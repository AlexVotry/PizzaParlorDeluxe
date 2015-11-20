<?php 
if (! defined('BASEPATH')) exit('No direct script access allowed (home.php)');

/**
* 
*/
class Home extends CI_Controller
{
	
	function __construct()
	{
		parent:: __construct();
		$this->load->helper('url');
		// $this->load->model('users_model');
	}
	public function index() {
		$this->load->view('template/header'); 
        $this->load->view('pages/showHome');
        $this->load->view('template/footer');
	}
	public function custForm()
	{
		// $data['user_list'] = $this->users_model->get_all_users();
		$this->load->view('template/header');
		$this->load->view('pages/showCustForm');
		$this->load->view('template/footer');
	}
 	public function summary()
 	{
 		$this->load->view('template/header');
		$this->load->view('pages/showSummary');
		$this->load->view('template/footer');
 	}
}
 ?>