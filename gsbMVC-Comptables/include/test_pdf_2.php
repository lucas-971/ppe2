<?php
// permet d'inclure la biblioth�que fpdf
require(dirname(__FILE__) . '/../fpdf/fpdf.php');

// instancie un objet de type FPDF qui permet de cr�er le PDF
$pdf=new FPDF();
// ajoute une page
$pdf->AddPage();

//
$pdf->Image('../images/logo.jpg',5,5, 30,30);

$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();$pdf->ln();
$pdf->Cell(40,10,'');

// d�finit la police courante
$pdf->SetFont('Arial','B',16);
// affiche du texte
$pdf->Cell(40,10,'Remboursement des frais engag�s !');

$pdf->Ln(80);
$pdf->Cell(40,10,'Visiteur :');

$pdf->Ln(20);
$pdf->Cell(40,10,'Mois : ');
// Enfin, le document est termin� et envoy� au navigateur gr�ce � Output().
$pdf->Output();
?>