<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Purchase extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Purchase';

		$this->load->model('model_purchase');
		$this->load->model('model_inpurchase');
		$this->load->model('model_products');
		$this->load->model('model_company');
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
	* It only redirects to the manage order page
	*/
	public function index()
	{
		if(!in_array('viewPurchase', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Purchase';
		$this->render_template('purchase/index', $this->data);		
	}

	/*
	* Fetches the orders data from the orders table 
	* this function is called from the datatable ajax function
	*/
	public function fetchPurchasesData()
	{
		$result = array('data' => array());

		$data = $this->model_purchase->getPurchaseData();

		foreach ($data as $key => $value) {

			// $count_total_item = $this->model_purchase->countPurchaseItem($value['id']);
			
			// button
			$buttons = '';

			

			if(in_array('updatePurchase', $this->permission)) {
				$buttons .= ' <a href="'.base_url('Controller_Purchase/update/'.$value['id']).'" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>';
			}

			if(in_array('deletePurchase', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			}
			if(in_array('updateOrder', $this->permission)) {
				$buttons .= ' <a href="'.base_url('Controller_Purchase/inpurchase/'.$value['id']).'" class="btn btn-primary btn-sm"><i class="fa fa-exchange"></i></a>';
			}

			$vendor = $this->model_vendor->getVendorDetails($value['vendor_id']);
			
			$result['data'][$key] = array(
				$value['bill_no'],
				$value['invoice_date'],
				$vendor[0]['name'],
				$vendor[0]['mobile'],
// '				$count_total_items',
				$value['net_amount'],
				// $paid_status,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}
	public function inpurchase($id)
	{
		if(!in_array('updateOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->data['page_title'] = 'Add Invoice';

		$this->form_validation->set_rules('paid_amount', 'Paid amount', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$purchase_id = $this->model_inpurchase->create();
        	
        	$this->data['page_title'] = 'Manage Invoice';
			$this->render_template('inpurchase/index', $this->data);
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$purchase_data = $this->model_purchase->getPurchaseData($id);

    		$result['purchase'] = $purchase_data;
    		$purchase_item = $this->model_purchase->getPurchaseItemData($purchase_data['id']);

    		foreach($purchase_item as $k => $v) {
    			$result['purchase_item'][] = $v;
    		}

			$this->data['purchase_data'] = $result;
			$this->data['vendors'] = $this->model_vendor->getActiveVendorData(); 
        	$this->data['products'] = $this->model_products->getActiveProductData(); 
			
			$this->data['singlevendor'] = $this->model_vendor->getVendorSingleData($purchase_data['vendor_id']);     	

            $this->render_template('purchase/inpurchase', $this->data);
        }
	}

	/*
	* If the validation is not valid, then it redirects to the create page.
	* If the validation for each input field is valid then it inserts the data into the database 
	* and it stores the operation message into the session flashdata and display on the manage group page
	*/
	public function create()
	{
		if(!in_array('createPurchase', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Add Purchase';

		$this->form_validation->set_rules('net_amount_value', 'Net amount', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$order_id = $this->model_purchase->create();
        	
        	if($order_id) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('Controller_Purchase/create/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Controller_Purchase/create/', 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	
			$this->data['vendors'] = $this->model_vendor->getActiveVendorData();
            $this->render_template('purchase/create', $this->data);
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
		if(!in_array('updatePurchase', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if(!$id) {
			redirect('dashboard', 'refresh');
		}

		$this->data['page_title'] = 'Update Purchase';

		$this->form_validation->set_rules('net_amount_value', 'Net amount', 'trim|required');
		
	
        if ($this->form_validation->run() == TRUE) {        	
        	
        	$update = $this->model_purchase->update($id);
        	
        	if($update == true) {
        		$this->session->set_flashdata('success', 'Successfully updated');
				// redirect('Controller_Purchase', 'refresh');
				redirect('Controller_Purchase/update/'.$id, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Controller_Purchase/update/'.$id, 'refresh');
        	}
        }
        else {
            // false case
        	$company = $this->model_company->getCompanyData(1);
        	$this->data['company_data'] = $company;
        	$this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
        	$this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

        	$result = array();
        	$orders_data = $this->model_purchase->getPurchaseData($id);

    		$result['order'] = $orders_data;
    		$orders_item = $this->model_purchase->getPurchaseItemData($orders_data['id']);

    		foreach($orders_item as $k => $v) {
    			$result['order_item'][] = $v;
    		}

    		$this->data['order_data'] = $result;

        	$this->data['products'] = $this->model_products->getActiveProductData();      	
			$this->data['vendors'] = $this->model_vendor->getActiveVendorData(); 
			
			$this->data['singlevendor'] = $this->model_vendor->getVendorSingleData($orders_data['vendor_id']); 
			
            $this->render_template('purchase/edit', $this->data);
        }
	}

	/*
	* It removes the data from the database
	* and it returns the response into the json format
	*/
	public function remove()
	{
		if(!in_array('deletePurchase', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$order_id = $this->input->post('order_id');

        $response = array();
        if($order_id) {
            $delete = $this->model_purchase->remove($order_id);
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
}