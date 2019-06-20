<?php 
// # encoded by @Francisco Monsalve

require_once "../modelos/Ciudad.php";

$ciudad = new Ciudad();

$ciu_id         	= isset($_POST['ciu_id'])? limpiarCadena($_POST['ciu_id']):"";
$ciu_nombre 		= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$ciu_departamento 	= isset($_POST['depto'])? limpiarCadena($_POST['depto']):"";
$ciu_descripcion 	= isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($ciu_id)) {
			$respuesta = $ciudad->insertar($ciu_id, $ciu_nombre, $ciu_departamento, $ciu_descripcion);
			echo $respuesta ? "Ciudad registrada" : "Ciudad no se pudo registrar"; 
		}else{
			$respuesta = $ciudad->editar($ciu_id, $ciu_nombre, $ciu_departamento, $ciu_descripcion);
			echo $respuesta ? "Ciudad actualizada" : "Ciudad no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $ciudad->desactivar($ciu_id);
		echo $respuesta ? "Ciudad desactivada" : "Ciudad no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $ciudad->activar($ciu_id);
		echo $respuesta ? "Ciudad activada" : "Ciudad no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $ciudad->mostrar($ciu_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $ciudad->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->ciu_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->ciu_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->ciu_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->ciu_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->ciu_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->ciu_nombre,
				"2"=>$reg->ciu_codigo,
				"3"=>$reg->ciu_departamento,
				"4"=>$reg->ciu_depto_codigo,
				"5"=>$reg->ciu_descripcion,
				"6"=>($reg->ciu_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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