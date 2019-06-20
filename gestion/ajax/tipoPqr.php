<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	tipo_pqr

// CAMPOS DE LA TABLA 
// 	tip_pqr_id
// 	tip_pqr_nombre
// 	tip_pqr_descripcion	
// 	tip_pqr_estado
	
// NAMES DE LOS INPUTS DEL FORM 
// 	tip_pqr_id
// 	nombre
// 	desc

// NOMBRE DE LA CLASE 
// 	TipoPqr

// AJAX
// 	tipoPqr

require_once "../modelos/TipoPqr.php";

$tipoPqr = new TipoPqr();

$tip_pqr_id         = isset($_POST['tip_pqr_id'])? limpiarCadena($_POST['tip_pqr_id']):"";
$tip_pqr_nombre 	= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$tip_pqr_descripcion = isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($tip_pqr_id)) {
			$respuesta = $tipoPqr->insertar($tip_pqr_id, $tip_pqr_nombre, $tip_pqr_descripcion);
			echo $respuesta ? "Tipo de PQR's registrada" : "Tipo de PQR's no se pudo registrar"; 
		}else{
			$respuesta = $tipoPqr->editar($tip_pqr_id, $tip_pqr_nombre, $tip_pqr_descripcion);
			echo $respuesta ? "Tipo de PQR's actualizada" : "Tipo de PQR's no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $tipoPqr->desactivar($tip_pqr_id);
		echo $respuesta ? "Tipo de PQR's desactivada" : "Tipo de PQR's no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $tipoPqr->activar($tip_pqr_id);
		echo $respuesta ? "Tipo de PQR's activada" : "Tipo de PQR's no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $tipoPqr->mostrar($tip_pqr_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $tipoPqr->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->tip_pqr_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->tip_pqr_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->tip_pqr_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->tip_pqr_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->tip_pqr_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->tip_pqr_nombre,
				"2"=>$reg->tip_pqr_descripcion,
				"3"=>($reg->tip_pqr_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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