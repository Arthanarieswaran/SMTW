<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Vendor extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Vendor';

		$this->load->model('model_vendor');
		$this->load->model('model_users');
		$this->load->model('model_vendor_history');
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
		if(!in_array('viewVendor', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$this->render_template('vendor/index', $this->data);	
	}

	/*
	* It retrieve the specific store information via a store id
	* and returns the data in json format.
	*/
	public function fetchStoresDataById($id) 
	{
		if($id) {
			$data = $this->model_vendor->getStoresData($id);
			$dataHistory = $this->model_vendor_history->getHistoryData('DIRECT'.$id);
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

		$data = $this->model_vendor->getStoresData();

		foreach ($data as $key => $value) {
			$paid = $this->model_vendor_history->getCustomerSingleData($value['id']);
			$paidAmt = 0;
			$badges = '<span class="badge badge-pill badge-success float-right">Debit</span>';	
			if(count($paid) > 0){
				$total = round($paid[0]['net_amount'],2) + round($paid[0]['due_amount'],2);
				$paidAmt = round($total,2) - round($paid[0]['paid_amount'],2);
				$badges = '';
				if($paidAmt < 0){
					$paidAmt = '<span style="color:green">'.round($paidAmt,2).'</span>';
					$badges = '<span class="badge badge-pill badge-success float-right">Debit</span>';	
				}else if($paidAmt != 0){
					$paidAmt = '<span style="color:red">'.round($paidAmt,2).'</span>';
					$badges = '<span class="badge badge-pill badge-danger float-right">Credit</span>';
				}
			}
			
			// button
			$buttons = '';

			if(in_array('updateVendor', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-warning btn-sm" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
			}

			if(in_array('deleteVendor', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
			$address = '';
			if($value['address1']){
				$address = $value['address1'];
			}
			if($value['address2']){
				$address .= ','.$value['address2'];
			}
			$result['data'][$key] = array(
				$value['name'],
				$value['mobile'],
				$value['gst_no'],
				$paidAmt.' '.$badges,
				$address,
				$value['district'],
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
		if(!in_array('createVendor', $this->permission)) {
			redirect('dashboard', 'refresh');
		}

		$response = array();

		$this->form_validation->set_rules('vendor_name', 'Vendor name', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		
        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'name' => $this->input->post('vendor_name'),
				'mobile' => $this->input->post('mobile'),	
				'address1' => $this->input->post('address1'),
				'address2' => $this->input->post('address2'),	
				'taluk' => $this->input->post('taluk'),
				'district' => $this->input->post('district'),	
				'state' => $this->input->post('state'),
        		'gst_no' => $this->input->post('gst_no'),	
        	);
			
        	$create = $this->model_vendor->create($data);
			$customerData = array(
				'bill_no' => 'DIRECT'.$create,
				'vendor_id' => $create,
				'date_time' => strtotime(date('Y-m-d h:i:s a')),
				'vendor_bal' => $this->input->post('balance_amt'),
				'total_amount' => 0,
				'due_date' => null,
				'due_amount' => 0,
				'paid_amount' => 0,
			);
			$create = $this->model_vendor_history->create($customerData);
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
			$this->form_validation->set_rules('edit_vendor_name', 'Vendor name', 'trim|required');
		$this->form_validation->set_rules('edit_mobile', 'Mobile', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
					'name' => $this->input->post('edit_vendor_name'),
					'mobile' => $this->input->post('edit_mobile'),	
					'address1' => $this->input->post('edit_address1'),
					'address2' => $this->input->post('edit_address2'),	
					'taluk' => $this->input->post('edit_taluk'),
					'district' => $this->input->post('edit_district'),	
					'state' => $this->input->post('edit_state'),
					'gst_no' => $this->input->post('edit_gst_no'),	
				);

	        	$update = $this->model_vendor->update($data, $id);
				$customerData = array(
					'bill_no' => 'DIRECT'.$id,
					'vendor_id' => $id,
					'date_time' => strtotime(date('Y-m-d h:i:s a')),
					'vendor_bal' => $this->input->post('edit_balance_amt'),
					'total_amount' => 0,
					'due_date' => null,
					'due_amount' => 0,
					'paid_amount' => 0,
				);
				
				$this->model_vendor_history->updateHistory($customerData,'DIRECT'.$id);
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
			$delete = $this->model_vendor->remove($store_id);
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
    function getVendorDetailsSingle()
	{
		$id = $this->input->post('id');
		if($id) {
			$data = $this->model_vendor->getVendorSingleData($id);
			$dataHistory = $this->model_vendor_history->getCustomerSingleData($id);
			echo json_encode([$data,$dataHistory]);
		}
	}

}