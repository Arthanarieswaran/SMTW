<?php 

class Model_customer_history extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the active store data */

	public function updateHistory($data,$id)
	{
		if($data && $id) {
			$this->db->where('bill_no', $id);
			$update = $this->db->update('customer_history', $data);
			return ($update == true) ? true : false;
		}
	}
	public function getHistoryData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM customer_history where bill_no = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	}
	public function create($data)
	{
		if($data) {
			$this->db->insert('customer_history', $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
	}
	public function remove($id)
	{
		if($id) {
			$this->db->where('bill_no', $id);
			$delete = $this->db->delete('customer_history');
			return ($delete == true) ? true : false;
		}
	}
    public function getCustomerSingleData($id){
		$sql = "SELECT SUM(paid_amount) as paid_amount , SUM(total_amount) as net_amount, SUM(cust_bal) as due_amount FROM customer_history WHERE customer_id = ?";
		$query = $this->db->query($sql, $id);
		return $query->result_array();
	}
	public function getCustomerpaidData($id){
		$sql = "SELECT SUM(paid_amount) as paid_amount FROM customer_history WHERE customer_id = ?";
		$query = $this->db->query($sql, $id);
		return $query->result_array();
	}

	public function countCustomerBalance($data)
	{
		$startDate = '';
		$endDate = '';
		if($data == 'today'){
			$startDate = date('Y-m-d').' 00:00:00';
			$endDate = date('Y-m-d').' 23:59:59';
		}else if($data == 'week'){
			$startDate = date('Y-m-d', strtotime("this week")).' 00:00:00';
			$endDate = date('Y-m-d').' 23:59:59';
		}else if($data == 'month'){
			$startDate = date('Y-m').'-01 00:00:00';
			$endDate = date('Y-m-d').' 23:59:59';
		}else{
			$startDate = date('Y').'-01-01 00:00:00';
			$endDate = date('Y-m-d').' 23:59:59';
		}
		$fullline = strtotime($startDate).' AND '.strtotime($endDate);
		$sql = "SELECT SUM(paid_amount) as paid_amount , SUM(total_amount) as net_amount FROM customer_history  WHERE customer_history.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		// $sql = "SELECT invoice.*,customer.* FROM invoice JOIN customer on customer.id = invoice.customer_id WHERE invoice.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function countCustomerBalanceCustom($data,$startDate,$endDate)
	{
		$sql = "SELECT SUM(paid_amount) as paid_amount , SUM(total_amount) as net_amount FROM customer_history  WHERE customer_history.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		// $sql = "SELECT invoice.*,customer.* FROM invoice JOIN customer on customer.id = invoice.customer_id WHERE invoice.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}

