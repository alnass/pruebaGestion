<?php 
session_start();
// # encoded by @Francisco Monsalve


require_once "../modelos/Consultas.php";

$consultas = new Consultas();

$hoy = isset($_POST['fecha'])? limpiarCadena($_POST['fecha']):"";


switch ($_GET["op"]) {
	case 'pqrfecha':

		$fecha_inicio 	= $_REQUEST["fecha_inicio"];
		$fecha_fin 		= $_REQUEST["fecha_fin"];

		$respuesta = $consultas->pqrfecha($fecha_inicio, $fecha_fin);
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
			
				"0"=>$reg->reg_pqr_id,
				"1"=>$reg->can_nombre,
				"2"=>$reg->tip_can_nombre,
				"3"=>$reg->prod_nombre,
				"4"=>$reg->tip_pqr_nombre,
				"5"=>$reg->cat_pqr_nombre,
				"6"=>$reg->per_num_documento,
				"7"=>$reg->per_nombre,
				"8"=>$reg->per_apellido,
				"9"=>$reg->reg_pqr_num_radicado,
				"10"=>$reg->reg_pqr_fecha_inicio,
				"11"=>$reg->reg_pqr_fecha_fin,
				"12"=>$reg->reg_pqr_ticket_interno,
				"13"=>$reg->usu_nombre.' '.$reg->usu_apellido,
				"14"=>$reg->reg_pqr_dias_respuesta,
				"15"=>$reg->reg_pqr_observacion,
				"16"=>$reg->est_pqr_nombre
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

	case 'consultapagosefectivohoy':

		$fecha_inicio 	= $_REQUEST["fecha_inicio"];
		$fecha_fin 		= $_REQUEST["fecha_fin"];


		$respuesta = $consultas->consultapagosefectivohoy($fecha_inicio, $fecha_fin);
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
			
				"0"=>$reg->est_cta_fecha_transacc,
				"1"=>$reg->per_nombre.' '.$reg->per_apellido,
				"2"=>$reg->con_tran_nombre,
				"3"=>'$'.$reg->est_cta_debe,
				"4"=>$reg->usu_nombre.' '.$reg->usu_apellido
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

	case 'totalefectivo':

		$fecha_inicio 	= $_REQUEST["fecha_inicio"];
		$fecha_fin 		= $_REQUEST["fecha_fin"];

		$respuesta = $consultas->totalefectivo($fecha_inicio, $fecha_fin);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;
		
	case 'totaledescuento':

		$fecha_inicio 	= $_REQUEST["fecha_inicio"];
		$fecha_fin 		= $_REQUEST["fecha_fin"];

		$respuesta = $consultas->totaledescuento($fecha_inicio, $fecha_fin);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'efectivoensedes':

		$fecha_inicio 	= $_REQUEST["fecha_inicio"];
		$fecha_fin 		= $_REQUEST["fecha_fin"];


		$respuesta = $consultas->efectivoensedes($fecha_inicio, $fecha_fin);
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
			
				"0"=>$reg->sed_nombre,
				"1"=>$reg->ciu_nombre,
				"2"=>$reg->registros,
				"3"=>'$'.number_format($reg->efectivo),
				
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
}

?>