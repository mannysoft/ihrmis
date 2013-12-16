<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

require_once('connection.php');
 
class EmployeeEloquent extends BaseModel {

	protected $table = "employee";

	protected $appends = array('finger_pics');
	
	public function getFingerPicsAttribute()
	{
		// Lets check if image exists
		if (file_exists('pics/'.$this->attributes['pics'])) 
		{
			return base_url().'pics/'.$this->attributes['pics'];
		}
		else
		{
			return base_url().'pics/not_available.jpg';
		}

		//return 'test';
		//return StakeHolder::find($this->attributes['stakeholder_id'])->name;
		//return $this->attributes['pics'];
		//return $this->attributes['user_id'] == true;
	}

	public function loan()
	{
		return self::hasMany('DeductionLoan', 'employee_id');
	}
}