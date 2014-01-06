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
class Leave_conversion_table extends CI_Model {
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Leave_conversion_table
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Compute the equivalent to leave credits
	 *
	 * @since 	Version 1.0
	 * @param 	integer $seconds
	 * @return 	double
	 */
	function compute_hour_minute($seconds)
	{ 
	    $equivalent_day = 0;
		
		$hours = 0;
		
		$days = 0;
		
		$minute_remain = 0;
		
		if ($seconds/60 >=1)
	    { 
			$minutes 		= $seconds/60; 
			
			$minute_remain 	= $seconds/60; 
			
			if ($minutes/60 >= 1) 
			{ # Hours 
		
				$hours = floor($minutes/60); 
				
				$minute_remain = $minutes % 60; 
			
			} #end of Hours 
			
			$days = 0;
			
			if (($hours/8) > 1)
			{
				$days = floor($hours/8);
				
				$hours_remain = $hours % 8; 
				
				$hours = $hours_remain;
				
			}
		
	    } #end of minutes 
		
		//Equivalent if more than 60 minutes
		$day = $this->get_days_equivalent($hours);
		
		$day = $day + $days;
		
		$data = array();
		
		$this->db->select('equivalent_day');
		$this->db->where('minutes', $minute_remain);
		$this->db->limit(1, 0);
		$q = $this->db->get('leave_conversion_table');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$equivalent_day = $row['equivalent_day'];
			}
		}
		
		return number_format($equivalent_day + $day, 3);
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the equivalent days in the conversion table
	 *
	 * @since 	Version 1.0
	 * @param 	integer $no_days
	 * @return 	double
	 */
	function days_equivalent($no_days)
	{
		$data = 0;
		
		$this->db->select('leave_earned');
		$this->db->where('day', $no_days);
		$this->db->limit(1, 0);
		$q = $this->db->get('leave_conversion_table');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['leave_earned'];
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Return equivalent day(s) 
 	 *
 	 * @since 	Version 1.0
	 * @param 	int $hours
	 * @return 	double
	 */
	function get_days_equivalent($hours)
	{
		return number_format($hours * 0.125, 3);
	}

}

/* End of file conversion_table.php */
/* Location: ./application/models/conversion_table.php */