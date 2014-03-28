<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

require_once('connection.php');
 
class GroupEloquent extends BaseModel {

	//public $timestamps = false;
	
	protected $table = "groups";
	
	protected $fillable = array(
						
						'name',
						'description',
						
						);
	
	protected static $rules = array(
						'name' 	=> 'required|max:50',	
						//'fname' => 'required|max:50',
			
	);
	
	protected static $messages = array(
			
	);
	
	// --------------------------------------------------------------------
	
	// Scopes method
	public function scopeLine($query, $line)
    {
        return $query->where('line', '=', $line);
    }
}