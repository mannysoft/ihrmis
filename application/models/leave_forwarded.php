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
class Leave_forwarded extends CI_Model{

	// --------------------------------------------------------------------
	
	public $fields = array(); //Fields to be selected
	
	// --------------------------------------------------------------------
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Add the forwarded leave
	 *
	 * @param varchar $employeeNo
	 * @param double $vacation
	 * @param double $sick
	 * @param string $notes
	 * @return unknown
	 */
	function add_forwarded_leave($employee_id = '', $vacation = 0, $sick = 0, 
								 $notes = '', $date_cutoff)
	{
		$is_employee_id_exists = $this->Employee->is_employee_id_exists($employee_id);
		
		if($is_employee_id_exists == FALSE)
		{
			return 'Invalid Employee No.';
		}
		
		// Delete all from forwarded leave
		$this->db->delete('leave_forwarded', array('employee_id' => $employee_id)); 
		
		//Insert to forwarded
		$data = array(
					"employee_id" 			=> $employee_id,
					"forwarded_vacation" 	=> $vacation, 
					"forwarded_sick" 		=> $sick,
					"forwarded_note" 		=> $notes
		);
				
		$this->db->insert('leave_forwarded', $data);
		
		
		// Delete all tardiness
		$this->Tardiness->delete_all_tardiness($employee_id, $date_cutoff);
		
		// Employee info
		$this->Employee->fields = array(
										'id',
										'salary_grade', 
										'step',
										'office_id'
										);
		$name = $this->Employee->get_employee_info($employee_id);
		
		$office = $this->Office->get_office_info($name['office_id']);
		
		// Total leave credits
		$total_leave = $this->Leave_card->get_total_leave_credits($employee_id);
		
		// Check if leave balance exists
		$is_leave_balance_exists = $this->Leave_balance->is_leave_balance_exists($employee_id);
		
		$format_sick_leave 		= number_format($total_leave['sick'], 		3);
		$format_vacation_leave 	= number_format($total_leave['vacation'], 	3);
		
		$monetary = 0;
		
		if ($name['salary_grade'] != '-' && $name['salary_grade'] != '')
		{
			// We need to check what salary grade the office use
			if ( $office['salary_grade_type'] == 'hospital' )
			{
				$this->Salary_grade->salary_grade_type = 'hospital';
			}
			
			$monetary = $this->Salary_grade->monetary_equivalent($name['salary_grade'],
																 $name['step'],
																 $format_sick_leave, 
																 $format_vacation_leave
																 );
		}
		
		// If exists just update
		if ($is_leave_balance_exists == TRUE)
		{
			$this->Leave_balance->update_leave_balance($name['id'], 
													   $format_sick_leave, 
													   $format_vacation_leave, 
													   $monetary);
		}
		// Insert
		else
		{
			$this->Leave_balance->insert_leave_balance($name['id'], 
													   $format_sick_leave, 
													   $format_vacation_leave, 
													   $monetary);
		}	
		// End insert
		
		
		return 'Leave Credits forwarded ('.$vacation.' VL, '.$sick.' SL)';
		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Get the forwarded leave of employee
	 *
	 * @param varchar $employee_id
	 * @return array
	 */
	function get_forwarded_leave($employee_id)
	{
		$data = array();
		
		$this->db->select($this->fields);
		
		$this->db->where('employee_id', $employee_id);
		$this->db->limit(1);
		$q = $this->db->get('leave_forwarded');
		
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
	 * Check if forwarded leave is exists
	 *
	 * @param varchar $employee_id
	 * @return boolean
	 */
	function is_forwarded_leave_exists($employee_id)
	{
		$this->db->where('employee_id', $employee_id);
		$this->db->limit(1);
		$q = $this->db->get('leave_forwarded');
		
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
	
	// --------------------------------------------------------------------
	
	/**
	 * Use this in on place editing 4warded leave
	 *
	 * @param varchar $employee_id
	 * @param string $field
	 * @param double $new_value
	 */
	function update_forward_leave($employee_id, $field, $new_value)
	{
		
		$this->db->where('employee_id', $employee_id);
		$this->db->limit(1);
		$q = $this->db->get('leave_forwarded');
		
		if ($q->num_rows() == 0)
		{
			$data = array(
						'employee_id' 	=> $employee_id,
						$field 		 	=> $new_value
            );

			$this->db->insert('leave_forwarded', $data); 
		}
		else
		{
			$data = array($field => $new_value);

			$this->db->where('employee_id', $employee_id);
			$this->db->update('leave_forwarded', $data);

		}
		
		$q->free_result();
	}
}

/* End of file leave_forwarded.php */
/* Location: ./application/models/leave_forwarded.php */