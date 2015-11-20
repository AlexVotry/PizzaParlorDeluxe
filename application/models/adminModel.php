<?php 
	class AdminModel extends CI_Model {
		function __construct() {
			parent::__construct();
			// don't specify database since we put "votr5810" into the database.php as default.
			$this->load->database();

		}
		public function getAllAdmin()
		{
			// gets all the data in "admins" data base
			$query = $this->db->get('admins');
			return $query->result();
		}
		public function insertUserToDB($data)
		{
			// puts the $data into 'admins'
			return $this->db->insert('admins', $data);
		}
		public function getById($userID)		
		{
			//  find the user by id goes to that line (get_where)
			$query = $this->db->get_where('admins',array('userID'=>$userID));
			// puts the new data at that id spot.
			return $query->row_array();
		}
		public function updateAdmin($data, $userID)	
		{
			$this->db->where('admins.userID', $userID);
			return $this->db->update('admins',$data);
		}
		public function deleteUser($userID)
		{
			$this->db->where('admins.userID', $userID);
			return $this->db->delete('admin');
		}

		public function chkLogin()
		{
			$refer1 = "hhttp://localhost/pizzaParlorDeluxe/"; //assigns a default URL to a variable
			$refer2 = "http://localhost/pizzaParlorDeluxe/index.php"; //assigns the full URL to a variable

// check to see if the referring page is correct, if not, send the user back to the log in page
			if (($_SERVER['HTTP_REFERER'] != $refer1) && ($_SERVER['HTTP_REFERER'] != $refer2)){
   			header('Location: '."<?php echo base_url(); ?>"); 
   			//sends the user who has arrived from an unacceptable URL back to the log in page
			}
			elseif ((!isset($_POST['txtUser'])) && (!isset($_POST['pswWord']))) {
			    header('Location: '."<?php echo base_url(); ?>");
			}
			else {
			    // requiring the db connection file, this file must exist and included only once
			   // require_once("../includes/connect.php");
			    $adminLogin = $_POST['txtUser'];
			    $adminPass = $_POST['pswWord'];
			        // used for encrypting the user's password, clear hash if exists
			    $hash = "";

			    // set default number of records found in DB
			    $recCount = 0;

			    // start SQL statement
			    $sql = "SELECT userID, firstName, lastName, adminLevel, COUNT(*) AS numRecs FROM admins WHERE login = '$adminLogin' AND password = ";

			    // check to see if default password is being used. End the SQL statement.
			    if ($adminPass == "'Noth1ng!'"){
			        // User is signing for the first time
			        $sql .= "'$adminPass';";
			    }
			    else {
			        // User has signed in before, encrypt the password
			        $hash = hash('sha256', $adminPass);
			        $sql .= "'$hash';";
			    }
			   
			    // run the query using mysqli_query
			    $result = mysqli_query($dbc, $sql) or die(mysqli_error);

			    // Get data as an associative array
			    // assign the count of records to a variable
			    if ($result){
			        while ($row = mysqli_fetch_array ($result, MYSQLI_ASSOC)){
			            $recCount = $row['numRecs'];
			        }
			    }
			}
		}
	}
 ?>