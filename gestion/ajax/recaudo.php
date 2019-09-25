<?php
session_start(); 
// # encoded by @Francisco Monsalve
// maintenance effectuee par Anderson Ferrucho

// NOMBRE DE LA TABLA
	// estado_cuenta_fin

// NOMBRE DE LOS CAMPOS
	// est_cta_id
	// est_cta_persona_id
	// est_cta_contrato_id	
	// est_cta_no_transaccion
	// est_cta_no_comprobante
	// est_cta_fecha_transacc
	// est_cta_fecha_comprobante
	// est_cta_concep_trans_id
	// est_cta_haber
	// est_cta_debe
	// est_cta_saldo_actual
	// est_cta_saldo_anterior	
	// est_cta_observacion	
	// est_cta_usuario_id
	// est_cta_estado

 // NOMBRE DE LA CLASE 
 	// Recaudo

require_once "../modelos/Recaudo.php";
require_once "../modelos/OrdenTrabajo.php";// maintenance
require_once "../modelos/AgregarImagen.php";// maintenance
require_once "../modelos/SeguimientoOT.php";// maintenance
require_once "../modelos/Corporativo.php";// maintenance
require_once "../modelos/CobroAutomatico.php";// maintenance

$recaudo	 = 	new Recaudo();
$corporativo = 	new Corporativo();// maintenance
$validarOT 	 =	new OrdenTrabajo();// maintenance
$cobro 		 =	new CobroAutomatico();// maintenance


