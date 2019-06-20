<?php 

require "../modelos/Apertura.php";

$apertura = new Apertura();

switch ($_GET["op"]){
	case 'listar':

		$fecha_inicio 	= $_REQUEST["fecha_inicio"];
		
		$respuesta = $apertura->listar($fecha_inicio);

		$data = Array();

		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				"0"=>$reg->log_id,
				"1"=>$reg->log_usu_fechahora,
				"2"=>$reg->usu_nombre." ".$reg->usu_apellido,
				"3"=>$reg->log_usu_usuario_id,
				"4"=>$reg->log_usu_ip,
				"5"=>$reg->sed_nombre
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