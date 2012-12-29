<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_entitlement_m extends DataMapper{

	public $table  = 'payroll_staff_entitlement';
	
	//var $has_many = array('deductions_information');
	
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();
		
		//$this->load->helper('security');
	}
	
	// --------------------------------------------------------------------
	
	function get_add_com($employee_id, $additional_compensation_id, $date = '')
	{
		$this->where('employee_id', $employee_id);
		$this->where('additional_compensation_id', $additional_compensation_id);
		$this->get();
		//echo $this->db->last_query();
		
		return $this->amount;
	}
	
	function get_amount()
	{
		
	}
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */