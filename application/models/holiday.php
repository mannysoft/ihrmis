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
class Holiday extends CI_Model{

	// --------------------------------------------------------------------
	
	public $fields 		= array();
	public $date		= '';
	public $half_day 	= FALSE;
	public $am_pm		= 'pm';
	
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add holiday
	 *
	 * @param array $data
	 * @return unknown
	 */
	function add_holiday($data)
	{
		$this->db->insert('holiday', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete holiday
	 *
	 * @param int $id
	 */
	function delete_holiday($id)
	{
		$this->db->delete('holiday', array('id' => $id)); 
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * List all holiday by year
	 *
	 * @param string $year
	 * @return array
	 */
	function holiday_list($year)
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		$this->db->where('YEAR(date)', $year);
		$this->db->order_by('date');
		$q = $this->db->get('holiday');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[]  = $row;
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the name of holiday
	 *
	 * @param string $date
	 * @return string
	 */
	function holiday_name($date)
	{
		$data = array();
		
		$this->db->where('date', $date);
		$this->db->limit(1);
		$q = $this->db->get('holiday');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['description'];
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Tells whether the date is holiday
	 *
	 * @param string $date
	 * @return boolean
	 */
	function is_holiday($date)
	{
		$this->db->where('date', $date);
		
		$q = $this->db->get('holiday');
		
		if ($q->num_rows() > 0)
		{
			// Lets check if half day
			$this->is_holiday_half($date);
			
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	function is_holiday_half($date = '')
	{
		$half_day = 'no';
		
		$this->db->where('date', $date);
		
		$this->db->limit(1);
		
		$q = $this->db->get('holiday');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				if ($row['half_day'] == 'yes')
				{
					$this->half_day = TRUE;
				}
				
				$this->am_pm = $row['am_pm'];
			}
		}
				
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	function count_working_days($date1 = '2012-11-01', $date2 = '2012-11-15')
	{
		$count = 0;
		
		$days = $this->Helps->get_days_in_between($date1, $date2);
		
		foreach ($days as $date)
		{
			
			list($year, $month, $day) = explode('-', $date);
			
			$is_sat_sun = $this->Helps->is_sat_sun($month, $day, $year);
			
			if ($this->is_holiday($date) or $is_sat_sun == 'Saturday' or $is_sat_sun == 'Sunday')
			{
				
			}
			else
			{
				$count ++;
			}
		}
		
		return $count;
	}
	
	// --------------------------------------------------------------------
}

/* End of file holiday.php */
/* Location: ./application/models/holiday.php */