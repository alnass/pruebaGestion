<?php
// encodé par @Anderson Ferrucho 
// maintenance effectuee par Anderson Ferrucho
require '../fpdf181/fpdf.php';

	clasS PDF extends FPDF
	{
		function Header()
		{	
			$this->Image('cuentasCobro/cuenta_de_cobro.png', 2, 0, 210);
			$this->Image('cuentasCobro/cuenta_de_cobro.png', 2, 140, 210);
			$this->SetFont('Arial','B',10);
			$this->Ln(20);
		}

	}



?>