<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

require_once('connection.php');
 
class OfficeEloquent extends BaseModel {

	//public $timestamps = false;
	
	protected $table = "office"; 
	
	// --------------------------------------------------------------------
	
	// Scopes method
	public function scopeLine($query, $line)
    {
        return $query->where('line', '=', $line);
    }
}