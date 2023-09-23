<?php 

class Model_orders extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
	}

	/* get the orders data */
	public function getOrdersData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM orders WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM orders ORDER BY id DESC";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	// get the orders item data
	public function getOrdersItemData($order_id = null)
	{
		if(!$order_id) {
			return false;
		}

		$sql = "SELECT * FROM orders_item WHERE order_id = ?";
		$query = $this->db->query($sql, array($order_id));
		return $query->result_array();
	}

	public function create()
	{
		$user_id = $this->session->userdata('id');
		$customerData= $this->model_customer->getStoresData($this->input->post('customer'));
		$sql1 = "SELECT * FROM orders";
		$query1 = $this->db->query($sql1);
		$orderNum = $query1->num_rows();
		$bill_no = 'SMTW-QUO-'.strtoupper(substr($customerData['name'],0,3)).''.$orderNum;
		$newDate = date("Y-m-d", strtotime($this->input->post('inv_date'))); 
    	$data = array(
    		'bill_no' => $bill_no,
    		'customer_id' => $this->input->post('customer'),
    		'date_time' => strtotime($newDate. ' '.date('h:i:s a')),
    		'gross_amount' => $this->input->post('gross_amount_value'),
    		'service_charge_rate' => $this->input->post('sgst_amount'),
    		'service_charge' => ($this->input->post('service_charge_value') > 0) ?$this->input->post('service_charge_value'):0,
    		'vat_charge_rate' => $this->input->post('cgst_amount'),
    		'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
			'net_amount' => $this->input->post('net_amount_value'),
			'paid_amount' => $this->input->post('paid_amount'),
			'due_amount' => $this->input->post('due_amount_value'),
			'extra_amount' => $this->input->post('extra_amount'),
			'due_date' => $this->input->post('due_date'),
			'old_balance' => $this->input->post('net_balance_amount_value'),
			'discount' => $this->input->post('discount'),
			'gst' => $this->input->post('gstData'),
			'payment_method' => $this->input->post('payment_method'),
			'transaction_number' => $this->input->post('transaction'),
			'cheque_amount' => $this->input->post('cheque_amount'),
			'online_amount' => $this->input->post('online_amount'),
			'cash_amount' => $this->input->post('cash_amount'),
			'extra_gst' => $this->input->post('extra_gst'),
			'extra_gst_amount' => $this->input->post('extra_gst_amount'),
    		'paid_status' => 1,
    		'user_id' => $user_id
    	);

		$insert = $this->db->insert('orders', $data);
		$order_id = $this->db->insert_id();

		$this->load->model('model_products');
		$customerData = array(
			'bill_no' => $bill_no,
    		'customer_id' => $this->input->post('customer'),
    		'date_time' => strtotime(date('Y-m-d h:i:s a')),
			'paid_amount' => $this->input->post('paid_amount'),
			'total_amount' => $this->input->post('net_amount_value'),
			'due_date' => $this->input->post('due_date'),
			'due_amount' => $this->input->post('due_amount_value'),
		);
		$custData = $this->db->insert('customer_history', $customerData);
		

		$count_product = count($this->input->post('product'));
    	for($x = 0; $x < $count_product; $x++) {
			if($this->input->post('product')[$x]){
					$kgs = null;
					$sqm = null;
					$sqf = null;
					if($this->input->post('pType')[$x] == 'SquareMeter'){
						$sqqf = $this->input->post('sbit1')[$x] * $this->input->post('sbit2')[$x];
						$sqmm = $sqqf * 0.305;
						$sqa = $sqmm ;
						$sqm = number_format($sqa * $this->input->post('qty')[$x],'3');
					}else if($this->input->post('pType')[$x] == 'SquareFeet'){
						$sqf = $this->input->post('sbit1')[$x] * $this->input->post('sbit2')[$x] * $this->input->post('qty')[$x];
					}else{
						$kgs = $this->input->post('kgs')[$x];
					}
    		$items = array(
    			'order_id' => $order_id,
    			'product_id' => $this->input->post('product')[$x],
    			'qty' => $this->input->post('qty')[$x],
				'rate' => $this->input->post('rate_value')[$x],
				'net_rate' => $this->input->post('net_rate_value')[$x],
				'amount' => $this->input->post('amount_value')[$x],
				'net_rate_amount' => $this->input->post('net_Amount')[$x],
				'square_bit_1' => $this->input->post('sbit1')[$x],
				'square_bit_2' => $this->input->post('sbit2')[$x],
				'product_type' => $this->input->post('pType')[$x],
				'gst_rate' => $this->input->post('gst_rate')[$x],
				'kgs' => $kgs,
				'sqm' => $sqm,
				'sqf' => $sqf,
    		);
        //    var_dump($items);
    		$this->db->insert('orders_item', $items);

    		// now decrease the stock from the product
    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
    		$qty = (int) $product_data['quotation_qty'] - (int) $this->input->post('qty')[$x];

			if($kgs){
				$invKGS = (float) $product_data['quo_kgs'] - (float) $kgs;
				$update_product = array('quotation_qty' => $qty,'quo_kgs' => $invKGS);
			}
			if($sqm){
				$invSQM = (float) $product_data['quo_sqm'] - (float) $sqm;
				$update_product = array('quotation_qty' => $qty,'quo_sqm' => $invSQM);
			}
			if($sqf){
				$invSQF = (float) $product_data['quo_sqf'] - (float) $sqf;
				$update_product = array('quotation_qty' => $qty,'quo_sqf' => $invSQF);
			}
			$this->model_products->update($update_product, $this->input->post('product')[$x]);
		}
    	}

		return ($order_id) ? $order_id : false;
		
	}

	public function countOrderItem($order_id)
	{
		if($order_id) {
			$sql = "SELECT * FROM orders_item WHERE order_id = ?";
			$query = $this->db->query($sql, array($order_id));
			return $query->num_rows();
		}
	}

	public function update($id)
	{
		if($id) {
			$user_id = $this->session->userdata('id');
			// fetch the order data 
			$newDate = date("Y-m-d", strtotime($this->input->post('inv_date'))); 
			$data = array(
				'date_time' => strtotime($newDate. ' '.date('h:i:s a')),
				'update_date' => strtotime($newDate. ' '.date('h:i:s a')),
				'gross_amount' => $this->input->post('gross_amount_value'),
				'service_charge_rate' => $this->input->post('sgst_amount'),
				'service_charge' => ($this->input->post('service_charge_value') > 0) ?$this->input->post('service_charge_value'):0,
				'vat_charge_rate' => $this->input->post('cgst_amount'),
				'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
				'net_amount' => $this->input->post('net_amount_value'),
				'paid_amount' => $this->input->post('paid_amount'),
				'due_amount' => $this->input->post('due_amount_value'),
				'extra_amount' => $this->input->post('extra_amount'),
				'due_date' => $this->input->post('due_date'),
				'old_balance' => $this->input->post('net_balance_amount_value'),
				'discount' => $this->input->post('discount'),
				'gst' => $this->input->post('gstData'),
				'payment_method' => $this->input->post('payment_method'),
				'transaction_number' => $this->input->post('transaction'),
				'cheque_amount' => $this->input->post('cheque_amount'),
				'online_amount' => $this->input->post('online_amount'),
				'cash_amount' => $this->input->post('cash_amount'),
				'extra_gst' => $this->input->post('extra_gst'),
			    'extra_gst_amount' => $this->input->post('extra_gst_amount'),
				'paid_status' => 1,
				'user_id' => $user_id
	    	);

			$this->db->where('id', $id);
			$update = $this->db->update('orders', $data);
			
			$orderData = $this->getOrdersData($id);

			$customerData = array(
				'bill_no' => $orderData['bill_no'],
				'customer_id' => $this->input->post('customer_id'),
				'date_time' => strtotime(date('Y-m-d h:i:s a')),
				'paid_amount' => $this->input->post('paid_amount'),
				'total_amount' => $this->input->post('net_amount_value'),
				'due_date' => $this->input->post('due_date'),
				'due_amount' => $this->input->post('due_amount_value'),
			);
			
			$this->model_customer_history->updateHistory($customerData,$orderData['bill_no']);

			// now the order item 
			// first we will replace the product qty to original and subtract the qty again
			$this->load->model('model_products');
			$get_order_item = $this->getOrdersItemData($id);
			foreach ($get_order_item as $k => $v) {
				$product_id = $v['product_id'];
				$qty = $v['qty'];
				// get the product 
				$product_data = $this->model_products->getProductData($product_id);
				$update_qty = $qty + $product_data['quotation_qty'];

				if($v['kgs'] && $v['kgs'] > 0){
					$invKGS = (float) $product_data['quo_kgs'] + (float) $v['kgs'];
					$update_product_data = array('quotation_qty' => $update_qty,'quo_kgs' => $invKGS);
				}
				if($v['sqm'] && $v['sqm'] > 0){
					$invSQM = (float) $product_data['quo_sqm'] + (float) $v['sqm'];
					$update_product_data = array('quotation_qty' => $update_qty,'quo_sqm' => $invSQM);
				}
				if($v['sqf'] && $v['sqf'] > 0){
					$invSQF = (float) $product_data['quo_sqf'] + (float) $v['sqf'];
					$update_product_data = array('quotation_qty' => $update_qty,'quo_sqf' => $invSQF);
				}
				// update the product qty
				$this->model_products->update($update_product_data, $product_id);
			}

			// now remove the order item data 
			$this->db->where('order_id', $id);
			$this->db->delete('orders_item');

			// now decrease the product qty
			$count_product = count($this->input->post('product'));
	    	for($x = 0; $x < $count_product; $x++) {
				if($this->input->post('product')[$x]){
					$kgs = null;
					$sqm = null;
					$sqf = null;
					if($this->input->post('pType')[$x] == 'SquareMeter'){
						$sqqf = $this->input->post('sbit1')[$x] * $this->input->post('sbit2')[$x];
						$sqmm = $sqqf * 0.305;
						$sqa = $sqmm;
						$sqm = number_format($sqa * $this->input->post('qty')[$x],'3');
					}else if($this->input->post('pType')[$x] == 'SquareFeet'){
						$sqf = $this->input->post('sbit1')[$x] * $this->input->post('sbit2')[$x] * $this->input->post('qty')[$x];
					}else{
						$kgs = $this->input->post('kgs')[$x];
					}
	    		$items = array(
	    			'order_id' => $id,
					'product_id' => $this->input->post('product')[$x],
					'qty' => $this->input->post('qty')[$x],
					'rate' => $this->input->post('rate_value')[$x],
					'net_rate' => $this->input->post('net_rate_value')[$x],
					'amount' => $this->input->post('amount_value')[$x],
					'net_rate_amount' => $this->input->post('net_Amount')[$x],
					'square_bit_1' => $this->input->post('sbit1')[$x],
					'square_bit_2' => $this->input->post('sbit2')[$x],
					'product_type' => $this->input->post('pType')[$x],
					'gst_rate' => $this->input->post('gst_rate')[$x],
					'kgs' => $kgs,
					'sqm' => $sqm,
					'sqf' => $sqf,
	    		);
	    		$this->db->insert('orders_item', $items);

    		// now decrease the stock from the product
    		$product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
    		$qty = (int) $product_data['quotation_qty'] - (int) $this->input->post('qty')[$x];

			if($kgs){
				$invKGS = (float) $product_data['quo_kgs'] - (float) $kgs;
				$update_product = array('quotation_qty' => $qty,'quo_kgs' => $invKGS);
			}
			if($sqm){
				$invSQM = (float) $product_data['quo_sqm'] - (float) $sqm;
				$update_product = array('quotation_qty' => $qty,'quo_sqm' => $invSQM);
			}
			if($sqf){
				$invSQF = (float) $product_data['quo_sqf'] - (float) $sqf;
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
			$delete = $this->db->delete('orders');

			$this->db->where('order_id', $id);
			$delete_item = $this->db->delete('orders_item');
			return ($delete == true && $delete_item) ? true : false;
		}
	}

	public function countTotalPaidOrders()
	{
		$sql = "SELECT * FROM orders WHERE paid_status = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}
	public function getTotalOrders($data)
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
		$sql = "SELECT orders.*,customer.*,orders.id as orderid FROM orders JOIN customer on customer.id = orders.customer_id WHERE orders.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getTotalOrdersCustom($data,$startDate,$endDate)
	{
		$sql = "SELECT orders.*,customer.*,orders.id as orderid FROM orders JOIN customer on customer.id = orders.customer_id WHERE orders.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getPrintInvoice($id)
	{
		$sql = "SELECT orders.*,customer.* FROM orders JOIN customer on customer.id = orders.customer_id WHERE orders.id = ?";
		$query = $this->db->query($sql,$id);
		return $query->result_array();
	}
	public function getAmountCash($data)
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
		$sql = "SELECT SUM(cash_amount) as paid_amount FROM orders  WHERE orders.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		// $sql = "SELECT invoice.*,customer.* FROM invoice JOIN customer on customer.id = invoice.customer_id WHERE invoice.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getAmountCashCustom($data,$startDate,$endDate)
	{
		$sql = "SELECT SUM(cash_amount) as paid_amount FROM orders  WHERE orders.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		// $sql = "SELECT invoice.*,customer.* FROM invoice JOIN customer on customer.id = invoice.customer_id WHERE invoice.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getAmountCheque($data)
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
		$sql = "SELECT SUM(cheque_amount) as paid_amount FROM orders  WHERE orders.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		// $sql = "SELECT invoice.*,customer.* FROM invoice JOIN customer on customer.id = invoice.customer_id WHERE invoice.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getAmountChequeCustom($data,$startDate,$endDate)
	{
		$sql = "SELECT SUM(cheque_amount) as paid_amount FROM orders  WHERE orders.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		// $sql = "SELECT invoice.*,customer.* FROM invoice JOIN customer on customer.id = invoice.customer_id WHERE invoice.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getAmountOnline($data)
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
		$sql = "SELECT SUM(online_amount) as paid_amount FROM orders  WHERE orders.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		// $sql = "SELECT invoice.*,customer.* FROM invoice JOIN customer on customer.id = invoice.customer_id WHERE invoice.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getAmountOnlineCustom($data,$startDate,$endDate)
	{
		$sql = "SELECT SUM(online_amount) as paid_amount FROM orders  WHERE orders.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		// $sql = "SELECT invoice.*,customer.* FROM invoice JOIN customer on customer.id = invoice.customer_id WHERE invoice.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getTotalAmt($data)
	{
		$startDate = date('Y').'-'.$data.'-01 00:00:00';
		
		$endDate = date('Y').'-'.$data.'-31 23:59:59';
		
		$fullline = strtotime($startDate).' AND '.strtotime($endDate);
		$sql = "SELECT SUM(net_amount) as net_amount FROM orders  WHERE orders.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		// $sql = "SELECT invoice.*,customer.* FROM invoice JOIN customer on customer.id = invoice.customer_id WHERE invoice.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function getPaidAmt($data)
	{
		$startDate = date('Y').'-'.$data.'-01 00:00:00';
		
		$endDate = date('Y').'-'.$data.'-31 23:59:59';
		
		$fullline = strtotime($startDate).' AND '.strtotime($endDate);
		$sql = "SELECT SUM(paid_amount) as paid_amount FROM orders  WHERE orders.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		// $sql = "SELECT invoice.*,customer.* FROM invoice JOIN customer on customer.id = invoice.customer_id WHERE invoice.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getLastOrder($data)
	{
		
		$sql = "SELECT * FROM orders WHERE orders.customer_id = ? ORDER BY `id` DESC limit 1";
		$query = $this->db->query($sql,$data);
		return $query->result_array();
	}
	
	public function getOrderCustData($data)
	{
		
		$sql = "SELECT * FROM orders WHERE orders.customer_id = ?";
		$query = $this->db->query($sql,$data);
		return $query->result_array();
	}
	public function getQuotationDetails($data)
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
		$sql = "SELECT orders.id FROM orders  WHERE orders.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getQuotationDetailsCustom($data,$startDate,$endDate)
	{
		$sql = "SELECT orders.id FROM orders  WHERE orders.date_time BETWEEN " .strtotime($startDate). " AND ".strtotime($endDate);
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function geQuotationItemDetails($data)
	{
		$this->db->select('orders_item.product_id,SUM(net_rate_amount) as net_rate_amount,SUM(qty) as qty,products.name as productname,products.product_type as producttype');
		$this->db->from('orders_item');
		$this->db->where_in('order_id', $data);
		$this->db->join('products','products.id = orders_item.product_id');
		$this->db->group_by('product_id'); 
		$query = $this->db->get();
		if(json_encode($query) == 'false'){
			return [];
		}else{
			return $query->result_array();
		}
	}

}