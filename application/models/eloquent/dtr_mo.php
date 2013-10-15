<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;
//use Illuminate\Validation;
use Illuminate\Validation;
 
class Dtr_mo extends BaseModel {

	const STATUS_INACTIVE = 'Inactive';
	const STATUS_ACTIVE   = 'Active';
	
	public $table = "x";
	
	
	protected $guarded = [];
	
	protected static $rules = [
			'tracking_no'  		=> 'required|max:50',
			'title'  			=> 'required|max:50',
			'actions_needed'  	=> 'required',
			'remarks'  			=> 'required|max:50',
	];
	
		
	function yeah()
	{
		
	}
	
}


class BaseModel extends Eloquent{
	
	public $errors;
	
	
	public static function boot()
	{		
		parent::boot();	
		
		
		//self::validate();
		
		static::saving(function($dtr)
		{
			
			
			return $dtr->validate();	
		});
	}
		
	public function validate()
	{
		//echo 'validate';
		
		$validation = new Illuminate\Validation\Validator($this->attributes, static::$rules);
		
		if($validation->passes()) return true;
		
		//$this->errors = $validation->messages();
		$this->errors = $validation->messages()->all();
		return false;
	}

}