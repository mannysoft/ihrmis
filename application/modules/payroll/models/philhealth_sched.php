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
	
	function get_amount($salary = 0, $share = 'employee_share')
	{
		$this->where('start_range <=', $salary);
		$this->order_by('start_range', 'DESC');
		$this->limit(1);
		$this->get();
		return $this->$share;
	}
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */