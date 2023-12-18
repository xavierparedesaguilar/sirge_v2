<?php

namespace App\Model\Entity;

class Pdf extends \FPDF
{
	//Cabecera de p&aacute;gina
	function Header()
	{
		$this->Image(WWW_ROOT.'img'.DS.'logo_horizontal.png',8,6,60);

		$this->SetFont('Arial','B',8);

		$this->Ln(3);
		$this->Cell(249);
		$this->Cell(0,0,'Fecha ',0,1,'L');
		$this->Cell(259);
		$this->Cell(0,0,':',0,1,'L');
		$this->Cell(261);
		$this->Cell(0,0,date('d-m-Y'),0,1,'L');
		$this->Ln(5);
		$this->Cell(249);
		$this->Cell(0,0,'Hora',0,1,'L');
		$this->Cell(259);
		$this->Cell(0,0,':',0,1,'L');
		$this->Cell(261);
		$this->Cell(0,0,date('H:i:s'),0,1,'L');
		$this->Ln(5);
		$this->Cell(249);
		$this->Cell(0,0,utf8_decode('Página '),0,1,'L');
		$this->Cell(259);
		$this->Cell(0,0,':',0,1,'L');
		$this->Cell(261);
		$this->Cell(0,0,$this->PageNo().' de {nb}',0,0,'L');

		$this->Ln(10);
		$this->SetFont('Arial','B',11);
		$this->Cell(0,0, utf8_decode('GESTIÓN DE MAPAS'),0,1,'C');
		$this->Ln(5);
	}

	function Footer() {

		$this->SetY(-15);
		$this->SetFont('Arial','I',6);
		$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'R');
	}
}


?>
