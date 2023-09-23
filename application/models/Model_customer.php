<?php 

class Model_customer extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the active store data */
	public function getActiveStore()
	{
		$sql = "SELECT * FROM customer WHERE active = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	
	public function getActiveCustomerData()
	{
		$sql = "SELECT * FROM customer WHERE active = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	/* get the brand data */
	public function getStoresData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM customer where active = '1' and id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM customer where active = '1' ORDER BY id DESC ";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$this->db->insert('customer', $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
	}

	public function updateHistory($data)
	{
		if($data && $id) {
			$this->db->where('bill_no', $id);
			$update = $this->db->update('customer_history', $data);
			return ($update == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('customer', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id,$data)
	{
		if($id) {
			$this->db->where('id', $id);
			$update = $this->db->update('customer', $data);
			return ($update == true) ? true : false;
			// $delete = $this->db->delete('customer');
			// return ($delete == true) ? true : false;
		}
	}

	public function countTotalStores()
	{
		$sql = "SELECT * FROM customer WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	public function getCustomerDetails($id)
	{
		$sql = "SELECT * FROM customer WHERE id = ?";
		$query = $this->db->query($sql, $id);
		return $query->result_array();
	}
	public function mobileduplicate($id){
		$sql = "SELECT * FROM customer WHERE mobile = ?";
		$query = $this->db->query($sql, $id);
		return $query->result_array();
	}
}