<?php 
/// # encoded by 

// NOMBRE DE LA TABLA
// 	equipo

// CAMPOS DE LA TABLA 
/*

//  equi_id 		
//  equi_referencia
//  equi_tipo_id	
//  equi_descripcion		
//  equi_fabricante_id_id		
//  equi_estado
*/

// NOMBRE DE LA CLASE 
// 	Equipo

// AJAX
// equipo

// NAMES DE LOS INPUTS
// 	equi_id
// 	referencia
// 	tipoequipo
// 	descripcion
// 	fabricante
// 	estado


require_once "../modelos/Equipo.php";

$equipo = new Equipo();

$equi_id         	= isset($_POST['equi_id'])? limpiarCadena($_POST['equi_id']):"";
$equi_referencia 	= isset($_POST['referencia'])? limpiarCadena($_POST['referencia']):"";
$equipo_tipo_id		= isset($_POST['tipoequipo'])? limpiarCadena($_POST['tipoequipo']):"";
$descripcion 	 	= isset($_POST['descripcion'])? limpiarCadena($_POST['descripcion']):"";
$fabricante_id 		= isset($_POST['fabricante'])? limpiarCadena($_POST['fabricante']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($equi_id)) {
			$respuesta = $equipo->insertar(
				$equi_id, 
				$equi_referencia, 
				$equipo_tipo_id, 
				$descripcion,
				$fabricante_id
			);
			echo $respuesta ? "Equipo registrado" : "El equipo no se pudo registrar"; 
		}else{
			$respuesta = $equipo->editar(
				$equi_id, 
				$equi_referencia, 
				$equipo_tipo_id, 
				$descripcion,
				$fabricante_id
			);
			echo $respuesta ? "Equipo actualizado" : "El equipo no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $equipo->desactivar($equi_id);
		echo $respuesta ? "Equipo desactivado" : "El equipo no se pudo desactivar";
		break;

	case 'activar':
		$respuesta = $equipo->activar($equi_id);
		echo $respuesta ? "Equipo activado" : "El equipo no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $equipo->mostrar($equi_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $equipo->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();

		// LLAMA LA FUNCION PARA CONTAR LOS ITEMS ALMACENADOS
		require_once '../modelos/EquipoDetalle.php';

		$equipoDetalle 	= 	new EquipoDetalle();



		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {

			$contarItems 	= 	$equipoDetalle->contarItems($reg->equi_id);			

			$contarItems = implode('', $contarItems);
			// print_r($contarItems);
			// $probar  	= 	$contarItems;

			// die();

			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->equi_estado)?'<button title="Editar" data-toggle="tooltip" title="Editar equipo." class="btn btn-warning" onclick="mostrar('.$reg->equi_id.')"><i class="fa fa-pencil"></i></button>'." ".'<a data-toggle="modal" href="#myModal"><button  title="Agregar Item" data-toggle="tooltip" title="Agregar Item" class="btn btn-info"><i class="fa fa-plus-circle"></i></button>'." ".	'<button  title="Desactivar" data-toggle="tooltip" title="Desactivar" class="btn btn-danger" onclick="desactivar('.$reg->equi_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->equi_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" title="Activar" onclick="activar('.$reg->equi_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->equi_referencia,
				"2"=>$reg->equi_tip_nombre,
				"3"=>$reg->equi_descripcion,
				"4"=>$reg->fab_nombre,
				"5"=>$contarItems,
				"6"=>($reg->equi_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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

		case 'slectTipoEquipo':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/EquipoTipo.php';
		// Se crea un nuevo objeto de la clase requerida
		$equipoTipo = new EquipoTipo();

		$respuesta = $equipoTipo->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->equi_tip_id.'>'.$reg->equi_tip_nombre.'</option>';
		}
		break;

		case 'selectFabricante':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/Fabricante.php';
		// Se crea un nuevo objeto de la clase requerida
		$fabricante = new Fabricante();

		$respuesta = $fabricante->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->fab_id.'>'.$reg->fab_nombre." - Tel. ".$reg->fab_telefono.'</option>';
		}
		break;	

			
}

?>