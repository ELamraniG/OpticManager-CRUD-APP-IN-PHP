<?php
require('../fpdf.php');

class PDF extends FPDF
{
protected $col = 0;
protected $y0;

function Header()
{
	global $titre;

	$this->SetFont('Arial','B',15);
	$w = $this->GetStringWidth($titre)+6;
	$this->SetX((210-$w)/2);
	$this->SetDrawColor(0,80,180);
	$this->SetFillColor(230,230,0);
	$this->SetTextColor(220,50,50);
	$this->SetLineWidth(1);	$this->Cell($w,9,$titre,1,1,'C',true);
	$this->Ln(10);
	$this->y0 = $this->GetY();
}

function Footer()
{
	$this->SetY(-15);
	$this->SetFont('Arial','I',8);
	$this->SetTextColor(128);
	$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

function SetCol($col)
{
	$this->col = $col;
	$x = 10+$col*65;
	$this->SetLeftMargin($x);
	$this->SetX($x);
}

function AcceptPageBreak()
{
	if($this->col<2)
	{		$this->SetCol($this->col+1);
		$this->SetY($this->y0);
		return false;
	}
	else
	{
		$this->SetCol(0);
		return true;
	}
}

function TitreChapitre($num, $libelle)
{
	$this->SetFont('Arial','',12);	$this->SetFillColor(200,220,255);
	$this->Cell(0,6,"Chapitre $num : $libelle",0,1,'L',true);
	$this->Ln(4);
	$this->y0 = $this->GetY();
}

function CorpsChapitre($fichier)
{	$txt = file_get_contents($fichier);
	$this->SetFont('Times','',12);
	$this->MultiCell(60,5,$txt);
	$this->Ln();
	$this->SetFont('','I');
	$this->Cell(0,5,"(fin de l'extrait)");
	$this->SetCol(0);
}

function AjouterChapitre($num, $titre, $fichier)
{
	$this->AddPage();
	$this->TitreChapitre($num,$titre);
	$this->CorpsChapitre($fichier);
}
}

$pdf = new PDF();
$titre = 'Vingt mille lieues sous les mers';
$pdf->SetTitle($titre);
$pdf->SetAuthor('Jules Verne');
$pdf->AjouterChapitre(1,'UN �CUEIL FUYANT','20k_c1.txt');
$pdf->AjouterChapitre(2,'LE POUR ET LE CONTRE','20k_c2.txt');
$pdf->Output();
?>
