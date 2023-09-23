<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Customer extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Customer';
		$this->load->model('model_customer_history');
		$this->load->model('model_customer');
		$this->load->model('model_orders');
		$this->load->model('model_invoice');
		$this->load->model('model_users');
		$this->load->model('model_receipt');
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

		$this->render_template('customer/index', $this->data);	
	}

	/*
	* It retrieve the specific store information via a store id
	* and returns the data in json format.
	*/
	public function fetchStoresDataById($id) 
	{
		if($id) {
			$data = $this->model_customer->getStoresData($id);
			$dataHistory = $this->model_customer_history->getHistoryData('DIRECT'.$id);
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

		$data = $this->model_customer->getStoresData();

		foreach ($data as $key => $value) {
		$paid = $this->model_customer_history->getCustomerSingleData($value['id']);
		$lastOrder = $this->model_orders->getLastOrder($value['id']);
		$lastDate = '-';
		$diff= 0;
		if(count($lastOrder) > 0){
			if($lastOrder[0]['due_date']){
				$startTimeStamp = strtotime(date('Y-m-d'));
				$endTimeStamp = strtotime($lastOrder[0]['due_date']);
				$timeDiff = ($endTimeStamp - $startTimeStamp);
				$numberDays = $timeDiff/86400; 
				$diff = intval($numberDays); 
				$lastDate = $lastOrder[0]['due_date'];
			}
		}
		$total = round($paid[0]['net_amount'],2) + round($paid[0]['due_amount'],2);
		$paid = round($total,2) - round($paid[0]['paid_amount'],2);
		$badges = '';
		if($paid < 0){
			$paid = '<span style="color:green">'.round($paid,2).'</span>';

			$badges = '<span class="badge badge-pill badge-success float-right">Debit</span>';	
		}else if($paid != 0){
			$paid = '<span style="color:red">'.round($paid,2).'</span>';
			$badges = '<span class="badge badge-pill badge-danger float-right">Credit</span>';
		}
			// button
			$buttons = '';

			if(in_array('updateCustomer', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-warning btn-sm" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteCustomer', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
			$viewpath = base_url('Controller_Customer/view/'.$value['id']);
			$buttons .= '<a href="'.$viewpath.'"> <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button></a>';
			
			$address = '';
			if($value['address1']){
				$address = $value['address1'];
			}
			if($value['address2']){
				$address .= ','.$value['address2'];
			}
			$daysColor = '';
			if($diff < 0){
				$daysColor = '<span class="badge badge-pill badge-danger float-right" style="font-size: 14px;font-weight: bold;background-color: red;">'.$diff.'</span>';
			}else if($diff > 0 && $diff < 10){
				$daysColor = '<span class="badge badge-pill badge-warning float-right" style="font-size: 14px;font-weight: bold;background-color: blue;">'.$diff.'</span>';
			}else{
				$daysColor = '<span class="badge badge-pill badge-succedd float-right" style="font-size: 14px;font-weight: bold;background-color: green;color:white;">'.$diff.'</span>';
			}
			
			$result['data'][$key] = array(
				($key+1),
				$value['name'],
				$value['mobile'],
				$value['gst_no'],
				$paid.' '.$badges,
				$lastDate,
				$daysColor,
				$address.','.$value['taluk'].','.$value['district'],
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

		$this->form_validation->set_rules('customer_name', 'Customer name', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		
        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('customer_name'),
				'mobile' => $this->input->post('mobile'),	
				'address1' => $this->input->post('address1'),
				'address2' => $this->input->post('address2'),	
				'taluk' => $this->input->post('taluk'),
				'district' => $this->input->post('district'),	
				'state' => 'Tamilnadu',
				'gst_no' => $this->input->post('gst_no'),
				'pincode' => $this->input->post('pincode'),	
        	);
			
			$create = $this->model_customer->create($data);
			$customerData = array(
				'bill_no' => 'DIRECT'.$create,
				'customer_id' => $create,
				'date_time' => strtotime(date('Y-m-d h:i:s a')),
				'cust_bal' => $this->input->post('balance_amt'),
				'total_amount' => 0,
				'due_date' => null,
				'due_amount' => 0,
				'paid_amount' => 0,
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

	public function invoice()
	{
		if(!in_array('createCustomer', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('customer_name', 'Customer name', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		
        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('customer_name'),
				'mobile' => $this->input->post('mobile'),	
				'address1' => $this->input->post('address1'),
				'address2' => $this->input->post('address2'),	
				'taluk' => $this->input->post('taluk'),
				'district' => $this->input->post('district'),	
				'state' => 'Tamilnadu',
				'gst_no' => $this->input->post('gst_no'),
				'pincode' => $this->input->post('pincode'),	
        	);
			
			$create = $this->model_customer->create($data);
			$customerData = array(
				'bill_no' => 'DIRECT'.$create,
				'customer_id' => $create,
				'date_time' => strtotime(date('Y-m-d h:i:s a')),
				'cust_bal' => $this->input->post('balance_amt'),
				'total_amount' => 0,
				'due_date' => null,
				'paid_amount' => 0,
				'due_amount' => 0,
			);
			$create = $this->model_customer_history->create($customerData);
        	if($create == true) {
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

        redirect('Controller_Invoice/create', 'refresh');
	}	

	public function quotation()
	{
		if(!in_array('createCustomer', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('customer_name', 'Customer name', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		
        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('customer_name'),
				'mobile' => $this->input->post('mobile'),	
				'address1' => $this->input->post('address1'),
				'address2' => $this->input->post('address2'),	
				'taluk' => $this->input->post('taluk'),
				'district' => $this->input->post('district'),	
				'state' => 'Tamilnadu',
				'gst_no' => $this->input->post('gst_no'),
				'pincode' => $this->input->post('pincode'),	
        	);
			
			$create = $this->model_customer->create($data);
			$customerData = array(
				'bill_no' => 'DIRECT'.$create,
				'customer_id' => $create,
				'date_time' => strtotime(date('Y-m-d h:i:s a')),
				'cust_bal' => $this->input->post('balance_amt'),
				'total_amount' => 0,
				'due_date' => null,
				'due_amount' => 0,
				'paid_amount' => 0,
			);
			$create = $this->model_customer_history->create($customerData);
        	if($create == true) {
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

        redirect('Controller_Orders/create', 'refresh');
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
			$this->form_validation->set_rules('edit_customer_name', 'Customer name', 'trim|required');
		$this->form_validation->set_rules('edit_mobile', 'Mobile', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
					'name' => $this->input->post('edit_customer_name'),
					'mobile' => $this->input->post('edit_mobile'),	
					'address1' => $this->input->post('edit_address1'),
					'address2' => $this->input->post('edit_address2'),	
					'taluk' => $this->input->post('edit_taluk'),
					'district' => $this->input->post('edit_district'),	
					'state' => 'Tamilnadu',
					'gst_no' => $this->input->post('edit_gst_no'),	
					'pincode' => $this->input->post('pincode'),	
				);

				$update = $this->model_customer->update($data, $id);
				$customerData = array(
					'bill_no' => 'DIRECT'.$id,
					'customer_id' => $id,
					'date_time' => strtotime(date('Y-m-d h:i:s a')),
					'cust_bal' => $this->input->post('edit_balance_amt'),
					'total_amount' => 0,
					'due_date' => null,
					'due_amount' => 0,
					'paid_amount' => 0,
				);
				
				$this->model_customer_history->updateHistory($customerData,'DIRECT'.$id);
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
			$customerData = array(
				'active' => 0,
			);
			$delete = $this->model_customer->remove($store_id,$customerData);
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

	function mobileduplicate()
	{
		$id = $this->input->post('mobile');
			$data = $this->model_customer->mobileduplicate($id);
			echo json_encode($data);
		
	}

	public function view($id)
	{
		if(!in_array('updateStore', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		if($id) {
			$this->data['view'] = $this->model_customer->getStoresData($id);
			$this->data['quo'] = $this->model_orders->getOrderCustData($id);
			$this->data['inv'] = $this->model_invoice->getInvoiceCustData($id);
			$this->data['receipt'] = $this->model_receipt->getReceiptData($id);
    		$this->data['messages'] = 'Success';
			$this->render_template('customerview', $this->data);
		}
	}

}