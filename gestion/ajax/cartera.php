<?php 
session_start();
require "../modelos/Cartera.php";

$cartera = new Cartera();

switch ($_GET["op"]) {
	case 'listar':

		$respuesta =  $cartera->listar();

		$data = Array();

		while ($reg = $respuesta->fetch_object()) {
			$servicio ="";

			if ($reg->cont_tv_analogica == 1) {
				$servicio = " TV-AN";
			}
			if ($reg->cont_tv_digital == 1) {
				$servicio =$servicio." TV-DG";
			}
			if ($reg->cont_internet == 1) {
				$servicio =$servicio. " INTER";
			}

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

			$t = 0;
			
				if($saldoactual == 0)
				{
					$t = $saldoactual;
				}
				else
				{
					$t = ceil($saldoactual/$reg->cont_valor_total_mes);// devuelve el valor redondeado en entero mayor 
				}
				$valida_mes = 0;

			if ($_SESSION['usu_sede_id'] == 3) {
				$valida_mes = 1;
			}else{
				$valida_mes = 2;
			}		
			if ($t >=$valida_mes) {
				
				$data[] = array(
					// Declaracion de indices de almacenamiento dentro del array
					"0"=>$reg->cont_no_contrato."-".$reg->cont_id,
					"1"=>$reg->per_nombre." ".$reg->per_apellido,
					"2"=>$reg->cont_direccion_serv,
					"3"=>$reg->cont_barrio,
					"4"=>$reg->per_num_documento,
					"5"=>$reg->per_telefono_1,
					"6"=>$servicio,
					"7"=>'$'.number_format($reg->cont_valor_total_mes),
					"8"=>'$'.number_format($saldoanterior),
					"9"=>'$'.number_format($saldoactual),
					"10"=>number_format($t),
					"11"=>$estadoservicio
					);
			}
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