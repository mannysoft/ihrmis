<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;
 
class DeductionInformation extends Eloquent {

	const STATUS_INACTIVE = 'Inactive';
	const STATUS_ACTIVE   = 'Active';
	
	public $table = "payroll_deduction_informations";
	
	// --------------------------------------------------------------------
	
	public function activeDeductions()
	{
		return self::where('status', '=', self::STATUS_ACTIVE);
	}
	
	// --------------------------------------------------------------------
	
	public function listBox($id)
	{
		$unique = PayrollHeading::distinctDeductions();
		
		if ($id != '')
		{
			$unique = array(0);
		}
		
		$deductions = self::orderBy('desc')->whereNotIn('id', $unique)->get();
		
		$rows = array('0' => '');
				
		foreach ($deductions as $deduction)
		{
			$rows[$deduction->id] = $deduction->desc;
		}
		
		return $rows;
	}
	
	// --------------------------------------------------------------------
}