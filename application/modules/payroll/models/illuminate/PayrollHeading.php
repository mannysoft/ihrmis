<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;
 
class PayrollHeading extends Eloquent {

	public $timestamps = false;
	
	public $table = "payroll_headings"; 
	
	// --------------------------------------------------------------------
	
	public function addcom()
    {
		return self::belongsTo('AdditionalCompensation', 'additional_compensation_id');
    }
	
	// --------------------------------------------------------------------
	
	public function deductions()
    {
		return self::belongsTo('DeductionInformation', 'deduction_id');
    }
	
	// --------------------------------------------------------------------
	
	public function deduction_addcom()
    {
		if ($this->type == 'additional')
		{
			return self::addcom();
		}
		if ($this->type == 'deductions')
		{
			return self::deductions();
		}
    }
	
	// --------------------------------------------------------------------
	
	public function distinctCompensations()
    {
		$rows = array();
		
		$compensations = self::where('additional_compensation_id', '!=', '')->get();
		
		foreach ($compensations as $compensation)
		{
			$rows[] = $compensation->additional_compensation_id;
		}
		
		return array_unique($rows);
    }
	
	// --------------------------------------------------------------------
	
	public function distinctDeductions()
    {
		$rows = array();
		
		$deductions = self::where('deduction_id', '!=', '')->get();
		
		foreach ($deductions as $deduction)
		{
			$rows[] = $deduction->deduction_id;
		}
		
		return array_unique($rows);
    }
	
	// --------------------------------------------------------------------
	
	public function blankRecord()
    {
		$row = new Stdclass();
		$row->type 		= '';
		$row->line 		= '';
		$row->additional_compensation_id = '';
		$row->deduction_id = '';
		$row->caption 	= '';
		
		return $row;
	}
}