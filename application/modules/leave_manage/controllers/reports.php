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
//http://codeigniter.com/forums/viewthread/91996/
class Reports extends MX_Controller
{
	// --------------------------------------------------------------------
	public $pages			= array();
	public $vacation_leave 	= 0;
	public $sick_leave 		= 0;
	public $date_retired	= '';
	
	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
    }	
	
	// --------------------------------------------------------------------
		
	function leave_certification($vl = 0, $sl = 0, $employee_id = '004001') 
	{
		$lgu_code = $this->Settings->get_selected_field('lgu_code'); 
		
		// Marinduque Province
		if ( $lgu_code == 'marinduque_province' )
		{
	
			$this->leave_certification_marinduque($vl, $sl, $employee_id);
			
			return;
		}
		
		// Laguna Province
		if ( $lgu_code == 'laguna_province' )
		{
	
			$this->leave_certification_laguna($vl, $sl, $employee_id);
			
			return;
		}
		
		if ( $lgu_code == 'training' )
		{
	
			$this->leave_certification_training($vl, $sl, $employee_id);
			
			return;
		}
		
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('P', 'mm', 'Letter');
		// add a page
		$pdf->AddPage();
		
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/certification4.pdf');
		
		// select the first page
		$tplIdx = $pdf->importPage(1);
		
		// use the page we imported
		$pdf->useTemplate($tplIdx);
		
		$vacation_leave =  $vl;
		$sick_leave 	=  $sl;
		
		$name = $this->Employee->get_employee_info($employee_id);
		
		
		$office_name = $this->Office->get_office_name($name['office_id']);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','B',12);
		
		
		// set initial placement
		$pdf->SetXY(136,50.5);
		
		// line break
		
		$pdf->Write(0, date('F').' '.date('d').', '.date('Y'));
		
		$pdf->Ln(37);
		// go to 25 X (indent)
		$pdf->SetX(35);
		
		// write
		$pdf->Write(0, $name['salut'].' '.ucwords(strtolower(utf8_decode($name['fname']))).' '.
										  ucwords(strtolower(utf8_decode($name['mname']))).' '.
										  ucwords(strtolower(utf8_decode($name['lname'])))
										  );
		
		$pdf->Ln(5.5);
		
		$pdf->SetX(35);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','',12);
		$pdf->Write(0, $name['position']);
		
		
		//$office_name_row = $Settings->splitstroverflow($office_name, 25);	//office name
		
		$pdf->Ln(5.5);
		
		$pdf->SetX(35);
		
		$pdf->Write(0, $office_name);
		
		$pdf->Ln(5.5);
		
		$pdf->SetX(35);
		
		$pdf->Write(0, 'City of Puerto Pricesa');
		
		
		$pdf->Ln(10);
		
		$pdf->SetX(35);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','B',12);
				
		$greet = 'Sir/Madam:';
		
		$pdf->Write(0, $greet);
		
		
		//get the last month that earned leave credit
		$last_month_last_day = date('Y-m-d',strtotime('-1 second',strtotime(date('m').'/01/'.date('Y').' 00:00:00')));
		
		//list($year, $month, $day) = split('[-.-]', $last_month_last_day);deprecated
		list($year, $month, $day) = explode('-', $last_month_last_day);
		
		$last_month_last_day = date("F d, Y", mktime(0, 0, 0, $month, $day, $year));
		
		$pdf->Ln(9);
		
		$pdf->SetX(136);
		
		$pdf->Write(0, date("F d, Y").':');
		
		//credits
		//vaation
		$pdf->Ln(23);
		
		$pdf->SetX(52);
		
		$pdf->Write(0, number_format($vacation_leave, 3));
		
		//sick
		//$pdf->Ln(9);
		
		$pdf->SetX(108);
		
		$pdf->Write(0, number_format($sick_leave, 3));
		
		//total
		//$pdf->Ln(7);
		
		$pdf->SetX(160);
		
		$pdf->Write(0, number_format($vacation_leave + $sick_leave, 3));
		
		
		//date for the day
		$pdf->Ln(21);
		
		$pdf->SetX(67);
		
		//day
		//$pdf->Write(0, date('jS'));
		
		$pdf->SetX(104);
		
		//$pdf->Write(0, date('F'));
		
		//year
		//$pdf->SetX(160);
		$pdf->Ln(25);
		
		$notice_leave_balance 					= $this->Settings->get_selected_field( 'notice_leave_balance' );
		$notice_leave_balance_position 			= $this->Settings->get_selected_field( 'notice_leave_balance_position' );
		$notice_leave_balance_noted 			= $this->Settings->get_selected_field( 'notice_leave_balance_noted' );
		$notice_leave_balance_noted_position 	= $this->Settings->get_selected_field( 'notice_leave_balance_noted_position' );
		
		//$pdf->Write(0,$notice_leave_balance);
		
		$pdf->Cell(290,5, $notice_leave_balance,			'0',	1,'C',false); //4th param border
		$pdf->Cell(290,5, $notice_leave_balance_position,	'0',	1,'C',false);
		
		$pdf->SetX(40);
		
		$pdf->Ln(20);
		
		$pdf->Cell(120,5, $notice_leave_balance_noted,	'0',	1,'C',false);
		$pdf->Cell(120,5, $notice_leave_balance_noted_position,	'0',	1,'C',false);		
		
		//MR or MS. request
		$pdf->Ln(7);
		
		$pdf->SetX(32);
		
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
		
		header('Pragma: public');
		
		$pdf->Output('dtr/reports/leave_certification_'.$employee_id.'.pdf', 'F'); 
		
		redirect(base_url().'dtr/reports/leave_certification_'.$employee_id.'.pdf', 'refresh');
		
		
	}
	
	// --------------------------------------------------------------------
	
	function leave_certification_marinduque($vl = 0, $sl = 0, $employee_id = '1')
	{
		
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('P', 'mm', 'Letter');
		// add a page
		$pdf->AddPage();
		
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/certification/marinduque_certification.pdf');
		
		// select the first page
		$tplIdx = $pdf->importPage(1);
		
		// use the page we imported
		$pdf->useTemplate($tplIdx);
		
		$vacation_leave =  $vl;
		$sick_leave 	=  $sl;
		
		$name = $this->Employee->get_employee_info($employee_id);
		
		
		$office_name = $this->Office->get_office_name($name['office_id']);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','B',12);
		
		
		// set initial placement
		$pdf->SetXY(136,50.5);
		
		// line break
		
		//$pdf->Write(0, date('F').' '.date('d').', '.date('Y'));
		
		$pdf->Ln(37);
		// go to 25 X (indent)
		$pdf->SetX(35);
		
										  
		$pdf->MultiCell(0,6,"                This is to certify that ".$name['salut'].' '.ucwords(strtolower(utf8_decode($name['fname']))).' '.
										 ucwords(strtolower(utf8_decode($name['mname']))).' '.
										  ucwords(strtolower(utf8_decode($name['lname']))).', '.$name['position'] .' of the '.$office_name.
										  ' has accumulated leave credits as of '.date('F').' '.date('d').', '.date('Y').
										  '.' ,0,'L',false);								  
		
		$pdf->Ln(5.5);
		
		$pdf->SetX(35);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','',12);
		//$pdf->Write(0, $name['position']);
		
				
		$pdf->Ln(5.5);
		
		$pdf->SetX(35);
		
		//$pdf->Write(0, $office_name);
		
		$pdf->Ln(5.5);
		
		$pdf->SetX(35);		
		
		$pdf->Ln(4);
		
		$pdf->SetX(35);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','B',12);
		
		//get the last month that earned leave credit
		$last_month_last_day = date('Y-m-d',strtotime('-1 second',strtotime(date('m').'/01/'.date('Y').' 00:00:00')));
		
		//list($year, $month, $day) = split('[-.-]', $last_month_last_day);deprecated
		list($year, $month, $day) = explode('-', $last_month_last_day);
		
		$last_month_last_day = date("F d, Y", mktime(0, 0, 0, $month, $day, $year));
		
		$pdf->SetX(136);
		
		$pdf->SetXY(62, 126);
		
		$pdf->Write(0, number_format($vacation_leave, 3));
		
		//sick		
		$pdf->SetX(110);
		
		$pdf->Write(0, number_format($sick_leave, 3));
		
		//total		
		$pdf->SetX(150);
		
		$pdf->Write(0, number_format($vacation_leave + $sick_leave, 3));
		
		$pdf->Ln(5);
		$pdf->SetX(35);
		
		$pdf->MultiCell(0,6,"                ISSUED this ".date('jS')." day of ".date('F, Y')." upon request of ".
		                    $name['salut'].' '.ucwords(strtolower(utf8_decode($name['lname'])))." for whatever legal purpose it may serve." ,0,'L',false);

		$pdf->Ln(15);
		$pdf->SetX(110);

		$statement_prepared 			= $this->Settings->get_selected_field( 'statement_prepared' );
		$statement_prepared_position 	= $this->Settings->get_selected_field( 'statement_prepared_position' );
		$statement_certified 			= $this->Settings->get_selected_field( 'statement_certified' );
		$statement_certified_position 	= $this->Settings->get_selected_field( 'statement_certified_position' );
		
		//$pdf->Cell(90,5, $statement_prepared,			'0',	0,'C',false); //4th param border
		$pdf->Cell(90,5, $statement_certified,			'0',	1,'C',false);
		//$pdf->Cell(90,5, $statement_prepared_position,	'0',	0,'C',false);
		$pdf->SetX(110);
		$pdf->Cell(90,5, $statement_certified_position,	'0',	1,'C',false);
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
		
		header('Pragma: public');
		
		//$pdf->Output('dtr/reports/leave_certification_'.$employee_id.'.pdf', 'F'); 
		$pdf->Output('dtr/reports/leave_certification_'.$employee_id.'.pdf', 'I'); 
		
		//redirect(base_url().'dtr/reports/leave_certification_'.$employee_id.'.pdf', 'refresh');
		
		
	}
	
	// --------------------------------------------------------------------
	
	function leave_certification_laguna($vl = 0, $sl = 0, $employee_id = '1')
	{
		
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('P', 'mm', 'Letter');
		// add a page
		$pdf->AddPage();
		
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/laguna_province/leave_certification.pdf');
		
		// select the first page
		$tplIdx = $pdf->importPage(1);
		
		// use the page we imported
		$pdf->useTemplate($tplIdx);
		
		$vacation_leave =  $vl;
		$sick_leave 	=  $sl;
		
		$name = $this->Employee->get_employee_info($employee_id);
		
		
		$office_name = $this->Office->get_office_name($name['office_id']);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','',12);
		
		
		// set initial placement
		$pdf->SetXY(136,50.5);
		
		// line break
		
		//$pdf->Write(0, date('F').' '.date('d').', '.date('Y'));
		
		$pdf->Ln(42);
		// go to 25 X (indent)
		$pdf->SetX(35);
		
										  
		$pdf->MultiCell(0,6,"                This is to certify that ".$name['salut'].' '.ucwords(strtolower(utf8_decode($name['fname']))).' '.
										 ucwords(strtolower(utf8_decode($name['mname']))).' '.
										  ucwords(strtolower(utf8_decode($name['lname']))).', '.$name['position'] .' of the '.$office_name.
										  ' has accumulated leave credits as of '.date('F').' '.date('d').', '.date('Y').
										  '.' ,0,'L',false);								  
		
		$pdf->Ln(5.5);
		
		$pdf->SetX(35);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','',12);
		//$pdf->Write(0, $name['position']);
		
				
		$pdf->Ln(5.5);
		
		$pdf->SetX(35);
		
		//$pdf->Write(0, $office_name);
		
		$pdf->Ln(5.5);
		
		$pdf->SetX(35);		
		
		$pdf->Ln(4);
		
		$pdf->SetX(35);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','',12);
		
		//get the last month that earned leave credit
		$last_month_last_day = date('Y-m-d',strtotime('-1 second',strtotime(date('m').'/01/'.date('Y').' 00:00:00')));
		
		//list($year, $month, $day) = split('[-.-]', $last_month_last_day);deprecated
		list($year, $month, $day) = explode('-', $last_month_last_day);
		
		$last_month_last_day = date("F d, Y", mktime(0, 0, 0, $month, $day, $year));
		
		
		
		$pdf->SetX(136);
				
		//credits
		//vaation
		
		
		$pdf->SetXY(62, 138);
		
		$pdf->Write(0, number_format($vacation_leave, 3));
		
		//sick		
		$pdf->SetX(110);
		
		$pdf->Write(0, number_format($sick_leave, 3));
		
		//total		
		$pdf->SetX(150);
		
		$pdf->Write(0, number_format($vacation_leave + $sick_leave, 3));
		
		$pdf->Ln(5);
		$pdf->SetX(35);
		
		$pdf->MultiCell(0,6,"                ISSUED this ".date('jS')." day of ".date('F, Y')." upon request of ".
		                    $name['salut'].' '.ucwords(strtolower(utf8_decode($name['lname'])))." for whatever legal purpose it may serve." ,0,'L',false);
		
		//date for the day
		$pdf->Ln(21);
		
		$pdf->SetX(67);
		
		//day
		//$pdf->Write(0, date('jS'));
		
		$pdf->SetX(104);
		
		//$pdf->Write(0, date('F'));
		
		//year
		$pdf->SetX(138);
		
		//$pdf->Write(0, date('Y'));
		
		//MR or MS. request
		$pdf->Ln(7);
		
		$pdf->SetX(32);
		
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
		
		header('Pragma: public');
		
		//$pdf->Output('dtr/reports/leave_certification_'.$employee_id.'.pdf', 'F'); 
		$pdf->Output('dtr/reports/leave_certification_'.$employee_id.'.pdf', 'I'); 
		
		//redirect(base_url().'dtr/reports/leave_certification_'.$employee_id.'.pdf', 'refresh');
		
		
	}
	

		
	// --------------------------------------------------------------------
	
	function leave_certification_training($vl = 0, $sl = 0, $employee_id = '1')
	{
		
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('P', 'mm', 'Letter');
		// add a page
		$pdf->AddPage();
		
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/certification/training_certification.pdf');
		
		// select the first page
		$tplIdx = $pdf->importPage(1);
		
		// use the page we imported
		$pdf->useTemplate($tplIdx);
		
		$vacation_leave =  $vl;
		$sick_leave 	=  $sl;
		
		$name = $this->Employee->get_employee_info($employee_id);
		
		
		$office_name = $this->Office->get_office_name($name['office_id']);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','B',12);
		
		
		// set initial placement
		$pdf->SetXY(136,50.5);
				
		$pdf->Ln(37);
		// go to 25 X (indent)
		$pdf->SetX(35);
		
										  
		$pdf->MultiCell(0,6,"                This is to certify that ".$name['salut'].' '.ucwords(strtolower(utf8_decode($name['fname']))).' '.
										 ucwords(strtolower(utf8_decode($name['mname']))).' '.
										  ucwords(strtolower(utf8_decode($name['lname']))).', '.$name['position'] .' of the '.$office_name.
										  ' has accumulated leave credits as of '.date('F').' '.date('d').', '.date('Y').
										  '.' ,0,'C',false);								  
		
		$pdf->Ln(5.5);
		
		$pdf->SetX(35);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','',12);
		//$pdf->Write(0, $name['position']);
		
				
		$pdf->Ln(5.5);
		
		$pdf->SetX(35);
		
		//$pdf->Write(0, $office_name);
		
		$pdf->Ln(5.5);
		
		$pdf->SetX(35);		
		
		$pdf->Ln(4);
		
		$pdf->SetX(35);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','B',12);
		
		//get the last month that earned leave credit
		$last_month_last_day = date('Y-m-d',strtotime('-1 second',strtotime(date('m').'/01/'.date('Y').' 00:00:00')));
		
		//list($year, $month, $day) = split('[-.-]', $last_month_last_day);deprecated
		list($year, $month, $day) = explode('-', $last_month_last_day);
		
		$last_month_last_day = date("F d, Y", mktime(0, 0, 0, $month, $day, $year));
		
		
		
		$pdf->SetX(136);
				
		//credits
		//vaation
		
		$pdf->SetX(62);
		
		$pdf->Write(0, number_format($vacation_leave, 3));
		
		//sick		
		$pdf->SetX(110);
		
		$pdf->Write(0, number_format($sick_leave, 3));
		
		//total		
		$pdf->SetX(150);
		
		$pdf->Write(0, number_format($vacation_leave + $sick_leave, 3));
		
		$pdf->Ln(5);
		$pdf->SetX(38);
		
		$pdf->MultiCell(0,6,"                ISSUED this ".date('jS')." day of ".date('F, Y')." upon request of ".
		                    $name['salut'].' '.ucwords(strtolower(utf8_decode($name['lname'])))." for  whatever legal purpose it may serve." ,0,'J',false);
		
		// Signatories
		$pdf->Ln(15);
		$pdf->SetX(20);
		
		$pdf->Cell(90,5,"PREPARED BY:",			'0',	0,'C',false);
		$pdf->Cell(90,5,"CERTIFIED CORRECT:",	'0',	1,'C',false);
		
		$pdf->Ln(10);
		
		// Get settings
		
		$statement_prepared 			= $this->Settings->get_selected_field( 'statement_prepared' );
		$statement_prepared_position 	= $this->Settings->get_selected_field( 'statement_prepared_position' );
		$statement_certified 			= $this->Settings->get_selected_field( 'statement_certified' );
		$statement_certified_position 	= $this->Settings->get_selected_field( 'statement_certified_position' );
		
		$pdf->SetX(20);
		
		$pdf->Cell(90,5, $statement_prepared,			'0',	0,'C',false); //4th param border
		$pdf->Cell(90,5, $statement_certified,			'0',	1,'C',false);
		
		$pdf->SetX(20);
		
		$pdf->Cell(90,5, $statement_prepared_position,	'0',	0,'C',false);
		$pdf->Cell(90,5, $statement_certified_position,	'0',	1,'C',false);		
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
		
		header('Pragma: public');
		
		$pdf->Output('dtr/reports/leave_certification_'.$employee_id.'.pdf', 'I'); 
				
	}
	
	// --------------------------------------------------------------------
	
	function statement_leave($state_no = '', $employee_id = '')
	{
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI(); // orig
		$pdf = new FPDI('P','mm','Legal');
		// add a page
		$pdf->AddPage();
		
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/statement_leave.pdf');
		
		// select the first page
		$tplIdx = $pdf->importPage(1);
		
		// use the page we imported
		$pdf->useTemplate($tplIdx);
		
		$this->Employee->fields = array(
										'id',
										'first_day_of_service', 
										'salut', 
										'fname', 
										'mname', 
										'lname',
										'office_id',
										'salary_grade',
										'step'
										);
		
		$name = $this->Employee->get_employee_info($employee_id);
		
		
		$first_day = $name['first_day_of_service'];
	
		list($year, $month, $day) = explode('-', $name['first_day_of_service']);
		
		
		//var_dump($name['first_day_of_service']);
		//exit;
		
		$entrance = $year.'-'.$month.'-'.$day;
		
		if($name['first_day_of_service'] !="")
		{
			$name['first_day_of_service'] = convert_long_date($name['first_day_of_service']);
		}
		
		
		// set font, font style, font size.
		$pdf->SetFont('Times','B',12);
		
		
		// set initial placement
		$pdf->SetXY(30, 34);
		
		// line break
		$pdf->Ln(13);
		
		//name
		$pdf->SetX(26);
		$pdf->Write(0, '  '.$name['salut'].' '.utf8_decode($name['fname'].' '.$name['mname'].' '.$name['lname']));
		
		
		//first day of sevice
		$pdf->Ln(5);
		$pdf->SetX(26);
		$pdf->Write(0, '  '.$this->Office->get_office_name($name['office_id']));
		
		//first day of service
		$pdf->SetX(161);
		$pdf->Write(0, $name['first_day_of_service']);
		
		$pdf->Ln(5);
		$pdf->SetX(10);
		
		$pdf->SetFont('Times','',12);
		
		$pdf->Cell(44,10,"Period Covered",	'RLTB',	0,'C',false);
		$pdf->Cell(40,5,'Leave Earned',		'1',	0,'C',false);
		$pdf->Cell(40,5,'Leave Spent',		'1',	0,'C',false);
		$pdf->Cell(40,5,'Leave Balance',	'1',	0,'C',false);
		$pdf->Cell(30,5,'Remarks',			'1',	1,'C',false);
		
		$pdf->Cell(44,5,"",			'RLB',	0,'C',false);
		$pdf->Cell(20,5,"Vacation",	'1',	0,'C',false);
		$pdf->Cell(20,5,"Sick",		'1',	0,'C',false);
		$pdf->Cell(20,5,"Vacation",	'1',	0,'C',false);
		$pdf->Cell(20,5,"Sick",		'1',	0,'C',false);
		$pdf->Cell(20,5,"Vacation",	'1',	0,'C',false);
		$pdf->Cell(20,5,"Sick",		'1',	0,'C',false);
		$pdf->Cell(30,5,"",			'1',	1,'C',false);
		
		$pdf->Ln(5);
		
		$x = 0;
		$year_count = 0;
		$year_diff = date('Y') - $year;
		
		
		$vacation_balance	= 0;
		$sick_balance		= 0;
		
		//set all the total varibles
		$vacation_earn_total 	= 0;
		$sick_earn_total 	 	= 0;
		$vacation_spent_total 	= 0;
		$sick_spent_total 		= 0;
		
		$vacation_balance_total = 0;
		$sick_balance_total 	= 0;
		
		$year = date('Y');
		
		// Check if there is a balance forwarded for the employee	
		$is_forwarded_leave_exists = $this->Leave_forwarded->is_forwarded_leave_exists($employee_id);
		
		// If there is a forwarded balance
		if ($is_forwarded_leave_exists == TRUE)
		{	
			//Get forwarded leave
			$row_leave 			= $this->Leave_forwarded->get_forwarded_leave($employee_id);
			
			$vacation_balance	= $row_leave['forwarded_vacation'];
			$sick_balance		= $row_leave['forwarded_sick'];
			
			$year = date('Y');
			
			$year = substr($row_leave['forwarded_note'], -4);    
			
			$next_day = substr($row_leave['forwarded_note'], -10);    
		}
		
		
		
		while(date('Y') >= $year)
		{
			
			$pdf->SetX(30);
		
			$pdf->Ln(5.1);
			
			// If in the first row
			if($x == 0)
			{
				// If Balance forwarded
				if ($is_forwarded_leave_exists == TRUE)
				{
					// Write the leave forwarded
					$pdf->Write(0, $row_leave['forwarded_note']);
				}
				else
				{
					// Write the first day of service up to last month of that year
					$pdf->Write(0, $month.'/'.$day.'/'.date("y", mktime(0, 0, 0, $month, $day, $year)).
										'  to  12/31/'.date("y", mktime(0, 0, 0, $month, $day, $year)));
				}
			}
			else
			{
				// If this is the last entry
				if(date('Y') == $year)
				{
					// Get the last month that earned leave credit
					$last_month_last_day = date('Y-m-d',strtotime('-1 second',strtotime(date('m').'/01/'.date('Y').' 00:00:00')));
		
					list($year3, $month3, $day3) = explode('-', $last_month_last_day);
					
					$last_month_last_day = date("m/d/y", mktime(0, 0, 0, $month3, $day3, $year3));

					// Write the period
					$pdf->Write(0, '01/01/'.date("y", mktime(0, 0, 0, $month, $day, $year)).
					               '  to  '.$last_month_last_day);
				}
				else
				{
					// Write the period
					$pdf->Write(0, '01/01/'.date("y", mktime(0, 0, 0, $month, $day, $year)).
					               '  to  12/31/'.date("y", mktime(0, 0, 0, $month, $day, $year)));
								   
								   //$pdf->Write(0, 'hehe');
				}
			}
			
			// ==============EARNED AND SPENT===================================
			
			// Vacation and sick leave earned output
			$row 			= $this->Leave_card->get_total_leave_earned($employee_id, $year);
			
			$sum_vacation  	= $row['sum_vacation'];
			$sum_sick  		= $row['sum_sick'];
			
			
			
			
			// Vacation leave spent output
			$row 				= $this->Leave_card->get_total_leave_spent($employee_id, $year);
			$vacation_spent 	= $row['vacation_spent'];
			$sick_spent 		= $row['sick_spent'];
			//echo $this->db->last_query();
			//exit;
			
			if ($is_forwarded_leave_exists == TRUE)
			{
				$sum_vacation  	= 0;
				$sum_sick  		= 0;
				$vacation_spent = 0;
				$sick_spent 	= 0;
			}
			
			
			// If Balance forwarded
			if ($is_forwarded_leave_exists == TRUE)
			{
				//$pdf->Write(0,$rowLeave['forwarded_note']);
			}
			else //Dont output the earnings
			{
				$pdf->SetX(54);
				if(number_format($sum_vacation, 3) !='0.000')
				{	
					$pdf->Write(0, number_format($sum_vacation, 3));
				}
				
				$pdf->SetX(75);
				if(number_format($sum_sick, 3) !='0.000')
				{	
					$pdf->Write(0, number_format($sum_sick, 3));
				}
			}
			
			//if Balance forwarded
			if ($is_forwarded_leave_exists == TRUE)
			{
				//$pdf->Write(0,$rowLeave['forwarded_note']);
			}
			else // Dont output the earnings =============================
			{
				//output vacation leave spent
				$pdf->SetX(95);
				
				//if the vacation spent is not equal to 0.000
				if(number_format($vacation_spent, 3) !='0.000')
				{	
					$pdf->Write(0, number_format($vacation_spent, 3));
				}
				
				
				//output sick leave spent
				$pdf->SetX(115);
				
				//if the sick spent is not equal to 0.000
				if(number_format($sick_spent, 3) !='0.000')
				{	
					$pdf->Write(0, number_format($sick_spent, 3));
				}
			}
			
			
			// ==============EARNED AND SPENT END===================================
			
			// ==============LEAVE BALANCES=========================================
			
			// Leave Balances
			$pdf->SetX(135);
			
			$vacation_balance += $sum_vacation - $vacation_spent;
			
			
			if(number_format($vacation_balance, 3) !='0.000')
			{	
				$pdf->Write(0, number_format($vacation_balance, 3));
			}
			
			
			$pdf->SetX(153);
			$sick_balance 	  += $sum_sick - $sick_spent;	
			
			if(number_format($sick_balance, 3) !='0.000')
			{	
				$pdf->Write(0, number_format($sick_balance, 3));
			}
			
			// ==============LEAVE BALANCES END======================================
			
			
			//this is for subtotal
			$vacation_earn_total 	+= $sum_vacation;
			$sick_earn_total 	 	+= $sum_sick;
			$vacation_spent_total 	+= $vacation_spent;
			$sick_spent_total 		+= $sick_spent;
			
			
			// Check here if leave forwarded
			if ($is_forwarded_leave_exists == TRUE)
			{
				$is_forwarded_leave_exists = FALSE;
				
				// Vacation and sick leave earned output
				$row 			= $this->Leave_card->get_total_leave_earned($employee_id, $year);
				
				$sum_vacation  	= $row['sum_vacation'];
				$sum_sick  		= $row['sum_sick'];
				
				
				
				
				// Vacation leave spent output
				$row 				= $this->Leave_card->get_total_leave_spent($employee_id, $year);
				$vacation_spent 	= $row['vacation_spent'];
				$sick_spent 		= $row['sick_spent'];
				//echo $this->db->last_query();;
				//exit;
				$pdf->Ln(5.1);
				
				$pdf->SetX(10);
				// Write the period
				//$pdf->Write(0, '01/01/'.date("y", mktime(0, 0, 0, $month, $day, $year)).
					              // '  to  12/31/'.date("y", mktime(0, 0, 0, $month, $day, $year)));
				
				$next_date = list($n_month, $n_day, $n_year) = explode('-', $next_day);
				
				//echo $n_year.'-'.$n_month.'-'.$n_day;
				//exit;
						   
				$pdf->Write(0, date('m/d/y', strtotime($n_year.'-'.$n_month.'-'.$n_day.' + 1 day')).
					               '  to  12/31/'.date("y", mktime(0, 0, 0, $month, $day, $year)));	
								   
				//$pdf->Write(0, date('m/d/y', strtotime($n_year.'-'.$n_month.'-'.$n_day.' + 1 day')).
					//               '  to '.date("m/d/y"));					   			   
								   
								   //echo date('m/d/y', strtotime('+1 day', $next_day))); 
				
				$pdf->SetX(54);
				
				if(number_format($sum_vacation, 3) !='0.000')
				{	
					$pdf->Write(0, number_format($sum_vacation, 3));
				}
				
				$pdf->SetX(75);
				
				if(number_format($sum_sick, 3) !='0.000')
				{	
					$pdf->Write(0, number_format($sum_sick, 3));
				}
				
				
				
				//output vacation leave spent
				$pdf->SetX(95);
				
				//if the vacation spent is not equal to 0.000
				if(number_format($vacation_spent, 3) !='0.000')
				{	
					$pdf->Write(0, number_format($vacation_spent, 3));
				}
				
				
				//output sick leave spent
				$pdf->SetX(115);
				
				//if the sick spent is not equal to 0.000
				if(number_format($sick_spent, 3) !='0.000')
				{	
					$pdf->Write(0, number_format($sick_spent, 3));
				}
				
				// Leave Balances
				$pdf->SetX(135);
				
				$vacation_balance += $sum_vacation - $vacation_spent;
				
				
				if(number_format($vacation_balance, 3) !='0.000')
				{	
					$pdf->Write(0, number_format($vacation_balance, 3));
				}
				
				
				$pdf->SetX(153);
				$sick_balance 	  += $sum_sick - $sick_spent;	
				
				if(number_format($sick_balance, 3) !='0.000')
				{	
					$pdf->Write(0, number_format($sick_balance, 3));
				}
				
				
				
				$vacation_earn_total 	+= $sum_vacation;
				$sick_earn_total 	 	+= $sum_sick;
				$vacation_spent_total 	+= $vacation_spent;
				$sick_spent_total 		+= $sick_spent;
				
			}
			
			//set all variable to blank after output
			$sum_vacation  	= '';
			$sum_sick  		= '';
			$vacation_spent = '';
			$sick_spent 	= '';
			
			$sql			= '';
			$result			= '';
			$row			= '';
				
			$year ++;
			
			$year_count ++;
			
			$x = 1;
			
		}
				
		$pdf->Ln(5.1);
		
		$pdf->SetFont('Times','B',12);
				
		$pdf->SetX(54);
		$pdf->Write(0, number_format($vacation_earn_total, 3));
		
		$pdf->SetX(75);
		$pdf->Write(0, number_format($sick_earn_total, 3));
		
		$pdf->SetX(95);
		$pdf->Write(0, number_format($vacation_spent_total, 3));
		
		$pdf->SetX(115);
		$pdf->Write(0, number_format($sick_spent_total, 3));
		
		$pdf->SetX(135);
		$pdf->Write(0, number_format($vacation_balance, 3));
		
		$pdf->SetX(153);
		$pdf->Write(0, number_format($sick_balance, 3));
		
		$pdf->Ln(5.1);
		
		$pdf->SetX(153);
		//$pdf->Write(0, number_format($sick_balance, 3) + number_format($vacation_balance, 3));
		$pdf->Write(0, number_format($sick_balance + $vacation_balance, 3));
		
		$pdf->SetFont('Times','',12);
		
		//LETS GET THE TERMINAL LEAVE PAY FOR THIS EMPLOYEE
		
		//list($sg, $step) = split('[-.-]', $name['salary_grade']);
		//list($sg, $step) = explode('-', $name['salary_grade']);
		$office = $this->Office->get_office_info($name['office_id']);
		
		// We need to check what salary grade the office use
		if ( $office['salary_grade_type'] == 'hospital' )
		{
			$this->Salary_grade->salary_grade_type = 'hospital';
		}
		
		$grand_total = $this->Salary_grade->monetary_equivalent($name['salary_grade'], $name['step'], $sick_balance, $vacation_balance);
		
		//compute #days x 0.0478087 x Highest salary received
		//$grand_total = ($sick_balance + $vacation_balance) * 0.0478087 * $step;
		
		//$pdf->Ln(10);
		//$pdf->SetX(120);
		//$pdf->Write(0, 'Monetary Equivalent PHP '.$grand_total);
		
		
		// Signatories
		$pdf->Ln(15);
		$pdf->SetX(10);
		
		$pdf->Cell(90,5,"PREPARED BY:",			'0',	0,'C',false);
		$pdf->Cell(90,5,"CERTIFIED CORRECT:",	'0',	1,'C',false);
		
		$pdf->Ln(10);
		
		// Get settings
		
		$statement_prepared 			= $this->Settings->get_selected_field( 'statement_prepared' );
		$statement_prepared_position 	= $this->Settings->get_selected_field( 'statement_prepared_position' );
		$statement_certified 			= $this->Settings->get_selected_field( 'statement_certified' );
		$statement_certified_position 	= $this->Settings->get_selected_field( 'statement_certified_position' );
		
		$pdf->Cell(90,5, $statement_prepared,			'0',	0,'C',false); //4th param border
		$pdf->Cell(90,5, $statement_certified,			'0',	1,'C',false);
		$pdf->Cell(90,5, $statement_prepared_position,	'0',	0,'C',false);
		$pdf->Cell(90,5, $statement_certified_position,	'0',	1,'C',false);
		
		
		//continue while the year is not equal to present year
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
		
		header('Pragma: public');
		
		//$pdf->Output('dtr/reports/statement_leave'.$employee_id.'.pdf', 'F'); 
		$pdf->Output('dtr/reports/statement_leave'.$employee_id.'.pdf', 'I');
		
		//redirect(base_url().'dtr/reports/statement_leave'.$employee_id.'.pdf', 'refresh');
	}
	
	// --------------------------------------------------------------------
	
	function money_value($date_retired = '', $leave_balance = 0, $employee_id = '1')
	{
		$data = array();
		$data['msg'] = '';
		
		$e = new Employee_m();
		$e->get_by_employee_id($employee_id);

		// View the form
		if (!$this->input->post('op'))
		{			
			$data['date_retired'] = $e->date_retired;
			
			$this->load->view('date_retired', $data);
			return;
			
		}
		
		$date_retired = $this->input->post('date_retired');
		
		if ($date_retired == '')
		{
			$date_retired = NULL;
		}
				
		$e->date_retired = $date_retired;
		$e->save();

		
		$this->date_retired = $date_retired;
		
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('P', 'mm', 'Letter');
		// add a page
		$pdf->AddPage();
		
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/leave/computation_money_value.pdf');
		
		// select the first page
		$tplIdx = $pdf->importPage(1);
		
		// use the page we imported
		$pdf->useTemplate($tplIdx);
						
		// set font, font style, font size.
		$pdf->SetFont('Times','B',12);
		
		$pdf->SetTextColor(89, 89, 89);
		
		// set initial placement
		$pdf->SetXY(83,30);
		
		$personal = new Personal_m();
		$personal->where('employee_id', $e->id);
		$personal->get(1);
		
		$this->load->helper('date');
		
		$date_birth 			= convert_long_date($personal->birth_date);
		$first_day_of_service 	= convert_long_date($e->first_day_of_service);
		
		$date_retired 			= convert_long_date($date_retired);
		$salary					= $this->Salary_grade->get_monthly_salary($e->salary_grade, $e->step);		
		
		$pdf->Cell(50, 8, $e->fname.' '.$e->mname.' '.$e->lname, 	'', 0, 'C', FALSE);
		
		$pdf->SetFont('Times','',12);
		$pdf->Ln(6);
		$pdf->SetX(83);
		$pdf->Cell(50, 8, "January 1, 2012 May 10, 2012", 	'', 0, 'C', FALSE);
		
		
		$pdf->Ln(20.5);
		$pdf->SetX(114);
		$pdf->Write(0, $date_birth);
		
		$pdf->Ln(6);
		$pdf->SetX(114);
		$pdf->Write(0, $first_day_of_service);
		
		
		$pdf->Ln(11);
		$pdf->SetX(114);
		$pdf->Write(0, $date_retired);
		
		$pdf->Ln(6);
		$pdf->SetX(114);
		$pdf->Write(0, number_format($salary, 2));
		
		$pdf->Ln(5.5);
		$pdf->SetX(114);
		$pdf->Write(0, number_format($leave_balance, 3));
				
		$total_money = $salary * $leave_balance * 0.0478087;
		
		$pdf->Ln(18);
		$pdf->SetX(27);
		$pdf->Cell(50, 8, number_format($salary, 2), '', 0, 'R', FALSE);
		
		$pdf->SetX(58);
		$pdf->Cell(50, 8, number_format($leave_balance, 3), '', 0, 'R', FALSE);
		
		$pdf->SetX(167);
		$pdf->Cell(15, 8, number_format($total_money, 2), '', 0, 'L', FALSE);
		
				
		$pdf->Ln(44);
		$pdf->SetX(50);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'money_value_signatory_prepared' ), 
					'', 0, 'C', FALSE);
		
		$pdf->SetX(136);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'money_value_signatory_certified' ),
					'', 0, 'C', FALSE);
		
		
		$pdf->Ln(6);
		$pdf->SetX(50);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'money_value_signatory_prepared_position' ),
					'', 0, 'C', FALSE);
		
		$pdf->SetX(136);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'money_value_signatory_certified_position' ),
					'', 0, 'C', FALSE);		
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
		
		header('Pragma: public');
		
		$pdf->Output('dtr/reports/money_value'.$employee_id.'.pdf', 'F');
		$this->pages['P'] = 'dtr/reports/money_value'.$employee_id.'.pdf';// index 'P' for portrait
		
		$this->schedule_retirement_pay($this->date_retired, $employee_id);
		
		
		// Lets concat
		$this->load->library('concat_pdf');
		
		$this->concat_pdf->setFiles($this->pages); 
		$this->concat_pdf->concat();
		
		$this->concat_pdf->Output("dtr/template/pds/archives/".$employee_id.".pdf", 'I');
		
		
		
	}
	
	
	function schedule_retirement_pay($date_retired = '', $employee_id = '1')
	{
		$data = array();
		$data['msg'] = '';
				
		$this->load->library('fpdf');
		
		if (!defined('FPDF_FONTPATH')) 
		{
			define('FPDF_FONTPATH',$this->config->item('fonts_path'));
		}
					
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('L', 'mm', 'Legal');
		
		$pdf->SetAutoPageBreak(FALSE);
		// add a page
		$pdf->AddPage();
		
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/leave/schedule_retirement_pay.pdf');
		
		// select the first page
		$tplIdx = $pdf->importPage(1);
		
		// use the page we imported
		$pdf->useTemplate($tplIdx);
		
		$e = new Employee_m();
		$e->get_by_employee_id($employee_id);		
				
		// set font, font style, font size.
		$pdf->SetFont('Times','',10);
		
		$pdf->SetTextColor(89, 89, 89);
		
		
		// set initial placement
		$pdf->SetXY(142,20.5);
		
		$personal = new Personal_m();
		$personal->where('employee_id', $e->id);
		$personal->get(1);
		
		$this->load->helper('date');
		
		$o = new Office_m();
		$o->get_by_office_id($e->office_id);
		
		
		
		$period = 'January 1, 2012 May 10, 2012';
		$office_name = $o->office_name;
		$lgu_name = $this->Settings->get_selected_field( 'lgu_name' );
		
		//var_dump($date_retired);
		
		$date_retired_diff = $date_retired;
		
		$date_birth 			= convert_long_date($personal->birth_date, TRUE);
		$first_day_of_service 	= convert_long_date($e->first_day_of_service);
		$date_retired 			= convert_long_date($date_retired, TRUE);
		$salary					= $this->Salary_grade->get_monthly_salary($e->salary_grade, $e->step);
		
		
		
		//$pdf->SetX(114);
		$pdf->Write(0, $period);
		
		
		$pdf->Ln(10);
		$pdf->SetX(63);
		$pdf->Write(0, $office_name);
				
		$pdf->Ln(5);
		$pdf->SetX(63);
		$pdf->Write(0, $lgu_name);
		
		
		$pdf->SetFont('Times','B',10);
		$pdf->Ln(21.5);
		$pdf->SetX(14);
		$pdf->Write(0, $e->fname . ' ' . substr($e->mname, 0, 1).'. '.$e->lname);
		
		$pdf->SetFont('Times','',10);
		$pdf->SetX(65);
		$pdf->Write(0, $date_birth);
		
		$pdf->SetX(88);
		$pdf->Write(0, $date_retired);
		
		$date1 = new DateTime("1970-7-01");
		$date2 = new DateTime("2011-11-16");
				
		$date1 = new DateTime($e->first_day_of_service);
		$date2 = new DateTime($date_retired_diff);
		
		$interval = $date1->diff($date2);
		//echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days ";
		
		if ($interval->y != 0)
		{
			$pdf->SetX(114);
			$pdf->Write(0, $interval->y . " years");
		}
		
		
		if ($interval->m != 0)
		{
			$pdf->Ln(5);
			$pdf->SetX(114);
			$pdf->Write(0, $interval->m . " months");
		}
		
		if ($interval->d != 0)
		{
			$pdf->Ln(5);
			$pdf->SetX(114);
			$pdf->Write(0, $interval->d . " days");
		}
		
		// Salary
		$pdf->SetXY(145,53);
		$pdf->Cell(20, 8, number_format($salary, 2), '', 0, 'C', FALSE);
		
		$total_leave = $this->Leave_card->get_total_leave_credits($employee_id);
		
		$vacation_leave = $total_leave['vacation'];
		$sick_leave 	= $total_leave['sick'];
		$total 			= $vacation_leave + $sick_leave;
		
		$terminal_leave = $salary * $total * 0.0478087;
		
		// vacation leave
		$pdf->SetXY(203,58);
		$pdf->Cell(20, 8, number_format($vacation_leave, 3), '', 0, 'R', FALSE);
		
		// sick leave
		$pdf->SetXY(203,63);
		$pdf->Cell(20, 8, number_format($sick_leave, 3), '', 0, 'R', FALSE);
		
		// total
		$pdf->SetXY(203,68);
		$pdf->Cell(20, 8, number_format($total, 3), '', 0, 'R', FALSE);
		
		// terminal leave
		$pdf->SetX(274);
		$pdf->Cell(20, 8, number_format($terminal_leave, 2), '', 0, 'R', FALSE);
		
		$pdf->SetFont('Times','B',10);
		// grand total leave
		$pdf->SetXY(203,119);
		$pdf->Cell(20, 8, number_format($total, 3), '', 0, 'R', FALSE);
		
		// total terminal amount
		$pdf->SetX(274);
		$pdf->Cell(20, 8, number_format($terminal_leave, 2), '', 0, 'R', FALSE);
		
		
		// Signatories	
		$pdf->Ln(35);
		$pdf->SetX(13);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'retirement_signatory_prepared' ), 
					'', 0, 'C', FALSE);
		// date	
		$pdf->SetFont('Times','',10);
		$pdf->SetX(76);
		$pdf->Cell(50, 8, date('F d, Y'), '', 0, 'C', FALSE);		
		
		$pdf->SetFont('Times','B',10);
		$pdf->SetX(147);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'retirement_signatory_approved' ),
					'', 0, 'C', FALSE);
		
		$pdf->SetFont('Times','',10);
		$pdf->Ln(5);
		$pdf->SetX(13);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'retirement_signatory_prepared_position' ),
					'', 0, 'C', FALSE);
		
		$pdf->SetX(146);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'retirement_signatory_approved_position' ),
					'', 0, 'C', FALSE);
					
		
		
		$pdf->SetFont('Times','B',10);
		$pdf->Ln(25);
		$pdf->SetX(13);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'retirement_signatory_certified' ), 
					'', 0, 'C', FALSE);
		

		$pdf->SetX(88);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'retirement_signatory_attested' ),
					'', 0, 'C', FALSE);
					
		$pdf->SetX(147);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'retirement_signatory_availability' ),
					'', 0, 'C', FALSE);
					
		$pdf->SetX(223);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'retirement_signatory_noted' ),
					'', 0, 'C', FALSE);	
					
					
					
		$pdf->SetFont('Times','',10);
		$pdf->Ln(5);
		$pdf->SetX(13);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'retirement_signatory_certified_position' ), 
					'', 0, 'C', FALSE);
		

		$pdf->SetX(88);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'retirement_signatory_attested_position' ),
					'', 0, 'C', FALSE);
					
		$pdf->SetX(147);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'retirement_signatory_availability_position' ),
					'', 0, 'C', FALSE);
					
		$pdf->SetX(223);
		$pdf->Cell(50, 8, 
					$this->Settings->get_selected_field( 'retirement_signatory_noted_position' ),
					'', 0, 'C', FALSE);							
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
		
		header('Pragma: public');
		
		$pdf->Output('dtr/reports/schedule_retirement_pay'.$employee_id.'.pdf', 'F');
		
		// index 'L' for landscape
		$this->pages['L'] = 'dtr/reports/schedule_retirement_pay'.$employee_id.'.pdf';
		
				
	}
	
	// --------------------------------------------------------------------
	
	function leave_apps($leave_apps_id = '')
	{
		$lgu_code = $this->Settings->get_selected_field('lgu_code'); 
		
		
		if ( $lgu_code == 'marinduque_province' )
		{
	
			$this->leave_apps_marinduque($leave_apps_id);
			
			return;
		}
		
		$rows = $this->Leave_apps->get_leave_apps_info($leave_apps_id);

		$name = $this->Employee->get_employee_info($rows['employee_id']);
		
		$office_name = $this->Office->get_office_name($name['office_id']);
		
		
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('P', 'mm', 'A4');
		
		// add a page
		$pdf->AddPage();
		
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/APPLICATION_FOR_LEAVE.pdf');
		
		// select the first page
		$tplIdx = $pdf->importPage(1);
		
		// use the page we imported
		$pdf->useTemplate($tplIdx);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','B',12);
		
		
		// set initial placement
		$pdf->SetXY(158,10.5);
		
		// line break
		//$pdf->Ln(40);
		
		$pdf->Write(0, 'Tracking no: '.$leave_apps_id);
		$pdf->Ln(9);
		$pdf->SetX(158);
		
		//ID number
		$pdf->Write(0, ' '.$rows['employee_id']);
		
		$pdf->Ln(20);
		
		// go to 25 X (indent)
		$pdf->SetX(25);
		
		$this->Office->fields = array('office_code');
		
		$office = $this->Office->get_office_info($name['office_id']);
		
		// write office
		$pdf->Write(0, $office['office_code']);
		
		//lname
		$pdf->SetX(90);
		$pdf->Write(0, $name['lname']);
		
		//fname
		$pdf->SetX(145);
		$pdf->Write(0, $name['fname']);
		
		//mname
		$pdf->SetX(192);
		$pdf->Write(0, $name['mname'][0].'.');
		
		$pdf->Ln(13);
		
		//date of file
		$pdf->SetX(25);
		$pdf->Write(0, date("F d, Y", strtotime($rows['date_encode'])));
		
		//position
		$pdf->SetX(70);
		$pdf->Write(0, $name['position']);
		
		// We need to check what salary grade the office use
		if ( $office['salary_grade_type'] == 'hospital' )
		{
			$this->Salary_grade->salary_grade_type = 'hospital';
		}
		
		//monthly salary
		$pdf->SetX(170);
		$pdf->Write(0, 'P '.number_format($this->Salary_grade->get_monthly_salary($name['salary_grade'], $name['step']), 2));
		
		
		$pdf->Ln(14);
		
		$leave_name = $this->Leave_type->get_leave_name($rows['leave_type_id']);
		
		$leave_type_ids = array(1, 3, 4, 5, 6, 7, 9, 10, 12);
		
		if (in_array($rows['leave_type_id'], $leave_type_ids))
		{
			$pdf->Ln(2);
			$pdf->SetX(28);
			$pdf->Write(0, 'X');
			
			$pdf->Ln(18);
			
			$pdf->SetX(32);
			
			if ( $rows['leave_type_id'] == 1 )
			{
				$leave_name = '';
			}
			
			$pdf->SetFont('Arial','B',10);
			$pdf->Write(0, $leave_name);
			$pdf->SetFont('Arial','B',12);
		}
		
		$leave_type_ids = array(2, 11, 20);
		
		if (in_array($rows['leave_type_id'], $leave_type_ids))
		{
			$pdf->Ln(27);
			$pdf->SetX(28);
			$pdf->Write(0, 'X');
			
			$pdf->Ln(18);
			
			$pdf->SetX(32);
			
			if ( $rows['leave_type_id'] == 2 )
			{
				$leave_name = '';
			}
			
			$pdf->SetFont('Arial','B',10);
			$pdf->Write(0, $leave_name);
			$pdf->SetFont('Arial','B',12);
		}
		
		/*
		if ($rows['leave_type_id'] == 1)
		{
			$pdf->Ln(2);
			$pdf->SetX(27);
			$pdf->Write(0, 'X');
		}
		if ($rows['leave_type_id'] == 2)
		{
			$pdf->Ln(27);
			$pdf->SetX(27);
			$pdf->Write(0, 'X');
		}
		*/
		//$pdf->Write(0, 'City of Puerto Pricesa');
		
		
		$pdf->Ln(35);
		
		$pdf->SetXY(35, 128);
		
		$days = 'day';
		
		if ($rows['days'] > 1)
		{
			$days = 'days';
		}
		
		$pdf->Write(0, $rows['days'].' '.$days);
		
		$date_leave = $this->Helps->get_month_name($rows['month']).' '.$rows['multiple'].', '.$rows['year'];
		
		if ($rows['multiple5'] != '')
		{
			$date_leave .= ' - '.$this->Helps->get_month_name($rows['month5']).' '.$rows['multiple5'].', '.$rows['year5'];
		}
		
		$pdf->Ln(4);
		$pdf->SetX(60);
		$pdf->Write(0, $date_leave);
		
		$last_earn = $this->Leave_card->get_last_earn($rows['employee_id']);
		//$last_earn = date('F d, Y', strtotime($last_earn));
		
		if ( $last_earn != '')
		{
			$last_earn = date('F d, Y', strtotime($last_earn));
		}
		else
		{
			$last_earn = date('F d, Y');
		}
		
		
		//$vbalance =  $this->Leave_balance->get_leave_balance(1, $rows['employee_id']);
		//$sbalance =  $this->Leave_balance->get_leave_balance(2, $rows['employee_id']);
		
		$credits = $this->Leave_card->get_total_leave_credits($rows['employee_id']);

		
		$pdf->Ln(39);
		$pdf->SetX(35);
		$pdf->Write(0, $last_earn);
		
		//balances
		$pdf->Ln(18);
		$pdf->SetX(25);
		//$pdf->Write(0, $vbalance);
		$pdf->Write(0, $credits['vacation']);
		
		$pdf->SetX(54);
		//$pdf->Write(0, $sbalance);
		$pdf->Write(0, $credits['sick']);
		
		$total_leave_balance = $credits['vacation'] + $credits['sick'];
		
		$pdf->SetX(80);
		$pdf->Write(0, $total_leave_balance);
		
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','B',12);
		
		$pdf->Ln(9);
		
		$pdf->SetX(136);
		
		//credits
		//vaation
		$pdf->Ln(23);
		
		$pdf->SetX(52);
		
		//$pdf->Write(0, number_format($vacation_leave, 3));
		
		//sick
		//$pdf->Ln(9);
		
		$pdf->SetX(108);
		
		//$pdf->Write(0, number_format($sick_leave, 3));
		
		//total
		//$pdf->Ln(7);
		
		$pdf->SetX(160);
		
		//$pdf->Write(0, number_format($vacation_leave + $sick_leave, 3));
		
		
		//date for the day
		$pdf->Ln(21);
		
		$pdf->SetX(67);
		
		//day
		//$pdf->Write(0, date('jS'));
		
		$pdf->SetX(104);
		
		//$pdf->Write(0, date('F'));
		
		//year
		$pdf->SetX(138);
		
		//$pdf->Write(0, date('Y'));
		
		//MR or MS. request
		$pdf->Ln(7);
		
		//$pdf->Image('white.png',10,10,-300);
		
		$pdf->SetX(32);
		
		
		$statement_certified = $this->Settings->get_selected_field('statement_certified');
		$statement_certified_position = $this->Settings->get_selected_field('statement_certified_position');
		
		$pdf->SetXY(35,205);
		$pdf->SetFillColor(255, 255, 255); 
		
		$pdf->Cell(65,5,strtoupper($statement_certified),'',0,'C',1);
		$pdf->SetXY(35,211);
		$pdf->SetFont('Arial','I',11);
		$pdf->Cell(65,5,$statement_certified_position,'',0,'C',1);
		
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
		
		header('Pragma: public');
		
		$pdf->Output('dtr/reports/leave-apps-'.$rows['employee_id'].'.pdf', 'I'); 
		
		//redirect(base_url().'dtr/reports/leave-apps-'.$rows['employee_id'].'.pdf', 'refresh');
		
	}
	
	function leave_apps_marinduque($leave_apps_id = '')
	{
		
		$rows = $this->Leave_apps->get_leave_apps_info($leave_apps_id);

		$name = $this->Employee->get_employee_info($rows['employee_id']);
		
		$office_name = $this->Office->get_office_name($name['office_id']);
		
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
		
		// initiate FPDI   
		//$pdf = new FPDI('P', 'mm', 'Legal');
		
		$pdf = new FPDI('P', 'mm', 'Letter');
		// add a page
		$pdf->AddPage();
		
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/APPLICATION_FOR_LEAVE_MARINDUQUE.pdf');
		
		// select the first page
		$tplIdx = $pdf->importPage(1);
		
		// use the page we imported
		$pdf->useTemplate($tplIdx);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','B',12);
		
		
		// set initial placement
		$pdf->SetXY(158,10.5);
		
		// line break
		//$pdf->Ln(40);
		
		$pdf->Write(0, 'Tracking no: '.$leave_apps_id);
		$pdf->Ln(9);
		$pdf->SetX(158);
		
		//ID number
		//$pdf->Write(0, ' '.$rows['employee_id']);
		
		$pdf->Ln(26);
		
		// go to 25 X (indent)
		$pdf->SetX(20);
		
		$this->Office->fields = array('office_code');
		
		$office = $this->Office->get_office_info($name['office_id']);
		
		
		
		$pdf->SetFont('Arial','B',10);
		// write office
		//$pdf->Write(0, $office['office_code']);
		$pdf->Write(0, $office['office_name']);
		$pdf->SetFont('Arial','B',12);
		
		//lname
		$pdf->SetX(97);
		$pdf->Write(0, $name['lname']);
		
		//fname
		$pdf->SetX(145);
		$pdf->Write(0, $name['fname']);
		
		//mname
		$pdf->SetX(187);
		$pdf->Write(0, $name['mname'][0].'.');
		
		$pdf->Ln(10);
		
		//date of file
		$pdf->SetX(20);
		$pdf->Write(0, date("F d, Y", strtotime($rows['date_encode'])));
		
		//position
		$pdf->SetFont('Arial','B',10);
		$pdf->SetX(70);
		$pdf->Write(0, $name['position']);
		$pdf->SetFont('Arial','B',12);
		
		// We need to check what salary grade the office use
		if ( $office['salary_grade_type'] == 'hospital' )
		{
			$this->Salary_grade->salary_grade_type = 'hospital';
		}
		
		//monthly salary
		$pdf->SetX(167);
		$pdf->Write(0, 'P '.number_format($this->Salary_grade->get_monthly_salary($name['salary_grade'], $name['step']), 2));
		
		
		$pdf->Ln(12);
		
		$leave_name = $this->Leave_type->get_leave_name($rows['leave_type_id']);
				
		$leave_type_ids = array(1, 3, 4, 5, 6, 7, 9, 10, 12, 24);
		
		if (in_array($rows['leave_type_id'], $leave_type_ids))
		{
			$pdf->Ln(1);
			$pdf->SetX(23);
			$pdf->Write(0, 'X');
			
			$pdf->Ln(18);
			
			$pdf->SetX(32);
			
			if ( $rows['leave_type_id'] == 1 )
			{
				$leave_name = '';
			}
			
			$pdf->SetFont('Arial','B',10);
			$pdf->Write(0, $leave_name);
			$pdf->SetFont('Arial','B',12);
		}
		
		$leave_type_ids = array(2, 11, 20);
		
		if (in_array($rows['leave_type_id'], $leave_type_ids))
		{
			$pdf->Ln(25);
			$pdf->SetX(23);
			$pdf->Write(0, 'X');
			
			$pdf->Ln(18);
			
			$pdf->SetX(32);
			
			if ( $rows['leave_type_id'] == 2 )
			{
				$leave_name = '';
			}
			
			$pdf->SetFont('Arial','B',10);
			$pdf->Write(0, $leave_name);
			$pdf->SetFont('Arial','B',12);
		}
				
		$pdf->Ln(35);
		
		$pdf->SetXY(37, 123);
		
		$days = 'day';
		
		if ($rows['days'] > 1)
		{
			$days = 'days';
		}
		
		$pdf->Write(0, $rows['days'].' '.$days);
		
		$date_leave = $this->Helps->get_month_name($rows['month']).' '.$rows['multiple'].', '.$rows['year'];
		
		
		// Get the first 2 char
		$leave_first_day = substr($rows['multiple'], 0, 2);
		
		// Get abs value
		$leave_first_day = abs($leave_first_day);
		
		$leave_balances_as_of = date("F d, Y", strtotime($rows['year'].'-'.$rows['month'].'-'.$leave_first_day."-1 day"));

		$record_limit_date = date("Y-m-d", strtotime($rows['year'].'-'.$rows['month'].'-'.$leave_first_day."-1 day"));;
				
		if ($rows['multiple5'] != '')
		{
			$date_leave .= ' - '.$this->Helps->get_month_name($rows['month5']).' '.$rows['multiple5'].', '.$rows['year5'];
		}
		
		$pdf->Ln(13);
		$pdf->SetX(30);
		$pdf->Write(0, $date_leave);
		
		$last_earn = $this->Leave_card->get_last_earn($rows['employee_id']);
		
		if ( $last_earn != '')
		{
			$date_format = $last_earn; // Get the last earn ex:2011-08-15
			
			$last_earn = date('F d, Y', strtotime($last_earn));
		}
		else
		{
			$last_earn = date('F d, Y');
		}

		
		
		$vbalance =  $this->Leave_balance->get_leave_balance(1, $rows['employee_id']);
		$sbalance =  $this->Leave_balance->get_leave_balance(2, $rows['employee_id']);
		
		//$credits = $this->Leave_card->get_total_leave_credits($rows['employee_id'], $record_limit_date);
		
		$leave_type_ids = array(3, 4, 5, 6, 20);
		
		if (in_array($rows['leave_type_id'], $leave_type_ids))
		{
			$leave_balances_as_of = '';
			$record_limit_date = '';
		}

		$credits = $this->Leave_card->get_total_leave_credits($rows['employee_id'], $record_limit_date);
		
		
		$pdf->Ln(27);
		$pdf->SetX(39);
		//$pdf->Write(0, $last_earn);
		$pdf->Write(0, $leave_balances_as_of);
		
		$no_days = $leave_first_day; // bugs_here
		
		// If leave in first day of the month
		if ( $no_days == 1)
		{
			$earn_day = substr($date_format, -2); // Get last two characted of the date ex: 1-31
			
			if ( $earn_day == 15)
			{
				//$no_days = 16;
			}
			if ( $earn_day == 28 || $earn_day == 29 || $earn_day == 30 || $earn_day == 31)
			{
				//$no_days = 31;
			}
		}
		
		// If leave in 16-31
		if ( $no_days >= 16)
		{
			$earn_day = substr($date_format, -2); // Get last two characted of the date ex: 1-31
			
			if ( $earn_day == 15)
			{
				//$no_days -= 15;
			}
			if ( $earn_day == 28 || $earn_day == 29 || $earn_day == 30 || $earn_day == 31)
			{
				//$no_days = 31;
			}
		}
				
		// The balance to add
		$add_to_balance = $this->Leave_conversion_table->days_equivalent($no_days - 1);
		//$add_to_balance = $this->Leave_conversion_table->days_equivalent($no_days);
		//echo $no_days;
		//print_r( $credits);
		//exit;
		
		$total_vacation_leave 	= $credits['vacation'] 	+ $add_to_balance;
		$total_sick_leave 		= $credits['sick'] 		+ $add_to_balance;
		
		$leave_type_ids = array(3, 4, 5, 6, 20, 24);
		
		if (in_array($rows['leave_type_id'], $leave_type_ids))
		{
			if ( $rows['leave_type_id'] == 3 )
			{
				$total_vacation_leave 	= 'CSC MC # 6 s 1996';
			}
			if ( $rows['leave_type_id'] == 24 )
			{
				$total_vacation_leave 	= 'CSC MC. No.2 s.2012';
			}
			else
			{
				$total_vacation_leave 	= '';
			}
			
			$total_sick_leave 		= '';
		}
		
		//balances
		$pdf->Ln(16);
		$pdf->SetX(24);
		$pdf->Write(0, $total_vacation_leave);
		
		$pdf->SetX(43);
		$pdf->Write(0, $total_sick_leave);		
		
		$total_leave_balance = $credits['vacation'] + $credits['sick'] + ($add_to_balance * 2);
		
		$leave_type_ids = array(3, 4, 5, 6, 20, 24);
		
		if (in_array($rows['leave_type_id'], $leave_type_ids))
		{
			$total_leave_balance 	= '';
		}
		
		$pdf->SetX(70);
		$pdf->Write(0, $total_leave_balance);
		
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','B',12);
		
		$pdf->Ln(5);
		
		$pdf->SetX(110);
		
		// Get office head
		
		$office = $this->Office->get_office_info($name['office_id']);
		
		// If detailed
		if ( $name['detailed_office_id'] != 0 )
		{
			//echo $name['detailed_office_id'];
			
			$detailed_office = $this->Office->get_office_info($name['detailed_office_id']);
			//echo $detailed_office['position'];
			//exit;
			$office['office_head'] 	= $detailed_office['office_head'];
			$office['position'] 	= $detailed_office['position'];
		}
		
		// If Employee is Department head
		$o = new Office_m();
		
		$o->get_by_employee_id($rows['employee_id']);
		
		if ( $o->exists())
		{
			$office['office_head'] 	= 'CARMENCITA O. REYES';
			$office['position'] 	= 'Governor';
		}
		
		// We need to work out for this as exception
		if ( $rows['employee_id'] == '61')
		{
			$office['office_head'] 	= 'ANTONIO L. UY, JR. M.D.';
			$office['position'] 	= 'Vice Governor';
		}
		
		
		
		$pdf->Cell(73, 4, strtoupper($office['office_head']), '0', 0, 'C', FALSE);
		//$pdf->Write(0, $office['office_head']);
		$pdf->Ln(5);
		
		$pdf->SetFont('Arial','',10);
		$pdf->SetX(110);
		$pdf->Cell(73, 4, $office['position'], '0', 0, 'C', FALSE);
		$pdf->SetFont('Arial','B',12);
		
		
		
		$statement_certified = $this->Settings->get_selected_field('statement_certified');
		$statement_certified_position = $this->Settings->get_selected_field('statement_certified_position');
		
		$pdf->SetXY(26,195);
		$pdf->SetFillColor(255, 255, 255); 
		
		$pdf->Cell(65,5,strtoupper($statement_certified),'',0,'C',1);
		$pdf->SetXY(26,199);
		$pdf->SetFont('Arial','I',11);
		$pdf->Cell(65,5,$statement_certified_position,'',0,'C',1);
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
		
		header('Pragma: public');
		
		$pdf->Output('dtr/reports/leave-apps-'.$rows['employee_id'].'.pdf', 'I'); 
				
	}
	
	// --------------------------------------------------------------------
	
	function cto_apps($id = '')
	{
		$c = new Compensatory_timeoff();
		$c->get_by_id($id);
		
		$name = $this->Employee->get_employee_info($c->employee_id);
		
		$office_name = $this->Office->get_office_name($name['office_id']);
		
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
				
		$pdf = new FPDI('P', 'mm', 'Legal');
		// add a page
		$pdf->AddPage();
		
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/app_for_offset.pdf');
		
		// select the first page
		$tplIdx = $pdf->importPage(1);
		
		// use the page we imported
		$pdf->useTemplate($tplIdx);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','B',12);
		
		
		// set initial placement
		$pdf->SetXY(158,10.5);
				
		$pdf->Write(0, 'Tracking no: '.$id);
		$pdf->Ln(9);
		$pdf->SetX(158);
		
		
		$pdf->Ln(20);
		
		// go to 25 X (indent)
		$pdf->SetX(12);
		
		$this->Office->fields = array('office_code');
		
		$office = $this->Office->get_office_info($name['office_id']);
		
		// write office
		$pdf->SetFont('Arial','B',10);
		$pdf->Write(0, $office['office_name']);
		$pdf->SetFont('Arial','B',12);
		
		//lname
		$pdf->SetX(99);
		$pdf->Write(0, $name['lname']);
		
		//fname
		$pdf->SetX(145);
		$pdf->Write(0, $name['fname']);
		
		//mname
		$pdf->SetX(187);
		$pdf->Write(0, $name['mname'][0].'.');
		
		$pdf->Ln(10);
		
		//date of file
		$pdf->SetX(20);
		$pdf->Write(0, $c->date_file);
		
		//position
		$pdf->SetFont('Arial','B',10);
		$pdf->SetX(63);
		$pdf->Write(0, $name['position']);
		$pdf->SetFont('Arial','B',12);
		
		// We need to check what salary grade the office use
		if ( $office['salary_grade_type'] == 'hospital' )
		{
			$this->Salary_grade->salary_grade_type = 'hospital';
		}
		
		//monthly salary
		$pdf->SetX(140);
		$pdf->Write(0, 'P '.number_format($this->Salary_grade->get_monthly_salary($name['salary_grade'], $name['step']), 2));
		
		
		$days = 'day';
		
		if ($c->days > 1)
		{
			$days = 'days';
		}
		
		$pdf->Ln(13);
		
		$pdf->SetX(30);
		$pdf->Write(0, $c->days.' '.$days);
		
		$pdf->SetX(140);
		//$pdf->Write(0, 'daily rate here');
		
	
		$pdf->Ln(13);
		$pdf->SetX(50);
		$pdf->Write(0, $this->Helps->get_month_name($c->month).' '.$c->dates.', '.$c->year);
		
		$cto_balances_as_of = date("F d, Y", strtotime($c->date_file."-1 day"));
		
		$pdf->SetXY(30, 106);
		//$pdf->Write(0, $cto_balances_as_of);
		
		// Compute balances
		// (balance + earn) - spent
		$cto = new Compensatory_timeoff();
		$cto->where('employee_id',$c->employee_id);
		$cto->where('type','balance');
		$cto->where('status','active');
		$cto->select_sum('days');
		$cto->get();
		
		$balance = $cto->days;
				
		$cto = new Compensatory_timeoff();
		$cto->where('employee_id',$c->employee_id);
		$cto->where('type','earn');
		$cto->where('status','active');
		$cto->select_sum('days');
		$cto->get();
		
		$earn = $cto->days;
				
		$cto = new Compensatory_timeoff();
		$cto->where('employee_id',$c->employee_id);
		$cto->where('type','spent');
		$cto->where('status','active');
		$cto->select_sum('days');
		$cto->get();
		
		$spent = $cto->days;
		
		$total_balance = ($balance + $earn) - $spent;
		
		$pdf->SetXY(35, 116);
		//$pdf->Write(0, $total_balance);
		
		
		$pdf->SetX(87);
		$pdf->Write(0, '');// hours here
		
		
		// Get office head
		$office = $this->Office->get_office_info($name['office_id']);
		
		// If detailed
		if ( $name['detailed_office_id'] != 0 )
		{			
			$detailed_office = $this->Office->get_office_info($name['detailed_office_id']);

			$office['office_head'] = $detailed_office['office_head'];
			$office['position'] = $detailed_office['position'];
		}
		
		// If Employee is Department head
		$o = new Office_m();
		
		$o->get_by_employee_id($c->employee_id);
		
		if ( $o->exists())
		{
			$office['office_head'] 	= 'CARMENCITA O. REYES';
			$office['position'] 	= 'Governor';
		}
		
		// We need to work out for this as exception
		if ( $c->employee_id== '61')
		{
			$office['office_head'] 	= 'ANTONIO L. UY, JR. M.D.';
			$office['position'] 	= 'Vice Governor';
		}
		
		$pdf->Ln(6);
		$pdf->SetX(120);
		
		$pdf->Cell(73, 4, strtoupper($office['office_head']), '0', 0, 'C', FALSE);

		$pdf->Ln(5);
		
		$pdf->SetFont('Arial','',10);
		$pdf->SetX(120);
		$pdf->Cell(73, 4, $office['position'], '0', 0, 'C', FALSE);
		$pdf->SetFont('Arial','B',12);
		
		
		// Statement of CTO signatory
		$statement_certified 			= $this->Settings->get_selected_field( 'cto_certification' );
		$statement_certified_position 	= $this->Settings->get_selected_field( 'cto_certification_position' );
		
		$pdf->Ln(5);
		$pdf->SetX(22);
		
		$pdf->Cell(73, 4, strtoupper($statement_certified), '0', 0, 'C', FALSE);
		
		$pdf->Ln(5);
		
		$pdf->SetFont('Arial','',10);
		$pdf->SetX(22);
		$pdf->Cell(73, 4, $statement_certified_position, '0', 0, 'C', FALSE);
		$pdf->SetFont('Arial','B',12);
		
		
		// ====================Second Form =============
		$pdf->Ln(44);
		$pdf->SetX(12);
		
		// write office
		$pdf->SetFont('Arial','B',10);
		$pdf->Write(0, $office['office_name']);
		$pdf->SetFont('Arial','B',12);
		
		//lname
		$pdf->SetX(99);
		$pdf->Write(0, $name['lname']);
		
		//fname
		$pdf->SetX(145);
		$pdf->Write(0, $name['fname']);
		
		//mname
		$pdf->SetX(187);
		$pdf->Write(0, $name['mname'][0].'.');
		
		$pdf->Ln(10);
		
		//date of file
		$pdf->SetX(20);
		$pdf->Write(0, $c->date_file);
		
		//position
		$pdf->SetFont('Arial','B',10);
		$pdf->SetX(63);
		$pdf->Write(0, $name['position']);
		$pdf->SetFont('Arial','B',12);
		
		//monthly salary
		$pdf->SetX(140);
		$pdf->Write(0, 'P '.number_format($this->Salary_grade->get_monthly_salary($name['salary_grade'], $name['step']), 2));
		
		$pdf->Ln(13);
		
		$pdf->SetX(30);
		$pdf->Write(0, $c->days.' '.$days);
		
		$pdf->SetX(140);
		//$pdf->Write(0, 'daily rate here');
		
	
		$pdf->Ln(13);
		$pdf->SetX(50);
		$pdf->Write(0, $this->Helps->get_month_name($c->month).' '.$c->dates.', '.$c->year);
		
		$cto_balances_as_of = date("F d, Y", strtotime($c->date_file."-1 day"));
		
		$pdf->Ln(30);
		$pdf->SetX(30);
		//$pdf->Write(0, $cto_balances_as_of);
		
		$pdf->Ln(10);
		$pdf->SetX(35);
		//$pdf->Write(0, $total_balance);
		
		$pdf->Ln(6);
		$pdf->SetX(120);
		
		$pdf->Cell(73, 4, strtoupper($office['office_head']), '0', 0, 'C', FALSE);

		$pdf->Ln(5);
		
		$pdf->SetFont('Arial','',10);
		$pdf->SetX(120);
		$pdf->Cell(73, 4, $office['position'], '0', 0, 'C', FALSE);
		$pdf->SetFont('Arial','B',12);
		
		$pdf->Ln(5);
		$pdf->SetX(22);
		
		$pdf->Cell(73, 4, strtoupper($statement_certified), '0', 0, 'C', FALSE);
		
		$pdf->Ln(5);
		
		$pdf->SetFont('Arial','',10);
		$pdf->SetX(22);
		$pdf->Cell(73, 4, $statement_certified_position, '0', 0, 'C', FALSE);
		$pdf->SetFont('Arial','B',12);
		
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
		
		header('Pragma: public');
		
		$pdf->Output('dtr/reports/cto-apps-'.intval($c->employee_id).'.pdf', 'I'); 
		
		//redirect(base_url().'dtr/reports/leave-apps-'.$rows['employee_id'].'.pdf', 'refresh');
		
	}

	
	// --------------------------------------------------------------------
}

/* End of file reports.php */
/* Location: ./application/modules/reports/controllers/reports.php */