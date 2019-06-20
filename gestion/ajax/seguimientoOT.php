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
$concepto				= 	isset($_POST['concepto'])? limpiarCadena($_POST['concepto']):"";
$usuario 				= 	$_SESSION['usu_id'];

$v_contratoid			= 	isset($_POST['v_contratoid'])? limpiarCadena($_POST['v_contratoid']):"";
$ot_id 					= 	isset($_POST['s_ot_id'])? limpiarCadena($_POST['s_ot_id']):"";
$ots_id 				= 	isset($_POST['ots_id'])? limpiarCadena($_POST['ots_id']):"";
$per_id 				= 	isset($_POST['per_id'])? limpiarCadena($_POST['per_id']):"";
$mensualidad			= 	isset($_POST['mensualidad'])? limpiarCadena($_POST['mensualidad']):"";
$sede					=	$_SESSION['usu_sede_id'];

switch($_GET["op"])
{
	case 'guardaryeditar':


	if(empty($_POST['id_detalle_equipo']))
	{

		if($ant_operacion == 1)
		{
			$ots_operacion_id 		=	isset($_POST['ant_operacion'])? limpiarCadena($_POST['ant_operacion']):"";			
		}else
		{
			$ots_operacion_id 		=	isset($_POST['ord_trab_nva_operacion_id'])? limpiarCadena($_POST['ord_trab_nva_operacion_id']):"";
		}

		$respuesta 	= 	$seguimientoOT->insertar2(
			$ots_id,
			$ord_trab_id,
			$ord_trab_nuevo_vencimiento,
			$ot_vencia,
			$ots_operacion_id,	
			$ots_contrato_id,
			$ots_responsable_id,
			$ots_observacion,
			$usu_id);

		echo $respuesta ? 	"Orden de trabajo registrada" : "Orden de trabajo no pudo ser registrada";
	}
	else
	{
		if($ant_operacion == 1)
		{
			$ots_operacion_id 		=	isset($_POST['ant_operacion'])? limpiarCadena($_POST['ant_operacion']):"";			
		}else
		{
			$ots_operacion_id 		=	isset($_POST['ord_trab_nva_operacion_id'])? limpiarCadena($_POST['ord_trab_nva_operacion_id']):"";
		}

		$respuesta 	= 	$seguimientoOT->insertarOTconEquipo(
			$ots_id,
			$ord_trab_id,
			$ord_trab_nuevo_vencimiento,
			$ot_vencia,
			$ots_operacion_id,	
			$ots_contrato_id,
			$ots_responsable_id,
			$ots_observacion,
			$usu_id,
			$_POST['id_detalle_equipo'],
			$_POST['cliente']
		);
		echo $respuesta ? 	"La Orden de trabajo y " . count($_POST['id_detalle_equipo']) . " equipos han sido registrados" : "Los datos no pudieron ser registrados";
	}

	
	break;


	case 'guardarNuevoEstado':

		if($ot_id == 0)
		{
			echo '<h1 class="text-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No se pudo realizar la operación por favor intente nuevamente</h1>';
		}
		else
		{
			$respuesta = $seguimientoOT->guardarNuevoEstado($estado, $v_contratoid, $usuario, $ot_id, $concepto);
			echo $respuesta ? "Estado actualizado correctamente, se ha cerrado la orden de trabajo":"Este estado no pudo ser actualizado";
		}
			
		break;

	case 'mostrar':

		$respuesta 	= 	$seguimientoOT->mostrar($ord_trab_id);
		echo json_encode($respuesta);	
		
		break;

	case 'listar':

		require_once 	'../modelos/OrdenTrabajo.php';

		if($usuario == 76)
		{
			$respuesta = $seguimientoOT->listarBoyaca();			
		}
		else
		{
			$respuesta = $seguimientoOT->listar();
		}
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		// print_r($seguimientoOT);
		// die();

		while ($reg = $respuesta->fetch_object()) 
		{

			$estado_cont	= 	$ordenTrabajo->fechaEstado($reg->cont_id);
			$saldoactual	= 	$ordenTrabajo->saldoActual($reg->cont_id);
			$validarOTS 	= 	$seguimientoOT->validarSeguimientoOT($reg->ord_trab_id);

			if(!empty($validarOTS))
			{
				$ultima_observacion = $validarOTS['ots_observacion'];
				$nombre_actualiza 	= $validarOTS['resp_nombre'];
				$apellido_actualiza = $validarOTS['resp_apellido'];		
				$tecnico_actual 	= $validarOTS['tec_nombre'] . " " . $validarOTS['tec_apellido'];		
			}
			else
			{
				$ultima_observacion = $reg->ord_trab_observacion;
				$nombre_actualiza 	= $reg->resp_nombre;
				$apellido_actualiza = $reg->resp_apellido;		
				$tecnico_actual 	= $reg->usu_nombre .' '.$reg->usu_apellido;		
			}


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
				$estadoservicio = '<span class="label bg-yellow">02 Agr. Producto</span>';	
			}
			elseif($reg->cont_estado_servicio_id >= 14){
				$servicio 	= '<span class="label label-info">01 Camb. Product</span>';
			}

			// print_r($saldoactual);

			$saldo_actual 	= 	$saldoactual['est_cta_saldo_actual'];

			$obsrv_estado 	= 	$estado_cont['cc_est_ser_observacion'];
			$fecha_estado 	=	$estado_cont['cc_est_ser_fecha'];

			$estado = null;
			$agregar = null;	


			date_default_timezone_set("America/Bogota");
			$hoy = date('Y-m-d H:i:s');

			// METODO PARA VALIDAR EL VENCIMIENTO
			$strStart = $hoy;  // FECHA DE INICIO
			$strEnd   = $reg->ord_trab_fecha_vencimiento; // FECHA DE VENCIMIENTO
			$dteStart = new DateTime($strStart); // 
			$dteEnd   = new DateTime($strEnd);
			$dteDiff  = $dteStart->diff($dteEnd); 
			$inicio = new DateTime($reg->ord_trab_fecha_programacion);
			
			$porvencer = strtotime("-12 hour", strtotime($strEnd)); // DESCUENTA EL TIEMPO PARA MOSTRAR EL VENCIMIENTO
			$porvencer = date('Y-m-d H:i:s',$porvencer);
			$dia 	= $dteDiff->format("%d");
			$hora 	= $dteDiff->format("%H");
			$minutos= $dteDiff->format("%I");


			if($_SESSION['usu_id'] == 54)
			{
				$agregar = '<button class="btn btn-warning" data-toggle="tooltip" title="Ver OT." onclick="mostrar('.$reg->ord_trab_id.')"><i class="fa fa-pencil"></i></button>';	
			}
			else
			{
				$agregar = '<button class="btn btn-warning" data-toggle="tooltip" title="Ver OT." onclick="mostrar('.$reg->ord_trab_id.')"><i class="fa fa-pencil"></i></button>
				<a data-toggle="modal" href="#myModal2">
					<button class="btn btn-success" data-toggle="tooltip" data-placement="right" title="Cerrar OT" onclick="mostrar2('.$reg->ord_trab_id.')"><i class="fa fa-check"></i></button>
				</a>';
			}

			if ($hoy > $strEnd) {
				$verestado = 2;
				$estado = '<span class="label bg-red">1-Vencida</span>';
			}
			elseif ($hoy < $strEnd && $hoy > $porvencer ) {
				$verestado = 3;
				$estado = '<span class="label bg-orange">2-Por Vencer</span>';
				
			}
			else{
				$verestado = 4;
				$estado = '<span class="label bg-green">3-Activa</span>';
				
			}
			

			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>$estado,
				"1"=>$estadoservicio,
				"2"=>'<strong>Última actualización:</strong> ' . $fecha_estado .' <br><strong>- Observacion de apertura: </strong>'.$reg->ord_trab_observacion . ' - '. $reg->resp_nombre . ' ' . $reg->resp_apellido. '<br><strong>- Ultima Observacion: </strong>'. $ultima_observacion . '<br><strong>- </strong> ' . $nombre_actualiza . ' ' . $apellido_actualiza,
				"3"=>$reg->per_nombre . ' ' . $reg->per_apellido,
				"4"=>$reg->per_num_documento,
				"5"=>$reg->cont_no_contrato .'-'. $reg->cont_id,
				"6"=>'$ ' . number_format($saldo_actual),
				"7"=>$reg->ord_trab_id,
				"8"=>$tecnico_actual,
				"9"=>$reg->ord_trab_fecha_programacion,
				"10"=>$reg->ord_trab_fecha_vencimiento,
				"11"=>$reg->sed_nombre,
				"12"=>'<a href="../reportes/imprimirOT.php?ord_trab_id='.$reg->ord_trab_id.'" target="_blanck" style="text-decoration:none;">
					<button title="Imprimir OT"  class="btn btn-default">
						<i class="fa fa-print"></i>
					</button>
					</a>',
				"13"=>$agregar);

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

	case 'listarProductos':

		$respuesta2 = $ordenTrabajo->listarProducto($cont_id);
		// Declaracion de array para almacenamiento de los resultados
		$data1 = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta2->fetch_object()) {

			$data1[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>$reg->cont_prod_id,
				"1"=>$reg->prod_nombre,
				"2"=>'$ ' . number_format($reg->prod_valor),
				"3"=>'$ ' . number_format($reg->prod_valor_pronto_pago));
		}
		
		$results2 = array(
			// Informacion para el datatable
			"sEcho"=>1,
			// Envio el total de los regstros al datatable
			"iTotalRecords"=>count($data1),
			// Envio del total de registros a visualizar
			"iTotalDisplayRecords"=>count($data1),
			//Envio de los valores resultantes
			"aaData"=>$data1);
		echo json_encode($results2);

		break;

	case 'listarEquipoDetalle':

		$respuesta3 = $ordenTrabajo->listarEquipoDetalle();
		// Declaracion de array para almacenamiento de los resultados
		$data2 = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta3->fetch_object()) {
			// Identificador de permanencia

			$data2[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>$reg->equi_det_id,
				"1"=>$reg->equi_tip_nombre,
				"2"=>$reg->equi_referencia,
				"3"=>$reg->equi_det_mac,
				"4"=>$reg->equi_det_sn,
				"5"=>'<button class="btn btn-warning" data-toggle="tooltip" title="Asignar Equipo" onclick="asignarEquipo('. $reg->equi_det_id .', \''.$reg->equi_tip_nombre.'\',\''. $reg->equi_referencia .'\',\''. $reg->equi_det_mac .'\',\''. $reg->equi_det_sn .'\')"><i class="fa fa-plus"></i></button>');

		}
		
		$results3 = array(
			// Informacion para el datatable
			"sEcho"=>1,
			// Envio el total de los regstros al datatable
			"iTotalRecords"=>count($data2),
			// Envio del total de registros a visualizar
			"iTotalDisplayRecords"=>count($data2),
			//Envio de los valores resultantes
			"aaData"=>$data2);
		echo json_encode($results3);

		break;

	case 'selectOperacion':

		require_once '../modelos/Operacion.php';
		$operacion 	= 	new Operacion();

		$respuesta 	=	$operacion->select();
		while ($reg = 	$respuesta->fetch_object())
		{
			echo '<option value=' . $reg->oper_id . '>'.$reg->oper_nombre.'</option>';
		}
		break;

	case 'nuevoestado':
		$respuesta = $seguimientoOT->nuevoEstado();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->est_serv_id.'>'.$reg->est_serv_nombre.'</option>';
		}
		break;

	case 'selectTecnico':

		require_once 	'../modelos/OrdenTrabajo.php';
		$tecnico 	= 	new 	OrdenTrabajo();

		$respuesta 	= 	$tecnico->selectTecnico();

		while ($reg = 	$respuesta->fetch_object())
		{
			echo '<option value=' . $reg->usu_id . '>'.$reg->usu_nombre. ' ' .$reg->usu_apellido . '</option>';
		}
		break;

	case 'listarEquipoInstalado':

		$estado 	= 	'';
		$respuesta4 = $ordenTrabajo->listarEquipoInstalado($cont_id);
		// Declaracion de array para almacenamiento de los resultados
		$data3 = Array();
		// Estructura de recorrido de la BD
		$comodato 	= 	'';

		while ($reg = $respuesta4->fetch_object()) {
			// Identificador de permanencia

			if($reg->ot_equi_propiedad == 1)
			{
				$comodato 	= 	'Si';
			}
			else
			{
				$comodato 	= 	'No';	
			}

			if($reg->ot_equi_estado == 0)
			{
				$estado 	= 	'Retirado';
			}
			else
			{
				$estado 	= 	'Instalado';
			}

			$data3[] = array(
				// Declaracion de indices de almacenamiento dentro del array

				"0"=>$reg->equi_tip_nombre,
				"1"=>$reg->equi_referencia,
				"2"=>$reg->equi_det_mac,
				"3"=>$reg->equi_det_sn,
				"4"=>$reg->ot_equi_ord_trab_id,
				"5"=>$estado,
				"6"=>$comodato,
				"7"=>($reg->ot_equi_estado)?'<button  class="btn btn-danger" data-toggle="tooltip" title="Retirar" onclick="desactivar('.$reg->ot_equi_estado.')"><i class="fa fa-close"></i></button>':
					'');
		}
		
		$results4 = array(
			// Informacion para el datatable
			"sEcho"=>1,
			// Envio el total de los regstros al datatable
			"iTotalRecords"=>count($data3),
			// Envio del total de registros a visualizar
			"iTotalDisplayRecords"=>count($data3),
			//Envio de los valores resultantes
			"aaData"=>$data3);
		echo json_encode($results4);

		break;

	case 'cobroprorrateo':

		$show_mensualidad 	= 	$seguimientoOT->mostrar($ot_id);

		
		// die();

		$dia 	= 	date('d');
		$mes 	= 	date('m');
		$anio	=	date('Y');

		$diasdelmes  	= cal_days_in_month(CAL_GREGORIAN, $mes ,$anio);
		$diasacobrar	= $diasdelmes - $dia;
		$valordia 		= $show_mensualidad['cont_valor_basico_mes'] / $diasdelmes;
		$valoracobra 	= $valordia * $diasacobrar;
		$valoracobra 	= round($valoracobra, -2); /// EL MENOS 2 REDONDEA EN VALOR DE CENTENAS

		// // print_r($_POST);
		// // printf($v_contratoid);
		// // printf($show_mensualidad['cont_valor_basico_mes'] . " "); 
		// // printf($diasdelmes . " ");
		// // printf($diasacobrar . " ");
		// // printf($valordia . " ");
		// // printf($valoracobra . " ");
		// // die();

		$respuesta 	= 	$seguimientoOT->cobroprorrateo(
			$per_id,
			$v_contratoid,
			$valoracobra,
			$sede,
			$usuario
			);

		echo $respuesta ? 'Se ha realizado un registro por prorrato correctamente':'No fue posible registrar el prorrateo';


		break;

		case 'listarOTS':

		$ot_seguimiento 	= 	new 	SeguimientoOT();
		
		$respuesta 			= 	$ot_seguimiento->listarOTS($ord_trab_id);
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();

		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			// Identificador de permanencia

			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>$reg->ots_fecha_elaboracion,
				"1"=>$reg->ots_observacion,
				"2"=>$reg->usu_resp,
				"3"=>$reg->est_serv_nombre,
				"4"=>$reg->usu_tec);

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