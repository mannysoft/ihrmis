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
class Leave_type extends CI_Model {

	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Leave_type
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the abbreviation of type of leave
	 *
	 * @param int $id
	 * @return string
	 */
	function get_leave_code($id)
	{
		$code = '';
		
		$this->db->select('code');
		$this->db->where('id', $id);
		$q = $this->db->get('leave_type', 1);
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$code = $row['code'];
			}
		}
		
		return $code;
		
		$q->free_result();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get leave name
	 *
	 * @param int $id
	 * @return string
	 */
	function get_leave_name($id)
	{
		$data = '';
		
		$this->db->select('leave_name');
		$this->db->where('id', $id);
		$this->db->limit(1);
		
		$q = $this->db->get('leave_type');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['leave_name'];
			}
		}
		
		return $data;
		
		$q->free_result();
	
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Return all type of leave
	 *
	 * @return array
	 */
	function leave_type_list()
	{
		$data = array();
		
		$this->db->select('leave_name, id');
		$q = $this->db->get('leave_type');
		
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
	
}

/* End of file leave_type.php */
/* Location: ./application/models/leave_type.php */