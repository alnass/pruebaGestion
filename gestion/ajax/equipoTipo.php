<?php 
// # encoded by 

// NOMBRE DE LA TABLA
// 	equipo_tipo

/*

// CAMPOS DE LA TABLA EQUIPOTIPO
equi_tip_id int				
equi_tip_nombre	varchar(45)				
equi_tip_descripcion	varchar(256)				
equi_tip_estado	defecto = 1

*/

require_once "../modelos/EquipoTipo.php";

$equipoTipo = new EquipoTipo();

$equi_tip_id 		=	isset($_POST['equi_tip_id'])? limpiarCadena($_POST['equi_tip_id']):"";
$equi_tip_nombre	=	isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$equi_tip_descripcion 	=	isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($equi_tip_id)) {
			$respuesta = $equipoTipo->insertar($equi_tip_id, $equi_tip_nombre, $equi_tip_descripcion);
			echo $respuesta ? "Tipo de equipo registrado" : "Tipo de equipo no se pudo registrar"; 
		}else{
			$respuesta = $equipoTipo->editar($equi_tip_id, $equi_tip_nombre, $equi_tip_descripcion);
			echo $respuesta ? "Tipo de equipo actualizado" : "Tipo de equipo no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $equipoTipo->desactivar($equi_tip_id);
		echo $respuesta ? "Tipo de equipo desactivado" : "Tipo de equipo no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $equipoTipo->activar($equi_tip_id);
		echo $respuesta ? "Tipo de equipo activado" : "Tipo de equipo no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $equipoTipo->mostrar($equi_tip_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $equipoTipo->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->equi_tip_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->equi_tip_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->equi_tip_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->equi_tip_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->equi_tip_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->equi_tip_nombre,
				"2"=>$reg->equi_tip_descripcion,
				"3"=>($reg->equi_tip_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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