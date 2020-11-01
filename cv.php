<?php
require('Class/fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
   // $this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    
    $this->SetXY(0,0);
    
    // Title
    $this->SetFillColor(6,171,255);
    $this->Cell(85,300,'',0,1,'L',true);
    
    // Line break
    $this->Ln(20);
}

// Page footer

}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$pdf->Output();
?>