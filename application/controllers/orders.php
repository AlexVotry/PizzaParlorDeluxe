<?php 
if (! defined('BASEPATH')) exit('No direct script access allowed (orders.php)');

class Orders extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('orderModel');
	}
	// starts with index.
	public function index()
	{
		// index is default program run, send to custForm().
		$this->custForm();
	}
	public function custForm()
	{
		// if its a specialty pizza get size
		if (filter_has_var(INPUT_POST, "size")) {
       $size = $_POST['size'];
       // if its a build it pizza get sizeB
		} else {
		    $size = $_POST['sizeB'];
		}
		// if its a specialty pizza get crust type
		if (filter_has_var(INPUT_POST, "crust")) {
		    $crust = $_POST['crust'];
		     // if its a build it pizza get crustB
		} else {
		    $crust = $_POST['crustB'];
		}
		// if its a specialty pizza provide name.
		if (isset($_POST['specialty'])) {
		    $specialty = $_POST['specialty'];
		    // if its a build it pizza don't print out anything
		}   else {
		     $specialty = "";
		    }
		    // if its a build it pizza add toppings, otherwise toppings don't print out.
		if (isset($_POST['topping'])) {
		    $topping = $_POST['topping'];
		    $pTopping = "";
		    $numToppings = count($topping);
		    // adds each chosen topping and provides a comma.
		    foreach ($topping as  $value) {
		        if ($value !="") {
		            $pTopping = $pTopping . " $value, ";
		        }
		    }
		    // if specialty pizza is chosen, no toppings will be chosen.
			}  else {
		        $pTopping = "";
		        $numToppings = 0;
		    }
	    // determine the base price for the pizza sizes.
	    switch ($size) {
	        case "Large":
	        $price = 20.00;
	        break;
	        case "Medium":
	        $price = 17.5;
	        break;
	        case "Small":
	        $price = 14;
	        break;
	        default:
	        $price = 0;
	        break;
		}
	    // determine price for specialty.
	    switch ($specialty) {
	        case "Aloha":
	            $cost = $price + 1;
	            break;
	        case "Meat Lover":
	            $cost = $price + 4;
	            break;
	        case "BBQ Chicken":
	            $cost = $price + 3;
	            break;
	        default:
	            $cost = 0;
	            break;
	    }
	    // if toppings have been chosen, determine the price.
	    if($numToppings > 0) $cost = $price + ($numToppings * .85);
	    if ($crust == "gluten free") $cost += 3;
	    // create the variables that will be entered into the orders db
	    $rawTotal = $cost * 1.095;
	    $rawTax = $cost * .095;
	    // convert values to 2 decimals.
	    $tax = number_format($rawTax, 2);
	    $totalWithTax = number_format($rawTotal, 2);
	    $subTotal = number_format($cost, 2);
	    // either specialty or pToppings will print, the other will be ""
		$finalPizza = "$size $specialty $pTopping with $crust crust";
		$_SESSION['finalPizza'] = $finalPizza;
		$_SESSION['tax'] = $tax;
		$_SESSION['totalWithTax'] = $totalWithTax;
		$_SESSION['subTotal'] = $subTotal;
		// default city, for hidden input.  needs a value to start.
		// $_SESSION['city'] = 'Edmonds';
			$data['pizza'] = $this->orderModel->getOrder();
			$this->load->view('template/header');
			$this->load->view('pages/showCustForm');
			$this->load->view('template/footer');
	}
 	public function summary()
 		// this ends the customer experience.
 	{
 		$this->load->view('template/header');
		$this->load->view('pages/showSummary');
		$this->load->view('template/footer');
 	}	
	public function insertNewPizza()
	{
		// from showCustForm.  takes info from form and enters into db
		

		// put customer info into variables to work with.
		$zip = 0;
		$fname =  $this->input->post('fname');
		$lname = $this->input->post('lname');
		$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		$address = $this->input->post('address');
		$aptnum = $this->input->post('aptnum');
		$zip = $this->input->post('zip');
		$comment = $this->input->post('comment');;
		// there's two Edmonds zip code which are lower than Lynn zips.
		if ($zip > 98026) {
			$city = "Lynnwood";
		} else {
			$city = "Edmonds";
		};
		// get info to summary page in easier variables.
		$custInfo = "$fname $lname <br>$address  $aptnum <br>$city, $zip WA <br>";
		$contactInfo = "contact info: $phone<br> $email";
		$_SESSION['custInfo'] = $custInfo;
		$_SESSION['contactInfo'] = $contactInfo;
		if ($comment !="") {
			$instructions = "Your special instructions are: <br> $comment";
		} else {
			$instructions = "";
		}
		$_SESSION['custInfo'] = $custInfo;
		$_SESSION['contactInfo'] = $contactInfo;
		$_SESSION['instructions'] = $instructions;
		$_SESSION['city'] = $city;

				// insert customer info into customer db
		$cdata['custFName'] = $this->input->post('fname');
		$cdata['custLName'] = $this->input->post('lname');
		$cdata['custAddress'] = $this->input->post('address');
		$cdata['custAptNo'] = $this->input->post('aptnum');
		$cdata['custCity'] = $city;
		$cdata['custState'] = $this->input->post('state');
		$cdata['custZip'] = $this->input->post('zip');
		$cdata['custPhone'] = $this->input->post('phone');
		$cdata['custEmail'] = $this->input->post('email');
		$cus = $this->orderModel->insertCust($cdata);

		// insert pizza info into orders db
		$lastID = $this->orderModel->getLastCustID();
		$pdata['date'] = $this->input->post('date');
		$pdata['time'] = $this->input->post('time');
		$pdata['pizzaDesc'] = $this->input->post('finalPizza');
		$pdata['priceSub'] = $this->input->post('subTotal');
		$pdata['tax'] = $this->input->post('tax');
		$pdata['priceTotal'] = $this->input->post('totalWithTax');
		$pdata['custID'] = $lastID;
		$pdata['userID'] = $this->input->post('userID');
		$pdata['completed'] = $this->input->post('completed');
		$this->orderModel->insertOrder($pdata);
		
		// if db is updated go to summary page.
		if ($cus) {
			$this->load->view('template/header');
			$this->load->view('pages/showSummary');
		}
	}
	public function todayDate()
	{
		// $this->session->all_userdata()
		// $udata['uname'] = $this->adminModel->getByName($username);
		// print_r($udata);
		// this gets the date loaded prior to starting adminOrder()
		//  without this, undefined date on first load, fine after reload.
 		date_default_timezone_set("America/Los_Angeles");
        $date = date("m/d");
 		$_SESSION['date'] = $date;
 		$this->adminOrder();
	}

	public function adminOrder()
 	{
 		// this goes to showAdminOrder.  This comes from admin/loginValidation()
 		date_default_timezone_set("America/Los_Angeles");
        $date = date("m/d");
 		// print_r($date);
 		 // $date = "11/23";
 		$data['openOrder'] = $this->orderModel->openOrder($date);
 		$this->load->view('template/header');
		$this->load->view('pages/showAdminOrder', $data);
		$this->load->view('template/footer');
		// $_SESSION['date'] = $date;
 	}
	public function deliver()
	{
		$data['userID'] = $this->session->userdata('userID');
		// this makes $orderID = the third segment from the left after index.php in URL
		$orderID = $this->uri->segment(3);
		$yes = 'y';
		// change completed to yes.
		$data['completed'] = $yes;
		// gets the userID from the table that matches the 3rd segment.
		$this->orderModel->getOrderById($orderID, $data);
		redirect('orders/justDelivered');
	}
	public function justDelivered()
	{
		// this goes to showAdminOrder.  This comes from admin/loginValidation()
 		date_default_timezone_set("America/Los_Angeles");
  		$date = date("m/d");
 		$data['openOrder'] = $this->orderModel->deliveredToday($date);
 		$this->load->view('template/header');
		$this->load->view('pages/showJustDelivered', $data);
		$this->load->view('template/footer');
		// $_SESSION['date'] = $date;
	}
	public function allDelivered()
	{
		$data['openOrder'] = $this->orderModel->allOrders();
 		$this->load->view('template/header');
		$this->load->view('pages/showAllDelivered', $data);
		$this->load->view('template/footer');
	}
}