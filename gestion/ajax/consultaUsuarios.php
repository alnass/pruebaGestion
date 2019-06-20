<?php session_start();
// NOMBRE DE LA TABLA
// orden_trabajo
/// CAMPOS DE LA TABLA
/*
ord_trab_id
ord_trab_fecha_elaboracion
ord_trab_fecha_programacion	
ord_trab_fecha_vencimiento
ord_trab_operacion_id
ord_trab_contrato_id
ord_trab_responsable_id
ord_trab_observacion
ord_estado
*/
// NOMBRE DE LA CLASE 
// OrdenTrabajo
//AJAX
// ordenTrabajo
// INPUTS
/*
ord_trab_id
fecha_program
fecha_vence
operacion
contrato
observacion
*/

require_once "../modelos/ConsultaUsuarios.php";

$consultar 	= 	new ConsultaUsuarios();

switch($_GET["op"])
{
	
	case 'listar':

		$respuesta = $consultar->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		

		// print_r($respuesta);

		// // Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) 
		{
			$sanant = $consultar->listarSanAntonio($reg->cont_estado_servicio_id);
			$bogota = $consultar->listarBogota($reg->cont_estado_servicio_id);
			$firavi = $consultar->listarFira($reg->cont_estado_servicio_id);
			$iza 	= $consultar->listarIza($reg->cont_estado_servicio_id);
			$paipa  = $consultar->listarPaipa($reg->cont_estado_servicio_id);
			$tibaso = $consultar->listarTiba($reg->cont_estado_servicio_id);
			$corpor = $consultar->listarCorp($reg->cont_estado_servicio_id);
			$fomequ = $consultar->listarFomeque($reg->cont_estado_servicio_id);
			$madrid = $consultar->listarMadrid($reg->cont_estado_servicio_id);
			$total  = $consultar->listarTotal($reg->cont_estado_servicio_id);
			
			/// VALORES PARA EL ESTADO DEL SERVICIO
			if ($reg->cont_estado_servicio_id == 0) {
				$estadoservicio = 'Error ST1001';
			}
			elseif ($reg->cont_estado_servicio_id == 1) {
				$estadoservicio = '01 Por instalar';
			}
			elseif ($reg->cont_estado_servicio_id == 2) {
				$estadoservicio = '03 Activos';
			}
			elseif ($reg->cont_estado_servicio_id == 3) {
				$estadoservicio = '02 Por Cortar';
			}
			elseif ($reg->cont_estado_servicio_id == 4) {
				$estadoservicio = '04 Cortados';
			}
			elseif ($reg->cont_estado_servicio_id == 5) {
				$estadoservicio = '05 Por reconectar';
			}
			elseif ($reg->cont_estado_servicio_id == 6) {
				$estadoservicio = '06 Suspendidos';
			}
			elseif ($reg->cont_estado_servicio_id == 7) {
				$estadoservicio = '12 Reco - Susp';
			}
			elseif ($reg->cont_estado_servicio_id == 8){
				$estadoservicio = '07 Por suspender';
			}
			elseif ($reg->cont_estado_servicio_id == 9){
				$estadoservicio = '08 En mantenimiento';
			}
			elseif ($reg->cont_estado_servicio_id == 10) {
				$estadoservicio = '09 Retirados';
			}
			elseif ($reg->cont_estado_servicio_id == 11) {
				$estadoservicio = '10 Corte por retiro';
			}
			elseif ($reg->cont_estado_servicio_id == 12) {
				$estadoservicio = '11 Por traslado';
			}
			elseif ($reg->cont_estado_servicio_id == 13) {
				$estadoservicio = '13 Pago Realizado';	
			}

			/// VALORES PARA LA SEDE
			

			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>$estadoservicio,
				"1"=>number_format($sanant['total']),
				"2"=>number_format($fomequ['total']),
				"3"=>number_format($bogota['total']),
				"4"=>number_format($firavi['total']),
				"5"=>number_format($iza['total']),
				"6"=>number_format($paipa['total']),
				"7"=>number_format($tibaso['total']),
				"8"=>number_format($corpor['total']),
				"9"=>number_format($madrid['total']),
				"10"=>number_format($total['total']));

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