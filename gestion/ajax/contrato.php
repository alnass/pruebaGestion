<?php 
session_start();
// # encoded by @Francisco Monsalve
// maintenance effectuee par Anderson Ferrucho

require_once "../modelos/Contrato.php";
require_once "../modelos/Corporativo.php";
require_once "../modelos/Recaudo.php";
require_once "../modelos/OrdenTrabajo.php";
require_once "../modelos/SeguimientoOT.php";

$ordenTrabajo 	= 	new OrdenTrabajo();
$contrato 		=	new Contrato();
$corporativo 	=	new Corporativo();
$recaudo	 	= 	new Recaudo();

$per_id 				= isset($_POST['per_id'])? limpiarCadena($_POST['per_id']):"";
$per_tipo_persona_id 	= isset($_POST['tipoPersona'])? limpiarCadena($_POST['tipoPersona']):"";
$per_tipo_cliente_id 	= isset($_POST['tipoCliente'])? limpiarCadena($_POST['tipoCliente']):"";
$per_alianza_id 		= $_SESSION['usu_alianza_id'];
$per_tipo_documento_id 	= isset($_POST['tipoDoc'])? limpiarCadena($_POST['tipoDoc']):"";
$per_num_documento 		= isset($_POST['numDoc'])? limpiarCadena($_POST['numDoc']):"";
$per_nombre 			= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$per_apellido 			= isset($_POST['apellido'])? limpiarCadena($_POST['apellido']):"";
$per_telefono_1 		= isset($_POST['tel1'])? limpiarCadena($_POST['tel1']):"";
$per_telefono_2 		= isset($_POST['tel2'])? limpiarCadena($_POST['tel2']):"";
$per_ciudad_id 			= isset($_POST['ciudad'])? limpiarCadena($_POST['ciudad']):"";

$per_barrio 			= isset($_POST['barrio'])? limpiarCadena($_POST['barrio']):"";
$per_tipo_vivienda_id 	= isset($_POST['tipoVivien'])? limpiarCadena($_POST['tipoVivien']):"";
$per_direccion 			= isset($_POST['direccion'])? limpiarCadena($_POST['direccion']):"";
$per_correo_personal 	= isset($_POST['correoPer'])? limpiarCadena($_POST['correoPer']):"";
$cont_id 				= isset($_POST['cont_id'])? limpiarCadena($_POST['cont_id']):"";
$cont_persona_id 		= isset($_POST['persona_id'])? limpiarCadena($_POST['persona_id']):"";
$cont_direccion_serv 	= isset($_POST['direccion_serv'])? limpiarCadena($_POST['direccion_serv']):"";
$cont_barrio 			= isset($_POST['contbarrio'])? limpiarCadena($_POST['contbarrio']):"";
$cont_tipo_vivienda_id	= isset($_POST['conttipvivi'])? limpiarCadena($_POST['conttipvivi']):"";
$cont_estrato 			= isset($_POST['estrato'])? limpiarCadena($_POST['estrato']):"";
$cont_minimo_mensual 	= isset($_POST['minimo_mensual'])? limpiarCadena($_POST['minimo_mensual']):"";
$cont_vigencia_a_partir = isset($_POST['vigencia_a_partir'])? limpiarCadena($_POST['vigencia_a_partir']):"";

$cont_renovacion_auto 	= isset($_POST['renovacion_auto'])? limpiarCadena($_POST['renovacion_auto']):"";
$cont_tv_analogica 		= isset($_POST['tv_analogica'])? limpiarCadena($_POST['tv_analogica']):"";
$cont_tv_digital 		= isset($_POST['tv_digital'])? limpiarCadena($_POST['tv_digital']):"";
$cont_internet 			= isset($_POST['internet'])? limpiarCadena($_POST['internet']):"";
$cont_adicional 		= isset($_POST['adicional'])? limpiarCadena($_POST['adicional']):"";
$cont_fecha_activacion 	= isset($_POST['fecha_activacion'])? limpiarCadena($_POST['fecha_activacion']):"";
$cont_valor_basico_mes 	= isset($_POST['minimo_mensual'])? limpiarCadena($_POST['minimo_mensual']):"";
$cont_valor_total_mes 	= isset($_POST['minimo_mensual'])? limpiarCadena($_POST['minimo_mensual']):"";
$cont_permanencia 		= isset($_POST['permanencia'])? limpiarCadena($_POST['permanencia']):"";
$cont_cargo_conexion 	= isset($_POST['cargo_conexion'])? limpiarCadena($_POST['cargo_conexion']):"";
$cont_valor_diferido 	= isset($_POST['valor_diferido'])? limpiarCadena($_POST['valor_diferido']):"";
$cont_fecha_ini_perm 	= isset($_POST['fecha_ini_perm'])? limpiarCadena($_POST['fecha_ini_perm']):"";
$cont_fecha_fin_perm 	= isset($_POST['fecha_fin_perm'])? limpiarCadena($_POST['fecha_fin_perm']):"";
$cont_costo_reconexion 	= isset($_POST['costo_reconexion'])? limpiarCadena($_POST['costo_reconexion']):"";
$cargo_adicional	 	= isset($_POST['cargo_adicional'])? limpiarCadena($_POST['cargo_adicional']):"";
date_default_timezone_set('America/Bogota');
$cont_fecha_transaccion = date("Y-m-d H:i:s");
$cont_usuario_id		= $_SESSION['usu_id'];
$cont_sede_id			= $_SESSION['usu_sede_id'];

