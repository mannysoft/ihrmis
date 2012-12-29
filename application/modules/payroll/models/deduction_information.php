<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deduction_information extends DataMapper{

	public $table  = 'payroll_deduction_informations';
	
	//var $has_one = array('deductions_agency');
	public $has_many = array('deduction_optional');

	
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