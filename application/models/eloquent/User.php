<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;
 
class User extends Eloquent {

	public $timestamps = false;
	
	public $table = "users"; 
	
	// --------------------------------------------------------------------
	
	public function addcom()
    {
		return self::belongsTo('AdditionalCompensation', 'additional_compensation_id');
    }
	
	// --------------------------------------------------------------------
	
	
	// Scopes method
	public function scopeLine($query, $line)
    {
        return $query->where('line', '=', $line);
    }
}