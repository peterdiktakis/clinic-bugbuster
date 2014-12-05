<?php
function dequeueNextPatient($queueName) {

  $this->db->trans_start();
  $query = $this->db->query("SELECT QUEUE_CONTENT FROM QUEUE WHERE QUEUE_NAME = $queueName FOR UPDATE")->row_array();
  $queueContent = $query['QUEUE_CONTENT'];

  $queue = new SplQueue();
  $visitId = -1;

  if ($queueContent != '') {
    $queue->unserialize($queueContent);
    $nextVisitId = $queue->dequeue();
  }
  else {
    return $visitId;
  }

  $this->updateQueue($queue, $queueName);

  $this->db->trans_complete(); //commits or rollback the transaction, releases locks

  return $visitId;

}

function getTargetQueue() {

}

?>
