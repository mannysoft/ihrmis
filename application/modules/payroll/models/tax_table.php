<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tax_table extends DataMapper{

	var $table  = 'payroll_tax_table';
	
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