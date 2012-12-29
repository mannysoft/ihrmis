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
 * Payroll Management Class
 *
 * This class use for payroll
 *
 * @package		iHRMIS
 * @subpackage	Payroll
 * @category	Controllers
 * @author		Manny Isles
 * @link		http://charliesoft.net/hrmis/user_guide/modules/payroll/controllers/payroll.html
 */
class Payroll extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
						
		$this->output->enable_profiler(TRUE);
    }
	
	// --------------------------------------------------------------------
	
	function monthly( $employee_id = '')
	{	
	
		$data['page_name'] = '<b>Monthly Payroll</b>';
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		$data['selected'] = $this->session->userdata('office_id');
		
		$data['year_options'] 		= $this->options->year_options(2009, 2020);//2010 - 2020
		$data['year_selected'] 		= date('Y');
		
		// Months
		$data['month_options'] 		= $this->options->month_options();
		$data['month_selected'] 	= date('m');
		
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
			
			$e = new Employee_m();
			
			$e->where('office_id', $this->input->post('office_id'));
			$e->where('permanent', 1);
			$e->order_by('lname');
			
			$data['employees'] = $e->get($limit, $offset);
			
			
			$a  = new Deduction_agency();
			$a->order_by('report_order');
			$data['agencies'] = $a->get();
			
			
			
		}
		
		$e = new Employee_m();
			
		$e->where('office_id', ($this->input->post('office_id')) ? $this->input->post('office_id') : $this->session->userdata('office_id'));
		$e->where('permanent', 1);
		$e->order_by('lname');
		
		//$data['employees'] = $e->get($limit, $offset);
		$data['employees'] = $e->get();
		
		$a  = new Deduction_agency();
		$a->order_by('report_order');
		$data['agencies'] = $a->get();
		
		$data['main_content'] = 'monthly';
		
		$this->load->view('includes/template', $data);	
	}
	 

}

/* End of file office_manage.php */
/* Location: ./application/modules/payroll/controllers/payroll.php */