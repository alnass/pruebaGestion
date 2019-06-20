<?php 
// # encoded by @Francisco Monsalve

require_once "../modelos/Permiso.php";

$permiso = new Permiso();

switch ($_GET["op"]) {
	
	case 'listar':
		$respuesta = $permiso->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>$reg->permi_nombre,
				"1"=>$reg->permi_descripcion
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