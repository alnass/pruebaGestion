<?php 

require_once "../modelos/SeguimientoPqr.php";

$seguimientoPqr = new SeguimientoPqr();

if (isset($_POST['reg_pqr_id'])) {
	$respuesta = $seguimientoPqr->listarseguimiento($reg_pqr_id);
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				
				"0"=>$reg->seg_id,
				"1"=>$reg->are_nombre,
				"2"=>$reg->usu_nombre." ".$reg->usu_apellido,
				"3"=>$reg->seg_fecha_envio,
				"4"=>$reg->seg_observacion
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
}elseif (isset($_GET['reg_pqr_id'])) {
	$respuesta = $seguimientoPqr->listarseguimiento($_GET['reg_pqr_id']);
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		
		while ($reg = $respuesta->fetch_object()) {
			
			$data[] = array(
				
				"0"=>$reg->seg_id,
				"1"=>$reg->are_nombre,
				"2"=>$reg->usu_nombre." ".$reg->usu_apellido,
				"3"=>$reg->seg_fecha_envio,
				"4"=>$reg->seg_observacion
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
}

 ?>