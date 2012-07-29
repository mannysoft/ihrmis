<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personal extends DataMapper{

	var $table  = 'pds_personal_info';
	
	//var $has_one = array("ebs");
	
	//var $has_many = array("ebs");
	
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