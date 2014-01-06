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
 * @copyright	Copyright (c) 2008 - 2014, Charliesoft
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
class Ajax extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		//$this->output->enable_profiler(TRUE);
    }  
	
	// --------------------------------------------------------------------
	
	function edit_place($mode = '')
	{
		
		if ($mode == 'tax_exempt')
		{
			$e = new Employee_m();
		
			$e->where('id', Input::get('rowid'));
			
			$e->get();
			
			if ( Input::get('colid') == 'tax_status' )
			{
				$e->tax_status = Input::get('new');
			}
			if ( Input::get('colid') == 'dependents' )
			{
				$e->dependents = Input::get('new');
			}
			
			$e->save();
			
			exit;
		}
		
	}
	
	// --------------------------------------------------------------------
	
	function tax($office_id = '')
	{
		//echo 'ee';
		$data 			= array();
		
		
		$this->Employee->fields = array(
                                'id',
                                'employee_id',
                                'office_id',
                                'lname',
                                'fname',
                                'mname',
								'tax_status',
								'dependents',
                                );
        
		$data['rows'] = $this->Employee->get_employee_list(Session::get('office_id'), '');
		
		if ($office_id != '')
		{
			$data['rows'] = $this->Employee->get_employee_list($office_id, '');
		}
		
		// Lets get the personal additional exemption
		$p = new Pae();
		
		$data['options'] = $p->options();
		
		return View::make('ajax/tax', $data);
	}
	
	// --------------------------------------------------------------------
	
}	