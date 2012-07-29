<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deduction_loan extends DataMapper{

	public $table  = 'payroll_deduction_loans';
	
	//var $has_many = array('deductions_information');
	
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