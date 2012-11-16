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
class Options extends CI_Model {

	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Options
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Options for dropdown list
	 * day 1-31
	 *
	 * @return array
	 */
	function days_options()
	{
		$day = 1; 
		
		while($day != 32)
		{
			//Add leading zero to month
			$x = sprintf("%02d", $day);
			
			$options[$x] = $x;
		
			$day ++; 
		}
		
		return $options;
		
	}
	
	// --------------------------------------------------------------------
	
	function budget_expenditures_options($e = '')
	{
		$this->load->model('budget_expenditure_m');
			
		$options  = array();
		
		$b = new Budget_expenditure_m();
		
		$expenditures = $b->order_by('expenditures')->get();
		
		$options[0] = '---ALL---';
		
		foreach($expenditures as $expenditure)
		{
			$options[$expenditure->id] = $expenditure->expenditures;
		}
		
		return $options;
		
	}
	
	
	// --------------------------------------------------------------------
	
	/**
	 * Options for dropdown list
	 * hour 01-24
	 *
	 * @return array
	 */
	function hour_options( $add_blank = FALSE)
	{
		$hour = 1; 
		
		if ( $add_blank == TRUE)
		{
			$options[0] = '';
		}
		
		while($hour != 25)
		{
			//Add leading zero to month
			$x = sprintf("%02d", $hour);
			
			$options[$x] = $x;
		
			$hour ++; 
		}
		
		return $options;
		
	}
	
	// --------------------------------------------------------------------
	
	function group_options($add_select = FALSE)
	{
		$options = array();
		
		$g = new Group_m();
		$g->order_by('name');
		$groups = $g->get();
		
		if ($add_select == TRUE)
		{
			$options[] = 'SELECT GROUP';	
		}
		
		foreach($groups as $group)
		{
			$options[$group->id] = $group->name;
		}
		
		return $options;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Options for leave type
	 *
	 * @param boolean $add_select
	 * @return array
	 */
	function leave_type_options($add_select = FALSE)
	{
		
		$leave_types = $this->Leave_type->leave_type_list();
		
		
		if ($add_select == TRUE)
		{
			$options[] = 'SELECT OFFICE';	
		}
		
		foreach($leave_types as $leave_type)
		{
			$options[$leave_type['id']] = $leave_type['leave_name'];
		}
		
		// Updated 3.1.2012 since version 2.00.00
		// add Undertime in type of leave
		// for laguna use
		
		$lgu_code = $this->Settings->get_selected_field('lgu_code'); 
		
		// Laguna Province
		if ( $lgu_code == 'laguna_province' )
		{
			$options['undertime'] = '-- Undertime --';
		}
		// end update
		
		return $options;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Options for month
	 *
	 * @param boolean $add_select
	 * @return array
	 */
	function month_options($add_select = FALSE)
	{
		$month = 1;
		
		while($month != 13)
		{
			//Add leading zero to month
			$x = sprintf("%02d", $month);
			
			$options[$x] = $this->Helps->get_month_name($month);
			
			$month ++;
		}
		
		return $options;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Options for office
	 *
	 * @param boolean $add_select
	 * @return array
	 */
	function office_options($add_select = FALSE)
	{
		$options = array();
		
		$this->Office->fields = array('office_id', 'office_name');
		
		$offices = $this->Office->get_offices();
		
		
		if ($add_select == TRUE)
		{
			$options[] = 'SELECT OFFICE';	
		}
		
		foreach($offices as $office)
		{
			$options[$office['office_id']] = $office['office_name'];
		}
		
		return $options;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Options for divisions
	 *
	 * @param boolean $add_select
	 * @return array
	 */
	function division_options($office_id = 1)
	{
		$options  = array();
		
		$d = new Division();
		
		$divisions = $d->where('office_id', $office_id)->order_by('order')->get();
						
		foreach($divisions as $division)
		{
			$options[$division->id] = $division->name;
		}
		
		return $options;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Options for salary grade
	 *
	 * @return array
	 */
	function salary_grade()
	{
		$x = 1;
		while($x != 31)
		{ 
			$sg_options[$x] = $x;
			$x++;
		}
		
		return $sg_options;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Options for shift
	 *
	 * @return array
	 */
	function shift()
	{
		$shifts = $this->Shift->shift_list();
	
		foreach($shifts as $shift)
		{
			$shifts_options[$shift['shift_id']] = $shift['name'];
		}
		//$shifts_options[0] = 'Other...';
		
		return $shifts_options;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Options for step
	 *
	 * @return array
	 */
	function step()
	{
		$x = 1;
		while($x != 9)
		{ 
			$step_options[$x] = $x;
			$x++;
		}
		
		return $step_options;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Options for type of employment
	 *
	 * @param boolean $all
	 * @return array
	 */
	function type_employment($all = FALSE)
	{
		if ($all == TRUE)
		{
			$type_employment['all'] = 'All';
		}	
		
		$type_employment['1'] = 'Permanent';
		$type_employment['2'] = 'Casual';
		$type_employment['3'] = 'Contract of Service';
		$type_employment['4'] = 'Job Order';
		$type_employment['5'] = 'Co Terminous';
		$type_employment['6'] = 'Elected Official';
		$type_employment['7'] = 'Temporary';
		$type_employment['8'] = 'Contractual Plantilla';
							
		return $type_employment;
	}
	
	// --------------------------------------------------------------------
	function training_type_options($training_type = '')
	{
		$this->load->model('training_type');
			
		$options  = array();
		
		$t = new Training_type();
		
		$types = $t->order_by('training_type')->get();
		
		$options[0] = '---ALL---';
		
		foreach($types as $type)
		{
			$options[$type->id] = $type->training_type;
		}
		
		return $options;
		
	}
	
	// --------------------------------------------------------------------
	function training_contact_type_options($training_type = '')
	{
		$this->load->model('training_contact_type');
			
		$options  = array();
		
		$t = new Training_contact_type();
		
		$types = $t->order_by('contact_type')->get();
		
		$options[0] = '---ALL---';
		
		foreach($types as $type)
		{
			$options[$type->id] = $type->contact_type;
		}
		
		return $options;
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Options for user type
	 *
	 * @return array
	 */
	function user_type()
	{
		$user_type = array(
							'1' => 'Super System Administrator',
							'2' => 'System Administrator',
							'3'	=> 'Time Keeper',
							'4'	=> 'OB Encoder',
							'5'	=> 'Leave Manager',
							'6' => 'Leave Administrator',
							'7' => 'Records Administrator',
							);
							
		// If leave training or hris training			
		if ( $this->config->item('active_apps') == 'leave_only' || $this->config->item('active_apps') == 'hris')
		{
			$user_type = array(
							
							'2' => 'System Administrator'
							);
		}
		
		return $user_type;
		
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Options for years. We need to specify the 
	 * start and end of the year for dropdown list
	 *
	 * @param int $start
	 * @param int $end
	 * @param boolean $add_select
	 * @return array
	 */
	function year_options($start = 2010, $end = 2020, $add_select = FALSE)
	{
		$year = $start;
		
		while($year <= $end)
		{
			$options[$year] = $year;
			
			$year ++;
		}
		
		return $options;
	}
	
	// --------------------------------------------------------------------
	
	
}

/* End of file options.php */
/* Location: ./application/models/options.php */