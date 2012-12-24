<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cos_status extends DataMapper{

	public $table  = 'payroll_cos_status';
		
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

			if ( ! $this->exists() )
			{
				$this->employee_id 	= $row['employee_id'];
				$this->status 		= 'FT';
				$this->save();
			}

			
			
		}
	}
	
	// --------------------------------------------------------------------
	
	function status($employee_id)
	{
		$this->where('employee_id', $employee_id);
			
		$this->get();
		
		return $this->status;
	}
	
	// --------------------------------------------------------------------
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */