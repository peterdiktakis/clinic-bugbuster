<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class TriageDetail extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }
  function index()
  {

    $this->form_validation->set_error_delimiters("<div class='alert alert-danger' role='alert'>
    <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
    <span class='sr-only'>Error:</span>", '</div>');

    $this->form_validation->set_rules('primaryComplaint', 'Primary Complaint', 'trim|required');
    $this->form_validation->set_rules('symptom1', 'First Symptom', 'trim|required');
    $this->form_validation->set_rules('symptom2', 'Second Symptom', 'trim|required');
    $this->form_validation->set_rules('priority', 'Priority', 'trim|required');

    //Get the visit id from the session flash data.
    $this->session->keep_flashdata('visitId');
    $visit_id = $this->session->flashdata('visitId');

    //Check to make sure that the user accessing this page has triage privileges.
    if (!$this->session->userdata('logged_in')['TRIAGE']) {
      redirect('login', 'refresh');
    } else {
      //If the request method isn't post, display the form.
      if (!($this->input->server('REQUEST_METHOD') === 'POST')) {
        $this->showTriageDetail($visit_id);
      }
      //Else that means the form has been submitted.
      else {
        //Check if there are form validation errors.
        if ($this->form_validation->run() == FALSE) {
          //If there are, redisplay the form.
          $this->showTriageDetail($visit_id);
        }
        //Else that means the form submitted fine.
        else {
          //Get the queue to place the patient into.
          $queueName = trim(htmlentities($_POST['priority']));

          //Add the patient to the queue.
          $this->addToQueue($visit_id, $queueName);

          $this->updateVisit($visit_id);

          //Set the flash data message to display a message on the previous screen indicating that a person was added to the queue.
          $this->session->set_flashdata('change', "" . $_POST['firstName'] . " " . $_POST['lastName'] . " was successfully triaged." );
          redirect("triageoverview", 'refresh');
        }
      }
    }
  }

  function showTriageDetail($visit_id) {

    // get patient / registration information.
    // load  model.
    $this->load->model('visit');
    $patient_id = $this->visit->findPatientIdByVisitId($visit_id);
    $this->load->model('patient');
    $patient = $this->patient->findPatientById($patient_id);

    $headerData = array(
    'title' => 'BugBuster Clinicc - Triage Details'
    );
    $formData = array(
    'patient' => $patient
    );
    $this->load->view('header', $headerData);
    $this->load->view('triagedetail', $formData);
    $this->load->view('footer');

  }

  function updateVisit($visitId) {
    $this->load->model('visit');
    $this->visit->updateVisitAfterTriage($visitId, $_POST);
  }

  function addToQueue($visit_id, $queueName) {
    $this->load->model('queue');
    $this->queue->addToQueue($visit_id, $queueName);
  }

} // end class
?>
