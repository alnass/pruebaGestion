<?php
@session_start();
/// # encoded by 

// NOMBRE DE LA TABLA
// 	equipo_detalle

// CAMPOS DE LA TABLA 
/*
equi_det_equipo_id
equi_det_estado_id
equi_det_fecha_entrada
equi_det_fecha_registro
equi_det_id
equi_det_mac
equi_det_sn
equi_det_tip_equi_id
equi_det_usuario_id
*/
// NOMBRE DE LA CLASE 
// 	EquipoDetalle

// AJAX
// equipoDetalle

// NAMES DE LOS INPUTS
/*
equi_det_id
referencia
mac
serial
fecha_ingreso
estado
tipo
*/


require_once "../modelos/EquipoDetalle.php";

$equipoDetalle 			= 	new EquipoDetalle();


$equi_det_id       		=	isset($_POST['equi_det_id'])? limpiarCadena($_POST['equi_det_id']):"";
$equi_det_equipo_id		=	isset($_POST['referencia'])? limpiarCadena($_POST['referencia']):"";
$equi_det_mac 			=	isset($_POST['mac'])? limpiarCadena($_POST['mac']):"";
$equi_det_sn			=	isset($_POST['serial'])? limpiarCadena($_POST['serial']):"";
$equi_det_fecha_entrada	=	isset($_POST['fecha_ingreso'])? limpiarCadena($_POST['fecha_ingreso']):"";
$equi_det_usuario_id	= 	$_SESSION['usu_id'];
$equi_det_estado_id 	=	isset($_POST['estado'])? limpiarCadena($_POST['estado']):"";
$equi_det_remision_no 	=	isset($_POST['remisionNo'])? limpiarCadena($_POST['remisionNo']):"";
$equi_det_movimiento 	=	isset($_POST['movimiento'])? limpiarCadena($_POST['movimiento']):"";
$equipo_id 				= 	isset($_POST['equipo_id'])? limpiarCadena($_POST['equipo_id']):"";
$sede_id 				= 	isset($_POST['sede'])? limpiarCadena($_POST['sede']):"";
$ord_tras 				=	isset($_POST['orden_traslado'])? limpiarCadena($_POST['orden_traslado']):"";	


switch ($_GET["op"]) {
	case 'guardaryeditar':

		if (empty($equi_det_id)) {
			$respuesta = $equipoDetalle->insertar(
				$equi_det_id, 
				$equi_det_equipo_id, 
				$equi_det_mac, 
				$equi_det_sn,
				$equi_det_fecha_entrada,
				$equi_det_usuario_id,
				$equi_det_estado_id,
				$equi_det_remision_no,
				$equi_det_movimiento
			);
			echo $respuesta ? "Detalle de Equipo registrado" : "Detalle del equipo no se pudo registrar"; 
		}else{
			$respuesta = $equipoDetalle->editar(
				$equi_det_id, 
				$equi_det_equipo_id, 
				$equi_det_mac, 
				$equi_det_sn,
				$equi_det_fecha_entrada,
				$equi_det_usuario_id,
				$equi_det_estado_id,
				$equi_det_remision_no,
				$equi_det_movimiento
			);
			echo $respuesta ? "Detalle de Equipo actualizado" : "Detalle del equipo no se pudo actualizar";
		}
		break;

	// case 'desactivar':
	// 	$respuesta = $equipo->desactivar($equi_det_id);
	// 	echo $respuesta ? "Equipo desactivado" : "El equipo no se pudo desactivar";
	// 	break;

	// case 'activar':
	// 	$respuesta = $equipo->activar($equi_det_id);
	// 	echo $respuesta ? "Equipo activado" : "El equipo no se pudo activar";
	// 	break;

	case 'mostrar':
		$respuesta = $equipoDetalle->mostrar($equi_det_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $equipoDetalle->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		
		require_once '../modelos/Equipo.php';
		// Se crea un nuevo objeto de la clase requerida
		$equipo 		= 	new Equipo();

		require_once '../modelos/EquipoTipo.php';
		// Se crea un nuevo objeto de la clase requerida
		$equipoTipo		= 	new EquipoTipo();
		
		while ($reg = $respuesta->fetch_object()) {
			// print_r($reg);
			// die();
				
			$id_equipo 	=	$equipo->mostrar($reg->equi_det_equipo_id);
			$tipo 		=	$id_equipo['equi_tipo_id'];

			$tipoEquipo = 	$equipoTipo->mostrar($tipo);

			// print_r($tipoEquipo);
			// // die();

			if ($reg->equi_det_estado_id == 1)
			{
				$estado = '<span class="label bg-red">1-En uso</span>';
			} 
			else
				{
					if($reg->equi_det_estado_id == 2) 
					{
						$estado = '<span class="label bg-green">2-Disponible</span>';			
					}
				
				} 

			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>'<button data-toggle="tooltip" title="Editar" class="btn btn-warning" onclick="mostrar('.$reg->equi_det_id.')"><i class="fa fa-pencil"></i>
					</button><a data-toggle="modal" href="#myModal"><button data-toggle="tooltip" title="Trasladar" class="btn btn-success" onclick="mostrar('.$reg->equi_det_id.')"><i class="fa fa-share"></i></button>',
				"1"=>$reg->equi_det_mac,
				"2"=>$reg->equi_det_sn,
				"3"=>$reg->equi_det_fecha_entrada,
				"4"=>$reg->equi_det_fecha_registro,
				"5"=>$tipoEquipo['equi_tip_nombre'] .' '. $reg->equi_referencia,
				"6"=>$reg->usu_nombre,
				"7"=>$reg->sed_nombre,
				"8"=>$estado);
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

	case 'selectReferenciaEquipo':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/Equipo.php';
		
		// Se crea un nuevo objeto de la clase requerida
		$equipo 		= 	new Equipo();
		
		require_once '../modelos/EquipoTipo.php';
		$equipoTipo 	= 	new EquipoTipo();

		$respuesta 		= 	$equipo->select();
		
		while ($reg = $respuesta->fetch_object()) {

			$respuesta2		= 	$equipoTipo->selectPorId($reg->equi_tipo_id);
			$tipo 			= 	$respuesta2->fetch_object();
			echo '<option value='.$reg->equi_id.'>'.$reg->equi_referencia.' - '. $tipo->equi_tip_nombre.' - '. $reg->fab_nombre.' </option>';
		}
		break;

	case 'selectTipoMovimiento':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/EquipoDetalle.php';
		
		// Se crea un nuevo objeto de la clase requerida
		$tpmovimiento 		= 	new EquipoDetalle();
		
		$respuesta 		= 	$tpmovimiento->listarMovimiento();
		
		while ($reg = $respuesta->fetch_object()) 
		{
			echo '<option value='.$reg->mv_inv_id.'>'.$reg->mv_inv_nombre.'</option>';
		}

		break;

	case 'selectSede':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/EquipoDetalle.php';
		
		// Se crea un nuevo objeto de la clase requerida
		$sede 		= 	new EquipoDetalle();
		
		$respuesta 		= 	$sede->listarSede();
		
		while ($reg = $respuesta->fetch_object()) 
		{
			echo '<option value='.$reg->sed_id.'>'.$reg->sed_nombre.'</option>';
		}

		break;

	case 'selectEquipoEstado':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/EquipoEstado.php';
		// Se crea un nuevo objeto de la clase requerida
		$equipoEstado = new EquipoEstado();

		$respuesta = $equipoEstado->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->equi_est_id.'>'.$reg->equi_est_nombre. '</option>';
		}
		break;
			
}

?>