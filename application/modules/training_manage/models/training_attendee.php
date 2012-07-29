<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Training_attendee extends DataMapper{

	//var $table  = 'training_course';
	
	public $has_manny = array("employee");
	
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	// --------------------------------------------------------------------
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */