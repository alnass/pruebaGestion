<?php session_start();
// # encodé par @Anderson Ferrucho 
// NOMBRE DE LA TABLA
// seguimientoOT
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
numDoc
nombre
apellido
ciudad
direccion
tel1
cont_id
m_contratoid
ord_trab_contrato_id
v_contratoid
barrInst
marca
alianza
expedCont
direcInst
correoPer
tel2
tipoVivien
estado
ord_trab_fecha_programacion
ord_trab_fecha_vencimiento
tec_asignado
operacion
ot_id
ord_trab_id
sede
*/

require_once "../modelos/OrdenTrabajo.php";
require_once "../modelos/Contrato.php";
require_once "../modelos/Persona.php";
require_once "../modelos/EquipoDetalle.php";
require_once "../modelos/SeguimientoOT.php";

$ordenTrabajo 	= 	new OrdenTrabajo();
$contrato 		= 	new Contrato();
$seguimientoOT 	= 	new SeguimientoOT();

$ord_trab_id 			= 	isset($_POST['ord_trab_id'])? limpiarCadena($_POST['ord_trab_id']):"";
$cont_id 				= 	isset($_POST['cont_id'])? limpiarCadena($_POST['cont_id']):"";
$contrato_id 			= 	isset($_POST['numDoc'])? limpiarCadena($_POST['numDoc']):"";
// $per_num_documento 		= 	isset($_POST['numDoc'])? limpiarCadena($_POST['numDoc']):"";
$per_fecha_exped_doc 	= 	isset($_POST['expedDoc'])? limpiarCadena($_POST['expedDoc']):"";
$per_nombre 			= 	isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$per_apellido 			= 	isset($_POST['apellido'])? limpiarCadena($_POST['apellido']):"";
$per_fecha_nacimiento 	= 	isset($_POST['nacimiento'])? limpiarCadena($_POST['nacimiento']):"";
$per_telefono_1 		= 	isset($_POST['tel1'])? limpiarCadena($_POST['tel1']):"";
$per_telefono_2 		= 	isset($_POST['tel2'])? limpiarCadena($_POST['tel2']):"";
$ciu_nombre 			= 	isset($_POST['ciudad'])? limpiarCadena($_POST['ciudad']):"";
$per_direccion 			= 	isset($_POST['direccion'])? limpiarCadena($_POST['direccion']):"";
$per_correo_personal 	= 	isset($_POST['correoPer'])? limpiarCadena($_POST['correoPer']):"";
$per_usuario 			= 	isset($_POST['usuario'])? limpiarCadena($_POST['usuario']):"";
$usu_id 				= 	$_SESSION['usu_id'];
$ot_vencia 				= 	isset($_POST['ord_trab_fecha_vencia'])?limpiarCadena($_POST['ord_trab_fecha_vencia']):"";
$ant_obsrv 				=	isset($_POST['ant_obsrv'])? limpiarCadena($_POST['ant_obsrv']):"";
$ant_operacion			= 	isset($_POST['ant_operacion'])? limpiarCadena($_POST['ant_operacion']):"";		
$tec_ant 				= 	isset($_POST['tec_cierre'])? limpiarCadena($_POST['tec_cierre']):"";		
$estado 				= 	isset($_POST['nuevoestado'])? limpiarCadena($_POST['nuevoestado']):"";
$ord_trab_nuevo_vencimiento		= 	isset($_POST['ord_trab_nuevo_vencimiento'])? 
									limpiarCadena($_POST['ord_trab_nuevo_vencimiento']):"";	



$ots_operacion_id 		=	isset($_POST['ord_trab_nva_operacion_id'])? limpiarCadena($_POST['ord_trab_nva_operacion_id']):"";
$ots_contrato_id		= 	isset($_POST['ord_trab_contrato_id'])? limpiarCadena($_POST['ord_trab_contrato_id']):"";
$ots_responsable_id		=	isset($_POST['tec_cierre'])? limpiarCadena($_POST['tec_cierre']):"";
$ots_responsable_id		= 	isset($_POST['ord_trab_responsable_id'])? limpiarCadena($_POST['ord_trab_responsable_id']):"";	
$ots_observacion		= 	isset($_POST['ord_trab_observacion'])? limpiarCadena($_POST['ord_trab_observacion']):"";
$usuario 				= 	$_SESSION['usu_id'];

$v_contratoid			= 	isset($_POST['v_contratoid'])? limpiarCadena($_POST['v_contratoid']):"";
$ot_id 					= 	isset($_POST['s_ot_id'])? limpiarCadena($_POST['s_ot_id']):"";
$ots_id 				= 	isset($_POST['ots_id'])? limpiarCadena($_POST['ots_id']):"";
$per_id 				= 	isset($_POST['per_id'])? limpiarCadena($_POST['per_id']):"";
$mensualidad			= 	isset($_POST['mensualidad'])? limpiarCadena($_POST['mensualidad']):"";
$sede					=	$_SESSION['usu_sede_id'];

