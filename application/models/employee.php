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
 * iHRMIS Employee Class
 *
 * This class use for managing all information about the employeess.
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/models/conversion_table.html
 */
class Employee extends CI_Model {
	
	// --------------------------------------------------------------------
	
	public $num_rows 			= 0;
	public $employee_id 		= '';
	public $office_id 			= 0;
	public $detailed_office_id	= 0;
	public $employment_type 	= '';
	
	public $per_page 			= '';
	public $off_set 			= '';
	public $lname				= ''; 
							   
	public $fields = array();
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add new employee
	 *
	 * @since Version 1.0
	 * @param array $data
	 * @return int
	 */
	function add_employee($data)
	{
		$this->db->insert('employee', $data);
		
		return $this->db->insert_id();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete Employee
	 *
	 * @since Version 1.0
	 * @param varchar $id
	 * @return void
	 */
	function delete_employee($employee_id)
	{
		$this->db->where('employee_id', $employee_id);
		$this->db->delete('employee');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get information about the employee.
	 * 
	 * There is an optional parameter $fields.
	 * This parameter containing what field to
	 * select in employee table. If $fields is
	 * blank meaning we select all fields in a 
	 * table
	 *
	 * @since Version 1.0
	 * @param varchar $id
	 * @param string $fields
	 * @return array
	 */
	function get_employee_info($employee_id, $fields = '')
	{
		//$data = array('lname' =>'', 'fname' => '', 'mname' =>'', 'pics' => '');
		$data = array();
		
		$this->db->select($this->fields);
		$this->db->where('employee_id', $employee_id);

		$q = $this->db->get('employee', 1);
		
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
	 * Get all list of employee according to office,
	 * employee ID at also by last name.
	 * not active employees will not return
	 *
	 * @since Version 1.0
	 * @param int $office_id
	 * @param varchar $employee_id
	 * @param int $per_page
	 * @param int $off_set
	 * @param string $lname
	 * @param unknown_type $fields
	 * @return array
	 */
	function get_employee_list($office_id = '', 
							   $employee_id = '', 
							   $per_page = '', 
							   $off_set = '', 
							   $lname= ''
							   )
	{
		$data = array();
		
		
		$this->db->select($this->fields);
		
		$this->db->where('status !=', 3);
		
		// If office id is not blank
		if ($office_id !='')
		{
			$this->db->where('office_id', $office_id);
			
			if ($this->detailed_office_id != 0)
			{
				$this->db->or_where('detailed_office_id', $this->detailed_office_id);
			}
			$this->db->order_by('lname');
		
			if ( $per_page != '' or $off_set != '' )
			{
				$this->db->limit($per_page, $off_set);
			}
		
		}
		
		if ($employee_id !='')
		{
			$this->db->where('employee_id', $employee_id);
			
			$this->db->order_by('lname');
		
			if ( $per_page != '' and $off_set != '' )
			{
				$this->db->limit($per_page, $off_set);
			}
	
		}
		
		if ($lname != '')
		{
			$this->db->where('lname', $lname);
		}
		
		// Type of employment
		if ($this->employment_type != '')
		{
			$this->db->where('permanent', $this->employment_type);
		}
		
		$this->db->where('status', 1); // Get only the active employee
		
		$q = $this->db->get('employee');
		
		$this->num_rows = $q->num_rows();
		
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
	 * Get all shifting employee according to office,
	 * 
	 *
	 * @param int $office_id
	 * @return array
	 */
	function get_employee_shifting($office_id = '')
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		$this->db->where('shift_type !=', 1);
		
		// If office id is not blank
		if ($office_id !='')
		{
			$this->db->where('office_id', $office_id);
			$this->db->order_by('lname');
		}
		
		$q = $this->db->get('employee');
		
		$this->num_rows = $q->num_rows();
		
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
	 * Get list of all contractual and job order
	 *
	 * @return array
	 */
	function get_jo_contract()
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		$this->db->where('permanent', 3);
		$this->db->or_where('permanent', 4);
		
		$this->db->order_by('lname');
		$q = $this->db->get('employee');
		
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
	 * Get new employees
	 *
	 * @return array
	 */
	function get_new_employee()
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		$this->db->where('newly_added', 1);
		
		$this->db->order_by('lname');
		$q = $this->db->get('employee');
		
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
	 * Get permanent employees
	 *
	 * @param int $office_id
	 * @return array
	 */
	function get_permanent($office_id = '')
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		$this->db->where("(permanent = 1 OR permanent = 2 OR permanent = 5 OR permanent = 6 OR permanent = 7 OR permanent = 8)");
		$this->db->where('status !=', 0);
		
		if($office_id != '')
		{ 
			$this->db->where('office_id', $office_id);
		}
		
		$this->db->order_by('lname');
		$q = $this->db->get('employee');
		
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
	 * Get selected enployees(not complete)
	 *
	 * @param array $employeeIds
	 * @return unknown
	 */
	function get_selected_employee($employee_ids = array())
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		$this->db->where_in('id', $employee_ids);
		
		$this->db->order_by('lname');
		$q = $this->db->get('employee');
		
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
	 * Get selected field
	 *
	 * @param string $table_field
	 * @param varchar $id
	 * @return mixed
	 */
	function get_single_field($table_field, $employee_id)
	{
		$field_value = '';
		
		$this->db->select($table_field);
		$this->db->where('employee_id', $employee_id);
		$q = $this->db->get('employee');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$field_value = $row[$table_field];	
			}
		}
	
		return $field_value;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Check if employee id exists
	 *
	 * @param varchar $employee_id
	 * @return boolean
	 */
	function is_employee_id_exists($employee_id)
	{
		$this->db->select('employee_id');
		$this->db->where('employee_id', $employee_id);
	
		$q = $this->db->get('employee');
		
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
	
	function set_status($employee_id, $status = 1)
	{
		$data = array('status' => $status);
		//$this->db->where('employee_id', $employee_id);
		$this->db->where('id', $employee_id);
		$this->db->update('employee', $data); 
		
		//echo $this->db->last_query();
		//exit;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete all employees
	 *
	 */
	function truncate()
	{
		$this->db->truncate('employee'); 
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Update employee data
	 *
	 * @param array $data
	 * @param varchar $employee_id
	 */
	function update_employee($data, $id = '')
	{
		$this->db->where('id', $id);
		$this->db->update('employee', $data); 
	}
	
}

/* End of file employee.php */
/* Location: ./application/models/employee.php */