<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pae extends DataMapper{

	public $table  = 'payroll_pae';
	
	//var $has_many = array('deductions_information');
	
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	function options()
	{
		$options = $this->get();
		
		foreach($options as $option)
		{
			$pae_options[$option->id] = $option->tax_status;
		}
		
		return $pae_options;
	}
	
	// --------------------------------------------------------------------
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */