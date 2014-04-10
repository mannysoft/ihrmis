<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;

require_once('connection.php');

class AssetBusinessInterest extends BaseModel {

	protected $table = "asset_business_interests";
	
	protected $fillable = array(
						
						'employee_id',
						'name',
						'company',
						'address',
						'nature_business',
						'date_acquisition',
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
	
	// --------------------------------------------------------------------
	
	public function employee()
    {
		return self::belongsTo('Employee');
    }
	
	public static function employee()
    {
		return self::belongsTo('Employee');
    }
}