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

    // read visit id from flash data.
    $this->session->keep_flashdata('visitId');
    $visit_id = $this->session->flashdata('visitId');

    // TODO: will need form validation rules...

    // if user is not logged in or does not have receptionist privileges.
    if (!$this->session->userdata('logged_in')['NURSE']) {
      redirect('login', 'refresh');
    } else {
      // user hasn't submitted the form.
      if (!($this->input->server('REQUEST_METHOD') === 'POST')) {
        $this->showTriageForm($visit_id);
      }
      // redirect to triage screen.
      else {
        // form is submitted

        // if there are form errors.
        if ($this->form_validation->run() == FALSE) {
          $this->showTriageForm($visit_id);
        }
        // no form errors~!!!
        else {
          // need to add him to appropriate Queue based on TRIAGE level.

          $queueName = trim(htmlentities($_POST['priority']));

          $this->addToQueue($visit_id, $queueName);

          $primaryComplaint = trim(htmlentities($_POST['primaryComplaint']));
          $firstSymptom = trim(htmlentities($_POST['symptom1']));
          $secondSymptom = trim(htmlentities($_POST['symptom2']));

          $this->updateVisit($visit_id, $queueName, $primaryComplaint, $firstSymptom, $secondSymptom);

          redirect("triageoverview", 'refresh');
        }
      }
    }
  }

  function showTriageForm($visit_id) {

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

  function updateVisit($visit_id, $queueName, $primaryComplaint, $firstSymptom, $secondSymptom) {
    $this->load->model('visit');
    $this->visit->updateVisitAfterTriage($visit_id, $_POST);
  }

  function addToQueue($visit_id, $queueName) {
    $this->load->model('queue');
    $this->queue->addToQueue($visit_id, $queueName);
  }

} // end class
?>
