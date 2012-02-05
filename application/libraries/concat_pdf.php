<?php

require_once('fpdi.php');

class Concat_pdf extends FPDI
{
	function setFiles($files) 
	{ 
		$this->files = $files; 
	} 

	function concat() { 
		foreach($this->files AS $file) { 
			$pagecount = $this->setSourceFile($file); 
			for ($i = 1; $i <= $pagecount; $i++) { 
				 $tplidx = $this->ImportPage($i); 
				 $s = $this->getTemplatesize($tplidx); 
				 $this->AddPage('P', array($s['w'], $s['h'])); 
				 $this->useTemplate($tplidx); 
			} 
		} 
	} 
}