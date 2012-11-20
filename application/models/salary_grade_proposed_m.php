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
 * iHRMIS Clients Class
 *
 * This class use for managing workstations of iHRMIS
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manny Isles
 * @link		http://charliesoft.net/hrmis/user_guide/models/clients.html
 */
class Salary_grade_proposed_m extends DataMapper{

	public $table  = 'salary_grade_proposed';
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get salary listing
	 *
	 * @return array
	 */
	function get_salary_grade($year = '', $salary_grade_type = '')
	{
		$data = array();
		//var_dump( $salary_grade_type);
		$this->db->where('year', $year);
	
		if ( $salary_grade_type == false)
		{
			$salary_grade_type = '';
		}
			
		$this->db->where('salary_grade_type', $salary_grade_type);
		
		$this->db->order_by('sg');
		$q = $this->db->get('salary_grade_proposed');
		
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
	
	function update_salary_grade( $data, $id = '')
	{
		$this->db->where('id', $id);
		$this->db->update('salary_grade_proposed', $data);
	}
}

/* End of file user.php */
/* Location: ./application/models/pages.php */