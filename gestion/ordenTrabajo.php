<?php session_start();
// # encodé par @Anderson Ferrucho 
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

require_once "../modelos/OrdenTrabajo.php";
require_once "../modelos/Contrato.php";
require_once "../modelos/Persona.php";
require_once "../modelos/EquipoDetalle.php";

$ordenTrabajo 	= 	new OrdenTrabajo();
$contrato 		= 	new Contrato();

// VALORES QUE SE ENVIAN DESDE EL FORMULARIO DE REGISTRO
$cont_id 						= 	isset($_POST['cont_id'])? limpiarCadena($_POST['cont_id']):"";
$ord_trab_id 					= 	isset($_POST['ord_trab_id'])? limpiarCadena($_POST['ord_trab_id']):"";
$ord_trab_fecha_programacion	= 	isset($_POST['ord_trab_fecha_programacion'])? limpiarCadena($_POST['ord_trab_fecha_programacion']):"";
$ord_trab_fecha_vencimiento		= 	isset($_POST['ord_trab_fecha_vencimiento'])? limpiarCadena($_POST['ord_trab_fecha_vencimiento']):"";
$ord_estado 					= 	1;
$ord_trab_contrato_id			= 	isset($_POST['ord_trab_contrato_id'])? limpiarCadena($_POST['ord_trab_contrato_id']):"";
$ord_trab_responsable_id		= 	$_SESSION['usu_id'];
$ord_trab_tecnico_id			= 	isset($_POST['ord_trab_tecnico_id'])? limpiarCadena($_POST['ord_trab_tecnico_id']):"";			
$ord_trab_observacion			= 	isset($_POST['ord_trab_observacion'])? limpiarCadena($_POST['ord_trab_observacion']):"";

// VERIFICA SI EL VALOR DE LA OPERACION ESTA VACIO ASÍ IDENTIFICA SI ES UN NUEVO CONTRATO
if(empty($_POST['ord_trab_operacion_id']))
{
	// ASIGNA A LA OPERACION EL 1 QUE ES EL ESTADO POR INSTALAR
	$ord_trab_operacion_id 		= 	1;	
}
else
{	
	//ASIGNA EL VALOR QUE REGISTRA EL USUARIO EN EL FORMULARIO 
	$ord_trab_operacion_id		= 	isset($_POST['ord_trab_operacion_id'])? limpiarCadena($_POST['ord_trab_operacion_id']):"";
}

