<?php 
class Earnmore_model extends CI_Model {
 
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
    public function get_earnmore_by_id($id)
    {
		$this->db->select('*');
		$this->db->from('earn_more');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->result_array(); 
    }    

    /**
    * Fetch earnmore data from the database
    * possibility to mix search, filter and order
    * @param string $search_string 
    * @param strong $order
    * @param string $order_type 
    * @param int $limit_start
    * @param int $limit_end
    * @return array
    */
    public function get_earnmore($earnmore_id=null, $search_string=null, $order=null, $order_type='Asc', $limit_start, $limit_end)
    {
	    $this->db->select('*');
		$this->db->from('earn_more');
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
    function count_earnmore($search_string=null, $order=null)
    {
		$this->db->select('*');
		$this->db->from('earn_more');
		if($search_string){
			$this->db->like('name', $search_string);
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
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_earnmore($data)
    {
		$insert = $this->db->insert('earn_more', $data);
	    return $insert;
	}

    /**
    * Update earnmore
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_earnmore($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('earn_more', $data);
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
    * Delete earnmore
    * @param int $id - earnmore id
    * @return boolean
    */
	function delete_earnmore($id){
		$this->db->where('id', $id);
		$this->db->delete('earn_more'); 
	}
 
}
?>