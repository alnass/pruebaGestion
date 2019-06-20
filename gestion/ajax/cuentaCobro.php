<?php 
session_start(); 
// maintenance effectuee par Anderson Ferrucho
require "../modelos/CuentaCobro.php";
$cuentaCobro =  new CuentaCobro();

switch ($_GET['op']) {
	
	case 'listar_sede':

		require_once "../modelos/Sede.php";

		$sede = new Sede();

		$respuesta = $sede->listar();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->sed_id.'>'.$reg->sed_nombre.'</option>';
		}

		break;

	case 'listar':
		if($_SESSION['usu_id'] == 30)
		{
			$respuesta = $cuentaCobro->listar();
		}
		else
		{
			$respuesta = $cuentaCobro->listarFiltrado();			
		}

		$data = Array();
		while ($reg = $respuesta->fetch_object()) {

			$servicio = "";
			if ($reg->cont_tv_analogica == 1) {
				$servicio = "Televisión analoga ";
			}
			if ($reg->cont_tv_digital == 1) {
				$servicio .= "Televisión digital";
			}
			if ($reg->cont_internet == 1) {
				$servicio .= "Internet";
			}

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
			// Début maintenance
			// if($_SESSION['usu_id']== 30)
			// {
				//<a href="../reportes/imprimirOT.php?ord_trab_id=''" target="_blanck" style="text-decoration:none;">
				$mostrar_valor = '<a href="../reportes/individual.php?cont='.$reg->cont_id.'" target="_blanck">
					<button title="Imprimir Cuenta"  class="btn btn-default">
						<i class="fa fa-print"></i>
					</button>
					</a>';
			// }
			// else
			// {
			// 	$mostrar_valor = $reg->per_tipo_persona_id;
			// }
			// fin maintenance
			
			$prontopago = $cuentaCobro->prontopago($reg->cont_id);
			$saldos = $cuentaCobro->saldos($reg->cont_id);

			$data[] = array(
				"0"=>$mostrar_valor,
				"1"=>$reg->per_num_documento,
				"2"=>$reg->per_nombre." ".$reg->per_apellido,
				"3"=>$reg->cont_direccion_serv,
				"4"=>$reg->per_telefono_1,
				"5"=>$reg->cont_no_contrato."-".$reg->cont_id,
				"6"=>$reg->cont_barrio,
				"7"=>$estadoservicio,
				"8"=>$reg->cont_valor_total_mes,
				"9"=>$saldos['est_cta_saldo_anterior'],
				"10"=>$saldos['est_cta_saldo_actual'],
				"11"=>$reg->sed_nombre,
				"12"=>$servicio,
				"13"=>$prontopago['prod_valor_pronto_pago'],
				"14"=>$reg->cont_fecha_transaccion,
				"15"=>$reg->sed_direccion
				
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