<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;
 
class DeductionLoan extends Eloquent {

	const STATUS_INACTIVE = 'Inactive';
	const STATUS_ACTIVE   = 'Active';
	
	public $table = "payroll_deduction_loans";
	
	// --------------------------------------------------------------------
	
	public function deductionInformation()
	{
		return self::belongsTo('DeductionInformation', 'deduction_information_id');
	}
	
	// --------------------------------------------------------------------
	
	
	
	// --------------------------------------------------------------------
}