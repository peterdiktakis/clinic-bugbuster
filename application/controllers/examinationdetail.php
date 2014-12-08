<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class ExaminationDetail extends CI_Controller
{
  function __construct() {
    parent::__construct();
    $this->load->library('form_validation');

  }

  function index() {
    //Get the visit id that was passed in via flash data.
    $this->session->keep_flashdata('visitId');
    $visitId = $this->session->flashdata('visitId');

    //Check to make sure the user is logged in with nurse privileges.
    if (!$this->session->userdata('logged_in')['NURSE']) {
      redirect('login', 'refresh');
    } else {
      //Check to see if the form has been submitted.
      if (!($this->input->server('REQUEST_METHOD') === 'POST')) {
        //If it hasn't, display the examination details.
        $this->showExaminationDetail($visitId);
      }
      else {
        //Else this means the form has been submitted. Update the visit with the exam time and redirect.
        $this->load->model('visit');
        $this->visit->updateVisitAfterExamination($visitId);

        $this->session->set_flashdata('change', "" . $_POST['firstName'] . " " . $_POST['lastName'] . " was successfully released." );
        redirect('examinationoverview', 'refresh');
      }
    }
  }

  function showExaminationDetail($visitId) {
    //Load the visit and patient models.
    $this->load->model('patient');
    $this->load->model('visit');

    //Get the visit and patient records from the database.
    $visit = $this->visit->findVisitById($visitId);
    $patientId = $this->visit->findPatientIdByVisitId($visitId);
    $patient = $this->patient->findPatientById($patientId);

    //Add the visit and patient data to an array.
    $data = array();
    $data['visit'] = $visit;
    $data['patient'] = $patient;

    //Set the header data and load the header.
    $headerData = array(
    'title' => 'BugBuster Clinic - Examination'
    );
    $this->load->view('header', $headerData);

    //Load the page with the page data.
    $this->load->view('examinationdetail', $data);
    $this->load->view('footer');
  }
}

?>
