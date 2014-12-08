<?php
Class Patient extends CI_Model {

	//CREATE
	function createPatient($patient) {
		$data = array(
			'RAMQ_ID' => htmlentities(strip_tags($patient['ramq'])),
			'FIRST_NAME' => htmlentities(strip_tags($patient['firstName'])),
			'LAST_NAME' => htmlentities(strip_tags($patient['lastName'])),
			'PHONE_HOME' => htmlentities(strip_tags($patient['homePhone'])),
			'PHONE_EMERGENCY' => htmlentities(strip_tags($patient['emergencyPhone'])),
			'PHYSICIAN' => htmlentities(strip_tags($patient['primaryPhysician'])),
			'EXISTING_CONDITIONS' => htmlentities(strip_tags($patient['existingConditions'])),
			'MEDICATION_1' => htmlentities(strip_tags($patient['medication1'])),
			'MEDICATION_2' => htmlentities(strip_tags($patient['medication2'])),
			'MEDICATION_3' => htmlentities(strip_tags($patient['medication3'])));

			$result = $this->db->insert('PATIENT', $data);
			$patient_id = $this->db->insert_id();

			return $patient_id;
		}

		//READ
		function findPatientById($patientId) {
			$this->db->where('PATIENT_ID', $patientId);
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
		function updatePatient($patient, $patientId) {

			$data = array(
				'RAMQ_ID' => htmlentities(strip_tags($patient['ramq'])),
				'FIRST_NAME' => htmlentities(strip_tags($patient['firstName'])),
				'LAST_NAME' => htmlentities(strip_tags($patient['lastName'])),
				'PHONE_HOME' => htmlentities(strip_tags($patient['homePhone'])),
				'PHONE_EMERGENCY' => htmlentities(strip_tags($patient['emergencyPhone'])),
				'PHYSICIAN' => htmlentities(strip_tags($patient['primaryPhysician'])),
				'EXISTING_CONDITIONS' => htmlentities(strip_tags($patient['existingConditions'])),
				'MEDICATION_1' => htmlentities(strip_tags($patient['medication1'])),
				'MEDICATION_2' => htmlentities(strip_tags($patient['medication2'])),
				'MEDICATION_3' => htmlentities(strip_tags($patient['medication3'])));

				$this->db->where('PATIENT_ID', $patientId);
				$this->db->update('PATIENT', $data);
			}

}
?>
