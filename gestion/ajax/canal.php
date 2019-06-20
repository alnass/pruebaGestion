<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	canal

// CAMPOS DE LA TABLA 
// 	can_id
// 	can_nombre
// 	can_descripcion
// 	can_estado
	
// NAMES DE LOS INPUTS DEL FORM 
// 	can_id
// 	nombre
// 	desc

// CLASE
// 	Canal

// AJAX
// 	canal

require_once "../modelos/Canal.php";

$canal = new Canal();

$can_id         = isset($_POST['can_id'])? limpiarCadena($_POST['can_id']):"";
$can_nombre 	= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$can_descripcion = isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($can_id)) {
			$respuesta = $canal->insertar($can_id, $can_nombre, $can_descripcion);
			echo $respuesta ? "Tipo de canal registrado" : "Tipo de canal no se pudo registrar"; 
		}else{
			$respuesta = $canal->editar($can_id, $can_nombre, $can_descripcion);
			echo $respuesta ? "Tipo de canal actualizada" : "Tipo de canal no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $canal->desactivar($can_id);
		echo $respuesta ? "Tipo de canal desactivado" : "Tipo de canal no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $canal->activar($can_id);
		echo $respuesta ? "Tipo de canal activado" : "Tipo de canal no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $canal->mostrar($can_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $canal->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->can_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->can_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->can_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->can_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->can_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->can_nombre,
				"2"=>$reg->can_descripcion,
				"3"=>($reg->can_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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