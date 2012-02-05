<?php
define('FPDF_FONTPATH','font/');
require('fpdf_js.php');

class PDF_AutoPrint extends PDF_Javascript
{
function AutoPrint($dialog=false)
{
    //Launch the print dialog or start printing immediately on the standard printer
    $param=($dialog ? 'true' : 'false');
    $script="print($param);";
    $this->IncludeJS($script);
}

function AutoPrintToPrinter($server, $printer, $dialog=false)
{
    //Print on a shared printer (requires at least Acrobat 6)
    $script = "var pp = getPrintParams();";
    if($dialog)
        $script .= "pp.interactive = pp.constants.interactionLevel.full;";
    else
        $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
    $script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
    $script .= "print(pp);";
    //$this->IncludeJS($script);
}
}
$pdf = new PDF_AutoPrint();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','',20);
$pdf->Text(90, 50, 'Print me!');
//Launch the print dialog
$pdf->AutoPrint(true);
$pdf->Output();
?> 