switch($_GET["op"])
{
	case 'listar':

		require_once 	'../modelos/OrdenTrabajo.php';

		$respuesta = $seguimientoOT->listarOTCerradas();
		// Declaracion de array para almacenamiento de los resultados
		$data 	= 	Array();/// almacena los datos listados

		while ($reg = $respuesta->fetch_object()) 
		{

			$estado_cont	= 	$ordenTrabajo->fechaEstado($reg->cont_id);

			if ($reg->cont_estado_servicio_id == 0) {
				$estadoservicio = 'Error ST1001';
			}
			elseif ($reg->cont_estado_servicio_id == 1) {
				$estadoservicio = '<span class="label bg-yellow">01 Por instalar</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 2) {
				$estadoservicio = '<span class="label bg-green">10 Activo</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 3) {
				$estadoservicio = '<span class="label bg-red">07 Por Cortar</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 4) {
				$estadoservicio = '<span class="label bg-black">12 Cortado</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 5) {
				$estadoservicio = '<span class="label bg-blue">02 Por reconectar</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 6) {
				$estadoservicio = '<span class="label bg-gray">11 Suspendido</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 7) {
				$estadoservicio = '<span class="label bg-orange">03 Reco - Susp</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 8){
				$estadoservicio = '<span class="label bg-purple">09 Por suspender</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 9){
				$estadoservicio = '<span class="label bg-gray">05 Mantenimiento</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 10) {
				$estadoservicio = '<span class="label bg-gray">13 Retirado</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 11) {
				$estadoservicio = '<span class="label bg-gray">06 Corte por retiro</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 12) {
				$estadoservicio = '<span class="label bg-red">08 Por traslado</span>';
			}
			elseif ($reg->cont_estado_servicio_id == 13) {
				$estadoservicio = '<span class="label bg-red">04 Pago Realizado</span>';	
			}
			elseif($reg->cont_estado_servicio_id >= 14){
				$estadoservicio = 'Error ST1002';
			}

			// linea para mostrar orden de trabajo cerradas toca corregir algunos datos
			// ../reportes/imprimirOT.php?ord_trab_id='.$reg->ord_trab_id.'" target="_blanck" style="text-decoration:nome;
			/// valores del listado
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>'<a href="#">
					<button data-toggle="tooltip" data-placement="right" title="Imprimir OT"  class="btn btn-default">
						<i class="fa fa-print"></i>
					</button>
					</a>',
				"1"=>$reg->ord_trab_id,
				"2"=>$reg->cont_no_contrato .'-'. $reg->cont_id,
				"3"=>$reg->per_nombre . ' ' . $reg->per_apellido,
				"4"=>$reg->per_num_documento,
				"5"=>$reg->ord_trab_fecha_programacion,
				"6"=>$reg->ord_trab_cie_fecha,
				"7"=>$reg->ord_trab_cie_concepto,
				"8"=>$est_cierre_ot,
				"9"=>$estadoservicio,
				"10"=>$reg->usu_nombre .' '.$reg->usu_apellido,
				// "4"=>$reg->est_serv_nombre,
				// "8"=>'<strong>Fecha cambio de estado:</strong> ' . $fecha_estado .' <br><strong>- Observacion en caja: </strong>'.$obsrv_estado .'<br><strong>- Observacion de OT: </strong>'. $reg->ord_trab_observacion,
				"10"=>'<a data-toggle="modal" href="#myModal"><button class="btn btn-warning" data-toggle="tooltip" title="Ver Mas." onclick="mostrar2('.$reg->ord_trab_id.')"><i class="fa fa-eye"></i></button>');

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

		case 'mostrar':

			$respuesta 	= 	$seguimientoOT->mostrarOTCerrada($ord_trab_id);

			// codifica el resultado mediante json
			echo json_encode($respuesta);	

		break;		

		case 'listarOTS':

			$ot_seguimiento 	= 	new 	SeguimientoOT();
			
			// $respuesta 			= 	$ot_seguimiento->mostrar($ord_trab_id);
			$respuesta2			= 	$ot_seguimiento->listarOTS($ord_trab_id);
			
			// Declaracion de array para almacenamiento de los resultados
			$data = Array();
			// print_r($respuesta2);

			// Estructura de recorrido de la BD
			while ($reg = $respuesta2->fetch_object()) 
			{
				// Identificador de permanencia

				$data[] = array(
					// Declaracion de indices de almacenamiento dentro del array
					"0"=>$reg->ots_id,
					"1"=>$reg->ots_fecha_elaboracion,
					"2"=>$reg->ots_observacion,
					"3"=>$reg->usu_resp,
					"4"=>$reg->est_serv_nombre,
					"5"=>$reg->usu_tec);

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