<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
class Pds_preview extends MX_Controller
{
	var $pds = array();
	
	function __construct()
    {
        parent::__construct();
    }
	
	function page1($employee_id)
	{
		
		$this->load->helper('settings');
		
		$this->load->library('fpdf');
		
		//define('FPDF_FONTPATH',$this->config->item('fonts_path'));
					
		$this->load->library('fpdi');
		
		//$this->load->model('Personal_Info');
		
		//Get personal info
		//$pi = $this->Personal_Info->get_personal_info($employee_id);
		$pi = new Personal();
		$pi->get_by_employee_id( $employee_id );
		
		//print_r($personal_info);	
		// initiate FPDI   
		$pdf = new FPDI('P','mm','Legal');
		
		// add a page
		$pdf->AddPage();
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/pds/page1.pdf');
		// import page 1
		$tplIdx = $pdf->importPage(1);
		// use the imported page and place it at point 10,10 with a width of 100 mm
		$pdf->useTemplate($tplIdx, 1, 1, 210);
		// now write some text above the imported page
		$pdf->SetFont('Arial');
		$pdf->SetTextColor(0,0,0);
		
		/*******************************
		 *START PERSONAL INFORMATION ==
		 ******************************/
		
		$split[0] = '';
		$split[1] = '';
		$split[2] = '';
		$split[3] = '';
		$split[4] = '';
		$split[5] = '';
		$split[6] = '';
		$split[7] = '';
		$split[8] = '';
		$split[9] = '';
		$split[10] = '';
		$split[11] = '';
		$split[12] = '';
		$split[13] = '';
		$split[14] = '';
		$split[15] = '';
		$split[16] = '';
		$split[17] = '';
		$split[18] = '';
		$split[19] = '';
		$split[20] = '';
		$split[21] = '';
		$split[22] = '';
		$split[23] = '';
		$split[24] = '';
		$split[25] = '';
		$split[26] = '';
		$split[27] = '';
		$split[28] = '';
		$split[29] = '';
		
		//$pdf->MultiCell(0,3,"hello this is a sample \nlong text with line break" ,'',1,'L',false);
		//$pdf->MultiCell(0,3,"hello this is a sample \nlong text with line break" ,'',1,'L',false);
		//$pdf->MultiCell(0,3,"hello this is a sample \nlong text with line break" ,'',1,'L',false);
		
		$this->load->helper('text');
		
		//$pdf->MultiCell(0,3,word_wrap("hello this is a sample nlong text with line break", 15) ,'',1,'L',false);
		
		$split = str_split($pi->lname);
		
		// Write something ==LAST NAME =========
		$pdf->SetXY(39, 53);
		$pdf->Write(0, $split[0]);
		$pdf->SetX(44);
		$pdf->Write(0, $split[1]);
		$pdf->SetX(49);
		$pdf->Write(0, $split[2]);
		$pdf->SetX(54);
		$pdf->Write(0, $split[3]);
		$pdf->SetX(60);
		$pdf->Write(0, $split[4]);
		$pdf->SetX(65);
		$pdf->Write(0, $split[5]);
		$pdf->SetX(70);
		$pdf->Write(0, $split[6]);
		$pdf->SetX(75);
		$pdf->Write(0, $split[7]);
		$pdf->SetX(81);
		$pdf->Write(0, $split[8]);
		$pdf->SetX(86);
		$pdf->Write(0, $split[9]);
		$pdf->SetX(91);
		$pdf->Write(0, $split[10]);
		$pdf->SetX(96);
		$pdf->Write(0, $split[11]);
		$pdf->SetX(101);
		$pdf->Write(0, $split[12]);
		$pdf->SetX(106);
		$pdf->Write(0, $split[13]);
		$pdf->SetX(111);
		$pdf->Write(0, $split[14]);
		$pdf->SetX(116);
		$pdf->Write(0, $split[15]);
		$pdf->SetX(121);
		$pdf->Write(0, $split[16]);
		$pdf->SetX(126);
		$pdf->Write(0, $split[17]);
		$pdf->SetX(131);
		$pdf->Write(0, $split[18]);
		$pdf->SetX(137);
		$pdf->Write(0, $split[19]);
		$pdf->SetX(142);
		$pdf->Write(0, $split[20]);
		$pdf->SetX(147);
		$pdf->Write(0, $split[21]);
		$pdf->SetX(152);
		$pdf->Write(0, $split[22]);
		$pdf->SetX(157);
		$pdf->Write(0, $split[23]);
		$pdf->SetX(163);
		$pdf->Write(0, $split[24]);
		$pdf->SetX(168);
		$pdf->Write(0, $split[25]);
		$pdf->SetX(173);
		$pdf->Write(0, $split[26]);
		$pdf->SetX(178);
		$pdf->Write(0, $split[27]);
		$pdf->SetX(183);
		$pdf->Write(0, $split[28]);
		$pdf->SetX(188);
		$pdf->Write(0, $split[29]);
		// line break
		
		//=========FIRST NAME==== 
		$split = str_split($pi->fname);
		
		$pdf->Ln(6);
		$pdf->SetX(39);
		$pdf->Write(0, $split[0]);
		$pdf->SetX(44);
		$pdf->Write(0, $split[1]);
		$pdf->SetX(49);
		$pdf->Write(0, $split[2]);
		$pdf->SetX(54);
		$pdf->Write(0, $split[3]);
		$pdf->SetX(60);
		$pdf->Write(0, $split[4]);
		$pdf->SetX(65);
		$pdf->Write(0, $split[5]);
		$pdf->SetX(70);
		$pdf->Write(0, $split[6]);
		$pdf->SetX(75);
		$pdf->Write(0, $split[7]);
		$pdf->SetX(81);
		$pdf->Write(0, $split[8]);
		$pdf->SetX(86);
		$pdf->Write(0, $split[9]);
		$pdf->SetX(91);
		$pdf->Write(0, $split[10]);
		$pdf->SetX(96);
		$pdf->Write(0, $split[11]);
		$pdf->SetX(101);
		$pdf->Write(0, $split[12]);
		$pdf->SetX(106);
		$pdf->Write(0, $split[13]);
		$pdf->SetX(111);
		$pdf->Write(0, $split[14]);
		$pdf->SetX(116);
		$pdf->Write(0, $split[15]);
		$pdf->SetX(121);
		$pdf->Write(0, $split[16]);
		$pdf->SetX(126);
		$pdf->Write(0, $split[17]);
		$pdf->SetX(131);
		$pdf->Write(0, $split[18]);
		$pdf->SetX(137);
		$pdf->Write(0, $split[19]);
		$pdf->SetX(142);
		$pdf->Write(0, $split[20]);
		$pdf->SetX(147);
		$pdf->Write(0, $split[21]);
		$pdf->SetX(152);
		$pdf->Write(0, $split[22]);
		$pdf->SetX(157);
		$pdf->Write(0, $split[23]);
		$pdf->SetX(163);
		$pdf->Write(0, $split[24]);
		$pdf->SetX(168);
		$pdf->Write(0, $split[25]);
		$pdf->SetX(173);
		$pdf->Write(0, $split[26]);
		$pdf->SetX(178);
		$pdf->Write(0, $split[27]);
		$pdf->SetX(183);
		$pdf->Write(0, $split[28]);
		$pdf->SetX(188);
		$pdf->Write(0, $split[29]);
		
		
		//======== MNAME
		$split = str_split($pi->mname);
		// line break
		$pdf->Ln(6);
		$pdf->SetX(39);
		$pdf->Write(0, $split[0]);
		$pdf->SetX(44);
		$pdf->Write(0, $split[1]);
		$pdf->SetX(49);
		$pdf->Write(0, $split[2]);
		$pdf->SetX(54);
		$pdf->Write(0, $split[3]);
		$pdf->SetX(60);
		$pdf->Write(0, $split[4]);
		$pdf->SetX(65);
		$pdf->Write(0, $split[5]);
		$pdf->SetX(70);
		$pdf->Write(0, $split[6]);
		$pdf->SetX(75);
		$pdf->Write(0, $split[7]);
		$pdf->SetX(81);
		$pdf->Write(0, $split[8]);
		$pdf->SetX(86);
		$pdf->Write(0, $split[9]);
		$pdf->SetX(91);
		$pdf->Write(0, $split[10]);
		$pdf->SetX(96);
		$pdf->Write(0, $split[11]);
		$pdf->SetX(101);
		$pdf->Write(0, $split[12]);
		$pdf->SetX(106);
		$pdf->Write(0, $split[13]);
		$pdf->SetX(111);
		$pdf->Write(0, $split[14]);
		$pdf->SetX(116);
		$pdf->Write(0, $split[15]);
		$pdf->SetX(121);
		$pdf->Write(0, $split[16]);
		$pdf->SetX(126);
		$pdf->Write(0, $split[17]);
		$pdf->SetX(131);
		$pdf->Write(0, $split[18]);
		$pdf->SetX(137);
		$pdf->Write(0, $split[19]);
		$pdf->SetX(142);
		$pdf->Write(0, $split[20]);
		$pdf->SetX(147);
		$pdf->Write(0, $split[21]);
		$pdf->SetX(152);
		$pdf->Write(0, $split[22]);
		$pdf->SetX(157);
		$pdf->Write(0, $split[23]);
		$pdf->SetX(163);
		$pdf->Write(0, $split[24]);
		$pdf->SetX(168);
		$pdf->Write(0, $split[25]);
		$pdf->SetX(173);
		$pdf->Write(0, $split[26]);
		$pdf->SetX(178);
		$pdf->Write(0, $split[27]);
		$pdf->SetX(183);
		$pdf->Write(0, $split[28]);
		$pdf->SetX(188);
		$pdf->Write(0, $split[29]);
		
		$pdf->SetX(189);
		$pdf->Write(0, $pi->extension);
		
		$date = $pi->birth_date;
		
		list($year, $month, $day) = explode('-', $date);
		$pdf->Ln(6);
		$pdf->SetX(67);
		$pdf->Write(0, $month.'-'.$day.'-'.$year);
		
		$res_address = splitstroverflow($pi->res_address, 30);
		
		$pdf->SetX(126);
		$pdf->Write(0, $res_address[0]);
		
		$pdf->Ln(4);
		$pdf->SetX(39);
		$pdf->Write(0, $pi->birth_place);
		
		$pdf->SetX(126);
		$pdf->Write(0, $res_address[1]);
		
		
		$pdf->Ln(5);
		
		if ($pi->sex == 'M')
		{
			$setx = 41.5;
		}
		
		if ($pi->sex == 'F')
		{
			$setx = 58;
		}
		$pdf->SetX($setx);
		$pdf->Write(0, 'X');
				
		if ($pi->civil_status == 1)
		{
			$pdf->SetXY(41.5, 85);
			$pdf->Write(0, 'X');
		}
		
		if ($pi->civil_status == 2)
		{
			$pdf->SetXY(41.5, 89);
			$pdf->Write(0, 'X');
		}
		if ($pi->civil_status == 3)
		{
			$pdf->SetXY(41.5, 94.5);
			$pdf->Write(0, 'X');
		}
		
		if ($pi->civil_status == 4)
		{
			$pdf->SetXY(64, 85);
			$pdf->Write(0, 'X');
		}
		
		if ($pi->civil_status == 5)
		{
			$pdf->SetXY(64, 89);
			$pdf->Write(0, 'X');
		}
		
		if ($pi->civil_status == 6)
		{
			$pdf->SetXY(64, 94.5);
			$pdf->Write(0, 'X');
		}
		
		//citizeship
		$pdf->SetXY(39, 103);
		$pdf->Write(0, $pi->citizenship);
		
		$pdf->Ln(5.2);
		$pdf->SetX(39);
		$pdf->Write(0, $pi->height);
		
		$pdf->Ln(5.2);
		$pdf->SetX(39);
		$pdf->Write(0, $pi->weight);
		
		$pdf->Ln(5.2);
		$pdf->SetX(39);
		$pdf->Write(0, $pi->blood_type);
		
		$pdf->Ln(4);
		$pdf->SetX(39);
		$pdf->Write(0, $pi->gsis);
		
		$pdf->Ln(5);
		$pdf->SetX(39);
		$pdf->Write(0, $pi->pagibig);
		
		$pdf->Ln(4);
		$pdf->SetX(39);
		$pdf->Write(0, $pi->philhealth);
		
		$pdf->Ln(5);
		$pdf->SetX(39);
		$pdf->Write(0, $pi->sss);
		
		$pdf->SetXY(126, 85);
		$pdf->Write(0, $pi->res_zip);
		
		$pdf->Ln(5);
		$pdf->SetX(126);
		$pdf->Write(0, $pi->res_tel);
		
		$pdf->Ln(5);
		$pdf->SetX(126);
		$permanent_address = splitstroverflow($pi->permanent_address, 30);
		$pdf->Write(0, $permanent_address[0]);
		
		$pdf->Ln(4);
		$pdf->SetX(126);
		$pdf->Write(0, $permanent_address[1]);
		

		$pdf->Ln(15);
		$pdf->SetX(126);
		$pdf->Write(0, $pi->permanent_zip);
		
		$pdf->Ln(4);
		$pdf->SetX(126);
		$pdf->Write(0, $pi->permanent_tel);
		
		$pdf->Ln(4.3);
		$pdf->SetX(126);
		$pdf->Write(0, $pi->email);
		
		$pdf->Ln(4.9);
		$pdf->SetX(126);
		$pdf->Write(0, $pi->cp);
		
		$pdf->Ln(4.3);
		$pdf->SetX(126);
		$pdf->Write(0, $pi->agency_employee_no);
		
		$pdf->Ln(4.3);
		$pdf->SetX(126);
		$pdf->Write(0, $pi->tin);
		
		
		/*******************************
		 *END PERSONAL INFORMATION =====
		 ******************************/
		 
		 //======================================================================
		 
		 /*******************************
		 *START FAMILY BACK GROUND=======
		 ******************************/
		
		//Get family background 
		//$fb = $this->Family_Background->get_family_background($employee_id);
		$fb = new Family();
		$fb->get_by_employee_id($employee_id);
		
		$pdf->SetXY(39, 146);
		$pdf->Write(0, $fb->spouse_lname);
		
		$pdf->Ln(4.3);
		$pdf->SetX(39);
		$pdf->Write(0, $fb->spouse_fname);
		
		$pdf->Ln(4.3);
		$pdf->SetX(39);
		$pdf->Write(0, $fb->spouse_mname);
		
		$pdf->Ln(5);
		$pdf->SetX(39);
		$pdf->Write(0, $fb->spouse_occupation);
		
		$pdf->Ln(5);
		$pdf->SetX(39);
		$pdf->Write(0, $fb->spouse_employer);
		
		$pdf->Ln(5);
		$pdf->SetX(39);
		$pdf->Write(0, $fb->spouse_biz_ad);
		
		$pdf->Ln(5);
		$pdf->SetX(39);
		$pdf->Write(0, $fb->spouse_tel);
		
		$pdf->Ln(9);
		$pdf->SetX(57);
		$pdf->Write(0, $fb->father_lname);
		
		$pdf->Ln(4.5);
		$pdf->SetX(57);
		$pdf->Write(0, $fb->father_fname);
		
		$pdf->Ln(4.5);
		$pdf->SetX(57);
		$pdf->Write(0, $fb->father_mname);
		
		$pdf->Ln(4.5);
		$pdf->SetX(57);
		$pdf->Write(0, $fb->mother_lname);
		
		$pdf->Ln(4.5);
		$pdf->SetX(57);
		$pdf->Write(0, $fb->mother_fname);
		
		$pdf->Ln(4.5);
		$pdf->SetX(57);
		$pdf->Write(0, $fb->mother_mname);
		
		/*******************************
		 *END FAMILY BACK GROUND=======
		 ******************************/
		 
		 //=============================================================================
		 
		 /*******************************
		 *START CHILDREN================
		 ******************************/
		 
		//$children = $this->Children->get_child($employee_id);
		
		$children = new Children();
		
		$children->order_by('birth_date');
		
		$children->get_by_employee_id($employee_id);
		
		$pdf->SetXY(110, 145);
		
		$i = 1;
		
		 $pdf->SetFont('Arial', '', 10);	
		
		foreach ($children as $child)
		{
			if ($i == 7 || $i == 9 || $i == 11)
			{
				$pdf->Ln(4.5);
			}
			else
			{
				$pdf->Ln(5);
			}
			
			
			
			$pdf->SetX(110);
			$pdf->Write(0, $child->children);
			
			$date = $child->birth_date;
			list($year, $month, $day) = explode('-', $date);
			$pdf->SetX(170);
			$pdf->Write(0, $month.'/'.$day.'/'.$year);
			
			$i ++;
		}
		
		
		 /*******************************
		 *END CHILDREN==================
		 ******************************/
		 
		 //=====================================================================
		 
		  /*******************************
		   *START EDUC==================
		   ******************************/
		 
		 $e = new Education();
		 
		 //$educs = $this->Educational_Background->get_educ($employee_id, $level = 1);
		 $educs = $e->get_single_educ($employee_id, $level = 1);
		 $pdf->SetFont('Arial', '', 10);		
		 $pdf->SetXY(39, 233);
		// 
		/*******************************
		 *END EDUC==================
		 ******************************/  
		 foreach($educs as $educ)
		 {
			
			
			$sch = wordwrap(ucwords(strtolower($educ->school_name)), 23, "|");
			$sch = explode("|", $sch);
			
			//$degree = wordwrap($educ->degree_course, 15, "|");
			$degree = wordwrap(ucwords(strtolower($educ->degree_course)), 15, "|");
			$degree = explode("|", $degree);
			
			$pdf->Write(0, $sch[0]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[0]);
			$pdf->SetX(107);
			$pdf->Write(0, $educ->year_graduated);
			$pdf->SetX(130);
			$pdf->Write(0, $educ->highest_grade);
			$pdf->SetX(150);
			$pdf->Write(0, $educ->attend_from);
			$pdf->SetX(163);
			$pdf->Write(0, $educ->attend_to);
			$pdf->SetX(177);
			$pdf->Write(0, $educ->scholarship);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[1]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[1]);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[2]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[2]);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[3]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[3]);
		 }
		 
		 //secondary
		// $educs = $this->Educational_Background->get_educ($employee_id, $level = 2);
		 $educs = $e->get_single_educ($employee_id, $level = 2);
		 $pdf->SetXY(39, 246);
		 foreach($educs as $educ)
		 {
			//$sch = wordwrap($educ->school_name, 23, "|");
			$sch = wordwrap(ucwords(strtolower($educ->school_name)), 23, "|");
			$sch = explode("|", $sch);
			
			//$degree = wordwrap($educ->degree_course, 15, "|");
			$degree = wordwrap(ucwords(strtolower($educ->degree_course)), 15, "|");
			$degree = explode("|", $degree);
			
			$pdf->Write(0, $sch[0]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[0]);
			$pdf->SetX(107);
			$pdf->Write(0, $educ->year_graduated);
			$pdf->SetX(130);
			$pdf->Write(0, $educ->highest_grade);
			$pdf->SetX(150);
			$pdf->Write(0, $educ->attend_from);
			$pdf->SetX(163);
			$pdf->Write(0, $educ->attend_to);
			$pdf->SetX(177);
			$pdf->Write(0, $educ->scholarship);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[1]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[1]);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[2]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[2]);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[3]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[3]);
		 }
		 
		 //vocational
		// $educs = $this->Educational_Background->get_educ($employee_id, $level = 3);
		 $educs = $e->get_single_educ($employee_id, $level = 3);
		 $pdf->SetXY(39, 259);
		 foreach($educs as $educ)
		 {
			//$sch = wordwrap($educ->school_name, 23, "|");
			$sch = wordwrap(ucwords(strtolower($educ->school_name)), 23, "|");
			$sch = explode("|", $sch);
			
			//$degree = wordwrap($educ->degree_course, 15, "|");
			$degree = wordwrap(ucwords(strtolower($educ->degree_course)), 15, "|");
			$degree = explode("|", $degree);
			
			$pdf->Write(0, $sch[0]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[0]);
			$pdf->SetX(107);
			$pdf->Write(0, $educ->year_graduated);
			$pdf->SetX(130);
			$pdf->Write(0, $educ->highest_grade);
			$pdf->SetX(150);
			$pdf->Write(0, $educ->attend_from);
			$pdf->SetX(163);
			$pdf->Write(0, $educ->attend_to);
			$pdf->SetX(177);
			$pdf->Write(0, $educ->scholarship);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[1]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[1]);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[2]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[2]);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[3]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[3]);
		 }
		 
		 //college
		// $educs = $this->Educational_Background->get_educ($employee_id, $level = 4);
		 $educs = $e->get_single_educ($employee_id, $level = 4);
		 $pdf->SetXY(39, 274);
		 foreach($educs as $educ)
		 {
			//$sch = wordwrap($educ->school_name, 23, "|");
			$sch = wordwrap(ucwords(strtolower($educ->school_name)), 23, "|");
			$sch = explode("|", $sch);
			
			//$degree = wordwrap($educ->degree_course, 15, "|");
			$degree = wordwrap(ucwords(strtolower($educ->degree_course)), 15, "|");
			$degree = explode("|", $degree);
			
			$pdf->Write(0, $sch[0]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[0]);
			$pdf->SetX(107);
			$pdf->Write(0, $educ->year_graduated);
			$pdf->SetX(130);
			$pdf->Write(0, $educ->highest_grade);
			$pdf->SetX(150);
			$pdf->Write(0, $educ->attend_from);
			$pdf->SetX(163);
			$pdf->Write(0, $educ->attend_to);
			$pdf->SetX(177);
			$pdf->Write(0, $educ->scholarship);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[1]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[1]);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[2]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[2]);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[3]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[3]);
		 }
		 
		 //graduate studies
		 //$educs = $this->Educational_Background->get_educ($employee_id, $level = 5);
		 $educs = $e->get_single_educ($employee_id, $level = 5);
		 $pdf->SetXY(39, 290);
		 foreach($educs as $educ)
		 {
			//$sch = wordwrap($educ->school_name, 23, "|");
			$sch = wordwrap(ucwords(strtolower($educ->school_name)), 23, "|");
			$sch = explode("|", $sch);
			
			//$degree = wordwrap($educ->degree_course, 15, "|");
			$degree = wordwrap(ucwords(strtolower($educ->degree_course)), 15, "|");
			$degree = explode("|", $degree);
			
			$pdf->Write(0, $sch[0]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[0]);
			$pdf->SetX(107);
			$pdf->Write(0, $educ->year_graduated);
			$pdf->SetX(130);
			$pdf->Write(0, $educ->highest_grade);
			$pdf->SetX(150);
			$pdf->Write(0, $educ->attend_from);
			$pdf->SetX(163);
			$pdf->Write(0, $educ->attend_to);
			$pdf->SetX(177);
			$pdf->Write(0, $educ->scholarship);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[1]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[1]);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[2]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[2]);
			
			$pdf->Ln(3);
			$pdf->SetX(39);
			$pdf->Write(0, $sch[3]);
			$pdf->SetX(78);
			$pdf->Write(0, $degree[3]);
		 }
		
		// Output
		//$pdf->Output('resources/pdfs/archives/page1_'.$employee_id.'.pdf', 'F'); 
		$pdf->Output('dtr/template/pds/page1_'.$employee_id.'.pdf', 'F'); 
		$this->pds[] = 'dtr/template/pds/page1_'.$employee_id.'.pdf';
		//$this->pds[] = 'resources/pdfs/archives/page1_'.$employee_id.'.pdf';
		//header("location:".base_url()."resources/pdfs/archives/page1_".$employee_id.'.pdf');
		
	}
	
	function page2($employee_id)
	{
		
		$this->load->helper('settings');
		
		$this->load->library('fpdf');
							
		$this->load->library('fpdi');
		
		// initiate FPDI   
		$pdf = new FPDI('P','mm','Legal');
		
		// add a page
		$pdf->AddPage();
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/pds/page2.pdf');
		// import page 1
		$tplIdx = $pdf->importPage(1);
		// use the imported page and place it at point 10,10 with a width of 100 mm
		$pdf->useTemplate($tplIdx, 1, 1, 210);
		// now write some text above the imported page
		$pdf->SetFont('Arial');
		$pdf->SetTextColor(0,0,0);
		
		
		$pdf->SetXY(8, 32);
		
		$e = new Eligibility();
		
		//$eligs = $this->Eligibility->get_eligibility($employee_id);
		$eligs = $e->get_by_employee_id($employee_id);
		
		
		
		$i = 1;
		
		$this->load->helper('text');
		
		 foreach($eligs as $elig)
		 {
			$pdf->SetFont('Arial', '', 7);
			
			$pdf->SetX(8);
			//$pdf->Write(0, character_limiter($elig->type, 20));
			$pdf->Write(0, str_replace('&#8230;', '..', character_limiter($elig->type, 25)));
			//$pdf->MultiCell(51,3,word_wrap($elig->type, 30) ,'',1,'L',true);
			
			$pdf->SetX(58);
			$pdf->Write(0, $elig->rating);
			
			
			$pdf->SetX(75);
			$pdf->Write(0, $elig->date_exam_conferment);
			
			$pdf->SetX(98);
			$pdf->Write(0, $elig->place_exam_conferment);
			
			$pdf->SetX(167);
			$pdf->Write(0, $elig->license_no);
			
			$pdf->SetFont('Arial', '', 8);	
			$pdf->SetX(188);
			$pdf->Write(0, $elig->license_release_date);
			
			  	    	 
			$pdf->SetFont('Arial', '', 12);	
			
			
			if ($i == 2 || $i == 6)
			{
				$pdf->Ln(8);
			}
			else
			{
				$pdf->Ln(7);
			}
			
			$i++;
			
		 }
		 
		 
		 
		 //work ===================================================================================================
		 $pdf->SetXY(8, 115);
		 
		 $work = new Work();
		 
		// $work->limit(25);
		 $work->order_by('inclusive_date_from', 'DESC');
		 
		 $works = $work->get_by_employee_id($employee_id);
		
		
		$i = 1;
		
		$this->load->helper('text');
		
		 foreach($works as $work)
		 {
			$pdf->SetFont('Arial', '', 8);
			$pdf->SetX(7);
			
			list($year, $month, $day) = explode('-', $work->inclusive_date_from);
			
			$inclusive_date_from = $month.'/'.$day.'/'.$year;
			
			$pdf->Write(0, $inclusive_date_from);
			
			list($year, $month, $day) = explode('-', $work->inclusive_date_to);
			
			$inclusive_date_to = $month.'/'.$day.'/'.$year;
			
			if ($work->inclusive_date_to == 'Present')
			{
				$inclusive_date_to = 'Present';
			}
			
			$pdf->SetX(22);
			$pdf->Write(0, $inclusive_date_to);
			
			
			$pdf->SetFont('Arial', '', 8);
			$pdf->SetX(39);
			$pdf->Write(0, str_replace('&#8230;', '..', character_limiter($work->position, 20)));
			
			$pdf->SetX(75);
			//$pdf->Write(0, $work->company);
			$pdf->Write(0, str_replace('&#8230;', '..', character_limiter($work->company, 35)));
			
			//$pdf->SetFont('Arial', '', 12);
			$pdf->SetX(132);
			$pdf->Write(0, $work->monthly_salary);
			
			$pdf->SetX(150);
			$pdf->Write(0, $work->salary_grade);
			
			$pdf->SetFont('Arial', '', 8);
			$pdf->SetX(166);
			$pdf->Write(0, $work->status);
			
			if ($work->govt_service == 1)
			{
				$work->govt_service = 'Yes';
			}
			else
			{
				$work->govt_service = 'No';
			}
			
			$pdf->SetX(190);
			$pdf->Write(0, $work->govt_service);			
			  	    	 
			$pdf->SetFont('Arial', '', 12);	
			
			
			if ($i == 6 || $i == 10  || $i == 13 || $i == 16 || $i == 19 || $i == 22)
			{
				$pdf->Ln(8);
			}
			else
			{
				$pdf->Ln(7);
			}
			
			if ( $i == 25)
			{
				//break;
				$pdf->AddPage();
			}
			
			$i++;
			
		 }
		 
		
		// Output
		$pdf->Output('dtr/template/pds/page2_'.$employee_id.'.pdf', 'F'); 
		//header("location:".base_url()."resources/pdfs/archives/page2_".$employee_id.'.pdf');
		$this->pds[] = 'dtr/template/pds/page2_'.$employee_id.'.pdf';
		
	}
	
	function page3($employee_id)
	{
		
		$this->load->helper('settings');
		
		$this->load->library('fpdf');
		
		//define('FPDF_FONTPATH',$this->config->item('fonts_path'));
					
		$this->load->library('fpdi');
		
		//print_r($personal_info);	
		// initiate FPDI   
		$pdf = new FPDI('P','mm','Legal');
		
		// add a page
		$pdf->AddPage();
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/pds/page3.pdf');
		// import page 1
		$tplIdx = $pdf->importPage(1);
		// use the imported page and place it at point 10,10 with a width of 100 mm
		$pdf->useTemplate($tplIdx, 1, 1, 210);
		// now write some text above the imported page
		$pdf->SetFont('Arial');
		$pdf->SetTextColor(0,0,0);
		
		
		$pdf->SetXY(8, 31);
		
		$org = new Organization();
		
		$orgs = $org->get_by_employee_id($employee_id);
		
		
		$i = 1;
		
		 foreach($orgs as $org)
		 {
			$pdf->SetX(8);
			$pdf->Write(0, $org->name);

			$pdf->SetFont('Arial', '', 8);	
			$pdf->SetX(95);
			$pdf->Write(0, $org->inclusive_date_from);
			
			$pdf->SetX(117);
			$pdf->Write(0, $org->inclusive_date_from);
			
			$pdf->SetFont('Arial', '', 12);	
			$pdf->SetX(138);
			$pdf->Write(0, $org->number_of_hours);
			
			$pdf->SetX(155);
			$pdf->Write(0, $org->position);
			
			
			$pdf->SetX(188);
			$pdf->Write(0, $org->license_release_date);
			
			  	    	 
			$pdf->SetFont('Arial', '', 12);	
			
			
			if ($i == 2 || $i == 6)
			{
				$pdf->Ln(8);
			}
			else
			{
				$pdf->Ln(7);
			}
			
			$i++;
			
		 }
		 
		 
		
		 
		// ther info
		 
		$pdf->SetXY(8, 258);
		
		$i = new Other_info();
		
		$infos = $i->get_by_employee_id($employee_id);
		
		
		$i = 1;
		
		 foreach($infos as $info)
		 {
			$pdf->SetFont('Arial', '', 8);	
			
			$pdf->SetX(8);
			$pdf->Write(0, $info->special_skills);

			$pdf->SetX(58);
			$pdf->Write(0, $info->recognition);
			
			$pdf->SetX(155);
			//$pdf->Write(0, $info->membership_organization);
			$pdf->Write(0, str_replace('&#8230;', '..', character_limiter($info->membership_organization, 25)));
			
			$pdf->SetX(138);
			$pdf->Write(0, $info->number_hours);
			
			$pdf->SetX(155);
			$pdf->Write(0, $info->conducted_by);
			
			
			  	    	 
			$pdf->SetFont('Arial', '', 12);	
			
			
			if ($i == 6 || $i == 10 || $i == 11 || $i == 16)
			{
				$pdf->Ln(8);
			}
			else
			{
				$pdf->Ln(7);
			}
			
			$i++;
			
		 }
		
		//Training (we set this code below other info
		// because of long list of trainings
		// but this will be first in page
		$pdf->SetXY(8, 105);
		
		$t = new Training();
		$t->order_by('date_from', 'DESC');
		
		// Lets set the limit first
		//
		//$t->limit(18);
		
		$trainings = $t->get_by_employee_id($employee_id);
		
		
		$i = 1;
		
		 foreach($trainings as $training)
		 {
			$pdf->SetFont('Arial', '', 8);	
			$pdf->SetX(8);
			//$pdf->Write(0, $training->name);
			$pdf->Write(0, str_replace('&#8230;', '..', character_limiter($training->name, 50)));
			
			$pdf->SetX(95);
			$pdf->Write(0, $training->date_from);
			
			$pdf->SetX(117);
			$pdf->Write(0, $training->date_to);
			
			
			$pdf->SetX(138);
			$pdf->Write(0, $training->number_hours);
			
			$pdf->SetX(155);
			//$pdf->Write(0, $training->conducted_by);
			$pdf->Write(0, str_replace('&#8230;', '..', character_limiter($training->conducted_by, 25)));
			
			
			  	    	 
			$pdf->SetFont('Arial', '', 12);	
			
			
			if ($i == 6 || $i == 10 || $i == 11 || $i == 16)
			{
				$pdf->Ln(8);
			}
			else
			{
				$pdf->Ln(7);
			}
			
			if ( $i == 18)
			{
				//break;
				$pdf->AddPage();
			}
			
			$i++;
			
		 }
		
		
		// Output
		$pdf->Output('dtr/template/pds/page3_'.$employee_id.'.pdf', 'F'); 
		//header("location:".base_url()."resources/pdfs/archives/page3_".$employee_id.'.pdf');
		$this->pds[] = 'dtr/template/pds/page3_'.$employee_id.'.pdf';
		
	}
	
	//page 4 ====================================================================================================================
	function page4($employee_id)
	{
		
		$this->load->helper('settings');
		
		$this->load->library('fpdf');
		
		//define('FPDF_FONTPATH',$this->config->item('fonts_path'));
					
		$this->load->library('fpdi');
		

		//print_r($personal_info);	
		// initiate FPDI   
		$pdf = new FPDI('P','mm','Legal');
		
		// add a page
		$pdf->AddPage();
		// set the sourcefile
		$pdf->setSourceFile('dtr/template/pds/page4.pdf');
		// import page 1
		$tplIdx = $pdf->importPage(1);
		// use the imported page and place it at point 10,10 with a width of 100 mm
		$pdf->useTemplate($tplIdx, 1, 1, 210);
		// now write some text above the imported page
		$pdf->SetFont('Arial');
		$pdf->SetTextColor(0,0,0);
		
		
		$pdf->SetXY(8, 14);
		
		$q = new Question();
		$q->order_by('question_no');
		
		$questions = $q->get_by_employee_id($employee_id);
		
		
		 foreach($questions as $question)
		 {
			if ($question->question_no == 1)
			{
				
				if ($question->answer == 1)
				{
					$setx = 138.5;
				}
				else
				{
					$setx = 164;
				}
				$pdf->SetX($setx);
				$pdf->Write(0, 'X');
			}
			
			if ($question->question_no == 2)
			{
				
				$pdf->Ln(21);
				
				if ($question->answer == 1)
				{
					$setx = 138.5;
				}
				else
				{
					$setx = 164;
				}
				$pdf->SetX($setx);
				$pdf->Write(0, 'X');
			}
			if ($question->question_no == 3)
			{
				
				$pdf->Ln(26);
				
				if ($question->answer == 1)
				{
					$setx = 138.5;
				}
				else
				{
					$setx = 164;
				}
				$pdf->SetX($setx);
				$pdf->Write(0, 'X');
			}
			
			if ($question->question_no == 4)
			{
				
				$pdf->Ln(21);
				
				if ($question->answer == 1)
				{
					$setx = 138.5;
				}
				else
				{
					$setx = 164;
				}
				$pdf->SetX($setx);
				$pdf->Write(0, 'X');
			}
			
			if ($question->question_no == 5)
			{
				
				$pdf->Ln(26);
				
				if ($question->answer == 1)
				{
					$setx = 138.5;
				}
				else
				{
					$setx = 164;
				}
				$pdf->SetX($setx);
				$pdf->Write(0, 'X');
			}
			if ($question->question_no == 6)
			{
				
				$pdf->Ln(26);
				
				if ($question->answer == 1)
				{
					$setx = 138.5;
				}
				else
				{
					$setx = 164;
				}
				$pdf->SetX($setx);
				$pdf->Write(0, 'X');
			}
			if ($question->question_no == 7)
			{
				
				$pdf->Ln(21);
				
				if ($question->answer == 1)
				{
					$setx = 138.5;
				}
				else
				{
					$setx = 164;
				}
				$pdf->SetX($setx);
				$pdf->Write(0, 'X');
			}
			if ($question->question_no == 8)
			{
				
				$pdf->Ln(35);
				
				if ($question->answer == 1)
				{
					$setx = 138.5;
				}
				else
				{
					$setx = 164;
				}
				$pdf->SetX($setx);
				$pdf->Write(0, 'X');
			}
			if ($question->question_no == 9)
			{
				
				$pdf->Ln(12);
				
				if ($question->answer == 1)
				{
					$setx = 138.5;
				}
				else
				{
					$setx = 164;
				}
				$pdf->SetX($setx);
				$pdf->Write(0, 'X');
			}
			if ($question->question_no == 10)
			{
				
				$pdf->Ln(13);
				
				if ($question->answer == 1)
				{
					$setx = 138.5;
				}
				else
				{
					$setx = 164;
				}
				$pdf->SetX($setx);
				$pdf->Write(0, 'X');
			}
			
		 }
		 
		
		$pdf->SetXY(8, 233);
		//$pdf->Write(0, 'X');
		
		$r = new Reference();
		
		$references = $r->get_by_employee_id($employee_id);
		
		
		 foreach($references as $reference)
		 {
			$pdf->SetX(8);
			$pdf->Write(0, $reference->name);
			$pdf->SetX(72);
			$pdf->Write(0, $reference->address);
			$pdf->SetX(134);
			$pdf->Write(0, $reference->tel_no);
			
			$pdf->Ln(4);
		
		 }
		
		// CTC NO
		$pdf->SetXY(15, 275);
		$pdf->Write(0, $reference->ctc_no);
		
		
		$pdf->Ln(13);
		$pdf->SetX(15);
		$pdf->Write(0, $reference->issue_at);
		
		$pdf->Ln(13);
		$pdf->SetX(15);
		$pdf->Write(0, $reference->issue_on);
		
		$pdf->SetX(90);
		$pdf->Write(0, date('F d, Y'));
		
		// Output
		$pdf->Output('dtr/template/pds/page4_'.$employee_id.'.pdf', 'F'); 
		//header("location:".base_url()."resources/pdfs/archives/page4_".$employee_id.'.pdf');
		$this->pds[] = 'dtr/template/pds/page4_'.$employee_id.'.pdf';
		
	}
	
	function pds($employee_id)
	{
		$this->load->helper('settings');
		
		$this->load->library('fpdf');
		
		define('FPDF_FONTPATH',$this->config->item('fonts_path'));
					
		$this->load->library('fpdi');
		
		$this->page1($employee_id);
		$this->page2($employee_id);
		$this->page3($employee_id);
		$this->page4($employee_id);
		
		//if training is excess to page
		
		
		//Concatenate the pdf files
		//$pdf = new FPDI('P','mm','Legal');
		$this->load->library('concat_pdf');
		
		$this->concat_pdf->setFiles($this->pds); 
		$this->concat_pdf->concat();
		
		$this->concat_pdf->Output("dtr/template/pds/archives/".$employee_id.".pdf", 'I');
		//header("location:".base_url()."dtr/template/pds/archives/".$employee_id.".pdf");
		unlink('dtr/template/pds/page1_'.$employee_id.'.pdf');
		unlink('dtr/template/pds/page2_'.$employee_id.'.pdf');
		unlink('dtr/template/pds/page3_'.$employee_id.'.pdf');
		unlink('dtr/template/pds/page4_'.$employee_id.'.pdf');
	}
	
	function aso()
	{
		$e = new Employee_m();
		$e->where('id', '25')->get();
		echo 'aso';	
	}
}
?>