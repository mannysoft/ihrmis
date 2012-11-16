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
class Leave_balance extends CI_Model {

	// --------------------------------------------------------------------
	
	public $fields = array();
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Leave_balance
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the leave balances of particular employee
	 *
	 * @param int $id
	 * @param varchar $employee_id
	 * @return double
	 */
	function get_leave_balance($id, $employee_id)
	{
		$data = array();
		
		if($id == 1 )
		{
			$field = 'vacation_leave';
		}
		
		if($id == 2 )
		{
			$field = 'sick_leave';
		}
		
		$this->db->select($field);
		$this->db->where('employee_id', $employee_id);
		$this->db->limit(1);
		$q = $this->db->get('leave_balance');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row[$field];
			}
		}
		
		return $data;
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	function get_leave_balances($employee_id)
	{
		$data = array();
		
		$options = array('employee_id' => $employee_id);
		
		$q = $this->db->getwhere('leave_balance', $options);
		
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
	 * Get monetary equivalent of leave balances
	 *
	 * @param varchar $employee_id
	 * @return double
	 */
	function get_monetary($employee_id)
	{
		$data = 0;
		
		$this->db->select('monetary_equivalent');
		$this->db->where('employee_id', $employee_id);
		$this->db->limit(1);
		$q = $this->db->get('leave_balance');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['monetary_equivalent'];
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Insert to leave balances
	 *
	 * @param varchar $employee_id
	 * @param double $sick_leave
	 * @param double $vacation_leave
	 * @param double $monetary
	 */
	function insert_leave_balance($employee_id, $sick_leave, $vacation_leave, $monetary)
	{
		$data = array(
                "employee_id" 			=> $employee_id,
				"sick_leave" 			=> $sick_leave, 
				"vacation_leave" 		=> $vacation_leave,
				"monetary_equivalent" 	=> $monetary
            );

		$this->db->insert('leave_balance', $data); 
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Tells whether an employee leave balance exists
	 *
	 * @param varchar $employee_id
	 * @return boolean
	 */
	function is_leave_balance_exists($employee_id)
	{
		$this->db->select('id');
		$this->db->where('employee_id', $employee_id);
		$this->db->limit(1);
		$q = $this->db->get('leave_balance');
		
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
	 * Update employee leave balance
	 *
	 * @param varchar $employee_id
	 * @param double $sick_leave
	 * @param double $vacation_leave
	 * @param double $monetary
	 */
	function update_leave_balance($employee_id, $sick_leave, $vacation_leave, $monetary)
	{
		$data = array(
               'sick_leave' 		=> $sick_leave,
               'vacation_leave' 	=> $vacation_leave,
               'monetary_equivalent'=> $monetary
            );

		$this->db->where('employee_id', $employee_id);
		$this->db->update('leave_balance', $data); 	  
	}
}

/* End of file leave_balance.php */
/* Location: ./application/models/leave_balance.php */