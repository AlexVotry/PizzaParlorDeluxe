<?php 
class HomeModel extends CI_Model {

		public function dbCreate($datab)
		{
			$this->load->dbforge();
			$this->dbforge->create_database($datab);
		}

			public function userCreate($user)
		{
			$query = "CREATE TABLE IF NOT EXISTS $user (
				userID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				username VARCHAR (25) NOT NULL,
				firstName VARCHAR(25) NOT NULL,
				lastName VARCHAR(25) NOT NULL,
				password VARCHAR(300) NOT NULL,
				adminLevel INT(11) NOT NULL DEFAULT 2
				)";
			return $this->db->query($query);
		}

		public function custCreate($cust)
		{
			$query = "CREATE TABLE IF NOT EXISTS $cust (
				custID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				custFName VARCHAR (30) NOT NULL,
				custLName VARCHAR(30) NOT NULL,
				custAddress VARCHAR(50) NOT NULL,
				custAptNo VARCHAR(25) NULL,
				custCity VARCHAR(30) NOT NULL,
				custState VARCHAR(10) NOT NULL,
				custZip VARCHAR(10) NOT NULL,
				custPhone VARCHAR(20) NOT NULL,
				custEmail VARCHAR(255) NOT NULL
				)";
			return $this->db->query($query);
		}

		public function orderCreate($order)
		{
			$query = "CREATE TABLE IF NOT EXISTS $order (
				orderID INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				date VARCHAR (30) NOT NULL,
				time VARCHAR(30) NOT NULL,
				pizzaDesc VARCHAR(255) NOT NULL,
				priceSub FLOAT(7,2) NOT NULL,
				tax FLOAT(7,2) NOT NULL,
				priceTotal FLOAT(7,2) NOT NULL,
				custID INT(11) NULL,
				userID INT(11) NULL,
				completed CHAR(1) NOT NULL	
				)";
			//There is no method in CodeIgniter to add foreign key constraints.
			return $this->db->query($query);
		}
}
?>

