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
 * @copyright	Copyright (c) 2008 - 2012, Charliesoft
 * @license		http://charliesoft.net/hrmis/user_guide/license.html
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
class Tardiness extends CI_Model {

	// --------------------------------------------------------------------
	
	var $rows 			= array();
	var $num_rows 		= 0;
	var $minutes_tardy 	= 1;
	var $emps 			= array();
	var $offices_tardy 	= array();
	var $employees 		= array();
	var $fields 		= array();
	var $sem			= 1;
	var $ten_tardy_ids	= '';
	var $all_tardiness	= FALSE;
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Tardiness
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add tardiness time in seconds. Also add the date and and type of tardiness
	 *
	 * @param varchar $employee_id
	 * @param string $date
	 * @param int $log_type
	 * @param int $number_seconds
	 */
	function check_tardiness($employee_id, $date, $log_type, $number_seconds)
	{
		$data = array();
		
		$this->db->select('tardiness_id');
		$this->db->where('employee_id', $employee_id);
		$this->db->where('date', $date);
		$this->db->where('log_type', $log_type);
		$this->db->limit(1);
		
		$q = $this->db->get('tardiness');
		
		$office_id = $this->Employee->get_single_field('office_id', $employee_id);
		
		if ($q->num_rows() == 0)
		{
			$data = array(
                "employee_id" 	=> $employee_id,
				"office_id" 	=> $office_id,
				"log_type" 		=> $log_type,
				"date" 			=> $date,
				"seconds" 		=> $number_seconds
            );

			$this->db->insert('tardiness', $data);

		}
		else 
		{
			$data = array('seconds' => $number_seconds);

			$this->db->where('employee_id', $employee_id);
			$this->db->where('date', $date);
			$this->db->where('log_type', $log_type);
			$this->db->update('tardiness', $data); 
		}
	
		// delete if zero
		if ($number_seconds == 0) 
		{
			$this->delete_tardiness($employee_id, $date, $log_type);
			
		}
		
		return $data;
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Compute the late and undertime
	 * put 'late' if late and 'undertime' if undertime 
	 * in the parameter
	 *
	 * @param int $type
	 * @param mixed $employee_id
	 * @param int $month
	 * @param int $year
	 */
	function compute_late_undertime($type, $employee_id, $month, $year)
	{
		$data = array();
		
		$this->db->select('SUM(seconds) as number_seconds');
		$this->db->where('employee_id', $employee_id);
		$this->db->where('YEAR(date)', $year);
		$this->db->where('MONTH(date)', $month);
		
		// Late
		if ($type == 'late')
		{
			$this->db->where('(log_type = 1 OR log_type = 3)');
		}
		
		// Undertime
		if ($type == 'undertime')
		{
			$this->db->where('(log_type = 2 OR log_type = 4)');
		}
		
		$q = $this->db->get('tardiness');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['number_seconds'];
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Count tardiness
	 *
	 * @param varchar $employee_id
	 * @param int $month
	 * @param int $year
	 * @param int $type1
	 * @param int $type2
	 * @return array
	 */
	function count_late($employee_id, $month, $year, $type1, $type2)
	{
		$this->db->select('SUM(seconds) as number_seconds, COUNT(log_type) as tardi_count');
		$this->db->where('employee_id', $employee_id);
		$this->db->where('YEAR(date)', $year);
		$this->db->where('MONTH(date)', $month);
		$this->db->where("(log_type = '$type1' OR log_type = '$type2')");
		
		$q = $this->db->get('tardiness');
		//echo $this->db->last_query().'aaa<br>';
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				return $row;
			}
		}
		
		
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get and count the tardiness of each Employee per month(if any)
	 *
	 * @param varcher $employee_id
	 * @param int $month
	 * @param int $year
	 * @return unknown
	 */
	function count_tardiness($employee_id, $month, $year, $type1, $type2)
	{
		$is_undertime_tardi = $this->Settings->get_selected_field('undertime_tardi');
		
		$minutes_tardy = $this->Settings->get_selected_field('minutes_tardy');
		
		$data = array();
		
		$this->db->select('SUM(seconds) as number_seconds, COUNT(log_type) as tardi_count');
		$this->db->where('employee_id', $employee_id);
		$this->db->where('YEAR(date)', $year);
		$this->db->where('MONTH(date)', $month);
		$this->db->where("(log_type = '$type1' OR log_type = '$type2')");
	
		
		// Use for quezon(15 minutes interval)
		if($minutes_tardy != 1)
		{
			// If the log is for undertime
			if($type1 == 2 && $type2 == 4)
			{
				
			}
			else
			{
				$this->db->where('seconds >=', 960);
			}
		}
		
		// if undertime is not tardy(return nathing)
		if($is_undertime_tardi == 0 && $type1 == 2 && $type2 == 4)
		{
			return array();
		}
		
		$q = $this->db->get('tardiness');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row;
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete all tardiness by employee and cut off
	 *
	 * @param varchar $employee_id
	 * @param string $date_cutoff
	 */
	function delete_all_tardiness($employee_id, $date_cutoff)
	{
		$this->db->delete('tardiness', array('date' => $date_cutoff, 'employee_id'=> $employee_id)); 			
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete the tardiness if the tardiness has 
	 * data which is just added to tardiness accidentaly
	 *
	 * @param varchar $employee_id
	 * @param string $date
	 * @param int $log_type
	 */
	function delete_tardiness($employee_id, $date, $log_type)
	{
		if ($log_type == 0)
		{			
			$this->db->delete('tardiness', array('employee_id' => $employee_id, 'date' => $date)); 			
		}			
	}
	
	// --------------------------------------------------------------------
	
	function delete_zero_seconds()
	{
					
		$this->db->delete('tardiness', array('seconds' => 0));
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get daily tardy
	 *
	 * @param varchar $employee_id
	 * @param string $date1
	 * @param string $date2
	 * @return array
	 */
	function get_daily_tardy($employee_id, $date1, $date2)
	{
		$data = array();
		
		$this->db->select('date, seconds');
		$this->db->where("date BETWEEN '".$date1."' AND '".$date2."' ");
		$q = $this->db->get('tardiness');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[] = $row;	
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get list of all tardiness by one employee
	 *
	 * @param varchar $employee_id
	 * @param int $month
	 * @return array
	 */
	function get_employee_tardiness($employee_id, $month)
	{
		$data = array();
		
		$this->db->select('date, seconds');
		$this->db->where('employee_id', $employee_id);
		$q = $this->db->get('tardiness');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[] = $row;	
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all employees with late and undertime more than 
	 * or equal to 10 for particular month
	 * and year and office
	 *
	 * @param string $month
	 * @param string $month2
	 * @param int $year
	 * @param int $office_id
	 * @return array
	 */
	function get_employees_ten_tardy($month, $month2, $year, $office_id = '')
	{
		$info 			= array();
		
		$employees 		= array();
		
		$rows 			= array();
		
		$minutes_tardy 	= $this->Settings->get_selected_field('minutes_tardy');
		
		$last_month 	= $month2;
		$month1 		= $month;
		
		while($last_month >= $month1)
		{
			$months[] = $last_month;
			$last_month --;
		}
		
		sort($months);
		
		$ten_tardy_ids 	= array();
		
		$employee_ids 	= array();
		
		$offices 		= array();
		
		$employees 		= array();
		
		$info 			= array();
		
		foreach ($months as $m)
		{
			// Use for quezon(15 minutes interval)
			if($minutes_tardy != 1)
			{
				$this->db->where('seconds >=', 960);
			}
			
			if($office_id != '')
			{
				$this->db->where('office_id', $office_id);
			}
			
			// ============= For Late
			
			$this->db->where("date BETWEEN '".$year.'-'.$m."-1' AND '".$year.'-'.$m."-31'");
			$this->db->where("(log_type = 1 OR log_type = 3)");
			//$this->db->where("(log_type = 2 OR log_type = 4)");
			
			$this->db->select('employee_id, office_id, count( seconds ) as total_tardiness');
			$this->db->group_by('employee_id');
			
			// include all tardiness
			if ($this->all_tardiness == TRUE)
			{
				
			}
			else // include 10 tardiness only
			{
				$this->db->having('total_tardiness >= 10');
			}
			
			$q = $this->db->get('tardiness');
			
			//echo $this->db->last_query().'<br>';
			
			if ($q->num_rows() > 0)
			{
				foreach ($q->result_array() as $row)
				{
					// Check if the employee_id commit 10 times tardy for about two times 
					// in sem.
					if (in_array($row['employee_id'], $ten_tardy_ids))
					{
						
						// Add employee to array if not yet added
						// to prevent duplicate employee id
						if (!in_array($row['employee_id'], $employee_ids))
						{
							$office_id2 = $this->Employee->get_single_field('office_id', $row['employee_id']);
							
							if ($office_id2 != '')
							{
								$info[$office_id2][] = array(
												'employee_id' 	=> $row['employee_id'], 
												'office_id' 	=> $office_id2
												);
												
								$offices[] = $office_id2;
								
								$employees[] = 	$row['employee_id'];
							}
						
						}
						
						$employee_ids[] = $row['employee_id'];
											
					}
					
					$ten_tardy_ids[] = $row['employee_id'];
					
				}
			}
			
			
			
			
			// ============= for undertime
			
			$this->db->where("date BETWEEN '".$year.'-'.$m."-1' AND '".$year.'-'.$m."-31'");
			$this->db->where("(log_type = 2 OR log_type = 4)");
			
			$this->db->select('employee_id, office_id, count( seconds ) as total_tardiness');
			$this->db->group_by('employee_id');
			// include all tardiness
			if ($this->all_tardiness == TRUE)
			{
				
			}
			else // include 10 tardiness only
			{
				$this->db->having('total_tardiness >= 10');
			}
			$q = $this->db->get('tardiness');
			
			//echo $this->db->last_query().'<br>';
			
			if ($q->num_rows() > 0)
			{
				foreach ($q->result_array() as $row)
				{
					// Check if the employee_id commit 10 times tardy for about two times 
					// in sem.
					if (in_array($row['employee_id'], $ten_tardy_ids))
					{
						
						// Add employee to array if not yet added
						// to prevent duplicate employee id
						if (!in_array($row['employee_id'], $employee_ids))
						{
							$office_id2 = $this->Employee->get_single_field('office_id', $row['employee_id']);
							
							if ($office_id2 != '')
							{
								$info[$office_id2][] = array(
												'employee_id' 	=> $row['employee_id'], 
												'office_id' 	=> $office_id2
												);
												
								$offices[] = $office_id2;
								
								$employees[] = 	$row['employee_id'];
							}
						
						}
						
						$employee_ids[] = $row['employee_id'];
											
					}
					
					$ten_tardy_ids[] = $row['employee_id'];
					
				}
			}
			
			
			
		}
		
		$offices 	= array_unique($offices);
		
		$this->offices_tardy = $offices;
		
		$employees 	= array_unique($employees);
						
		$this->employees = $employees;
		
		// Use for 2nd sem tardy. Theres no need the 2 10 times.
		// 1 10 times tardy is enough for second offense.
		$ten_tardy_ids = array_unique($ten_tardy_ids);
		
		$this->ten_tardy_ids = $ten_tardy_ids;
		
		return $info;
		
		//echo '<pre>';
		//print_r($info);
		//echo '</pre>';
		
		$q->free_result();	
		
	}
	
	// --------------------------------------------------------------------
	
	 /**
	 * Get all employees with late and undertime for particular month
	 * and year and office
	 *
	 * @param int $month
	 * @param int $year
	 * @param int $office_id
	 * @return array
	 */
	function get_employees_with_tardy($month, $year, $office_id = '')
	{
		$rows = array();
		
		$employee_ids = array();
		
		$minutes_tardy = $this->Settings->get_selected_field('minutes_tardy');
		
		$this->db->select('DISTINCT(employee_id)');
		$this->db->where('YEAR(date)', $year);
		$this->db->where('MONTH(date)', $month);
		$this->db->where('office_id', $office_id);
	
		// Use for quezon(15 minutes interval)
		if($minutes_tardy != 1)
		{
			$this->db->where('seconds >=', 960);
		}	  
		
		$q = $this->db->get('tardiness');
		
		
		if ($q->num_rows() > 0)
		{
			
			foreach ($q->result_array() as $row)
			{	
				$employee_ids[] = $row['employee_id'];
			}
			
		}
		
		return $employee_ids;
		
		$q->free_result();	
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get offices with tardy
	 *
	 * @param int $month1
	 * @param int $month2
	 * @param int $year
	 * @return array
	 */
	function get_office_with_tardy($month1 = '01', $month2 = '12', $year = 2010)
	{
		$offices = array();
		
		$minutes_tardy = $this->Settings->get_selected_field('minutes_tardy');
		
		$this->db->select('office_id, employee_id, date, seconds');
		$this->db->where('YEAR(date)', $year);
		$this->db->where("MONTH(date) BETWEEN '$month1' AND '$month2'");
		
		// Use for quezon(15 minutes interval)
		if($minutes_tardy != 1)
		{
			$this->db->where('seconds >=', 960);
		}	 
		
		$q = $this->db->get('tardiness');
		
		if ($q->num_rows() > 0)
		{
			
			foreach ($q->result_array() as $row)
			{	
				$offices[] = $row['office_id'];
			}
			
		}
		
		$offices = array_unique($offices);
		
		return $offices;
		
		$q->free_result();	
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all tardiness
	 *
	 * @param string $date1
	 * @param string $date2
	 * @return array
	 */
	function get_tardiness($date1, $date2)
	{
		$data = array();
		
		$this->db->where("date BETWEEN '$date1' AND '$date2'");
		$q = $this->db->get('tardiness');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[] = $row;
			}
		}
		
		return $data;
		
		$q->free_result();	
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get total tardiness
	 *
	 * @param string $year_month_earn
	 * @param varchar $employee_id
	 * @return double
	 */
	function get_total_tardiness($year_month_earn, $employee_id)
	{
		$total_tard = 0;
		
		$this->db->select('SUM(seconds) AS total_tard');
		$this->db->where("CONCAT(YEAR(date),'-',MONTH(date)) = '$year_month_earn'");
		$this->db->where('employee_id', $employee_id);
		$q = $this->db->get('tardiness');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$total_tard = $row['total_tard'];
			}
		}
		
		return $total_tard;
		
		$q->free_result();	
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check if the employee reach 10x tardiness for the
	 * given month
	 *
	 * @param varchar $employee_id
	 * @param int $year
	 * @param int $month
	 * @param int $office_id
	 * @return boolean
	 */
	function is_ten_tardy($employee_id, $year, $month, $office_id)
	{
		$total_tard = 0;
		
		$this->db->select('COUNT(tardiness_id) as total_tard');
		$this->db->where('YEAR(date)', $year);
		$this->db->where('MONTH(date)', $month);
		$this->db->where('employee_id', $employee_id);
		
		if ($office_id != '') 
		{
			$this->db->where('office_id', $office_id);
		}
		
		$q = $this->db->get('tardiness');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$total_tard = $row['total_tard'];
			}
			
		}
		
		if ($total_tard >= 10) 
		{
			return  TRUE;
		}
		else 
		{
			return FALSE;
		}
		
		
		$q->free_result();	
		
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check if tardy is zero
	 *
	 * @param int $tardy_count
	 * @return unknown
	 */
	function is_tardy_zero($tardy_count)
	{
		if ($tardy_count == 0)
		{
			return '';
		}
		else
		{
			return $tardy_count;
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set the minutes of tardy
	 *
	 * @param unknown_type $minutes_tardy
	 */
	function set_minutes_tardy($minutes_tardy)
	{
		$this->minutes_tardy = $minutes_tardy;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get total tardiness by employee
	 *
	 * @param string $date
	 * @param int $employee_id
	 * @return double
	 */
	function total_tardiness($date, $employee_id = '')
	{
		$total_tard = 0;
		
		$this->db->select('SUM(seconds) AS total_tard');
		$this->db->where("CONCAT(YEAR(date),'-',MONTH(date)) = '$date'");
		$this->db->where('employee_id', $employee_id);
		$q = $this->db->get('tardiness');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$total_tard = $row['total_tard'];
			}
			
		}
		
		return $total_tard;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Total tardiness in seconds
	 *
	 * @param varchar $employee_id
	 * @return doule
	 */
	function total_tardy_seconds($employee_id)
	{
		
		$total_tard = 0;
		
		$this->db->select('SUM(seconds) AS total_tard');
		$this->db->where('employee_id', $employee_id);
		$q = $this->db->get('tardiness');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$total_tard = $row['total_tard'];
			}
			
		}
		
		
		return $total_tard;
		
		$q->free_result();
	}
	
	
}

/* End of file tardiness.php */
/* Location: ./application/models/tardiness.php */