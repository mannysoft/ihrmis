<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Family extends DataMapper{

	var $table  = 'pds_family_background';
	
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