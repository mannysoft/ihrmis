<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deduction_optional extends DataMapper{

	public $table  = 'payroll_deduction_optional';
	
	var $has_one = array('deduction_information');

	
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();		
	}
	
	// --------------------------------------------------------------------
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */