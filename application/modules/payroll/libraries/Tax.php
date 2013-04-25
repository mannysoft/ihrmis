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
 * iHRMIS Tax Class
 *
 * This class use for processing leave applications.
 *
 * @package		iHRMIS
 * @subpackage	Libraries
 * @category	Leave
 * @author		Manny Isles
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/libraries/tax.html
 */
class Tax {

	public $CI					= '';
	public $status 				= 'FT';
	public $salary_grade		= 1;
	public $step				= 1;
	public $hour_rate 			= 0;
	public $monthly_salary 		= 0;
	public $taxable_amount		= 0;
	public $daily_rate 			= 0;
	public $total_salary 		= 0;
	public $deduct_day 			= 0;
	public $deduct_amount 		= 0;
	public $deduct_time 		= 0;
	public $days				= 0;
	public $hours				= 0;
	public $count_working_days 	= 0;
	public $grand_total_salary 	= 0;
	public $wtax				= 0; // Withholoding tax
	public $tax_table_status	= 'semi'; // semi monthly, monthly
	public $tax_exemption		= 'S/ME';
	public $bracket_amount		= 0;
	public $column				= '';
	public $total_deduction		= 0;
	public $devided_by			= 2; // devide the monthly salary;
	
	 // ------------------------------------------------------------------------
   
    function __construct($params = array())
    {	   
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
		
		$this->set_monthly_salary();
		
		$this->is_monthly(); // Use for tax deduction
		
		if ($this->status == 'FT')
		{
			$this->full_time();
		}
		if ($this->status == 'PT')
		{
			$this->part_time();
		}
				
		$this->get_bracket();
		
		$this->compute_tax();
	}
	
	// ------------------------------------------------------------------------
	
	function is_monthly()
	{
		if ($this->tax_table_status == 'monthly')
		{
			$this->devided_by = 1;
		}
	}
	
	// ------------------------------------------------------------------------
	
	function set_monthly_salary()
	{
		$this->CI = & get_instance();
		
		$this->monthly_salary = $this->CI->Salary_grade->get_monthly_salary($this->salary_grade, $this->step);
	}
	
	// ------------------------------------------------------------------------
	
	function full_time()
	{
		$this->daily_rate = $this->monthly_salary / 22;
		
		if ($this->days >= $this->count_working_days)
		{
			$this->total_salary 	= $this->monthly_salary / $this->devided_by;
			$this->taxable_amount 	= $this->total_salary;
		}
		else
		{
			$this->total_salary = ($this->monthly_salary / $this->devided_by);
				
			$this->deduct_day = $this->count_working_days - $this->days;
					
			$this->deduct_amount = ($this->deduct_day * $this->daily_rate);
							
			$this->total_salary = $this->total_salary - $this->deduct_amount;
			
			$this->taxable_amount 	= $this->total_salary;
		}
	}
	
	// ------------------------------------------------------------------------
	
	function part_time()
	{
		$this->monthly_salary = $this->monthly_salary / 2; // for part time
		
		$this->total_salary = $this->monthly_salary / $this->devided_by;
		
		$this->hour_rate = ($this->monthly_salary / 11) / 8;
								
		if ($this->hours >= 40)
		{
			$this->taxable_amount 	= $this->total_salary;
		}
		else
		{			
			$this->deduct_time = 40 - $this->hours;
			
			$this->deduct_amount = ($this->deduct_time * $this->hour_rate);
						
			$this->total_salary = $this->total_salary - $this->deduct_amount;
			
			$this->taxable_amount 	= $this->total_salary;
		}
	}
	
	// ------------------------------------------------------------------------
	
	function set_tax_exemption()
	{
		$last_char = substr($this->tax_exemption, -1, 1);
		
		if (is_numeric($last_char))
		{
			$this->tax_exemption = 'ME' . $last_char . ' / S'.$last_char;
		}
		else
		{
			$this->tax_exemption = 'S/ME';
		}
	}
	
	// ------------------------------------------------------------------------
	
	function get_bracket()
	{		
		$this->set_tax_exemption();
		
		$t = new Tax_table();
		$t->where('monthly', $this->tax_table_status);
		$t->where('status', $this->tax_exemption);
		$tables = $t->get();
		
		$amount = 0;
		
		$brackets['bracket2'] = $t->bracket2;
		$brackets['bracket3'] = $t->bracket3;
		$brackets['bracket4'] = $t->bracket4;
		$brackets['bracket5'] = $t->bracket5;
		$brackets['bracket6'] = $t->bracket6;
		$brackets['bracket7'] = $t->bracket7;
		$brackets['bracket8'] = $t->bracket8;
		
		foreach ($brackets as $key => $bracket)
		{
			if (floatval($bracket) > $this->taxable_amount)
			{
				break;
			}
			
			$this->bracket_amount 	= floatval($bracket);
			$this->column 			= $key;
		}
	}
	
	// ------------------------------------------------------------------------
	
	function compute_tax()
	{
		$t = new Tax_table();
		
		$t->where('monthly', $this->tax_table_status);
		$t->where('status', 'percent_over');
		$t->get();
				
		$tax = ($this->taxable_amount - $this->bracket_amount);
		
		// The column in tax table like bracket7
		$column = $this->column;
		
		$int = intval($t->$column);
		
		$decimal = floatval($int."%") / 100; // like 30% to 0.3
		
		$tax = $tax * $decimal;
		
		$t->where('monthly', $this->tax_table_status);
		$t->where('status', 'exemption');
		$t->get();
		
		$add_exemption = $t->$column;
		
		$tax = $tax + $add_exemption;
		
		$this->wtax = $tax;
		
		$this->total_deduction += $this->wtax;
	}
	
	// ------------------------------------------------------------------------
	
	function total_deduction()
	{
		return $this->total_deduction;
	}
	
	// ------------------------------------------------------------------------
	
	function amount_paid()
	{
		return $this->total_salary - $this->total_deduction;
	}
}
