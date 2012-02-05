<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends DataMapper{

	//var $table  = 'pds_profile';
	var $table  = 'employee';
	
	//var $has_one = array("position", 'personal');
	
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();
		
	}
	
	// --------------------------------------------------------------------
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */