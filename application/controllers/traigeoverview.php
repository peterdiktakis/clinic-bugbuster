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
    } else {
      // user hasn't submitted the form.
      if ($this->form_validation->run() == FALSE) {
        $this->showTriageOverview();
      }
      // redirect to triage screen.
      else {
        // form is submitted, remove a patient from the queue.

        $nextVisitId = $this->getNextPatient();
        // there are no patients in queue.
        if ($nextVisitId == -1) {
          $this->showTriageOverview();
        }
        // a patient was dequeued from triage queue.
        else {
          // the triage screen requires visit ID
          $this->session->set_flashdata('visit_id', $nextVisitId);
          redirect("triagepatient", 'refresh');
        }
      }
    }
  }

  function showTriageOverview() {
    $headerData = array(
      'title' => 'CQS - Triage Overview'
    );
    $this->load->view('header', $headerData);

    $lengthOfQueue = $this->getLengthOfQueue();

    $viewData =
    array(
    'lengthOfQueue' => $lengthOfQueue
    );

    $this->load->view('triage_overview_view', $viewData);

  }

  function getNextPatient() {
    // load queue model.
    $this->load->model('queue');
    return $this->queue->getNextPatient('0');
  }

  function getLengthOfQueue() {
    // load queue model.
    $this->load->model('queue');
    return $this->queue->getLengthOfQueue('0');
  }

} // end class
?>
