<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
		$this->output->enable_profiler(TRUE);
		
		
    }
	
	// --------------------------------------------------------------------
	/**
	 * Enter description here...
	 *
	 */
	function general_payroll($office_id = 26)
	{
		$results = $this->Employee->get_employee_list($office_id, $employee_id = '', 
																$xml = TRUE);
		header('Content-type: application/xml');
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		$xml = '<?xml version="1.0" encoding="UTF-8"?>
		<CATALOG>';
		
		$i = '';
		
		foreach($results as $result)
		{
			$i = 1;
			$xml.= '<CD>
						<TITLE>'.$result['lname'].', '.$result['fname'].' '.$result['mname'].'</TITLE>
						<ARTIST>'.$result['lname'].'</ARTIST>
						<COUNTRY>'.$result['fname'].'</COUNTRY>
						<COMPANY>'.$result['mname'].'</COMPANY>
						<PRICE>'.$result['position'].'</PRICE>
						<YEAR>'.$result['monthly_salary'].'</YEAR>
		  		 </CD>';
		}
		$xml.= '</CATALOG>';
		
		
		
		if ($i == '')
		{
			$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<CATALOG><CD>
							<Employee_ID></Employee_ID>
							<Last_Name></Last_Name>
							<First_Name></First_Name>
							<Middle_Name></Middle_Name>
							<Position></Position>
							<Salary></Salary>
					 </CD></CATALOG>';
			
		}
		
		echo str_replace('&', '&amp;', $xml);

	}
	
	function payslip()
	{
		
	}
	
	function salary_index()
	{
	
	}
	
	function loan_balance()
	{
	
	}
	
	function income_tax()
	{
	
	}
	
	function signatory()
	{
	
	}

}	