<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

require_once('connection.php');
 
class UserEloquent extends BaseModel {

	//public $timestamps = false;
	
	protected $table = "users"; 
	
	// --------------------------------------------------------------------
	
	// Scopes method
	public function scopeLine($query, $line)
    {
        return $query->where('line', '=', $line);
    }
}