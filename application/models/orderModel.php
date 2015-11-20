<?php 
	class OrderModel extends CI_Model {
		function __construct() {
			parent::__construct();
			// don't specify database since we put "votr5810" into the database.php as default.
			$this->load->database();

		}
		public function getOrder()
		{
			// gets all the data in "admins" data base
			$query = $this->db->get('orders');
			return $query->result();
		}
		public function insertOrder($data)
		{
			// puts the $data into 'admins'
			return $this->db->insert('orders', $data);
		}
		public function getOrderById($userID)		
		{
			//  find the user by id goes to that line (get_where)
			$query = $this->db->get_where('admins',array('orderID'=>$userID));
			// puts the new data at that id spot.
			return $query->row_array();
		}


	}
 ?>