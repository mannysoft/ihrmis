<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Model;
 
class Deductions extends Model {

	public $table = "payroll_deduction_adcoms";
	
	public function employee()
    {
		  return self::belongsTo('Payslip', 'employee_id');
    }
	
}