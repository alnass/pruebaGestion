<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	tipo_canal

// CAMPOS DE LA TABLA 
// 	tip_can_id
// 	tip_can_nombre
// 	tip_can_descripcion
// 	tip_can_estado

// NOMBRE DE LA CLASE 
// 	TipoCanal
	
// NAMES DE LOS INPUTS DEL FORM 
// 	tip_can_id
// 	nombre
// 	desc

// CLASE
// 	TipoCanal

// AJAX
// 	tipoCanal

require_once "../modelos/TipoCanal.php";

$tipoCanal = new TipoCanal();

$tip_can_id         = isset($_POST['tip_can_id'])? limpiarCadena($_POST['tip_can_id']):"";
$tip_can_nombre 	= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$tip_can_descripcion = isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($tip_can_id)) {
			$respuesta = $tipoCanal->insertar($tip_can_id, $tip_can_nombre, $tip_can_descripcion);
			echo $respuesta ? "Tipo de canal registrada" : "Tipo de canal no se pudo registrar"; 
		}else{
			$respuesta = $tipoCanal->editar($tip_can_id, $tip_can_nombre, $tip_can_descripcion);
			echo $respuesta ? "Tipo de canal actualizada" : "Tipo de canal no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $tipoCanal->desactivar($tip_can_id);
		echo $respuesta ? "Tipo de canal desactivada" : "Tipo de canal no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $tipoCanal->activar($tip_can_id);
		echo $respuesta ? "Tipo de canal activada" : "Tipo de canal no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $tipoCanal->mostrar($tip_can_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $tipoCanal->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->tip_can_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->tip_can_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->tip_can_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->tip_can_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->tip_can_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->tip_can_nombre,
				"2"=>$reg->tip_can_descripcion,
				"3"=>($reg->tip_can_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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