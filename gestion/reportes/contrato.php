<?php 

require "../fpdf181/fpdf.php";

class PDF extends FPDF{

	function Header(){
		$this->Image('contratoImg/contrato_unico.png',0,0,220);
		// $this->Cell(10);
	}

}

 ?>