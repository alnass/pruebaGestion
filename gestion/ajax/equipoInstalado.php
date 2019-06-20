<?php session_start();
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


switch ($_GET["op"]) {
	case 'guardaryeditar':
	// print_r($_POST);
	// die();
		if (empty($equi_det_id)) {
			$respuesta = $equipoDetalle->insertar(
				$equi_det_id, 
				$equi_det_equipo_id, 
				$equi_det_mac, 
				$equi_det_sn,
				$equi_det_fecha_entrada,
				$equi_det_usuario_id,
				$equi_det_estado_id
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
				$equi_det_estado_id
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
		$respuesta = $equipoDetalle->listarInstalados();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		

		require_once '../modelos/Equipo.php';
		// Se crea un nuevo objeto de la clase requerida
		$equipo 		= 	new Equipo();

		require_once '../modelos/EquipoTipo.php';
		// Se crea un nuevo objeto de la clase requerida
		$equipoTipo		= 	new EquipoTipo();

		$numeracion 	= 	0;
		
		while ($reg = $respuesta->fetch_object()) {
			// print_r($reg);
			// die();
				
			$id_equipo 	=	$equipo->mostrar($reg->equi_det_equipo_id);
			$tipo 		=	$id_equipo['equi_tipo_id'];

			$tipoEquipo = 	$equipoTipo->mostrar($tipo);

			// print_r($tipoEquipo);
			// // die();
			if($reg->ot_equi_propiedad == 1)
			{
				$propiedad 	=	'COMODATO';
			}
			else
			{
				$propiedad 	=	'CLIENTE';
			}

			$numeracion++;

			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>$numeracion,
				"1"=>$reg->equi_referencia,
				"2"=>$reg->equi_det_mac,
				"3"=>$reg->equi_det_sn,
				"4"=>$reg->ot_equi_fecha_registro,
				"5"=>$reg->usu_nombre,
				"6"=>$tipoEquipo['equi_tip_nombre'],
				"7"=>$reg->per_nombre .' '. $reg->per_apellido,
				"8"=>$reg->cont_no_contrato .'-'. $reg->ord_trab_contrato_id,
				"9"=>$propiedad
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
			echo '<option value='.$reg->equi_id.'>'.$reg->equi_referencia.' - '. $tipo->equi_tip_nombre.'</option>';
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