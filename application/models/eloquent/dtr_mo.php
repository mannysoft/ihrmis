<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once('connection.php');

use Illuminate\Database\Eloquent\Model as Eloquent;
 
class Dtr_mo extends Eloquent {

	const STATUS_INACTIVE = 'Inactive';
	const STATUS_ACTIVE   = 'Active';
	
	public $table = "dtr";
	
	function yeah()
	{
		
	}
	
}