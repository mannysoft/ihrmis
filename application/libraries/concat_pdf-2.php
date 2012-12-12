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
 * iHRMIS Concatenate PDF Class
 *
 * This class use for concatenating pdf files.
 *
 * @package		iHRMIS
 * @subpackage	Libraries
 * @category	PDF Utilities
 * @author		Manny Isles
 * @link		http://charliesoft.net/hrmis/user_guide/libraries/concat_pdf.html
 */
require_once('fpdi.php');

class Concat_pdf extends FPDI{
	
	// ------------------------------------------------------------------------
	
	public $orientation = array();
	
	// ------------------------------------------------------------------------
	
	function setFiles($files) 
	{ 
		$this->files = $files; 
	} 
	
	// ------------------------------------------------------------------------
	
	function concat() 
	{ 
		foreach($this->files as $key => $file) 
		{ 
			$pagecount = $this->setSourceFile($file);
			
			for ($i = 1; $i <= $pagecount; $i++) 
			{ 
				 $tplidx = $this->ImportPage($i); 
				 $s = $this->getTemplatesize($tplidx);
				 
				 $orientation = 'P';
				 
				 // If the array key is not numeric
				 // might be 'P' or 'L' portrait or
				 // landscape.				 
				 if ( ! is_numeric($key) )
				 {
					 $orientation = $key;
				 }
				 
				 //$this->AddPage('P', array($s['w'], $s['h'])); // orig
				 $this->AddPage($orientation, array($s['w'], $s['h'])); 
				 $this->useTemplate($tplidx); 
			} 
		} 
	}
	
	// ------------------------------------------------------------------------
}