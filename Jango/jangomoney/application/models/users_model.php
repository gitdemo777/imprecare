<?php
class Users_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get user by his is
    * @param int $user_id 
    * @return array
    */
    public function get_user_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Fetch users data from the database
    * possibility to mix search, filter and order
    * @param int $user_id 
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_users($user_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    
		$this->db->select('users.id');
		$this->db->select('users.first_name');
		$this->db->select('users.email');
		$this->db->select('users.phone');
		$this->db->select('users.joining');
		$this->db->select('users.earning');
		$this->db->select('users.balance');
		$this->db->from('users');
		$this->db->group_by('users.id');

		if($order){
			$this->db->order_by($order, $order_type);
		}else{
		    $this->db->order_by('id', $order_type);
		}

		$this->db->limit($limit_start, $limit_end);
		
		$query = $this->db->get();
		
		return $query->result_array(); 	
    }

    /**
    * Count the number of rows
    * @param int $user_id
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_users($user_id=null, $search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('users');
		
		if($search_string){
			$this->db->like('last_name', $search_string);
		}
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Delete user
    * @param int $id - user id
    * @return boolean
    */
	function delete_user($id){
		$this->db->where('id', $id);
		$this->db->delete('users'); 
	}
 
}
?>