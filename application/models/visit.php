<?php
Class Visit extends CI_Model {

	//CREATE
	/*
	* Used by the receptionist when patient arrives.
	*/
	function createVisit($patientId) {

		$data = array(
			'PATIENT_ID' => $patientId,
			'TIME_TRIAGE' => null,
			'TIME_EXAMINATION' => null
		);

		$insert = $this->db->insert('VISIT', $data);
		$visit_id = $this->db->insert_id();

		return $visit_id;
	}

	//READ
	function findVisitById($visitId) {
		$this->db->where('VISIT_ID', $visitId);
		$query = $this->db->get('VISIT')->row_array();
		return $query;
	}

	function getPatientId($visitId) {
		$this->db->select('PATIENT_ID');
		$this->db->where('VISIT_ID', $visitId);
		$query = $this->db->get('VISIT')->row_array();
		$patient_id = $query['PATIENT_ID'];
		return $patient_id;
	}

	//UPDATE
	function updateVisit($visit, $visitId) {

		$data = array (
			'CODE' => $code,
			'PRIMARY_COMPLAINT' => $primaryComplaint,
			'SYMPTOM_1' => $symptom_1,
			'SYMPTOM_2' => $symptom_2
		);

		$this->db->set('TRIAGE_TIME', 'NOW()', FALSE);
		$this->db->where('VISIT_ID', $visit_id);
		$this->db->update('VISIT', $data);
	}

}
?>
