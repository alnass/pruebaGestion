<?php 
/// # encoded by 

// NOMBRE DE LA TABLA
// 	fabricante

// CAMPOS DE LA TABLA 
/*

fab_id int
fab_nombre	varchar
fab_tip_doc_id	int
fab_documento	bigint
fab_direccion	varchar
fab_telefono	varchar
fab_estado 		tinyint
tip_doc_nombre
ciu_nombre
*/

// NOMBRE DE LA CLASE 
// 	Fabricante 

// AJAX
// fabricante

// NAMES DE LOS INPUTS
// 	fab_id
// 	nombre
// 	tip_doc_id
// 	documento
// 	direccion
// 	telefono


require_once "../modelos/Fabricante.php";

$fabricante = new Fabricante();

$fab_id         	= isset($_POST['fab_id'])? limpiarCadena($_POST['fab_id']):"";
$fab_nombre 		= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$fab_tip_doc_id		= isset($_POST['tipoDoc'])? limpiarCadena($_POST['tipoDoc']):"";
$fab_documento 	 	= isset($_POST['documento'])? limpiarCadena($_POST['documento']):"";
$fab_direccion 		= isset($_POST['direccion'])? limpiarCadena($_POST['direccion']):"";
$fab_telefono 		= isset($_POST['telefono'])? limpiarCadena($_POST['telefono']):"";
$fab_ciu_id 		= isset($_POST['ciudad'])? limpiarCadena($_POST['ciudad']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($fab_id)) {
			$respuesta = $fabricante->insertar(
				$fab_id, 
				$fab_nombre, 
				$fab_tip_doc_id, 
				$fab_documento,
				$fab_direccion,
				$fab_telefono,
				$fab_ciu_id
			);
			echo $respuesta ? "Fabricante registrado" : "fabricante no se pudo registrar"; 
		}else{
			$respuesta = $fabricante->editar(
				$fab_id, 
				$fab_nombre, 
				$fab_tip_doc_id, 
				$fab_documento,
				$fab_direccion,
				$fab_telefono,
				$fab_ciu_id
			);
			echo $respuesta ? "fabricante actualizado" : "fabricante no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $fabricante->desactivar($fab_id);
		echo $respuesta ? "fabricante desactivada" : "fabricante no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $fabricante->activar($fab_id);
		echo $respuesta ? "fabricante activado" : "fabricante no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $fabricante->mostrar($fab_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $fabricante->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->fab_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->fab_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->fab_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->fab_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->fab_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->fab_nombre,
				"2"=>$reg->tip_doc_nombre,
				"3"=>$reg->fab_documento,
				"4"=>$reg->fab_direccion,
				"5"=>$reg->fab_telefono,
				"6"=>$reg->ciu_nombre,
				"7"=>$reg->fab_estado,
				"8"=>($reg->fab_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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

		// case 'slectTipoEquipo':
		// // Se requiere la clase que va  mostrar en el select
		// require_once '../modelos/EquipoTipo.php';
		// // Se crea un nuevo objeto de la clase requerida
		// $equipoTipo = new EquipoTipo();

		// $respuesta = $equipoTipo->select();
		// while ($reg = $respuesta->fetch_object()) {
		// 	echo '<option value='.$reg->equi_tip_id.'>'.$reg->equi_tip_nombre.'</option>';
		// }
		// break;

		case 'slectCategoria':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/Ciudad.php';
		// Se crea un nuevo objeto de la clase requerida
		$ciudad = new Ciudad();

		$respuesta = $ciudad->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->ciu_id.'>'.$reg->ciu_nombre." - ".$reg->ciu_departamento.'</option>';
		}
		break;	

			
}

?>