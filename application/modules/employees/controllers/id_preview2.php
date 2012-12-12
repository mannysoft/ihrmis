<?php 
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
 * iHRMIS Id_preview Class
 *
 * This class use for converting number of minutes late
 * to the corresponding equivalent to leave credits.
 *
 * @package		iHRMIS
 * @subpackage	Models
 * @category	Models
 * @author		Manny Isles and Michael Rafallo
 * @link		http://charliesoft.net/hrmis/user_guide/models/conversion_table.html
 */
class Id_preview extends MX_Controller
{
	var $pds = array();
	
	function __construct()
    {
        parent::__construct();
		
		header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	 //ini_set('memory_limit', '9999999M');
     //print system('ulimit -a');
	}
		//-------------------------------------------------------------------------------------------------
	function front_id($results)
	{
		
			 $params = array(
			'mode' 				=> '',			// mode - default ''
			'format' 			=> 'Legal', 	// format - A4, for example, default ''
			'default_font_size' => 0,			// font size - default 0
			'default_font' 		=> '',			// default font family
			'mgl' 				=> '0',			// margin_left
			'mgr' 				=> '0',			// margin right
			'mgt' 				=> '0',			// margin top
			'mgb' 				=> '0',			// margin bottom
			'mgh' 				=> '0',			// margin header
			'mgf' 				=> '0', 		// margin footer
			'orientation' 		=> 'P'			// L - landscape, P - portrait
			);
						
			$this->load->library('mpdf', $params);
			
			$mpdf = new mpdf($params);
			

			// LOAD a stylesheet
		
			//$this->mpdf->SetHTMLHeader('<div align="center" style="font-size:15">LAGUNA UNIVERSITY PROPERTY INVENTORY SYSTEM<div>');
			$stylesheet = file_get_contents(base_url().'css/mpdf/mpdfstyletables.css');
			$mpdf->WriteHTML($stylesheet,1); // The parameter 1 tells that this is css/style only and no body/html/text
	
			//$today = date("F, l, d, Y - H:i:s a");
			//$this->mpdf->SetFooter($today.'||{PAGENO} of {nbpg}');	
			$tbl_start_f = '<table border="0"><tr>';
			$mpdf->WriteHTML($tbl_start_f);
			
			
			$x = '4'; //4 start counting
			$y = '0';
		
			foreach($results as $result)
			{
				$e = new Employee_m();
				$row = $e->get_by_id($result->employee_id);
				$y++;

				$pics = "pics/".$row->pics;
		
				if(strlen($row->pics) <= '4' || !file_exists($pics))
				{
					$pics = 'pics/not_available.jpg';
				}
				
				//set font size if textover flow at employee name
				$s_name = 'height="21" style="font-weight: bold; font-size:15px;"';
				
				if(strlen($row->fname." ".$row->mname." ".$row->lname)  >= '20'):
					$s_name = 'height="21" style="font-weight: bold; font-size:10px;"';
				endif;
				
				//set font size if textover flow at office code
				$s_office = 'style="font-weight: bold; font-size:15px; color: #FFF;"';
				if(strlen($row->office_code)  >= '21'):
					$s_office = 'style="font-weight: bold; font-size:10px; color: #FFF;"';
				endif;
				
				//set font size if textover flow at position
				$valign_pos = 'valign="middle"';
				if(strlen($row->position)  >= '45'):	
					$valign_pos = 'valign="bottom"';
				endif;
				
				//set font size if textover flow at position
				$s_position = 'style="font-weight: bold; font-size:15px; color:#FF0;"';
				if(strlen($row->position)  >= '21'):
				
					$s_position = 'style="font-weight: bold; font-size:8px; color:#FF0;"';
				endif;

				
				$html_f = '<td align="center">
							<table border="0" width="205" height="320" style="background-image: url(images/id/id-front.png);">
							  <tr>
								<td align="center" height="63">&nbsp;</td>
							  </tr>
							  <tr>
								<td align="center" style="font-weight: bold; font-size:12px;">EMP No:'.strtoupper($row->employee_id).'</td>
							  </tr>
							  <tr>
								<td align="center"><img src="'.$pics.'" width="120" height="140"/></td>
							  </tr>
							  <tr>
								<td align="center" valign="middle" '.$s_name.'>'.strtoupper($row->fname." ".$row->mname." ".$row->lname).'</td>
							  </tr>
							  <tr>
								<td align="center"  height="34">&nbsp;</td>
							  </tr>
							  <tr>
								<td align="center" valign="bottom" height="27" '.$s_office.'>'.strtoupper($row->office_code).'</td>
							  </tr>
							  <tr>
								<td align="center" '.$valign_pos.' height="22" '.$s_position.'>'.strtoupper($row->position).'</td>
							  </tr>
							</table></td>';	
						
				if($y  == $x){
					$html_f = '
					<tr><td align="center">
						<table border="0" width="205" height="320" style="background-image: url(images/id/id-front.png);">
						  <tr>
							<td align="center" height="63">&nbsp;</td>
						  </tr>
						  <tr>
							<td align="center" style="font-weight: bold; font-size:12px;">EMP No:'.strtoupper($row->employee_id).'</td>
						  </tr>
						  <tr>
							<td align="center"><img src="'.$pics.'" width="120" height="140"/></td>
						  </tr>
						  <tr>
							<td align="center" valign="middle" '.$s_name.'>'.strtoupper($row->fname." ".$row->mname." ".$row->lname).'</td>
						  </tr>
						  <tr>
							<td align="center"  height="34">&nbsp;</td>
						  </tr>
						  <tr>
							<td align="center" valign="bottom" height="27" '.$s_office.'>'.strtoupper($row->office_code).'</td>
						  </tr>
						  <tr>
							<td align="center" '.$valign_pos.' height="22" '.$s_position.'>'.strtoupper($row->position).'</td>
						  </tr>
						</table></td></tr>';		
					$x = $x + 3; //3 count of generated id per column
				}
		
				
				$mpdf->WriteHTML($html_f);
			}
	
		
		$tbl_end_f = '</tr></table>';
		
		$mpdf->WriteHTML($tbl_end_f);

		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
				
		header('Pragma: public');
		
		$mpdf->Output('dtr/template/id_generated/front_id.pdf', 'F');
		//return 'dtr/template/id_generated/front_id_'.date('Y_m_d').'.pdf';	
	}
	//-----------------------------------------------------------------------------------------------
	function back_id($results)
	{

		 $params = array(
		'mode' 				=> '',			// mode - default ''
		'format' 			=> 'Legal', 	// format - A4, for example, default ''
		'default_font_size' => 0,			// font size - default 0
		'default_font' 		=> '',			// default font family
		'mgl' 				=> '0',			// margin_left
		'mgr' 				=> '0',			// margin right
		'mgt' 				=> '0',			// margin top
		'mgb' 				=> '0',			// margin bottom
		'mgh' 				=> '0',			// margin header
		'mgf' 				=> '0', 		// margin footer
		'orientation' 		=> 'P'			// L - landscape, P - portrait
		);	  
					
		$this->load->library('mpdf', $params);
		// LOAD a stylesheet
	
		//$this->mpdf->SetHTMLHeader('<div align="center" style="font-size:15">LAGUNA UNIVERSITY PROPERTY INVENTORY SYSTEM<div>');
		$stylesheet = file_get_contents(base_url().'css/mpdf/mpdfstyletables.css');
		$this->mpdf->WriteHTML($stylesheet,1); // The parameter 1 tells that this is css/style only and no body/html/text

		//$today = date("F, l, d, Y - H:i:s a");
		//$this->mpdf->SetFooter($today.'||{PAGENO} of {nbpg}');	
		$tbl_start_b = '<table border="0"><tr>';
		$this->mpdf->WriteHTML($tbl_start_b);
		
		
		$x = '4'; //4 start counting
		$y = '0';
	
		foreach($results as $result)
		{
			//get info from PDS table
			$p = new Pds_personal_info_m();
			$row = $p->get_by_employee_id($result->employee_id);
						
			//get info from Employee table
			$e = new Employee_m();
			$e_row = $e->get_by_id($val);
				
			$blood_type = '';	
			if(strlen($row->blood_type) >= 1):
				$blood_type = "&quot;".$row->blood_type."&quot;";
			endif;
			
			$y++;

			$o = new Office_m();
			$office = $o->get_by_office_id( $e_row->office_id );
			
			
				$html_f = '<td align="center">
						<table border="0" width="205" height="320" style="background-image: url(images/id/id-back.png) no-repeat; font-size:9px; font-family:Arial" >
						  <tr><td height="12" colspan="2"></td></tr>
                          <tr>
							<td width="20%" height="37" align="left">ADDRESS:</td>
							<td align="center">'.ucwords(strtolower($row->permanent_address)).'</td>
						  </tr>
						   <tr>
							<td height="18" align="left" valign="bottom">BIRTHDAY:</td>
							<td align="center" valign="bottom">'.$row->birth_date.'</td>
						  </tr>
						  <tr>
							<td height="18" align="left" valign="bottom">BLOOD TYPE:</td>
							<td align="center" valign="bottom">'.$blood_type.'</td>
						  </tr>
						  <tr>
							<td height="18" align="left" valign="bottom">GSIS:</td>
							<td align="center" valign="bottom">'.$row->gsis.'</td>
						  </tr>
						  <tr>
							<td height="20" align="left" valign="bottom">PAG-IBIG:</td>
							<td align="center" valign="bottom">'.$row->pagibig.'</td>
						  </tr>
						  <tr>
							<td height="20" align="left" valign="bottom">PHILHEALTH:</td>
							<td align="center" valign="bottom">'.$row->philhealth.'</td>
						  </tr>
						  <tr>
							<td height="20" align="left" valign="bottom">TIN:</td>
							<td align="center" valign="bottom">'.$row->tin.'</td>
						  </tr>
						  <tr>
							<td height="10" colspan="2" align="center">
							This card must be surrendered immediately upon termination or separation from service. if found. please send or mail to</td>
  						  </tr>
						  <tr>
						    <td align="center" colspan="2">
								<b>Provincial Government of Laguna<br>'.$office->office_name.'</b>
								<br>'.$office->office_address.'
							</td>
  						  </tr>
						  <tr>
						    <td align="center" colspan="2" height="20" valign="bottom"><b>IN CASE OF EMERGENCY, PLEASE NOTIFY:</b></td>
  						  </tr>
						  <tr>
						    <td align="center" colspan="2"><b>&nbsp;<br />&nbsp;</b></td>
  						  </tr>
						  <tr>
						    <td align="center" height="61" colspan="2" style="background-image: url(images/id/gov.signiture.png) no-repeat;">&nbsp;</td>
  						  </tr>
						  </table></td>';	
						
				if($y  == $x){
					$html_f = '
					<tr><td align="center">
						<table border="0" width="205" height="320" style="background-image: url(images/id/id-back.png) no-repeat; font-size:9px; font-family:Arial" >
						  <tr><td height="12" colspan="2"></td></tr>
                          <tr>
							<td width="20%" height="37" align="left">ADDRESS:</td>
							<td align="center">'.ucwords(strtolower($row->permanent_address)).'</td>
						  </tr>
						   <tr>
							<td height="18" align="left" valign="bottom">BIRTHDAY:</td>
							<td align="center" valign="bottom">'.$row->birth_date.'</td>
						  </tr>
						  <tr>
							<td height="18" align="left" valign="bottom">BLOOD TYPE:</td>
							<td align="center" valign="bottom">'.$blood_type.'</td>
						  </tr>
						  <tr>
							<td height="18" align="left" valign="bottom">GSIS:</td>
							<td align="center" valign="bottom">'.$row->gsis.'</td>
						  </tr>
						  <tr>
							<td height="20" align="left" valign="bottom">PAG-IBIG:</td>
							<td align="center" valign="bottom">'.$row->pagibig.'</td>
						  </tr>
						  <tr>
							<td height="20" align="left" valign="bottom">PHILHEALTH:</td>
							<td align="center" valign="bottom">'.$row->philhealth.'</td>
						  </tr>
						  <tr>
							<td height="20" align="left" valign="bottom">TIN:</td>
							<td align="center" valign="bottom">'.$row->tin.'</td>
						  </tr>
						  <tr>
							<td height="10" colspan="2" align="center">
							This card must be surrendered immediately upon termination or separation from service. if found. please send or mail to</td>
  						  </tr>
						  <tr>
						    <td align="center" colspan="2">
								<b>Provincial Government of Laguna<br>'.$office->office_name.'</b>
								<br>'.$office->office_address.'
							</td>
  						  </tr>
						  <tr>
						    <td align="center" colspan="2" height="20" valign="bottom"><b>IN CASE OF EMERGENCY, PLEASE NOTIFY:</b></td>
  						  </tr>
						  <tr>
						    <td align="center" colspan="2"><b>&nbsp;<br />&nbsp;</b></td>
  						  </tr>
						  <tr>
						    <td align="center" height="61" colspan="2" style="background-image: url(images/id/gov.signiture.png) no-repeat;">&nbsp;</td>
  						  </tr>
						  </table></td></tr>';		
					$x = $x + 3; //3 count of generated id per column
				}
		
				$this->mpdf->WriteHTML($html_f);
			}
	
		
		$tbl_end_b = '</tr></table>';
		
		$this->mpdf->WriteHTML($tbl_end_b);

		
		header('Cache-Control: maxage=3600'); //Adjust maxage appropriately
				
		header('Pragma: public');
		
		$this->mpdf->Output('dtr/template/id_generated/back_id.pdf', 'F');
		
		
		return TRUE;
	
	}
	//--------------------------------------------------------------------------------------
	function generated_id_preview($results = '')
	{
		$this->load->library('fpdf');
		
		//define('FPDF_FONTPATH',$this->config->item('fonts_path'));
					
		$this->load->library('fpdi');

		$this->front_id($results);
	
		$pre = array('dtr/template/id_generated/front_id.pdf','dtr/template/id_generated/back_id.pdf');
		
		$this->load->library('concat_pdf');
					
		$this->concat_pdf->setFiles($pre); 
		$this->concat_pdf->concat();
			
		$this->concat_pdf->Output('dtr/template/id_generated/id_preview.pdf', 'F'); 
		
		//delete generated pdf file afterwards
		unlink('dtr/template/id_generated/front_id.pdf');
		unlink('dtr/template/id_generated/back_id.pdf');
		
		return 'dtr/template/id_generated/id_preview.pdf';	
	}
	//-----------------------------------------------------------------------------------------------	
}

?>