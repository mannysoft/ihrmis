<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Attendance Tracking and Leave Management System
 *
 * An Application Software use by Government agencies for management
 * of employees Attendance and Leave Administration.
 *
 * @package		ATLMS
 * @author		Manolito Isles
 * @copyright	Copyright (c) 2008 - 2012, Charliesoft
 * @license		http://charliesoft.com/atlms/user_guide/license.html
 * @link		http://charliesoft.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * ATLMS Conversion Table Class
 *
 * This class use for converting number of minutes late
 * to the corresponding equivalent to leave credits.
 *
 * @package		ATLMS
 * @subpackage	Models
 * @category	Models
 * @author		Manolito Isles
 * @link		http://charliesoft.com/atlms/user_guide/models/conversion_table.html
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