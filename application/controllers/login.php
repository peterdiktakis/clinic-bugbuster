<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Login extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_getLogin');

    //Set the default look of error messages.
    $this->form_validation->set_error_delimiters("<div class='alert alert-danger' role='alert'>
    <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
    <span class='sr-only'>Error:</span>", '</div>');

    if ($this->form_validation->run() == FALSE) {
      $headerData = array(
        'title' => 'BugBuster Clinic - Login'
      );
      $this->load->view('header', $headerData);
      $this->load->view('login');
      $this->load->view('footer');
    } else {
      redirect('hub', 'refresh');
    }

  }

  function logout()
  {
    $this->session->sess_destroy();
    redirect('login', 'refresh');
  }

  function getLogin($password)
  {
    $this->load->model('user');
    $user = $this->input->post('username');
    if (count(trim($user)) == 0) {
      return false;
    }

    $invalidCount = ($this->user->getInvalidLoginCount($user));
    if ($invalidCount >= 5) {
      $this->form_validation->set_message('getLogin', 'Too many attempts - contact admin to reset password');
      return false;
    }

    $result = ($this->user->login($user, $password));
    if ($result) {

      // successful login - set session data.
      $session_array = array();
      foreach ($result as $key => $value) {
        if ($key === 'HASHED_PASSWORD') {
          continue;
        }
        $session_array[$key] = $value;
      }
      // dump it into session
      $this->session->set_userdata('logged_in', $session_array);
      return true;
    } else {

      $this->form_validation->set_message('getLogin', 'Incorrect username or password');
      return false;
    }

  }
}
?>
