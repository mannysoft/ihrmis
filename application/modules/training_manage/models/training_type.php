<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Training_type extends DataMapper{

	var $has_many = array("training_course");
	
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();
		
		//$this->load->helper('security');
	}
	
	// --------------------------------------------------------------------
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */