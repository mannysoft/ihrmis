<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends MX_Controller {

	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
		$this->output->enable_profiler(TRUE);
		
		
    }
	
	function loan()
	{
		$data['rows'] = $this->Deductions_Agency->get_agencies();
		
		$data['page_name'] = '<b>Loan Schedules</b>';
		
		$data['msg'] = '';
		
		$offices = $this->Office->get_offices();
		
		foreach($offices as $office)
		{
			$options[$office['office_id']] = $office['office_name'];
		}
		
		//Use for office listbox
		$data['options'] = $options;
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('schedules/loan', $data);
		
		$this->load->view('index', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	function premiums()
	{
		$data['rows'] = $this->Deductions->get_deductions('premiums');
		
		$data['page_name'] = '<b>Premiums</b>';
		
		$data['msg'] = '';
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('remittances/premiums', $data);
		
		$this->load->view('index', $data);
		
		$this->load->view('includes/footer');
		
	}

}	