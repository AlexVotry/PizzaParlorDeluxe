<?php 
	class OrderModel extends CI_Model {

		public function getOrder()
		{
			// from adminOrder()
			// gets all the data in "orders" data base
			$query = $this->db->get('orders');
			return $query->result();
		}



		public function insertOrder($pdata)
		{
			// from insertNewPizza()
			// puts the $data into 'orders'
			return $this->db->insert('orders', $pdata);
		}
		public function updateAdmin($data, $custID)	
		{
			// from update()
			// goes to the orderID column in orders db and selects the $custID from update()
			$this->db->where('orders.orderID', $custID);
			return $this->db->update('orders',$data);
		}
		public function getOrderById($orderID, $data)		
		{
			// from deliver().  change completed to yes.
			$this->db->where('orders.orderID', $orderID);
			return $this->db->update('orders', $data);

		}

		public function getCust()
		{
			// from adminOrder()
			// gets all the data in "customers" data base
			$query = $this->db->get('customers');
			return $query->result();
		}
		
		public function insertCust($cdata)
		{
			// from insertNewPizza()
			// puts the $data into 'customers'
			return $this->db->insert('customers', $cdata);
		}
		public function getLastCustID()
			// from insertNewPizza()
			// gets id from current customer and converts to a number
			// so I can use it for order table. Now cust and order are linked.
		{
			$this->db->select_max('custID');
			$res1 = $this->db->get('customers');
					$res2 = $res1->result_array();
					$result = $res2[0]['custID'];
					return $result;
		}
		public function openOrder($tDate)
		{
			$this->db
				->select()
				->from('orders')
				->where('date', $tDate)
				->join('customers', 'customers.custID = orders.custID');
				$query = $this->db->get();
				return $query->result();
		}
		public function deliveredToday($tDate)
		{
			$this->db
				->select()
				->from('orders')
				->where('date', $tDate)
				->join('customers', 'customers.custID = orders.custID')
				->join('admins', 'admins.userID = orders.userID');
				$query = $this->db->get();
				return $query->result();
		}
		public function allOrders()
		{
			$this->db
				->select()
				->from('orders')
				->join('customers', 'customers.custID = orders.custID')
				->join('admins', 'admins.userID = orders.userID');
				$query = $this->db->get();
				return $query->result();
		}
	}
// $this->db->select('title')->from('mytable')->where('id', $id)->limit(10, 20);
// $query = $this->db->get();
 ?>