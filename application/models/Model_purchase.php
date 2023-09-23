<?php 

class Model_purchase extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* get the orders data */
	public function getPurchaseData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM purchase WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM purchase ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// get the orders item data
	public function getPurchaseItemData($purchase_id = null)
	{
		if(!$purchase_id) {
			return false;
		}

		$sql = "SELECT * FROM purchase_item WHERE purchase_id = ?";
		$query = $this->db->query($sql, array($purchase_id));
		return $query->result_array();
	}

	public function create()
	{
		$user_id = $this->session->userdata('id');
		// $bill_no = 'INV-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    	$data = array(
    		'bill_no' => $this->input->post('bill_no'),
    		'vendor_id' => $this->input->post('vendor'),
			'invoice_date' => $this->input->post('due_date'),
			'extra_amount' => $this->input->post('extra_amount'),
    		'total_amount' => $this->input->post('gross_amount_value'),
    		'cgst_rate' => $this->input->post('service_charge_rate'),
    		'cgst_amount' => ($this->input->post('service_charge_value') > 0) ?$this->input->post('service_charge_value'):0,
    		'sgst_rate' => $this->input->post('vat_charge_rate'),
    		'sgst_amount' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
			'net_amount' => $this->input->post('net_amount_value'),
			'discount' => $this->input->post('discount'),
				'paid_amount' => $this->input->post('paid_amount'),
				'due_amount' => $this->input->post('due_amount_value'),
				'old_balance' => $this->input->post('v_bal'),
    		'user_id' => $user_id
    	);

		$insert = $this->db->insert('purchase', $data);
		$purchase_id = $this->db->insert_id();
		$customerData = array(
			'bill_no' => 'QUO'.$purchase_id,
			'vendor_id' => $this->input->post('vendor'),
			'date_time' => strtotime(date('Y-m-d h:i:s a')),
			'vendor_bal' => 0,
			'total_amount' => $this->input->post('net_amount_value'),
			'due_date' => null,
			'due_amount' => $this->input->post('due_amount_value'),
			'paid_amount' => $this->input->post('paid_amount'),
		);
		$create = $this->model_vendor_history->create($customerData);
		$this->load->model('model_products');

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
			if($this->input->post('product')[$x]){
				$kgs = null;
				$sqm = null;
				$sqf = null;
				if($this->input->post('type')[$x] == 'SquareMeter'){
					$sqm = $this->input->post('sbit1')[$x] * $this->input->post('sbit2')[$x] * $this->input->post('qty')[$x];
				}else if($this->input->post('type')[$x] == 'SquareFeet'){
					$sqf = $this->input->post('sbit1')[$x] * $this->input->post('sbit2')[$x] * $this->input->post('qty')[$x];
				}else{
					$kgs = $this->input->post('kgs')[$x];
				}
    		$items = array(
    			'purchase_id' => $purchase_id,
    			'product_id' => $this->input->post('product')[$x],
    			'qty' => $this->input->post('qty')[$x],
    			'rate' => $this->input->post('rate_value')[$x],
				'amount' => $this->input->post('amount_value')[$x],
				'square_bit_1' => $this->input->post('sbit1')[$x],
					'square_bit_2' => $this->input->post('sbit2')[$x],
					'product_type' => $this->input->post('type')[$x],
					'kgs_value' => $this->input->post('kgs')[$x],
					'kgs' => $kgs,
					'sqf' => $sqf,
					'sqm' => $sqm
    		);

    		$this->db->insert('purchase_item', $items);

    		// now decrease the stock from the product
    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
    		$qty = (int) $product_data['quotation_qty'] + (int) $this->input->post('qty')[$x];

    		if($kgs){
				$invKGS = (float) $product_data['quo_kgs'] + (float) $kgs;
				$update_product = array('quotation_qty' => $qty,'quo_kgs' => $invKGS);
			}
			if($sqm){
				$invSQM = (float) $product_data['quo_sqm'] + (float) $sqm;
				$update_product = array('quotation_qty' => $qty,'quo_sqm' => $invSQM);
			}
			if($sqf){
				$invSQF = (float) $product_data['quo_sqf'] + (float) $sqf;
				$update_product = array('quotation_qty' => $qty,'quo_sqf' => $invSQF);
			}


    		$this->model_products->update($update_product, $this->input->post('product')[$x]);
    	}
	}
		return ($purchase_id) ? $purchase_id : false;
	}

	public function countPurchaseItem($purchase_id)
	{
		if($purchase_id) {
			$sql = "SELECT * FROM purchase_item WHERE purchase_id = ?";
			$query = $this->db->query($sql, array($purchase_id));
			return $query->num_rows();	
		}
	}

	public function update($id)
	{
		if($id) {
		
			$user_id = $this->session->userdata('id');
			// fetch the order data 
			$data = array(
				'bill_no' => $this->input->post('bill_no'),
                'vendor_id' => $this->input->post('vendor'),
				'invoice_date' => $this->input->post('due_date'),
				'extra_amount' => $this->input->post('extra_amount'),
                'total_amount' => $this->input->post('gross_amount_value'),
                'cgst_rate' => $this->input->post('service_charge_rate'),
                'cgst_amount' => ($this->input->post('service_charge_value') > 0) ?$this->input->post('service_charge_value'):0,
                'sgst_rate' => $this->input->post('vat_charge_rate'),
                'sgst_amount' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
                'net_amount' => $this->input->post('net_amount_value'),
				'discount' => $this->input->post('discount'),
				'paid_amount' => $this->input->post('paid_amount'),
				'due_amount' => $this->input->post('due_amount_value'),
				'old_balance' => $this->input->post('v_bal'),
                'user_id' => $user_id
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('purchase', $data);
			$customerData = array(
				'bill_no' => 'QUO'.$id,
				'vendor_id' => $this->input->post('vendor'),
				'date_time' => strtotime(date('Y-m-d h:i:s a')),
				'vendor_bal' => 0,
				'total_amount' => $this->input->post('net_amount_value'),
				'due_date' => null,
				'due_amount' => $this->input->post('due_amount_value'),
				'paid_amount' => $this->input->post('paid_amount'),
			);
			$this->model_vendor_history->updateHistory($customerData,'QUO'.$id);
			// now the order item 
			// first we will replace the product qty to original and subtract the qty again
			$this->load->model('model_products');
			$get_order_item = $this->getPurchaseItemData($id);
			foreach ($get_order_item as $k => $v) {
				$product_id = $v['product_id'];
				$qty = $v['qty'];
				$purchaseId = $v['id'];
				// get the product 
                $product_data = $this->model_products->getProductData($product_id);
				$update_qty = $qty - $product_data['quotation_qty'];

				if($v['kgs']){
					$invKGS = (float) $product_data['quo_kgs'] - (float) $v['kgs'];
					$update_product_data = array('quotation_qty' => $update_qty,'quo_kgs' => $invKGS);
				}
				if($v['sqm']){
					$invSQM = (float) $product_data['quo_sqm'] - (float) $v['sqm'];
					$update_product_data = array('quotation_qty' => $qty,'quo_sqm' => $invSQM);
				}
				if($v['sqf']){
					$invSQF = (float) $product_data['quo_sqf'] - (float) $v['sqf'];
					$update_product_data = array('quotation_qty' => $qty,'quo_sqf' => $invSQF);
				}
				// update the product qty
				$this->model_products->update($update_product_data, $product_id);
			}

			// now remove the order item data 
			$this->db->where('purchase_id', $id);
			$this->db->delete('purchase_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
				if($this->input->post('product')[$x]){
					$kgs = null;
					$sqm = null;
					$sqf = null;
					$sbit1 = null;
					$sbit2 = null;
					$kgDa = null;
					if($this->input->post('type')[$x] == 'SquareMeter'){
						$sqm = $this->input->post('sbit1')[$x] * $this->input->post('sbit2')[$x] * $this->input->post('qty')[$x];
						$sbit1 = $this->input->post('sbit1')[$x];
						$sbit2 = $this->input->post('sbit2')[$x];
					}else if($this->input->post('type')[$x] == 'SquareFeet'){
						$sqf = $this->input->post('sbit1')[$x] * $this->input->post('sbit2')[$x] * $this->input->post('qty')[$x];
		
						$sbit1 = $this->input->post('sbit1')[$x];
						$sbit2 = $this->input->post('sbit2')[$x];
					}else{
						$kgs = $this->input->post('kgs')[$x];
						$kgDa = $this->input->post('kgs')[$x];
					}
	    		$items = array(
	    			'purchase_id' => $id,
	    			'product_id' => $this->input->post('product')[$x],
	    			'qty' => $this->input->post('qty')[$x],
	    			'rate' => $this->input->post('rate_value')[$x],
					'amount' => $this->input->post('amount_value')[$x],
					'square_bit_1' => $sbit1,
					'square_bit_2' => $sbit2,
					'product_type' => $this->input->post('type')[$x],
					'kgs_value' => $kgDa,
					'kgs' => $kgs,
					'sqf' => $sqf,
					'sqm' => $sqm
	    		);
				$this->db->insert('purchase_item', $items);
				$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
				$qty = (int) $product_data['quotation_qty'] + (int) $this->input->post('qty')[$x];
				if($kgs){
					$invKGS = (float) $product_data['quo_kgs'] + (float) $kgs;
					$update_product = array('quotation_qty' => $qty,'quo_kgs' => $invKGS);
				}
				if($sqm){
					$invSQM = (float) $product_data['quo_sqm'] + (float) $sqm;
					$update_product = array('quotation_qty' => $qty,'quo_sqm' => $invSQM);
				}
				if($sqf){
					$invSQF = (float) $product_data['quo_sqf'] + (float) $sqf;
					$update_product = array('quotation_qty' => $qty,'quo_sqf' => $invSQF);
				}
				$this->model_products->update($update_product, $this->input->post('product')[$x]);
	    	}
		}
			return true;
		}
	}



	public function remove($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('purchase');

			$this->db->where('purchase_id', $id);
			$delete_item = $this->db->delete('purchase_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function getTotalPurchase()
	{
		
		$startDate = date('Y-m-d').' 00:00:00';
		$endDate = date('Y-m-d').' 23:59:59';
		$fullline = strtotime($startDate).' AND '.strtotime($endDate);
		$sql = "SELECT * FROM purchase WHERE date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}

}