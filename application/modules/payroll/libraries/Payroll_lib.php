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
	public $total_adcom					= 0;
	public $deduction_amount			= 0;
	public $amount						= 0;
	public $caption						= '';
	public $monthly_salary				= 0;
	
	public $salary_grade				= 1;
	public $step						= 1;
	public $tax_status					= '';
	public $dependents					= 0;
	public $share						= 'employee_share'; // employee_share or employer_share
	public $employer_deductions			= 0;
	public $employee_deductions			= 0;
	public $allow_save_adcom_deductions	= FALSE;
	
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
		
		$CI = & get_instance();
		
		$this->monthly_salary = $CI->Salary_grade->get_monthly_salary($this->salary_grade, $this->step);
		
	}
	
	// ------------------------------------------------------------------------
	
	function deduction_compensation($line, $employee_id)
	{
		$this->set_employee_id($employee_id);
		
		$this->additional_compensation_id = 0;
		
		$this->deduction_id = 0;
				
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
		
		$this->total_adcom += $this->add_com_amount;
		
		$this->amount = $this->add_com_amount;
		
		$this->save_deductions_adcom($this->add_com_amount);
	}
	
	// ------------------------------------------------------------------------
	
	function get_deduction()
	{
		$this->amount = 0;
		
		$d = new Deduction_information();
		
		$d->get_by_id($this->deduction_id);
		
		if ($d->type == 'tax')
		{
			$this->amount = $this->get_tax();
		}
		else if($d->type == 'premiums')
		{	
			if ($d->reference_table != '')
			{
				$CI = & get_instance();
				
				if ($d->er_share == 'yes')
				{
					$this->share = 'employer_share';
				}
				else
				{
					$this->share = 'employee_share';
				}
								
				// Phil Health
				if ($d->reference_table == 'philhealth')
				{
					// Lets check if Employer Share or not
					$this->amount = $this->phil_health_deductions();
				}
				// Pagibig
				if ($d->reference_table == 'pagibig')
				{
					$this->amount = $this->pagibig_gsis_deductions($d->amount);
				}
				
				// GSIS
				if ($d->reference_table == 'gsis')
				{
					$this->amount = $this->pagibig_gsis_deductions($d->amount, 'gsis');
				}
				
			}
		}
		
		else if ($d->type == 'loan')
		{
			$this->amount = $this->loan_deductions();
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
			
		
		$tax_exemption = ($this->tax_status != 'Single' ) ? 'ME' : 'S';
		$tax_exemption .= $this->dependents;

		$params = array(
					'tax_table_status' 		=> 'monthly',
					'salary_grade' 			=> $this->salary_grade,
					'step'					=> $this->step,
					'days' 					=> 22,
					'hours' 				=> 0,
					'count_working_days' 	=> 22,
					'tax_exemption'			=> $tax_exemption
					);
					
		$CI->load->library('tax', $params);
		
		$CI->tax->initialize($params);
		
		$this->add_deductions($this->share, $CI->tax->wtax); // add up deductions
		
		return $CI->tax->wtax;
	}
	
	// ------------------------------------------------------------------------
	
	function phil_health_deductions()
	{
		$p = new Philhealth_sched();
		
		$amount = $p->get_amount($this->monthly_salary, $this->share);
		
		$this->add_deductions($this->share, $amount); // add up deductions
			
		return $amount;
	}
	
	// ------------------------------------------------------------------------
	
	function pagibig_gsis_deductions($amount = 0, $agency = 'pagibig')
	{		
		$personal_share_percent = 0.02;
		$govt_share_percent 	= 0.02;
		
		if ($agency == 'gsis')
		{
			$personal_share_percent = 0.09;
			$govt_share_percent 	= 0.12;
		}
		
		if ($this->share == 'employee_share')
		{
			$this->add_deductions($this->share, $this->monthly_salary * $personal_share_percent); // add up deductions
			
			return $this->monthly_salary * $personal_share_percent;
		}
		else
		{			
			if ($amount != 0)
			{
				$this->add_deductions($this->share, $amount); // add up deductions
				return $amount;
			}
			else
			{
				$this->add_deductions($this->share, $this->monthly_salary * $govt_share_percent); // add up deductions
				return $this->monthly_salary * $govt_share_percent;	
			}
		}
		
		
	}
	
	// ------------------------------------------------------------------------
	
	function loan_deductions()
	{
		$CI = & get_instance();
		
		$date = $CI->input->post('year') . '-' . $CI->input->post('month').'-15';
		
		$d = new Deduction_loan();
		$d->where('employee_id', $this->employee_id);
		$d->where('deduction_information_id', $this->deduction_id);
		$d->where('date_to >=', $date);
		$d->where('status', 'active');
		$d->get();
		
		$this->share = 'employee_share';
		
		$this->add_deductions($this->share, $d->monthly_pay); // add up deductions
		
		return $d->monthly_pay;
	}
	
	// ------------------------------------------------------------------------
	
	function add_deductions($deduct_to = 'employee_share', $amount = 0)
	{
		if ($deduct_to == 'employee_share')
		{
			$this->employee_deductions += $amount;
			
			// Save the data to table
			$this->save_deductions_adcom($amount);
			
		}
		else if ($deduct_to == 'employer_share')
		{
			$this->employer_deductions += $amount;
			
			// Save the data to table
			$this->save_deductions_adcom($amount);
		}
	}
	
	// ------------------------------------------------------------------------
	
	function total_amount_due()
	{
		return ($this->monthly_salary + $this->total_adcom) - $this->employee_deductions;
	}
	
	// ------------------------------------------------------------------------
	
	function save_deductions_adcom($amount = 0)
	{
		if ($amount == 0)
		{
			return;
		}
		
		$CI = & get_instance();
		
		$date = $CI->input->post('year') . '-' . $CI->input->post('month').'-15';
		
		// Just save all additional compensation and deductions
		$this->allow_save_adcom_deductions = TRUE; // default is FALSE;
		
		$d = new Deduction_adcom();
		
		if ($this->allow_save_adcom_deductions == TRUE)
		{
			// Additional Compensation
			if ($this->additional_compensation_id != 0)
			{
				$d->where('employee_id', $this->employee_id);
				$d->where('additional_compensation_id', $this->additional_compensation_id);
				$d->where('date', $date);
				$d->get();
				
				$d->employee_id 				= $this->employee_id;
				$d->additional_compensation_id 	= $this->additional_compensation_id;
				$d->amount 						= $amount;
				$d->monthly_salary 				= $this->monthly_salary;
				$d->date 						= $date;
				$d->save();				
			}
			else // Deductions
			{
				$d->where('employee_id', $this->employee_id);
				$d->where('deduction_id', $this->deduction_id);
				$d->where('date', $date);
				$d->get();
				
				$d->employee_id 		= $this->employee_id;
				$d->deduction_id 		= $this->deduction_id;
				$d->amount 				= $amount;
				$d->monthly_salary 		= $this->monthly_salary;
				$d->date 				= $date;
				$d->save();				
			}
						
			$this->add_com_amount = 0;
		}
		
	}
	
	// ------------------------------------------------------------------------
	
	function reset_class()
	{
		foreach (get_class_vars(get_class($this)) as $name => $default) 
  		$this->$name = $default;	
	}
	
}
