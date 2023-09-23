<?php 

class Controller_lang extends Admin_Controller 
{

	/* 
	* It only redirects to the manage category page
	* It passes the total product, total paid orders, total users, and total stores information
	into the frontend.
	*/
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		$this->load->model('model_users');
        
	}
	public function create()
	{
		$lang = $this->input->get('language');
		$this->model_users->updateUserData($lang);
		echo json_encode('true');
	}
	public function index()
	{
		$lang = $this->session->userdata('id');
		$userData = $this->model_users->getSingleUser($lang);
		echo json_encode($userData);

	}
}