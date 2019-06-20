<?php 

require "../fpdf181/fpdf.php";

class PDF extends FPDF{

	function Header(){
		$this->Image('contratoImg/Formato_OT_001.jpg',0,0,220);
		// $this->Cell(10);
	}

}


 ?>