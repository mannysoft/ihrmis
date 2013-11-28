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
class Salary_grade extends CI_Model {

	// --------------------------------------------------------------------
	
	public $salary_grade_type = '';
	public $year 			  = 2011;
	
	/**
	 * Construtor
	 *
	 * @return Salary_grade
	 */
	function __construct()
	{
		parent::__construct();
		
		// assign the default salary grade
		$this->year = Setting::getField( 'default_salary_grade_year' );
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the monthly salary depending on salary grade and year
	 *
	 * @param string $salary_grade
	 * @param int $year
	 * @return unknown
	 */
	function get_monthly_salary($sg = 1, $step = 1)
	{
		$year = $this->year;
		
		$monthly_salary = 0;
		
		if ($step == 0)
		{
			$step = 1;
		}
		
		$this->db->select('step'.$step.' AS monthly_salary');
		$this->db->where('sg', $sg);
		$this->db->where('year', $year);
		
		// If not blank will get the salary grade for salary_grade_type
		// ex:hospital
		if ( $this->salary_grade_type != '' )
		{
			$this->db->where('salary_grade_type', $this->salary_grade_type);
		}
		else
		{
			$this->db->where('salary_grade_type', '');
		}
		
		$this->db->order_by('sg');
		$q = $this->db->get('salary_grade');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$monthly_salary  = $row['monthly_salary'];
			}
		}
		
		return floatval($monthly_salary);
		
		$q->free_result();
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
		$q = $this->db->get('salary_grade');
		
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
	 * Get monetary equivalent of the leave balances
	 *
	 * @param double $salary_grade
	 * @param double $sick_balance
	 * @param double $vacation_balance
	 * @param int $year
	 * @return double
	 */
	function monetary_equivalent($salary_grade = 1, $step = 1, $sick_balance, $vacation_balance)
	{
		$year = $this->year;
		
		$data = array();
		
		if ($step == 0)
		{
			$step = 1;
		}
		
		$this->db->select("step".$step." AS step");
		$this->db->where('sg', $salary_grade);
		$this->db->where('year', $year);
		
		// If not blank will get the salary grade for salary_grade_type
		// ex:hospital
		if ( $this->salary_grade_type != '' )
		{
			$this->db->where('salary_grade_type', $this->salary_grade_type);
		}
		else
		{
			$this->db->where('salary_grade_type', '');
		}
		
		$q = $this->db->get('salary_grade');
		
		if ($q->num_rows() > 0)
		{
			foreach ($q->result_array() as $row)
			{
				$step = $row['step'];
			}
		}
		
		//compute #days x 0.0478087 x Highest salary received
		$grand_total = ($sick_balance + $vacation_balance) * 0.0478087 * $step;
		
		return number_format($grand_total, 2);
		
		$q->free_result();
	}
	
	function update_salary_grade( $data, $id = '')
	{
		$this->db->where('id', $id);
		$this->db->update('salary_grade', $data);
	}
	
	
	
}

/* End of file salary_grade.php */
/* Location: ./application/models/salary_grade.php */