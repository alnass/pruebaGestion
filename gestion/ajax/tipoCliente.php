<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	tipo_cliente	

// CAMPOS DE LA TABLA 
// 	tip_cli_id
// 	tip_cli_nombre
// 	tip_cli_descripcion
// 	tip_cli_estado

// NOMBRE DE LA CLASE
// 	TipoCliente

// NAMES DE LOS INPUTS DE FORM 
// 	tip_cli_id
// 	nombre
// 	desc

require_once "../modelos/TipoCliente.php";

$TipoCliente = new TipoCliente();

$tip_cli_id         = isset($_POST['tip_cli_id'])? limpiarCadena($_POST['tip_cli_id']):"";
$tip_cli_nombre 	= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$tip_cli_descripcion = isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($tip_cli_id)) {
			$respuesta = $TipoCliente->insertar($tip_cli_id, $tip_cli_nombre, $tip_cli_descripcion);
			echo $respuesta ? "Tipo de cliente registrada" : "Tipo de cliente no se pudo registrar"; 
		}else{
			$respuesta = $TipoCliente->editar($tip_cli_id, $tip_cli_nombre, $tip_cli_descripcion);
			echo $respuesta ? "Tipo de cliente actualizada" : "Tipo de cliente no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $TipoCliente->desactivar($tip_cli_id);
		echo $respuesta ? "Tipo de cliente desactivada" : "Tipo de cliente no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $TipoCliente->activar($tip_cli_id);
		echo $respuesta ? "Tipo dePersona activada" : "Tipo de cliente no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $TipoCliente->mostrar($tip_cli_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $TipoCliente->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->tip_cli_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->tip_cli_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->tip_cli_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->tip_cli_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->tip_cli_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->tip_cli_nombre,
				"2"=>$reg->tip_cli_descripcion,
				"3"=>($reg->tip_cli_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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