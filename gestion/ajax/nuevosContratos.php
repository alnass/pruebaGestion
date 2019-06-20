<?php  
require "../modelos/NuevosContratos.php";

$nuevosContratos = new NuevosContratos();
$nuevosContratos2 = new NuevosContratos();

switch ($_GET['op']) {
	case 'listar':
/// LISTAR TV		
		$respuesta = $nuevosContratos->traerMes();
		$data = Array();
		while ($reg = $respuesta->fetch_object()) {
			$mes  = "";
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

			$bogotatv 		= 	$nuevosContratos->nvoBogota($reg->fecha);
			$paipatv 		= 	$nuevosContratos->nvoPaipa($reg->fecha);
			$firatv 		= 	$nuevosContratos->nvoFira($reg->fecha);
			$tibasosatv 	= 	$nuevosContratos->nvoTibasosa($reg->fecha);
			$izatv 			= 	$nuevosContratos->nvoIza($reg->fecha);
			$fomequetv 		= 	$nuevosContratos->nvoFomeque($reg->fecha);
			$snAntoniotv 	= 	$nuevosContratos->nvoSnAntonio($reg->fecha);
			$corptv 		= 	$nuevosContratos->nvoCorp($reg->fecha);

			$data[] = array(
				"0"	=>	$mes,
				"1"	=>	$bogotatv['cuenta'],
				"2"	=>	$paipatv['cuenta'],
				"3"	=>	$firatv['cuenta'],
				"4"	=>	$tibasosatv['cuenta'],
				"5"	=>	$izatv['cuenta'],
				"6"	=>	$fomequetv['cuenta'],
				"7"	=>	$snAntoniotv['cuenta'],
				"8"	=>	$corptv['cuenta']
				
			);
		}
		$results = array(
			// Informacion para el datatable
			"sEcho"=>1,
			// Envio el total de los regstros al datatable
			"iTotalRecords"=>count($data),
			// Envio del total de registros a visualizar
			"iTotalDisplayRecords"=>count($data),
			//Envio de los valores resultantes
			"aaData"=>$data);
		echo json_encode($results);
		
		break;

	case 'listar2':

/// LISTAR INTERNET

		$respuesta2 = $nuevosContratos2->traerMes();
		$data2 = Array();
		while ($reg2 = $respuesta2->fetch_object()) {
			$mes  = "";
			if ($reg2->fecha == 1) {
				$mes = "01 - ENERO";
			}
			elseif ($reg2->fecha ==2) {
				$mes = "02 - FEBRERO";
			}
			elseif ($reg2->fecha ==3) {
				$mes = "03 - MARZO";
			}
			elseif ($reg2->fecha ==4) {
				$mes = "04 - ABRIL";
			}
			elseif ($reg2->fecha ==5) {
				$mes = "05 - MAYO";
			}
			elseif ($reg2->fecha ==6) {
				$mes = "06 - JUNIO";
			}
			elseif ($reg2->fecha ==7) {
				$mes = "07 - JULIO";
			}
			elseif ($reg2->fecha ==8) {
				$mes = "08 - AGOSTO";
			}
			elseif ($reg2->fecha ==9) {
				$mes = "09 - SEPTIEMBRE";
			}
			elseif ($reg2->fecha ==10) {
				$mes = "10 - OCTUBRE";
			}
			elseif ($reg2->fecha ==11) {
				$mes = "11 - NOVIEMBRE";
			}
			elseif ($reg2->fecha ==12) {
				$mes = "12 - DICIEMBRE";
			}

			$bogotaint 		=	$nuevosContratos2->nvoBogotaTv($reg2->fecha);
			$paipaint 		=	$nuevosContratos2->nvoPaipaTv($reg2->fecha);
			$firaint 		=	$nuevosContratos2->nvoFiraTv($reg2->fecha);
			$tibasosaint	=	$nuevosContratos2->nvoTibasosaTv($reg2->fecha);
			$izaint 		=	$nuevosContratos2->nvoIzaTv($reg2->fecha);
			$fomequeint 	=	$nuevosContratos2->nvoFomequeTv($reg2->fecha);
			$snAntonioint	=	$nuevosContratos2->nvoSnAntonioTv($reg2->fecha);
			$corpint 		=	$nuevosContratos2->nvoCorpTv($reg2->fecha);

			$data2[] = array(
				"0"	=>	$mes,
				"1"	=>	$bogotaint['cuenta'],
				"2"	=>	$paipaint['cuenta'],
				"3"	=>	$firaint['cuenta'],
				"4"	=>	$tibasosaint['cuenta'],
				"5"	=>	$izaint['cuenta'],
				"6"	=>	$fomequeint['cuenta'],
				"7"	=>	$snAntonioint['cuenta'],
				"8"	=>	$corpint['cuenta']
			
			);
		}
		$results2 = array(
			// Informacion para el datatable
			"sEcho"=>1,
			// Envio el total de los regstros al datatable
			"iTotalRecords"=>count($data2),
			// Envio del total de registros a visualizar
			"iTotalDisplayRecords"=>count($data2),
			//Envio de los valores resultantes
			"aaData"=>$data2);
		echo json_encode($results2);

		break;
	
}
?>