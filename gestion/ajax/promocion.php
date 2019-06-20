<?php 
session_start();

require_once "../modelos/Promocion.php";

$promocion = new Promocion();

$prom_id        = isset($_POST['prom_id'])? limpiarCadena($_POST['prom_id']):"";
$prom_nom_corto	= isset($_POST['nom_corto'])? limpiarCadena($_POST['nom_corto']):"";
$prom_descrip	= isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";
$user_id 		= isset($_SESSION['usu_id']);

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($prom_id)) {
			$respuesta = $promocion->insertar(
				$prom_nom_corto, 
				$prom_descrip, 
				$user_id
			);
			echo $respuesta ? "Promoción registrada" : "La Promoción no se pudo registrar"; 
		}else{
			$respuesta = $promocion->editar(
				$prom_id, 
				$prom_nom_corto, 
				$prom_descrip, 
				$user_id
			);
			echo $respuesta ? "Promoción actualizada" : "La Promoción no se pudo actualizar"; 
		}
		break;

	case 'desactivar':
		$respuesta = $promocion->desactivar($prom_id);
		echo $respuesta ? "promocion desactivada" : "promocion no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $promocion->activar($prom_id);
		echo $respuesta ? "promocion activada" : "promocion no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $promocion->mostrar($prom_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;


	case 'sede':
		// Obtener todos los permisos de la tabla permisos
		require_once "../modelos/Sede.php";
		$sede = new Sede();
		$respuesta = $permiso->listar();

		// Obtener los permisos asignados al usuario
		$id = $_GET['id'];
		$marcados = $usuario->listamarcados($id);

		// Decalaracionde array que almacena los permisos
		$valores=array();

		// Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object()) {
			array_push($valores, $per->usu_per_permiso_id);
		}

		// Mostrar la lista de permisos en la vista y si estan marcados o no 
		while ($reg = $respuesta->fetch_object()) {
			$sw = in_array($reg->permi_id, $valores)?'checked':'';

			echo '<li> <input type="checkbox" '.$sw.' name="permiso[]" value="'.$reg->permi_id.'"> '.$reg->permi_nombre.' </li>';
		}
		
	break;	

	case 'listar':
		
		if($_GET['filtro'] == 1) 
		{
			$respuesta = $promocion->listarActivos();
		}
		else if($_GET['filtro'] == 2)
		{
			$respuesta = $promocion->listar();
		}
		else
		{
			$respuesta = $promocion->listarActivos();	
		}

		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {

			print_r($reg);
			die();
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->prom_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->prom_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->prom_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->prom_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->prom_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->prom_id,
				"2"=>$reg->prom_nombre_corto,
				"3"=>$reg->prom_descripcion,
				"4"=>$reg->prom_fecha,
				"5"=>$reg->prom_usu_id
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