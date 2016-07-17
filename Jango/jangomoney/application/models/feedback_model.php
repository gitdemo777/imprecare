<?php
class Feedback_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */
    public function get_feedback_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('feedback');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }    

    /**
    * Fetch feedback data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_feedback($feedback_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    $this->db->select('*');
		$this->db->from('feedback');
		$this->db->group_by('id');

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
    * @param int $search_string
    * @param int $order
    * @return int
    */
    function count_feedback($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('feedback');
		if($order){
			$this->db->order_by($order, 'Asc');
		}else{
		    $this->db->order_by('id', 'Asc');
		}
		$query = $this->db->get();
		return $query->num_rows();        
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_feedback($data)
    {
		$insert = $this->db->insert('feedback', $data);
	    return $insert;
	}

    /**
    * Update feedback
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_feedback($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('feedback', $data);
		$report = array();
		$report['error'] = $this->db->_error_number();
		$report['message'] = $this->db->_error_message();
		if($report !== 0){
			return true;
		}else{
			return false;
		}
	}

    /**
    * Delete feedback
    * @param int $id - feedback id
    * @return boolean
    */
	function delete_feedback($id){
		$this->db->where('id', $id);
		$this->db->delete('feedback'); 
	}
 
}
?>