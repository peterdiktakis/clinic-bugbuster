<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hub extends CI_Controller
{
    function __construct() {
        parent::__construct();
    }

	function index() {


		// Check if logged in.
		// Just display links based on user's privileges.
        if ($this->session->userdata('logged_in')) {
			$this->showHub();

		}
		// user is not logged in, redirect to login page.
		else {
		    redirect('login', 'refresh');

		}
	}

	function showHub() {

			$links = array(
				'reception' => $this->session->userdata('logged_in')['RECEPTION'],
				'triage' => $this->session->userdata('logged_in')['TRIAGE'],
				'nurse' => $this->session->userdata('logged_in')['NURSE'],
				'admin' => $this->session->userdata('logged_in')['ADMIN']
			);

			$headerData = array(
						'title' => 'BugBuster Clinic - Hub'
					);

			$this->load->view('header', $headerData);
			$this->load->view('hub', $links);
			$this->load->view('footer');


	}

}
?>
