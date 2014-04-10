<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use Illuminate\Database\Eloquent\Model as Eloquent;

require_once('connection.php');
 
class LeaveCardEloquent extends BaseModel {

	protected $table = "leave_card";
	
	protected static $rules = array();
	
	protected static $messages = array();
	
	public function scopePaginate1($query, $perPage = '5')
    {
        $ci = & get_instance();
		parse_str($ci->input->server('QUERY_STRING'), $_GET);
	
		$page = Input::get('page');
		
		if($page) 
			$start = ($page - 1) * $perPage; 			//first item to display on this page
		else
			$start = 0;
		
		return $query->skip($start)->take($perPage)->get();
	
    }
}