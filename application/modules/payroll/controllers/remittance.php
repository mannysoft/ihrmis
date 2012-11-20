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
class Remittance extends MX_Controller {

	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
		//$this->output->enable_profiler(TRUE);
		
		
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
		//$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		//$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		//$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		
		$data['page_name'] = '<b>Deduction Refund</b>';
		
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
		
		$data['main_content'] = 'remittance/deduction_refund/deduction_refund';
		
		$this->load->view('includes/template', $data);
	
	}
	
	function philhealth_sched()
	{
		$data['page_name'] = '<b>Philhealth Schedule</b>';
		
		$data['msg'] = '';
		
		$p = new Philhealth_sched();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'payroll/remittance/philhealth_sched/';
		$config['total_rows'] = $p->get()->count();
		$config['per_page'] = '15';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		// Get all positions
		//$p = new Position();
		$p->order_by('start_range');
		
		$data['deductions'] = $p->get($limit, $offset);
		
		$data['main_content'] = 'remittance/philhealth_sched/philhealth_sched';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function philhealth_sched_save( $id = '' )
	{
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/agency/">Agency</a> / ';
		
		$data['page_name'] = '<b>Add Philhealth Schedules</b>';
		
		if ( $id != '' )
		{
			$data['page_name'] = '<b>Edit Philhealth Schedules</b>';
		}
		
		$data['msg'] = '';
			
		$p = new Philhealth_sched();
		
		$data['deduction'] = $p->get_by_id( $id );
		
		if ( $this->input->post('op'))
		{
			$p->start_range 	= $this->input->post('start_range');
			$p->end_range 		= $this->input->post('end_range');
			$p->salary_based 	= $this->input->post('salary_based');
			$p->monthly_share 	= $this->input->post('monthly_share');
			$p->employee_share 	= $this->input->post('employee_share');
			$p->employer_share 	= $this->input->post('employer_share');
			
			$p->save();
			
			redirect(base_url().'payroll/remittance/philhealth_sched', 'refresh');
			
		}
	
		$data['main_content'] = 'payroll/remittance/philhealth_sched/philhealth_sched_save';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function philhealth_sched_delete( $id = '' )
	{
		$p = new Philhealth_sched();
		
		$p->get_by_id( $id );
		
		$p->delete();
		
		redirect(base_url().'payroll/remittance/philhealth_sched', 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	function pae()
	{
		$data['page_name'] = '<b>Personal Additional Exemptions</b>';
		
		$data['msg'] = '';
		
		$p = new Pae();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'payroll/remittance/pae/';
		$config['total_rows'] = $p->get()->count();
		$config['per_page'] = '15';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		// Get all positions
		//$p = new Position();
		//$p->order_by('start_range');
		
		$data['deductions'] = $p->get($limit, $offset);
		
		$data['main_content'] = 'remittance/pae/pae';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function pae_save( $id = '' )
	{
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/agency/">Agency</a> / ';
		
		$data['page_name'] = '<b>Add Personal Additional Exemptions</b>';
		
		if ( $id != '' )
		{
			$data['page_name'] = '<b>Edit Personal Additional Exemptions</b>';
		}
		
		$data['msg'] = '';
			
		$p = new Pae();
		
		$data['deduction'] = $p->get_by_id( $id );
		
		if ( $this->input->post('op'))
		{
			$p->tax_status 			= $this->input->post('tax_status');
			$p->description 		= $this->input->post('description');
			$p->effectivity_date 	= $this->input->post('effectivity_date');
			$p->effectivity_date_to = $this->input->post('effectivity_date_to');
			$p->exemption 			= $this->input->post('exemption');
			
			$p->save();
			
			redirect(base_url().'payroll/remittance/pae', 'refresh');
			
		}
	
		$data['main_content'] = 'remittance/pae/pae_save';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function pae_delete( $id = '' )
	{
		$p = new Pae();
		
		$p->get_by_id( $id );
		
		$p->delete();
		
		redirect(base_url().'payroll/remittance/pae', 'refresh');
		
	}
	
	
	// --------------------------------------------------------------------
	
	function tax_table()
	{
		$data['page_name'] = '<b>Tax Table</b>';
		
		$data['msg'] = '';
		
		$p = new Tax_table();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'payroll/remittance/pae/';
		$config['total_rows'] = $p->get()->count();
		$config['per_page'] = '15';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		// Get all positions
		//$p = new Position();
		$p->order_by('id');
		
		$data['deductions'] = $p->get($limit, $offset);
		
		$data['main_content'] = 'remittance/tax_table/tax_table';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function tax_table_save( $id = '' )
	{
		$data['bread_crumbs'] = '<a href="'.base_url().'home/home_page/">Home</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll/">Payroll Management</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/deductions/">Deductions</a> / ';
		$data['bread_crumbs'].= '<a href="'.base_url().'payroll_deductions/agency/">Agency</a> / ';
		
		$data['page_name'] = '<b>Add Tax Table</b>';
		
		if ( $id != '' )
		{
			$data['page_name'] = '<b>Edit Tax Table</b>';
		}
		
		$data['msg'] = '';
			
		$p = new Tax_table();
		
		$data['deduction'] = $p->get_by_id( $id );
		
		if ( $this->input->post('op'))
		{
			$p->start_range 	= $this->input->post('start_range');
			$p->end_range 		= $this->input->post('end_range');
			$p->fix_amount 		= $this->input->post('fix_amount');
			$p->percentage 		= $this->input->post('percentage');
			$p->over_limit 		= $this->input->post('over_limit');
			
			$p->save();
			
			redirect(base_url().'payroll/remittance/tax_table', 'refresh');
			
		}
	
		$data['main_content'] = 'remittance/tax_table/tax_table_save';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function tax_table_delete( $id = '' )
	{
		$p = new Tax_table();
		
		$p->get_by_id( $id );
		
		$p->delete();
		
		redirect(base_url().'payroll/remittance/tax_table', 'refresh');
		
	}
	
	// --------------------------------------------------------------------
}	