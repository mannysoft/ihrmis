<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plantilla_m extends DataMapper{

	public $table  = 'plantilla';
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