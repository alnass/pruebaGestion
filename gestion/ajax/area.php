<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	area

// CAMPOS DE LA TABLA 
// 	are_id
// 	are_nombre
// 	are_descripcion
//  are_correo
// 	are_estado

// NOMBRE DE LA CLASE
// 	Area 
	
// NAMES DE LOS INPUTS DEL FORM 
// 	are_id
// 	nombre
// 	desc
//  correo

require_once "../modelos/Area.php";

$area = new Area();

$are_id         = isset($_POST['are_id'])? limpiarCadena($_POST['are_id']):"";
$are_nombre 	= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$are_descripcion = isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";
$are_correo		= isset($_POST['correo'])? limpiarCadena($_POST['correo']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($are_id)) {
			$respuesta = $area->insertar($are_id, $are_nombre, $are_descripcion, $are_correo);
			echo $respuesta ? "Area registrada" : "Area no se pudo registrar"; 
		}else{
			$respuesta = $area->editar($are_id, $are_nombre, $are_descripcion, $are_correo);
			echo $respuesta ? "Area actualizada" : "Area no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $area->desactivar($are_id);
		echo $respuesta ? "Area desactivada" : "Area no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $area->activar($are_id);
		echo $respuesta ? "Area activada" : "Area no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $area->mostrar($are_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $area->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {

			$botones = null;

			if ($reg->are_id == 5) {
				
				$botones = $botones = '<button  class="btn btn-basic" onclick="bloq()"><i class="fa fa-lock"></i></button>';
			}else{
				if ($reg->are_estado) {
					$botones = '<button  class="btn btn-warning" onclick="mostrar('.$reg->are_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->are_id.')"><i class="fa fa-close"></i></button>';
				}else{
					$botones = '<button  class="btn btn-warning" onclick="mostrar('.$reg->are_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->are_id.')"><i class="fa fa-check"></i></button>';
				}
			}


			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				// "0"=>($reg->are_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->are_id.')"><i class="fa fa-pencil"></i></button>'." ".
				// 	'<button  class="btn btn-danger" onclick="desactivar('.$reg->are_id.')"><i class="fa fa-close"></i></button>':
				// 	'<button  class="btn btn-warning" onclick="mostrar('.$reg->are_id.')"><i class="fa fa-pencil"></i></button>'." ".
				// 	'<button  class="btn btn-primary" onclick="activar('.$reg->are_id.')"><i class="fa fa-check"></i></button>',
				"0"=>$botones,
				"1"=>$reg->are_nombre,
				"2"=>$reg->are_descripcion,
				"3"=>$reg->are_correo,
				"4"=>($reg->are_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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