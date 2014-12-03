<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class ReceptionRAMQ extends CI_Controller {
  function __construct() {
    parent::__construct();
    //We need the session and form_validation libraries for this page.
    $this->load->library('session');
    $this->load->library('form_validation');
  }

  function index() {
    //The RAMQ number is mandatory. Clean up the input, require it, and clean it. (Does this strip tags!?)
    $this->form_validation->set_rules('ramq', 'RAMQ', 'trim|required|xss_clean');

    //Setup the fancy Boostrap error stuff.
    $this->form_validation->set_error_delimiters("<div class='alert alert-danger' role='alert'>
    <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
    <span class='sr-only'>Error:</span>", '</div>');

    //Check to see if the user that is currently logged in has reception privileges.
    if (!$this->session->userdata('logged_in')['RECEPTION']) {
      //If they don't, check to see if they're at least logged in.
      if(!$this->session->userdata('logged_in')) {
        //If they're not, redirect them to the login page.
        redirect('login', 'refresh');
      }
      else {
        //Else this means they're logged in, but are trying to acces something they shouldn't be. :-)
        redirect('hub', 'refresh');
      }
    }
    //Else that means that whoever is logged in has access to this page.
    else {
      //When either running for the first time or failing to complete the form, load the registration form.
      if ($this->form_validation->run() == FALSE ) {
        $this->loadRegistration();
      }
      //Else, the form has been successfully filled in. Yay!
      else {
        //We'll need to pass the RAMQ number to the next screen, so, add it to
        //the POST array.
        $this->session->set_flashdata('ramq', $_POST['ramq']);
        //Redirect the user to the Reception Registration page.
        redirect("receptionregistration", 'refresh');
      }
    }
  }

  //This function loads the appropriate views to display the registration field.
  function loadRegistration() {
    //Create data for the header. This includes the title, as well as any patient
    //that was triaged from a previous add. (After the receptionist completes the form,
    //they come back here.)
    $headerData = array(
      'title' => 'BugBuster Clinic - Reception Area',
      'added' =>  $this->session->flashdata('change')
    );
    $this->load->view('header', $headerData);
    $this->load->view('receptionramq');
    $this->load->view('footer');
  }
}
?>
