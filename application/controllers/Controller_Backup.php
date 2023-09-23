<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controller_Backup extends Admin_Controller 
{
    public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

        $this->load->helper('url');
        $this->load->model('model_company');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('zip');
        $this->load->helper('email');
	}
	public function db_backup()
    {
        $this->load->dbutil();
        $prefs = array(
            'format' => 'zip',
            'filename' => 'my_db_backup.sql'
            );
        $backup =& $this->dbutil->backup($prefs);
        $db_name = 'backup-on-'. date("Y-m-d") .'.zip';
        $save = 'assets/db_backup/'.$db_name;
        $this->load->helper('file');
        write_file($save, $backup);
        $this->load->helper('download');
        force_download($db_name, $backup);

    }  
    public function sendMail(){
        $company_data = $this->model_company->getCompanyData(1);
     
$config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'testmail9677@gmail.com', 
            'smtp_pass' => 'Mohan@123', 
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
          );
      
      
                $this->load->library('email', $config);
                $this->email->set_newline("\r\n");
                $this->email->from('testmail9677@gmail.com');
                $this->email->to($company_data['email']);
                $this->email->subject('Backup for backup-on-'. date("Y-m-d") .'.zip');
                $this->email->message('Backup for backup-on-'. date("Y-m-d") .'.zip');
                  $this->email->attach('assets/db_backup/backup-on-'. date("Y-m-d") .'.zip');
                if($this->email->send())
               {
                echo 'Email send.';
               }
               else
              {
               show_error($this->email->print_debugger());
              }
    }
}