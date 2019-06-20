<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA
// 	categoria_pgr

// CAMPOS DE LA TABLA CATEGORIA
// 	cat_pqr_id
// 	cat_pqr_nombre
// 	cat_pqr_descripcion
// 	cat_pqr_tiempo_h
// 	cat_pqr_estado

// NAMES DE LOS INPUTS
// 	cat_pqr_id
// 	nombre
// 	desc
// 	tiempo

require_once "../modelos/Categoria.php";

$categoria = new Categoria();

$cat_pqr_id         = isset($_POST['cat_pqr_id'])? limpiarCadena($_POST['cat_pqr_id']):"";
$cat_pqr_nombre 	= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$cat_pqr_descripcion = isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";
$cat_pqr_tiempo_h 	= isset($_POST['tiempo'])? limpiarCadena($_POST['tiempo']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($cat_pqr_id)) {
			$respuesta = $categoria->insertar($cat_pqr_id, $cat_pqr_nombre, $cat_pqr_descripcion, $cat_pqr_tiempo_h);
			echo $respuesta ? "Categoria registrada" : "Categoria no se pudo registrar"; 
		}else{
			$respuesta = $categoria->editar($cat_pqr_id, $cat_pqr_nombre, $cat_pqr_descripcion, $cat_pqr_tiempo_h);
			echo $respuesta ? "Categoria actualizada" : "Categoria no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $categoria->desactivar($cat_pqr_id);
		echo $respuesta ? "Categoria desactivada" : "Categoria no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $categoria->activar($cat_pqr_id);
		echo $respuesta ? "Categoria activada" : "Categoria no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $categoria->mostrar($cat_pqr_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $categoria->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->cat_pqr_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->cat_pqr_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->cat_pqr_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->cat_pqr_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->cat_pqr_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->cat_pqr_nombre,
				"2"=>$reg->cat_pqr_descripcion,
				"3"=>$reg->cat_pqr_tiempo_h,
				"4"=>($reg->cat_pqr_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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