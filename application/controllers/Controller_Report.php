<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Report extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->data['page_title'] = 'Report';

		$this->load->model('model_invoice');
		$this->load->model('model_products');
		$this->load->model('model_company');
		$this->load->model('model_customer_history');
		$this->load->model('model_customer');
		$this->load->model('model_users');
		$this->load->helper('language'); 
		$this->load->library('Pdf');
		$this->load->model('model_inpurchase');
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
	public function salesreport()
	{
		if(!in_array('viewInvoice', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Sales Report';
		$this->render_template('reports/sales_report', $this->data);		
	}

	public function getListBalancesheet()
	{
		$data = array(
			'month' => $this->input->post('month'),
			'year' => $this->input->post('year')
		);
		$create = $this->model_invoice->getBalacesheet($data);
		echo json_encode($create);
	}

	public function purchasereport()
	{
		if(!in_array('viewInvoice', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Sales Report';
		$this->render_template('reports/purchase_report', $this->data);		
	}

	public function getPurchaseReport()
	{
		$data = array(
			'month' => $this->input->post('month'),
			'year' => $this->input->post('year')
		);
		$create = $this->model_inpurchase->getBalacesheet($data);
		echo json_encode($create);
	}
	public function hsnreport()
	{
		if(!in_array('viewInvoice', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->data['page_title'] = 'Manage Sales Report';
		$this->render_template('reports/hsn_report', $this->data);		
	}
	public function getHsnReport()
	{
		$data = array(
			'month' => $this->input->post('month'),
			'year' => $this->input->post('year')
		);
		$create = $this->model_inpurchase->getBalacesheet($data);
		echo json_encode($create);
	}

}