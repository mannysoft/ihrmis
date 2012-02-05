<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
				
				$late1 = $this->Tardiness->count_late($name['id'], $mo1, $year1, 1, 3);
				$late2 = $this->Tardiness->count_late($name['id'], $mo2, $year1, 1, 3);
				$late3 = $this->Tardiness->count_late($name['id'], $mo3, $year1, 1, 3);
				$late4 = $this->Tardiness->count_late($name['id'], $mo4, $year1, 1, 3);
				$late5 = $this->Tardiness->count_late($name['id'], $mo5, $year1, 1, 3);
				$late6 = $this->Tardiness->count_late($name['id'], $mo6, $year1, 1, 3);
				
				$under_time1 = $this->Tardiness->count_late($name['id'], $mo1, $year1, 2, 4);
				$under_time2 = $this->Tardiness->count_late($name['id'], $mo2, $year1, 2, 4);
				$under_time3 = $this->Tardiness->count_late($name['id'], $mo3, $year1, 2, 4);
				$under_time4 = $this->Tardiness->count_late($name['id'], $mo4, $year1, 2, 4);
				$under_time5 = $this->Tardiness->count_late($name['id'], $mo5, $year1, 2, 4);
				$under_time6 = $this->Tardiness->count_late($name['id'], $mo6, $year1, 2, 4);
				
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
	
	function leave_apps($leave_apps_id = '')
	{
		$rows = $this->Leave_apps->get_leave_apps_info($leave_apps_id);

		$name = $this->Employee->get_employee_info($rows['employee_id']);
		
		$office_name = $this->Office->get_office_name($name['office_id']);
		
		
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('P', 'mm', 'Legal');
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
		
		//monthly salary
		$pdf->SetX(170);
		$pdf->Write(0, 'P '.number_format($this->Salary_grade->get_monthly_salary($name['salary_grade'], $name['step']), 2));
		
		
		$pdf->Ln(14);
		
		
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
		
		$pdf->Ln(9);
		$pdf->SetX(50);
		$pdf->Write(0, $date_leave);
		
		$last_earn = $this->Leave_card->get_last_earn($rows['employee_id']);
		//$last_earn = date('F d, Y', strtotime($last_earn));
		
		if ( $last_earn != '0000-00-00')
		{
			$last_earn = date('F d, Y', strtotime($last_earn));
		}
		else
		{
			$last_earn = date('F d, Y');
		}
		
		$vbalance =  $this->Leave_balance->get_leave_balance(1, $rows['employee_id']);
		$sbalance =  $this->Leave_balance->get_leave_balance(2, $rows['employee_id']);
		
		$pdf->Ln(34);
		$pdf->SetX(35);
		$pdf->Write(0, $last_earn);
		
		//balances
		$pdf->Ln(18);
		$pdf->SetX(25);
		$pdf->Write(0, $vbalance);
		
		$pdf->SetX(54);
		$pdf->Write(0, $sbalance);
		
		$total_leave_balance = $vbalance + $sbalance;
		
		$pdf->SetX(80);
		$pdf->Write(0, $total_leave_balance);
		
		
		// set font, font style, font size.
		$pdf->SetFont('Arial','B',12);
		
		$pdf->Ln(9);
		
		$pdf->SetX(136);
		
		
		
		//$pdf->Write(0, date("F d, Y").':');
		
		
		
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
		
		$pdf->SetX(32);
		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
		
		header('Pragma: public');
		
		$pdf->Output('dtr/reports/leave-apps-'.$rows['employee_id'].'.pdf', 'F'); 
		
		redirect(base_url().'dtr/reports/leave-apps-'.$rows['employee_id'].'.pdf', 'refresh');
		
	}
	
	// --------------------------------------------------------------------
	
	function leave_certification($vl = 0, $sl = 0, $employee_id = '004001') 
	{
		$lgu_code = $this->Settings->get_selected_field('lgu_code'); 
		
		
		if ( $lgu_code == 'marinduque_province' )
		{
	
			$this->leave_certification_marinduque($vl, $sl, $employee_id);
			
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
		
		$greet = 'Sir:';
		
		if ($name['sex'] == 1)
		{
			$greet = 'Sir:';
		}
		
		if ($name['sex'] == 2)
		{
			$greet = 'Madam:';
		}
		
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
		$pdf->SetX(138);
		
		//$pdf->Write(0, date('Y'));
		
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
		
		// write
		//$pdf->Write(0, $name['salut'].' '.ucwords(strtolower(utf8_decode($name['fname']))).' '.
										 // ucwords(strtolower(utf8_decode($name['mname']))).' '.
										  //ucwords(strtolower(utf8_decode($name['lname'])))
										  //);
										  
		$pdf->MultiCell(0,6,"                This is to certify that ".$name['salut'].' '.ucwords(strtolower(utf8_decode($name['fname']))).' '.
										 ucwords(strtolower(utf8_decode($name['mname']))).' '.
										  ucwords(strtolower(utf8_decode($name['lname']))).', '.$name['position'] .' of the '.$office_name.
										  ' has accumulated leave credits as of '.date('F').' '.date('d').', '.date('Y').
										  '' ,'',1,'L',false);								  
		
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
		
		//$pdf->Write(0, date("F d, Y").':');
		
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
		$pdf->SetX(35);
		
		$pdf->MultiCell(0,6,"                ISSUED this ".date('jS')." day of ".date('F, Y')." upon request of ".
		                    $name['salut'].' '.ucwords(strtolower(utf8_decode($name['lname'])))." for  whatever purpose it may serve." ,'',1,'L',false);
		
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
										  '.' ,'',1,'C',false);								  
		
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
		                    $name['salut'].' '.ucwords(strtolower(utf8_decode($name['lname'])))." for  whatever legal purpose it may serve." ,'',1,'J',false);
		
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
		
		//$pdf->Output('dtr/reports/leave_certification_'.$employee_id.'.pdf', 'F'); 
		$pdf->Output('dtr/reports/leave_certification_'.$employee_id.'.pdf', 'I'); 
		
		//redirect(base_url().'dtr/reports/leave_certification_'.$employee_id.'.pdf', 'refresh');
		
		
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
			$pdf->Cell(40, 10, $this->Conversion_table->compute_hour_minute($total),	'1', 1, 'C', FALSE);//Put 1 to 5th param if
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
	
	function statement_leave($state_no = '', $employee_id = '')
	{
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
						
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI();
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
		
		
		//list($year, $month, $day) = split('[-.-]', $name['first_day_of_service']);
		list($year, $month, $day) = explode('-', $name['first_day_of_service']);
		
		$entrance = $year.'-'.$month.'-'.$day;
		
		if($name['first_day_of_service'] !="")
		{
			$name['first_day_of_service'] = date("F d, Y", mktime(0, 0, 0, $month, $day, $year));
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
		
		$pdf->Cell(44,5,"",			'RLB',	0,'C',false);
		$pdf->Cell(20,5,"",	'1',	0,'C',false);
		$pdf->Cell(20,5,"",		'1',	0,'C',false);
		$pdf->Cell(20,5,"",	'1',	0,'C',false);
		$pdf->Cell(20,5,"",		'1',	0,'C',false);
		$pdf->Cell(20,5,"",	'1',	0,'C',false);
		$pdf->Cell(20,5,"",		'1',	0,'C',false);
		$pdf->Cell(30,5,"",			'1',	0,'C',false);
		
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
		
		// Check if there is a balance forwarded for the employee	
		$is_forwarded_leave_exists = $this->Forwarded_leave->is_forwarded_leave_exists($employee_id);
		
		// If there is a forwarded balance
		if ($is_forwarded_leave_exists == TRUE)
		{	
			//Get forwarded leave
			$row_leave 			= $this->Forwarded_leave->get_forwarded_leave($employee_id);
			
			$vacation_balance	= $row_leave['forwarded_vacation'];
			$sick_balance		= $row_leave['forwarded_sick'];
			
			$year = date('Y');
			//$year =  str_replace('Bal. forwarded as of ','', $row_leave['forwarded_note']);
			
			$year = substr($row_leave['forwarded_note'], -4);    
			
			$next_day = substr($row_leave['forwarded_note'], -10);    
			//exit;
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
						   
				//$pdf->Write(0, date('m/d/y', strtotime($n_year.'-'.$n_month.'-'.$n_day.' + 1 day')).
					//               '  to  12/31/'.date("y", mktime(0, 0, 0, $month, $day, $year)).' '.$month.$day.$year);	
								   
				$pdf->Write(0, date('m/d/y', strtotime($n_year.'-'.$n_month.'-'.$n_day.' + 1 day')).
					               '  to '.date("m/d/y"));					   			   
								   
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
		$pdf->Write(0, number_format($sick_balance, 3) + number_format($vacation_balance, 3));
		
		//LETS GET THE TERMINAL LEAVE PAY FOR THIS EMPLOYEE
		
		//list($sg, $step) = split('[-.-]', $name['salary_grade']);
		//list($sg, $step) = explode('-', $name['salary_grade']);
		
		
		$grand_total = $this->Salary_grade->monetary_equivalent($name['salary_grade'], $name['step'], $sick_balance, $vacation_balance);
		
		//compute #days x 0.0478087 x Highest salary received
		//$grand_total = ($sick_balance + $vacation_balance) * 0.0478087 * $step;
		
		$pdf->Ln(10);
		$pdf->SetX(120);
		$pdf->Write(0, 'Monetary Equivalent PHP '.$grand_total);
		
		
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


		$pdf->SetXY(155, 50);
		
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
		
		$pdf->Write(0, 'Puerto Princesa City');
		
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
		$count_employee = $this->Helps->convert_number(count($tardis));
		
		$pdf->Ln(6);
		$pdf->SetX(35);
		$pdf->MultiCell(0,6,"                Please be informed that per records in this Office, it has been observed that $count_employee of your employees has incurred the following tardiness and undertime, viz:",'',1,'L',false);
		
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
			
			$late1 = $this->Tardiness->count_late($name['id'], $mo1, $year1, 1, 3);
			$late2 = $this->Tardiness->count_late($name['id'], $mo2, $year1, 1, 3);
			$late3 = $this->Tardiness->count_late($name['id'], $mo3, $year1, 1, 3);
			$late4 = $this->Tardiness->count_late($name['id'], $mo4, $year1, 1, 3);
			$late5 = $this->Tardiness->count_late($name['id'], $mo5, $year1, 1, 3);
			$late6 = $this->Tardiness->count_late($name['id'], $mo6, $year1, 1, 3);
			
			$under_time1 = $this->Tardiness->count_late($name['id'], $mo1, $year1, 2, 4);
			$under_time2 = $this->Tardiness->count_late($name['id'], $mo2, $year1, 2, 4);
			$under_time3 = $this->Tardiness->count_late($name['id'], $mo3, $year1, 2, 4);
			$under_time4 = $this->Tardiness->count_late($name['id'], $mo4, $year1, 2, 4);
			$under_time5 = $this->Tardiness->count_late($name['id'], $mo5, $year1, 2, 4);
			$under_time6 = $this->Tardiness->count_late($name['id'], $mo6, $year1, 2, 4);
			
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
		",'',1,'L',false);
		
		$pdf->Cell(0,6," Very truly yours,              ",'',1,'R',FALSE);
		$pdf->Cell(0,6,"              ",'',1,'R',FALSE);
		$pdf->Cell(0,6,"               ",'',1,'R',FALSE);
		$pdf->SetFont('Arial','B','');
		$pdf->Cell(0,6," FELIMON R. SABAS              ",'',1,'R',FALSE);
		$pdf->SetFont('Arial','','');
		$pdf->Cell(0,6," CG Department Head II              ",'',1,'R',FALSE);
		$pdf->Cell(0,6," (City Personnel Officer)              ",'',1,'R',FALSE);
					   
					   
		$pdf->MultiCell(0,6,"
		NOTED:
		
		BY AUTHORITY OF THE CITY MAYOR:",'',1,'L',FALSE);
		
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
		$pdf->MultiCell(0,6,"                Please be informed that despite the first notice issued to him/her as per records in this office, it has been observed that the he/she has continuously incurred the following tardiness and undertime, viz:",'',1,'L',false);
		
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
		
		foreach($tardis as $tardi)
		{	
			$name = $this->Employee->get_employee_info($tardi, $field ='');
			
			$late1 = $this->Tardiness->count_late($name['id'], $mo1, $year1, 1, 3);
			$late2 = $this->Tardiness->count_late($name['id'], $mo2, $year1, 1, 3);
			$late3 = $this->Tardiness->count_late($name['id'], $mo3, $year1, 1, 3);
			$late4 = $this->Tardiness->count_late($name['id'], $mo4, $year1, 1, 3);
			$late5 = $this->Tardiness->count_late($name['id'], $mo5, $year1, 1, 3);
			$late6 = $this->Tardiness->count_late($name['id'], $mo6, $year1, 1, 3);
			
			$under_time1 = $this->Tardiness->count_late($name['id'], $mo1, $year1, 2, 4);
			$under_time2 = $this->Tardiness->count_late($name['id'], $mo2, $year1, 2, 4);
			$under_time3 = $this->Tardiness->count_late($name['id'], $mo3, $year1, 2, 4);
			$under_time4 = $this->Tardiness->count_late($name['id'], $mo4, $year1, 2, 4);
			$under_time5 = $this->Tardiness->count_late($name['id'], $mo5, $year1, 2, 4);
			$under_time6 = $this->Tardiness->count_late($name['id'], $mo6, $year1, 2, 4);
			
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
		
				   For your appropriate action.
		",'',1,'L',false);
		
		$pdf->Cell(0,6," Very truly yours,              ",'',1,'R',FALSE);
		$pdf->Cell(0,6,"              ",'',1,'R',FALSE);
		$pdf->Cell(0,6,"               ",'',1,'R',FALSE);
		$pdf->SetFont('Arial','B','');
		$pdf->Cell(0,6," FELIMON R. SABAS              ",'',1,'R',FALSE);
		$pdf->SetFont('Arial','','');
		$pdf->Cell(0,6," CG Department Head II              ",'',1,'R',FALSE);
		$pdf->Cell(0,6," (City Personnel Officer)              ",'',1,'R',FALSE);
					   
					   
		$pdf->MultiCell(0,6,"
		NOTED:
		
		BY AUTHORITY OF THE CITY MAYOR:",'',1,'L',FALSE);
		
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