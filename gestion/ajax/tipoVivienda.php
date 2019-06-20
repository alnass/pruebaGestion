<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	tipo_vivienda

// CAMPOS DE LA TABLA 
// 	tip_viv_id
// 	tip_viv_nombre
// 	tip_viv_descripcion
// 	tip_viv_estado

// NOMBRE DE LA CLASE 
// 	TipoVivienda
	
// NAMES DE LOS INPUTS DEL FORM 
// 	tip_viv_id
// 	nombre
// 	desc

// AJAX
// 	tipoVivienda

require_once "../modelos/TipoVivienda.php";

$tipoVivienda = new TipoVivienda();

$tip_viv_id         = isset($_POST['tip_viv_id'])? limpiarCadena($_POST['tip_viv_id']):"";
$tip_viv_nombre 	= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$tip_viv_descripcion = isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($tip_viv_id)) {
			$respuesta = $tipoVivienda->insertar($tip_viv_id, $tip_viv_nombre, $tip_viv_descripcion);
			echo $respuesta ? "Tipo de vivienda registrada" : "Tipo de vivienda no se pudo registrar"; 
		}else{
			$respuesta = $tipoVivienda->editar($tip_viv_id, $tip_viv_nombre, $tip_viv_descripcion);
			echo $respuesta ? "Tipo de vivienda actualizada" : "Tipo de vivienda no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $tipoVivienda->desactivar($tip_viv_id);
		echo $respuesta ? "Tipo de vivienda desactivada" : "Tipo de vivienda no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $tipoVivienda->activar($tip_viv_id);
		echo $respuesta ? "Tipo de vivienda activada" : "Tipo de vivienda no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $tipoVivienda->mostrar($tip_viv_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $tipoVivienda->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->tip_viv_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->tip_viv_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->tip_viv_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->tip_viv_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->tip_viv_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->tip_viv_nombre,
				"2"=>$reg->tip_viv_descripcion,
				"3"=>($reg->tip_viv_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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