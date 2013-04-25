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
class Manual_log extends CI_Model {

	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Manual_log
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get manual log of the employee
	 *
	 * @param varchar $employee_id
	 * @return array
	 */
	function employee_manual_log($employee_id)
	{
		$data = array();
		
		$this->db->where('employee_id', $employee_id);
		
		$q = $this->db->get('manual_log');
		
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
	 * Get the notes
	 *
	 * @param int $manual_log_id
	 * @return string
	 */
	function get_notes($manual_log_id)
	{
		$data = '';
		
		$this->db->select('notes');
		$this->db->where('id', $manual_log_id);
		
		$q = $this->db->get('manual_log');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['notes'];
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Insert manual log
	 *
	 * @param array $data
	 * @return int
	 */
	function insert_manual_log($data)
	{
		$this->db->insert('manual_log', $data); 
		
		return $this->db->insert_id();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Tells whether a manual log exists
	 *
	 * @param varchar $employee_id
	 * @param int $log_type
	 * @param string $log_date
	 * @return boolean
	 */
	function is_manual_log_exists($employee_id, $log_type, $log_date)
	{
		$this->db->select('id');
		$this->db->where('employee_id', $employee_id);
		$this->db->where('log_type', $log_type);
		$this->db->where('cover_if_ob_or_leave', $log_date);
		$q = $this->db->get('manual_log', 1);
		
		if ($q->num_rows() == 0)
		{
			return FALSE;
		}
		else
		{
			foreach ($q->result_array() as $row)
			{
				return $row['id'];
			}
		}
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Manual log by office specified
	 *
	 * @param int $office_id
	 * @param int $log_type
	 * @return array
	 */
	function office_manual_log($employee_id, $log_type, $hidden = 0)
	{
		$data = array();
		
		$this->db->where('log_type', $log_type);
		$this->db->where('employee_id', $employee_id);
		
		$this->db->order_by('timestamp DESC, id desc');
		
		$q = $this->db->get('manual_log');
		
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
	 * Remove or hide the manual log
	 *
	 * @param int $id
	 */
	function remove_log($id)
	{
		$data = array('hidden' => 1);

		$this->db->where('id', $id);
		$this->db->update('manual_log', $data); 
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Update the manual log entry
	 *
	 * @param array $data
	 * @param int $id
	 */
	function update_manual_log($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('manual_log', $data); 
	}

}

/* End of file manual_log.php */
/* Location: ./application/models/manual_log.php */