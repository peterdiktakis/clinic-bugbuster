<?php
Class Patient extends CI_Model {

	//CREATE
	function createPatient($patient) {
		$data = array(
			'RAMQ_ID' => $patient['ramq'],
			'FIRST_NAME' => $patient['firstName'],
			'LAST_NAME' => $patient['lastName'],
			'PHONE_HOME' => $patient['homePhone'],
			'PHONE_EMERGENCY' => $patient['emergencyPhone'],
			'PHYSICIAN' => $patient['primaryPhysician'],
			'EXISTING_CONDITIONS' => $patient['existingConditions'],
			'MEDICATION_1' => $patient['medication1'],
			'MEDICATION_2' => $patient['medication2'],
			'MEDICATION_3' => $patient['medication3'] );

			$result = $this->db->insert('PATIENT', $data);
			$patient_id = $this->db->insert_id();

			return $patient_id;
		}

		//READ
		function getPatientById($patient_id) {
			$this->db->where('PATIENT_ID', $patient_id);
			$query = $this->db->get('PATIENT')->row_array();
			return $query;
		}

		function findPatientByRAMQ($ramq) {
			$this->db->where('RAMQ_ID', $ramq);
			$query = $this->db->get('PATIENT')->row_array();

			if (count($query) != 0) {
				return $query;
			}
			else {
				return false;
			}
		}

		//UPDATE
		function updatePatient($patient, $patient_id) {

			$data = array(
				'RAMQ_ID' => $patient['ramq'],
				'FIRST_NAME' => $patient['firstName'],
				'LAST_NAME' => $patient['lastName'],
				'PHONE_HOME' => $patient['homePhone'],
				'PHONE_EMERGENCY' => $patient['emergencyPhone'],
				'PHYSICIAN' => $patient['primaryPhysician'],
				'EXISTING_CONDITIONS' => $patient['existingConditions'],
				'MEDICATION_1' => $patient['medication1'],
				'MEDICATION_2' => $patient['medication2'],
				'MEDICATION_3' => $patient['medication3'] );

				$this->db->where('PATIENT_ID', $patient_id);
				$this->db->update('PATIENT', $data);
			}

}
?>
