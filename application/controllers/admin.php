<?php 
if (! defined('BASEPATH')) exit('No direct script access allowed (admin.php)');

class Admin extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('adminModel');
	}
	// starts with index.
	public function index()
	{
		// index is default program run, send to login().
		// reset logon attempts to 0
		$_SESSION["logOnAttempt"] = 0;
		$this->login();
	}
	public function login()
	{
		$this->load->view('template/header');
		$this->load->view('pages/login');
		$this->load->view('template/footer');
		// goes to loginValidation
	}
	public function loginValidation()
	// decide where to go from log in page based on input.
	{
		$adminPass = $_POST['password'];
		// $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
		// $hashPW = $hasher->HashPassword($adminPass);
		$this->form_validation->set_rules('username', 'User Name', 'required|trim|callback_validate_credentials');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		// check to see if first time login:
		
			if ($adminPass == "Noth1ng!") {
				redirect('admin/addForm');
			}
			// if the the form is validated username is logged in:
			elseif ($this->form_validation->run()) {
				$hash = hash('sha256', $adminPass);
        		$sql .= "'$hash';";
				// compare entered username, get adminLevel for userdata
				$uname = $this->input->post('username');
				$ldata = $this->adminModel->getByName($uname);
				$data = array(
					'username' => $this->input->post('username'),
					'userID' => $ldata['userID'],
					'adminLevel' => $ldata['adminLevel'],
					'is_logged_in' => 1
					);

				// set the userdata to show who is logged in:
				$_SESSION['userID'] = $userID;
				$this->session->set_userdata($data);
				redirect('orders/todayDate');
				// if password/login is wrong, count log on attempts, 
				// provide messages based on number of log on attempts
			} else {
				if (!isset($_SESSION["logOnAttempt"])) {
					$_SESSION["logOnAttempt"] = 0;
				}
				$_SESSION["logOnAttempt"] += 1;
				$this->load->view('template/header');
				if ($_SESSION["logOnAttempt"] >= 10){
	   				 $_SESSION["loginWarn"] = "There is a problem with the log in capabilities.  
	   				 Contact the administrator of this site for access.";
	   				 $this->load->view('pages/FailedLogin');
				} elseif ($_SESSION["logOnAttempt"] >3) {
		    		$_SESSION["loginWarn"] = "There is a problem with your credentials. 
		    		Contact the administrator of this site for access.";
					$this->load->view('pages/FailedLogin');	
				} else {
					// if less than 3 attempts, stay on login page.
					$this->load->view('pages/login');
				}
					$this->load->view('template/footer');
				}
	}
	// public function checkDB($password)
	// {
	// 	// field validation succeded. Validate against database
	// 	$username = $this->input->post('username');
	// 	// query database
	// 	$result = $this->admins->login($username, $password);

	// }
	public function adminList()
		// this is where adminLevel of 1 can go to edit employees info.	
	{
		$data['adminList'] = $this->adminModel->getAllAdmin();
		$this->load->view('template/header');
		$this->load->view('pages/showAdmin', $data);
		$this->load->view('template/footer');
	}
	public function addForm()
	{
		// new administrator info form.  gets sent to insert new user on submit
		$this->load->view('template/header');
		$this->load->view('pages/showInsert');
		$this->load->view('template/footer');
	}
	public function insertNewUser()
		// adds new administrator info into admin db.
	{
			// set adminLevel of person
		$adminLevel = $this->session->userdata('adminLevel');
		// with the form_validation library loaded, I set rules for input.
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[admins.username]');
		// is_unique ensures that each username is unique.
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');
		// simple way to determine if password matches.
		$this->form_validation->set_message('is_unique', "that username already exists");
		//add the info entered on showInsert into admin db
		if ($this->form_validation->run()) {
			$password = $_POST['password'];
			$hash = hash('sha256', $password);
			$udata['username'] = $this->input->post('username');
			$udata['firstName'] = $this->input->post('firstName');
			$udata['lastName'] = $this->input->post('lastName');
			$udata['password'] = $hash;
			$udata['adminLevel'] = $this->input->post('adminLevel');
			$res = $this->adminModel->insertUserToDB($udata);
			// if successfully added to db go back to either adminList or log in.
			if ($res) {
					if ($adminLevel == 1) {
						redirect('admin/adminList');
					}	else {
						// go to login
						header('location:'.base_url().'index.php/admin/'.$this->index());
					}
			}
		} else {
			// otherwise stay on page.
			$this->load->view('template/header');
			$this->load->view('pages/showInsert');
			$this->load->view('template/footer');
		}
	}
	public function edit()
		// edit button from showAdmin comes here.
	{
		// this makes $userID = the third segment from the left after index.php in URL
		$userID = $this->uri->segment(3);
		// gets the userID from the table that matches the 3rd segment.
		$data['admin'] = $this->adminModel->getById($userID);
		$this->load->view('template/header');
		// this loads edit page with $userID data and pre-fills text boxes from db
		$this->load->view('pages/edit', $data);
	}
	public function update() 
	{
		$password = $_POST['password'];
		$hash = hash('sha256', $password);
		// takes all info from pages/edit, sends as $mdata, by userID
		$mdata['username']=$_POST['username'];
		$mdata['firstName']=$_POST['firstName'];
		$mdata['lastName']=$_POST['lastName'];
		$mdata['password']=$hash;
		$mdata['adminLevel']=$_POST['adminLevel'];
		// first parameter is the data inserted, second is the location
		$res=$this->adminModel->updateAdmin($mdata, $_POST['userID']);
		// if db successfully updated, go back to AdminList 
		if($res){
			redirect('admin/adminList');
		}
	}
	public function delete($userID) 
	{
		// delete button from showAdmin
		$this->adminModel->deleteUser($userID);
		redirect('admin/adminList');
	}
	public function validate_credentials()
	{
		// from loginValidation().  
		// this checks if username and pw match db.
		if ($this->adminModel->successLogin())
		{
			return true;
		} else
		// personal message for validation failure.
		{
			$this->form_validation->set_message('validate_credentials', 'incorrect username/password');
			return false;
		}
	}
	public function reset()
	{
		// this is for testing.  when login attempts are over 3 
		// I need a way to get back to program and reset counter.
		$_SESSION["logOnAttempt"] = 0;
		$this->load->view('template/header');
		$this->load->view('pages/login');
		$this->load->view('template/footer');
	}
	public function logout()
	{
		// this is to clear session data on log out.
		$this->session->sess_destroy();
		redirect('admin/login');
	}
	public function chkLevel()
	{
		$adminLevel = $this->session->userdata('adminLevel');
		$user = $this->session->userdata('userID');
		if ($adminLevel == 1 || $user == 1) {
			redirect('admin/adminList');
		}
		else {
			
			 $this->load->view('template/header');
			 $this->load->view('pages/showLevelWarning');	
		}
	}
}

 ?>