<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	estado_pqr

// CAMPOS DE LA TABLA 
// 	est_pqr_id
// 	est_pqr_nombre
// 	est_pqr_descripcion
//  est_pqr_estado

// NOMBRE DE LA CLASE
// 	EstadoPqr

// AJAX
// 	estadoPqr
	
// NAMES DE LOS INPUTS DEL FORM 
// 	est_pqr_id
// 	nombre
// 	desc

require_once "../modelos/EstadoPqr.php";

$estadoPqr = new EstadoPqr();

$est_pqr_id         = isset($_POST['est_pqr_id'])? limpiarCadena($_POST['est_pqr_id']):"";
$est_pqr_nombre 	= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$est_pqr_descripcion = isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($est_pqr_id)) {
			$respuesta = $estadoPqr->insertar($est_pqr_id, $est_pqr_nombre, $est_pqr_descripcion);
			echo $respuesta ? "Estado de PQR´s registrada" : "Estado de PQR´s no se pudo registrar"; 
		}else{
			$respuesta = $estadoPqr->editar($est_pqr_id, $est_pqr_nombre, $est_pqr_descripcion);
			echo $respuesta ? "Estado de PQR´s actualizada" : "Estado de PQR´s no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $estadoPqr->desactivar($est_pqr_id);
		echo $respuesta ? "Estado de PQR´s desactivada" : "Estado de PQR´s no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $estadoPqr->activar($est_pqr_id);
		echo $respuesta ? "Estado de PQR´s activada" : "Estado de PQR´s no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $estadoPqr->mostrar($est_pqr_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $estadoPqr->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->est_pqr_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->est_pqr_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->est_pqr_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->est_pqr_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->est_pqr_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->est_pqr_nombre,
				"2"=>$reg->est_pqr_descripcion,
				"3"=>($reg->est_pqr_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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