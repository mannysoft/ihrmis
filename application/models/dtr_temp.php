<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Attendance Tracking and Leave Management System
 *
 * An Application Software use by Government agencies for management
 * of employees Attendance and Leave Administration.
 *
 * @package		ATLMS
 * @author		Manolito Isles
 * @copyright	Copyright (c) 2008 - 2012, Charliesoft
 * @license		http://charliesoft.com/atlms/user_guide/license.html
 * @link		http://charliesoft.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * ATLMS Dtr Temp Class
 *
 * This class use for manipulating data from standalone
 * finger scanning machine.
 *
 * @package		ATLMS
 * @subpackage	Models
 * @category	Models
 * @author		Manolito Isles
 * @link		http://charliesoft.com/atlms/user_guide/models/conversion_table.html
 */
class Dtr_temp extends CI_Model {
	// --------------------------------------------------------------------
	
	/**
	 *  Constructor.
	 *
	 * @return Dtr_temp
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Delete dtr entries with no employee id.
	 *
	 * @since Version 1.0
	 * @return void
	 */
	function delete_dtr_temp()
	{
		$this->db->where('employee_id', '');
		$this->db->delete('dtr_temp');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get all DTR entries by date of extraction from 
	 * stand alone machine like T4.
	 *
	 * @since Version 1.0
	 * @return array
	 */
	function get_dtr_temp()
	{
		$data = array();
		
		//$this->db->where('date_extract', "'".date('Y-m-d')."'");
		$this->db->where('employee_id !=', '');
		
		$q = $this->db->get('dtr_temp');
		
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
	 * Insert DTR temp
	 *
	 * @since Version 1.0
	 * @param array $data
	 * @return int
	 */
	function insert_dtr_temp($data)
	{
		$this->db->insert('dtr_temp', $data);
		return $this->db->insert_id();
	}
}

/* End of file dtr_temp.php */
/* Location: ./application/models/dtr_temp.php */