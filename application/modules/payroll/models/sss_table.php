<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sss_table extends DataMapper{

	public $table  = 'payroll_sss_tables';
		
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