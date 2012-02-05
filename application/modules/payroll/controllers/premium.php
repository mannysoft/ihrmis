<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Premiums extends Controller {

	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
		$this->output->enable_profiler(TRUE);
		
		
    }
	
	function list_premiums()
	{
		$results = $this->Employee->get_employee_list($office_id, $employee_id = '', 
																$xml = TRUE);
		header('Content-type: application/xml');
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		$xml = '<?xml version="1.0" encoding="UTF-8"?>
		<leave>';
		
		$i = '';
		
		foreach($results as $result)
		{
			$i = 1;
			$xml.= '<name>
						<Employee_ID>'.$result['id'].'</Employee_ID>
						<Last_Name>'.$result['lname'].'</Last_Name>
						<First_Name>'.$result['fname'].'</First_Name>
						<Middle_Name>'.$result['mname'].'</Middle_Name>
						<Position>'.$result['position'].'</Position>
						<Salary>'.$result['monthly_salary'].'</Salary>
				 </name>';
		}
		$xml.= '</leave>';
		
		
		
		if ($i == '')
		{
			$xml = '<?xml version="1.0" encoding="UTF-8"?>
			<leave><name>
							<Employee_ID></Employee_ID>
							<Last_Name></Last_Name>
							<First_Name></First_Name>
							<Middle_Name></Middle_Name>
							<Position></Position>
							<Salary></Salary>
					 </name></leave>';
			
		}
		
		echo str_replace('&', '&amp;', $xml);

	}
}	