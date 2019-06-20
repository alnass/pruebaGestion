<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	tipo_documento

// CAMPOS DE LA TABLA 
// 	tip_doc_id
// 	tip_doc_nombre
// 	tip_doc_descripcion
// 	tip_doc_estado

// NOMBRE DE LA CLASE 
// 	TipoDocumento
	
// NAMES DE LOS INPUTS DEL FORM 
// 	tip_doc_id
// 	nombre
// 	desc

// AJAX
// 	tipoDocumento

require_once "../modelos/TipoDocumento.php";

$tipoDocumento = new TipoDocumento();

$tip_doc_id         = isset($_POST['tip_doc_id'])? limpiarCadena($_POST['tip_doc_id']):"";
$tip_doc_nombre 	= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$tip_doc_descripcion = isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($tip_doc_id)) {
			$respuesta = $tipoDocumento->insertar($tip_doc_id, $tip_doc_nombre, $tip_doc_descripcion);
			echo $respuesta ? "Tipo de docuemento registrada" : "Tipo de docuemento no se pudo registrar"; 
		}else{
			$respuesta = $tipoDocumento->editar($tip_doc_id, $tip_doc_nombre, $tip_doc_descripcion);
			echo $respuesta ? "Tipo de docuemento actualizada" : "Tipo de docuemento no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $tipoDocumento->desactivar($tip_doc_id);
		echo $respuesta ? "Tipo de docuemento desactivada" : "Tipo de docuemento no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $tipoDocumento->activar($tip_doc_id);
		echo $respuesta ? "Tipo de docuemento activada" : "Tipo de docuemento no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $tipoDocumento->mostrar($tip_doc_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $tipoDocumento->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->tip_doc_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->tip_doc_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->tip_doc_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->tip_doc_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->tip_doc_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->tip_doc_nombre,
				"2"=>$reg->tip_doc_descripcion,
				"3"=>($reg->tip_doc_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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