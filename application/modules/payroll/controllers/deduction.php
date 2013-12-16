<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Open Source Application Software use by Government agencies for  
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis
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
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/models/conversion_table.html
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
		$data['page_name'] = '<b>Agency</b>';
		
		$data['msg'] = '';
		
		//echo DeductionInformation::all();
		
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
		
		return View::make('includes/template', $data);	
		
	}
	
	// --------------------------------------------------------------------
	
	function agency_save( $id = '' )
	{		
		$data['page_name'] = '<b>Save Agency</b>';
				
		$data['msg'] = '';
			
		$p = new Deduction_agency();
		
		$data['deduction'] = $p->get_by_id( $id );
		
		if ( Input::get('op'))
		{
			$p->code 			= Input::get('code');
			$p->agency_name 	= Input::get('agency_name');
			$p->report_order 	= Input::get('report_order');
			
			$p->save();
			
			return Redirect::to('payroll/deduction/agency', 'refresh');
			
		}
	
		$data['main_content'] = 'deduction/agency/agency_save';
		
		return View::make('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function agency_delete( $id = '' )
	{
		$p = new Deduction_agency();
		
		$p->get_by_id( $id );
		
		$p->delete();
		
		return Redirect::to('payroll/deduction/agency', 'refresh');
		
	}
	
	// =================================================================================
	
	function information()
	{		
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
		
		return View::make('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function information_save( $id = '' )
	{
		$data['page_name'] = '<b>Add Information</b>';
		
		$this->config->load('deductions');
		
		if ( $id != '' )
		{
			$data['page_name'] = '<b>Edit Information</b>';
		}
		
		$data['msg'] = '';
		
		$di = new Deduction_information();
		
		$data['deduction'] = $di->get_by_id( $id );
		
		if ( Input::get('op'))
		{
			$di->code 					= Input::get('code');
			$di->desc 					= Input::get('desc');
			$di->deduction_agency_id 	= Input::get('agency_id');
			$di->type 					= Input::get('type');
			$di->mandatory 				= Input::get('mandatory');
			$di->tax_exempted 			= Input::get('tax_exempted');
			$di->er_share 				= Input::get('er_share');
			$di->official 				= Input::get('official');
			$di->optional_amount 		= Input::get('optional_amount');
			$di->amount 				= Input::get('amount');
			$di->reference_table 		= Input::get('reference_table');
			$di->amount_exempted 		= Input::get('amount_exempted');
			$di->report_order 			= Input::get('report_order');
			$di->line_no 				= Input::get('line_no');
			
			$di->save();
			
			return Redirect::to('payroll/deduction/information', 'refresh');
			
		}
		
		$d = new Deduction_agency();
				
		$data['agencies'] = $d->get_agencies();
		
		$data['main_content'] = 'deduction/information/information_save';
		
		return View::make('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function information_delete( $id = '' )
	{
		$di = new Deduction_information();
		
		$di->get_by_id( $id );
		
		$di->delete();
		
		return Redirect::to('payroll/deduction/information', 'refresh');
		
	}
	
	// =================================================================================
	
	function optional( $employee_id = '' )
	{		
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
		
		if ( Input::get('op'))
		{
			$data['employee_id'] 	= Input::get('employee_id');
			$data['selected'] 		= Input::get('office_id');
			
			$p->where('employee_id', Input::get('employee_id'));
			
			$data['deductions'] = $p->get($limit, $offset);
		}
		
		$data['main_content'] = 'deduction/optional/optional';
		
		return View::make('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function optional_save( $id = '', $employee_id = '' )
	{		
		$data['page_name'] = '<b>Save Optional Contributions</b>';
		
		$data['msg'] = '';
		
		$di = new Deduction_optional();
		
		$data['deduction'] = $di->get_by_id( $id );
		
		if ( Input::get('op'))
		{
			// Add employee id if insert only
			if ( $id == 0)
			{
				$di->employee_id 			= $employee_id;
			}
			
			$di->deduction_information_id 	= Input::get('deduction_information_id');
			$di->date_from 					= Input::get('date_from');
			$di->date_to 					= Input::get('date_to');
			$di->status 					= Input::get('status') ? Input::get('status') : 'inactive';			
			$di->save();
			
			return Redirect::to('payroll/deduction/optional/'.$employee_id, 'refresh');
			
		}
		
		$d = new Deduction_information();
		
		$d->order_by('desc');
		$d->where('official', 'unofficial');
		
		$data['informations'] = $d->get();
		
		$data['main_content'] = 'deduction/optional/optional_save';
		
		return View::make('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function optional_delete( $id = '', $employee_id = '' )
	{
		$di = new Deduction_optional();
		
		$di->get_by_id( $id );
		
		$di->delete();
		
		return Redirect::to('payroll/deduction/optional/'.$employee_id, 'refresh');
		
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
		
		if ( Input::get('op'))
		{
			$data['employee_id'] 	= Input::get('employee_id');
			$data['selected'] 		= Input::get('office_id');
			
			$p->where('employee_id', Input::get('employee_id'));
			
			$data['deductions'] = $p->get($limit, $offset);
		}
		
		$data['main_content'] = 'deduction/loan/loan';
		
		return View::make('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function loan_save( $id = '', $employee_id = '' )
	{
		$data['page_name'] = '<b>Save Loan Schedule</b>';
		
		$data['employee_id'] = $employee_id;
		
		$data['msg'] = '';
		
		$di = new Deduction_loan();
		
		$data['deduction'] = $di->get_by_id( $id );
		
		if ( Input::get('op'))
		{
			// Add employee id if insert only
			if ( $id == 0)
			{
				$di->employee_id 			= $employee_id;
			}
			
			$di->deduction_information_id 	= Input::get('deduction_information_id');
			$di->date_loan 					= Input::get('date_loan');
			$di->loan_gross 				= Input::get('loan_gross');
			$di->months_pay 				= Input::get('months_pay');
			$di->monthly_pay 				= Input::get('monthly_pay');
			$di->date_from 					= Input::get('date_from');
			$di->date_to 					= Input::get('date_to');
			$di->status 					= Input::get('status') ? Input::get('status') : 'inactive';			
			$di->save();
			
			return Redirect::to('payroll/deduction/loan/'.$employee_id, 'refresh');
			
		}
		
		$d = new Deduction_information();
		
		$d->order_by('desc');
		$d->where('type', 'loan');
		
		$data['informations'] = $d->get();
		
		$data['main_content'] = 'deduction/loan/loan_save';
		
		return View::make('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function loan_delete( $id = '', $employee_id = '' )
	{
		$di = new Deduction_loan();
		
		$di->get_by_id( $id );
		
		$di->delete();
		
		return Redirect::to('payroll/deduction/loan/'.$employee_id, 'refresh');
		
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
		
		return View::make('includes/template', $data);	
		
	}
	
	// --------------------------------------------------------------------	

}


/* End of file office_manage.php */
/* Location: ./system/application/modules/office_manage/controllers/office_manage.php */