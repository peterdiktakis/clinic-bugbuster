<?php
Class Queue extends CI_Model {

  function getLengthOfQueue($queueName) {
    //Get the queue specified by the passed queue name.
    $queue = $this->getQueue($queueName);
    return $queue->count();
  }

  function getNextVisitId($queueName) {
    //Start a transaction.
    $this->db->trans_start();
    //Get the desired queue and lock it.
    $query = $this->db->query("SELECT QUEUE_CONTENT FROM QUEUE WHERE QUEUE_NAME = $queueName FOR UPDATE")->row_array();
    //Get the queue's content.
    $queueContent = $query['QUEUE_CONTENT'];

    //Create a new SplQueue
    $queue = new SplQueue();
    //Initialize the visit id.
    $visitId = -1;

    //Ensure that the queue's content is not empty.
    if ($queueContent != '') {
      //If the queue's content is not empty, unserialize it and dequeue the next person.
      $queue->unserialize($queueContent);
      $visitId = $queue->dequeue();
    }

    //Update the queue.
    $this->updateQueue($queue, $queueName);

    //Complete the transaction and unlock the record.
    $this->db->trans_complete();

    //Return the visitId. If the transaction failed, this will return -1.
    return $visitId;

  }

  function getNextPatientFromQueue($queueName) {
    $queue = $this->getQueue($queueName);

    //If the queue has content, dequeue the next patient.
    if ($queue->count() > 0) {
      $visitId = $queue->dequeue();
    }
    else {
      $visitId = -1;
    }
    // Update queue if patient existed.
    if ($visitId != -1) {
      $this->updateQueue($queue, $queueName);
    }

    return $visitId;
  }

  function findNextQueueToPullFrom() {
    $firstQueue = $this->getQueue('1');
    if($firstQueue->count() > 0) {
        return 1;
    }
    $frequencyArray = array('2', '3', '2', '4', '3', '2', '5', '2', '3', '4');
    $this->load->model('system');
    $systemCounter = $this->system->getCurrentPosition();
    $queueName = $frequencyArray[$systemCounter];
    if($this->getLengthOfQueue("$queueName") != 0)
      return $queueName;
    else
      while(($i = $this->system->incrementPosition()) != $systemCounter) {
        $queueName = $frequencyArray[$i];
        if($this->getLengthOfQueue("$queueName") != 0)
          return $queueName;
    }
  }

  function addToQueue($visitId, $queueName) {
    $queue = $this->getQueue($queueName);

    //Queue the visitId.
    $queue->enqueue($visitId);

    //Update the queue in the table.
    $query = $this->updateQueue($queue, $queueName);

    return $query;
  }


  /* Accepts an SplQueue, and updates the corresponding table with it.
  */
  private function updateQueue($queue, $queueName) {
    $data = array(
    'QUEUE_CONTENT' => $queue->serialize()
    );
    $this->db->where('QUEUE_NAME', (int)$queueName);
    $query = $this->db->update('QUEUE', $data);
    return $query;

  }
  private function getQueue($queueName) {
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
