<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Additional_compensation extends MX_Controller {

	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
		$this->output->enable_profiler(TRUE);
    }
	
	function add_compensation()
	{
		$data['page_name'] = '<b>Additional Compensation</b>';
		
		$data['msg'] = '';
		
		$p = new Additional_compensation_m();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'payroll/additional_compensation/add_compensation/';
		$config['total_rows'] = $p->get()->count();
		$config['per_page'] = '15';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		// Get all positions
		//$p = new Position();
		$p->order_by('order');
		
		$data['deductions'] = $p->get($limit, $offset);
		
		$data['main_content'] = 'additional_compensation/add_compensation/add_compensation';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function add_compensation_save( $id = '' )
	{
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/agency/">Agency</a> / ';
		
		$data['page_name'] = '<b>Add Additional Compensation</b>';
		
		if ( $id != '' )
		{
			$data['page_name'] = '<b>Edit Additional Compensation</b>';
		}
		
		$data['msg'] = '';
			
		$p = new Additional_compensation_m();
		
		$data['deduction'] = $p->get_by_id( $id );
		
		if ( $this->input->post('op'))
		{
			$p->code 		= $this->input->post('code');
			$p->name 		= $this->input->post('name');
			$p->taxable 	= $this->input->post('taxable');
			$p->frequency 	= $this->input->post('frequency');
			$p->order 		= $this->input->post('order');
			$p->deductible 	= $this->input->post('deductible');
			$p->basis 		= $this->input->post('basis');
			
			$p->save();
			
			redirect(base_url().'payroll/additional_compensation/add_compensation', 'refresh');
			
		}
	
		$data['main_content'] = 'additional_compensation/add_compensation/add_compensation_save';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function add_compensation_delete( $id = '' )
	{
		$p = new Additional_compensation_m();
		
		$p->get_by_id( $id );
		
		$p->delete();
		
		redirect(base_url().'payroll/additional_compensation/add_compensation', 'refresh');
		
	}
	
	// =================================================================================
	
	function staff_entitlement( $employee_id = '')
	{	
	
		$data['page_name'] = '<b>Staff Entitlement</b>';
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		$data['selected'] = $this->session->userdata('office_id');
		
		$data['employee_id'] = $employee_id;
		
		$data['msg'] = '';
				
		$p = new Staff_entitlement_m();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'payroll/additional_compensation/staff_entitlement/';
		$config['total_rows'] = $p->get()->count();
		$config['per_page'] = '15';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		// Get all positions
		//$p = new Position();
		//$p->order_by('desc');
		
		//$data['deductions'] = $p->get($limit, $offset);	
		$data['deductions'] = array();	
		
		if ( $employee_id )
		{			
			$p->where('employee_id', $employee_id);
			
			$data['deductions'] = $p->get($limit, $offset);
		}
		
		if ( $this->input->post('op'))
		{
			$data['employee_id'] 	= $this->input->post('employee_id');
			$data['selected'] 		= $this->input->post('office_id');
			
			$p->where('employee_id', $this->input->post('employee_id'));
			
			$data['deductions'] = $p->get($limit, $offset);
		}
		
		$data['main_content'] = 'additional_compensation/staff_entitlement/staff_entitlement';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function staff_entitlement_save( $id = '', $employee_id = '' )
	{
		$data['page_name'] = '<b>Save Staff Entitlement</b>';
		
		$data['msg'] = '';
		
		$di = new Staff_entitlement_m();
		
		$data['deduction'] = $di->get_by_id( $id );
		
		if ( $this->input->post('op'))
		{
			// Add employee id if insert only
			if ( $id == 0)
			{
				$di->employee_id 			= $employee_id;
			}
			
			$di->additional_compensation_id 	= $this->input->post('additional_compensation_id');
			$di->effectivity_date 				= $this->input->post('effectivity_date');
			$di->ineffectivity_date 			= $this->input->post('ineffectivity_date');
			$di->amount 						= $this->input->post('amount');	
			$di->save();
			
			redirect(base_url().'payroll/additional_compensation/staff_entitlement/'.$employee_id, 'refresh');
			
		}
		
		$d = new Additional_compensation_m();
		
		$d->order_by('name');
		//$d->where('type', 'loan');
		
		$data['informations'] = $d->get();
		
		$data['main_content'] = 'additional_compensation/staff_entitlement/staff_entitlement_save';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function staff_entitlement_delete( $id = '', $employee_id = '' )
	{
		$di = new Staff_entitlement_m();
		
		$di->get_by_id( $id );
		
		$di->delete();
		
		redirect(base_url().'payroll/additional_compensation/staff_entitlement/'.$employee_id, 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	// --------------------------------------------------------------------
	
	
	// --------------------------------------------------------------------
}	