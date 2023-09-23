<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Invoice extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Invoice';

		$this->load->model('model_invoice');
		$this->load->model('model_products');
		$this->load->model('model_company');
		$this->load->model('model_customer_history');
		$this->load->model('model_customer');
		$this->load->model('model_users');
		$this->load->helper('language'); 
		$this->load->library('Pdf');
		$userID = $this->session->userdata('id');
		$userData = $this->model_users->getSingleUser($userID);
		if(count($userData) > 0){
			$this->lang->load("content", $userData[0]['language']);
		}else{
			$this->lang->load("content", 'english');
		}
	}

	/* 
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewInvoice', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Invoice';
		$this->render_template('invoice/index', $this->data);		
	}

	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchOrdersData()
	{
		$result = array('data' => array());

		$data = $this->model_invoice->getOrdersData();

		foreach ($data as $key => $value) {

			$count_total_item = $this->model_invoice->countOrderItem($value['id']);
			$data = "";
			$time = "";
			if($value['update_date']){
				$date = date('d-m-Y', $value['update_date']);
				$time = date('h:i a', $value['update_date']);
			}else{
				$date = date('d-m-Y', $value['date_time']);
				$time = date('h:i a', $value['date_time']);
			}
			

			$date_time = $date . ' ' . $time;

			// button
			$buttons = '';

			if(in_array('viewInvoice', $this->permission)) {
				$buttons .= '<a target="__blank" href="'.base_url('Controller_Invoice/printDiv/'.$value['id']).'" class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>';
			}

			if(in_array('updateInvoice', $this->permission)) {
				$buttons .= ' <a href="'.base_url('Controller_Invoice/update/'.$value['id']).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deleteInvoice', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}

			if($value['paid_status'] == 1) {
				$paid_status = '<span class="label label-success">Paid</span>';	
			}
			else {
				$paid_status = '<span class="label label-warning">Not Paid</span>';
			}

			$customer = $this->model_customer->getCustomerDetails($value['customer_id']);
			
			$result['data'][$key] = array(
				$value['bill_no'],
				$customer[0]['name'],
				$customer[0]['mobile'],
				$date_time,
				$count_total_item,
				$value['net_amount'],
				// $paid_status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
	* If the validation is not valid, then it redirects to the create page.
	* If the validation for each input field is valid then it inserts the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function create()
	{
		if(!in_array('createInvoice', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Invoice';

		$this->form_validation->set_rules('paid_amount', 'Paid amount', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$order_id = $this->model_invoice->create();
        	
        	if($order_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('Controller_Invoice/update/'.$order_id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Controller_Invoice/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	
			$this->data['customers'] = $this->model_customer->getActiveCustomerData();
            $this->render_template('invoice/create', $this->data);
        }	
	}

	/*
	* It gets the product id passed from the ajax method.
	* It checks retrieves the particular product data from the product id 
	* and return the data into the json format.
	*/
	public function getProductValueById()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_products->getProductData($product_id);
			echo json_encode($product_data);
		}
	}

	public function getProductQtyId()
	{
		$product_id = $this->input->post('product_id');
		if($product_id) {
			$product_data = $this->model_products->getProductData($product_id);
			echo json_encode($product_data);
		}
	}

	/*
	* It gets the all the active product inforamtion from the product table 
	* This function is used in the order page, for the product selection in the table
	* The response is return on the json format.
	*/
	public function getTableProductRow()
	{
		$products = $this->model_products->getActiveProductData();
		echo json_encode($products);
	}

	/*
	* If the validation is not valid, then it redirects to the edit orders page 
	* If the validation is successfully then it updates the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function update($id)
	{
		if(!in_array('updateInvoice', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Invoice';

		$this->form_validation->set_rules('paid_amount', 'Paid amount', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_invoice->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
        		redirect('Controller_Invoice/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Controller_Invoice/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$orders_data = $this->model_invoice->getOrdersData($id);

    		$result['order'] = $orders_data;
    		$orders_item = $this->model_invoice->getOrdersItemData($orders_data['id']);

    		foreach($orders_item as $k => $v) {
    			$result['order_item'][] = $v;
    		}

    		$this->data['order_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	
			$this->data['customers'] = $this->model_customer->getActiveCustomerData(); 
            $this->render_template('invoice/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deleteInvoice', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$order_id = $this->input->post('order_id');

        $response = array();
        if($order_id) {
            
			$orderdata = $this->model_invoice->getOrdersData($order_id);
			$deletes = $this->model_customer_history->remove($orderdata['bill_no']);
			$delete = $this->model_invoice->remove($order_id);
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Successfully removed"; 
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Refersh the page again!!";
        }

        echo json_encode($response); 
	}

	/*
	* It gets the product id and fetch the order data. 
	* The order print logic is done here 
	*/
	public function printDiv($id)
	{
		if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        
		if($id) {
			$order_datas = $this->model_invoice->getPrintInvoice($id);
			$order_data = $order_datas[0];
			$orders_items = $this->model_invoice->getOrdersItemData($id);
			$customerData= $this->model_customer_history->getCustomerSingleData($order_data['customer_id']);
			$company_info = $this->model_company->getCompanyData(1);

			$order_date = date('d/m/Y', $order_data['date_time']);
			$paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";
            // $imageUrl = '.base_url./assets/images/murugan.png';
			$html = '<!-- Main content -->
			<!DOCTYPE html>
			<html>
			<head>
			  <meta charset="utf-8">
			  <meta http-equiv="X-UA-Compatible" content="IE=edge">
			  <title>Invoice</title>
			  <!-- Tell the browser to be responsive to screen width -->
			  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			  <!-- Bootstrap 3.3.7 -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
			  <!-- Font Awesome -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
			  <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
			</head>
			<style>
			table {
				width: 100%;
			  }
			  
			  table.print-content {
				font-size: 12px;
				border: 1px solid #dee2e6;
				border-collapse: collapse !important;
			  }
			  
			  table.print-content th,
			  table.print-content td {
				padding: .2rem .4rem;
				text-align: left;
				vertical-align: top;
				border-top: 1px solid #dee2e6;
			  }
			  
			  @media print {
				tfooter {
				  position: fixed;	
				  bottom: 0;
				  left: 0;
				  overflow: visible;
				}
			  }
			 
				</style>
			<body onload="window.print();">
			
			<table>
<!-- Start Header -->
<thead>
<tr>
  <td>
  <img src="'.base_url('assets/images/invoicehead.jpg').'">
  </td>
</tr>
</thead>
<!-- End Header -->
<tr>
<td>
				<table class="table table-striped table-bordered print-content" style="min-height : 360px !important;">
				  <thead>
				  <tr>
				  <div class="row invoice-info">
			  
			<div class="col-md-6 invoice-col">
			  <b>GST IN &nbsp;&nbsp;:&nbsp;</b> 33CDVPK9157Q1ZE<br>
			  
			  
			</div>
			<div class="col-md-6 invoice-col" style="text-align:center;">
				<b> TAX INVOICE<b><br><span>State : Tamilnadu</span>
			</div>
			<div class="col-md-6 invoice-col" style="text-align:right !important;">
				<b>Invoice No &nbsp;&nbsp;&nbsp;&nbsp;:</b>  <b >'.$order_data['bill_no'].'</b><br>
			  <b> Date :</b> <b >'.$order_date.'</b><br>
			 
			</div>
			<!-- /.col -->
		  </div>
		  <hr style="padding:0px;margin:0px;">
		  <div class="row invoice-info">
				
		  <div class="col-md-12 invoice-col" style="100% !important;">
		  <b>Billing Address</b><br>
		  &nbsp;&nbsp;&nbsp;&nbsp;'.$order_data['name'].'<br>
		  &nbsp;&nbsp;&nbsp;&nbsp;'.$order_data['address1'].','.$order_data['district'].' <br />
		  &nbsp;&nbsp;&nbsp;&nbsp; '.$order_data['mobile'].'<br>
		  </div>
		  <!-- /.col -->
		</div>
		</tr>
		<tr>
		<th rowspan="2" style="padding: 0 6px 0 6px">S.No</th>
		<th rowspan="2" style="padding: 0 6px 0 6px">Name of Product</th>
		<th rowspan="2" style="padding: 0 6px 0 6px">HSN</th>
		<th rowspan="2" style="padding: 0 6px 0 6px">Qty</th>
		<th rowspan="2" style="padding: 0 6px 0 6px">Net Rate</th>
		<th rowspan="2" style="padding: 0 6px 0 6px">Rate</th>
		<th rowspan="2" style="padding: 0 6px 0 6px">Per</th>
		<th rowspan="2" style="padding: 0 6px 0 6px">Amount</th>
		</tr>
		</thead>
		<thead>
	  </thead>
		<tbody>
		'; 
		
		$quantity = 0;
		$cgsttl = 0;
		$sgsttl = 0;
		$granttl = 0;
		$ttl = 0;
		$ttlNet = 0;
		$ptotal = 0;
		$discounttl = 0;
		$kgsTl = 0;
		$gstRates = '';
		$gstDatas = '';
		$extratl = 0;
		if($order_data['discount']){
			$discounttl = $order_data['discount'];
		}
		if($order_data['extra_amount']){
			$extratl = $order_data['extra_amount'];
		}
	  foreach ($orders_items as $k => $v) {

		  $product_data = $this->model_products->getProductData($v['product_id']); 
		  $quantity = ($quantity + $v['qty']);
			$totalAmt = $v['qty'] * $v['rate'];
			$totalNetAmt = $v['qty'] * $v['net_rate'];
			$ttl = ($ttl + ($totalAmt));
			$ttlNet = ($ttlNet + ($totalNetAmt));
			
		
			$sqData = '';
			$normalData = '';
			$areaSm = '';
			$areaStatus = '';
			if($order_data['gst'] == 0){
				$amount = number_format($v['net_rate_amount'], 2, '.', '');
				$ptotal = ($ptotal + $v['net_rate_amount']);
				$granttl = ($granttl + $v['net_rate_amount']);
			}else {
				$amount = number_format($v['amount'], 2, '.', '');
				$ptotal = ($ptotal + $v['amount']);
				
				$granttl = ($granttl + $v['net_rate_amount']);
				$gstRate =  ($granttl - $ptotal)/2;
				$gstRates = number_format($gstRate,'2').'<br>'.number_format($gstRate,'2').'</b><br>';
				$gstDatas = '<b>SGST</b><br><b>CGST</b><br>';
			}
			if($v['product_type'] == 'SquareMeter'){
				$totalSq = ($v['square_bit_1']*$v['square_bit_2']);
				$totalSm = $totalSq * 0.305;
				$areaSm = number_format(($totalSm  * $v['qty']), 3, '.', '');
				$areaStatus = 'Sqmts';
				$sqData = '<div class="row" style="display:flex;">
				<div class="col-md-2">
				Width<br>'.$v['square_bit_1'].'
				</div>
				<div class="col-md-2">
				Feet<br>'.$v['square_bit_2'].'
				</div>
				<div class="col-md-3">
				Mtr<br>'.number_format($totalSm, 3, '.', '').'
				</div>
				<div class="col-md-2">
				Qty<br>'.$v['qty'].'
				</div>
				<div class="col-md-3">
				Area<br>'.$areaSm.'
				</div>
				</div>';
				// $sqData = 'Sq.Feet '.$v['square_bit_1'].' * '.$v['square_bit_2'].' = '.number_format($totalSq, 3, '.', '').' Sq';
			}else if($v['product_type'] == 'SquareFeet'){
				$totalSq = ($v['square_bit_1']*$v['square_bit_2']);
				
				$areaSq = ($totalSq * $v['qty']);
				$areaSm = number_format(($totalSq * $v['qty']),'3');
				$areaStatus = 'Sqfts';
				$normalData = '&nbsp;&nbsp;&nbsp; (Feet : '.number_format($totalSq, 3, '.', '').'&nbsp;&nbsp;&nbsp; Qty : '.$v['qty'].')';
				// $sqData = 'Sq.Feet '.$v['square_bit_1'].' * '.$v['square_bit_2'].' = '.number_format($totalSq, 3, '.', '').' Sq';
			}else if($v['product_type'] == 'Kgs'){
				$areaSm = number_format($v['kgs'],'3');
				$areaStatus = 'kgs';
				$kgsTl = $kgsTl + $v['kgs'];
				$normalData = '&nbsp;&nbsp;&nbsp; (Qty : '.$v['qty'].')';
				// $sqData = 'Sq.Feet '.$v['square_bit_1'].' * '.$v['square_bit_2'].' = '.number_format($totalSq, 3, '.', '').' Sq';
			} else if($v['product_type'] == 'Piece'){
				$areaSm = $v['qty'];
				$areaStatus = 'pcs';
				$normalData = '&nbsp;&nbsp;&nbsp; (Qty : '.$v['qty'].')';
				// $sqData = 'Sq.Feet '.$v['square_bit_1'].' * '.$v['square_bit_2'].' = '.number_format($totalSq, 3, '.', '').' Sq';
			}
			$hsnCode = '-';
			if($product_data['hsn'])
			{
				$hsnCode =  $product_data['hsn'];
			}
		  $html .= '<tr>
		  <td style="padding: 0 6px 0 6px">'.($k+1).'</td>
			<td style="padding: 0 6px 0 6px"><b>'.$product_data['name'].'</b><span>'.$normalData.'</span><br>'.$sqData.'</td>
			<td style="padding: 0 6px 0 6px">'.$hsnCode.'</td>
			<td style="padding: 0 6px 0 6px">'.$areaSm .' '.$areaStatus.'</td>
			<td style="padding: 0 6px 0 6px">'.number_format($v['net_rate'], 2, '.', '').'</td>
			<td style="padding: 0 6px 0 6px">'.number_format($v['rate'], 2, '.', '').'</td>
			<td style="padding: 0 6px 0 6px">'.$areaStatus.'</td>
			<td style="padding: 0 6px 0 6px">'.$amount.'</td>
		  </tr>';
	  }
	  $roundOff = round($granttl-$discounttl + $extratl);
	  $normalValue = $granttl-$discounttl + $extratl;
	  $extraValue = $roundOff - $normalValue;
	  $balanceAmt = (($customerData[0]['net_amount'] + $customerData[0]['due_amount']) - $customerData[0]['paid_amount']);
	  $status = 'Normal';
	  if($balanceAmt < 0){
		$status = 'Debit';
	  }else if($balanceAmt > 0){
		$status = 'Credit';
	  }
	  $html .= '
	  <tr>
	  <td colspan="3" style="padding: 0 6px 0 6px">Sub Total</td>
		<td style="padding: 0 6px 0 6px">'.$kgsTl.' kgs</td>
		<td style="padding: 0 6px 0 6px"></td>
		<td style="padding: 0 6px 0 6px"></td>
		<td style="padding: 0 6px 0 6px"></td>
		<td style="padding: 0 6px 0 6px">'.number_format($ptotal, 2, '.', '').'</td>
	  </tr>
	  <tr>
	  <td colspan="7" style="padding: 0 6px 0 6px">
	  <div style="float:left;">
	  <b>Paid Amount &nbsp;:</b>&nbsp;&nbsp;&nbsp;&nbsp;' .number_format($order_data['paid_amount'], 2, '.', '').'<br>
	  <b>Total Balance :</b>&nbsp;&nbsp;&nbsp;&nbsp;' .number_format($balanceAmt, 2, '.', '').'<br>
	  <b>Status :</b>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .$status.'<br>
	  </div>
	  <div style="float:right;">
	  '.$gstDatas.'
			  <b>Discount</b><br>
			  <b>Extra Charge</b><br>
			  
			  <b>Round Off </b> 
	  
	  </div>
	 
	  </td>
		
	  <td style="padding: 0 6px 0 6px">'.$gstRates.''.number_format($discounttl, 2, '.', '').'<br>
	  '. number_format($extratl, 2, '.', '').'<br>
	  
	  '.number_format(($extraValue), 2, '.', '').' </td>
	  </tr>
	  <tr>
	  <td colspan="7" style="padding: 0 6px 0 6px"><div style="float:right;">Grand Total</div></td>
		<td style="padding: 0 6px 0 6px">'.number_format(($roundOff), 2, '.', '').'</td>
	  </tr>
	  <tr>
	  <td colspan="8" style="padding: 0 6px 0 6px;text-transform: uppercase;">';
					 
					$number = number_format(($roundOff), 2, '.', '');
					   $no = floor($number);
					   $point = round($number - $no, 2) * 100;
					   $hundred = null;
					   $digits_1 = strlen($no);
					   $i = 0;
					   $str = array();
					   $words = array('0' => '', '1' => 'one', '2' => 'two',
						'3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
						'7' => 'seven', '8' => 'eight', '9' => 'nine',
						'10' => 'ten', '11' => 'eleven', '12' => 'twelve',
						'13' => 'thirteen', '14' => 'fourteen',
						'15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
						'18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
						'30' => 'thirty', '40' => 'forty', '50' => 'fifty',
						'60' => 'sixty', '70' => 'seventy',
						'80' => 'eighty', '90' => 'ninety');
					   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
					   while ($i < $digits_1) {
						 $divider = ($i == 2) ? 10 : 100;
						 $number = floor($no % $divider);
						 $no = floor($no / $divider);
						 $i += ($divider == 10) ? 1 : 2;
						 if ($number) {
							$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
							$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
							$str [] = ($number < 21) ? $words[$number] .
								" " . $digits[$counter] . $plural . " " . $hundred
								:
								$words[floor($number / 10) * 10]
								. " " . $words[$number % 10] . " "
								. $digits[$counter] . $plural . " " . $hundred;
						 } else $str[] = null;
					  }
					  $str = array_reverse($str);
					  $result = implode('', $str);
					  $points = ($point) ?
						"." . $words[$point / 10] . " " . 
							  $words[$point = $point % 10] : '';
					  
					
					 $html .= 'Rupees  : '.$result .'</td>
				  </tr>
				  <tr>
				  </tr>
				  </tbody>

				 
				 
				</table>
</td>
</tr>

</table>

<tfooter>
<th colspan="3"><img src="'.base_url('assets/images/Footer_SMT1.png.jpg').'"> </th>
<tfooter>
		</body>
		<script>
	window.onafterprint = function(event) {
		window.close();
	};
	</script>
	</html>';

			  echo $html;
			 
		}
	}

	function mobileduplicate()
	{
		$id = $this->input->post('mobile');
			$data = $this->model_customer->mobileduplicate($id);
			echo json_encode($data);
		
	}

}