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
class Office_pass extends CI_Model {

	// --------------------------------------------------------------------
	
	public $num_rows = 0;
	
	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Office_pass
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Cancel office pass
	 *
	 * @param int $id
	 */
	function cancel_office_pass($id = '')
	{			
		$this->db->delete('office_pass', array('id' => $id)); 			
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get employee total office pass
	 *
	 * @param int $employee_id
	 * @return double
	 */
	function get_employee_pass($employee_id)
	{
		$data = array();
		
		$this->db->select('SUM(seconds) AS total_pass');
		$this->db->where('employee_id', $employee_id);
		$this->db->order_by('date', 'DESC');
		
		$q = $this->db->get('office_pass');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['total_pass'];
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all office pass
	 *
	 * @return array
	 */
	function get_office_pass()
	{
		$data = array();
		
		$this->db->order_by('date', 'DESC');
		
		$q = $this->db->get('office_pass');
		
		
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
	 * Get office pass between two dates
	 *
	 * @param string(date) $date1
	 * @param string(date) $date2
	 * @return array
	 */
	function get_office_pass_list($date1, $date2)
	{
		$data = array();
		
		$this->db->where("date_acquired BETWEEN '$date1' AND '$date2'");
		
		$q = $this->db->get('office_pass');
		
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
	 *Get total office pass
	 *
	 * @param varchar $id
	 * @param string(date) $date
	 * @return double
	 */
	function get_total_pass($id, $date)
	{
		$data = array();
		
		$this->db->select('SUM(seconds) AS total_pass');
		$this->db->where("CONCAT(YEAR(date),'-',MONTH(date)) = '$date'");
		$this->db->where('employee_id', $id);
		
		$q = $this->db->get('office_pass');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['total_pass'];
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add new entry to office pass
	 *
	 * @param array $data
	 */
	function insert_office_pass($data)
	{
		$this->db->insert('office_pass', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 *Get office pass info
	 *
	 * @param INT $id
	 * @return array
	 */
	function get_pass_info( $id = '' )
	{
		$data = array();
		
		$this->db->where('id', $id);
		
		$q = $this->db->get('office_pass');
		
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
}	

/* End of file office_pass.php */
/* Location: ./application/models/office_pass.php */