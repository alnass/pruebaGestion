<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	cargo

// CAMPOS DE LA TABLA 
// 	car_id
// 	car_nombre
// 	car_descripcion
// 	car_estado

// NOMBRE DE LA CLASE 
// 	Cargo

// AJAX
// 	cargo 
	
// NAMES DE LOS INPUTS DEL FORM 
// 	car_id
// 	nombre
// 	desc

require_once "../modelos/Cargo.php";

$cargo = new Cargo();

$car_id         = isset($_POST['car_id'])? limpiarCadena($_POST['car_id']):"";
$car_nombre 	= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$car_descripcion = isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($car_id)) {
			$respuesta = $cargo->insertar($car_id, $car_nombre, $car_descripcion);
			echo $respuesta ? "Cargo registrado" : "Cargo no se pudo registrar"; 
		}else{
			$respuesta = $cargo->editar($car_id, $car_nombre, $car_descripcion);
			echo $respuesta ? "Cargo actualizado" : "Cargo no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $cargo->desactivar($car_id);
		echo $respuesta ? "Cargo desactivado" : "Cargo no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $cargo->activar($car_id);
		echo $respuesta ? "Cargo activado" : "Cargo no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $cargo->mostrar($car_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $cargo->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->car_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->car_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->car_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->car_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->car_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->car_nombre,
				"2"=>$reg->car_descripcion,
				"3"=>($reg->car_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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