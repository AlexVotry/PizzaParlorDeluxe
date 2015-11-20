<?php 
if (! defined('BASEPATH')) exit('No direct script access allowed (users.php)');

class Admin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('adminModel');
	}
	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('pages/login');
		$this->load->view('template/footer');
	}

	public function logIn()
	{
		# code...
	}
	public function adminList()
	{
		$data['adminList'] = $this->adminModel->getAllAdmin();
		$this->load->view('template/header');
		$this->load->view('pages/showAdmin', $data);
		$this->load->view('template/footer');
	}
	public function addForm()
	{
		$this->load->view('template/header');
		$this->load->view('pages/showInsert');
		$this->load->view('template/footer');
	}
	// this is to grab the new admin data and insert it into the data base
	public function insertNewUser()
		{
			$udata['username'] = $this->input->post('username');
			$udata['firstName'] = $this->input->post('firstName');
			$udata['lastName'] = $this->input->post('lastName');
			$udata['password'] = $this->input->post('password');
			$udata['adminLevel'] = $this->input->post('adminLevel');
			$res = $this->adminModel->insertUserToDB($udata);
			if ($res) {
				header('location:'.base_url().'index.php/admin/'.$this->index());
			}
		}
	// add editing function
		public function edit() {
			$userID = $this->uri->segment(3);
			$data['admin'] = $this->adminModel->getById($userID);
			$this->load->view('template/header');
			$this->load->view('pages/edit', $data);
		}
	public function update() {
		$mdata['username']=$_POST['username'];
		$mdata['firstName']=$_POST['firstName'];
		$mdata['lastName']=$_POST['lastName'];
		$mdata['password']=$_POST['password'];
		$mdata['adminLevel']=$_POST['adminLevel'];
		$res=$this->adminModel->updateAdmin($mdata, $_POST['userID']);
		if($res){
			header('location:'.base_url()."index.php/admin/".$this->index());
		}
	}
	public function delete($userID) {
		$this->adminModel->deleteUser($userID);
		$this->index();
	}
	public function login_validation()
	{

		$this->form_validation->set_rules('username', 'User Name', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|md5');

		if ($this->form_validation->run() == false) {
			$this->load->view('pages/showLogin');
		} else {
			$this->load->view('pages/showAdmin');
		}

	}
}

 ?>