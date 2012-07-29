http://codeigniter.com/forums/viewthread/91996/

Kinda goes something like this:

application
  libraries
    fpdf.php
    fpdf_tpl.php
    fpdi.php
    fpdi_pdf_parser.php
    pdf_context.php
    pdf_parser.php
    wrapper_functions.php


Controller
$this->load->library('fpdf');
define('FPDF_FONTPATH',$this->config->item('fonts_path'));
            
$this->load->library('fpdi');
            
// initiate FPDI   
$pdf =& new FPDI('P','mm','A4');
// add a page
$pdf->AddPage();
// set the sourcefile
$pdf->setSourceFile('resources/pdfs/your_pdf_template.pdf');
// import page 1
$tplIdx = $pdf->importPage(1);
// use the imported page and place it at point 10,10 with a width of 100 mm
$pdf->useTemplate($tplIdx, 1, 1, 210);
// now write some text above the imported page
$pdf->SetFont('Arial');
$pdf->SetTextColor(0,0,0);

// Write something
$pdf->SetXY(88, 31);
$pdf->Write(0, "Hello world");

// Output
$pdf->Output('resources/pdfs/archives/'. $pdf_name, 'F');


Don’t forget the fonts folder:
Add this to config.php
$config['fonts_path']= "resources/font/";

Works great for me, hope this helps. 