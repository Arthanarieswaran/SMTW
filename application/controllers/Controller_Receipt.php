<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Receipt extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Customer';
		$this->load->model('model_customer_history');
        $this->load->model('model_receipt');
        $this->load->model('model_customer');
		$this->load->model('model_users');
		$this->load->helper('language'); 
		$userID = $this->session->userdata('id');
		$userData = $this->model_users->getSingleUser($userID);
		if(count($userData) > 0){
			$this->lang->load("content", $userData[0]['language']);
		}else{
			$this->lang->load("content", 'english');
		}
	}

	/* 
    * It only redirects to the manage stores page
    */
	public function index()
	{
		if(!in_array('viewCustomer', $this->permission)) {
			redirect('dashboard', 'refresh');
        }
        $this->data['customers'] = $this->model_customer->getActiveCustomerData(); 
        $this->data['page_title'] = 'Manage Receipts';
		$this->render_template('receipt/index', $this->data);	
	}

	/*
	* It retrieve the specific store information via a store id
	* and returns the data in json format.
	*/
	public function fetchStoresDataById($id) 
	{
		if($id) {
			$data = $this->model_receipt->getStoresData($id);
			$dataHistory = $this->model_customer_history->getHistoryData('RECEIPT'.$id);
			echo json_encode([$data,$dataHistory]);
		}
	}

	/*
	* It retrieves all the store data from the database 
	* This function is called from the datatable ajax function
	* The data is return based on the json format.
	*/
	public function fetchStoresData()
	{
		$result = array('data' => array());

		$data = $this->model_receipt->getStoresData();

		foreach ($data as $key => $value) {
		$customer = $this->model_customer->getCustomerDetails($value['customer_id']);
		$paid = $this->model_customer_history->getCustomerSingleData($value['customer_id']);
		$date = date('d-m-Y', $value['date']);
		$total = round((isset($paid) ?$paid[0]['net_amount'] : 0),2) + round((isset($paid) ? $paid[0]['due_amount'] : 0),2);
		$paid = round($total,2) - round((isset($paid) ? $paid[0]['paid_amount'] : 0),2);
		$badges = '';
		if($paid < 0){
			$paid = '<span style="color:green">'.round($paid,2).'</span>';

			$badges = '<span class="badge badge-pill badge-success float-right">Debit</span>';	
		}else if($paid != 0){
			$paid = '<span style="color:red">'.round($paid,2).'</span>';
			$badges = '<span class="badge badge-pill badge-danger float-right">Credit</span>';
		}
        
		$buttons = '<a target="__blank" href="'.base_url() .'Controller_Receipt/printDiv/'.$value['id'].'" class="btn btn-sm btn-info" ><i class="fa fa-print"></i></a>';
        if(in_array('updateCustomer', $this->permission)) {
            $buttons .= ' <button type="button" class="btn btn-warning btn-sm" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
        }

        if(in_array('deleteCustomer', $this->permission)) {
            $buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
        }
			$result['data'][$key] = array(
                ($key+1),
                $date,
				isset($customer) ? $customer[0]['name'] : null,
				isset($customer) ? $customer[0]['mobile'] : null,
				$value['amount'],
				$paid.' '.$badges,
				$value['description'],
				isset($value['payment_method']) ? $value['payment_method'] : null,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	/*
    * If the validation is not valid, then it provides the validation error on the json format
    * If the validation for each input is valid then it inserts the data into the database and 
    returns the appropriate message in the json format.
    */
	public function create()
	{
		if(!in_array('createCustomer', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('amount', 'Amount', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		$newDate = date("Y-m-d", strtotime($this->input->post('inv_date'))); 
        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'customer_id' => $this->input->post('customer_id'),
				'date' => strtotime($newDate. ' '.date('h:i:s a')),	
				'amount' => $this->input->post('amount'),
				'description' => $this->input->post('description'),
				'payment_method' => $this->input->post('payment_mode'),
        	);
			
			$create = $this->model_receipt->create($data);
			$customerData = array(
				'bill_no' => 'RECEIPT'.$create,
				'customer_id' => $this->input->post('customer_id'),
				'date_time' => strtotime($newDate. ' '.date('h:i:s a')),
				'paid_amount' => $this->input->post('amount'),
				'total_amount' => 0,
				'due_date' => null,
				'due_amount' => 0,
			);
			$create = $this->model_customer_history->create($customerData);
		
        	if($create) {
        		$response['success'] = true;
        		$response['messages'] = 'Succesfully created';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}	

	/*
    * If the validation is not valid, then it provides the validation error on the json format
    * If the validation for each input is valid then it updates the data into the database and 
    returns a n appropriate message in the json format.
    */
	public function update($id)
	{
		if(!in_array('updateStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();
       
		if($id) {
		$this->form_validation->set_rules('edit_amount', 'Amount', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
			$newDate1 = date("Y-m-d", strtotime($this->input->post('edit_inv_date'))); 
			
	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
					'customer_id' => $this->input->post('edit_customer_id'),
                    'amount' => $this->input->post('edit_amount'),
					'date' => strtotime($newDate1. ' '.date('h:i:s a')),	
                    'update_date' => strtotime($newDate1. ' '.date('h:i:s a')),
					'description' => $this->input->post('edit_description'),
					'payment_method' => $this->input->post('edit_payment_mode'),
                );
				$update = $this->model_receipt->update($data, $id);
				$customerData = array(
					'bill_no' => 'RECEIPT'.$id,
					'customer_id' => $this->input->post('edit_customer_id'),
					'date_time' => strtotime($newDate1. ' '.date('h:i:s a')),
					'paid_amount' => $this->input->post('edit_amount'),
					'total_amount' => 0,
					'due_date' => null,
					'due_amount' => 0,
				);
				
				$this->model_customer_history->updateHistory($customerData,'RECEIPT'.$id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated the brand information';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	/*
	* If checks if the store id is provided on the function, if not then an appropriate message 
	is return on the json format
    * If the validation is valid then it removes the data into the database and returns an appropriate 
    message in the json format.
    */
	public function remove()
	{
		if(!in_array('deleteStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}
		
		$store_id = $this->input->post('store_id');
       
        $response = array();
       
		if($store_id) {
            $delete = $this->model_receipt->remove($store_id);
            $delete = $this->model_customer_history->remove('RECEIPT'.$store_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Successfully removed";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}
    function getCustomerDetailsSingle()
	{
		$id = $this->input->post('id');
		if($id) {
			$data = $this->model_customer_history->getCustomerSingleData($id);
			echo json_encode($data);
		}
	}

	public function printDiv($id)
	{        
			if($id) {
				$order_datas = $this->model_receipt->getPrintReceipt($id);
				$order_data = $order_datas[0];
				$customerData= $this->model_customer_history->getCustomerSingleData($order_data['customer_id']);
				
				$order_date = date('d/m/Y', $order_data['date']);
				$paid = $this->model_customer_history->getCustomerSingleData($order_data['customer_id']);
				$total = round($paid[0]['net_amount'],2) + round($paid[0]['due_amount'],2);
				$paid = round($total,2) - round($paid[0]['paid_amount'],2);
				$badges = '';
				if($paid < 0){
					$badges = 'Depit';	
				}else if($paid != 0){
					$badges = 'Credit';
				}
				// $imageUrl = '.base_url./assets/images/murugan.png';
				$html = '<!-- Main content -->
				<!DOCTYPE html>
		<html>
		<head>
		  <meta charset="utf-8">
		  <meta http-equiv="X-UA-Compatible" content="IE=edge">
		  <title>Quotation</title>
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
			.pageFooter {
				display: block;
			  position: fixed;	
			  bottom: 0;
			  left: 0;
			}
		  }
			</style>
		<body onload="window.print();">
		<div >
		<table >
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
			<table class="table table-striped table-bordered print-content">
			  <thead>
			  <tr>
			  <div class="row invoice-info">
					  
			  <div class="col-md-6 invoice-col">
			  <b>Invoice No &nbsp;&nbsp;&nbsp;&nbsp;:</b>  <b >'.$order_data['id'].'</b><br>
			  </div>
			  <div class="col-md-6 invoice-col" style="text-align:center;">
				  <b> RECEIPT<b>
			  </div>
			  <div class="col-md-6 invoice-col" style="text-align:right;">
				  
				<b> Date :</b> <b >'.$order_date.'</b><br>
			  </div>
			  <!-- /.col -->
			</div>
			<hr style="padding:0px;margin:0px;">
			  <div class="row invoice-info">
				
				<div class="col-md-12 invoice-col" style="100% !important;">
				<b>Billing Address</b><br>
				&nbsp;&nbsp;&nbsp;&nbsp;'.$order_data['name'].'<br>
				&nbsp;&nbsp;&nbsp;&nbsp; '.$order_data['mobile'].'<br>
				</div>
				<!-- /.col -->
			  </div>
			  </tr>
			  <tr>
				<th rowspan="2" style="padding: 0 6px 0 6px">S.No</th>
				<th rowspan="2" style="padding: 0 6px 0 6px">Description</th>
				<th rowspan="2" style="padding: 0 6px 0 6px">Amount</th>
			  </tr>
			  </thead>
			  <thead>
			</thead>
			  <tbody>
				  <td style="padding: 0 6px 0 6px">1</td>
					<td style="padding: 0 6px 0 6px">'.$order_data['description'].'</td>
					<td style="padding: 0 6px 0 6px">'.number_format($order_data['amount'], 2, '.', '').'</td>
				  </tr>
			  <tr>
			  <td colspan="2" style="padding: 0 6px 0 6px">
			  <div style="float:left;">
			  
			  <b>Total Balance :</b>&nbsp;&nbsp;&nbsp;&nbsp;' .number_format($paid, 2, '.', '').'<br>
			  <b>Status :</b>&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' .$badges.'<br>
			  </div>
			  <div style="float:right;">
			  <b>Total</b>
			  </td>
				<td style="padding: 0 6px 0 6px">'.number_format($order_data['amount'], 2, '.', '').'</td>
			  </tr>
			  <tr>
			  <tr>
			  <td colspan="3" style="padding: 0 6px 0 6px;text-transform: uppercase;">';
				 
				$number = number_format($order_data['amount'], 2, '.', '');
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

</div>
<br/>
<div class="col-md-12" style="margin-left : 45em;">
<p>Sign</p>	
</div>

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
}