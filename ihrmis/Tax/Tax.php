<?php

namespace Ihrmis\Tax;
use Ihrmis\Tax\Deductions\Deduction;
use Ihrmis\Tax\Compensations\Compensation;
use Ihrmis\Tax\Deductions\Sss;
use Ihrmis\Tax\Deductions\PhilHealth;
use Ihrmis\Tax\Models\TaxTable;

class Tax
{

	public $user = null;
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
	public $taxTableStatus		= 'monthly'; // semi monthly, monthly
	public $bracketAmount		= 0;
	public $bracket_amount		= 0;
	public $column				= '';
	public $total_deduction		= 0;
	public $devided_by			= 2; // devide the monthly salary;

	public $taxableIncome = 0;
	public $taxExemption = 'S/ME';

	public $compensation;
	public $deduction;

	 // ------------------------------------------------------------------------
   
    public function __construct(Compensation $compensation, Deduction $deduction)
    {
    	$this->compensation = $compensation;
    	$this->deduction = $deduction;
    }

    public function setCompensations($basicSalary = 0)
    {
    	$this->compensation->setBasicSalary($basicSalary);
    	$this->deduction->setBasicSalary($basicSalary);
    }

    public function setDeductions()
    {
    	//$this->deduction->setDeduction($this->monthlySalary);
    }

    public function setTaxableIncome()
    {
    	$this->taxableIncome = $this->compensation->getTotalTaxableCompensation() - 
    	       $this->deduction->getTotalDeductions();
    }

    public function getTaxableIncome()
    {
    	return $this->taxableIncome;
    }

	public function setTaxExemption($taxExemption)
	{
		$this->taxExemption = $taxExemption;
	}



   	public function getBracket()
	{
		$t = TaxTable::where('monthly', $this->taxTableStatus)
			->where('status', $this->taxExemption)
			->first();
		
		$amount = 0;
		
		$brackets['bracket2'] = $t->bracket2;
		$brackets['bracket3'] = $t->bracket3;
		$brackets['bracket4'] = $t->bracket4;
		$brackets['bracket5'] = $t->bracket5;
		$brackets['bracket6'] = $t->bracket6;
		$brackets['bracket7'] = $t->bracket7;
		$brackets['bracket8'] = $t->bracket8;
		
		foreach ($brackets as $key => $bracket) {
			
			// if (floatval($bracket) > $this->taxable_amount) {
			if (floatval($bracket) > $this->getTaxableIncome()) {
				break;
			}
			
			$this->bracketAmount 	= floatval($bracket);
			$this->column 			= $key;
		}
	}

	public function computeTax()
	{
		$t = TaxTable::where('monthly', $this->taxTableStatus)
			->where('status', 'percent_over')
			->first();
				
		$tax = ($this->taxableIncome - $this->bracketAmount);
		
		// The column in tax table like bracket7
		$column = $this->column;
		
		$int = intval($t->$column);
		
		$decimal = floatval($int."%") / 100; // like 30% to 0.3
		
		$tax = $tax * $decimal;
		
		$t = TaxTable::where('monthly', $this->taxTableStatus)
			->where('status', 'exemption')
			->first();
		
		$addExemption = $t->$column;
		
		$tax = $tax + $addExemption;
		
		$this->wtax = $tax;
		
		$this->total_deduction += $this->wtax;
	}

	// ------------------------------------------------------------------------
	
	public function set_monthly_salary()
	{
		$this->CI = & get_instance();
		
		$this->monthly_salary = $this->CI->Salary_grade->get_monthly_salary($this->salary_grade, $this->step);
	}
	
	// ------------------------------------------------------------------------
	
	public function full_time()
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
	
	public function part_time()
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

}
