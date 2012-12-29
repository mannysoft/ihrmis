<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payroll_heading extends DataMapper{

	public $table  = 'payroll_headings';
		
	// --------------------------------------------------------------------
	
	
	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	function get_line($line = 1)
	{
		$this->where('line', $line);
		$this->order_by('order');
		$this->get();
		
		return $this;
	}
	
	// --------------------------------------------------------------------
	
	function get_line_desc()
	{
		
	}
	
}

/* End of file user.php */
/* Location: ./application/models/pages.php */