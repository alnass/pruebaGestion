<?php
// # encodé par @Anderson Ferrucho 
// LLAMADO A LAS CLASES
require "../modelos/ConsolidadoVentas.php";
require "../fpdf181/fpdf.php";

// ASIGNACIÓN DE OBJETOS
$consolidadoVentas 	= 	new ConsolidadoVentas();
$pdf				=	new FPDF();
$fecha 				=	(date('Y/m/d g:i a'));
$pdf->AddPage();

// RESULTADO DE MESES
$respuesta = $consolidadoVentas->traerMes();
// CREACION DE ARRAY PARA ALMACENAR RESULTADOS
$data = Array();

while ($reg = $respuesta->fetch_object()) 
{
	$mes  = "";
	$bogota = $consolidadoVentas->conBogota($reg->fecha);
	$paipa = $consolidadoVentas->conPaipa($reg->fecha);
	$fira = $consolidadoVentas->conFira($reg->fecha);
	$tibasosa = $consolidadoVentas->conTibasosa($reg->fecha);
	$iza = $consolidadoVentas->conIza($reg->fecha);
	$fomeque = $consolidadoVentas->conFomeque($reg->fecha);
	$snAntonio = $consolidadoVentas->conSnAntonio($reg->fecha);
	$madrid = $consolidadoVentas->conMadrid($reg->fecha);
	$corp = $consolidadoVentas->conCorp($reg->fecha);
	$total = $consolidadoVentas->total($reg->fecha);
	if ($reg->fecha == 1) {
		$mes = "01 - ENERO";
	}
	elseif ($reg->fecha ==2) {
		$mes = "02 - FEBRERO";
	}
	elseif ($reg->fecha ==3) {
		$mes = "03 - MARZO";
	}
	elseif ($reg->fecha ==4) {
		$mes = "04 - ABRIL";
	}
	elseif ($reg->fecha ==5) {
		$mes = "05 - MAYO";
	}
	elseif ($reg->fecha ==6) {
		$mes = "06 - JUNIO";
	}
	elseif ($reg->fecha ==7) {
		$mes = "07 - JULIO";
	}
	elseif ($reg->fecha ==8) {
		$mes = "08 - AGOSTO";
	}
	elseif ($reg->fecha ==9) {
		$mes = "09 - SEPTIEMBRE";
	}
	elseif ($reg->fecha ==10) {
		$mes = "10 - OCTUBRE";
	}
	elseif ($reg->fecha ==11) {
		$mes = "11 - NOVIEMBRE";
	}
	elseif ($reg->fecha ==12) {
		$mes = "12 - DICIEMBRE";
	}

	$data[] = array(
		"meses"		=>	$mes,
		"bogota"	=>	"$".number_format($bogota['sumatoria']),
		"paipa"		=>	"$".number_format($paipa['sumatoria']),
		"fira"		=>	"$".number_format($fira['sumatoria']),
		"tiba"		=>	"$".number_format($tibasosa['sumatoria']),
		"iza"		=>	"$".number_format($iza['sumatoria']),
		"fomeque"	=>	"$".number_format($fomeque['sumatoria']),
		"sat"		=>	"$".number_format($snAntonio['sumatoria']),
		"corp"		=>	"$".number_format($corp['sumatoria']),
		"madrid"	=>	"$".number_format($madrid['sumatoria']),
		"total"		=>	"$".number_format($total['sumatoria'])
	);			
}

// $results = array(
// 	// Informacion para el datatable
// 	"sEcho"=>1,
// 	// Envio el total de los regstros al datatable
// 	"iTotalRecords"=>count($data),
// 	// Envio del total de registros a visualizar
// 	"iTotalDisplayRecords"=>count($data),
// 	//Envio de los valores resultantes
// 	"aaData"=>$data);
// echo json_encode($results);

$pdf->Output();