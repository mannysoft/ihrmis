<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

require_once('connection.php');
 
class UserEloquent extends BaseModel {

	//public $timestamps = false;
	
	protected $table = "users";
	
	protected $fillable = array(
						
						'group_id',
						'username',
						'fname',
						'mname',
						'lname',
						'office_id',
						'password',
						'stat',
						
						);
						
	protected static $rules = array(
			'lname' 	=> 'required|max:50',	
			'fname' 	=> 'required|max:50',
			'username' 	=> 'required|unique:users,username,:id:',
			'password' 	=> 'required',
	);
	
	protected static $messages = array(
			
	);					
	
	// --------------------------------------------------------------------
	
	public function office()
    {
		return self::belongsTo('OfficeEloquent', 'office_id', 'office_id');
    }
	
	public function group()
    {
		return self::belongsTo('GroupEloquent');
    }
	
	// Scopes method
	public function scopeLine($query, $line)
    {
        return $query->where('line', '=', $line);
    }
}