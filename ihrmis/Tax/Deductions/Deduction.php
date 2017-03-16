<?php

namespace Ihrmis\Tax\Deductions;
use Ihrmis\Tax\Models\Sss as SssModel;
use Ihrmis\Tax\Models\PhilHealth as PhilHealthModel;

class Deduction 
{

    public $basicSalary = 0;
    public $government = false;
    public $sssDeduction = 0;
    public $phDeduction = 0;
    public $pagibigDeduction = 0;
    public $gsisDeduction = 0;

    public $hmoAmount = 0;
    public $absencesAmount = 0;
    public $tardinessAmount = 0;
    public $undertimeAmount = 0;

    protected $sss;
    protected $philHealth;
    public $type;

	function __construct(SssModel $sss, PhilHealthModel $philHealth)
    {
		$this->sss = $sss;
        $this->philHealth = $philHealth;
    }

    public function __set($key, $value)
    {
        return $this->$key = $value;
    }

    public function setBasicSalary($basicSalary)
    {
        $this->basicSalary = $basicSalary;
    }

    public function getSalaryDeductions()
    {

    }

    public function getDeduction($type, $basicSalary = 0, $amount = null)
    {
        if ($type == 'sss') {
            if ($basicSalary >= 15750) {
                return $this->sss->orderBy('id', 'desc')->first()->ss_ee;
            }
            return $this->sss->where('range_to', '>', $basicSalary)->first()->ss_ee;
        }
    	
        if ($type == 'philhealth') {
            if ($basicSalary >= 35000) {
                return $this->philHealth->orderBy('id', 'desc')->first()->employee_share;
            }

            if ($basicSalary < 9000) {
                return $this->philHealth->first()->employee_share;
            }

            return $this->philHealth->where('end_range', '>', $basicSalary)->first()->employee_share;
        }

        if ($type == 'pagibig') {
            if ($amount > 100) {
                return $amount;
            }

            return 100;
        }

    }

    public function getSss()
    {
        $this->sssDeduction = $this->getDeduction('sss', $this->basicSalary);
        return $this->sssDeduction;
    }

    public function getPhilHealth()
    {
        $this->phDeduction = $this->getDeduction('philhealth', $this->basicSalary);
        return $this->phDeduction;
    }

    public function getPagibig($amount = null)
    {
        $this->pagibigDeduction = $this->getDeduction('pagibig', $this->basicSalary, $amount);

        return $this->pagibigDeduction;
    }

    public function getGSIS()
    {
        if ($this->government == false) {
            return;
        }
        // Percentage of share
        $personalShare = 0.09;
        $govtShare = 0.12;
        
        //if ($this->share == 'employee_share'){
            
            return $this->basicSalary * $personalShare;
        //}

        //$this->add_deductions($this->share, $this->monthly_salary * $govt_share_percent); // add up deductions
        return $this->basicSalary * $govtShare;   
    }

    public function getHmoAmount()
    {
        return  $this->hmoAmount;
    }

    public function getAbsencesAmount()
    {
        return  $this->absencesAmount;
    }

    public function getTardinessAmount()
    {
        return  $this->tardinessAmount;
    }

    public function getUndertimeAmount()
    {
        return  $this->undertimeAmount;
    }

    public function getTotalDeductions()
    {
        return  $this->getSss() + 
                $this->getPhilHealth() + 
                $this->getPagibig() + 
                $this->getGSIS() +
                $this->getHmoAmount() +
                $this->getAbsencesAmount() +
                $this->getTardinessAmount() +
                $this->getUndertimeAmount()
                ;
    }

}