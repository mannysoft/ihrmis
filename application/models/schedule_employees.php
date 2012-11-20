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
 * @author		Manny Isles
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
 * @author		Manny Isles
 * @link		http://charliesoft.net/hrmis/user_guide/models/conversion_table.html
 */
class Schedule_employees extends CI_Model {

	// --------------------------------------------------------------------
	
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	function is_schedule_exists($employee_id, $date)
	{
		$data = array();
		
		$this->db->limit(1);
		
		$this->db->where('employee_id', $employee_id);
		$this->db->where('date', $date);
		
		$q = $this->db->get('schedule_employees');
		
		if ($q->num_rows() > 0)
		{
			return TRUE;
		}
		
		else
		{
			return FALSE;	
		}
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	function insert_blank_schedule($office_id, $employee_id, $date)
	{
		$data = array(
			'office_id' 	=> $office_id, 
			'employee_id' 	=> $employee_id, 
			'date' 			=> $date
			);
		$this->db->insert('schedule_employees', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get schedule by offices and range of date
	 *
	 * @param int $office_id
	 * @param string(date) $date
	 * @param string(date) $date2
	 * @param varchar $employee_id
	 * @param bool $flex
	 * @return array
	 */
	function get_office_schedule($office_id, $date, $date2 = '', $employee_id = '', $flex = '')
	{
		$data = array();
		$rows = array();
		
		$this->Employee->fields = array('employee_id', 'office_id');
		
		// Get employees which is shifting
		$employees = $this->Employee->get_employee_shifting($office_id);
		
		$days = $this->Helps->get_days_in_between($date, $date2);
		
		// If uses for single employee only
		if ($employee_id != '')
		{
			$employees = array(array('employee_id' => $employee_id));
		}
	
		// Add new schedule if this is blank
		foreach ($employees as $employee)
		{
			$office_id2 = $this->Employee->get_single_field('office_id', $employee['employee_id']);
			
			foreach ($days as $day)
			{				
				// Insert to schedule if the log_date and employee id
				// is not in the schedule table

				$is_log_date_exists = $this->is_schedule_exists($employee['employee_id'], $day);
				
				
				
				if ($is_log_date_exists == FALSE)
				{
					// Insert blank schedule
					$this->insert_blank_schedule($office_id2, $employee['employee_id'], $day);
				}
				
			}
			
		}
		
		$this->db->select('schedule_employees.id, 
						   schedule_employees.employee_id,
						   schedule_employees.date, 
						   schedule_employees.hour_from,
						   schedule_employees.hour_to, 
						   schedule_employees.am_in, 
						   schedule_employees.am_out, 
						   schedule_employees.pm_in, 
						   schedule_employees.pm_out, 
						   schedule_employees.shift_type, 
						   schedule_employees.office_id, 
						   employee.lname,  
						   employee.fname,
						   employee.shift_type');
		$this->db->from('schedule_employees');
		$this->db->join('employee', 'schedule_employees.employee_id = employee.employee_id');
		$this->db->where('employee.office_id', $office_id);
		$this->db->where("schedule_employees.date BETWEEN '$date' AND '$date2'");
		//$this->db->order_by('employee.lname, employee.fname, dtr.log_date');
		$q = $this->db->get();
		
		// If uses for single employee only
		if ($employee_id != '')
		{
			$this->db->select('schedule_employees.id, 
							   schedule_employees.employee_id,
							   schedule_employees.date, 
							   schedule_employees.hour_from,
							   schedule_employees.hour_to, 
							   schedule_employees.am_in, 
						   	   schedule_employees.am_out, 
						  	   schedule_employees.pm_in, 
						  	   schedule_employees.pm_out, 
							   schedule_employees.shift_type, 
							   schedule_employees.office_id, 
							   employee.lname,  
							   employee.fname,
							   employee.shift_type');
			$this->db->from('schedule_employees');
			$this->db->join('employee', 'schedule_employees.employee_id = employee.employee_id');
			$this->db->where('schedule_employees.employee_id', $employee_id);
			$this->db->where("schedule_employees.date BETWEEN '$date' AND '$date2'");
			$this->db->order_by('schedule_employees.date');
			
			$q = $this->db->get();
		}
		
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
	
	function get_schedule($employee_id, $date = '')
	{
		$data = array();
		
		$this->db->limit(1);
		
		$this->db->where('employee_id', $employee_id);
		
		if ( $date != '')
		{
			$this->db->where('date', $date);
		}
		
		$q = $this->db->get('schedule_employees');
		
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
	 * Update the Schedule
	 *
	 * @param string $field
	 * @param string(time) $value
	 * @param int $id
	 */
	function update_schedule($field, $value = '', $id)
	{
		$data = array($field => $value);

		$this->db->where('id', $id);
		$this->db->update('schedule_employees', $data); 
		
	}
	
	function update( $data , $date = '', $employee_id = '')
	{
		$this->db->where('date', $date);
		$this->db->where('employee_id', $employee_id);
		$this->db->update('schedule_employees', $data);
	}
	
	function insert( $data )
	{
		$this->db->insert('schedule_employees', $data);
	}
	
	
}

/* End of file schedule.php */
/* Location: ./application/models/schedule.php */