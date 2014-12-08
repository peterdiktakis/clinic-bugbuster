<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class WaitString extends CI_Controller {
  function index() {
    var_dump($this->getWaitString(61));
    $this->load->view('waitstring');
  }

  function getWaitString($visitId) {
    $this->load->model('queue');
    $this->load->model('system');

    $queue1 = $this->getQueue('1');
    $queue2 = $this->getQueue('2');
    $queue3 = $this->getQueue('3');
    $queue4 = $this->getQueue('4');
    $queue5 = $this->getQueue('5');

    $queues = array($queue1, $queue2, $queue3, $queue4, $queue5);

    $waitString = "";

    $exists = FALSE;

    foreach($queues as $queue)
    if($this->contains($queue, $visitId))
    $exists = TRUE;

    if($exists) {
      $pulledId = -1;

      $counter = $this->system->getCurrentPosition();

      while($pulledId != $visitId) {
        if($counter > 9)
        $counter = 0;

        if($queues[0]->count() > 0) {
          $pulledId = $queues[0]->dequeue();
          $waitString .= '1';
          continue;
        }
        $frequencyArray = array(1, 2, 1, 3, 2, 1, 4, 1, 2, 3);
        $selectedQueue = $queues[$frequencyArray[$counter]];
        if($selectedQueue->count() != 0) {
          $pulledId = $selectedQueue->dequeue();
          $waitString .= $frequencyArray[$counter] + 1;
        }
        $counter++;
      }
    }

    return $waitString;
  }

  function contains($queue, $id) {
    if($queue->count() == 0)
    return false;

    $queue->setIteratorMode(SplDoublyLinkedList::IT_MODE_KEEP);

    foreach($queue as $val)
    if($val == $id)
    return true;

    return false;
  }

  function getQueue($queueName) {
    // First get the queue.
    $this->db->select('QUEUE_CONTENT');
    $this->db->from('QUEUE');
    $this->db->where('QUEUE_NAME', $queueName);
    $query = $this->db->get()->row_array();
    $queueContent = $query['QUEUE_CONTENT'];

    $queue = new SplQueue();

    /* If queue is empty, then return the new empty queue.
    */
    if ($query['QUEUE_CONTENT'] == '') {
      return $queue;
    }
    /* Queue isn't empty - de serialize the queue and return
    */
    else {
      $queue->unserialize($queueContent);
      return $queue;
    }

  }
}
?>
