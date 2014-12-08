<?php
Class Visit extends CI_Model {

	//CREATE
	/*
	* Used by the receptionist when patient arrives.
	*/
	function createVisit($patientId) {

		$data = array(
			'PATIENT_ID' => $patientId,
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

	function findPatientIdByVisitId($visitId) {
		$this->db->select('PATIENT_ID');
		$this->db->where('VISIT_ID', $visitId);
		$query = $this->db->get('VISIT')->row_array();
		$patient_id = $query['PATIENT_ID'];
		return $patient_id;
	}

	//UPDATE
	function updateVisitAfterTriage($visitId, $visit) {

		$data = array (
			'CODE' => $visit['priority'],
			'PRIMARY_COMPLAINT' => $visit['primaryComplaint'],
			'SYMPTOM_1' => $visit['symptom1'],
			'SYMPTOM_2' => $visit['symptom2']
		);

		$this->db->set('TIME_TRIAGE', 'NOW()', FALSE);
		$this->db->where('VISIT_ID', $visitId);
		$this->db->update('VISIT', $data);
	}

	function updateVisitAfterExamination($visitId) {
		$this->db->set('TIME_EXAMINATION', 'NOW()', FALSE);
		$this->db->where('VISIT_ID', $visitId);
		$this->db->update('VISIT');
	}

}
?>
