<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
	// concepto_transaccion
// 
// NOMBRE DE LOS CAMPOS
	// con_tran_id
	// con_tran_area_trans_id	
	// con_tran_transaccion_id
	// con_tran_nombre
	// con_tran_descripcion
	// con_tran_estado
// 
// NOMBRE DE LOS INPUTS 
	// con_tran_id 
	// area_trans
	// transaccion
	// tran_nombre
	// descripcion
// 
// NOMBRE DE LA CLASE 
	// ConceptoTransaccion 
// 
// NOMBRE DEL AJAXtransaccion
	// conceptoTransaccion 

require_once "../modelos/ConceptoTransaccion.php";

$conceptoTransaccion = new ConceptoTransaccion();

$con_tran_id        	= isset($_POST['con_tran_id'])? limpiarCadena($_POST['con_tran_id']):"";
$con_tran_area_trans_id = isset($_POST['area_trans'])? limpiarCadena($_POST['area_trans']):"";
$con_tran_transaccion_id= isset($_POST['transaccion'])? limpiarCadena($_POST['transaccion']):"";
$con_tran_nombre        = isset($_POST['tran_nombre'])? limpiarCadena($_POST['tran_nombre']):"";
$con_tran_descripcion   = isset($_POST['descripcion'])? limpiarCadena($_POST['descripcion']):"";


switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($ali_id)) {
			$respuesta = $conceptoTransaccion->insertar(
				$con_tran_id, 
				$con_tran_area_trans_id, 
				$con_tran_transaccion_id, 
				$con_tran_nombre, 
				$con_tran_descripcion 
				
			);
			echo $respuesta ? "Alianza registrada" : "La alianza no se pudo registrar"; 
		}else{
			$respuesta = $conceptoTransaccion->editar(
				$con_tran_id, 
				$con_tran_area_trans_id, 
				$con_tran_transaccion_id, 
				$con_tran_nombre, 
				$con_tran_descripcion 
			);
			echo $respuesta ? "Alianza actualizada" : "La alianza no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $conceptoTransaccion->desactivar($con_tran_id);
		echo $respuesta ? "Concepto de transaccion desactivado" : "No es posible desactivar el concepto de la transaccion";
		break;

	case 'activar':
		$respuesta = $conceptoTransaccion->activar($con_tran_id);
		echo $respuesta ? "Concepto de transaccion activado" : "No es posible activar el concepto de la transaccion";
		break;

	case 'mostrar':
		$respuesta = $conceptoTransaccion->mostrar($con_tran_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $conceptoTransaccion->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->con_tran_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->con_tran_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->con_tran_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->con_tran_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->con_tran_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->con_tran_id,
				"2"=>$reg->con_tran_area_trans_id,
				"3"=>$reg->con_tran_transaccion_id,
				"4"=>$reg->con_tran_nombre,
				"5"=>$reg->con_tran_descripcion,
				"6"=>($reg->con_tran_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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

	case 'selectTransaccion':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/Transaccion.php';
		// Se crea un nuevo objeto de la clase requerida
		$transaccion = new Transaccion();

		$respuesta = $transaccion->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->tran_id.'>'.$reg->tran_nombre.'</option>';
		}
		break;

	case 'selectAreaTransaccion':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/AreaTransaccion.php';
		// Se crea un nuevo objeto de la clase requerida
		$areaTransaccion = new AreaTransaccion();

		$respuesta = $areaTransaccion->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->are_tran_id.'>'.$reg->are_tran_nombre.'</option>';
		}
		break;
	
}

?>