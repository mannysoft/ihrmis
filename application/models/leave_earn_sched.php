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
class Leave_earn_sched extends CI_Model {

	// --------------------------------------------------------------------
	
	public $leave_earning;
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Leave_earn_sched
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	
	/**
	 * This is for scheduling of leave earnings.
	 * This will move backward to record to check the 
	 * month and year of the previous record
	 *
	 * @param string $month
	 * @param string $year
	 * @return int
	 */
	function get_previous_month($month, $year)
	{
		
		
		$this->db->select('id');
		$this->db->where('month', $month);
		$this->db->where('year', $year);
		
		$q = $this->db->get('leave_earn_sched', 1);
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$id = $row['id'];
			}
		}
		
		$id--;
		
		return $id;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Tells wheter a leave earnings on previous 
	 * month was not performed
	 *
	 * @param string(date) $month
	 * @param string(year) $year
	 * @return boolean
	 */
	function is_earned_missed($month, $year)
	{
		$date = '';
		
		// Get the previous month id
		$id = $this->get_previous_month($month, $year);
		
		// check if the settings is set to 15/30 for the earning of leave
		// much better if set to configuration class
		$leave_earn =  Setting::getField('leave_earn');
		
		if ($leave_earn == 15)
		{
			//$leave_earning[] = 15;
			
			// For previous month (15th)
			// If the value of column done is zero then the 
			// leave earning is not performed yet
			
			$this->db->where('id', $id);
			$this->db->where('done', 0);
			$this->db->order_by('id', 'DESC');
			$q = $this->db->get('leave_earn_sched', 1);
			
			
			if ($q->num_rows() > 0)
			{
				foreach ($q->result_array() as $row)
				{
					$leave_earning = array(
										'leave_earn' => 15, 
										'month' 	 => $row['month'], 
										'year'		 => $row['year']
										);
										
					return $leave_earning;					
				}
			}
			
			// for previous month (30th)
			
			$this->db->where('id', $id);
			$this->db->where('done2', 0);
			$this->db->order_by('id', 'DESC');
			$q = $this->db->get('leave_earn_sched', 1);
			
			
			if ($q->num_rows() > 0)
			{
				foreach ($q->result_array() as $row)
				{
					$leave_earning = array(
										'leave_earn' => 30, 
										'month' 	 => $row['month'], 
										'year'		 => $row['year']
										);
										
					return $leave_earning;					
				}
			}
			
			// if the date is greater than 15th //for current month (15th)
			if (date('d') > 15)
			{
				
				$this->db->where('id', $id + 1);
				$this->db->where('done', 0);
				$this->db->order_by('id', 'DESC');
				$q = $this->db->get('leave_earn_sched', 1);
				
				
				if ($q->num_rows() > 0)
				{
					foreach ($q->result_array() as $row)
					{
						$leave_earning = array(
											'leave_earn' => 15, 
											'month' 	 => $row['month'], 
											'year'		 => $row['year']
											);
											
						return $leave_earning;					
					}
				}

			}
			
		}
		
		//$date[0] = 30;
		
		$this->db->where('id', $id);
		$this->db->where('done', 0);
		//$this->db->order_by('id', 'DESC');
		
		$q = $this->db->get('leave_earn_sched', 1);
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$date['month'] 		= $row['month'];
				$date['year'] 		= $row['year'];
				$date['leave_earn'] = $leave_earn;
			}
		}
	
		return $date;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Tells whether the leave earning have performed for the month
	 * and year specified
	 *
	 * @param int $month
	 * @param int $year
	 * @return boolean
	 */
	function is_leave_month_earned($month, $year)
	{
		
		$this->db->select('id');
		$this->db->where('month', $month);
		$this->db->where('year', $year);
		$this->db->where('done', 1);
		$q = $this->db->get('leave_earn_sched');
		
		if ($q->num_rows() == 0)
		{
			return FALSE;
		}
		else 
		{
			return TRUE;
		}
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set the leave earnings to done
	 *
	 * @param int $month
	 * @param int $year
	 */
	function set_done($month, $year, $done)
	{
		// Set to done
		$data = array($done => 1);

		$this->db->where('month', $month);
		$this->db->where('year', $year);
		$this->db->update('leave_earn_sched', $data); 
	}

}

/* End of file leave_earn_sched.php */
/* Location: ./application/models/leave_earn_sched.php */