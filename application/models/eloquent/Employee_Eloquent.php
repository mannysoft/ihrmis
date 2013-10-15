<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;
 
class Employee_Eloquent extends Eloquent {

	public $table = "employee";
	
	public function loan()
	{
		return self::hasMany('DeductionLoan', 'employee_id');
	}	
}