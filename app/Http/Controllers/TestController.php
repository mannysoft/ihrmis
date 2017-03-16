<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Ihrmis\Tax\TaxCalculator;
use Ihrmis\Tax\Tax;
use App\User;

class TestController extends Controller
{
	protected $tax;

	public function __construct(Tax $tax)
	{
		$this->tax = $tax;
	}

    public function index()
    {
    	$this->tax->user = User::find(1);
    	$this->tax->compensation->user = User::find(1);
    	// $this->tax->compensation->hmoAmount = 200;
    	// $this->tax->compensation->absencesAmount = 1000;
    	// $this->tax->compensation->tardinessAmount = 2000;
    	// $this->tax->compensation->undertimeAmount = 3000;

    	$this->tax->deduction->hmoAmount = 200;
    	$this->tax->deduction->absencesAmount = 1000;
    	$this->tax->deduction->tardinessAmount = 2000;
    	$this->tax->deduction->undertimeAmount = 3000;
    	// return $this->tax->deduction->hmoAmount;
    	// suedo code
    	// set salary
        $tax = $this->tax;
        //$tax->setMonthlySalary(100000);
        $tax->setCompensations(70000);
        //$tax->compensation->nightDifferentialPay = 10000;
        $tax->setDeductions();
        // $tax->setOverTimePay(3000);
        // $tax->setHolidayPay(2000);
        // $tax->setNightDifferentialPay(4040);
        //$tax->government = true;
        $tax->setTaxableIncome();
        echo 'taxable income - ' . $tax->getTaxableIncome() . '<br>';
       	echo 'sss-' . $tax->deduction->getSss() .'<br>';
       	echo 'ph-' . $tax->deduction->getPhilHealth() . '<br>';
       	echo 'hdmf-' . $tax->deduction->getPagibig() . '<br>';
       	echo 'gsis-' . $tax->deduction->getGSIS() . '<br>';
       	$tax->setTaxExemption('ME1 / S1');
       	$tax->getBracket();
       	$tax->computeTax();
       	return $tax->wtax;
    }
}
