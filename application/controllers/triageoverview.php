<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class TriageOverview extends CI_Controller
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

    //Check to make sure the user logged in has access to this page.
    if (!$this->session->userdata('logged_in')['TRIAGE']) {
      redirect('login', 'refresh');
    }
    //If the request method is not post on load, the page hasn't been submitted yet. (First run)
    if (!($this->input->server('REQUEST_METHOD') === 'POST')) {
      $this->showTriageOverview(FALSE);
    }
    //Else the request has been recognized, so we should prepare to redirect them to the triage detail screen.
    else {
      //Dequeue the next patient.
      $nextVisitId = $this->getNextPatient();
      //If we have -1, that means there is no one left to dequeue.
      if ($nextVisitId == -1) {
        $this->showTriageOverview(TRUE);
      }
      //Else that means we dequeued someone.
      else {
        //Pass the information to the next screen and redirect.
        $this->session->set_flashdata('visitId', $nextVisitId);
        redirect("triagedetail", 'refresh');
      }
    }
  }

  function showTriageOverview($failed) {
    //Set the page header.
    $headerData = array(
      'title' => 'BugBuster Clinic - Triage'
    );
    $this->load->view('header', $headerData);

    //Get the length of the triage queue for display on the page.
    $lengthOfQueue = $this->getLengthOfTriageQueue();

    //Add the queue length to the page data.
    $viewData = array(
      'lengthOfQueue' => $lengthOfQueue,
      'added' =>  $this->session->flashdata('change')
    );

    //The failed variable will be true when the page was submitted, but no one was dequeued.
    //If it's true, let the page know there was an error by sending the boolean.
    //(This usually won't happen, but, if the button is clicked at the same time on two screens, it's possible.)
    $viewData['error'] = $failed;

    //Load the view sending in the view data.
    $this->load->view('triageoverview', $viewData);

  }

  function getNextPatient() {
    $this->load->model('queue');
    return $this->queue->getNextPatientFromQueue('0');
  }

  function getLengthOfTriageQueue() {
    $this->load->model('queue');
    return $this->queue->getLengthOfQueue('0');
  }

} // end class
?>
