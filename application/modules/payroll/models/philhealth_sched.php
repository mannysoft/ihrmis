<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Philhealth_sched extends DataMapper{

	public $table  = 'payroll_philhealth_schedules';
	
	//http://www.philhealth.gov.ph/partners/employers/contri_tbl.html
	
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