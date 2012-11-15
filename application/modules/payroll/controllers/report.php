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
 * @copyright	Copyright (c) 2008 - 2013, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
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
class Report extends MX_Controller {

	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
		
		$this->load->model('options');
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		
		//$this->output->enable_profiler(TRUE);
		
		
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
	
	// --------------------------------------------------------------------
	
	function signatory()
	{		
		$data['page_name'] = '<b>Signatories</b>';
		
		$data['msg'] = '';
		
		$p = new Deduction_agency();
		
		$this->load->library('pagination');
		
		$config['base_url'] = base_url().'payroll/report/signatory/';
		$config['total_rows'] = $p->get()->count();
		$config['per_page'] = '15';
		
		$this->pagination->initialize($config);
		
		// How many related records we want to limit ourselves to
		$limit = $config['per_page'];
		
		// Set the offset for our paging
		$offset = $this->uri->segment(3);
		
		// Get all positions
		//$p = new Position();
		$p->order_by('agency_name');
		
		$data['deductions'] = $p->get($limit, $offset);
		
		$data['main_content'] = 'report/signatory';
		
		$this->load->view('includes/template', $data);
	}

}	