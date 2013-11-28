<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use Illuminate\Database\Eloquent\Model as Eloquent;

require_once('connection.php');

class Setting extends BaseModel {

	protected $table = "settings";
	
	protected $fillable = array(
						
						'name',
						//'email',
						//'group_id',
						//'user_id',
						//'notes',
						);
						
	protected static $rules = array(
						//'user_id' 	=> 'required',
						'name' 		=> 'required',
	);
	
	protected static $messages = array(
			//'lname.required' => 'The Last Name field is required.',
			//'fname.required' 	=> 'required|max:50',
			//'email' 	=> 'required|email|unique:users,email,:id:',
			//'password' 	=> 'required',
	);					
	
	// --------------------------------------------------------------------
	
	public static function getField($table_field = '')
	{
		return self::where('name', '=', $table_field)->first()->setting_value;
	}
	
	// --------------------------------------------------------------------
	
	public function countMonthPaid($id = '')
	{
		//return self::where('loan_id', '=', $id)->count();	
	}
	
	// --------------------------------------------------------------------
	
	public function loan()
    {
		//return self::belongsTo('DeductionLoan', 'loan_id');
    }
}