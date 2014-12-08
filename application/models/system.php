<?php
Class System extends CI_Model {
  function getCurrentPosition() {
    $query = $this->db->get('SYSTEM')->row_array();
    $currentPosition = $query['CURRENT_POSITION'];

    return $currentPosition;
  }

  function incrementPosition() {
    $currentPosition = $this->getCurrentPosition();
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
