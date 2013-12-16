<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

require_once('connection.php');
 
class DtrEloquent extends BaseModel {

	protected $table = "dtr";

	protected $fillable = array(
						
						'employee_id',
						'log_date',
						'am_login',
						'am_logout',
						'pm_login',
						'pm_logout',
						'ot_login',
						'ot_logout',
						'office_id',
						);

	protected static $rules = array(
						//'user_id' 	=> 'required',
						//'name' 		=> 'required',
	);
	
	protected static $messages = array(
			//'lname.required' => 'The Last Name field is required.',
			//'fname.required' 	=> 'required|max:50',
			//'email' 	=> 'required|email|unique:users,email,:id:',
			//'password' 	=> 'required',
	);	

	//protected $appends = array('finger_pics');
	
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