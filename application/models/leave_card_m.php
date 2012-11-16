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
 * @author		Manolito Isles
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
 * @author		Manolito Isles
 * @link		http://charliesoft.net/hrmis/user_guide/models/clients.html
 */
class Leave_card_m extends DataMapper{

	public $table  = 'leave_card';
	
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	function total_earned($employee_id = '', $year_process = '')
	{
		$this->select_sum('v_earned');
		$this->where('YEAR(date) <=', $year_process);
		$this->where('employee_id', $employee_id);
		$this->get();
						
		return $this->v_earned;
	}
	
	// --------------------------------------------------------------------
	
	function total_spent($employee_id = '', $year_process = '')
	{
		$this->select_sum('v_abs');
		$this->where('YEAR(date) <=', $year_process);
		$this->where('employee_id', $employee_id);
		$this->where('leave_type_id !=', 3); // not spl
		$this->get();
						
		return $this->v_abs;
	}
	
	// --------------------------------------------------------------------
	
	function total_vacation_leave($employee_id = '', $year_process = '')
	{
		$earned 	= $this->total_earned($employee_id, $year_process);
		$spent 		= $this->total_spent($employee_id, $year_process);
		
		return $earned - $spent;
	}
}

/* End of file user.php */
/* Location: ./application/models/pages.php */