$cont_id 					= isset($_POST['cont_id'])? limpiarCadena($_POST['cont_id']):"";
$est_cta_id 				= isset($_POST['est_cta_id'])? limpiarCadena($_POST['est_cta_id']):"";
$est_cta_persona_id			= isset($_POST['persona_id'])? limpiarCadena($_POST['persona_id']):"";
$est_cta_no_comprobante		= isset($_POST['no_comprobante'])? limpiarCadena($_POST['no_comprobante']):"";
$est_cta_fecha_comprobante	= isset($_POST['fecha_comprobante'])? limpiarCadena($_POST['fecha_comprobante']):"";
$est_cta_concep_trans_id	= isset($_POST['concepto'])? limpiarCadena($_POST['concepto']):"";
$est_cta_debe				= isset($_POST['recaudo'])? limpiarCadena($_POST['recaudo']):"";
$est_cta_saldo_anterior		= isset($_POST['valorapagarsindct'])? limpiarCadena($_POST['valorapagarsindct']):"";
$est_cta_observacion		= isset($_POST['observacion'])? limpiarCadena($_POST['observacion']):"";
$est_cta_usuario_id			= $_SESSION['usu_id'];
$prontopago					= isset($_POST['prontopago'])? limpiarCadena($_POST['prontopago']):"";
$v_contratoid 				= isset($_POST['v_contratoid'])? limpiarCadena($_POST['v_contratoid']):"";// maintenance
$nuevoestado				= isset($_POST['nuevoestado'])? limpiarCadena($_POST['nuevoestado']):"";// maintenance
$cc_observacion 			= isset($_POST['observacion'])? limpiarCadena($_POST['observacion']):"";// maintenance
$usu_imagen					= isset($_POST['imagen'])? limpiarCadena($_POST['imagen']):"";
$doc_imagen					= isset($_POST['documento'])? limpiarCadena($_POST['documento']):"";
$est_serv_id				= isset($_POST['est_serv_id'])? limpiarCadena($_POST['est_serv_id']):"";
$mensualidad				= isset($_POST['mensualidad'])? limpiarCadena($_POST['mensualidad']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':

			if (!empty($_POST['recaudo'])) 
			{
				$totalapagar 	=	$_POST['valorapagarsindct'];
				$apagardcto		=	$_POST['valorapagar'];
				$pago 			=	$_POST['recaudo'];
				$ptopago 		=	$_POST['prontopago'];
				$contrans 		=	$_POST['concepto'];
			}

			$trans = "SELECT con_tran_transaccion_id
					FROM concepto_transaccion
					WHERE con_tran_id = '$contrans'";
			$trans_id = ejecutarConsultaSimpleFila($trans);
			$trans_id = implode("", $trans_id);

		if ($est_cta_concep_trans_id != 2) {
			// Verifica la exetncion de la imagen cargada
			$ext = explode(".", $_FILES["imagen"]["name"]);
			// Valida el tipo de extencion que se cargo 
			// if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" || $_FILES['imagen']['type'] == "image/PNG") {
				// Cambia el nombre de la imagen con un formato de tiempo para no repetirla y adhiere la extencion
				$usu_imagen = $est_cta_no_comprobante . '.' . end($ext);
				// Subir el archivo a la carpeta dentro del servidor
				move_uploaded_file($_FILES["imagen"]["tmp_name"] , "../files/soportes/".$usu_imagen);
			// }
		}
	
		if ($ptopago > 0 && $pago >= $apagardcto && $totalapagar > $ptopago && $trans_id != 6 && $trans_id != 5) {

			$est_cta_saldo_actual = $totalapagar - $pago;

			$resp = $recaudo->insertar(
				$est_cta_id,
				$est_cta_persona_id,
				$cont_id,	
				$usu_imagen,
				$est_cta_fecha_comprobante,
				$trans_id,
				$est_cta_concep_trans_id,
				$est_cta_debe,
				$est_cta_saldo_anterior,
				$est_cta_saldo_actual, 
				$est_cta_observacion,	
				$est_cta_usuario_id
			);

			$est_cta_saldo_actual = $est_cta_saldo_actual - $ptopago;

			$respuesta = $recaudo->insertarprontopago(
				$est_cta_id,
				$est_cta_persona_id,
				$cont_id,	
				$usu_imagen,
				$est_cta_fecha_comprobante,
				$trans_id,
				$est_cta_concep_trans_id,
				$prontopago,
				$est_cta_saldo_anterior = $totalapagar - $pago,
				$est_cta_saldo_actual, 
				$est_cta_observacion,	
				$est_cta_usuario_id
			);

			echo $respuesta ? "Pago con pronto pago aplicado" : "No es posible registrar pago con pronto pago";
		}
		elseif($trans_id == 5){

			$est_cta_saldo_actual = $totalapagar + $pago;

			$respuesta = $recaudo->insertarntadebito(
				$est_cta_id,
				$est_cta_persona_id,
				$cont_id,	
				$usu_imagen,
				$est_cta_fecha_comprobante,
				$trans_id,
				$est_cta_concep_trans_id,
				$pago,
				$totalapagar,
				$est_cta_saldo_actual, 
				$est_cta_observacion,	
				$est_cta_usuario_id
			);
			echo $respuesta ? "Nota debito registrada exitosamente" : "No ha sido posible registrar nota debito"; 
		}
		else{

				$est_cta_saldo_actual = $totalapagar - $pago;

				$respuesta = $recaudo->insertar(
					$est_cta_id,
					$est_cta_persona_id,
					$cont_id,	
					$usu_imagen,
					$est_cta_fecha_comprobante,
					$trans_id,
					$est_cta_concep_trans_id,
					$est_cta_debe,
					$est_cta_saldo_anterior,
					$est_cta_saldo_actual, 
					$est_cta_observacion,	
					$est_cta_usuario_id
				);
				echo $respuesta ? "Pago registrado exitosamente" : "No ha sido posible registrar el pago"; 
		}
			
		break;

// Début mantenance
	case 'guardarconCobro':

	$validar_cobro = $cobro->listarestadocuenta($cont_id);
	$fecha_actual = date('Y/m/d');
	$cobro_bandera = '';// BANDERA PARA VERIFICAR SI YA TIENE COBRO CARGADO


	// VALIDACION DE COBROS CARGADOS
	if($validar_cobro->num_rows > 0)
	{// CICLO PARA CONTEO DE COBROS CARGADOS
		while ($valida = $validar_cobro->fetch_object()) 
		{// CONDICIONAL PARA GENERAR LA BANDERA
			print_r($valida->fecha . ' ');
			echo date("Y-m-d",strtotime($fecha_actual." - 29 days")). ' ' ; // opera las semanas meses o días 

			if (strtotime($fecha_actual." - 31 days") < strtotime($valida->fecha))
			{
				echo 'No cobrar';
				$cobro_bandera = 0;
			}
			else
			{
				echo 'Cobrar';
				$cobro_bandera = 1;
			}
		}
	}
	else
	{
		echo "No existen cobros por mensualidad"; 
	}

	$totalapagar 	=	$_POST['valorapagarsindct'];

	$meses = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");

	if(date('d') >= 26)
	{
		if(date('n')==12)
		{
			$mes_actual = $meses[0];
			$año 		= date('Y')+1;
		}
		else
		{
			$mes_actual = $meses[date('m')];
			$año 		= date('Y');
		}
	}
	else
	{
		if(date('n')==12)
		{
			$mes_actual = $meses[date('m')-1];
			$año 		= date('Y');
		}
		else
		{
			$mes_actual = $meses[date('m')];
			$año 		= date('Y');
		}
	}

	if($cobro_bandera >0)
	{
		$est_cta_saldo_actual = $totalapagar + $mensualidad;

		$respuesta = $cobro->insertarntadebito(
					$est_cta_persona_id,
					$cont_id,	
					$mensualidad,
					$totalapagar,
					$est_cta_saldo_actual, 
					$mes_actual . ' ' . $año);

		if (!empty($_POST['recaudo'])) 
				{
					$totalapagar 			=	$est_cta_saldo_actual;
					$apagardcto				=	$_POST['valorapagar'];
					$pago 					=	$_POST['recaudo'];
					$ptopago 				=	$_POST['prontopago'];
					$contrans 				=	$_POST['concepto'];
					$est_cta_saldo_anterior = 	$totalapagar;					
				}

				$trans = "SELECT con_tran_transaccion_id
						FROM concepto_transaccion
						WHERE con_tran_id = '$contrans'";
				$trans_id = ejecutarConsultaSimpleFila($trans);
				$trans_id = implode("", $trans_id);

			if ($est_cta_concep_trans_id != 2) 
			{
				// Verifica la exetncion de la imagen cargada
				$ext = explode(".", $_FILES["imagen"]["name"]);
				// Valida el tipo de extencion que se cargo 
					$usu_imagen = $est_cta_no_comprobante . '.' . end($ext);
					// Subir el archivo a la carpeta dentro del servidor
					move_uploaded_file($_FILES["imagen"]["tmp_name"] , "../files/soportes/".$usu_imagen);
				// }
			}
		
				$est_cta_saldo_actual = $totalapagar - $pago;

				$respuesta = $recaudo->insertar(
					$est_cta_id,
					$est_cta_persona_id,
					$cont_id,	
					$usu_imagen,
					$est_cta_fecha_comprobante,
					$trans_id,
					$est_cta_concep_trans_id,
					$est_cta_debe,
					$est_cta_saldo_anterior,
					$est_cta_saldo_actual, 
					$est_cta_observacion,	
					$est_cta_usuario_id);

			$recaudo->guardarnuevoestado(2, $cont_id, $est_cta_usuario_id, 'Pago Deuda', 0);

			echo $respuesta ? "Mensualidad Cargada exitosamente - Pago registrado Exitosamente " : "No ha sido posible registrar el cobro"; 
	}
	else
	{
		if (!empty($_POST['recaudo'])) 
		{
			$totalapagar 	=	$_POST['valorapagarsindct'];
			$apagardcto		=	$_POST['valorapagar'];
			$pago 			=	$_POST['recaudo'];
			$ptopago 		=	$_POST['prontopago'];
			$contrans 		=	$_POST['concepto'];
		}

		$trans = "SELECT con_tran_transaccion_id
				FROM concepto_transaccion
				WHERE con_tran_id = '$contrans'";

		$trans_id = ejecutarConsultaSimpleFila($trans);
		$trans_id = implode("", $trans_id);

		if ($est_cta_concep_trans_id != 2) 
		{
			// Verifica la exetncion de la imagen cargada
			$ext = explode(".", $_FILES["imagen"]["name"]);
			// Valida el tipo de extencion que se cargo 
			$usu_imagen = $est_cta_no_comprobante . '.' . end($ext);
			// Subir el archivo a la carpeta dentro del servidor
			move_uploaded_file($_FILES["imagen"]["tmp_name"] , "../files/soportes/".$usu_imagen);
		}

		if ($ptopago > 0 && $pago >= $apagardcto && $totalapagar > $ptopago && $trans_id != 6 && $trans_id != 5)
		{
			$est_cta_saldo_actual = $totalapagar - $pago;

			$resp = $recaudo->insertar(
					$est_cta_id,
					$est_cta_persona_id,
					$cont_id,	
					$usu_imagen,
					$est_cta_fecha_comprobante,
					$trans_id,
					$est_cta_concep_trans_id,
					$est_cta_debe,
					$est_cta_saldo_anterior,
					$est_cta_saldo_actual, 
					$est_cta_observacion,	
					$est_cta_usuario_id);

			$est_cta_saldo_actual = $est_cta_saldo_actual - $ptopago;

			$respuesta = $recaudo->insertarprontopago(
					$est_cta_id,
					$est_cta_persona_id,
					$cont_id,	
					$usu_imagen,
					$est_cta_fecha_comprobante,
					$trans_id,
					$est_cta_concep_trans_id,
					$prontopago,
					$est_cta_saldo_anterior = $totalapagar - $pago,
					$est_cta_saldo_actual, 
					$est_cta_observacion,	
					$est_cta_usuario_id);

				$recaudo->guardarnuevoestado(2, $cont_id, $est_cta_usuario_id, 'Pago Deuda', 0);

				echo $respuesta ? "Pago con pronto pago aplicado" : "No es posible registrar pago con pronto pago";
		}
		else
		{

			$est_cta_saldo_actual = $totalapagar - $pago;

			$respuesta = $recaudo->insertar(
						$est_cta_id,
						$est_cta_persona_id,
						$cont_id,	
						$usu_imagen,
						$est_cta_fecha_comprobante,
						$trans_id,
						$est_cta_concep_trans_id,
						$est_cta_debe,
						$est_cta_saldo_anterior,
						$est_cta_saldo_actual, 
						$est_cta_observacion,	
						$est_cta_usuario_id);

			$recaudo->guardarnuevoestado(2, $cont_id, $est_cta_usuario_id, 'Pago Deuda', 0);

		}

		echo $respuesta ? "Pago registrado Exitosamente " : "No ha sido posible registrar el cobro"; 	
	
	}

	break;	

	case 'validarPago':
		
		echo  "El valor del pago no puede ser inferior a la deuda el pago no pudo ser registrado";
		
		break;

// Fin mantenance

	case 'anular':	
		$respuesta = $recaudo->anular($est_cta_id);
		echo $respuesta ? "Operación anulada exitosamente" : "No es posible anular la operacion";
		break;

	// case 'activar':
	// 	$respuesta = $recaudo->activar($per_id);
	// 	echo $respuesta ? "Persona activada" : "Persona no se pudo activar";
	// 	break;


	case 'mostrar':
		$respuesta = $recaudo->mostrar($cont_id);

		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'saldos':
		$respuesta = $recaudo->saldos($cont_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'prontopago':
		$respuesta = $recaudo->prontopago($cont_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':

		// Début de maintenance
		if($_SESSION['usu_sede_id'] == 11)
		{
			$respuesta = $corporativo->listarCorporativo();
		}
		else
		{
			$respuesta = $recaudo->listarcontrato();
		}
		// fin de maintenance
		
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD

		// HACER UN SELECT CON EL ID DEL CON TRATO PARA TRAER LOS VALORES DE LOS SALDOS 

		while ($reg = $respuesta->fetch_object()) {

			$contrato = $reg->cont_id;

			$sqlsaldos = "SELECT *	FROM estado_cuenta_fin
						WHERE est_cta_contrato_id = '$contrato'
						AND est_cta_estado = 1
						ORDER BY est_cta_id DESC 
						LIMIT 1";

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
				$estadoservicio = '<span class="label label-info">Agr. Producto</span>';	
			}
			elseif($reg->cont_estado_servicio_id == 14){
				$estadoservicio = '<span class="label bg-yellow">Cmb. Producto</span>';
			}

			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>'<button  class="btn btn-success" data-toggle="tooltip" data-placement="right" title="Nuevo registro a cuenta" onclick="mostrar('.$reg->cont_id.'), listarestadocuenta('.$reg->cont_id.')"><i class="fa fa-money"></i></button>',
				"1"=>$reg->cont_no_contrato."-".$reg->cont_id,
				"2"=>$reg->per_nombre." ".$reg->per_apellido,
				"3"=>$reg->cont_direccion_serv,
				"4"=>$reg->per_num_documento,
				"5"=>$reg->per_telefono_1,
				"6"=>'$'.number_format($reg->cont_valor_total_mes),
				"7"=>'$'.number_format($saldoanterior),
				"8"=>'$'.number_format($saldoactual),
				"9"=>'<button  class="btn btn-warning" data-toggle="modal" data-target="#myModal" onclick="vermodal('.$reg->cont_id.')"><i class="fa"></i>OT</button>',
				"10"=>$estadoservicio
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

	case 'listarNotas':
	// Début de maintenance
		if($_SESSION['usu_sede_id'] == 11)
		{
			if($est_cta_usuario_id == 75)
			{
				$respuesta = $recaudo->listarcontrato();
			}
			else
			{
				$respuesta = $corporativo->listarCorporativo();
			}
		}
		else
		{
			$respuesta = $recaudo->listarcontrato();
		}
		// fin de maintenance
		
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD

		// HACER UN SELECT CON EL ID DEL CON TRATO PARA TRAER LOS VALORES DE LOS SALDOS 

		while ($reg = $respuesta->fetch_object()) {

			$contrato = $reg->cont_id;

			$sqlsaldos = "SELECT *	FROM estado_cuenta_fin
						WHERE est_cta_contrato_id = '$contrato'
						ORDER BY est_cta_id DESC
						AND est_cta_estado = 1 
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
				$estadoservicio = '<span class="label label-info">Agr. Producto</span>';	
			}
			elseif($reg->cont_estado_servicio_id == 14){
				$estadoservicio = '<span class="label bg-yellow">Cmb. Producto</span>';
			}

			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>'<button  class="btn btn-success" data-toggle="tooltip" data-placement="right" title="Nuevo registro a cuenta" onclick="mostrar('.$reg->cont_id.'), listarestadocuenta('.$reg->cont_id.')"><i class="fa fa-money"></i></button>',
				"1"=>$reg->cont_no_contrato."-".$reg->cont_id,
				"2"=>$reg->per_nombre." ".$reg->per_apellido,
				"3"=>$reg->cont_direccion_serv,
				"4"=>$reg->per_num_documento,
				"5"=>$reg->per_telefono_1,
				"6"=>'$'.number_format($reg->cont_valor_total_mes),
				"7"=>'$'.number_format($saldoanterior),
				"8"=>'$'.number_format($saldoactual),
				"9"=>$estadoservicio
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

	case 'selectConceptoTransaccion':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/ConceptoTransaccion.php';
		// Se crea un nuevo objeto de la clase requerida
		$conceptoTransaccion = new ConceptoTransaccion();

		$respuesta = $conceptoTransaccion->selectcaja();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->con_tran_id.'>'.$reg->con_tran_nombre.'</option>';
		}
		break;

	case 'selectNotaCredito':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/ConceptoTransaccion.php';
		// Se crea un nuevo objeto de la clase requerida
		$conceptoTransaccion = new ConceptoTransaccion();

		$respuesta = $conceptoTransaccion->selectntacredito();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->con_tran_id.'>'.$reg->con_tran_nombre.'</option>';
		}
		break;

	case 'selectNotaDebito':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/ConceptoTransaccion.php';
		// Se crea un nuevo objeto de la clase requerida
		$conceptoTransaccion = new ConceptoTransaccion();

		$respuesta = $conceptoTransaccion->selectntadebito();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->con_tran_id.'>'.$reg->con_tran_nombre.'</option>';
		}
		break;
	
	case 'listarestadocuenta':
		$respuesta = $recaudo->listarestadocuenta($cont_id);
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD

		while ($reg = $respuesta->fetch_object()) 
		{
			$ob = $reg->est_cta_observacion;
			if ($reg->est_cta_fecha_comprobante != '0000-00-00') 
			{
				$ob .= " ".$reg->est_cta_fecha_comprobante;
			}
			if (!empty($reg->est_cta_no_comprobante)) 
			{
				$no_soporte = explode(".", $reg->est_cta_no_comprobante);
				$ob .= " C".'<a href="../files/soportes/'.$reg->est_cta_no_comprobante.'" target="_blanck">'.$no_soporte[0].'</a>';
			}
			
			$data[] = array(
			// Declaracion de indices de almacenamiento dentro del array
				"0"  =>'',
		        "1" => $reg->est_cta_id,
		        "2" => $reg->est_cta_fecha_transacc,
		        "3" => '<a href="../reportes/exTicketCopi.php?num_trans=' . $reg->est_cta_no_transaccion . '" target="_blanck">' . $reg->est_cta_no_transaccion . '</a>',
		        "4" => $reg->con_tran_nombre,
		        "5" => $ob,
		        "6" => '$ ' . number_format($reg->est_cta_saldo_anterior),
		        "7" => '$ ' . number_format($reg->est_cta_haber),
		        "8" => '$ ' . number_format($reg->est_cta_debe),
		        "9" => '$ ' . number_format($reg->est_cta_saldo_actual));
		}
		if(!empty($data))
		{
			// Cuenta el tamaño del array
			$ult_reg_ec	= count($data);

			// Modifica el valor del último array dentro del principal en el primer campo. 
			$data[$ult_reg_ec-1][0] = '<button  class="btn btn-danger" data-toggle="tooltip" id="'. $data[$ult_reg_ec-1][1] .'" data-placement="right" title="Eliminar registro"  onclick="ocultar_registro_tabla(' . $data[$ult_reg_ec-1][1] . ')"><i class="fa  fa-eraser"></i></button>';
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

	case 'listarntacredito':

		$respuesta = $recaudo->listarntacredito();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->con_tran_id.'>'.$reg->con_tran_nombre.'</option>';
		}
		break;

	case 'nuevoestado':

		$respuesta = $recaudo->nuevoestado();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->est_serv_id.'>'.$reg->est_serv_nombre.'</option>';
		}

	break;
