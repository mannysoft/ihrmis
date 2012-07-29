<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Application Software use by Government agencies for management
 * of employees Attendance, Leave Administration, Payroll, Personnel
 * Training, Service Records, Performance, Recruitment and more...
 *
 * @package		iHRMIS
 * @author		Manolito Isles
 * @copyright	Copyright (c) 2008 - 2012, Charliesoft
 * @license		http://charliesoft.net/hrmis/user_guide/license.html
 * @link		http://charliesoft.net
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * iHRMIS Conversion Table Class
 *
 * This class use for converting number of minutes late
 * to the corresponding equivalent to leave credits.
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manolito Isles
 * @link		http://charliesoft.net/hrmis/user_guide/models/conversion_table.html
 */
class Premiums extends Controller {

	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
		//$this->output->enable_profiler(TRUE);
		
		
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