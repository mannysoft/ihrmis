<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;
 
class Employee_i extends Eloquent {

	public $table = "employee"; 
		
	public function deductions()
    {
		return self::hasMany('Deductions', 'employee_id');
    }
}