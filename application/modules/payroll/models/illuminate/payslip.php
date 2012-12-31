<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Model;
 
class Payslip extends Model {

	public $table = "employee"; 
		
	public function deductions()
    {
		  return self::hasMany('Deductions', 'employee_id');
    }
}