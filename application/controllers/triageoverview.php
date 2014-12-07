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

    // if user is not logged in or does not have receptionist privileges.
    if (!$this->session->userdata('logged_in')['NURSE']) {
      redirect('login', 'refresh');
    }
    // user hasn't submitted the form.
    if ($this->form_validation->run() == FALSE) {
      $this->showTriageOverview(TRUE);
    }
    // redirect to triage screen.
    else {
      // form is submitted, remove a patient from the queue.

      $nextVisitId = $this->getNextPatient();
      // there are no patients in queue.
      if ($nextVisitId == -1) {
        $this->showTriageOverview(FALSE);
      }
      // a patient was dequeued from triage queue.
      else {
        // the triage screen requires visit ID
        $this->session->set_flashdata('visit_id', $nextVisitId);
        redirect("triagepatient", 'refresh');
      }
    }
  }

  function showTriageOverview($failed) {
    $headerData = array(
      'title' => 'BugBuster Clinic - Triage'
    );
    $this->load->view('header', $headerData);

    $this->load->model('queue');
    $lengthOfQueue = $this->queue->getLengthOfQueue('0');

    $viewData =
    array(
      'lengthOfQueue' => $lengthOfQueue
    );

    if($failed)
      $viewData['error'] = TRUE;
    else
      $viewData['error'] = FALSE;

    $this->load->view('triageoverview', $viewData);

  }

  function getNextPatient() {
    // load queue model.
    $this->load->model('queue');
    return $this->queue->getNextPatient("0");
  }

  function getLengthOfQueue() {
    // load queue model.
    $this->load->model('queue');
    return $this->queue->getLengthOfQueue('0');
  }

} // end class
?>
