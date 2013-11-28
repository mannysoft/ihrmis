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
class Plantilla extends MX_Controller  
{
	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		$this->output->enable_profiler(TRUE);
    }  
	
	
	// --------------------------------------------------------------------
	
	function index($year = '2009')
	{
		
		$data['page_name'] 			= '<b>Plantilla of Personnel</b>';
		$data['msg'] 				= '';
				
		$data['error_msg'] = '';
		
		// Use for office listbox
		$data['options'] 			= $this->options->office_options();
		$data['selected'] 			= (Input::get('office_id')) ? Input::get('office_id') : 
										$this->session->userdata('office_id');		
		
		$data['year_options'] 		= $this->options->year_options(date('Y') - 5, date('Y') + 3);//2010 - 2020
		$data['year_selected'] 		= (Input::get('year')) ? Input::get('year') : date('Y');
		
		$office_id = $data['selected'];
				
		$this->Employee->fields = array(
                                'id',
                                'employee_id',
                                'office_id',
                                'lname',
                                'fname',
                                'mname'
                                );
        
		if ($office_id != '')
		{
			$p = new Plantilla_item();

			$data['rows'] = $p->get_by_office_id($office_id);
		}
		
		//
		$data['year'] = $year;
		
		foreach ( $data['rows'] as $row)
		{
			$c = new Plantilla_m();
			
			$c->where('employee_id', $row->id);
			$c->where('year', $year);
			$c->get();
			
			if ( $c->exists())// Do nothing
			{
				//echo 'cool';
			}
			else// Insert blank
			{
				$c->employee_id 	= $row->id;
				$c->year 			= $year;
				//$c->type 			= 'balance';
				//$c->save();
				//echo 'not cool';
			}
		}
		
		if(Input::get('op'))
		{
					
		}
				
		$data['main_content'] = 'plantilla/index';
		
		$this->load->view('includes/template', $data);
		
	}
	
	// --------------------------------------------------------------------
	
	function edit_place($mode = '')
	{		
		if ($mode == 'plantilla')
		{
			$c = new Plantilla();
		
			$c->where('id', Input::get('rowid'));
			
			$c->get();
			
			$field = Input::get('colid');	
			$c->$field = Input::get('new');
			
			$c->save();
			
			exit;
		}
	}
}

/* End of file home.php */
/* Location: ./system/application/modules/home/controllers/home.php */