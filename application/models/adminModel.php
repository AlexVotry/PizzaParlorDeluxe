<?php 
	class AdminModel extends CI_Model {
		// added database to autoload.
	
		public function getAllAdmin()
		{
			// from adminList()
			// gets all the data in "admins" data base
			$query = $this->db->get('admins');
			return $query->result();
		}
		public function insertUserToDB($data)
		{
			// from insertNewUser()
			// puts the $data into 'admins'
			return $this->db->insert('admins', $data);
		}
		public function getById($userID)		
		{
			// from edit().  this allows me to edit one line from db.
			//  find the user by id goes to that line (get_where)
			$query = $this->db->get_where('admins',array('userID'=>$userID));
			// puts the new data at that id spot.
			return $query->row_array();
		}
		public function getByName($username)		
		{
			// from loginValidation.
			// find the adminLevel and userID
			$this->db->select('adminLevel, userID');
			$query = $this->db->get_where('admins',array('username'=>$username));
			return $query->row_array();
		}
		public function updateAdmin($data, $userID)	
		{
			// from update()
			// goes to the userID column in admins db and selects the $userID from update()
			$this->db->where('admins.userID', $userID);
			return $this->db->update('admins',$data);
		}
		public function deleteUser($userID)
		{
			// from delete(). (db column, userID)
			$this->db->where('admins.userID', $userID);
			return $this->db->delete('admins');
		}
		public function successLogin()
		{
			// from validate_credentials().  
			// compare the entered data with db data.
			// if correct, then log in.
			$password = $this->input->post('password');
			$hash = hash('sha256', $password);
			$this->db->where('username', $this->input->post('username'));
			$this->db->where('password', $hash);

			$query = $this->db->get('admins');

			if ($query->num_rows()==1) {
				return true;
			} else {
				return false;
			}
		}	
	}
 ?>