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
class Shift extends CI_Model {

	// --------------------------------------------------------------------
	
	/**
	 * Constructor
	 *
	 * @return Shift
	 */
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Insert new shift
	 *
	 * @param int $office_id
	 * @param int $shift_type
	 * @param string $times
	 * @return void
	 */
	function add_shift($office_id, $shift_type, $times)
	{
		$data = array(
               "office_id" 	=> $office_id,
				"shift_type" => $shift_type,
				"times" 	=> $times
            );

		$this->db->insert('shift', $data);
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get shift details
	 *
	 * @param string $times
	 * @return array
	 */
	function shift_details($times)
	{
		$data = array();
		
		$this->db->select('shift_id');
		$this->db->where('times', $times);
		$q = $this->db->get('shift');
		
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
	 * Shift listing
	 *
	 * @param string $shift_id_from_select
	 * @return string
	 */
	function shift_list($shift_id_from_select = '')
	{  
		$data = array();
			
		$q = $this->db->get('shift');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$data[]	= $row;
			}
		}
		
		return $data;
		
		$q->free_result();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get shift times
	 *
	 * @param int $shif_type
	 * @param int $shift_id
	 * @return string
	 */
	function shift_times($shift_type, $shift_id = '')
	{
		$time = array();
	
		$this->db->select('times');
		$this->db->where('shift_type', $shift_type);
		$this->db->where('shift_id', $shift_id);
		$q = $this->db->get('shift');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$times = $row['times'];
			}
		}
		
		// split the times 8 12 1 5
		//list($time_a, $time_b, $time_c, $time_d) = split('[,.-]', $times); //As of PHP 5.3.0 the regex extension is deprecated, calling this function will issue an E_DEPRECATED notice. 
		list($time_a, $time_b, $time_c, $time_d) = explode(',', $times);
		
		$time['time_a'] = $time_a;
		$time['time_b'] = $time_b;
		$time['time_c'] = $time_c;
		$time['time_d'] = $time_d;
		
		return $time;
		
		$q->free_result();
	}
	
	
}

/* End of file shift.php */
/* Location: ./application/models/shift.php */