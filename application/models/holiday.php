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
class Holiday extends CI_Model{

	// --------------------------------------------------------------------
	
	var $fields = array();
	
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add holiday
	 *
	 * @param array $data
	 * @return unknown
	 */
	function add_holiday($data)
	{
		$this->db->insert('holiday', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete holiday
	 *
	 * @param int $id
	 */
	function delete_holiday($id)
	{
		$this->db->delete('holiday', array('id' => $id)); 
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * List all holiday by year
	 *
	 * @param string $year
	 * @return array
	 */
	function holiday_list($year)
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		$this->db->where('YEAR(date)', $year);
		$this->db->order_by('date');
		$q = $this->db->get('holiday');
		
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
	 * Get the name of holiday
	 *
	 * @param string $date
	 * @return string
	 */
	function holiday_name($date)
	{
		$data = array();
		
		$this->db->where('date', $date);
		$this->db->limit(1);
		$q = $this->db->get('holiday');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data = $row['description'];
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Tells whether the date is holiday
	 *
	 * @param string $date
	 * @return boolean
	 */
	function is_holiday($date)
	{
		$this->db->where('date', $date);
		$q = $this->db->get('holiday');
		
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
}

/* End of file holiday.php */
/* Location: ./application/models/holiday.php */