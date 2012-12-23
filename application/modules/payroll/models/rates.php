<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rates extends DataMapper{

	public $table  = 'payroll_rates';
		
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	function populate($rows = array())
	{
		foreach ( $rows as $row)
		{			
			$this->where('employee_id', $row['employee_id']);
			
			$this->get();
			
			$this->employee_id 	= $row['employee_id'];
			$this->rate_per_day 	= '';
			$this->save();
			
		}
	}
	
	// --------------------------------------------------------------------
	
	function edit_place()
	{
		
	}
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */