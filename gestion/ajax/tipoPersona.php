<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	tipo_persona

// CAMPOS DE LA TABLA 
// 	tip_per_id
// 	tip_per_nombre
// 	tip_per_descripcion
// 	tip_per_estado

// NOMBRE DE LA CLASE 
// 	TipoPersona
	
// NAMES DE LOS INPUTS DEL FORM 
// 	tip_per_id
// 	nombre
// 	desc

require_once "../modelos/TipoPersona.php";

$tipoPersona = new TipoPersona();

$tip_per_id         = isset($_POST['tip_per_id'])? limpiarCadena($_POST['tip_per_id']):"";
$tip_per_nombre 	= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$tip_per_descripcion = isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($tip_per_id)) {
			$respuesta = $tipoPersona->insertar($tip_per_id, $tip_per_nombre, $tip_per_descripcion);
			echo $respuesta ? "Tipo de Persona registrada" : "Tipo de Persona no se pudo registrar"; 
		}else{
			$respuesta = $tipoPersona->editar($tip_per_id, $tip_per_nombre, $tip_per_descripcion);
			echo $respuesta ? "Tipo de Persona actualizada" : "Tipo de Persona no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $tipoPersona->desactivar($tip_per_id);
		echo $respuesta ? "Tipo de Persona desactivada" : "Tipo de Persona no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $tipoPersona->activar($tip_per_id);
		echo $respuesta ? "Tipo de Persona activada" : "Tipo de Persona no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $tipoPersona->mostrar($tip_per_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $tipoPersona->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->tip_per_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->tip_per_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->tip_per_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->tip_per_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->tip_per_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->tip_per_nombre,
				"2"=>$reg->tip_per_descripcion,
				"3"=>($reg->tip_per_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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