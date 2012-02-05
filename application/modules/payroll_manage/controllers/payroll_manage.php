<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_manage extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
		$this->output->enable_profiler(TRUE);
		
		
    }  
	
	// --------------------------------------------------------------------
	
	function deductions()
	{
		$data['bread_crumbs'] = 'Home / Payroll Management / ';
		
		$data['page_name'] = '<b>Deductions</b>';
		
		$data['msg'] = '';
		
		$p = new Deduction_agency();
		
		$p->get();
		
		foreach ($p as $a)
		{
			//echo $a->agency_name;
		}
				
		$data['main_content'] = 'deductions';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function agency()
	{
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		
		$data['page_name'] = '<b>Agency</b>';
		
		$data['msg'] = '';
		
		$p = new Deduction_agency();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'payroll_deductions/agency/';
		$config['total_rows'] = $p->get()->count();
		$config['per_page'] = '15';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		// Get all positions
		//$p = new Position();
		$p->order_by('agency_name');
		
		$data['deductions'] = $p->get($limit, $offset);
		
		$data['main_content'] = 'agency';
		
		$this->load->view('includes/template', $data);	
		
	}
	
	// --------------------------------------------------------------------
	
	function agency_save( $id = '' )
	{
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/agency/">Agency</a> / ';
		
		$data['page_name'] = '<b>Add Agency</b>';
		
		if ( $id != '' )
		{
			$data['page_name'] = '<b>Edit Agency</b>';
		}
		
		$data['msg'] = '';
			
		$p = new Deductions_agency();
		
		$data['deduction'] = $p->get_by_id( $id );
		
		if ( $this->input->post('op'))
		{
			$p->code 			= $this->input->post('code');
			$p->agency_name 	= $this->input->post('agency_name');
			$p->report_order 	= $this->input->post('report_order');
			
			$p->save();
			
			redirect(base_url().'payroll_deductions/agency', 'refresh');
			
		}
	
		$data['main_content'] = 'agency_save';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function agency_delete( $id = '' )
	{
		$p = new Deductions_agency();
		
		$p->get_by_id( $id );
		
		$p->delete();
		
		redirect(base_url().'payroll_deductions/agency', 'refresh');
		
	}
	
	// =================================================================================
	
	function information()
	{
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		
		$data['page_name'] = '<b>Deduction Information</b>';
		
		$data['msg'] = '';
				
		$p = new Deductions_information();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'payroll_deductions/information/';
		$config['total_rows'] = $p->get()->count();
		$config['per_page'] = '15';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		// Get all positions
		//$p = new Position();
		$p->order_by('desc');
		
		$data['deductions'] = $p->get($limit, $offset);
				
		$data['main_content'] = 'information';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function information_save( $id = '' )
	{
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/information/">Deductions Information</a> / ';
		$data['page_name'] = '<b>Add Information</b>';
		
		if ( $id != '' )
		{
			$data['page_name'] = '<b>Edit Information</b>';
		}
		
		$data['msg'] = '';
		
		$di = new Deductions_information();
		
		$data['deduction'] = $di->get_by_id( $id );
		
		if ( $this->input->post('op'))
		{
			$di->code 				= $this->input->post('code');
			$di->desc 				= $this->input->post('desc');
			$di->agency_id 			= $this->input->post('agency_id');
			$di->type 				= $this->input->post('type');
			$di->mandatory 			= $this->input->post('mandatory');
			$di->tax_exempted 		= $this->input->post('tax_exempted');
			$di->er_share 			= $this->input->post('er_share');
			$di->optional_amount 	= $this->input->post('optional_amount');
			$di->amount_exempted 	= $this->input->post('amount_exempted');
			$di->report_order 		= $this->input->post('report_order');
			
			$di->save();
			
			redirect(base_url().'payroll_deductions/information', 'refresh');
			
		}
		
		$d = new Deductions_agency();
		
		$d->order_by('agency_name');
		
		$data['agencies'] = $d->get();
		
		$data['main_content'] = 'information_save';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function information_delete( $id = '' )
	{
		$di = new Deductions_information();
		
		$di->get_by_id( $id );
		
		$di->delete();
		
		redirect(base_url().'payroll_deductions/information', 'refresh');
		
	}
	
	// =================================================================================
	
	function optional()
	{
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		
		$data['page_name'] = '<b>Optional Contributions</b>';
		
		$data['msg'] = '';
				
		$p = new Deductions_information();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'payroll_deductions/optional/';
		$config['total_rows'] = $p->get()->count();
		$config['per_page'] = '15';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		// Get all positions
		//$p = new Position();
		$p->order_by('desc');
		
		$data['deductions'] = $p->get($limit, $offset);
				
		$data['main_content'] = 'optional';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function optional_save( $id = '' )
	{
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions_information/">Deductions Information</a> / ';
		$data['page_name'] = '<b>Add Information</b>';
		
		if ( $id != '' )
		{
			$data['page_name'] = '<b>Edit Information</b>';
		}
		
		$data['msg'] = '';
		
		$di = new Deductions_information();
		
		$data['deduction'] = $di->get_by_id( $id );
		
		if ( $this->input->post('op'))
		{
			$di->code 				= $this->input->post('code');
			$di->desc 				= $this->input->post('desc');
			$di->agency_id 			= $this->input->post('agency_id');
			$di->type 				= $this->input->post('type');
			$di->mandatory 			= $this->input->post('mandatory');
			$di->tax_exempted 		= $this->input->post('tax_exempted');
			$di->er_share 			= $this->input->post('er_share');
			$di->optional_amount 	= $this->input->post('optional_amount');
			$di->amount_exempted 	= $this->input->post('amount_exempted');
			$di->report_order 		= $this->input->post('report_order');
			
			$di->save();
			
			redirect(base_url().'payroll_deductions/optional', 'refresh');
			
		}
		
		$d = new Deductions_agency();
		
		$d->order_by('agency_name');
		
		$data['agencies'] = $d->get();
		
		$data['main_content'] = 'optional_save';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function optional_delete( $id = '' )
	{
		$di = new Deductions_information();
		
		$di->get_by_id( $id );
		
		$di->delete();
		
		redirect(base_url().'payroll_deductions/optional', 'refresh');
		
	}
	
	// =================================================================================
	
	function loan( $ajax = '')
	{	
	
		if ( $ajax == 1)
		{
			echo 'ebs';
			exit;
		}
		
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		
		$data['page_name'] = '<b>Loans</b>';
		
		$data['msg'] = '';
				
		$loan = new Deductions_loan();
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['selected'] = $this->session->userdata('office_id');
		
		$d = new Deductions_agency();
		
		$d->order_by('agency_name');
		
		$data['agencies'] = $d->get();
		
		
		
		//$this->load->library('pagination');
		
		//$config['base_url'] = base_url().'payroll/deductions_optional/';
		//$config['total_rows'] = $p->get()->count();
		//$config['per_page'] = '15';
		
		//$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		//$limit = $config['per_page'];
		
		// Set the offset for our paging
		//$offset = $this->uri->segment(3);
		
		// Get all positions
		//$p = new Position();
		//$p->order_by('id');
		
		$data['loans'] = $loan->order_by('id')->get();
		
		$this->load->helper('loading');
		
		$data['main_content'] = 'loan';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function loan_save( $id = '' )
	{
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions_information/">Deductions Information</a> / ';
		$data['page_name'] = '<b>Add Information</b>';
		
		if ( $id != '' )
		{
			$data['page_name'] = '<b>Edit Information</b>';
		}
		
		$data['msg'] = '';
		
		$di = new Deductions_information();
		
		$data['deduction'] = $di->get_by_id( $id );
		
		if ( $this->input->post('op'))
		{
			$di->code 				= $this->input->post('code');
			$di->desc 				= $this->input->post('desc');
			$di->agency_id 			= $this->input->post('agency_id');
			$di->type 				= $this->input->post('type');
			$di->mandatory 			= $this->input->post('mandatory');
			$di->tax_exempted 		= $this->input->post('tax_exempted');
			$di->er_share 			= $this->input->post('er_share');
			$di->optional_amount 	= $this->input->post('optional_amount');
			$di->amount_exempted 	= $this->input->post('amount_exempted');
			$di->report_order 		= $this->input->post('report_order');
			
			$di->save();
			
			redirect(base_url().'payroll_deductions/loan', 'refresh');
			
		}
		
		$d = new Deductions_agency();
		
		$d->order_by('agency_name');
		
		$data['agencies'] = $d->get();
		
		$data['main_content'] = 'loan_save';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function loan_delete( $id = '' )
	{
		$di = new Deductions_information();
		
		$di->get_by_id( $id );
		
		$di->delete();
		
		redirect(base_url().'payroll_deductions/loan', 'refresh');
		
	}
	
	
	
	
	
	
	function ajax_loan_list( $office_id = '', $employee_id = 0, $agency_id = 0, $status = 0)
	{	
		$data = array();
		
		$loan = new Deductions_loan();
		
		if ( $employee_id != 0)
		{
			$loan->where('employee_id', $employee_id);
		}
		if ( $agency_id != 0)
		{
			$loan->where('loan_agency_id', $agency_id);
		}
		if ( $status != 0)
		{
			$loan->where('status', $status);
		}
		
		//$loan->where('office_id', $office_id);
		
		$data['loans'] = $loan->order_by('id')->get();
		
		$this->load->view('ajax/loan_list', $data);	
	}
	
}


/* End of file office_manage.php */
/* Location: ./system/application/modules/office_manage/controllers/office_manage.php */