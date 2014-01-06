<?php
/**
 * Integrated Human Resource Management Information System
 *
 * An Open Source Application Software use by Government agencies for  
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2014, Charliesoft
 * @license		http://charliesoft.net/ihrmis/license
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis
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
 * @link		http://charliesoft.net
 * @github	    http://github.com/mannysoft/ihrmis/hrmis/user_guide/models/conversion_table.html
 */
class Sr_preview extends MX_Controller
{
	var $pds = array();
	
	function __construct()
    {
        parent::__construct();
    }
	
	function preview($employee_id)
	{
		
		$this->load->helper('settings');
		
		$this->load->library('fpdf');
		
		//define('FPDF_FONTPATH',$this->config->item('fonts_path'));
					
		$this->load->library('fpdi');
		
		//$pi = new Personal();
		//$pi->get_by_employee_id( $employee_id );
		
		//print_r($personal_info);	
		// initiate FPDI   
		$pdf = new FPDI('P','mm','Letter');
		
		// add a page
		$pdf->AddPage();
		// set the sourcefile
		//$pdf->setSourceFile('dtr/template/service_record/service_record.pdf');
		// import page 1
		//$tplIdx = $pdf->importPage(1);
		// use the imported page and place it at point 10,10 with a width of 100 mm
		//$pdf->useTemplate($tplIdx, 1, 1, 210);
		// now write some text above the imported page
		$pdf->SetFont('Arial');
		$pdf->SetTextColor(0,0,0);
		
		$pdf->SetXY(15, 60);
		
		$pdf->SetFont('Arial', '', 16);	
		
		$pdf->Cell(0,3,"Employee's Service Record" ,'',1,'C',false);
		
		$pdf->Ln(4);
		
		$e = new Employee_m();
		
		$e->get_by_id( $employee_id ); 
		
		$pdf->SetFont('Arial', '', 12);	
		$pdf->Cell(0,8,"Employee No.:".$e->employee_id ,'',1,'L',false);
		$pdf->Ln(2);
		$pdf->SetFont('Arial', '', 12);	
		$pdf->Cell(0,8,"Employee Name:".$e->lname.', '.$e->fname.' '.$e->mname ,'',1,'L',false);
		
		$pdf->Ln(4);
		
		$pdf->Cell(0,8,"Date From Date To   Position                               Department                        Movement Status   Status" ,'1',1,'L',false);
		
		$pdf->Ln(4);
		
		$work = new Work();
		
		$work->where('govt_service', '1'); 
		$work->order_by('inclusive_date_from', 'DESC');
		 
		$works = $work->get_by_employee_id($employee_id);
		
		
		$i = 1;
		
		$this->load->helper('text');
		
		 foreach($works as $work)
		 {
			$pdf->SetFont('Arial', '', 8);
			$pdf->SetX(10);
			
			list($year, $month, $day) = explode('-', $work->inclusive_date_from);
			
			$inclusive_date_from = $month.'/'.$day.'/'.$year;
			
			$pdf->Write(0, $inclusive_date_from);
			
			list($year, $month, $day) = explode('-', $work->inclusive_date_to);
			
			$inclusive_date_to = $month.'/'.$day.'/'.$year;
			
			if ($work->inclusive_date_to == 'Present')
			{
				$inclusive_date_to = 'Present';
			}
			
			$pdf->SetX(29);
			$pdf->Write(0, $inclusive_date_to);
			
			
			$pdf->SetFont('Arial', '', 8);
			$pdf->SetX(50);
			$pdf->Write(0, str_replace('&#8230;', '..', character_limiter($work->position, 35)));
			
			$pdf->SetX(100);
			//$pdf->Write(0, $work->company);
			$pdf->Write(0, str_replace('&#8230;', '..', character_limiter($work->company, 35)));
			
			//$pdf->SetFont('Arial', '', 12);
			$pdf->SetX(160);
			$pdf->Write(0, $work->movement);
			
			//$pdf->SetX(150);
			//$pdf->Write(0, $work->salary_grade);
			
			$pdf->SetFont('Arial', '', 8);
			$pdf->SetX(185);
			$pdf->Write(0, $work->status);
			
			$work->govt_service = ($work->govt_service == 1) ? 'Yes' : 'No';
			
			$pdf->SetX(190);
			//$pdf->Write(0, $work->govt_service);			
			  	    	 
			$pdf->SetFont('Arial', '', 12);	
			
			
			if ($i == 6 || $i == 10  || $i == 13 || $i == 16 || $i == 19 || $i == 22)
			{
				$pdf->Ln(8);
			}
			else
			{
				$pdf->Ln(7);
			}
			
			$i++;
			
		 }
		 
		 $pdf->Cell(0,8,"--------------------------------------------------------- Nothing Follows ---------------------------------------------------------" ,'',1,'C',false);
		
		// Signatories
		$pdf->Ln(15);
		$pdf->SetX(20);
		
		$pdf->Cell(90,5,"PREPARED BY:",			'0',	0,'C',false);
		$pdf->Cell(90,5,"CERTIFIED CORRECT:",	'0',	1,'C',false);
		
		$pdf->Ln(10);
		 
		$sr_prepared 			= Setting::getField( 'sr_prepared' );
		$sr_prepared_position 	= Setting::getField( 'sr_prepared_position' );
		$sr_certified 			= Setting::getField( 'sr_certified' );
		$sr_certified_position 	= Setting::getField( 'sr_certified_position' );
		
		$pdf->SetX(20);
		
		$pdf->Cell(90,5, $sr_prepared,			'0',	0,'C',false); //4th param border
		$pdf->Cell(90,5, $sr_certified,			'0',	1,'C',false);
		
		$pdf->SetX(20);
		
		$pdf->Cell(90,5, $sr_prepared_position,	'0',	0,'C',false);
		$pdf->Cell(90,5, $sr_certified_position,	'0',	1,'C',false);		
		
		// Output
		$pdf->Output('dtr/template/service_record/archives/service_record_'.$employee_id.'.pdf', 'I'); 
		
		
	}
	
	
}
?>