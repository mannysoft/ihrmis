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
class Conversion_table extends CI_Model {
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Conversion_table
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
		$q = $this->db->get('conversion_table');
		
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
		
		if ( $no_days == 0)
		{
			//echo 'wow';
			//return $data;
		}
		
		$this->db->select('leave_earned');
		$this->db->where('day', $no_days);
		$this->db->limit(1, 0);
		$q = $this->db->get('conversion_table');
		
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
		switch($hours)
		{
			case 0:
			$day = 0.000;
			break;
			
			case 1:
			$day = 0.125;
			break;
			
			case 2:
			$day = 0.250;
			break;
			
			case 3:
			$day = 0.375;
			break;
			
			case 4:
			$day = 0.500;
			break;
			
			case 5:
			$day = 0.625;
			break;
			
			case 6:
			$day = 0.750;
			break;
			
			case 7:
			$day = 0.875;
			break;
			
			case 8:
			$day = 1.000;
			break;
		}
		
		return $day;
	}

}

/* End of file conversion_table.php */
/* Location: ./application/models/conversion_table.php */