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
		$this->load->model('homeModel');
	}
	public function index()
	{
		// index is default program run. First, set up db.
		// 
		$this->createDB();
	}
	public function createDB()
	{
		$this->load->dbutil();
		if ($this->dbutil->database_exists('votr5810')) {
			// set up tables:
			$this->tableCreate();
		} else {
			$datab = 'votr5810';
			$this->model_users->dbCreate($datab);
			$this->tableCreate();
		}
	}
	public function tableCreate()		
	{
		// set up tables if they don't exist
		$user = 'admins';
		$cust = 'customers';
		$order = 'orders';
		$this->homeModel->userCreate($user);
		$this->homeModel->custCreate($cust);
		$this->homeModel->orderCreate($order);
		$this->home();
	}
	public function home() {
		// view home page:
		$this->load->view('template/header'); 
        $this->load->view('pages/showHome');
        // $this->load->view('template/footer');
	}
	
}
 ?>