switch($_GET["op"])
{
	case 'guardaryeditar':

	require_once 	'../modelos/OrdenTrabajo.php';
		$ot_activa 	= 	new 	OrdenTrabajo(); 
		// REALIZA UNA VALIDACIÓN DE OT ACTIVA POR EL NUMERO DE CONTRATO
		$respuesta2	= 	$ot_activa->validarOTActiva($ord_trab_contrato_id);
			// SI NO ENCUENTRA RESPUESTA REALIZA LO SIGUIENTE
			if(empty($respuesta2))
			{	
				//VERIFICA SI NO HAY REGISTRO DE UN EQUIPO EN LA OT
				if(empty($_POST['id_detalle_equipo']))
				{
					// Asigna a la variable respuesta la funcion insertar de la clase OrdenTrabajo con los parametros recibidos por post
					$respuesta 	= 	$ordenTrabajo->insertar(
						$ord_trab_id,
						$ord_trab_fecha_programacion,
						$ord_trab_fecha_vencimiento,	
						$ord_trab_operacion_id,
						$ord_trab_tecnico_id,
						$ord_trab_contrato_id,
						$ord_trab_responsable_id,
						$ord_estado,
						$ord_trab_observacion	
					);
					// dans la variable repons assigner la fonction guardarNuevoEstado du la classe ordenTrbajo
					$repons 	= 	$ordenTrabajo->guardarNuevoEstado(
											$ord_trab_operacion_id,
											$ord_trab_contrato_id,
											$ord_trab_responsable_id);
					// assigner ici une valeur en réponse a l'opération
					echo $respuesta ? 	"Orden de trabajo registrada" : "Orden de trabajo no pudo ser registrada";
				}
				// si línsertion a une équipe assignée fait ce qui suit
				else
				{
					// dans la variable respuesta assigner la fonction insertarOTconEquipo du la classe ordenTrbajo
					$respuesta 	= 	$ordenTrabajo->insertarOTconEquipo(
						$ord_trab_id,
						$ord_trab_fecha_programacion,
						$ord_trab_fecha_vencimiento,	
						$ord_trab_operacion_id,
						$ord_trab_tecnico_id,
						$ord_trab_contrato_id,
						$ord_trab_responsable_id,
						$ord_trab_observacion,
						$_POST['id_detalle_equipo'],
						$_POST['cliente']
					);
					// assigner ici une valeur en réponse a l'opération
					echo $respuesta ? 	"La Orden de trabajo y " . count($_POST['id_detalle_equipo']) . " equipos han sido registrados" : "Los datos no pudieron ser registrados";
				}
			}
			// si vous avez déja un bon de travail actif fait ce qui suit
			else
			{
				//valider si le technicien est affecté
				if($respuesta2['ord_trab_tecnico_id'] == 0)	
				{

				}
				//si vous avez déja un technicien affecté, vous ne pouvez pas créer plus de commandes
				else
				{	
					// et montre ce qui suit message
					$respuesta = "!! ESTE CONTRATO TIENE UNA ORDEN DE TRABAJO ACTIVA, NO SE PUEDEN CREAR NUEVAS ORDENES MIENTRAS EXISTA UNA ACTIVA, POR FAVOR CIERRE LA QUE SE ENCUENTRA ACTIVA E INTENTE CREAR NUEVAMENTE ¡¡ ";	

				echo 	$respuesta;	
				}
			}
	
	break;

	case 'mostrar':

		$respuesta 		= 	$ordenTrabajo->mostrar($cont_id);
		// codifica el resultado mediante json
		echo json_encode($respuesta);

		$ot_activa 	= 	new 	OrdenTrabajo();
		$respuesta2	= 	$ot_activa->validarOTActiva($cont_id);// mediante esta linea valida si tiene una OT activa

		break;

	case 'llamarObservacion':

		$observacion_caja 		= 	$ordenTrabajo->llamarObservacion($cont_id);
		// codifica el resultado mediante json
		echo json_encode($observacion_caja);

		break;


	case 'nuevoestado':
		$respuesta = $ordenTrabajo->nuevoEstado();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->est_serv_id.'>'.$reg->est_serv_nombre.'</option>';
		}
		break;

	case 'listar':

		$respuesta = $ordenTrabajo->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();

		$ot 	=	'';
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			// Identificador de permanencia

			$servicio ="";

			if ($reg->cont_tv_analogica == 1) {
				$servicio = " TV-ANA ";
			}
			if ($reg->cont_tv_digital == 1) {
				$servicio =$servicio." TV-DG";
			}
			if ($reg->cont_internet == 1) {
				$servicio =$servicio. "+ INTER";
			}

			$respuesta2		= 	$ordenTrabajo->validarOTActiva($reg->cont_id);
			$estado			= 	$ordenTrabajo->fechaEstado($reg->cont_id);

			$obsrv_estado 	= 	$estado['cc_est_ser_observacion'];
			$fecha_estado 	=	$estado['cc_est_ser_fecha'];

			if(!empty($respuesta2))
			{
				if($respuesta2['ord_trab_tecnico_id'] == 0)
				{
					$ot 	= 	'<i class="fa fa-circle" style="color: green;"></i>';
				}
				else
				{
					$ot 	= 	'<i class="fa fa-circle" style="color: red;"></i>';	
				}
			}
			else
			{
				$ot 	= 	'<i class="fa fa-circle" style="color: green;"></i>';
			}
			

			$perm = "";
			if ($reg->cont_permanencia == 1) {
				$perm = "SI";
			}elseif($reg->cont_permanencia == 0){
				$perm = "NO";
			}else{
				$perm = "Error";
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
				$estadoservicio = '<span class="label bg-red">02 Agr. Producto</span>';	
			}
			elseif($reg->cont_estado_servicio_id >= 14){
				$estadoservicio = 'Error ST1002';
			}


			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>$reg->cont_no_contrato."-".$reg->cont_id,
				"1"=>$reg->per_nombre." ".$reg->per_apellido,
				"2"=>$reg->per_num_documento,
				"3"=>$estadoservicio,
				"4"=>$fecha_estado,
				"5"=>$obsrv_estado,
				"6"=>$reg->cont_direccion_serv,
				"7"=>$reg->sed_nombre,
				"8"=>'<button class="btn btn-warning" data-toggle="tooltip" title="Generar OT." onclick="mostrar('.$reg->cont_id.')"><i class="fa"></i>OT</button> '. $ot,				
				"9"=>$servicio,
				"10"=>$reg->cont_vigencia_a_partir,
				"11"=>$reg->per_telefono_1);

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
				"2"=>'<a data-toggle="modal" href="#myModal"><button name="boton" data-toggle="tooltip" title="Seleccionar Equipo"class="btn btn-warning" onclick="listarEquipoDetalle()"><i class="fa fa-plus-circle"></i></button>'
				/// <a data-toggle="modal" href="#myModal"> permite mostrar la ventana modal
				);
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
				"5"=>'<button id="equipo" class="btn btn-warning" data-toggle="tooltip" title="Asignar Equipo" onclick="asignarEquipo('. $reg->equi_det_id .', \''.$reg->equi_tip_nombre.'\',\''. $reg->equi_referencia .'\',\''. $reg->equi_det_mac .'\',\''. $reg->equi_det_sn .'\')"><i class="fa fa-plus"></i></button>');
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

	case 'selectContrato':

		require_once '../modelos/Contrato.php';
		$contrato 	= 	new Contrato();

		$respuesta 	=	$contrato->select();
		while ($reg = 	$respuesta->fetch_object())
		{
			echo '<option value=' . $reg->cont_id . '>'.$reg->cont_id. '-' .$reg->cont_no_contrato . '</option>';
		}
		break;

	case 'selectEstado':

		$estado 	= 	new OrdenTrabajo();

		$respuesta 	=	$estado->selectEstado();
		while ($reg = 	$respuesta->fetch_object())
		{
			echo '<option value=' . $reg->est_serv_id . '>'.$reg->est_serv_id. '-' .$reg->est_serv_nombre . '</option>';
		}
		break;

	case 'selectContrato':

		require_once '../modelos/Contrato.php';
		$contrato 	= 	new Contrato();

		$respuesta 	=	$contrato->select();
		while ($reg = 	$respuesta->fetch_object())
		{
			echo '<option value=' . $reg->cont_id . '>'.$reg->cont_id. '-' .$reg->cont_no_contrato . '</option>';
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
		$comodato 	=	'';

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
				"6"=>$comodato);
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


		case 'validarOTActiva':

		

		if($respuesta == true)
		{
			echo 'excelente';
		}
		else
		{
			echo 'que mal';	
		}

		break;

}

?>