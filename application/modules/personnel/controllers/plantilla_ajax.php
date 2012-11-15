<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Application Software use by Government agencies for management
 * of employees Attendance, Leave Administration, Payroll, Personnel
 * Training, Service Records, Performance, Recruitment and more...
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
class Plantilla_ajax extends MX_Controller  
{
	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		//$this->load->model('options');
		//$this->output->enable_profiler(TRUE);
    }
	
	// --------------------------------------------------------------------
	
	function plantilla($office_id = '', $year = '2009' )
	{
		$data 			= array();
		
		
		$this->Employee->fields = array(
                                'id',
                                'employee_id',
                                'office_id',
                                'lname',
                                'fname',
                                'mname'
                                );
        
		$data['rows'] = $this->Employee->get_employee_list($this->session->userdata('office_id'), '');
		
		if ($office_id != '')
		{
			$data['rows'] = $this->Employee->get_employee_list($office_id, '');
		}
		
		//
		$data['year'] = $year;
		
		foreach ( $data['rows'] as $row)
		{
			$c = new Plantilla();
			
			$c->where('employee_id', $row['id']);
			$c->where('year', $year);
			$c->get();
			
			if ( $c->exists())// Do nothing
			{
				//echo 'cool';
			}
			else// Insert blank
			{
				$c->employee_id 	= $row['id'];
				$c->year 			= $year;
				//$c->type 			= 'balance';
				$c->save();
				//echo 'not cool';
			}
		}
		
		$this->load->view('ajax/plantilla', $data);
	}
	
	function edit_place($mode = '')
	{		
		if ($mode == 'plantilla')
		{
			$c = new Plantilla();
		
			$c->where('id', $this->input->post('rowid'));
			
			$c->get();
			
			$field = $this->input->post('colid');	
			$c->$field = $this->input->post('new');
			
			$c->save();
			
			exit;
		}
	}
	
}

/* End of file home.php */
/* Location: ./system/application/modules/home/controllers/home.php */