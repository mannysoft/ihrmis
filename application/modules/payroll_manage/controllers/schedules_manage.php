<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedules_Manage extends Controller {

	function Schedules_Manage()
	{
		parent::Controller();
		
	}
	
	function index()
	{
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

	function forwarded()
	{
		//$this->output->enable_profiler(TRUE);
		$data['page_name'] = '<b>Leave Forwarded</b>';
		$data['msg'] = '';
		/**/
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('index', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	function wop()
	{
		//$this->output->enable_profiler(TRUE);
		$data['page_name'] = '<b>Leave WOP</b>';
		$data['msg'] = '';
		/**/
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('index', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	function monetization()
	{
		//$this->output->enable_profiler(TRUE);
		$data['page_name'] = '<b>Monetization</b>';
		$data['msg'] = '';
		/**/
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('index', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	
	
}	