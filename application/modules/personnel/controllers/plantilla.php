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
 * @author		Manolito Isles
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
 * @author		Manolito Isles
 * @link		http://charliesoft.net/hrmis/user_guide/models/conversion_table.html
 */
class Plantilla extends MX_Controller  
{
	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function index($employee_id = '')
	{
		
		$data['page_name'] 			= '<b>Plantilla of Personnel</b>';
		$data['msg'] 				= '';
		
		
		if ( $this->input->post('employee_id'))
		{
			$employee_id = $this->input->post('employee_id');
		}
		
		$e = new Employee_m();
		
		$data['employee'] = $e->get_by_id ($employee_id);
		
		$data['selected'] = $e->office_id;
		
		//Use for office listbox
		$data['options'] = $this->options->office_options();
		
		$data['employee_id'] 		= $employee_id;
		
		$data['main_content'] 		= 'assets';
		
		$this->load->view('includes/template', $data);
		
	}
	
	function index2()
	{
		echo 'index';
	}
	
	
}

/* End of file home.php */
/* Location: ./system/application/modules/home/controllers/home.php */