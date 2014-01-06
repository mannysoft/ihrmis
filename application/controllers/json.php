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
 * iHRMIS Json Class
 *
 * This class use for converting from database to json format
 * usable for javascript.
 *
 * @package		iHRMIS
 * @subpackage	Controllers
 * @category	Utilities
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/models/agency.html
 */

class Json extends MX_Controller {

	function __construct()
    {
        parent::__construct();
				
		if(!Session::get('username'))
		{
			//redirect(base_url(), 'refresh');
		}
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function employees($office_id = '', $employee_id = '')
	{		
		$e 	= new Employee_m();
		
		$e->order_by('lname');
				
		$employees 	= $e->get_by_office_id( $office_id );
		
		$json 		= array();
		
		foreach ($employees as $employee)
		{
			// If employee is not blank we will 
			// going to use the 'employee_id' field as index
			// not the 'id' field
			
			if ($employee_id != '')
			{
				$json[$employee->employee_id] = $employee->lname.', '.$employee->fname;
			}
			else
			{
				$json[$employee->id] = $employee->lname.', '.$employee->fname;
			}
			
			
		}
				
		echo json_encode($json);
		
	}
	
	// --------------------------------------------------------------------
	
	function divisions($office_id = '')
	{
		$d = new Division();
		
		$divisions = $d->where('office_id', $office_id)->order_by('order')->get();
		
		$json 		= array();
		
		foreach ($divisions as $division)
		{			
			$json[$division->id] = $division->name;
		}
		
		echo json_encode($json);
		
	}

}