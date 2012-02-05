<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Json extends CI_Controller {

	function __construct()
    {
        parent::__construct();
				
		if(!$this->session->userdata('username'))
		{
			//redirect(base_url(), 'refresh');
		}
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		//$this->output->enable_profiler(TRUE);
    }  

	
	function employees($office_id = '')
	{
		
		
		$profile 	= new Profile();
		
		//$personal 	= new Personal();
		
		$employees 	= $profile->get_by_office_id( $office_id );
		
		$json 		= array();
		
		foreach ($employees as $employee)
		{
			$personal->get_by_id( $employee->employee_id );
			
			$json[$employee->employee_id] = $personal->lname.', '.$personal->fname;
		}
		
		echo json_encode($json);
		
	}

}