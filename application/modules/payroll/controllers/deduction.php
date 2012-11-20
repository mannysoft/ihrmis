<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Open source Application Software use by Government agencies for 
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Conversion Table Class
 *
 * This class use for converting number of minutes late
 * to the corresponding equivalent to leave credits.
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manny Isles
 * @link		http://charliesoft.net/hrmis/user_guide/models/conversion_table.html
 */
class Deduction extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
		//$this->output->enable_profiler(TRUE);
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
		
		$data['main_content'] = 'deduction/agency/agency';
		
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
			
		$p = new Deduction_agency();
		
		$data['deduction'] = $p->get_by_id( $id );
		
		if ( $this->input->post('op'))
		{
			$p->code 			= $this->input->post('code');
			$p->agency_name 	= $this->input->post('agency_name');
			$p->report_order 	= $this->input->post('report_order');
			
			$p->save();
			
			redirect(base_url().'payroll/deduction/agency', 'refresh');
			
		}
	
		$data['main_content'] = 'deduction/agency/agency_save';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function agency_delete( $id = '' )
	{
		$p = new Deduction_agency();
		
		$p->get_by_id( $id );
		
		$p->delete();
		
		redirect(base_url().'payroll/deduction/agency', 'refresh');
		
	}
	
	// =================================================================================
	
	function information()
	{
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		
		$data['page_name'] = '<b>Deduction Information</b>';
		
		$data['msg'] = '';
				
		$p = new Deduction_information();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'payroll/deduction/information/';
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
				
		$data['main_content'] = 'deduction/information/information';
		
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
		
		$this->config->load('deductions');
		
		if ( $id != '' )
		{
			$data['page_name'] = '<b>Edit Information</b>';
		}
		
		$data['msg'] = '';
		
		$di = new Deduction_information();
		
		$data['deduction'] = $di->get_by_id( $id );
		
		if ( $this->input->post('op'))
		{
			$di->code 					= $this->input->post('code');
			$di->desc 					= $this->input->post('desc');
			$di->deduction_agency_id 	= $this->input->post('agency_id');
			$di->type 					= $this->input->post('type');
			$di->mandatory 				= $this->input->post('mandatory');
			$di->tax_exempted 			= $this->input->post('tax_exempted');
			$di->er_share 				= $this->input->post('er_share');
			$di->official 				= $this->input->post('official');
			$di->optional_amount 		= $this->input->post('optional_amount');
			$di->amount_exempted 		= $this->input->post('amount_exempted');
			$di->report_order 			= $this->input->post('report_order');
			$di->line_no 				= $this->input->post('line_no');
			
			$di->save();
			
			redirect(base_url().'payroll/deduction/information', 'refresh');
			
		}
		
		$d = new Deduction_agency();
				
		$data['agencies'] = $d->get_agencies();
		
		$data['main_content'] = 'deduction/information/information_save';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function information_delete( $id = '' )
	{
		$di = new Deduction_information();
		
		$di->get_by_id( $id );
		
		$di->delete();
		
		redirect(base_url().'payroll/deduction/information', 'refresh');
		
	}
	
	// =================================================================================
	
	function optional( $employee_id = '' )
	{
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		
		$data['page_name'] = '<b>Optional Contributions</b>';
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		$data['selected'] = $this->session->userdata('office_id');
		
		$data['employee_id'] = $employee_id;
		
		$data['msg'] = '';
				
		$p = new Deduction_optional();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'payroll/deduction/optional/';
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
		
		$data['main_content'] = 'deduction/optional/optional';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function optional_save( $id = '', $employee_id = '' )
	{
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions_information/">Deductions Information</a> / ';
		
		$data['page_name'] = '<b>Save Optional Contributions</b>';
		
		$data['msg'] = '';
		
		$di = new Deduction_optional();
		
		$data['deduction'] = $di->get_by_id( $id );
		
		if ( $this->input->post('op'))
		{
			// Add employee id if insert only
			if ( $id == 0)
			{
				$di->employee_id 			= $employee_id;
			}
			
			$di->deduction_information_id 	= $this->input->post('deduction_information_id');
			$di->date_from 					= $this->input->post('date_from');
			$di->date_to 					= $this->input->post('date_to');
			$di->status 					= $this->input->post('status') ? $this->input->post('status') : 'inactive';			
			$di->save();
			
			redirect(base_url().'payroll/deduction/optional/'.$employee_id, 'refresh');
			
		}
		
		$d = new Deduction_information();
		
		$d->order_by('desc');
		$d->where('official', 'unofficial');
		
		$data['informations'] = $d->get();
		
		$data['main_content'] = 'deduction/optional/optional_save';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function optional_delete( $id = '', $employee_id = '' )
	{
		$di = new Deduction_optional();
		
		$di->get_by_id( $id );
		
		$di->delete();
		
		redirect(base_url().'payroll/deduction/optional/'.$employee_id, 'refresh');
		
	}
	
	// =================================================================================
	
	function loan( $employee_id = '')
	{	
	
		$data['page_name'] = '<b>Loan Schedule</b>';
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		$data['selected'] = $this->session->userdata('office_id');
		
		$data['employee_id'] = $employee_id;
		
		$data['msg'] = '';
				
		$p = new Deduction_loan();
		
		//echo $this->db->last_query();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'payroll/deduction/loan/';
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
		
		$data['main_content'] = 'deduction/loan/loan';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function loan_save( $id = '', $employee_id = '' )
	{
		$data['page_name'] = '<b>Save Loan Schedule</b>';
		
		$data['employee_id'] = $employee_id;
		
		$data['msg'] = '';
		
		$di = new Deduction_loan();
		
		$data['deduction'] = $di->get_by_id( $id );
		
		if ( $this->input->post('op'))
		{
			// Add employee id if insert only
			if ( $id == 0)
			{
				$di->employee_id 			= $employee_id;
			}
			
			$di->deduction_information_id 	= $this->input->post('deduction_information_id');
			$di->date_loan 					= $this->input->post('date_loan');
			$di->loan_gross 				= $this->input->post('loan_gross');
			$di->months_pay 				= $this->input->post('months_pay');
			$di->monthly_due 				= $this->input->post('monthly_due');
			$di->date_from 					= $this->input->post('date_from');
			$di->date_to 					= $this->input->post('date_to');
			$di->status 					= $this->input->post('status') ? $this->input->post('status') : 'inactive';			
			$di->save();
			
			redirect(base_url().'payroll/deduction/loan/'.$employee_id, 'refresh');
			
		}
		
		$d = new Deduction_information();
		
		$d->order_by('desc');
		$d->where('type', 'loan');
		
		$data['informations'] = $d->get();
		
		$data['main_content'] = 'deduction/loan/loan_save';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function loan_delete( $id = '', $employee_id = '' )
	{
		$di = new Deduction_loan();
		
		$di->get_by_id( $id );
		
		$di->delete();
		
		redirect(base_url().'payroll/deduction/loan/'.$employee_id, 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	function tax( $office_id = '' )
	{
		$data['page_name'] = '<b>Tax Exemption</b>';
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		$data['selected'] = $this->session->userdata('office_id');
				
		$data['error_msg'] = '';
		
		$data['msg'] = '';
		
		$data['main_content'] = 'deduction/tax/tax';
		
		$this->load->view('includes/template', $data);	
		
	}
	
	// --------------------------------------------------------------------	

}


/* End of file office_manage.php */
/* Location: ./system/application/modules/office_manage/controllers/office_manage.php */