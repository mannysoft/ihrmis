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
class Leave_apps extends CI_Model {

	// --------------------------------------------------------------------
	
	public $fields 		= array();
	public $office_id 		= '';
	public $num_rows 		= 0;
	
	/**
	 * Constructor
	 *
	 * @return Leave_apps
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete leave application
	 *
	 * @param int $id
	 */
	function delete_leave_apps($id = '')
	{
		$this->db->where('id', $id);
		$this->db->delete('leave_apps');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Count all leave apps
	 *
	 * @param int $approved
	 * @return array
	 */
	function count_leave_apps()
	{
		$data = array();
		
		$q = $this->db->get('leave_apps');
		
		return $q->num_rows();
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all leave applications
	 *
	 * @param int $approved
	 * @return array
	 */
	function get_leave_apps($per_page = "", $off_set = "", $approved = '')
	{
		$data = array();
		
		$this->db->select($this->fields);
		//echo $approved;
		if ( $approved != '')
		{
			//echo 'hehe';
			$this->db->where('approved', $approved);
		}
		
		if ( $this->office_id != '')
		{
			$this->db->where('office_id', $this->office_id);
		}
		
		
		$this->db->order_by('id', 'desc');
		
		if ( $per_page != '' or $off_set != '' )
		{
			$this->db->limit($per_page, $off_set);
		}
		
		$q = $this->db->get('leave_apps');
		
		$this->num_rows = $q->num_rows();
		
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
	 * Leave application info
	 *
	 * @param int $tracking_no
	 * @return array
	 */
	function get_leave_apps_info($tracking_no)
	{
		$this->db->select($this->fields);
		
		$data = array();
		
		$this->db->where('id', $tracking_no);
		$q = $this->db->get('leave_apps');
		
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
	 * Insert new leave application
	 *
	 * @param array $data
	 * @return int
	 */
	function insert_leave_apps($data)
	{
		$this->db->insert('leave_apps', $data);
		return $this->db->insert_id();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $employee_id
	 * @param unknown_type $details
	 * @return unknown
	 */
	function is_leave_apps_exists( $params = array() )
	{
		$this->db->select('id');
		
		foreach ( $params as $key => $val)
		{
			$this->db->where($key, $val);
		}
		
		$q = $this->db->get('leave_apps');
		
		//echo $this->db->last_query();
		
		if ($q->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Search leave applications
	 *
	 * @param int $tracking_no
	 * @return array
	 */
	function search_leave_apps($tracking_no = '')
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		if ($tracking_no != '')
		{
			 $this->db->where('id', $tracking_no);
		}	 
		
		if ( $this->office_id != '')
		{
			$this->db->where('office_id', $this->office_id);
		}
		
		$this->db->order_by('date_encode');
		
		$q = $this->db->get('leave_apps');
		
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
	
	/**
	 * Approved leave application
	 *
	 * @param unknown_type $leave_apps_id
	 */
	function set_approved($leave_apps_id = '')
	{
		$data = array('approved' => 1);
		$this->db->where('id', $leave_apps_id);
		$this->db->update('leave_apps', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Disapproved leave application
	 *
	 * @param unknown_type $leave_apps_id
	 */
	function set_disapproved($leave_apps_id = '')
	{
		$data = array('approved' => 2);
		$this->db->where('id', $leave_apps_id);
		$this->db->update('leave_apps', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Update leave application
	 *
	 * @param array $data
	 * @param int $id
	 */
	function update_leave_apps($data = array(), $id = '')
	{
		$this->db->where('id', $id);
		$this->db->update('leave_apps', $data);
	}

}	

/* End of file leave_apps.php */
/* Location: ./application/models/leave_apps.php */