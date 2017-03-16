<?php

namespace Ihrmis\Tax\Compensations;

use Ihrmis\Tax\Compensations\TaxableCompensation;
use App\User;

class Compensation
{

	public $user;
    public $basicSalary = 0;
	public $overTimePay = 0;
	public $holidayPay = 0;
	public $nightDifferentialPay = 0;

	public $taxableCompensation = 0;


	public function __construct(TaxableCompensation $taxableCompensation, User $user)
	{
		$this->taxableCompensation = $taxableCompensation;
		$this->user = $user;
	}

	/**
     * Sets basic salary.
     *
     * @param  string|double  $basicSalary
     * @return void
     */
	public function setBasicSalary($basicSalary)
    {
    	$this->basicSalary = $basicSalary;
    }

    /**
     * Get basic salary.
     *
     * @return double
     */
    public function getBasicSalary()
    {
    	return $this->basicSalary;
    }

    public function setOverTimePay($overTimePay)
    {
    	$this->overTimePay = $overTimePay;
    }

    public function getOverTimePay()
    {
    	return $this->overTimePay;
    }

    public function setHolidayPay($holidayPay)
    {
    	$this->holidayPay = $holidayPay;
    }

    public function getHolidayPay()
    {
    	return $this->holidayPay;
    }

    public function setNightDifferentialPay($nightDifferentialPay)
    {
    	$this->nightDifferentialPay = $nightDifferentialPay;
    }

    public function getNightDifferentialPay()
    {
    	return $this->nightDifferentialPay;
    }

    public function getTotalTaxableCompensation()
    {
    	return $this->basicSalary + 
    		   $this->overTimePay + 
    		   $this->holidayPay + 
    		   $this->nightDifferentialPay +
    		   $this->taxableCompensation->get($this->user); // If there are other taxable compensation
    }

}
