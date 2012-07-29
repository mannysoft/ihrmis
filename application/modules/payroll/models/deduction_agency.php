<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deduction_agency extends DataMapper{

	public $table  = 'payroll_deduction_agencies';
	
	//var $has_many = array('deductions_information');
	
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();
		
		//$this->load->helper('security');
	}
	
	function get_agencies()
	{
		$data = array();
		
		$this->order_by('agency_name');
		
		$agencies = $this->get();
		
		foreach ($agencies as $agency)
		{
			$data[$agency->id] = $agency->agency_name;
		}
		
		return $data;
	}
	
	// --------------------------------------------------------------------
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */