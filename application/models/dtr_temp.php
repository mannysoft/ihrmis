<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System 3.0dev
 *
 * An Open Source Application Software use by Government agencies for  
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2014, Isles Technologies
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Dtr Temp Class
 *
 * This class use for manipulating data from standalone
 * finger scanning machine.
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/models/conversion_table.html
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
		
		// Lets check for double entries and delete it
		$doubles = $this->double_entries();
		
		
		foreach($doubles as $double)
		{
			$this->db->where('employee_id', $double['employee_id']);
			$this->db->where('log_date', $double['log_date']);
			$this->db->where('logs', $double['logs']);
			$this->db->limit(abs(1-$double['double_entry']));
			$this->db->delete('dtr_temp');
		}
		
		//$this->db->where('date_extract', "'".date('Y-m-d')."'");
		$this->db->where('employee_id !=', '');
		$this->db->order_by('employee_id, id');
		//$this->db->where('employee_id', '1414');
		
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
	
	// --------------------------------------------------------------------
	function double_entries()
	{	
		$data = array();
				
		$this->db->select('employee_id, log_date, logs, COUNT( * ) as double_entry');
		
		$this->db->group_by('employee_id, log_date, logs'); 
		$this->db->having("double_entry > 1");
		
		$q = $this->db->get('dtr_temp');
		
		echo $this->db->last_query();
				
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
}

/* End of file dtr_temp.php */
/* Location: ./application/models/dtr_temp.php */