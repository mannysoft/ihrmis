<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;
 
class Deductions extends Eloquent {

	public $table = "payroll_deduction_adcoms";
	
	// --------------------------------------------------------------------
	
	// --------------------------------------------------------------------
	
	public function amountPaid($id = '')
	{
		return self::where('loan_id', '=', $id)->sum('amount');	
	}
	
	// --------------------------------------------------------------------
	
	public function countMonthPaid($id = '')
	{
		return self::where('loan_id', '=', $id)->count();	
	}
	
	// --------------------------------------------------------------------
	
	public function loan()
    {
		return self::belongsTo('DeductionLoan', 'loan_id');
    }
}