switch ($_GET["op"]) {
	case 'guardaryeditar':

		// Trae el codigo del departamento y el codigo de la ciudad 
		$sql = "SELECT ciu_depto_codigo, ciu_codigo FROM ciudad WHERE ciu_id = '$per_ciudad_id'";
		$a = ejecutarConsultaSimpleFila($sql);

		$sqlExistente = "SELECT * FROM persona
						WHERE per_num_documento = '$per_num_documento'
						";
		$existente = ejecutarConsultaSimpleFila($sqlExistente);

		if (empty($existente)) {
			
			if (empty($per_id)) {

				if ($cont_permanencia == 1) {
					$respuesta = $contrato->insertar(
						$per_id,
						$per_tipo_persona_id,
						$per_tipo_cliente_id,
						$per_alianza_id,
						$per_tipo_documento_id,
						$per_num_documento,
						$per_nombre,
						$per_apellido,
						$per_telefono_1,
						$per_telefono_2,
						$per_ciudad_id,
						$per_barrio,
						$per_tipo_vivienda_id,
						$per_direccion,
						$per_correo_personal,
						$cont_id, 	
						$cont_no_contrato = $a['ciu_depto_codigo'].$a['ciu_codigo'],
						$cont_persona_id,	
						$cont_direccion_serv,
						$cont_barrio,
						$cont_tipo_vivienda_id,
						$cont_estrato,	
						$cont_minimo_mensual,	
						$cont_vigencia_a_partir,	
						$cont_renovacion_auto,	
						$cont_tv_analogica,	
						$cont_tv_digital,
						$cont_internet,
						$cont_adicional,
						$cont_fecha_activacion,
						$cont_valor_basico_mes,	
						$cont_valor_total_mes,	
						$cont_permanencia,
						$cont_cargo_conexion,
						$cont_valor_diferido,
						$cont_fecha_ini_perm,
						$cont_fecha_fin_perm,	
						$cont_costo_reconexion,
						$cont_fecha_transaccion,
						$cont_sede_id,
						$cont_usuario_id,
						$_POST["cont_prod_producto_id"],
						$_POST["cont_prod_cantidad"] ,
						$_POST["cont_prod_precio"],
						$cargo_adicional
					);
					echo $respuesta ? "Contrato registrado exitosamente" : "El contrato no pudo ser registrado completamente"; 
				}else{
					$respuesta = $contrato->insertarsinpermanencia (
						$per_id,
						$per_tipo_persona_id,
						$per_tipo_cliente_id,
						$per_alianza_id,
						$per_tipo_documento_id,
						$per_num_documento,
						$per_nombre,
						$per_apellido,
						$per_telefono_1,
						$per_telefono_2,
						$per_ciudad_id,
						$per_barrio,
						$per_tipo_vivienda_id,
						$per_direccion,
						$per_correo_personal,
						$cont_id, 	
						$cont_no_contrato = $a['ciu_depto_codigo'].$a['ciu_codigo'],
						$cont_persona_id,	
						$cont_direccion_serv,
						$cont_barrio,
						$cont_tipo_vivienda_id,
						$cont_estrato,	
						$cont_minimo_mensual,	
						$cont_vigencia_a_partir,	
						$cont_renovacion_auto,	
						$cont_tv_analogica,	
						$cont_tv_digital,
						$cont_internet,
						$cont_adicional,
						$cont_fecha_activacion,
						$cont_valor_basico_mes,	
						$cont_valor_total_mes,	
						$cont_permanencia,
						$cont_cargo_conexion,
						$cont_valor_diferido,
						$cont_fecha_ini_perm,
						$cont_fecha_fin_perm,	
						$cont_costo_reconexion,
						$cont_fecha_transaccion,
						$cont_sede_id,
						$cont_usuario_id,
						$_POST["cont_prod_producto_id"],
						$_POST["cont_prod_cantidad"] ,
						$_POST["cont_prod_precio"],
						$cargo_adicional
					);
					
					echo $respuesta ? "Contrato registrado exitosamente" : "El contrato no pudo ser registrado completamente"; 
				}
			}
		}else{
			echo "El suscriptor ya se encuentra registrado en la base de datos";
		}

		break;

	case 'desactivar':
		$respuesta = $contrato->desactivar($cont_id);
		echo $respuesta ? "Contrato desactivado" : "No ha sido posuble desactivar el contrato";
		break;

	case 'activar':
		$respuesta = $contrato->activar($cont_id);
		echo $respuesta ? "Contrato activado" : "No ha sido posible activar el contrato";
		break;

	case 'mostrar':
		$respuesta = $contrato->mostrar($cont_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':

		// Maintenance
		if($_SESSION['usu_sede_id'] == 11)
		{	
			$respuesta = $corporativo->listarCorporativo();
		}
		else
		{
			$respuesta = $contrato->listar();
		}
		// fin Maintenance

		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) 
		{
			// Identificador de permanencia
			$perm = "";
			if ($reg->cont_permanencia == 1) {
				$perm = "SI";
			}elseif($reg->cont_permanencia == 0){
				$perm = "NO";
			}else{
				$perm = "Error";
			}

			if(!empty($reg->per_correo_personal))
			{
				if(!empty($reg->per_correo_corp))
				{
					$correo = 	$reg->per_correo_personal .' - ' .$reg->per_correo_corp;
				}
				else
				{
					$correo = 	$reg->per_correo_personal;
				}
			}
			else
			{
				$correo =	'Sin correo registrado';
			}

			$data[] = array
			(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>'<a href="../reportes/impContrato.php?cont_id='.$reg->cont_id.'" target="_blanck" style="text-decoration:nome;">
					<button data-toggle="tooltip" data-placement="right" title="Imprimir contrato"  class="btn btn-default">
						<i class="fa fa-print"></i>
					</button>
					</a>',
				"1"=>'<button  class="btn btn-success" data-toggle="tooltip" data-placement="right" title="Agregar o Cambiar productos" onclick="verform2('.$reg->cont_id.',\''.$reg->per_nombre.'\',\''.$reg->per_apellido.'\',\''.$reg->cont_direccion_serv.'\','.$reg->cont_minimo_mensual.','.$reg->cont_tv_analogica.','.$reg->cont_tv_digital.','.$reg->cont_internet.')"><i class="fa fa-plus"></i></button>',
				"2"=>$reg->cont_no_contrato."-".$reg->cont_id,
				"3"=>'$ '.number_format($reg->cont_minimo_mensual),
				"4"=>$reg->per_nombre." ".$reg->per_apellido,
				"5"=>$reg->per_num_documento,
				"6"=>$reg->per_telefono_1,
				"7"=>$reg->cont_vigencia_a_partir,
				"8"=>$perm,
				"9"=>$correo,
				"10"=>$reg->cont_fecha_transaccion,
				"11"=>($reg->cont_estado)?'<span class="label bg-green">Vigente</span>':'<span class="label bg-gray">Cancelado</span>'
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

	case 'listardesactivar':
		$respuesta = $contrato->listar();
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

			if($reg->cont_estado_servicio_id == 1)
			{
				$estado 	= 	'14-Por Instalar';
			}
			else if($reg->cont_estado_servicio_id == 2)
			{
				$estado 	= 	'11-Activo';
			}
			else if($reg->cont_estado_servicio_id == 3)
			{
				$estado 	= 	'13-Por Cortar';
			}
			else if($reg->cont_estado_servicio_id == 4)
			{
				$estado 	= 	'14-Cortado';
			}
			else if($reg->cont_estado_servicio_id == 5)
			{
				$estado 	= 	'05-Por Reconectar';
			}
			else if($reg->cont_estado_servicio_id == 6)
			{
				$estado 	= 	'06-Supendido';
			}
			else if($reg->cont_estado_servicio_id == 7)
			{
				$estado 	= 	'07-Reco Supención';
			}
			else if($reg->cont_estado_servicio_id == 8)
			{
				$estado 	= 	'08-Por Suspender';
			}
			else if($reg->cont_estado_servicio_id == 9)
			{
				$estado 	= 	'09-Mantenimient';
			}
			else if($reg->cont_estado_servicio_id == 10)
			{
				$estado 	= 	'04-Retirado';
			}
			else if($reg->cont_estado_servicio_id == 11)
			{
				$estado 	= 	'11-Corte por Retiro';
			}
			else if($reg->cont_estado_servicio_id == 12)
			{
				$estado 	= 	'12-Por Traslado';
			}
			else if($reg->cont_estado_servicio_id == 13)
			{
				$estado 	= 	'01-Agr. Producto';
			}
			else if($reg->cont_estado_servicio_id == 14)
			{
				$estado 	= 	'02-Camb. Producto';
			}

			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>'<button data-toggle="tooltip" data-placement="right" title="Cancelar contrato"  class="btn btn-danger" onclick="desactivar('.$reg->cont_id.')">
						<i class="fa fa-times"></i>
					</button>
					',
				"1"=>$reg->cont_no_contrato."-".$reg->cont_id,
				"2"=>'$ '.number_format($reg->cont_minimo_mensual),
				"3"=>$reg->per_nombre." ".$reg->per_apellido,
				"4"=>$reg->per_num_documento,
				"5"=>$reg->per_telefono_1,
				"6"=>$reg->cont_vigencia_a_partir,
				"7"=>$perm,
				"8"=>$estado,
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
// Impementacion de metodo para listar registros

	case 'selecTipoPersona':
		// Se requiere la clase que va mostrar en el select
		require_once '../modelos/TipoPersona.php';
		// Se crea un nuevo objeto de la clase requerida
		$tipo_persona = new TipoPersona();

		$respuesta = $tipo_persona->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->tip_per_id.'>'.$reg->tip_per_nombre.'</option>';
		}
		break;

	case 'selecTipoCiente':
		// Se requiere la clase que va mostrar en el select
		require_once '../modelos/TipoCliente.php';
		// Se crea un nuevo objeto de la clase requerida
		$tipo_cliente = new TipoCliente();

		$respuesta = $tipo_cliente->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->tip_cli_id.'>'.$reg->tip_cli_nombre.'</option>';
		}
		break;

	case 'selecAlianza':
		// Se requiere la clase que va mostrar en el select
		require_once '../modelos/Alianza.php';
		// Se crea un nuevo objeto de la clase requerida
		$alianza = new Alianza();

		$respuesta = $alianza->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->ali_id.'>'.$reg->ali_nombre.'</option>';
		}
		break;

	case 'selecTipoDocumento':
		// Se requiere la clase que va mostrar en el select
		require_once '../modelos/TipoDocumento.php';
		// Se crea un nuevo objeto de la clase requerida
		$tipo_documento = new TipoDocumento();

		$respuesta = $tipo_documento->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->tip_doc_id.'>'.$reg->tip_doc_nombre.'</option>';
		}
		break;

	case 'selectCiudad':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/Ciudad.php';
		// Se crea un nuevo objeto de la clase requerida
		$ciudad = new Ciudad();

		$respuesta = $ciudad->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->ciu_id.'>'.$reg->ciu_nombre.'</option>';
		}
		break;

	case 'selecTipoVivienda':
		// Se requiere la clase que va mostrar en el select
		require_once '../modelos/TipoVivienda.php';
		// Se crea un nuevo objeto de la clase requerida
		$tipo_vivienda = new TipoVivienda();

		$respuesta = $tipo_vivienda->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->tip_viv_id.'>'.$reg->tip_viv_nombre.'</option>';
		}
	break;

	case 'listarPorSede':

		// Se instancia la clase Producto de modelos 
		require_once "../modelos/Producto.php";
		// Se crea el objeto producto 
		$producto = new Producto();

		$respuesta = $producto->listarPorSede();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>'<button  class="btn btn-warning" onclick="agregarDetalle('.$reg->prod_id.',\''.$reg->prod_nombre.'\',\''.$reg->prod_descripcion.'\','.$reg->prod_valor.',\''.$reg->prod_prefijo.'\','.$reg->prod_descuento_x_combo.')"><i class="fa fa-plus"></i></button>',
				"1"=>$reg->prod_codigo,
				"2"=>$reg->prod_prefijo,
				"3"=>$reg->prod_nombre,
				// "4"=>$reg->prod_descripcion,
				"4"=>'$'.number_format($reg->prod_valor)
				
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

	// Début maintenance
	case 'nuevoestado':

		$respuesta = $recaudo->nuevoestado();
		while ($reg = $respuesta->fetch_object()) 
		{
			echo '<option value='.$reg->est_serv_id.'>'.$reg->est_serv_nombre.'</option>';
		}

	break;

	case 'listarProductos':

		$respuesta2 = $ordenTrabajo->listarProducto($cont_id);
		// Declaracion de array para almacenamiento de los resultados
		$data1 = Array();
		$prefijos = Array();
		$descuento 	= 0;
		// Estructura de recorrido de la BD
		$contar_btn 	= 0;
		while ($reg = $respuesta2->fetch_object()) {
			// contador para numerar id del boton
			$contar_btn++;
			$data1[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>'<button type="button" data-toggle="tooltip" data-placement="right" id="btn'.$contar_btn.'" title="Eliminar producto" onclick="eliminarProducto('.$reg->cont_prod_id.',\''.$reg->prod_nombre.'\','.$reg->prod_valor.','.$contar_btn.',\''.$reg->prod_prefijo.'\')" class="btn btn-danger"><i class="fa fa-close"></i></button>',
				"1"=>$reg->cont_prod_id,
				"2"=>$reg->prod_nombre,
				"3"=>$reg->prod_prefijo,
				"4"=>$reg->prod_valor,
				"5"=>$reg->prod_descuento_x_combo
			);

			array_push($prefijos, $reg->prod_prefijo);
			$descuento = $descuento + $reg->prod_descuento_x_combo;
		}
		
		if(in_array('INT', $prefijos))
		{
			if(in_array('TVA', $prefijos))
			{
				$data1[] = array
				(
					// Declaracion de indices de almacenamiento dentro del array
					"0"=>'',
					"1"=>'<strong>DESCUENTO TOTAL</strong>',
					"2"=>'Total Descuento por Combo',
					"3"=>'DSCTO',
					"4"=>'<strong>$ '. $descuento.'</strong>',
					"5"=>'<strong>DESCUENTO TOTAL</strong>'
				);
			}
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

	case 'actualizarContrato':

		$or_trab 		= 	new OrdenTrabajo();
		$nvo_estado 	= 	new Recaudo();
		$prod_nom 		= 	'';
		$nvo_prod_nom 	= 	'';
		$contrato_id 	= 	isset($_POST['contrat_id'])? limpiarCadena($_POST['contrat_id']):"";
		$nva_mensua 	= 	isset($_POST['minimo_mensual_adc'])? limpiarCadena($_POST['minimo_mensual_adc']):"";
		$ant_mensua 	= 	isset($_POST['mens_ant'])? limpiarCadena($_POST['mens_ant']):"";
		$veces_elim		= 	0;
		$nvo_prod		= 	0;
		$mensajeOTAdd 	= 	'';
		
		if(!isset($_POST['nvtva']))
		{
			$tvaloga 		= 	isset($_POST['tva'])? limpiarCadena($_POST['tva']):"";;
		}
		else
		{
			// IDENTIFICA CUANDO UN CONTRATO TENIA MAS DE UN PRODUCTO DEL MISMO PREFIJO 
			$tvaloga 		= 	isset($_POST['nvtva'])? limpiarCadena($_POST['nvtva']):"";;	
		}

		if(!isset($_POST['nvtvd']))
		{
			$tvdgtal 		= 	isset($_POST['tvd'])? limpiarCadena($_POST['tvd']):"";;
		}
		else
		{
			// IDENTIFICA CUANDO UN CONTRATO TENIA MAS DE UN PRODUCTO DEL MISMO PREFIJO 
			$tvdgtal 		= 	isset($_POST['nvtvd'])? limpiarCadena($_POST['nvtvd']):"";;	
		}

		if(!isset($_POST['nvint']))
		{
			$internet 		= 	isset($_POST['int'])? limpiarCadena($_POST['int']):"";;
		}
		else
		{
			// IDENTIFICA CUANDO UN CONTRATO TENIA MAS DE UN PRODUCTO DEL MISMO PREFIJO 
			$internet 		= 	isset($_POST['nvint'])? limpiarCadena($_POST['nvint']):"";;	
		}

			/*	 ------------------------------------------------------
				|		VALIDACION DE INPUT DE MENSUALIDAD  			|
				 -------------------------------------------------------*/		
		if($nva_mensua > 0)
		{
			// SI NO HAY PRODUCTOS POR ELIMINAR ENVIADOS DESDE EL FORMULARIO
			if(!isset($_POST['prefijo_elm']))
			{
				// ES UTILIZADO PARA CONTAR EL NUMERO DE PRODUCTOS RECIBIDOS POR POST
				$nvo_prod 		=	count($_POST['cont_prod_producto_id']);
				$i = 0;
				// VARIABLE PARA RECORRER CANTIDAD DE REGISTROS CON PREFIJO
				$count_prefijos = 	0;

				while ($i < count($_POST['prod_nombre'])) 
				{
					while (count($_POST['prefijo']) > $count_prefijos) 
					{
						if(in_array('TVA', $_POST['prefijo']))
						{
							// VALOR QUE SE REGISTRA EN EL CONTRATO TVA
							$tvaloga 	= 	1;
						}
						if(in_array('TVD', $_POST['prefijo']))
						{
							// VALOR QUE SE REGISTRA EN EL CONTRATO TVD
							$tvdgtal 	= 	1;
						}
						if(in_array('INT', $_POST['prefijo']))
						{
							// VALOR QUE SE REGISTRA EN EL CONTRATO INT
							$internet 	= 	1;
						}
						$count_prefijos++;	
					}

					// ALIMENTA LOS DATOS PARA EL MENSAJE QUE SE ALMACENARÁ
					if($_POST['prod_nombre'][$i] != 'Descuento')
					{
						$nvo_prod_nom  = 	$nvo_prod_nom .' '. $_POST['prod_nombre'][$i];
					}

					$i++;

				}

				$mensajeOT 	=	'Agregar producto '. $nvo_prod_nom;
				// ESTADO DEL SERVICIO QUE REGISTRA EN LA BASE DE DATOS
				$labor 		= 	13;

			}
			// PRODUCTOS A ELIMINAR ENVIADOS DESDE EL FORMULARIO
			else
			{
				// SI NO HAY NUEVOS PRODUCTOS ENVIADOS DESDE EL FORMULARIO
				if(!isset($_POST['cont_prod_producto_id']))
				{
					$i = 0;
					// RECORRE LA CANTIDAD DE PRODUCTOS ENVIADOS A ELIMINAR
					$veces_elim 	= 	count($_POST['cont_prod_producto_id_elm']);
					// VARIABLE PARA RECORRER CANTIDAD DE REGISTROS DE PREFIJO
					$count_prefijos = 	0;
					
					while ($i < count($_POST['prod_nombre_elm'])) 
					{
						if($tvaloga === 'uno')
						{
						// VALOR QUE ENVIA SI EL CONTRATO QUEDO CON UNO O MAS PRODUCTOS DE TVA ACTIVOS
							$tvaloga 	= 	1;	

							while (count($_POST['prefijo_elm']) > $count_prefijos) 
							{
								if(in_array('TVD', $_POST['prefijo_elm']))
								{	
									$tvdgtal 	= 	0;
								}
								if(in_array('INT', $_POST['prefijo_elm']))
								{
									$internet 	= 	0;
								}

								$count_prefijos++;	
							}
						}
						if($tvdgtal === 'uno')
						{
						// VALOR QUE ENVIA SI EL CONTRATO QUEDO CON UNO O MAS PRODUCTOS DE TVD ACTIVOS
							$tvdgtal 	= 	1;	

							while (count($_POST['prefijo_elm']) > $count_prefijos) 
							{
								if(in_array('TVA', $_POST['prefijo_elm']))
								{	
									$tvaloga 	= 	0;
								}
								if(in_array('INT', $_POST['prefijo_elm']))
								{
									$internet 	= 	0;
								}

								$count_prefijos++;	
							}
						}
						if($internet === 'uno')
						{
						// VALOR QUE ENVIA SI EL CONTRATO QUEDO CON UNO O MAS PRODUCTOS DE INTERNET ACTIVOS
							$internet 	= 	1;	

							while (count($_POST['prefijo_elm']) > $count_prefijos) 
							{
								if(in_array('TVA', $_POST['prefijo_elm']))
								{	
									$tvaloga 	= 	0;
								}
								if(in_array('TVD', $_POST['prefijo_elm']))
								{	
									$tvdgtal 	= 	0;
								}

								$count_prefijos++;	
							}
						}
						else
						{
							while (count($_POST['prefijo_elm']) > $count_prefijos) 
							{
								if(in_array('TVA', $_POST['prefijo_elm']))
								{
									// VALOR QUE SE REGISTRA EN EL CONTRATO TVA
									$tvaloga 	= 	0;
								}
								if(in_array('TVD', $_POST['prefijo_elm']))
								{
									// VALOR QUE SE REGISTRA EN EL CONTRATO TVD
									$tvdgtal 	= 	0;
								}
								if(in_array('INT', $_POST['prefijo_elm']))
								{
									// VALOR QUE SE REGISTRA EN EL CONTRATO INT
									$internet 	= 	0;
								}
								$count_prefijos++;	
							}
						}
						
						if($_POST['prod_nombre_elm'][$i] != 'Descuento')
						{
							$prod_nom  = 	$prod_nom .' '. $_POST['prod_nombre_elm'][$i];
						}

						$i++;
					}

					$mensajeOT	=	'Retirar '. $prod_nom;
				}
				// SI HAY NUEVOS PRODUCTOS ENVIADOS DESDE EL FORMULARIO Y PRODUCTOS A ELIMINAR
				else
				{
					$i = 0;
					$veces_elim 	= 	count($_POST['cont_prod_producto_id_elm']);
					$count_prefijos_eliminar	= 	0;

					while ($i < count($_POST['prod_nombre_elm'])) 
					{
						// VALOR QUE ENVIA SI EL CONTRATO QUEDO CON UNO O MAS PRODUCTOS DE TVA ACTIVOS
						if($tvaloga === 'uno')
						{
							$tvaloga 	= 	1;	

							while (count($_POST['prefijo_elm']) > $count_prefijos_eliminar) 
							{
								if(in_array('TVD', $_POST['prefijo_elm']))
								{	
									$tvdgtal 	= 	0;
								}
								if(in_array('INT', $_POST['prefijo_elm']))
								{
									$internet 	= 	0;
								}

								$count_prefijos_eliminar++;	
							}
						}
						// VALOR QUE ENVIA SI EL CONTRATO QUEDO CON UNO O MAS PRODUCTOS DE TVD ACTIVOS
						if($tvdgtal === 'uno')
						{
							$tvdgtal 	= 	1;	

							while (count($_POST['prefijo_elm']) > $count_prefijos_eliminar) 
							{
								if(in_array('TVA', $_POST['prefijo_elm']))
								{	
									$tvaloga 	= 	0;
								}
								if(in_array('INT', $_POST['prefijo_elm']))
								{
									$internet 	= 	0;
								}

								$count_prefijos_eliminar++;	
							}
						}
						// VALOR QUE ENVIA SI EL CONTRATO QUEDO CON UNO O MAS PRODUCTOS DE INTERNET ACTIVOS
						if($internet === 'uno')
						{
							$internet 	= 	1;	

							while (count($_POST['prefijo_elm']) > $count_prefijos_eliminar) 
							{
								if(in_array('TVA', $_POST['prefijo_elm']))
								{	
									$tvaloga 	= 	0;
								}
								if(in_array('TVD', $_POST['prefijo_elm']))
								{	
									$tvdgtal 	= 	0;
								}

								$count_prefijos_eliminar++;	
							}
						}
						else
						{
							while (count($_POST['prefijo_elm']) > $count_prefijos_eliminar) 
							{
								if(in_array('TVA', $_POST['prefijo_elm']))
								{
									// VALOR QUE SE REGISTRA EN EL CONTRATO TVA
									$tvaloga 	= 	0;
								}
								if(in_array('TVD', $_POST['prefijo_elm']))
								{
									// VALOR QUE SE REGISTRA EN EL CONTRATO TVD
									$tvdgtal 	= 	0;
								}
								if(in_array('INT', $_POST['prefijo_elm']))
								{
									// VALOR QUE SE REGISTRA EN EL CONTRATO INT
									$internet 	= 	0;
								}
								$count_prefijos_eliminar++;	
							}
						}
						if($_POST['prod_nombre_elm'][$i] != 'Descuento')
						{
							$prod_nom  = 	$prod_nom .' '. $_POST['prod_nombre_elm'][$i];
						}

						$i++;
					}

					$b = 0;
					$nvo_prod 	=	count($_POST['cont_prod_producto_id']);
					$count_prefijos = 	0;

					while ($b < count($_POST['prod_nombre'])) 
					{
						while (count($_POST['prefijo']) > $count_prefijos) 
						{
							if(in_array('TVA', $_POST['prefijo']))
							{
								// VALOR QUE SE REGISTRA EN EL CONTRATO TVA
								$tvaloga 	= 	1;
							}
							if(in_array('TVD', $_POST['prefijo']))
							{
								// VALOR QUE SE REGISTRA EN EL CONTRATO TVD
								$tvdgtal 	= 	1;
							}
							if(in_array('INT', $_POST['prefijo']))
							{
								// VALOR QUE SE REGISTRA EN EL CONTRATO INT
								$internet 	= 	1;
							}
							$count_prefijos++;	
						}

						if($_POST['prod_nombre'][$b] != 'Descuento')
						{
							$nvo_prod_nom  = 	$nvo_prod_nom .' '. $_POST['prod_nombre'][$b];
						}
						$b++;
					}
					
					$labor			= 	14;	
					$mensajeOT		=	'Retirar '. $prod_nom;
					$mensajeOTAdd	=	' Agregar ' . $nvo_prod_nom;

				}

			}
			// FIN DE PRODUCTOS A ELIMINAR ENVIADOS DESDE EL FORMULARIO

			$respuesta2		= 	$or_trab->validarOTActivaCaja($contrato_id);

			/*	 ------------------------------------------------------
				|		PROCESO DE VALIDACIONES SIN OT ACTIVA 			|
				 -------------------------------------------------------*/		

			if(empty($respuesta2))
			{
				$result_ot 	= 	nuevo_OT(	date('Y/m/d'),
				 							$mensajeOT . '' . $mensajeOTAdd, 
				 							14,
				 							$contrato_id,
				 							$cont_usuario_id,
				 							date('Y/m/d'),
				 							0,
				 							'null',
				 							1
				 						);
				
				$nvo_estado->guardarnuevoestado (14, $contrato_id, $cont_usuario_id, $mensajeOT . '' . $mensajeOTAdd, $result_ot);
				$respuesta 	= 	$contrato->editarContrato($contrato_id,$nva_mensua,$tvaloga,$tvdgtal,$internet,1);

				$contar 	= 	0;

				if($veces_elim == 0 && $nvo_prod != 0)
				{
					// Verifica la exetncion de la imagen cargada
					$ext = explode(".", $_FILES["file-1"]["name"]);
					// Valida el tipo de extencion que se cargo 
					if ($_FILES['file-1']['type'] == "image/jpg" || $_FILES['file-1']['type'] == "image/jpeg" || $_FILES['file-1']['type'] == "image/png" || $_FILES['file-1']['type'] == "image/PNG") 
					{
						// Cambia el nombre de la imagen con un formato de tiempo para no repetirla y adhiere la extencion
						$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
						// Subir el archivo a la carpeta dentro del servidor
						move_uploaded_file($_FILES["file-1"]["tmp_name"] , "../files/solicitudes/otrosi/".$doc_imagen);
					}
					while ($contar < $nvo_prod) 
					{
						$prod_asignado =  $contrato->insertarContratoProducto(
												$contrato_id,
												$_POST['cont_prod_producto_id'][$contar],
												$_POST['cont_prod_cantidad'][$contar],
												$_POST['cont_prod_precio'][$contar]
											);

						$respuesta  = $contrato->controlcambioproductos(
													$contrato_id,
													$prod_asignado,
													$cont_usuario_id,
													$result_ot,
													$ant_mensua,
													$mensajeOT,
													$doc_imagen);
						
						$contar++;
					}
				}
				else if($nvo_prod == 0 && $veces_elim != 0)
				{
					// Verifica la exetncion de la imagen cargada
					$ext = explode(".", $_FILES["file-1"]["name"]);
					// Valida el tipo de extencion que se cargo 
					if ($_FILES['file-1']['type'] == "image/jpg" || $_FILES['file-1']['type'] == "image/jpeg" || $_FILES['file-1']['type'] == "image/png" || $_FILES['file-1']['type'] == "image/PNG") 
					{
						// Cambia el nombre de la imagen con un formato de tiempo para no repetirla y adhiere la extencion
						$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
						// Subir el archivo a la carpeta dentro del servidor
						move_uploaded_file($_FILES["file-1"]["tmp_name"] , "../files/solicitudes/otrosi/".$doc_imagen);
					}
					while ($contar < $veces_elim) 
					{

						$prd_elimin = isset($_POST['cont_prod_producto_id_elm'][$contar])? limpiarCadena($_POST['cont_prod_producto_id_elm'][$contar]):"";
						$respuesta  = $contrato->desactivarContratoProducto($prd_elimin);
						$respuesta  = $contrato->controlcambioproductos(
													$contrato_id,
													$prd_elimin,
													$cont_usuario_id,
													$result_ot,
													$ant_mensua,
													$mensajeOT,
													$doc_imagen);
						$contar++;

					}
				}
				else
				{
					// Verifica la exetncion de la imagen cargada
					$ext = explode(".", $_FILES["file-1"]["name"]);
					// Valida el tipo de extencion que se cargo 
					if ($_FILES['file-1']['type'] == "image/jpg" || $_FILES['file-1']['type'] == "image/jpeg" || $_FILES['file-1']['type'] == "image/png" || $_FILES['file-1']['type'] == "image/PNG") 
					{
						// Cambia el nombre de la imagen con un formato de tiempo para no repetirla y adhiere la extencion
						$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
						// Subir el archivo a la carpeta dentro del servidor
						move_uploaded_file($_FILES["file-1"]["tmp_name"] , "../files/solicitudes/otrosi/".$doc_imagen);
					}
					while ($contar < $nvo_prod) 
					{
						$prod_asignado =  $contrato->insertarContratoProducto(
												$contrato_id,
												$_POST['cont_prod_producto_id'][$contar],
												$_POST['cont_prod_cantidad'][$contar],
												$_POST['cont_prod_precio'][$contar]
											);

						$respuesta  = $contrato->controlcambioproductos(
													$contrato_id,
													$prod_asignado,
													$cont_usuario_id,
													$result_ot,
													$ant_mensua,
													$mensajeOTAdd,
													$doc_imagen);
						
						$contar++;
					}

					$contar = 0;
					
					while ($contar < $veces_elim) 
					{
						$prd_elimin = 	isset($_POST['cont_prod_producto_id_elm'][$contar])? limpiarCadena($_POST['cont_prod_producto_id_elm'][$contar]):"";
						$respuesta  = $contrato->desactivarContratoProducto($prd_elimin);
						$respuesta  = $contrato->controlcambioproductos(
													$contrato_id,
													$prd_elimin,
													$cont_usuario_id,
													$result_ot,
													$ant_mensua,
													$mensajeOT,
													$doc_imagen);
							$contar++;
					}
				}
				echo $respuesta = "Contrato modificado exitosamente";

			}
			/*	 ------------------------------------------------------
				|		PROCESO DE VALIDACIONES CON OT ACTIVA 			|
				 -------------------------------------------------------*/		
			else
			{
				if($respuesta2['ord_trab_tecnico_id'] == 0 )
				{
					update_OT(
								$respuesta2['ord_trab_id'],
								date('Y/m/d'),
								$respuesta2['ord_trab_fecha_vencimiento'],
								14,
								$contrato_id,
								$cont_usuario_id,
								$mensajeOT . '' . $mensajeOTAdd, 
								$respuesta2['ord_estado']);
				}
				else
				{
					seguimiento_OT(
									null,
									$respuesta2['ord_trab_id'],
									date('Y/m/d'),
									$respuesta2['ord_trab_fecha_vencimiento'],
									14,
									$contrato_id,
									$respuesta2['ord_trab_tecnico_id'],
									$mensajeOT . '' . $mensajeOTAdd, 
									$cont_usuario_id,
									$respuesta2['ord_trab_resp_activ_id']);
				}

				$nvo_estado->guardarnuevoestado (14, $contrato_id, $cont_usuario_id, $mensajeOT . '' . $mensajeOTAdd, $respuesta2['ord_trab_id']);
				$respuesta 	= 	$contrato->editarContrato($contrato_id,$nva_mensua,$tvaloga,$tvdgtal,$internet,1);

				$contar 	= 	0;

				if($veces_elim == 0 && $nvo_prod != 0)
				{
					// Verifica la exetncion de la imagen cargada
					$ext = explode(".", $_FILES["file-1"]["name"]);
					// Valida el tipo de extencion que se cargo 
					if ($_FILES['file-1']['type'] == "image/jpg" || $_FILES['file-1']['type'] == "image/jpeg" || $_FILES['file-1']['type'] == "image/png" || $_FILES['file-1']['type'] == "image/PNG") 
					{
						// Cambia el nombre de la imagen con un formato de tiempo para no repetirla y adhiere la extencion
						$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
						// Subir el archivo a la carpeta dentro del servidor
						move_uploaded_file($_FILES["file-1"]["tmp_name"] , "../files/solicitudes/otrosi/".$doc_imagen);
					}
					while ($contar < $nvo_prod) 
					{
						$prod_asignado =  $contrato->insertarContratoProducto(
												$contrato_id,
												$_POST['cont_prod_producto_id'][$contar],
												$_POST['cont_prod_cantidad'][$contar],
												$_POST['cont_prod_precio'][$contar]
											);

						$respuesta  = $contrato->controlcambioproductos(
													$contrato_id,
													$prod_asignado,
													$cont_usuario_id,
													$respuesta2['ord_trab_id'],
													$ant_mensua,
													$mensajeOT,
													$doc_imagen);
						
						$contar++;
					}
				}
				else if($nvo_prod == 0 && $veces_elim != 0)
				{
					// Verifica la exetncion de la imagen cargada
					$ext = explode(".", $_FILES["file-1"]["name"]);
					// Valida el tipo de extencion que se cargo 
					if ($_FILES['file-1']['type'] == "image/jpg" || $_FILES['file-1']['type'] == "image/jpeg" || $_FILES['file-1']['type'] == "image/png" || $_FILES['file-1']['type'] == "image/PNG") 
					{
						// Cambia el nombre de la imagen con un formato de tiempo para no repetirla y adhiere la extencion
						$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
						// Subir el archivo a la carpeta dentro del servidor
						move_uploaded_file($_FILES["file-1"]["tmp_name"] , "../files/solicitudes/otrosi/".$doc_imagen);
					}
					while ($contar < $veces_elim) 
					{
						$prd_elimin = 	isset($_POST['cont_prod_producto_id_elm'][$contar])? limpiarCadena($_POST['cont_prod_producto_id_elm'][$contar]):"";
						$respuesta  = $contrato->desactivarContratoProducto($prd_elimin);
						$respuesta  = $contrato->controlcambioproductos(
													$contrato_id,
													$prd_elimin,
													$cont_usuario_id,
													$respuesta2['ord_trab_id'],
													$ant_mensua,
													$mensajeOT,
													$doc_imagen);
							$contar++;
					}
				}
				else
				{
					// Verifica la exetncion de la imagen cargada
					$ext = explode(".", $_FILES["file-1"]["name"]);
					// Valida el tipo de extencion que se cargo 
					if ($_FILES['file-1']['type'] == "image/jpg" || $_FILES['file-1']['type'] == "image/jpeg" || $_FILES['file-1']['type'] == "image/png" || $_FILES['file-1']['type'] == "image/PNG") 
					{
						// Cambia el nombre de la imagen con un formato de tiempo para no repetirla y adhiere la extencion
						$doc_imagen = 	round(microtime(true)) . '.' . end($ext);
						// Subir el archivo a la carpeta dentro del servidor
						move_uploaded_file($_FILES["file-1"]["tmp_name"] , "../files/solicitudes/otrosi/".$doc_imagen);
					}
					while ($contar < $nvo_prod) 
					{
						$prod_asignado =  $contrato->insertarContratoProducto(
												$contrato_id,
												$_POST['cont_prod_producto_id'][$contar],
												$_POST['cont_prod_cantidad'][$contar],
												$_POST['cont_prod_precio'][$contar]
											);

						$respuesta  = $contrato->controlcambioproductos(
													$contrato_id,
													$prod_asignado,
													$cont_usuario_id,
													$respuesta2['ord_trab_id'],
													$ant_mensua,
													$mensajeOTAdd,
													$doc_imagen);
						
						$contar++;
					}

					$contar = 0;
					
					while ($contar < $veces_elim) 
					{
						$prd_elimin = 	isset($_POST['cont_prod_producto_id_elm'][$contar])? limpiarCadena($_POST['cont_prod_producto_id_elm'][$contar]):"";
						$respuesta  = $contrato->desactivarContratoProducto($prd_elimin);
						$respuesta  = $contrato->controlcambioproductos(
													$contrato_id,
													$prd_elimin,
													$cont_usuario_id,
													$respuesta2['ord_trab_id'],
													$ant_mensua,
													$mensajeOT,
													$doc_imagen);
							$contar++;
					}
				}
				echo $respuesta = "Contrato modificado exitosamente";

			}

		}
		/*	 ------------------------------------------------------
			|		FIN VALIDACION DE INPUT DE MENSUALIDAD 			|
			 -------------------------------------------------------*/		
		else
		{
			echo $respuesta = 'Existe un error en la nueva mensualidad del contrato';
		}

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
// fin maintenance

?>