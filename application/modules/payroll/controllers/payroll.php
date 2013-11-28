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
 * Payroll Management Class
 *
 * This class use for payroll
 *
 * @package		iHRMIS
 * @subpackage	Payroll
 * @category	Controllers
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/modules/payroll/controllers/payroll.html
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
				
		$data['employee_id'] = $employee_id;
		
		$data['msg'] = '';
		
		if ( Input::get('op'))
		{
	
		}
		
		
		
		
		$e = new Employee_m();
			
		$e->where('office_id', (Input::get('office_id')) ? Input::get('office_id') : $this->session->userdata('office_id'));
		$e->where('permanent', 1);
		$e->order_by('lname');
		
		$data['employees'] = $e->get();
				
		$data['main_content'] = 'monthly';
		
		$this->load->view('includes/template', $data);	
	}
	 

}

/* End of file office_manage.php */
/* Location: ./application/modules/payroll/controllers/payroll.php */