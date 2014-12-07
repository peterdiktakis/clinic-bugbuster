<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class ReceptionRegistration extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }
  function index()
  {
    //Setup the form validation rules.
    $this->form_validation->set_rules('ramq', 'RAMQ', 'trim|required');
    $this->form_validation->set_rules('firstName', 'First Name', 'trim|required');
    $this->form_validation->set_rules('lastName', 'Last Name', 'trim|required');
    $this->form_validation->set_rules('homePhone', 'Home Phone', 'trim|required');
    $this->form_validation->set_rules('emergencyPhone', 'Emergency Contact', 'trim|required');
    $this->form_validation->set_rules('existingConditions', 'Existing Conditions', 'trim|required');
    $this->form_validation->set_rules('primaryPhysician', 'Primary Care Physician', 'trim|required');

    //Set the fancy bootstrap error messages.
    $this->form_validation->set_error_delimiters("<div class='alert alert-danger' role='alert'>
    <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
    <span class='sr-only'>Error:</span>", '</div>');


    //Get the RAMQ number that was entered in the previous screen.
    $this->session->keep_flashdata('ramq');
    $ramq = $this->session->flashdata('ramq');

    //Check to see if the user that is accessing this page is logged in with reception privileges.
    if (!$this->session->userdata('logged_in')['RECEPTION']) {
      //If they're not, redirect them to the login screen.
      redirect('login', 'refresh');
    }
    else {
      //The user is logged in. Try to get the patient using the RAMQ patient data.
      $patient = $this->getPatient($ramq);
      if (isset($patient['PATIENT_ID'])) {
        $patientId = $patient['PATIENT_ID'];
      }

      //Check to see if the form successfully validates.
      if ($this->form_validation->run() == FALSE ) {
        $this->loadRegistration($patient);
      }
      else {
        //Fill out the form with the patient information.
        $patient = $_POST;
        //Check to see if the patient ID was already set from the getPatient call above.
        if (isset($patientId)) {
          //If so, we'll be updating the patient information.
          $this->updatePatient($patient, $patientId);
        }
        //Otherwise, we're adding a new patient.
        else {
          //Add the new patient.
          $patientId = $this->addPatient($patient);
        }

        //Now that we've figured out things with the patient, register this visit in the database.
        $visitId = $this->addVisit($patientId);

        //Add the patient to the triage queue.
        $queueInsert = $this->addToTriage($visitId);

        //Setup the alert message to let the user know that the patient was successfully added to the queue.
        $message = $patient['firstName'] . " " . $patient['lastName'] . " was added to the triage queue";

        //Send the message through the flashdata so it can be placed on the RAMQ registration page.
        $this->session->set_flashdata('change', $message);

        //Redirect back to the RAMQ registration page.
        redirect("receptionramq", 'refresh');
      }
    }
  }

  function getPatient($ramq)
  {
    //Load the patient model.
    $this->load->model('patient');

    //Find the patient by their RAMQ number.
    $patient = ($this->patient->findPatientByRAMQ($ramq));

    //If we haven't found a patient, set a form validation message saying so.
    if (!$patient) {
      $this->form_validation->set_message('getPatient', 'Patient not found.');
      return array(
        'RAMQ_ID' => $ramq
      );
    }
    else {
      //Else that means we have an array of the database record.
      //Make the database record be the main array.
      return array_merge($patient);
    }
  }

  function loadRegistration($patient)
  {
    $this->load->helper(array(
      'form',
      'url'
    ));

    //Define the page title.
    $headerData = array(
      'title' => 'BugBuster Clinic - Patient Registration'
    );

    //Load the header.
    $this->load->view('header', $headerData);

    //Load the helper method to get the medications array.
    $this->load->helper('getmedications');
    $medications = getMedications();

    //Add the patient information (if it exists) and medication list to the page data.
    $data['medications'] = $medications;
    $data['patient'] = $patient;

    //Load the view sending in the data.
    $this->load->view('receptionregistration', $data);

    //Load the footer.
    $this->load->view('footer');
  }

  function addToTriage($visitId) {
    //Load the queue model.
    $this->load->model('queue');
    $inserted = $this->queue->addToQueue($visitId, '0');
    return $inserted;
  }

  function addVisit($patientId) {
    // create instance of visit model
    $this->load->model('visit');
    $visitId = ($this->visit->createVisit($patientId));
    return $visitId;
  }

  function addPatient($patient) {
    // create instance of user model

    $this->load->model('patient');
    // add the patient to the db using the model, returning the patient id.
    $patient_id = ($this->patient->createPatient($patient));
    if ($patient_id) {
      return $patient_id;
    }
    else {
      return false;
    }

  }

  function updatePatient($patient, $patientId) {
    // create instance of user model
    $this->load->model('patient');
    $updated = ($this->patient->updatePatient($patient, $patientId));
    if ($updated) {
      return $updated;
    }
    else {
      return false;
    }
  }

}



?>
