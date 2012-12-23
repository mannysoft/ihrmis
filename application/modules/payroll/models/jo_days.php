<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jo_days extends DataMapper{

	public $table  = 'payroll_jo_days';
		
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	function populate($rows = array(), $number_days = 0, $period = '')
	{
		foreach ( $rows as $row)
		{			
			$this->where('employee_id', $row['employee_id']);
			
			$this->get();

			$this->period 		= $period;
			$this->employee_id 	= $row['employee_id'];
			$this->days 		= $number_days;
			$this->save();
			
		}
	}
	
	// --------------------------------------------------------------------
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */