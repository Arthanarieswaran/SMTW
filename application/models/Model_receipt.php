<?php 

class Model_receipt extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the active store data */
	public function getActiveStore()
	{
		$sql = "SELECT * FROM receipt WHERE active = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	
	public function getActiveCustomerData()
	{
		$sql = "SELECT * FROM receipt WHERE active = ? ORDER BY id DESC";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}
	/* get the brand data */
	public function getStoresData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM receipt where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM receipt ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function create($data)
	{
		if($data) {
			$this->db->insert('receipt', $data);
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
			$update = $this->db->update('receipt', $data);
			return ($update == true) ? true : false;
		}
	}

	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('receipt');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalStores()
	{
		$sql = "SELECT * FROM receipt WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	public function getCustomerDetails($id)
	{
		$sql = "SELECT * FROM receipt WHERE id = ?";
		$query = $this->db->query($sql, $id);
		return $query->result_array();
	}
	public function getPrintReceipt($id)
	{
		$sql = "SELECT receipt.*,customer.* FROM receipt JOIN customer on customer.id = receipt.customer_id WHERE receipt.id = ?";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	public function getReceiptItemDetails($data)
	{
		
		$startDate = '';
		$endDate = '';
		if($data == 'today'){
			$startDate = date('Y-m-d').' 00:00:00';
			$endDate = date('Y-m-d').' 23:59:59';
		}else if($data == 'month'){
			$startDate = date('Y-m').'-01 00:00:00';
			$endDate = date('Y-m-d').' 23:59:59';
		}else if($data == 'week'){
			$startDate = date('Y-m-d', strtotime("this week")).' 00:00:00';
			$endDate = date('Y-m-d').' 23:59:59';
		}else{
			$startDate = date('Y').'-01-01 00:00:00';
			$endDate = date('Y-m-d').' 23:59:59';
		}
		$fullline = strtotime($startDate).' AND '.strtotime($endDate);
		$sql = "SELECT receipt.*,customer.*,receipt.id as receiptid FROM receipt JOIN customer on customer.id = receipt.customer_id WHERE receipt.date BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getReceiptData($data){
		$sql = "SELECT * FROM receipt WHERE receipt.customer_id = ?";
		$query = $this->db->query($sql,$data);
		return $query->result_array();
	}
	
}