// Début de maintenance
// # encodé par @Anderson Ferrucho 
	case 'guardarnuevoestado':
	// ASIGNA LA ZONA HORARIA PARA LA FECHA
		date_default_timezone_set ('America/Bogota');

			$or_trab 	= 	new OrdenTrabajo();
			$insert_img =	new AgregarImagen(); 
			// VALIDA LA EXISTENCIA DE UNA OT
			$respuesta2		= 	$or_trab->validarOTActivaCaja($v_contratoid);

	// SI NO EXISTE ORDEN DE TRABAJO CREADA AUN REALIZA ESTE PROCEDIMIENTO
			if(empty($respuesta2))
			{
			//VALIDACION DE ESTADO SI ES POR SUSPENDER O CORTE POR RETIRO
				if($nuevoestado == 11 || $nuevoestado == 8)
				{
				// CREA LA ORDEN DE TRABAJO
					$result_ot 	= 	nuevo_OT(date('Y/m/d'), $cc_observacion, $nuevoestado, $v_contratoid, $est_cta_usuario_id, date('Y/m/d'), 0, 'null', 1);	

					/// ASIGNA RUTA DE LA IMAGEN PARA CREAR LA CARPETA DE ALMACENAMIENTO
					$carpeta 	= 	"../files/solicitudes/".$v_contratoid;

					if(!is_dir($carpeta))
					{
						// CREA LA CARPETA
						mkdir($carpeta,0777);
						$ext 		=	explode(".", $_FILES["documento"]["name"]);
						$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
						// SUBE EL ARCHIVO A LA CARPETA DEL SERVIDOR
						move_uploaded_file($_FILES["documento"]["tmp_name"] , $carpeta."/".$doc_imagen);

						// INSERTA EL DATO DE UBICACION DE LA IMAGEN EN LA BD
						$insert_img->insertarImagen($v_contratoid,2,$doc_imagen,  $result_ot);
					}
					else
					{
						// SI LA CARPETA YA EXISTE SOLO COPIA LA IMAGEN
						$ext 		=	explode(".", $_FILES["documento"]["name"]);
						$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
						move_uploaded_file($_FILES["documento"]["tmp_name"] , $carpeta."/".$doc_imagen);	
						// INSERTA EL DATO DE UBICACION DE LA IMAGEN EN LA BD
						$insert_img->insertarImagen($v_contratoid,2,$doc_imagen, $result_ot);
					}
					// SI NO FALLA LA CREACION DE LA OT HACE LO SIGUIENTE
					if(!empty($result_ot))
					{
						$ot_id = $result_ot;

						/// GUARDA EL NUEVO ESTADO AL CONTRATO
						$respuesta 	= 	$recaudo->guardarnuevoestado($nuevoestado, $v_contratoid, $est_cta_usuario_id, $cc_observacion, $ot_id);
						// MUESTRA UNA MODAL CON LOS SIGUIENTES DATOS
						echo $respuesta ? "Estado actualizado correctamente, Se ha creado una nueva orden de trabajo":"El estado no pudo ser actualizado "; 

					}
					else
					{
						// SI NO SE PUEDE CREAR LA OT MUESTRA EL SIGUIENTE MENSAJE
						$respuesta 	= 	'No se pudo guardar OT';
					}

				}
				else if($nuevoestado == 13 || $nuevoestado == 14)
				{
					// CREA LA ORDEN DE TRABAJO
					$result_ot 	= 	nuevo_OT(date('Y/m/d'), $cc_observacion, $nuevoestado, $v_contratoid, $est_cta_usuario_id, date('Y/m/d'), 0, 'null', 1);	

					/// ASIGNA RUTA DE LA IMAGEN PARA CREAR LA CARPETA DE ALMACENAMIENTO
					$carpeta 	= 	"../files/solicitudes/otrosi".$v_contratoid;

					if(!is_dir($carpeta))
					{
						// CREA LA CARPETA
						mkdir($carpeta,0777);
						$ext 		=	explode(".", $_FILES["documento"]["name"]);
						$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
						// SUBE EL ARCHIVO A LA CARPETA DEL SERVIDOR
						move_uploaded_file($_FILES["documento"]["tmp_name"] , $carpeta."/".$doc_imagen);

						// INSERTA EL DATO DE UBICACION DE LA IMAGEN EN LA BD
						$insert_img->insertarImagen($v_contratoid,2,$doc_imagen,  $result_ot);
					}
					else
					{
						// SI LA CARPETA YA EXISTE SOLO COPIA LA IMAGEN
						$ext 		=	explode(".", $_FILES["documento"]["name"]);
						$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
						move_uploaded_file($_FILES["documento"]["tmp_name"] , $carpeta."/".$doc_imagen);	
						// INSERTA EL DATO DE UBICACION DE LA IMAGEN EN LA BD
						$insert_img->insertarImagen($v_contratoid,2,$doc_imagen, $result_ot);
					}
					// SI NO FALLA LA CREACION DE LA OT HACE LO SIGUIENTE
					if(!empty($result_ot))
					{
						$ot_id = $result_ot;

						/// GUARDA EL NUEVO ESTADO AL CONTRATO
						$respuesta 	= 	$recaudo->guardarnuevoestado($nuevoestado, $v_contratoid, $est_cta_usuario_id, $cc_observacion, $ot_id);
						// MUESTRA UNA MODAL CON LOS SIGUIENTES DATOS
						echo $respuesta ? "Estado actualizado correctamente, Se ha creado una nueva orden de trabajo":"El estado no pudo ser actualizado "; 

					}
					else
					{
						// SI NO SE PUEDE CREAR LA OT MUESTRA EL SIGUIENTE MENSAJE
						$respuesta 	= 	'No se pudo guardar OT';
					}
				}
				else
				{
					// SI LA OPERACION ES DIFERENTE A CORTE POR RETIRO O A POR SUSPENDER CREA OT SIN IMAGEN 
					// CREA LA OT
					$result_ot 	= 	nuevo_OT(date('Y/m/d'), $cc_observacion, $nuevoestado, $v_contratoid, $est_cta_usuario_id, date('Y/m/d'), 0, 'null', 1);	

					/// SI SE CREA LA OT GUARDA EL NUEVO ESTADO AL CONTRATO
					if(!empty($result_ot))
					{
						$ot_id = $result_ot;

						$respuesta 	= 	$recaudo->guardarnuevoestado($nuevoestado, $v_contratoid, $est_cta_usuario_id, $cc_observacion, $ot_id);
						
						echo $respuesta ? "Estado actualizado correctamente, Se ha creado una nueva orden de trabajo":"El estado no pudo ser actualizado "; //reubicar 

					}
					else
					{// SI NO SE PUEDE CREAR LA OT MUESTRA ESTE MENSAJE
						$respuesta 	= 	'No se pudo guardar OT';
					}
				}

				
			}
	// SI YA EXISTE UNA ORDEN DE TRABAJO HACE LO SIGUIENTE			
			else
			{
				// Si el tecnico esta en 0 aún no ha sido asignado, y el sistema permite modificar la ot creada. 
				if($respuesta2['ord_trab_tecnico_id'] == 0)
				{

					//VALIDACION SI EL ESTADO ES 8 POR SUSPENDER O SI ES 11 POR RETIRO
					if($nuevoestado == 11 || $nuevoestado == 8)
					{
						$img_act 	=  $insert_img->validarImagen($respuesta2['ord_trab_id'], 2);
						// VARIABLE PARA ASIGNAR RUTA A LA CARPETA
						$carpeta 	= 	"../files/solicitudes/".$v_contratoid;

						if(!is_dir($carpeta))
						{
							// CREA LA CARPETA
							mkdir($carpeta,0777);
							// EXTRAE LA EXTENSION DEL ARCHIVO CARGADO
							$ext 		=	explode(".", $_FILES["documento"]["name"]);
							// LE PONE UN NOMBRE A LA IMAGEN
							$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
							// SUBE EL ARCHIVO A LA CARPETA DEL SERVIDOR
							move_uploaded_file($_FILES["documento"]["tmp_name"] , $carpeta."/".$doc_imagen);
							// INSERTA EL DATO DE UBICACION DE LA IMAGEN EN LA BD
							$insert_img->insertarImagen($v_contratoid,2,$doc_imagen, $respuesta2['ord_trab_id']);
						}
						// SI LA CARPETA YA EXISTE SOLO COPIA LA IMAGEN
						else
						{
							// EXTRAE LA EXTENSION DEL ARCHIVO CARGADO 
							$ext 		=	explode(".", $_FILES["documento"]["name"]);
							// LE PONE UN NOMBRE A LA IMAGEN
							$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
							// MUEVE LA IMAGEN AL SERVIDOR
							move_uploaded_file(
								$_FILES["documento"]["tmp_name"], 
								$carpeta."/".$doc_imagen);	
							// INSERTA EL DATO DE UBICACION DE LA IMAGEN EN LA BD		
							$insert_img->insertarImagen(
													$v_contratoid,
													2,
													$doc_imagen,
													$respuesta2['ord_trab_id']);
							
						}
						// MODIFICA LA OBSERVACION A LA ORDEN DE TRABAJO 
						update_OT(
							$respuesta2['ord_trab_id'],
							date('Y/m/d'),
							date('Y/m/d'),
							$nuevoestado,
							$respuesta2['ord_trab_contrato_id'],
							$est_cta_usuario_id,
							$cc_observacion,
							1);
						// GUARDA EL REGISTRO DEL CAMBIO DE ESTADO
						$respuesta 	= 	$recaudo->guardarnuevoestado($nuevoestado, $v_contratoid, $est_cta_usuario_id, $cc_observacion, $respuesta2['ord_trab_id']);
						// MUESTRA UN RESULTADO DE LA LABOR
						echo $respuesta ? 	"Observación actualizada " : "Observación no pudo ser actualizada";
					}
					// SI EL CAMBIO DE ESTADO ES DIFERENTE A POR CORTAR O POR SUSPENDER HACE LO SIGUIENTE
					else
					{
						// MODIFICA LA OBSERVACION A LA ORDEN DE TRABAJO 
						update_OT(
							$respuesta2['ord_trab_id'],
							date('Y/m/d'),
							date('Y/m/d'),
							$nuevoestado,
							$respuesta2['ord_trab_contrato_id'],
							$est_cta_usuario_id,
							$cc_observacion,
							1);
						// GUARDA EL REGISTRO DEL CAMBIO DE ESTADO
						$respuesta 	= 	$recaudo->guardarnuevoestado($nuevoestado, $v_contratoid, $est_cta_usuario_id, $cc_observacion, $respuesta2['ord_trab_id']);
						// MUESTRA UN RESULTADO DE LA LABOR
						echo $respuesta ? 	"Observación actualizada " : "Observación no pudo ser actualizada";
					}
				}
/// FIN VALIDACION DEL TECNICO ACTIVO	
				else
				{
					//VALIDACION SI EL ESTADO ES 8 POR SUSPENDER O SI ES 11 POR RETIRO
					if($nuevoestado == 11 || $nuevoestado == 8)
					{
						// VARIABLE PARA ASIGNAR RUTA A LA CARPETA
						$carpeta 	= 	"../files/solicitudes/".$v_contratoid;

						if(!is_dir($carpeta))
						{
							// CREA LA CARPETA
							mkdir($carpeta,0777);
							// EXTRAE LA EXTENSION DEL ARCHIVO CARGADO
							$ext 		=	explode(".", $_FILES["documento"]["name"]);
							// LE PONE UN NOMBRE A LA IMAGEN
							$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
							// SUBE EL ARCHIVO A LA CARPETA DEL SERVIDOR
							move_uploaded_file($_FILES["documento"]["tmp_name"] , $carpeta."/".$doc_imagen);
							// INSERTA EL DATO DE UBICACION DE LA IMAGEN EN LA BD
							$insert_img->insertarImagen($v_contratoid,2,$doc_imagen, $respuesta2['ord_trab_id']);
						}
						// SI LA CARPETA YA EXISTE SOLO COPIA LA IMAGEN
						else
						{
							// EXTRAE LA EXTENSION DEL ARCHIVO CARGADO 
							$ext 		=	explode(".", $_FILES["documento"]["name"]);
							// LE PONE UN NOMBRE A LA IMAGEN
							$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
							// MUEVE LA IMAGEN AL SERVIDOR
							move_uploaded_file(
								$_FILES["documento"]["tmp_name"], 
								$carpeta."/".$doc_imagen);	
							// INSERTA EL DATO DE UBICACION DE LA IMAGEN EN LA BD		
							$insert_img 	= 	$or_trab->insertarImagen(
													$v_contratoid,
													2,
													$doc_imagen,
													$respuesta2['ord_trab_id']);
							
						}
						// CREA LA OBSERVACION A LA ORDEN DE TRABAJO 
						seguimiento_OT(
							'null',
							$respuesta2['ord_trab_id'],
							$respuesta2['ord_trab_fecha_vencimiento'],
							$respuesta2['ord_trab_fecha_vencimiento'],
							$respuesta2['ord_trab_operacion_id'],
							$respuesta2['ord_trab_contrato_id'],
							$respuesta2['ord_trab_tecnico_id'],
							$cc_observacion, $est_cta_usuario_id);

						// CAMBIA EL ESTADO DEL CONTRATO Y ALMACENA LA OPERACION
						$respuesta 	= 	$recaudo->guardarnuevoestado($nuevoestado, $v_contratoid, $est_cta_usuario_id, $cc_observacion, $respuesta2['ord_trab_id']);
						// MUESTRA UN RESULTADO DE LA LABOR
						echo $respuesta ? 	"Observación registrada " : "Observación no pudo ser actualizada";
					}
					// SI EL CAMBIO DE ESTADO ES DIFERENTE A POR CORTAR O POR SUSPENDER HACE LO SIGUIENTE
					else
					{
						// CREA LA OBSERVACION A LA ORDEN DE TRABAJO EXISTENTE
						seguimiento_OT(
							'null',
							$respuesta2['ord_trab_id'],
							$respuesta2['ord_trab_fecha_vencimiento'],
							$respuesta2['ord_trab_fecha_vencimiento'],
							$respuesta2['ord_trab_operacion_id'],
							$respuesta2['ord_trab_contrato_id'],
							$respuesta2['ord_trab_tecnico_id'],
							$cc_observacion, 
							$est_cta_usuario_id,
							$respuesta2['ord_trab_resp_activ_id']);

						// REALIZA EL CAMBIO Y ALMACENA LA OPERACION DE REGISTRO DE CAMBIO DE ESTADO 
						$respuesta 	= 	$recaudo->guardarnuevoestado(
											$nuevoestado,
											$v_contratoid,
											$est_cta_usuario_id, 
											$cc_observacion,
											$respuesta2['ord_trab_id']);

						// MUESTRA EL RESULTADO DE LA LABOR
						echo $respuesta ? 	"Observación registrada " : "Observación no pudo ser actualizada";
					}
					
				}
			}
			break;	

		// by Steven Guantiva
		case 'ocultar_registro_tabla':
        	$respuesta = $recaudo->ocultar_registro_tabla($est_cta_id);
        break;

}


