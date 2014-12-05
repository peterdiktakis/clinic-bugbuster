<?php
Class System extends CI_Model {
  function getCurrentPosition() {
    $this->db->select('QUEUE_CONTENT');
    $query->db->get('SYSTEM')->row_array();
    $currentPosition = $query['CURRENT_POSITION'];

    return $currentPosition;
  }

  function incrementPosition() {
    $position = getCurrentPosition();
    $currentPosition++;

    if ($currentPosition == 9) {
      $currentPosition = 0;
    }

    $data = array(
      'CURRENT_POSITION' => $currentPosition
    );
    $this->db->update('SYSTEM', $data);
    return $currentPosition;
  }
}
?>
