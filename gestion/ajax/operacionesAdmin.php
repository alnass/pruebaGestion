<?php 
session_start();
require '../modelos/OperacionesAdmin.php';

$cierre_id   = isset($_POST['cierre_id'])? limpiarCadena($_POST['cierre_id']):"";
$mes         = isset($_POST['mes'])? limpiarCadena($_POST['mes']):"";
$anio        = isset($_POST['anio'])? limpiarCadena($_POST['anio']):"";

$operacionesAdmin = new OperacionesAdmin();

switch ($_GET['op']) {
	case 'listarsede':

		$respuesta = $operacionesAdmin->listarsede();
		$data = Array();

		while ($res = $respuesta->fetch_object()) {

			$sede_id = $res->cierre;

			$sql = "SELECT 
		 	cf.cie_fin_usuario_id,
		 	cf.cie_fin_sede_id,
		 	cf.cie_fin_fecha,
		 	cf.cie_fin_estado,
		 	s.sed_id,
		 	s.sed_nombre,
		 	u.usu_id,
		 	u.usu_nombre,
		 	u.usu_apellido
		 	FROM cierre_final cf
		 	INNER JOIN sede s 
		 	ON cf.cie_fin_sede_id = s.sed_id
		 	INNER JOIN usuario_log u 
		 	ON cf.cie_fin_usuario_id = u.usu_id
		 	WHERE cie_fin_id = '$sede_id' 
		 	";

		 	$infsede = ejecutarConsultaSimpleFila($sql);

		 	$caja_estado 	= $infsede['cie_fin_estado'];
		 	$sede_id 		= $infsede['sed_id'];
		 	$sede_nombre 	= $infsede['sed_nombre'];
		 	$fecha_cierre	= $infsede['cie_fin_fecha'];
		 	$usu_nombre		= $infsede['usu_nombre'];
		 	$usu_apellido	= $infsede['usu_apellido'];


			if ($caja_estado == 1) {
				$estadocaja = '<span class="label bg-green">Abierto</span>';
				$nuevoestado = '<button  class="btn btn-danger" data-toggle="tooltip" data-placement="right" title="Desactivar recaudo" onclick="desactivarrecaudo('.$res->cierre.')"><i class="fa fa-times-circle-o"></i></button>';
			}elseif ($caja_estado == 0) {
				$estadocaja = '<span class="label bg-red">Cerrado</span>';
				$nuevoestado = '<button  class="btn btn-success" data-toggle="tooltip" data-placement="right" title="Activar recaudo" onclick="activarrecaudo('.$res->cierre.')"><i class="fa fa-check-circle-o"></i></button>';
			}

			$data[] = array(
				"0"=>$estadocaja,
				"1"=>$res->cierre,
				"2"=>$sede_id,
				"3"=>$sede_nombre,
				"4"=>$fecha_cierre,
				"5"=>$usu_nombre." ".$usu_apellido,
				"6"=>$nuevoestado
	
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

	case 'activarrecaudo':
		
		$respuesta = $operacionesAdmin->activarrecaudo($cierre_id);
		echo $respuesta?"Se ha activado el modulo de recaudo correctamente":"No ha sido posible activar el modulo de recaudo";

		break;

	case 'desactivarrecaudo':
		
		$respuesta = $operacionesAdmin->desactivarrecaudo($cierre_id);
		echo $respuesta?"Se ha desactivado el modulo de recaudo correctamente":"No ha sido posible desactivar el modulo de recaudo";

		break;

	case 'facturar':

		$respuesta = $operacionesAdmin->facturar($mes, $anio);
		$operacionesAdmin->control_impr_cuentas(0, $_SESSION['usu_id']);
		echo $respuesta?"Se han cargado las facuras exitosamente":"no hay nada";
		
		break;

	case 'se_listar':
		
		$respuesta = $operacionesAdmin->se_listar();

		$data = Array();

		while ($reg = $respuesta->fetch_object()) {
				if ($reg->cc_est_ser_estado_id == 0){

				$estadoservicio = 'Valor 0 (cero) Contrato_Estado en BD´s - No válido';
				}
				elseif ($reg->cc_est_ser_estado_id == 1) {
					$estadoservicio = '<span class="label bg-yellow">Por instalar</span>';
				}
				elseif ($reg->cc_est_ser_estado_id == 2) {
					$estadoservicio = '<span class="label bg-green">Activo</span>';
				}
				elseif ($reg->cc_est_ser_estado_id == 3) {
					$estadoservicio = '<span class="label bg-red">Por Cortar</span>';
				}
				elseif ($reg->cc_est_ser_estado_id == 4) {
					$estadoservicio = '<span class="label bg-black">Cortado</span>';
				}
				elseif ($reg->cc_est_ser_estado_id == 5) {
					$estadoservicio = '<span class="label bg-blue">Por reconectar</span>';
				}
				elseif ($reg->cc_est_ser_estado_id == 6) {
					$estadoservicio = '<span class="label bg-gray">Suspendido</span>';
				}
				elseif ($reg->cc_est_ser_estado_id == 7) {
					$estadoservicio = '<span class="label bg-orange">Reco - susp</span>';
				}
				elseif ($reg->cc_est_ser_estado_id == 8){
					$estadoservicio = '<span class="label bg-purple">Por suspender</span>';
				}
				elseif ($reg->cc_est_ser_estado_id == 9){
					$estadoservicio = '<span class="label bg-gray">Mantenimiento</span>';
				}
				elseif ($reg->cc_est_ser_estado_id == 10){
					$estadoservicio = '<span class="label bg-gray">Retirado</span>';
				}
				elseif ($reg->cc_est_ser_estado_id == 11){
					$estadoservicio = '<span class="label bg-black">Corte por retiro</span>';
				}
				elseif ($reg->cc_est_ser_estado_id == 12){
					$estadoservicio = '<span class="label bg-black">Por traslado</span>';
				}
				elseif ($reg->cc_est_ser_estado_id == 13){
					$estadoservicio = '<span class="label bg-black">Pago realizado</span>';
				}
				elseif ($reg->cc_est_ser_estado_id == 14){
					$estadoservicio = 'Error ST1002';
				}

			$data[] = array(

				"0"=>$reg->cont_no_contrato.'-'.$reg->cc_est_ser_contrato_id,
				"1"=>$reg->per_nombre.' '.$reg->per_apellido,
				"2"=>$reg->per_num_documento,
				"3"=>$estadoservicio,
				"4"=>$reg->cc_est_ser_fecha,
				"5"=>$reg->usu_nombre." ".$reg->usu_apellido
				
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

	case 'listarpostcierre':

		$fecha_inicio 	= $_REQUEST["fecha_inicio"];
		$fecha_fin 		= $_REQUEST["fecha_fin"];
		
		$respuesta = $operacionesAdmin->listarpostcierre($fecha_inicio, $fecha_fin);

		$data = Array();

		while ($reg = $respuesta->fetch_object()) {

			$contrato = $reg->cont_id;

			$sqlsaldos = "SELECT *	FROM estado_cuenta_fin
						WHERE est_cta_contrato_id = '$contrato'
						ORDER BY est_cta_id DESC 
						LIMIT 1
						";
			$saldos = ejecutarConsultaSimpleFila($sqlsaldos);

			$saldoanterior 	= $saldos['est_cta_saldo_anterior']; 
			$saldoactual 	= $saldos['est_cta_saldo_actual'];

			if ($reg->cont_estado_servicio_id == 0) {
				$estadoservicio = 'Error ST1001';
			}
			elseif ($reg->cont_estado_servicio_id == 1) {
				$estadoservicio = '<span class="label bg-yellow">Por instalar</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 2) {
				$estadoservicio = '<span class="label bg-green">Activo</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 3) {
				$estadoservicio = '<span class="label bg-red">Por Cortar</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 4) {
				$estadoservicio = '<span class="label bg-black">Cortado</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 5) {
				$estadoservicio = '<span class="label bg-blue">Por reconectar</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 6) {
				$estadoservicio = '<span class="label bg-gray">Suspendido</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 7) {
				$estadoservicio = '<span class="label bg-orange">Reco - Susp</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 8){
				$estadoservicio = '<span class="label bg-purple">Por suspender</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 9){
				$estadoservicio = '<span class="label bg-gray">Mantenimiento</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 10) {
				$estadoservicio = '<span class="label bg-gray">Retirado</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 11) {
				$estadoservicio = '<span class="label bg-gray">Corte por retiro</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 12) {
				$estadoservicio = '<span class="label bg-red">Por traslado</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 13) {
				$estadoservicio = '<span class="label bg-red">Pago Realizado</span>';	
			}
			elseif($reg->cont_estado_servicio_id >= 14){
				$estadoservicio = 'Error ST1002';
			}

			$ultimohaber = $operacionesAdmin->ultimohaber($reg->cont_id);

			$data[] = array(

				"0"=> '<button  class="btn btn-warning" data-toggle="tooltip" data-placement="right" title="Nuevo registro a cuenta" onclick="listarestadocuenta('.$reg->cont_id.')"><i class="fa fa-search"></i></button>',
				"1"=> $reg->cont_no_contrato."-".$reg->cont_id,
				"2"=> $reg->cc_est_ser_fecha,
				"3"=> $reg->per_nombre." ".$reg->per_apellido,
				"4"=> $reg->per_num_documento,
				"5"=> "$".number_format($reg->cont_valor_total_mes),
				"6"=> "$".number_format($saldoanterior),
				"7"=> "$".number_format($saldoactual),
				"8"=> $ultimohaber['est_cta_observacion'],
				"9"=> $estadoservicio			
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

	case 'listarcontrato':
		$respuesta = $operacionesAdmin->listarcontrato();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			// Identificador de permanencia
			$perm = "";
			if ($reg->cont_permanencia == 1) {
				$perm = "SI";
			}elseif($reg->cont_permanencia == 0){
				$perm = "NO";
			}else{
				$perm = "Error";
			}

			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>'<a href="../reportes/impContrato.php?cont_id='.$reg->cont_id.'" target="_blanck" style="text-decoration:nome;">
					<button data-toggle="tooltip" data-placement="right" title="Imprimir contrato"  class="btn btn-default">
						<i class="fa fa-print"></i>
					</button>
					</a>',
				"1"=>$reg->cont_no_contrato."-".$reg->cont_id,
				"2"=>'$ '.number_format($reg->cont_minimo_mensual),
				"3"=>$reg->per_nombre." ".$reg->per_apellido,
				"4"=>$reg->per_num_documento,
				"5"=>$reg->per_telefono_1,
				"6"=>$reg->cont_vigencia_a_partir,
				"7"=>$perm,
				"8"=>$reg->cont_fecha_fin_perm,
				"9"=>$reg->cont_fecha_transaccion,
				"10"=>($reg->cont_estado)?'<span class="label bg-green">Vigente</span>':'<span class="label bg-gray">Cancelado</span>'
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