// FUNCION PARA CREAR LA ORDEN DE TRABAJO 
function nuevo_OT(
	$ord_trab_fecha_programacion, 
	$ord_trab_observacion,
	$ord_trab_operacion_id,
	$ord_trab_contrato_id,
	$ord_trab_responsable_id,
	$ord_trab_fecha_vencimiento,
	$ord_trab_tecnico_id,
	$ord_trab_id,
	$ord_estado)
{

	$or_trab 	= 	new OrdenTrabajo(); 
	$respuesta	= 	$or_trab->insertar(
			$ord_trab_id,
			$ord_trab_fecha_programacion,
			$ord_trab_fecha_vencimiento,	
			$ord_trab_operacion_id,
			$ord_trab_tecnico_id,
			$ord_trab_contrato_id,
			$ord_trab_responsable_id,
			$ord_estado,
			$ord_trab_observacion);

	return $respuesta;
}

function update_OT(
	$ord_trab_id,
	$ord_trab_fecha_programacion,
	$ord_trab_fecha_vencimiento,
	$ord_trab_operacion_id,
	$ord_trab_contrato_id,
	$ord_trab_responsable_id,
	$ord_trab_observacion,
	$ord_estado)
{

	$or_trab 	= 	new OrdenTrabajo(); 
	$respuesta	= 	$or_trab->editar(
			$ord_trab_id,
			$ord_trab_fecha_programacion,
			$ord_trab_fecha_vencimiento,	
			$ord_trab_operacion_id,
			$ord_trab_contrato_id,
			$ord_trab_responsable_id,
			$ord_trab_observacion,
			$ord_estado);

	return $respuesta;
}

// FUNCION PARA ASIGNAR OBSERVACION A LA ORDEN DE TRABAJO
function seguimiento_OT(
	$ots_id,
	$ord_trab_id,
	$ord_trab_nuevo_vencimiento,
	$ot_vencia,
	$ots_operacion_id,
	$ots_contrato_id,
	$tec_ant,
	$obsrv,
	$ots_responsable_id,
	$resp_act_id)
{

	$seguimiento_OT 	= 	new SeguimientoOT(); 
	$respuesta	= 	$seguimiento_OT->insertar(
			$ots_id,
			$ord_trab_id,
			$ord_trab_nuevo_vencimiento,
			$ot_vencia,
			$ots_operacion_id,
			$ots_contrato_id,
			$tec_ant,
			$obsrv,
			$ots_responsable_id,
			$resp_act_id);

	return $respuesta;
}
// fin de maintenance 

?>