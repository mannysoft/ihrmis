<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Integrated Human Resource Management Information System
 *
 * An Open source Application Software use by Government agencies for 
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
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
 * @author		Manny Isles
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
	
	function sortable()
	{
		$headings = $this->input->post('headings');
		
		$headings2 = $this->input->post('headings2');
		
		if ($headings2 != '')
		{
			$headings = $headings2;
		}
		
		foreach ($headings as $order => $id)
		{
			PayrollHeading::where('id', '=', $id)
			->update(array('order' => $order));
		}
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
	
	// --------------------------------------------------------------------
	
	function payslip()
	{			
		$p = new Payslip();
		
		$users = $p->where('office_id' , '=', 21)->get();
				
		foreach ($users as $user)
		{
			$deductions = $user->deductions;
			
			foreach ($deductions as $d)
			{
				echo $d->amount.'<br>';
			}
		}
		
		
		$d = new Deductions();
		
		$deductions = $d->where('id' , '=', 126)->get();
		
		
		foreach ($deductions as $dd)
		{
			echo $dd->employee->lname;
		}
		
		// For single record
		$deductions = $d->find(126);
		
		echo $deductions->employee->lname;
		
		
		
	}
	
	// --------------------------------------------------------------------
	
	function salary_index($employee_id = '')
	{
		$data['page_name'] = '<b>Employee Salary Index</b>';
				
		$data['employee_id'] = $employee_id;
		
		$data['msg'] = '';
								
		if ( $this->input->post('op'))
		{

		}
		
		$e = new Employee_m();
			
		$e->where('permanent', 1);
		$e->where('id', 171);
		$e->order_by('lname');
		
		$data['employees'] = $e->get();
				
		$data['main_content'] = 'report/salary_index';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function loan_balance()
	{
		$data['page_name'] = '<b>Loan Balance</b>';
				
		$data['employee_id'] = '';
		
		$data['msg'] = '';
		
		$data['loans'] = array();
		
		if ( $this->input->post('op'))
		{
			$data['employee_id'] 	= $this->input->post('employee_id');
			$data['selected'] 		= $this->input->post('office_id');
			
			$e = Employee_Eloquent::find($this->input->post('employee_id'));
			
			$data['loans'] = $e->loan;
			
		}
		
		$data['main_content'] = 'report/loan_balance';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
	function loan_payments($loan_id = '', $employee_id = '')
	{
		$data['page_name'] = '<b>Loan Balance</b>';
				
		$data['employee_id'] = '';
		
		$data['msg'] = '';
		
		$data['loans'] = array();
		
		if ( $this->input->post('op'))
		{
			$data['employee_id'] 	= $this->input->post('employee_id');
			$data['selected'] 		= $this->input->post('office_id');
			
			$e = Employee_Eloquent::find($this->input->post('employee_id'));
			
			$data['loans'] = $e->loan;
			
		}
		
		$data['main_content'] = 'report/loan_balance';
		
		$this->load->view('includes/template', $data);	
	}
	
	// --------------------------------------------------------------------
	
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
	
	// --------------------------------------------------------------------
	
	function headings($line = '1')
	{		
		$data['page_name'] = '<b>Payroll Headings</b>';
		
		$data['msg'] = '';
				
		$data['rows'] = PayrollHeading::where('line', '=', 1)
						->orderBy('order')
						->get();
						
		$data['rows2'] = PayrollHeading::where('line', '=', 2)
						->orderBy('order')
						->get();				
		
		$data['main_content'] = 'report/headings';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function headings_save($id = '')
	{		
		$data['page_name'] = '<b>Save Heading</b>';
		
		$data['msg'] = '';
						
		$data['row'] = PayrollHeading::blankRecord();
		
		if ($this->input->post('op'))
		{			
			$info = array(
					'type' 							=> $this->input->post('type'),
					'line' 							=> $this->input->post('line'),
					'additional_compensation_id' 	=> $this->input->post('additional_compensation_id'),
					'deduction_id' 					=> $this->input->post('deduction_id'),
					'caption' 						=> $this->input->post('caption'),
					);
					
			$data['row'] = $row = PayrollHeading::find($id);		
			
			if ($row === NULL)
			{
				PayrollHeading::insert($info);
			}
			else
			{
				PayrollHeading::where('id', '=', $id)
						->update($info);
			}
			
			redirect(base_url().'payroll/report/headings');
		}
				
		$data['compensations'] 	= AdditionalCompensation::listBox($id);
		$data['deductions'] 	= DeductionInformation::listBox($id);
				
		$data['main_content'] = 'report/headings_save';
		
		$this->load->view('includes/template', $data);
	}
	
	// --------------------------------------------------------------------
	
	function jo_preview( $office_id = '' , $period = '')
	{
		
		$this->Employee->fields = array(
                                'id',
                                'employee_id',
                                'office_id',
                                'lname',
                                'fname',
                                'mname',
								'tax_status',
								'dependents'
                                );
								
		$this->Employee->employment_type = 4;
		
		$rows = $this->Employee->get_employee_list($office_id, '');
		
		$o = new Office_m();
		
		$o->get_by_office_id($office_id);
		
		$disbursing_officer = $o->disbursing_officer;
		
		$str = $o->office_name;
				
		if ((strlen($str) % 2) == 1)
		{
			$str .= ' ';
		}
		
		$length = (strlen($str) / 2);
		
		$arr2 = str_split($str, $length);
		
		$office_page1 = $arr2[0];
		$office_page2 = $arr2[1];
		
		list($month, $day1, $day2, $year) = explode("-", $period);
		
		$month_name = $this->Helps->get_month_name($month);
		
		$period_text = 'For the Month of ' . $month_name . ' ' . $day1 . '-' . $day2 . ', ' . $year;
		
		
		if ((strlen($period_text) % 2) == 1)
		{
			$period_text .= ' ';
		}
		
		$length = (strlen($period_text) / 2);
		
		$period_text_arr = str_split($period_text, $length);
		
		$period_page1 = $period_text_arr[0];
		$period_page2 = $period_text_arr[1];
		
		$agency_accountant = $this->Settings->get_selected_field('agency_accountant');
		$agency_accountant_position = $this->Settings->get_selected_field('agency_accountant_position');
		
		$head_of_office = $this->Settings->get_selected_field('head_of_office');
		$head_of_office_position = $this->Settings->get_selected_field('head_of_office_position');
						
		$heading = '<table width="100%" border="0">
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"></td>
    <td>&nbsp;</td>
    <td align="right"><H1>DAILY WAGE PAY</H1></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">'.strtoupper($office_page1).'</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><strong>'.$period_page1.'</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" style="font-size:11px">We acknowledge receipt of the sum shown opposite our names as full compensation for the services rendered for the period stated.</td>
  </tr>
</table>';
		
		
		$page = '
<table width="100%" border="1">
  <tr>
    <td width="3%" rowspan="3" align="center" valign="middle"><strong>No.</strong></td>
    <td width="45%" rowspan="3" align="center" valign="middle"><strong>NAME</strong></td>
    <td width="19%" rowspan="3" align="center" valign="middle"><strong>TIN</strong></td>
    <td width="12%" rowspan="3" align="center" valign="middle"><strong>Tax Exemption</strong></td>
    <td width="12%" rowspan="3" align="center" valign="middle"><strong>Rate per Day</strong></td>
    <td width="6%" rowspan="3" align="center" valign="middle"><strong>Rate per Hour</strong></td>
    <td width="3%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>';
  
  
 
  
 	
		
		
	$grand_total_salary = 0;
    $grand_total_amount_due = 0;
    $deduction = 0;	
  
  $p = new Personal_m();
  $r = new Rates();
  $j = new Jo_days();
  
  $n = 1;
  
  foreach ($rows as $row)
  {
  		$p->get_by_employee_id($row['id']);
		$r->get_by_employee_id($row['employee_id']);
		
		$j->where('employee_id',$row['employee_id']);
		$j->where('period', $period);
		$j->get();
		
		$total_salary = $r->rate_per_day * $j->days;
		$grand_total_salary += $total_salary;
		
		$total_amount_due = $total_salary - $deduction;
		$grand_total_amount_due += $total_amount_due;
		
	 
	 $tax_status = ($row['tax_status'] != 'Single' ) ? 'ME'.$row['dependents'] : 'S';
	 
	  $page .= '<tr>
		<td>'.$n.'</td>
		<td>'.strtoupper($row['lname']).', '.$row['fname'].' '.$row['mname'].'</td>
		<td>'.$p->tin.'</td>
		<td>'.$tax_status.'</td>
		<td align="right">'.number_format($r->rate_per_day, 2).'</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>';
	  
	  $n ++;
  
  }
  
  $page.=
  '<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>TOTAL</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="1">
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="3%">&nbsp;</td>
        <td width="64%">CERTIFIED</td>
        <td width="4%">&nbsp;</td>
        <td width="6%">&nbsp;</td>
        <td width="4%">&nbsp;</td>
        <td width="16%">&nbsp;</td>
        <td width="3%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6">Each person whose name appears on this rolls had rendered services for the time stated</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">_______________________</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><strong>'.strtoupper($o->office_head).'</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">Date</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="5" style="font-size:11px">'.$o->position.'</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="3%">&nbsp;</td>
        <td width="35%">CERTIFIED: Funds available in the amount of</td>
        <td width="33%">'.number_format($grand_total_amount_due, 2).'</td>
        <td width="6%">&nbsp;</td>
        <td width="4%">&nbsp;</td>
        <td width="16%">&nbsp;</td>
        <td width="3%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center"><strong>'.$agency_accountant.'</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">_______________________</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td align="center">'.$agency_accountant_position.'</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">Date</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<pagebreak />
';




$page2 = '<table width="100%" border="0">
  <tr>
    <td><H1>ROLL - JOB ORDER</H1></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"></td>
    <td>&nbsp;</td>
    <td align="right"></td>
  </tr>
  <tr>
    <td>'.strtoupper($office_page2).'</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>' . $period_page2 . '</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6">&nbsp;</td>
  </tr>
</table>

<table width="100%" border="1">
  <tr>
    <td width="5%" rowspan="3" align="center" valign="middle"><strong>No of Hours</strong></td>
    <td width="19%" rowspan="3" align="center" valign="middle"><strong>No. of Days with Pay</strong></td>
    <td width="15%" rowspan="3" align="center" valign="middle"><strong>Total Amount of Salary</strong></td>
    <td width="7%" rowspan="3" align="center" valign="middle">&nbsp;</td>
    <td width="10%" rowspan="3" align="center" valign="middle"><strong>Total Deductions</strong></td>
    <td width="13%" rowspan="3" align="center" valign="middle"><strong>Total Amount Due</strong></td>
    <td width="5%" rowspan="3" align="center" valign="middle"><strong>No.</strong></td>
    <td width="20%" rowspan="3" align="center" valign="middle"><strong>SIGNATURE OR THUMBMARK</strong></td>
    <td width="6%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>';
  
    $n = 1;
    $grand_total_salary = 0;
    $grand_total_amount_due = 0;
    $deduction = 0;
  
  $j = new Jo_days();
  
  foreach ($rows as $row)
  {
	  	$j->where('employee_id',$row['employee_id']);
		$j->where('period', $period);
		$j->get();
		
		$total_salary = $r->rate_per_day * $j->days;
		$grand_total_salary += $total_salary;
		
		$total_amount_due = $total_salary - $deduction;
		$grand_total_amount_due += $total_amount_due;
  
	  $page2 .='
	  <tr>
		<td></td>
		<td align="right">'.$j->days.'</td>
		<td align="right">'.number_format($total_salary, 2).'</td>
		<td>&nbsp;</td>
		<td align="right">'.$deduction.'</td>
		<td align="right">'.number_format($total_amount_due, 2).'</td>
		<td>'.$n.'</td>
		<td></td>
		<td>&nbsp;</td>
	  </tr>';
  
  $n ++;
  
  }
  
  $page2 .='
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>TOTAL</strong></td>
    <td align="right"><strong>'.number_format($grand_total_salary, 2).'</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><strong>'.number_format($grand_total_amount_due, 2).'</strong></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="100%" border="1">
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="3%">&nbsp;</td>
        <td colspan="2">APPROVED FOR PAYMENT</td>
        <td width="31%">&nbsp;</td>
        <td width="4%">&nbsp;</td>
        <td width="16%">&nbsp;</td>
        <td width="3%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="17%">&nbsp;</td>
        <td width="26%">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">_______________________</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center"><strong>'.$head_of_office.'</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">Date</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">'.$head_of_office_position.'</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td width="3%">&nbsp;</td>
        <td colspan="6">CERTIFIED: Each person whose name appears on the above rolls has been</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="6">paid the amount stated opposite his name after identifying himself</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td width="17%">&nbsp;</td>
        <td width="26%">&nbsp;</td>
        <td width="31%">&nbsp;</td>
        <td width="4%">&nbsp;</td>
        <td width="16%">&nbsp;</td>
        <td width="3%">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center"><strong>'.$disbursing_officer.'</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">_______________________</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">Disbursing Officer</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">Date</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
';

		
		
		$html = $heading.$page.$page2;
		
		$params = array('format' => 'Legal');
		
		$this->load->library('mpdf', $params);
		
		//$mpdf=new mPDF('c','Letter'); 

		$this->mpdf->mirrorMargins = 1;	// Use different Odd/Even headers and footers and mirror margins
		
		$stylesheet = file_get_contents(base_url().'css/mpdf/mpdfstyletables.css');
		$this->mpdf->WriteHTML($stylesheet,1); // The parameter 1 tells that this is css/style only and no
		
		
		$this->mpdf->WriteHTML($html);
		
		$this->mpdf->Output();
		
	}

}	