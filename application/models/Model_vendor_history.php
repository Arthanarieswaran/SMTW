<?php 

class Model_vendor_history extends CI_Model
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
			$update = $this->db->update('vendor_history', $data);
			return ($update == true) ? true : false;
		}
	}
	public function getHistoryData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM vendor_history where bill_no = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}
	}
	public function create($data)
	{
		if($data) {
			$this->db->insert('vendor_history', $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}
	}
	public function remove($id)
	{
		if($id) {
			$this->db->where('bill_no', $id);
			$delete = $this->db->delete('vendor_history');
			return ($delete == true) ? true : false;
		}
	}
    public function getCustomerSingleData($id){
		$sql = "SELECT SUM(paid_amount) as paid_amount , SUM(total_amount) as net_amount, SUM(vendor_bal) as due_amount FROM vendor_history WHERE vendor_id = ?";
		$query = $this->db->query($sql, $id);
		return $query->result_array();
	}
	public function getCustomerpaidData($id){
		$sql = "SELECT SUM(paid_amount) as paid_amount FROM vendor_history WHERE vendor_id = ?";
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
		}else if($data == 'month'){
			$startDate = date('Y-m').'-01 00:00:00';
			$endDate = date('Y-m-d').' 23:59:59';
		}else{
			$startDate = date('Y').'-01-01 00:00:00';
			$endDate = date('Y-m-d').' 23:59:59';
		}
		$fullline = strtotime($startDate).' AND '.strtotime($endDate);
		$sql = "SELECT SUM(paid_amount) as paid_amount , SUM(total_amount) as net_amount FROM vendor_history  WHERE vendor_history.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		// $sql = "SELECT invoice.*,customer.* FROM invoice JOIN customer on customer.id = invoice.vendor_id WHERE invoice.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getVendorDataDetails($data)
	{
		$this->db->select('vendor_history.vendor_id,SUM(paid_amount) as paid_amount,SUM(total_amount) as total_amount,vendor.name as vname');
		$this->db->from('vendor_history');
		$this->db->join('vendor','vendor.id = vendor_history.vendor_id');
		$this->db->group_by('vendor_id');
		$this->db->order_by('total_amount','desc'); 
		$query = $this->db->get();
		if(json_encode($query) == 'false'){
			return [];
		}else{
			return $query->result_array();
		}
	}
}

