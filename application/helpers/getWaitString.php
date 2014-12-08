<?php
function getWaitString($visitId) {
  $this->load->model('queue');
  $this->load->model('system');

  $queue1 = $this->queue->getQueue('1');
  $queue2 = $this->queue->getQueue('2');
  $queue3 = $this->queue->getQueue('3');
  $queue4 = $this->queue->getQueue('4');
  $queue5 = $this->queue->getQueue('5');

  $queues = array($queue1, $queue2, $queue3, $queue4, $queue5);

  $exists = FALSE;

  foreach($queues as $queue)
  if(contains($queue, $visitId))
  $exists = TRUE;

  if($exists) {
    $waitString = "";

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
      $selectedQueue = $frequencyArray[$counter];
      if($selectedQueue->count() != 0) {
        $pulledId = $selectedQueue->dequeue();
        $waitString .= $frequencyArray[$counter] + 1;
      }
      $counter++;
    }
  }
}

function contains($queue, $id) {
  if($queue->count()) == 0)
  return false;

  $queue->setIteratorMode(SplDoublyLinkedList::IT_MODE_KEEP);

  foreach($queue as $val)
  if($val == $id)
  return true;

  return false;
}

?>
