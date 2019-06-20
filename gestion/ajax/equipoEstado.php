<?php 
// session_start();
// # encoded by 

//  equi_est_id 		
//  equi_est_nombre
//  equi_est_descripcion
//  equi_est_estado		


require_once "../modelos/EquipoEstado.php";

$equipoEstado = new EquipoEstado();

$equi_est_id 			=	isset($_POST['equi_est_id'])? limpiarCadena($_POST['equi_est_id']):"";
$equi_est_nombre		=	isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$equi_est_descripcion 	=	isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($equi_est_id)) {
			$respuesta = $equipoEstado->insertar(
				$equi_est_id,
				$equi_est_nombre,
				$equi_est_descripcion
			);
			echo $respuesta ? "Estado del equipo registrado" : "Estado del equipo no se pudo registrar"; 
		}else{
			$respuesta = $equipoEstado->editar($equi_est_id, $equi_est_nombre, $equi_est_descripcion);
			echo $respuesta ? "Estado del equipo actualizado" : "Estado del equipo no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $equipoEstado->desactivar($equi_est_id);
		echo $respuesta ? "Estado del equipo desactivado" : "Estado del equipo no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $equipoEstado->activar($equi_est_id);
		echo $respuesta ? "Estado del equipo activado" : "Estado del equipo no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $equipoEstado->mostrar($equi_est_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $equipoEstado->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->equi_est_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->equi_est_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->equi_est_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->equi_est_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->equi_est_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->equi_est_nombre,
				"2"=>$reg->equi_est_descripcion,
				"3"=>($reg->equi_est_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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