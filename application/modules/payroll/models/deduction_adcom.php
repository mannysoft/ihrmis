<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deduction_adcom extends DataMapper{

	public $table  = 'payroll_deduction_adcoms';
	
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