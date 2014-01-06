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
 * iHRMIS Dtr Class
 *
 * This class use for getting dtr date and printing of dtr.
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/models/dtr.html
 */
class Dtr extends CI_Model {
	
	// --------------------------------------------------------------------
	
	public $fields 	= array();	// Fields in the table dtr that needs to be selected
	public $is_pm_in12 = FALSE;
	public $double_incomplete = FALSE;
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor.
	 * 
	 * Load and initialized all default class variable.
	 * Check if the table is updated to version of source code
	 * installed.
	 *
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Cancel the CTO.
	 * 
	 *
	 * @since 	Version 1.7
	 * @param 	int $compensatory_timeoff_id
	 * @param 	varchar $employee_id Employee ID/Number
	 * @return 	void
	 */
	function cancel_cto($compensatory_timeoff_id, $employee_id)
	{
		$this->db->delete('dtr', array('compensatory_timeoff_id' => $compensatory_timeoff_id));
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Cancel the leave.
	 * 
	 * This function deletes the entries of leave of 
	 * employees. Removes the entries from manual_log table.
	 * This function change the entries of leave card to
	 * Cancelled as per CSC law and rules if the leave was cancelled
	 * using cancel by csc and Cancelled as per request approved by the CPO
	 * if cancelled by cpo
	 *
	 * @since 	Version 1.0
	 * @param 	int $manual_log_id manual log id
	 * @param 	varchar $employee_id Employee ID/Number
	 * @param 	int $csc Cancelled as per CSC law and rules
	 * @param 	int $cpo Cancelled as per request approved by the CPO
	 * @return 	void
	 */
	function cancel_leave($manual_log_id, $employee_id, $csc = '', $cpo = '')
	{
		// Do if regular delete
		if ($csc == '' && $cpo == '')
		{
			$this->db->delete('dtr', array('manual_log_id' => $manual_log_id));
						
			$this->db->delete('manual_log', array('id' => $manual_log_id));
			
			$this->db->delete('leave_card', array('manual_log_id' => $manual_log_id));
		}
		
		// If cancel as per CSC rules and law
		if ($csc == 1)
		{
			$this->db->delete('dtr', array('manual_log_id' => $manual_log_id));
			
			$data = array(
						'v_abs' 		=> 0,
						's_abs' 		=> 0,
						'action_take' 	=> '<b>Cancelled as per CSC law and rules</b>'
						);

			$this->db->where('manual_log_id', $manual_log_id);						
			$this->db->update('leave_card', $data);			
		}
		
		// If cancel as per CPO rules and law
		if ($cpo == 1)
		{
			$this->db->delete('dtr', array('manual_log_id' => $manual_log_id));
			
			$data = array(
						'v_abs' 		=> 0,
						's_abs' 		=> 0,
						'action_take' 	=> '<b>Cancelled as per request approved by the CPO</b>'
						);

			$this->db->where('manual_log_id', $manual_log_id);						
			$this->db->update('leave_card', $data);			
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the date for tomorrow
	 *
	 * @since 	Version 1.0
	 * @param 	string(date) $log_date
	 * @param 	varchar $employee_id
	 * @return 	date(string)
	 */
	function date_tom($log_date, $employee_id)
	{
		$data = array(
					'am_login' 	=> '',
					'am_logout' => '',
					'pm_login' 	=> '',
					'pm_logout' => '', 
					'log_date' 	=> ''
					);
		
		$this->db->select('am_login, am_logout, pm_login, pm_logout, log_date');
		$this->db->where('log_date = ADDDATE('.'"'.$log_date.'"'.', 1)');
		$this->db->where('employee_id', $employee_id); 
		$q = $this->db->get('dtr', 1);
		
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
	 * Delete entries in DTR by date and employee number
	 *
	 * @since Version 1.0
	 * @param varchar $employee_id
	 * @param string(date) $date
	 * @return void
	 */
	function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('dtr');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete entries in DTR by date and employee number
	 *
	 * @since Version 1.0
	 * @param varchar $employee_id
	 * @param string(date) $date
	 * @return void
	 */
	function delete_dtr($employee_id, $date)
	{
		$this->db->where('employee_id', $employee_id);
		$this->db->where('log_date', $date);
		$this->db->delete('dtr');
	}
	
	// --------------------------------------------------------------------
	function double_entries($month, $year)
	{	
		$data = array();
		
		$from = $year.'-'.$month.'-01';
		$to = $year.'-'.$month.'-31';
		
		$this->db->select('employee_id, log_date, COUNT( * )');
		
		$this->db->group_by('employee_id, log_date'); 
		$this->db->having("COUNT( * ) > 1 and log_date BETWEEN '$from' AND '$to'");
		
		$q = $this->db->get('dtr');
				
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
	
	function double_entries_employee($employee_id, $log_date)
	{	
		$data = array();
				
		$this->db->where('employee_id', $employee_id); 
		$this->db->where('log_date', $log_date); 
		
		$q = $this->db->get('dtr', 2);
				
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
	 * Edit DTR by employee number and date
	 *
	 * @since Version 1.0
	 * @param array $data
	 * @param varchar $employee_id
	 * @param mixed $log_date
	 * @return void
	 */
	function edit_dtr($data, $employee_id, $log_date)
	{
		$this->db->where('employee_id', $employee_id);
		$this->db->where('log_date', $log_date);
		$this->db->update('dtr', $data); 
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the DTR of Employee by range of dates
	 *
	 * @since Version 1.0
	 * @param string(date) $between_from
	 * @param string(date) $between_to
	 * @param varchar $employee_id
	 * @return array
	 */
	function employee_dtr($between_from, $between_to, $employee_id)
	{	
		$data = array();
		
		$this->db->select($this->fields);
		
		$where = "log_date BETWEEN '$between_from' AND '$between_to'";
		$this->db->where($where);
		$this->db->where('employee_id', $employee_id);
		$this->db->order_by("log_date"); 
		$q = $this->db->get('dtr');
		
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
	 * Get list of absent employees for specified date
	 *
	 * @since Version 1.0
	 * @param int $office_id
	 * @param string $log_date
	 * @return array
	 */
	function get_absences($office_id, $log_date)
	{
		$data = array();
		
		$this->db->select('employee_id');
		$this->db->where('log_date', $log_date);
		$this->db->where('office_id', $office_id);
		$this->db->where('am_login', '');
		
		$q = $this->db->get('dtr');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[] = $row['employee_id'];
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the dates to be delete
	 *
	 * @since Version 1.0
	 * @param varchar $employee_id
	 * @param string(date) $date_start
	 * @param string(date) $date_end
	 * @param string $year
	 * @param string $month
	 * @return array
	 */
	function get_blank_dates($employee_id, $date_start, $date_end, $year, $month)
	{
		$delete_dates = array();
		
		for ($i = $date_start; $i <= $date_end; $i++ )
		{
		
			$this->db->select('employee_id');
			$this->db->where('employee_id', $employee_id);
			$this->db->where('log_date', $year.'-'.$month.'-'.$i);
			$q = $this->db->get('dtr');
						
			if ($q->num_rows() == 0)
			{
				//INSERT
				$data = array(
               				'employee_id' => $employee_id,
               				'log_date' 	  => $year.'-'.$month.'-'.$i
							);

				$this->db->insert('dtr', $data);
				
				$delete_dates[] = $year.'-'.$month.'-'.$i;
			}
		}
		
		return $delete_dates;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the days and time worked by contractual employees
	 *
	 * @since Version 1.0
	 * @param varchar $employee_id
	 * @param string $month
	 * @param string $year
	 * @param string $from
	 * @param string $to
	 * @return double
	 */
	function get_contractual_work($employee_id, $month, $year, $from, $to)
	{
		
		$between_from = $year.'-'.$month.'-'.$from;
		$between_to   = $year.'-'.$month.'-'.$to;
		
		$add = 0;
		
		$days = 0;
		
		$rows = $this->employee_dtr($between_from, $between_to, $employee_id);
		
		foreach ($rows as $row)
		{
			$am_login 	= $row['am_login'];
			$am_logout 	= $row['am_logout'];
			$pm_login 	= $row['pm_login'];
			$pm_logout 	= $row['pm_logout'];
			
			$ot_login 	= $row['ot_login'];
			$ot_logout 	= $row['ot_logout'];
			
			// Do compute if employee attend whole day
			if ($am_login !="" && $pm_logout !="")
			{
				$add =1;
			}
			
			//If halfday(morning) and no log on PM
			if($am_login !="" && $am_logout !="" && $pm_login =="" && $pm_logout =="")
			{
				$add = 0.5;
			}
			
			//If halfday(afternoon) and no log on AM
			if($am_login =="" && $am_logout =="" && $pm_login !="" && $pm_logout !="")
			{
				$add = 0.5;
			}
			
			
			//If whole day with logs with all
			if($am_login !="" && $am_logout !="" && $pm_login !="" && $pm_logout !="")
			{
				$add = 1;
			}
			
			//If whole day 10pm-6am
			if($am_login =="" && $am_logout !="" && $pm_login !="" && $pm_logout =="")
			{
				$add = 1;
			}
			
			//elseif ($amLogin !="" )
			
			$days += $add;
		}
		
		return $days;
	}
	
	// --------------------------------------------------------------------
	
	
	/**
	 * Get dtr depending on the date specified
	 *
	 * @since Version 1.0
	 * @param mixed $date
	 * @return array
	 */
	function get_dtr($date)
	{
		$data = array();
		
		$this->db->where('log_date', $date);
				
		$q = $this->db->get('dtr');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[] = array($row, 'struct');
			}
		}
	
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the details about the dtr entry
	 *
	 * @since Version 1.0
	 * @param int $id
	 * @return array
	 */
	function get_dtr_details($id = '')
	{	
		$data = array();
		
		$this->db->select($this->fields);
		
		$this->db->where('id', $id);
		$q = $this->db->get('dtr', 1);
		
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
	 * Get DTR in range of dates
	 *
	 * @since Version 1.0
	 * @param string $date1
	 * @param string $date2
	 * @param boolean $web_service
	 * @return array
	 */
	function get_dtr_range($date1, $date2, $web_service = FALSE)
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		$where = "log_date BETWEEN '$date1' AND '$date2'";
		$this->db->order_by('log_date');
		$this->db->where($where);
		$q = $this->db->get('dtr');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[]  = $row;
				
				$data_web_service[] = array($row, 'struct'); //use this for web services
				
				//$this->xml_output[] = $row; use this for web services
			}
		}
		
		// Use for web services
		if ($web_service == TRUE)
		{
			return $data_web_service;
		}
		
		return $data;
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get list of late employee for date specified.
	 * We only use this for 8-5 schedule and need to be fit
	 * for other shifting schedule
	 *
	 * @since 	Version 1.0
	 * @todo 	This is not a final for this method.
	 * @param 	int $office_id
	 * @param 	string $date
	 * @param 	boolean $is_log_pm
	 * @return 	array
	 */
	function get_late_employee($office_id, $date, $is_log_pm)
	{
		$data = array();
		
		$this->db->select($this->fields);
			
		$this->db->where('office_id', $office_id);
		$this->db->where('am_login >', '08:00');
		$this->db->where('log_date', $date);
		$this->db->where('am_login !=', 'Official Business');
		$this->db->where('am_login !=', 'Leave');
		$this->db->where('am_login !=', 'CTO');
		$q = $this->db->get('dtr');
		
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
	 * Just get the manual log id
	 *
	 * @since Version 1.0
	 * @param int $id
	 * @return int
	 */
	function get_manual_log_id($id)
	{
		$data = array();
		
		$manual_log_id = '';
			
		$this->db->select('manual_log_id');
		$this->db->where('id', $id);
		$q = $this->db->get('dtr');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$manual_log_id  = $row['manual_log_id'];
			}
		}
		
		return $manual_log_id;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get Official Business Employees for specified date
	 *
	 * @since Version 1.0
	 * @param int $office_id
	 * @param string $date
	 * @return array
	 */
	function get_ob_employee($office_id, $date)
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		$this->db->where('office_id', $office_id);
		$this->db->where('am_login', 'Official Business');
		$this->db->where('log_date', $date);
		$q = $this->db->get('dtr');
		
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
	 * Get DTR by offices and range of date
	 *
	 * @since Version 1.0
	 * @param int $office_id
	 * @param string(date) $date
	 * @param string(date) $date2
	 * @param varchar $employee_id
	 * @param bool $flex
	 * @return array
	 */
	function get_office_dtr($office_id, $date, $date2 = '', $employee_id = '', $flex = '')
	{
		$data = array();
		$rows = array();
		
		$this->Employee->fields = array('employee_id', 'office_id');
		
		$employees = $this->Employee->get_employee_list($office_id, '');
		
		$days = $this->Helps->get_days_in_between($date, $date2);
		
		// If uses for single employee only
		if ($employee_id != '')
		{
			$employees = array(array('employee_id' => $employee_id));
		}
	
		// Add new dates in the view dtr even if this is blank
		foreach ($employees as $employee)
		{
			$office_id2 = $this->Employee->get_single_field('office_id', $employee['employee_id']);
			
			foreach ($days as $day)
			{				
				// Insert to dtr if the log_date and employee id
				// is not in the dtr table
				
				$is_log_date_exists = $this->is_log_date_exists($employee['employee_id'], $day);
								
				if ($is_log_date_exists === FALSE)
				{
					// Insert blank dtr
					$this->insert_blank_dtr($office_id2, $employee['employee_id'], $day);
				}
				
			}
			
		}		
		
		$this->db->select('dtr.id, 
						   dtr.employee_id, 
						   dtr.am_login,
						   dtr.am_logout, 
						   dtr.pm_login, 
						   dtr.pm_logout, 
						   dtr.ot_login, 
						   dtr.ot_logout, 
						   dtr.log_date, 
						   dtr.manual_log_id, 
						   dtr.office_id, 
						   dtr.orig_dtr, 
						   employee.lname,  
						   employee.fname,
						   employee.shift_type');
		$this->db->from('dtr');
		$this->db->join('employee', 'dtr.employee_id = employee.employee_id');
		//$this->db->where('dtr.employee_id', $employee_id);
		
		// 
		if ($this->double_incomplete == FALSE)
		{
			$this->db->where('employee.office_id', $office_id);
		}
		
		$this->db->where("dtr.log_date BETWEEN '$date' AND '$date2'");
		
		if ($this->double_incomplete == TRUE)
		{
			// Get offices(internal)
			$o = new Office_m();
			$o->where('office_location', 'internal');
			$offices = $o->get();
			
			foreach ($offices as $office)
			{
				$off[] = $office->office_id;
			}
			
			$this->db->where_in('employee.office_id', $off);
			
			$this->db->where("(ats_dtr.am_login = '' OR `ats_dtr`.`pm_login` = '' OR `ats_dtr`.`am_logout` = '' OR `ats_dtr`.`pm_logout` = '')");
		}
		
		$this->db->order_by('dtr.office_id, employee.lname, employee.fname, dtr.log_date');
		
		$q = $this->db->get();
		
		//echo $this->db->last_query();
		
		// GSO LAGUNA
		// ORDER BY ".TABLEPREF."dtr.am_login, ".TABLEPREF."employee.lname";
		// $this->db->order_by('dtr.am_login, employee.lname');
		
		
		// If uses for single employee only
		if ($employee_id != '')
		{
			$this->db->select('dtr.id, 
							   dtr.employee_id, 
							   dtr.am_login,
							   dtr.am_logout, 
							   dtr.pm_login, 
							   dtr.pm_logout, 
							   dtr.ot_login, 
							   dtr.ot_logout, 
							   dtr.log_date, 
							   dtr.manual_log_id, 
							   dtr.office_id, 
							   dtr.orig_dtr, 
							   employee.lname,  
							   employee.fname,
							   employee.shift_type');
			$this->db->from('dtr');
			$this->db->join('employee', 'dtr.employee_id = employee.employee_id');
			$this->db->where('dtr.employee_id', $employee_id);
			$this->db->where("dtr.log_date BETWEEN '$date' AND '$date2'");
			$this->db->order_by('dtr.log_date');
			
			$q = $this->db->get();
			
			// Check what type of user is logged
			// If leave manager
			$this->load->library('session');
			
			if ( Session::get('user_type') == 5)
  			{
				// If the office is not equal to office id of user logged
				if (Session::get('office_id') != $employee['office_id'])
				{
					//echo '<font color="red">You are not allowed to view this records!</font>';
					//return ;
					$this->db->where('id', 0);
					$q = $this->db->get('dtr');
				}
				
			}
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
	
	/**
	 * Just insert blank dates
	 *
	 * @since Version 1.0
	 * @param int $office_id
	 * @param varchar $employee_id
	 * @param string $log_date
	 * @return void
	 */
	function insert_blank_dtr($office_id, $employee_id, $log_date)
	{
		$data = array(
               'office_id' 		=> $office_id,
               'employee_id' 	=> $employee_id,
               'log_date' 		=> $log_date
            );
		
		
		if ($this->is_log_date_exists($employee_id, $log_date) === FALSE)
		{
			$this->db->insert('dtr', $data);
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Insert compensatory time off
	 *
	 * @since Version 1.0
	 * @param string $field
	 * @param string $field2
	 * @param varchar $employee_id
	 * @param string $date
	 * @return void
	 */
	function insert_cto($field, $field2, $employee_id, $date)
	{
		$data = array(
               'employee_id' 	=> $employee_id,
               'log_date' 		=> $date,
               $field			=> 'CTO',
               $field2			=> ''
            );

		$this->db->insert('dtr', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Insert DTR values
	 *
	 * @since Version 1.0
	 * @param array $data
	 * @return int
	 */
	function insert_dtr($data)
	{
		$this->db->insert('dtr', $data);
		return $this->db->insert_id();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check if the field is blank
	 *
	 * @since Version 1.0
	 * @param string $field
	 * @param string $log_date
	 * @param varchar $employee_id
	 * @return boolean
	 */
	function is_field_blank($field, $log_date, $employee_id)
	{
		$field_value = '';
		
		$this->db->select($field);
		$this->db->where('employee_id', $employee_id);
		$this->db->where('log_date', $log_date);
		$q = $this->db->get('dtr');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$field_value = $row[$field];
			}
		}
		
		if ($field_value == '')
		{
			return TRUE;
		}
		
		return FALSE;
		
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check if employee is leave
	 *
	 * @since Version 1.0
	 * @param varchar $id
	 * @return boolean
	 */
	function is_leave($id)
	{
		$this->db->select('id');
		
		$this->db->where('am_login', 'Leave');
		
		$this->db->or_where('am_logout', 'Leave');
		$this->db->or_where('pm_login', 'Leave');
		$this->db->or_where('pm_logout', 'Leave');
		
		$this->db->where('id', $id);
		
		$q = $this->db->get('dtr');
		
		if ($q->num_rows() > 0)
		{
			return TRUE;
		}
		
		return FALSE;
	
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check if leave is half day
	 *
	 * @since Version 1.0
	 * @param int $id
	 * @return boolean
	 */
	function is_leave_half($id = '')
	{	
		$this->db->select('am_login, 
						   am_logout, 
						   pm_login, 
						   pm_logout');
		$this->db->where('id', $id);
		$q = $this->db->get('dtr');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$am_login 	= $row['am_login'];
				$am_logout 	= $row['am_logout'];
				$pm_login 	= $row['pm_login'];
				$pm_logout 	= $row['pm_logout'];
			}
		}
		
		$is_leave_half = FALSE;
		
		// If am login and am logout is leave
		// and pm login and pm logout is not leave
		if( ($am_login == 'Leave' && $am_logout == 'Leave') &&
		($pm_login != 'Leave' && $pm_logout != 'Leave') )
		{
			$is_leave_half = TRUE;
		}
		
		// If am login and am logout is not leave
		// and pm login and pm logout is leave
		if( ($am_login != 'Leave' && $am_logout != 'Leave') &&
		($pm_login == 'Leave' && $pm_logout == 'Leave') )
		{
			$is_leave_half = TRUE;
		}
		
		return $is_leave_half;
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check if log exists
	 *
	 * @since Version 1.0
	 * @param varchar $employee_id
	 * @param string $log_date
	 * @return boolean
	 */
	function is_log_date_exists($employee_id = '', $log_date = '')
	{
		$this->db->select('id');
		$this->db->where('employee_id', $employee_id);
		$this->db->where('log_date', $log_date);
		$q = $this->db->get('dtr', 1);
		
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
	
	/**
	 * Tell whether DTR entry is Official Business
	 *
	 * @since Version 1.0
	 * @param int $id
	 * @return boolean
	 */
	function is_ob($id = '')
	{
		$this->db->select('id');
	
		$this->db->where('am_login', 'Official Business');
		
		$this->db->or_where('am_logout', 'Official Business');
		$this->db->or_where('pm_login', 'Official Business');
		$this->db->or_where('pm_logout', 'Official Business');
		
		$this->db->where('id', $id);
		
		$q = $this->db->get('dtr', 1);
		
		if ($q->num_rows() > 0)
		{
			return TRUE;
		}
		
		return FALSE;
		
		$q->free_result();
	}
	
	function is_to($id = '')
	{
		$this->db->select('id');
	
		$this->db->where('am_login', 'Travel Order');
		
		$this->db->or_where('am_logout', 'Travel Order');
		$this->db->or_where('pm_login', 'Travel Order');
		$this->db->or_where('pm_logout', 'Travel Order');
		
		$this->db->where('id', $id);
		
		$q = $this->db->get('dtr', 1);
		
		if ($q->num_rows() > 0)
		{
			return TRUE;
		}
		
		return FALSE;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check if Official Business is half day
	 *
	 * @since Version 1.0
	 * @param int $id
	 * @return boolean
	 */
	function is_ob_half($id = '')
	{
		$this->db->select('am_login, am_logout, pm_login, pm_logout');
		$this->db->where('id', $id);
		$q = $this->db->get('dtr');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$am_login 	= $row['am_login'];
				$am_logout 	= $row['am_logout'];
				$pm_login 	= $row['pm_login'];
				$pm_logout 	= $row['pm_logout'];
			}
		}
		
		$is_ob_half = FALSE;
		
		if( ($am_login == 'Official Business' && $am_logout == 'Official Business') &&
		($pm_login != 'Official Business' && $pm_logout != 'Official Business') )
		{
			$is_ob_half = TRUE;
		}
		
		
		if( ($am_login != 'Official Business' && $am_logout != 'Official Business') &&
		($pm_login == 'Official Business' && $pm_logout == 'Official Business') )
		{
			$is_ob_half = TRUE;
		}
		
		return $is_ob_half;
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * DTR Manual log
	 *
	 * @since Version 1.0
	 * @param int $office_id
	 * @param varchar $employee_id
	 * @param string $time
	 * @param string $date
	 * @param int $type
	 * @param int $shift_type
	 * @param int(bool) $overwrite_logs
	 * @return void
	 */
	function manual_log($office_id, $employee_id, $time, $date, $type, $shift_type, $overwrite_logs = 0)
	{
		// Check if the date and employee id exists in dtr table
		
		$this->db->select('id');
		$this->db->where('employee_id', $employee_id);
		$this->db->where('log_date', $date);
		$this->db->where('office_id', $office_id);
		$q = $this->db->get('dtr', 1);
		
		// Check type of login
		switch($type)
		{
			case 1:
			$field 	= 'am_login';
			$am_pm	= 'AM';
			break;
			
			case 2:
			$field 	= 'am_logout';
			$am_pm	= 'AM';
			break;
			
			case 3:
			$field 	= 'pm_login';
			$am_pm	= 'PM';
			break;
			
			case 4:
			$field 	= 'pm_logout';
			$am_pm	= 'PM';
			break;
			
			case 5:
			$field 	= 'ot_login';
			$am_pm	= 'PM';
			break;
			
			case 6:
			$field 	= 'ot_logout';
			$am_pm	= 'PM';
			break;
		
		}
		
		// PROCESS THIS IS THE SHIFT ID IS EQUAL TO 1 OR REGULAR OFFICE HOURS
		if($shift_type == 1)
		{
			if ($q->num_rows() > 0)
			{
				$is_field_blank = $this->is_field_blank($field, $date, $employee_id);
				
				if($is_field_blank == TRUE)
				{
					$data = array($field => $time);
				
					$this->db->where('employee_id', $employee_id);
					$this->db->where('log_date', $date);
					$this->db->where('office_id', $office_id);
					$this->db->update('dtr', $data); 
					
					$no_record = 'Manual Log set! (MULTIPLE EMPLOYEE)' .$time.' '.$date;
					
				}
				else
				{
					//If not blank
					//check if overwrite is activated
					if($overwrite_logs == 1)
					{
						$data = array($field => $time);
					
						$this->db->where('employee_id', $employee_id);
						$this->db->where('log_date', $date);
						$this->db->where('office_id', $office_id);
						$this->db->update('dtr', $data); 
					 
						$no_record = 'Manual Log set! (MULTIPLE EMPLOYEE)' .$time.' '.$date;
					}
						
				}
			}
			else
			{
				$data = array(
               				'office_id' 	=> $office_id ,
               				'employee_id'	=> $employee_id ,
               				'log_date' 		=> $date,
			   				$field 			=> $time
            				);

				$this->db->insert('dtr', $data);

				
				$no_record = 'Manual Log set! (MULTIPLE EMPLOYEE)' .$time.' '.$date;
			}
			
			$this->Logs->insert_logs(
									'attendance', 
									'MANUAL LOG', 
									'', 
									$employee_id
									);
			
		}	
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Set the DTR to CTO
	 *
	 * @since Version 1.0
	 * @param string $field
	 * @param varchar $employee_id
	 * @param string $date
	 * @return void
	 */
	function set_cto($field, $employee_id, $date)
	{
		$data = array($field => 'CTO');

		$this->db->where('employee_id', $employee_id);
		$this->db->where('log_date', $date);
		$this->db->update('dtr', $data); 	
	}
	
	// --------------------------------------------------------------------
	
	
	/**
	 * Update the DTR
	 *
	 * @since Version 1.0
	 * @param string $field
	 * @param string(time) $value
	 * @param int $id
	 * @return void
	 */
	function update_dtr($field, $value = '', $id)
	{
		// Change the value if not blank
		if(($field == 'pm_login' OR $field == 'pm_logout' OR $field == 'ot_login' OR $field == 'ot_logout') && $value != '')
		{
			// If flexi and pm_in is 12:00
			if ( $this->is_pm_in12 == TRUE && $field == 'pm_login')
			{
				$data = array($field => $value);

				$this->db->where('id', $id);
				$this->db->update('dtr', $data); 
				
				return 0;
			}
			
			if ($value < '13:00') 
			{
				$value = strtotime($value.' PM');
				$value = date('H:i', $value);
			}
		}
		
		$data = array($field => $value);

		$this->db->where('id', $id);
		$this->db->update('dtr', $data); 
		
	}
}

/* End of file dtr.php */
/* Location: ./application/models/dtr.php */