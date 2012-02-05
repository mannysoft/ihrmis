<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remittances_Manage extends Controller {

	function Remittances_Manage()
	{
		parent::Controller();
		
	}
	
	function index()
	{
	}
	
	function deductions_agency()
	{
		$data['rows'] = $this->Deductions_Agency->get_agencies();
		
		$data['page_name'] = '<b>Deductions Agency</b>';
		
		$data['msg'] = '';
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('remittances/deductions_agency', $data);
		
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
	
	function loans()
	{
		$data['rows'] = $this->Deductions->get_deductions('loan');
		
		$data['page_name'] = '<b>Loans</b>';
		
		$data['msg'] = '';
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('remittances/premiums', $data);
		
		$this->load->view('index', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	function insurances()
	{
		$data['rows'] = $this->Deductions->get_deductions('insurances');
		
		$data['page_name'] = '<b>Insurances</b>';
		
		$data['msg'] = '';
		
		$this->load->view('includes/header');
		
		$this->load->view('includes/menu', $data);
		$this->load->view('includes/body_top', $data);
		
		$this->load->view('remittances/premiums', $data);
		
		$this->load->view('index', $data);
		
		$this->load->view('includes/footer');
		
	}
	
	function deduction_refund()
	{
	
	
	}
	
	function philhealth_sched()
	{
	
	}
	
	
	function pae()
	{
	
	}
	
	function tax_table()
	{
	
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