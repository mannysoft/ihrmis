<?php
/**
 * Integrated Human Resource Management Information System 3.0dev
 *
 * An Open Source Application Software use by Government agencies for  
 * management of employees Attendance, Leave Administration, Payroll, 
 * Personnel Training, Service Records, Performance, Recruitment,
 * Personnel Schedule(Plantilla) and more...
 *
 * @package		iHRMIS
 * @author		Manny Isles
 * @copyright	Copyright (c) 2008 - 2014, Isles Technologies
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
class Search_result_preview extends MX_Controller
{
	var $pds = array();
	
	function __construct()
    {
        parent::__construct();
    }
	
	function preview( $rows , $report_name = '' )
	{
		$html = '
		
		<table width="100%" border="0">
	  <tr>
		<td colspan="3" align="center">'.$report_name.'</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	</table>
			
	<table width="100%" border="1">
	<tbody><tr>
	  <td width="10%"><strong>Employee ID</strong></td>
	  <td width="9%"><strong>Name</strong></td>
	  <td width="4%"><strong>Sex</strong></td>
	  <td width="10%"><strong>Position/<br />
		Designation</strong></td>
	  <td width="13%"><strong>Office / Department</strong></td>
	  <td width="11%"><strong>Employment Status</strong></td>
	  <td width="6%"><strong>Salary Grade</strong></td>
	  <td width="9%"><strong>Eligibility</strong></td>
	  <td width="11%"><strong>Education</strong></td>
	  <td width="8%"><strong>Birthday</strong></td>
	  <td width="9%"><strong>Address</strong></td></tr>';
		
		$params = array('format' => 'Letter-L');
		
		$this->load->library('mpdf', $params);
		// LOAD a stylesheet
		$stylesheet = file_get_contents(base_url().'css/mpdf/mpdfstyletables.css');
		$this->mpdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
		$this->mpdf->WriteHTML($html);
		
		
		$office = new Office_m();
		
		foreach($rows as $row)
		{
			$office->get_by_office_id($row->office_id);
			$type_employment = $this->options->type_employment();
			
			$birth_date = $row->birth_date;
			
			if ( $row->birth_date == '0000-00-00')
			{
				$birth_date = '';
			}
			
			$entry='
			<tr>
				<td>'.$row->employee_id.'</td>
				 <td>'.$row->lname.','. $row->fname.' '.$row->mname.'</td>
				 <td>'.$row->sex.'</td>
				 <td>'.$row->position.'</td>
				 <td>'.$office->office_name.'</td>
				 <td>'.$type_employment[$row->permanent].'</td>
				 <td>'.$row->salary_grade.'/'.$row->step.'</td>
				 <td>'.$row->eligibility.'</td>
				 <td>'.$row->education.'</td>
				 <td>'.$birth_date.'</td>
				 <td>'.$row->res_address.'</td>
			</tr>';
			
			$this->mpdf->WriteHTML($entry);
		}
		
		
		
	$signatories='
	<tr><td><p>&nbsp;</p></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td><td>&nbsp;</td></tr>
	</tbody></table>';


	// Signatories
	$sr_prepared 			= Setting::getField( 'sr_prepared' );
	$sr_prepared_position 	= Setting::getField( 'sr_prepared_position' );
	$sr_certified 			= Setting::getField( 'sr_certified' );
	$sr_certified_position 	= Setting::getField( 'sr_certified_position' );

	$signatories.='
	<table width="100%" border="0">
	  <tr>
		<td width="38%">&nbsp;</td>
		<td width="23%">&nbsp;</td>
		<td width="39%">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="center">PREPARED BY:</td>
		<td>&nbsp;</td>
		<td align="center">CERTIFIED CORRECT:</td>
	  </tr>
	  <tr>
		<td align="center">&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="center">&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="center">'.$sr_prepared.'</td>
		<td>&nbsp;</td>
		<td align="center">'.$sr_certified.'</td>
	  </tr>
	  <tr>
		<td align="center">'.$sr_prepared_position.'</td>
		<td>&nbsp;</td>
		<td align="center">'.$sr_certified_position.'</td>
	  </tr>
	</table>
	';
	
		$this->mpdf->WriteHTML($signatories);
		
		$this->mpdf->Output('dtr/template/pds/archives/pds_'.date('Y_m_d').'.pdf', 'F');
		return 'dtr/template/pds/archives/pds_'.date('Y_m_d').'.pdf';
		exit;
		
		
		
		$this->load->helper('settings');
		
		$this->load->library('fpdf');
		
		//define('FPDF_FONTPATH',$this->config->item('fonts_path'));
					
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('L','mm','Letter');
		
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
		
		$pdf->Cell(0,3,"Report Name" ,'',1,'C',false);
		
		//$pdf->Ln(4);
		
		//$e = new Employee_m();
		
		//$e->get_by_employee_id( $employee_id ); 
		
		$pdf->SetFont('Arial', '', 12);	
		//$pdf->Cell(0,8,"Employee No.:".$e->id ,'',1,'L',false);
		//$pdf->Ln(2);
		//$pdf->SetFont('Arial', '', 12);	
		//$pdf->Cell(0,8,"Employee Name:".$e->lname.', '.$e->fname.' '.$e->mname ,'',1,'L',false);
		
		
		
		$pdf->Ln(4);
		
		$pdf->Cell(0,8,"Emp ID    Name                  Sex     Position/Designation    Office    Employment Status     Salary Grade Eligibility Education Birth Day   Address" ,'1',1,'L',false);
		
		$pdf->Ln(4);
		
		$i = 1;
		
		$this->load->helper('text');
		
		//$pdf->Cell(30,12, word_wrap('msayado maahhn ndhah ahhhehe so ano gagawin mo now', 10) ,'1',1,'L',false);
		//$pdf->MultiCell(30,3,word_wrap("hello this is a sample nlong text with line break ", 15) ,'1',1,'L',false);
		//$pdf->MultiCell(30,3,word_wrap("hello this is a sample nlong text with line break ", 15) ,'0',1,'L',false);
		
		 foreach($rows as $row)
		 {
			$pdf->SetFont('Arial', '', 11);
			$pdf->SetX(10);
			
			//$pdf->Write(0, $row->id);
			$pdf->Cell(15,12, $row->id ,'1',0,'L',false);
			
			
			$pdf->SetX(29);
			//$pdf->Write(0, $row->lname.', '.$row->fname.''.$row->mname);
			$pdf->Cell(30,12, word_wrap($row->lname.', '.$row->fname.''.$row->mname, 10) ,'1',1,'L',false);
			
			
			$pdf->SetFont('Arial', '', 8);
			$pdf->SetX(62);
			$pdf->Write(0, $row->sex);
			
			$pdf->SetX(75);
			//$pdf->Write(0, $row->company);
			$pdf->Write(0, $row->position);
			
			//$pdf->SetFont('Arial', '', 12);
			$pdf->SetX(160);
			$pdf->Write(0, $row->movement);
			
			//$pdf->SetX(150);
			//$pdf->Write(0, $row->salary_grade);
			
			$pdf->SetFont('Arial', '', 8);
			$pdf->SetX(185);
			//$pdf->Write(0, $row->status);
			
			if ($row->govt_service == 1)
			{
				$row->govt_service = 'Yes';
			}
			else
			{
				$row->govt_service = 'No';
			}
			
			$pdf->SetX(190);
			//$pdf->Write(0, $row->govt_service);			
			  	    	 
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
		$pdf->Output('dtr/template/pds/archives/pds_'.date('Y_m_d').'.pdf', 'F');
		
		return 'dtr/template/pds/archives/pds_'.date('Y_m_d').'.pdf';
		
		
	}
}
?>