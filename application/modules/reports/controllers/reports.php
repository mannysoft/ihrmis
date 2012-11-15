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
//http://codeigniter.com/forums/viewthread/91996/
class Reports extends MX_Controller
{
	// --------------------------------------------------------------------
	
	var $pds 				= array();
	
	var $second_offenders 	= array(); // Ten times tardy offenders(1st and 2nd sem)
	
	// --------------------------------------------------------------------
	
	function __construct()
    {
        parent::__construct();
    }
	
	// --------------------------------------------------------------------
	
	function all_office_tardiness()
	{
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('P', 'mm', 'Letter');
		// add a page
		$pdf->SetLeftMargin(20);

		$pdf->AddPage();
		// set the sourcefile
		//$pdf->setSourceFile('dtr/template/sample.pdf');
		
		// select the first page
		//$tplIdx = $pdf->importPage(1);
		
		// use the page we imported
		//$pdf->useTemplate($tplIdx);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','BI',10);
		
		$pdf->SetX(120);

		$pdf->Ln(3);
		
		$employees =  $this->Tardiness->get_employees_ten_tardy(
		
										$this->input->post('month1'), 
										$this->input->post('month2'), 
										$this->input->post('year'), 
										''
										);
		
		$offices =  $this->Tardiness->offices_tardy;
		
		$year1 =  $this->input->post('year');
		//$month1 = $_GET['month'];
		//$month2 = $_GET['month2'];
		
		if ($this->input->post('month1') == '01' && $this->input->post('month2') == '06')
		{
			$m1 = 'Jan';
			$m2 = 'Feb';
			$m3 = 'March';
			$m4 = 'Apr';
			$m5 = 'May';
			$m6 = 'Jun';
			
			$mo1 = '01';
			$mo2 = '02';
			$mo3 = '03';
			$mo4 = '04';
			$mo5 = '05';
			$mo6 = '06';
		}
		
		if ($this->input->post('month1') == '07' && $this->input->post('month2') == '12')
		{
			$m1 = 'Jul';
			$m2 = 'Aug';
			$m3 = 'Sep';
			$m4 = 'Oct';
			$m5 = 'Nov';
			$m6 = 'Dec';
			
			$mo1 = '07';
			$mo2 = '08';
			$mo3 = '09';
			$mo4 = '10';
			$mo5 = '11';
			$mo6 = '12';
		}
		
		$pdf->SetFillColor(210, 210, 210); 

		//header
		$pdf->Cell(50, 8, "Name", 	'RLTB', 0, 'C', 1);
		$pdf->Cell(20, 4, $m1,		'1',	0, 'C', 1);
		$pdf->Cell(20, 4, $m2,		'1',	0, 'C', 1);
		$pdf->Cell(20, 4, $m3,		'1',	0, 'C', 1);
		$pdf->Cell(20, 4, $m4,		'1',	0, 'C', 1);
		$pdf->Cell(20, 4, $m5,		'1',	0, 'C', 1);
		$pdf->Cell(20, 4, $m6,		'1',	1, 'C', 1);
		
		$pdf->SetFont('Arial','',9);
		$pdf->SetFillColor(240, 240, 240); 
		
		$pdf->Cell(50, 4, "",		'RLB',	0, 'C', FALSE);
		$pdf->Cell(10, 4, "Tardy",	'1',	0, 'C', 1);
		$pdf->Cell(10, 4, "UT",		'1',	0, 'C', 1);
		$pdf->Cell(10, 4, "Tardy",	'1',	0, 'C', 1);
		$pdf->Cell(10, 4, "UT",		'1',	0, 'C', 1);
		$pdf->Cell(10, 4, "Tardy",	'1',	0, 'C', 1);
		$pdf->Cell(10, 4, "UT",		'1',	0, 'C', 1);
		$pdf->Cell(10, 4, "Tardy",	'1',	0, 'C', 1);
		$pdf->Cell(10, 4, "UT",		'1',	0, 'C', 1);
		$pdf->Cell(10, 4, "Tardy",	'1',	0, 'C', 1);
		$pdf->Cell(10, 4, "UT",		'1',	0, 'C', 1);
		$pdf->Cell(10, 4, "Tardy",	'1',	0, 'C', 1);
		$pdf->Cell(10, 4, "UT",		'1',	1, 'C', 1);
		
		$pdf->SetFillColor(215, 255, 215);
		
		
		 foreach($offices as $office)
		{	
		
			$office_name = $this->Office->get_office_name($office);
			
			$tardis = $employees[$office];
			
			$pdf->Cell(170,4,$office_name,'1',1,'L',1);
			
			foreach($tardis as $tardi)
			{	
				$name = $this->Employee->get_employee_info($tardi['employee_id'], $field ='');
				
				$late1 = $this->Tardiness->count_late($name['employee_id'], $mo1, $year1, 1, 3);
				$late2 = $this->Tardiness->count_late($name['employee_id'], $mo2, $year1, 1, 3);
				$late3 = $this->Tardiness->count_late($name['employee_id'], $mo3, $year1, 1, 3);
				$late4 = $this->Tardiness->count_late($name['employee_id'], $mo4, $year1, 1, 3);
				$late5 = $this->Tardiness->count_late($name['employee_id'], $mo5, $year1, 1, 3);
				$late6 = $this->Tardiness->count_late($name['employee_id'], $mo6, $year1, 1, 3);
				
				$under_time1 = $this->Tardiness->count_late($name['employee_id'], $mo1, $year1, 2, 4);
				$under_time2 = $this->Tardiness->count_late($name['employee_id'], $mo2, $year1, 2, 4);
				$under_time3 = $this->Tardiness->count_late($name['employee_id'], $mo3, $year1, 2, 4);
				$under_time4 = $this->Tardiness->count_late($name['employee_id'], $mo4, $year1, 2, 4);
				$under_time5 = $this->Tardiness->count_late($name['employee_id'], $mo5, $year1, 2, 4);
				$under_time6 = $this->Tardiness->count_late($name['employee_id'], $mo6, $year1, 2, 4);
				
				$late1['tardi_count'] = $this->Tardiness->is_tardy_zero($late1['tardi_count']);
				$late2['tardi_count'] = $this->Tardiness->is_tardy_zero($late2['tardi_count']);
				$late3['tardi_count'] = $this->Tardiness->is_tardy_zero($late3['tardi_count']);
				$late4['tardi_count'] = $this->Tardiness->is_tardy_zero($late4['tardi_count']);
				$late5['tardi_count'] = $this->Tardiness->is_tardy_zero($late5['tardi_count']);
				$late6['tardi_count'] = $this->Tardiness->is_tardy_zero($late6['tardi_count']);
				
				$under_time1['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time1['tardi_count']);
				$under_time2['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time2['tardi_count']);
				$under_time3['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time3['tardi_count']);
				$under_time4['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time4['tardi_count']);
				$under_time5['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time5['tardi_count']);
				$under_time6['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time6['tardi_count']);
				
				//start employee tardy 
				$pdf->Cell(50,4, ucwords(strtolower(utf8_decode($name['fname'].' '.$name['mname'].' '.$name['lname']))),'RLTB',0,'L',FALSE);
				
				$pdf->Cell(10, 4, $late1['tardi_count'],		'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $under_time1['tardi_count'],	'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $late2['tardi_count'],		'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $under_time2['tardi_count'],	'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $late13['tardi_count'],		'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $under_time3['tardi_count'],	'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $late4['tardi_count'],		'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $under_time4['tardi_count'],	'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $late5['tardi_count'],		'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $under_time5['tardi_count'],	'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $late6['tardi_count'],		'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $under_time6['tardi_count'],	'1', 1, 'C', FALSE);
				
			}
				
			$pdf->Cell(50, 4, "",'RLTB',0,'L',FALSE);
			
			$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, "", '1', 1, 'C', FALSE);
			
		}
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
				
		header('Pragma: public');
	
		//If the parameter is D = download F = save as file
		$pdf->Output('dtr/reports/all_office_tardiness.pdf', 'F'); 

	}
	
	// --------------------------------------------------------------------
	
	function report_tardiness()
	{
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI();
		// add a page
		//$pdf->AddPage();
		$pdf->AddPage('L', 'Legal');
		// set the sourcefile
		//$pdf->setSourceFile('dtr/template/sample.pdf');
		
		// select the first page
		//$tplIdx = $pdf->importPage(1);
		
		// use the page we imported
		//$pdf->useTemplate($tplIdx);
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','',8);
		
		$rows =  $this->Tardiness->get_employees_with_tardy($this->input->post('month'),
															$this->input->post('year'), 
															$this->input->post('office_id')
															);
															
		$month 	= $this->input->post('month');
		$year 	= $this->input->post('year');											
		
		$pdf->Ln(3);
		
		$pdf->SetFillColor(210, 210, 210); 
		
		//Write heading
		$pdf->Cell(25, 6, "Employee No.",		'1', 0, 'C', 1);
		$pdf->Cell(60, 6, "Employee Name",		'1', 0, 'C', 1);
		$pdf->Cell(20, 6, "Tardiness",			'1', 0, 'C', 1);
		$pdf->Cell(25, 6, "No. of Late",		'1', 0, 'C', 1);
		$pdf->Cell(25, 6, "Hours",				'1', 0, 'C', 1);
		$pdf->Cell(25, 6, "No. of Undertime",	'1', 0, 'C', 1);
		$pdf->Cell(25, 6, "Hours",				'1', 0, 'C', 1);
		$pdf->Cell(30, 6, "Total",				'1', 0, 'C', 1);
		$pdf->Cell(40, 6, "VL Equivalent",		'1', 1, 'C', 1);//Put 1 to 5th param if the printing 
																//of the next cell is 
																//below. Put 0 to print the cell to right			
															
		foreach($rows as $id)
		{
				
			$tardiness = $this->Tardiness->count_tardiness($id, $month, $year, 1, 3);
			$tardiness2 = $this->Tardiness->count_tardiness($id, $month, $year, 2, 4);
			
			$total_tardiness = $tardiness['tardi_count'] + $tardiness2['tardi_count'];
			
			$late = $this->Tardiness->count_late($id, $month, $year, 1, 3);
			$underTime = $this->Tardiness->count_late($id, $month, $year, 2, 4);
			
			$totalLate = $this->Tardiness->compute_late_undertime('late', $id, $month, $year);
			$totalUnderTime = $this->Tardiness->compute_late_undertime('undertime', $id, $month, $year);
			
			$total = $late['number_seconds'] + $underTime['number_seconds'];
				
			if ($late['tardi_count'] == 0)
			{
				$late['tardi_count'] = '';
			}
			
			if ($underTime['tardi_count'] == 0)
			{
				$underTime['tardi_count'] = '';
			}
			
			$name = $this->Employee->get_employee_info($id);
			
			$pdf->Cell(25, 10, $id,														'1', 0, 'C', FALSE);
			$pdf->Cell(60, 10, utf8_decode($name['lname'].', '.$name['fname'].' '.$name['mname']),	'1', 0, 'L', FALSE);
			$pdf->Cell(20, 10, $total_tardiness,										'1', 0, 'C', FALSE);
			$pdf->Cell(25, 10, $late['tardi_count'],									'1', 0, 'C', FALSE);
			$pdf->Cell(25, 10, $this->Helps->compute_time($totalLate),					'1', 0, 'L', FALSE);
			$pdf->Cell(25, 10, $underTime['tardi_count'],								'1', 0, 'C', FALSE);
			$pdf->Cell(25, 10, $this->Helps->compute_time($totalUnderTime),				'1', 0, 'C', FALSE);
			$pdf->Cell(30, 10, $this->Helps->compute_time($total),						'1', 0, 'L', FALSE);
			$pdf->Cell(40, 10, $this->Leave_conversion_table->compute_hour_minute($total),	'1', 1, 'C', FALSE);//Put 1 to 5th param if
																											//the printing of the 
																											//next cell is 
																											//below. Put 0 to print 
																											//the cell to right
		}														
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
				
		header('Pragma: public');
	
		//If the parameter is D = download F = save as file
		$pdf->Output('dtr/reports/report_tardiness.pdf', 'F'); 
		
	}
		
	// --------------------------------------------------------------------
	
	function ten_tardiness($sem = 1)
	{
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('P', 'mm', 'Legal');
		
		$pdf->SetLeftMargin(20);
		$pdf->SetRightMargin(15);

		
		// add a page
		$pdf->AddPage();
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/notice1st.pdf');
		
		$lgu_place = 'Puerto Princesa City';
		$first_x = 50;
		
		$hrm_head 					= ' FELIMON R. SABAS              ';	
		$hrm_head_position 			= ' CG Department Head II              ';			   
		$hrm_head_position_other 	=  '(City Personnel Officer)              ';	

		
		$lgu_code = $this->Settings->get_selected_field('lgu_code'); 
		
		if ( $lgu_code == 'marinduque_province' )
		{	
			$pdf->setSourceFile('dtr/template/marinduque/notice1st_marinduque.pdf');
			$lgu_place = 'Boac, Marinduque';
			$first_x = 70;
			
			

			$hrm_head 					= ' ERMA E. REYES              ';	
			$hrm_head_position 			= ' Chief Administrative Officer      ';			   
			$hrm_head_position_other 	=  '             ';	

			$hrm_head  			= $this->Settings->get_selected_field( 'statement_certified' );
			$hrm_head_position 	= $this->Settings->get_selected_field( 'statement_certified_position' );

		}
		
		// select the first page
		$tplIdx = $pdf->importPage(1);
		
		// use the page we imported
		$pdf->useTemplate($tplIdx);
		
		
		$month1 = $this->input->post('month1');
		$month2 = $this->input->post('month2');
		$year1 =  $this->input->post('year');
		
		
		$offices = $this->input->post('offices');
		
		$office_id = $offices[0];
		
		if ($sem == 1)
		{
			$m1 = 'Jan';
			$m2 = 'Feb';
			$m3 = 'March';
			$m4 = 'Apr';
			$m5 = 'May';
			$m6 = 'Jun';
			
			$mo1 = '01';
			$mo2 = '02';
			$mo3 = '03';
			$mo4 = '04';
			$mo5 = '05';
			$mo6 = '06';
		}
		
		if ($sem == 2)
		{
			$m1 = 'Jul';
			$m2 = 'Aug';
			$m3 = 'Sep';
			$m4 = 'Oct';
			$m5 = 'Nov';
			$m6 = 'Dec';
			
			$mo1 = '07';
			$mo2 = '08';
			$mo3 = '09';
			$mo4 = '10';
			$mo5 = '11';
			$mo6 = '12';
		}
		
		$pdf->SetFont('Arial','','12');


		$pdf->SetXY(155, $first_x);
		
		$pdf->Write(0, date('F d, Y'));
				
		$pdf->Ln(10);
		
		//get office head
		$office_info = $this->Office->get_office_info($office_id);
		
		$pdf->SetFont('Arial','B','12');
		
		$pdf->SetX(35);
		
		$pdf->Write(0, $office_info['office_head']);
		$pdf->Ln(6);
		$pdf->SetX(35);
		$pdf->SetFont('Arial','','12');
		$pdf->Write(0, $office_info['position']);
		
		$pdf->Ln(5);
		$pdf->SetX(35);
		
		$pdf->Write(0, $lgu_place);
		
		$pdf->Ln(12);
		$pdf->SetX(35);
		
		$pdf->Write(0, 'Sir/Madam:');
		
		//$tardis = $_SESSION['10x'][$_SESSION['offices'][0]];
		
		$this->Tardiness->get_employees_ten_tardy($month1, 
												  $month2, 
												  $year1, 
												  $office_id
												  );
		$tardis = $this->Tardiness->employees;

//print_r($tardis);
//exit;

		$count_employee = $this->Helps->convert_number(count($tardis));
		
		$pdf->Ln(6);
		$pdf->SetX(35);
		$pdf->MultiCell(0,6,"                Please be informed that per records in this Office, it has been observed that $count_employee of your employees has incurred the following tardiness and undertime, viz:",0,'L',false);
		
		//$pdf->SetX(35);				
		//$pdf->Cell(0,6," $number of your employees has incurred the following, viz:",'',0,'L',false);				
		
		$pdf->SetFont('Arial','BI',10);
		$pdf->Ln(2);
		
		$pdf->SetFillColor(210, 210, 210); 
		
		//$pdf->SetX(20);
		//header
		$pdf->Cell(50,8,"Name",'RLTB',0,'C',1);
		$pdf->Cell(20,4,$m1,'1',0,'C',1);
		$pdf->Cell(20,4,$m2,'1',0,'C',1);
		$pdf->Cell(20,4,$m3,'1',0,'C',1);
		$pdf->Cell(20,4,$m4,'1',0,'C',1);
		$pdf->Cell(20,4,$m5,'1',0,'C',1);
		$pdf->Cell(20,4,$m6,'1',1,'C',1);
		
		$pdf->SetFont('Arial','',9);
		$pdf->SetFillColor(240, 240, 240); 
		
		$pdf->Cell(50,4,"",'RLB',0,'C',false);
		$pdf->Cell(10,4,"Tardy",'1',0,'C',1);
		$pdf->Cell(10,4,"UT",'1',0,'C',1);
		$pdf->Cell(10,4,"Tardy",'1',0,'C',1);
		$pdf->Cell(10,4,"UT",'1',0,'C',1);
		$pdf->Cell(10,4,"Tardy",'1',0,'C',1);
		$pdf->Cell(10,4,"UT",'1',0,'C',1);
		$pdf->Cell(10,4,"Tardy",'1',0,'C',1);
		$pdf->Cell(10,4,"UT",'1',0,'C',1);
		$pdf->Cell(10,4,"Tardy",'1',0,'C',1);
		$pdf->Cell(10,4,"UT",'1',0,'C',1);
		$pdf->Cell(10,4,"Tardy",'1',0,'C',1);
		$pdf->Cell(10,4,"UT",'1',1,'C',1);
		
		$pdf->SetFillColor(215, 255, 215);
		
			
		//print_r($tardis);
		
		foreach($tardis as $tardi)
		{	
			$name = $this->Employee->get_employee_info($tardi, $field ='');
			
			$late1 = $this->Tardiness->count_late($name['employee_id'], $mo1, $year1, 1, 3);
			$late2 = $this->Tardiness->count_late($name['employee_id'], $mo2, $year1, 1, 3);
			$late3 = $this->Tardiness->count_late($name['employee_id'], $mo3, $year1, 1, 3);
			$late4 = $this->Tardiness->count_late($name['employee_id'], $mo4, $year1, 1, 3);
			$late5 = $this->Tardiness->count_late($name['employee_id'], $mo5, $year1, 1, 3);
			$late6 = $this->Tardiness->count_late($name['employee_id'], $mo6, $year1, 1, 3);
			
			$under_time1 = $this->Tardiness->count_late($name['employee_id'], $mo1, $year1, 2, 4);
			$under_time2 = $this->Tardiness->count_late($name['employee_id'], $mo2, $year1, 2, 4);
			$under_time3 = $this->Tardiness->count_late($name['employee_id'], $mo3, $year1, 2, 4);
			$under_time4 = $this->Tardiness->count_late($name['employee_id'], $mo4, $year1, 2, 4);
			$under_time5 = $this->Tardiness->count_late($name['employee_id'], $mo5, $year1, 2, 4);
			$under_time6 = $this->Tardiness->count_late($name['employee_id'], $mo6, $year1, 2, 4);
			
			$late1['tardi_count'] = $this->Tardiness->is_tardy_zero($late1['tardi_count']);
			$late2['tardi_count'] = $this->Tardiness->is_tardy_zero($late2['tardi_count']);
			$late3['tardi_count'] = $this->Tardiness->is_tardy_zero($late3['tardi_count']);
			$late4['tardi_count'] = $this->Tardiness->is_tardy_zero($late4['tardi_count']);
			$late5['tardi_count'] = $this->Tardiness->is_tardy_zero($late5['tardi_count']);
			$late6['tardi_count'] = $this->Tardiness->is_tardy_zero($late6['tardi_count']);
			
			$under_time1['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time1['tardi_count']);
			$under_time2['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time2['tardi_count']);
			$under_time3['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time3['tardi_count']);
			$under_time4['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time4['tardi_count']);
			$under_time5['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time5['tardi_count']);
			$under_time6['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time6['tardi_count']);
			
			//start employee tardy
			$pdf->Cell(50,4, ucwords(strtolower(utf8_decode($name['fname'].' '.$name['mname'].' '.$name['lname']))),'RLTB',0,'L',false);
			
			$pdf->Cell(10, 4, $late1['tardi_count'],		'1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, $under_time1['tardi_count'],	'1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, $late2['tardi_count'],		'1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, $under_time2['tardi_count'],	'1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, $late3['tardi_count'],		'1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, $under_time3['tardi_count'],	'1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, $late4['tardi_count'],		'1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, $under_time4['tardi_count'],	'1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, $late5['tardi_count'], 		'1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, $under_time5['tardi_count'],	'1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, $late6['tardi_count'],		'1', 0, 'C', FALSE);
			$pdf->Cell(10, 4, $under_time6['tardi_count'],	'1', 1, 'C', FALSE);
			
		}
			
		$pdf->Cell(50, 4, "", 'RLTB', 0, 'L', FALSE);
		
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 1, 'C', FALSE);
			
		// line break
		$pdf->Ln(5);
		$pdf->SetFont('Arial','','12');
		$pdf->SetX(35);
		
		
		$pdf->MultiCell(0,6,"             Section 8, Rule XVII of the Omnibus Rules Implementing Book V of Executive Order No. 292, states that: 
				   'Officers and employees who have incurred tardiness and undertime, regardless of the number of minutes per day, ten (10) times a month for at least two (2) consecutive months during the year or for at least two (2) months in a semester shall be subject to disciplinary action.'
				   Violation of the said rule carries the following penalties:
		
				   1.	First Offense - Reprimand;
				   2.	Second Offense - Suspension for one (1) day to thirty (30) days; and
				   3.	Third Offense - Dismissal.
		
				   In view hereof, may we request your office to advise them to take special attention on the above-mentioned CSC Memorandum to avoid future disciplinary action.
		
				   Your preferential attention on this matter is highly appreciated.
		
				   Thank you.
		", 0,'L',false);
		
		$pdf->Cell(0,6," Very truly yours,              ",'',1,'R',FALSE);
		$pdf->Cell(0,6,"              ",'',1,'R',FALSE);
		$pdf->Cell(0,6,"               ",'',1,'R',FALSE);
		$pdf->SetFont('Arial','B','');
		$pdf->Cell(0,6,$hrm_head,'',1,'R',FALSE);
		$pdf->SetFont('Arial','','');
		$pdf->Cell(0,6,$hrm_head_position,'',1,'R',FALSE);
		$pdf->Cell(0,6,$hrm_head_position_other,'',1,'R',FALSE);
		
		
		if ( $lgu_code == 'marinduque_province' )
		{
			header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
				
			header('Pragma: public');
		
			//If the parameter is D = download F = save as file
			$pdf->Output('dtr/reports/ten_tardiness.pdf', 'F'); 
			
			return;
		}
					   
		$pdf->MultiCell(0,6,"
		NOTED:
		
		BY AUTHORITY OF THE CITY MAYOR:",0,'L',FALSE);
		
		$pdf->SetFont('Arial','B','');
		$pdf->Cell(0,6,"    ATTY. AGUSTIN M. ROCAMORA",'',1,'L',FALSE);
		$pdf->SetFont('Arial','','');
		$pdf->Cell(0,6,"       City Administrator II",'',1,'L',FALSE);
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
				
		header('Pragma: public');
	
		//If the parameter is D = download F = save as file
		$pdf->Output('dtr/reports/ten_tardiness.pdf', 'F'); 
	}
	
	function ten_tardiness_second($second_offenders = array())
	{
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('P', 'mm', 'Legal');
		
		$pdf->SetLeftMargin(20);
		$pdf->SetRightMargin(15);

		
		// add a page
		$pdf->AddPage();
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/notice2nd.pdf');
		
		// select the first page
		$tplIdx = $pdf->importPage(1);
		
		// use the page we imported
		$pdf->useTemplate($tplIdx);
		
		$offices = $this->input->post('offices');
		
		$office_id = $offices[0];
		
		
		$m1 = 'Jul';
		$m2 = 'Aug';
		$m3 = 'Sep';
		$m4 = 'Oct';
		$m5 = 'Nov';
		$m6 = 'Dec';
		
		$mo1 = '07';
		$mo2 = '08';
		$mo3 = '09';
		$mo4 = '10';
		$mo5 = '11';
		$mo6 = '12';
		
		
		
		$pdf->SetFont('Arial','','12');


		$pdf->SetXY(155, 50);
		
		$pdf->Write(0, date('F d, Y'));
			
		$pdf->SetX(35);
		
		$pdf->SetFont('Arial','B','');
		$pdf->Cell(0,6,"HON. EDWARD S. HAGEDORN ",'',1,'L',FALSE);
		$pdf->SetFont('Arial','','');
		$pdf->SetX(35);
		$pdf->Cell(0,6,"City Mayor",'',1,'L',FALSE);
		$pdf->SetX(35);
		$pdf->Cell(0,6,"Puerto Princesa City",'',1,'L',FALSE);
		
		$pdf->Cell(0,6,"",'',1,'C',FALSE);
		$pdf->Cell(0,6,"Thru: ATTY. SHIRLEY R. DAGANTA",'',1,'C',FALSE);
		$pdf->Cell(0,6,"CG Assistant Dept. Head II",'',1,'C',FALSE);
		$pdf->Cell(0,6,"Assistant City Legal Officer II",'',1,'C',FALSE);
		
		$pdf->Ln(12);
		$pdf->SetX(35);
		
		$pdf->SetFont('Arial','B','');
		$pdf->Write(0, 'Madam:');
		$pdf->SetFont('Arial','','');
		
		$pdf->Ln(6);
		$pdf->SetX(35);
		$pdf->MultiCell(0,6,"                Please be informed that despite the first notice issued to him/her as per records in this office, it has been observed that the he/she has continuously incurred the following tardiness and undertime, viz:",0,'L',false);
		
		//$pdf->SetX(35);				
		//$pdf->Cell(0,6," $number of your employees has incurred the following, viz:",'',0,'L',false);				
		
		$pdf->SetFont('Arial','BI',10);
		$pdf->Ln(2);
		
		$pdf->SetFillColor(210, 210, 210); 
		
		//$pdf->SetX(20);
		//header
		$pdf->Cell(50,8,"Name",'RLTB',0,'C',1);
		$pdf->Cell(20,4,$m1,'1',0,'C',1);
		$pdf->Cell(20,4,$m2,'1',0,'C',1);
		$pdf->Cell(20,4,$m3,'1',0,'C',1);
		$pdf->Cell(20,4,$m4,'1',0,'C',1);
		$pdf->Cell(20,4,$m5,'1',0,'C',1);
		$pdf->Cell(20,4,$m6,'1',1,'C',1);
		
		$pdf->SetFont('Arial','',9);
		$pdf->SetFillColor(240, 240, 240); 
		
		$pdf->Cell(50,4,"",'RLB',0,'C',false);
		$pdf->Cell(10,4,"Tardy",'1',0,'C',1);
		$pdf->Cell(10,4,"UT",'1',0,'C',1);
		$pdf->Cell(10,4,"Tardy",'1',0,'C',1);
		$pdf->Cell(10,4,"UT",'1',0,'C',1);
		$pdf->Cell(10,4,"Tardy",'1',0,'C',1);
		$pdf->Cell(10,4,"UT",'1',0,'C',1);
		$pdf->Cell(10,4,"Tardy",'1',0,'C',1);
		$pdf->Cell(10,4,"UT",'1',0,'C',1);
		$pdf->Cell(10,4,"Tardy",'1',0,'C',1);
		$pdf->Cell(10,4,"UT",'1',0,'C',1);
		$pdf->Cell(10,4,"Tardy",'1',0,'C',1);
		$pdf->Cell(10,4,"UT",'1',1,'C',1);
		
		$pdf->SetFillColor(215, 255, 215);
		
		$year1 = $this->input->post('year');
			
		$tardis = $second_offenders;
		
		if (is_array($tardis))
		{
			foreach($tardis as $tardi)
			{	
				$name = $this->Employee->get_employee_info($tardi, $field ='');
				
				$late1 = $this->Tardiness->count_late($name['employee_id'], $mo1, $year1, 1, 3);
				$late2 = $this->Tardiness->count_late($name['employee_id'], $mo2, $year1, 1, 3);
				$late3 = $this->Tardiness->count_late($name['employee_id'], $mo3, $year1, 1, 3);
				$late4 = $this->Tardiness->count_late($name['employee_id'], $mo4, $year1, 1, 3);
				$late5 = $this->Tardiness->count_late($name['employee_id'], $mo5, $year1, 1, 3);
				$late6 = $this->Tardiness->count_late($name['employee_id'], $mo6, $year1, 1, 3);
				
				$under_time1 = $this->Tardiness->count_late($name['employee_id'], $mo1, $year1, 2, 4);
				$under_time2 = $this->Tardiness->count_late($name['employee_id'], $mo2, $year1, 2, 4);
				$under_time3 = $this->Tardiness->count_late($name['employee_id'], $mo3, $year1, 2, 4);
				$under_time4 = $this->Tardiness->count_late($name['employee_id'], $mo4, $year1, 2, 4);
				$under_time5 = $this->Tardiness->count_late($name['employee_id'], $mo5, $year1, 2, 4);
				$under_time6 = $this->Tardiness->count_late($name['employee_id'], $mo6, $year1, 2, 4);
				
				$late1['tardi_count'] = $this->Tardiness->is_tardy_zero($late1['tardi_count']);
				$late2['tardi_count'] = $this->Tardiness->is_tardy_zero($late2['tardi_count']);
				$late3['tardi_count'] = $this->Tardiness->is_tardy_zero($late3['tardi_count']);
				$late4['tardi_count'] = $this->Tardiness->is_tardy_zero($late4['tardi_count']);
				$late5['tardi_count'] = $this->Tardiness->is_tardy_zero($late5['tardi_count']);
				$late6['tardi_count'] = $this->Tardiness->is_tardy_zero($late6['tardi_count']);
				
				$under_time1['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time1['tardi_count']);
				$under_time2['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time2['tardi_count']);
				$under_time3['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time3['tardi_count']);
				$under_time4['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time4['tardi_count']);
				$under_time5['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time5['tardi_count']);
				$under_time6['tardi_count'] = $this->Tardiness->is_tardy_zero($under_time6['tardi_count']);
				
				//start employee tardy
				$pdf->Cell(50,4, ucwords(strtolower(utf8_decode($name['fname'].' '.$name['mname'].' '.$name['lname']))),'RLTB',0,'L',false);
				
				$pdf->Cell(10, 4, $late1['tardi_count'],		'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $under_time1['tardi_count'],	'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $late2['tardi_count'],		'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $under_time2['tardi_count'],	'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $late3['tardi_count'],		'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $under_time3['tardi_count'],	'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $late4['tardi_count'],		'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $under_time4['tardi_count'],	'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $late5['tardi_count'], 		'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $under_time5['tardi_count'],	'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $late6['tardi_count'],		'1', 0, 'C', FALSE);
				$pdf->Cell(10, 4, $under_time6['tardi_count'],	'1', 1, 'C', FALSE);
				
			}
		}
		
		
			
		$pdf->Cell(50, 4, "", 'RLTB', 0, 'L', FALSE);
		
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 0, 'C', FALSE);
		$pdf->Cell(10, 4, "", '1', 1, 'C', FALSE);
			
		// line break
		$pdf->Ln(5);
		$pdf->SetFont('Arial','','12');
		$pdf->SetX(35);
		
		
		$pdf->MultiCell(0,6,"             Section 8, Rule XVII of the Omnibus Rules Implementing Book V of Executive Order No. 292, states that: 
				   'Officers and employees who have incurred tardiness and undertime, regardless of the number of minutes per day, ten (10) times a month for at least two (2) consecutive months during the year or for at least two (2) months in a semester shall be subject to disciplinary action.'
				   Violation of the said rule carries the following penalties:
		
				   1.	First Offense - Reprimand;
				   2.	Second Offense - Suspension for one (1) day to thirty (30) days; and
				   3.	Third Offense - Dismissal.
		
				   For your appropriate action.
		",'',1,'L',false);
		
		$pdf->Cell(0,6," Very truly yours,              ", 0,'R',FALSE);
		$pdf->Cell(0,6,"              ",'',1,'R',FALSE);
		$pdf->Cell(0,6,"               ",'',1,'R',FALSE);
		$pdf->SetFont('Arial','B','');
		$pdf->Cell(0,6," FELIMON R. SABAS              ",'',1,'R',FALSE);
		$pdf->SetFont('Arial','','');
		$pdf->Cell(0,6," CG Department Head II              ",'',1,'R',FALSE);
		$pdf->Cell(0,6," (City Personnel Officer)              ",'',1,'R',FALSE);
					   
					   
		$pdf->MultiCell(0,6,"
		NOTED:
		
		BY AUTHORITY OF THE CITY MAYOR:",0,'L',FALSE);
		
		$pdf->SetFont('Arial','B','');
		$pdf->Cell(0,6,"    ATTY. AGUSTIN M. ROCAMORA",'',1,'L',FALSE);
		$pdf->SetFont('Arial','','');
		$pdf->Cell(0,6,"       City Administrator II",'',1,'L',FALSE);
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
				
		header('Pragma: public');
	
		//If the parameter is D = download F = save as file
		$pdf->Output('dtr/reports/ten_tardiness_second.pdf', 'F'); 
	}
}

/* End of file reports.php */
/* Location: ./application/modules/reports/controllers/reports.php */