<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;
 
class AdditionalCompensation extends Eloquent {

	const STATUS_INACTIVE = 'Inactive';
	const STATUS_ACTIVE   = 'Active';
	
	public $table = "payroll_additional_compensation";
	
	public function activeCompensation()
	{
		return self::where('status', '=', self::STATUS_ACTIVE);
	}
	
	public function listBox($id)
	{
		$unique = PayrollHeading::distinctCompensations();
		
		if ($id != '')
		{
			$unique = array(0);
		}
		
		$compensations = self::activeCompensation()->whereNotIn('id', $unique)->orderBy('code')->get();
				
		$rows = array('0' => '');
				
		foreach ($compensations as $compensation)
		{
			$rows[$compensation->id] = $compensation->code;
		}
		
		return $rows;
	}	
}