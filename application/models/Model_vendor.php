<?php 

class Model_vendor extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the active store data */
	public function getActiveStore()
	{
		$sql = "SELECT * FROM vendor WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	
	public function getActiveVendorData()
	{
		$sql = "SELECT * FROM vendor WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	/* get the brand data */
	public function getStoresData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM vendor where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM vendor";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('vendor', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('vendor', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('vendor');
			return ($delete == true) ? true : false;
		}
	}

	public function getVendorDetails($id)
	{
		$sql = "SELECT * FROM vendor WHERE id = ?";
		$query = $this->db->query($sql, $id);
		return $query->result_array();
	}

    public function getVendorSingleData($id){
		$sql = "SELECT * FROM vendor WHERE id = ?";
		$query = $this->db->query($sql, $id);
		return $query->result_array();
	}
}