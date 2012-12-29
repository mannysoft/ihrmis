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
 * iHRMIS Payroll Library
 *
 * This class use for processing payroll deductions and additional compensation.
 *
 * @package		iHRMIS
 * @subpackage	Libraries
 * @category	Leave
 * @author		Manny Isles
 * @link		http://charliesoft.net/hrmis/user_guide/libraries/payroll_lib.html
 */
class Payroll_lib {

	public $CI							= '';
	public $employee_id					= 0;
	public $deduction_id				= 0;
	public $additional_compensation_id 	= 0;
	public $add_com_amount				= 0;
	public $deduction_amount			= 0;
	public $amount						= 0;
	public $caption						= '';
	public $monthly_salary				= 0;
	
	public $salary_grade				= 1;
	public $step						= 1;
	public $tax_status					= '';
	public $dependents					= 0;
	public $share						= 'employee_share'; // employee_share or employer_share
	
	 // ------------------------------------------------------------------------
   
    function __construct($params = array())
    {
        //$this->CI = & get_instance();
		
		if (count($params) > 0)
		{
			$this->initialize($params);
		}
    }
	
	// ------------------------------------------------------------------------
	
	/**
	 * Initialize Preferences
	 *
	 * @access	public
	 * @param	array	initialization parameters
	 * @return	void
	 */
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
		
	}
	
	// ------------------------------------------------------------------------
	
	function deduction_compensation($line, $employee_id)
	{
		$this->set_employee_id($employee_id);
				
		if ($line->type == 'additional')
		{			
			$this->additional_compensation_id = $line->additional_compensation_id;
			
			$this->get_compensation();
		}
		else
		{
			$this->deduction_id = $line->deduction_id;
			$this->get_deduction();
		}
	}
	
	// ------------------------------------------------------------------------
	
	function get_compensation()
	{
		$s = new Staff_entitlement_m();
		
		$this->add_com_amount = $s->get_add_com($this->employee_id, $this->additional_compensation_id, $date = '');
		
		$this->amount = $this->add_com_amount;
	}
	
	// ------------------------------------------------------------------------
	
	function get_deduction()
	{
		$this->amount = 0;
		
		$d = new Deduction_information();
		
		$d->get_by_id($this->deduction_id);
		
		if ($d->type == 'tax')
		{
			$this->get_tax();
		}
		else
		{	
			if ($d->reference_table != '')
			{
				$CI = & get_instance();
				
				$this->monthly_salary = $CI->Salary_grade->get_monthly_salary($this->salary_grade, $this->step);
				
				if ($d->er_share == 'yes')
				{
					$this->share = 'employer_share';
				}
				
				// Todo: Save all deductions to table 
				
				// Phil Health
				if ($d->reference_table == 'philhealth')
				{
					// Lets check if Employer Share or not
					$this->amount = $this->phil_health_deductions();
				}
				// Pagibig
				if ($d->reference_table == 'pagibig')
				{
					$this->amount = $this->pagibig_deductions($d->amount);
				}
				
			}
		}
		
	}
	
	// ------------------------------------------------------------------------
	
	function set_employee_id($employee_id = 0)
	{
		$this->employee_id = $employee_id;
	}
	
	function compensation()
	{
		return $this->add_com_amount;	
	}
	
	// ------------------------------------------------------------------------
	
	function deduction()
	{
		return $this->deduction_amount;	
	}
	
	// ------------------------------------------------------------------------
	
	function amount()
	{
		if ($this->amount == '')
		{
			return '';
		}
		return number_format($this->amount, 2);
	}
	
	// ------------------------------------------------------------------------
	
	function get_tax()
	{
		$CI = & get_instance();
			
		$CI->load->library('tax');
		
		$CI->tax->tax_table_status 	= 'monthly';
		$CI->tax->salary_grade 		= $this->salary_grade;
		$CI->tax->step 				= $this->step;
		$CI->tax->days 				= 22;
		$CI->tax->hours 			= 0;
		$CI->tax->count_working_days = 22;
		
		$CI->tax->tax_exemption = ($this->tax_status != 'Single' ) ? 'ME' : 'S';
		$CI->tax->tax_exemption .= $this->dependents;
				
		$CI->tax->initialize();
		
		$this->amount = $CI->tax->wtax;
	}
	
	// ------------------------------------------------------------------------
	
	function phil_health_deductions()
	{
		$p = new Philhealth_sched();
		
		$this->share = 'employee_share';
		
		return $p->get_amount($this->monthly_salary, $this->share);
	}
	
	// ------------------------------------------------------------------------
	
	function pagibig_deductions($amount = 0)
	{		
		if ($this->share == 'employee_share')
		{
			return $this->monthly_salary * 0.02;
		}
		else
		{
			if ($amount != 0)
			{
				return $amount;
			}
			else
			{
				return $this->monthly_salary * 0.02;	
			}
		}
		
		$this->share = 'employee_share';
	}
	
}
