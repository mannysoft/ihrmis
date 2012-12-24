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
 * iHRMIS Tax Class
 *
 * This class use for processing leave applications.
 *
 * @package		iHRMIS
 * @subpackage	Libraries
 * @category	Leave
 * @author		Manny Isles
 * @link		http://charliesoft.net/hrmis/user_guide/libraries/tax.html
 */
class Tax {

	public $CI					= '';
	public $status 				= 'FT';
	public $salary_grade		= 1;
	public $step				= 1;
	public $hour_rate 			= 0;
	public $monthly_salary 		= 0;
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
		
		$this->CI = & get_instance();
		
		$this->set_monthly_salary();
		
		if ($this->status == 'FT')
		{
			$this->full_time();
		}
		if ($this->status == 'PT')
		{
			$this->part_time();
		}
		
		//echo $this->total_salary;exit;
		
		$this->get_bracket();
		
		$this->compute_tax();
		
		
		
	}
	
	// ------------------------------------------------------------------------
	
	function set_monthly_salary()
	{
		$this->monthly_salary = $this->CI->Salary_grade->get_monthly_salary($this->salary_grade, $this->step);
	}
	
	// ------------------------------------------------------------------------
	
	function full_time()
	{
		$this->daily_rate = $this->monthly_salary / 22;
		
		if ($this->days >= $this->count_working_days)
		{
			$this->total_salary = $this->monthly_salary / 2;
			
			
			
		}
		else
		{
			$this->total_salary = ($this->monthly_salary / 2);
				
			$this->deduct_day = $this->count_working_days - $this->days;
					
			$this->deduct_amount = ($this->deduct_day * $this->daily_rate);
							
			$this->total_salary = $this->total_salary - $this->deduct_amount;
			
			//echo $this->total_salary;exit;//echo $this->deduct_amount;
		}
	}
	
	// ------------------------------------------------------------------------
	
	function part_time()
	{
		$this->monthly_salary = $this->monthly_salary / 2;
		
		$this->hour_rate = ($this->monthly_salary / 11) / 8;
								
		if ($this->hours >= 40)
		{
			$this->total_salary = $this->monthly_salary / 2;
		}
		else
		{
			$this->total_salary = ($this->monthly_salary / 2);
			
			$this->deduct_time = 40 - $this->hours;
			
			$this->deduct_amount = ($this->deduct_time * $this->hour_rate);
						
			$this->total_salary = $this->total_salary - $this->deduct_amount;
		}
	}
	
	// ------------------------------------------------------------------------
	
	function get_bracket()
	{
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
			echo number_format($bracket, 2).'--'.number_format($this->total_salary, 2).var_dump((number_format($bracket, 2) > number_format($this->total_salary, 2))).'<br>';
			
			if (number_format($bracket, 2) > number_format($this->total_salary, 2))
			{
				break;
			}
			
			$this->bracket_amount 	= number_format($bracket, 2);
			$this->column 			= $key;
		}
		
		//echo $this->column;
		
	}
	
	// ------------------------------------------------------------------------
	
	function compute_tax()
	{
		$t = new Tax_table();
		
		$t->where('monthly', $this->tax_table_status);
		$t->where('status', 'percent_over');
		$t->get();
		
		
		//var_dump(($this->bracket_amount));
		//var_dump($this->total_salary);
		//$tax = (number_format($this->total_salary) - (floatval($this->bracket_amount)));
		//
		//echo ($tax);
		
		
		//exit;
		$column = $this->column;
		
		//echo $t->$column;
	}
	
	// ------------------------------------------------------------------------
	
	function total_deduction()
	{
		
	}
	
	// ------------------------------------------------------------------------
	
	function amount_paid()
	{
		
	}
}
