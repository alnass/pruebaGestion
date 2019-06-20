<?php 
session_start();
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA
	// 	registro_pqr

// ------------------------------------------
// |CAMPOS DE LA TABLA 		| INPUTS		|
// ------------------------------------------ 
	// |reg_pqr_id 				|reg_pqr_id 	|
	// |reg_pqr_canal_id 		|canal 			|
	// |reg_pqr_tipo_canal_id	|tipoCanal 		|
	// |reg_pqr_producto_id		|producto 		|
	// |reg_pqr_tipo_pqr_id		|tipoPqr 		|
	// |reg_pqr_categoria_pqr_id|categoriaPqr 	|
	// |reg_pqr_persona_id		|persona 		|
	// |reg_pqr_remitido_id		|remitido 		|
	// |reg_pqr_num_radicado	|numRadicado 	|
	// |reg_pqr_fecha_inicio	|fechaInicio 	|
	// |reg_pqr_fecha_remision	|fechaRemision 	|
	// |reg_pqr_fecha_fin		|fechaFin 		|
	// |reg_pqr_ticket_interno	|ticket 		|
	// |reg_pqr_operador_id		|operador 		|
	// |reg_pqr_dias_respuesta	|dias  			|
	// |reg_pqr_observacion		|observacion 	|
	// |reg_pqr_estado_id		|estado 		|
	// ------------------------------------------

// NOMBRE DE LA CLASE 
	// 	Registro-pqr

// AJAX
	// 	registro_pqr

// NOMBRES DE LOS INPUTS DEL HTMPL
	//    reg_pqr_id
	//    canal
	//    tipoCanal
	//    producto
	//    tipoPqr
	//    categoriaPqr
	//    persona
	//    remitido
	//    numRadicado
	//    fechaInicio
	//    fechaRemision
	//    fechaFin
	//    ticket
	//    operador
	//    dias
	//    observacion   
	//_________________________
	//    per_id    
	//    prefijo   
	//    marca     
	//    precinto  
	//    tipoPersona 
	//    tipoCliente 
	//    alianza   
	//    tipoDoc   
	//    numDoc    
	//    expedDoc   
	//    nombre    
	//    apellido   
	//    nacimiento  
	//    tel1    
	//    tel2    
	//    ciudad     
	//    barrio    
	//    tipoVivien  
	//    direccion   
	//    correoPer   
	//    correoCorp  
	//    usuario   
	//    pass 

require_once "../modelos/Registro-pqr.php";
require_once "../modelos/Persona.php";

$registro_pqr = new RegistroPqr();
$persona = new Persona();


$reg_pqr_id  			= isset($_POST['reg_pqr_id'])? limpiarCadena($_POST['reg_pqr_id']):"";
$reg_pqr_canal_id 		= isset($_POST['canal'])? limpiarCadena($_POST['canal']):"";
$reg_pqr_tipo_canal_id 	= isset($_POST['tipoCanal'])? limpiarCadena($_POST['tipoCanal']):"";
$reg_pqr_producto_id 	= isset($_POST['producto'])? limpiarCadena($_POST['producto']):"";
$reg_pqr_tipo_pqr_id 	= isset($_POST['tipoPqr'])? limpiarCadena($_POST['tipoPqr']):"";
$reg_pqr_categoria_pqr_id = isset($_POST['categoriaPqr'])? limpiarCadena($_POST['categoriaPqr']):"";
$reg_pqr_persona_id 	= isset($_POST['persona'])? limpiarCadena($_POST['persona']):"";
$reg_pqr_remitido_id 	= isset($_POST['remitido'])? limpiarCadena($_POST['remitido']):"";
$reg_pqr_num_radicado 	= isset($_POST['numRadicado'])? limpiarCadena($_POST['numRadicado']):"";
$reg_pqr_fecha_inicio 	= isset($_POST['fechaIni'])? limpiarCadena($_POST['fechaIni']):"";
$reg_pqr_fecha_remision = isset($_POST['fechaRemision'])? limpiarCadena($_POST['fechaRemision']):"";
$reg_pqr_dias_respuesta = isset($_POST['dias'])? limpiarCadena($_POST['dias']):"";


// $reg_pqr_fecha_fin 		= isset($_POST['fechaFin'])? limpiarCadena($_POST['fechaFin']):"";
$reg_pqr_ticket_interno = isset($_POST['ticket'])? limpiarCadena($_POST['ticket']):"";
$reg_pqr_operador_id 	= $_SESSION['usu_id'];
$reg_pqr_observacion 	= isset($_POST['observacion'])? limpiarCadena($_POST['observacion']):"";

$per_id 				= isset($_POST['per_id'])? limpiarCadena($_POST['per_id']):"";
$per_prefijo 			= isset($_POST['prefijo'])? limpiarCadena($_POST['prefijo']):"";
$per_marca 				= isset($_POST['marca'])? limpiarCadena($_POST['marca']):"";
$per_precinto 			= isset($_POST['precinto'])? limpiarCadena($_POST['precinto']):"";
$per_tipo_persona_id 	= isset($_POST['tipoPersona'])? limpiarCadena($_POST['tipoPersona']):"";
$per_tipo_cliente_id 	= isset($_POST['tipoCliente'])? limpiarCadena($_POST['tipoCliente']):"";
$per_alianza_id 		= isset($_POST['alianza'])? limpiarCadena($_POST['alianza']):"";
$per_tipo_documento_id 	= isset($_POST['tipoDoc'])? limpiarCadena($_POST['tipoDoc']):"";
$per_num_documento 		= isset($_POST['numDoc'])? limpiarCadena($_POST['numDoc']):"";
$per_fecha_exped_doc 	= isset($_POST['expedDoc'])? limpiarCadena($_POST['expedDoc']):"";
$per_nombre 			= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$per_apellido 			= isset($_POST['apellido'])? limpiarCadena($_POST['apellido']):"";
$per_fecha_nacimiento 	= isset($_POST['nacimiento'])? limpiarCadena($_POST['nacimiento']):"";
$per_telefono_1 		= isset($_POST['tel1'])? limpiarCadena($_POST['tel1']):"";
$per_telefono_2 		= isset($_POST['tel2'])? limpiarCadena($_POST['tel2']):"";
$per_ciudad_id 			= isset($_POST['ciudad'])? limpiarCadena($_POST['ciudad']):"";
$per_barrio 			= isset($_POST['barrio'])? limpiarCadena($_POST['barrio']):"";
$per_tipo_vivienda_id 	= isset($_POST['tipoVivien'])? limpiarCadena($_POST['tipoVivien']):"";
$per_direccion 			= isset($_POST['direccion'])? limpiarCadena($_POST['direccion']):"";
$per_correo_personal 	= isset($_POST['correoPer'])? limpiarCadena($_POST['correoPer']):"";
$per_correo_corp 		= isset($_POST['correoCorp'])? limpiarCadena($_POST['correoCorp']):"";
$per_usuario 			= isset($_POST['usuario'])? limpiarCadena($_POST['usuario']):"";
$per_contrasenia 		= isset($_POST['pass'])? limpiarCadena($_POST['pass']):"";

$cont_id 		  		= isset($_POST['cont_id'])? limpiarCadena($_POST['cont_id']):"";
$nuevoestado			= isset($_POST['nuevoestado'])? limpiarCadena($_POST['nuevoestado']):"";
$v_contratoid			= isset($_POST['v_contratoid'])? limpiarCadena($_POST['v_contratoid']):"";
$area_envio				= $_SESSION['usu_area_id'];

switch ($_GET["op"]) {
	case 'guardaryeditarpersona':

		if (empty($per_id)) {
			$respuesta = $persona->insertar(
				$per_id,
				$per_marca,
				$per_precinto,
				$per_tipo_persona_id,
				$per_tipo_cliente_id,
				$per_tipo_documento_id,
				$per_num_documento,
				$per_fecha_exped_doc,
				$per_nombre,
				$per_apellido,
				$per_fecha_nacimiento,
				$per_telefono_1,
				$per_telefono_2,
				$per_ciudad_id,
				$per_barrio,
				$per_tipo_vivienda_id,
				$per_direccion,
				$per_correo_personal,
				$per_correo_corp,
				$per_usuario,
				$per_contrasenia);

			echo $respuesta ? "Contrato registrado exitosamente" : "El nuevo contrato con permanencia no pudo ser registrado completamente"; 
		}else{
			$respuesta = $persona->editar(
				$per_id,
				$per_prefijo,
				$per_marca,
				$per_precinto,
				$per_tipo_persona_id,
				$per_tipo_cliente_id,
				$per_alianza_id,
				$per_tipo_documento_id,
				$per_num_documento,
				$per_fecha_exped_doc,
				$per_nombre,
				$per_apellido,
				$per_fecha_nacimiento,
				$per_telefono_1,
				$per_telefono_2,
				$per_ciudad_id,
				$per_barrio,
				$per_tipo_vivienda_id,
				$per_direccion,
				$per_correo_personal,
				$per_correo_corp,
				$per_usuario,
				$per_contrasenia);
			// echo $respuesta ? "Persona actualizado" : "Persona no se pudo actualizar";
			echo $respuesta ? "Persona registrado" : "Persona no se pudo registrar"; 
		}
			
		break;

	case 'guardaryeditar':
		// identifica la zona horaria 
		date_default_timezone_set("America/Bogota");
		// Captura la fecha y hora en curso 
		$fecha = date('Y-m-d H:i:s');
		// identifia la diferencia entre la fecha fianal y la en curso
		$reg_pqr_fecha_fin 		= strtotime("+".$reg_pqr_dias_respuesta." hour", strtotime($fecha));
		$reg_pqr_fecha_fin		=date('Y-m-d H:i:s', $reg_pqr_fecha_fin);

		// Trae el correo del area asignada en el registro de la PQR
		$sql = "SELECT are_correo 
				FROM area
				WHERE are_id = '$reg_pqr_remitido_id'";

		$correo =  ejecutarConsultaSimpleFila($sql);
		// Convierte el array en cadena de texto
		$correo = implode("", $correo);


		if (empty($reg_pqr_id)) {
			$respuesta = $registro_pqr->insertar(
				$reg_pqr_id, 
				$reg_pqr_canal_id, 
				$reg_pqr_tipo_canal_id, 
				$reg_pqr_producto_id, 
				$reg_pqr_tipo_pqr_id,
				$reg_pqr_categoria_pqr_id,
				$reg_pqr_persona_id,
				$reg_pqr_remitido_id,
				$reg_pqr_num_radicado,
				$reg_pqr_fecha_inicio,
				$reg_pqr_fecha_remision,
				$reg_pqr_fecha_fin,
				$reg_pqr_ticket_interno,
				$reg_pqr_operador_id,
				$reg_pqr_dias_respuesta,
				$reg_pqr_observacion
			);
					
	echo $respuesta ? "PQR's registrado ".$correo  : "PQR's no se pudo registrar"; 
		}else{
			$respuesta = $registro_pqr->editar(
				$reg_pqr_id, 
				$reg_pqr_canal_id, 
				$reg_pqr_tipo_canal_id, 
				$reg_pqr_producto_id,
				$reg_pqr_tipo_pqr_id,
				$reg_pqr_categoria_pqr_id,
				$reg_pqr_persona_id,
				$reg_pqr_remitido_id,
				$reg_pqr_num_radicado,
				$reg_pqr_fecha_inicio,
				$reg_pqr_fecha_remision,
				$reg_pqr_fecha_fin,
				$reg_pqr_ticket_interno,
				$reg_pqr_operador_id,
				$reg_pqr_dias_respuesta,
				$reg_pqr_observacion
			);
			
			echo $respuesta ? "PQR's actualizado ".$correo : "PQR's no se pudo actualizar";
		}

		
		 
		$asunto = "Nueva PQR"; 
		$cuerpo = ' 
		<html> 
		<head> 
		   <title>'.utf8_decode('Nueva PQR´s registrada para su área'). '</title> 
		</head> 
		<body> 
		<h1>Nueva PQR</h1> 
		<h3>Radicado número:'.$reg_pqr_num_radicado.' </h3>
		<p>Observación:'.utf8_decode($reg_pqr_observacion) .'</p>
		<h3>Tiempo de respuesta:'.$reg_pqr_dias_respuesta.' horas</h3>
		<h3>Fecha de inicio:'.$reg_pqr_fecha_inicio.'<h3>
		<h3>Fecha de vencimiento:'.$reg_pqr_fecha_fin.'<h3>
		</body> 
		</html> 
		'; 
	
		//para el envío en formato HTML 
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=UTF-8\r\n"; 
	
		//dirección del remitente 
		$headers .= 'From:'. utf8_decode('Sistema de gestión Globalplay').'<servicioalcliente@globalplay.tv>\r\n'; 
	
		// //dirección de respuesta, si queremos que sea distinta que la del remitente 
		// $headers .= "Reply-To: mariano@desarrolloweb.com\r\n"; 
	
		// //ruta del mensaje desde origen a destino 
		// $headers .= "Return-path: holahola@desarrolloweb.com\r\n"; 
	
		// //direcciones que recibián copia 
		// $headers .= "Cc: maria@desarrolloweb.com\r\n"; 
	
		// //direcciones que recibirán copia oculta 
		// $headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n"; 
	
		mail($correo,$asunto,$cuerpo,$headers);
		


		break;

	case 'desactivar':
		$respuesta = $registro_pqr->desactivar($reg_pqr_id);
		echo $respuesta ? "PQR's desactivada" : "PQR's no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $registro_pqr->activar($reg_pqr_id);
		echo $respuesta ? "PQR's activada" : "PQR's no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $registro_pqr->mostrar($reg_pqr_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $registro_pqr->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
					
				"0"=>$reg->per_num_documento,
				"1"=>$reg->per_nombre." ".$reg->per_apellido,
				"2"=>$reg->per_telefono_1,
				"3"=>$reg->ciu_nombre,
				"4"=>$reg->per_direccion,
				"5"=>$reg->per_correo_personal,
				"6"=>'<button class="btn btn-success" data-toggle="tooltip" data-placement="left" title="Nueva PQR" onclick="mostrar('.$reg->per_id.'),numeroradicado(),listarcontrato('.$reg->per_id.'), limpirRegPqr();">
						<i class="fa fa-plus-circle"></i>
					</button>',
				"7"=>'<button class="btn btn-warning" data-toggle="modal" data-target="#myModal" onclick="listarpqrusuario('.$reg->per_id.')">
						<i class="fa fa-eye"></i>
					</button>'
					//." ". '<button  class="btn btn-danger" onclick="desactivar('.$reg->per_id.')"><i class="fa fa-close"></i></button>'
					
					//." ". '<button  class="btn btn-primary" onclick="activar('.$reg->per_id.')"><i class="fa fa-check"></i></button>'



				// "7"=>($reg->per_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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

	case 'selectCanal':
		// Se requiere la clase que va mostrar en el select
		require_once '../modelos/Canal.php';
		// Se crea un nuevo objeto de la clase requerida
		$canal = new Canal();

		$respuesta = $canal->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->can_id.'>'.$reg->can_nombre.'</option>';
		}
		break;

	case 'selectTipoCanal':
		// Se requiere la clase que va mostrar en el select
		require_once '../modelos/TipoCanal.php';
		// Se crea un nuevo objeto de la clase requerida
		$tipo_canal = new TipoCanal();

		$respuesta = $tipo_canal->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->tip_can_id.'>'.$reg->tip_can_nombre.'</option>';
		}
		break;

	case 'selectProducto':
		// Se requiere la clase que va mostrar en el select
		require_once '../modelos/Producto.php';
		// Se crea un nuevo objeto de la clase requerida
		$producto = new Producto();

		$respuesta = $producto->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->prod_id.'>'.$reg->prod_nombre.'</option>';
		}
		break;

	case 'selectTipoPqr':
		// Se requiere la clase que va mostrar en el select
		require_once '../modelos/TipoPqr.php';
		// Se crea un nuevo objeto de la clase requerida
		$tipo_pqr = new TipoPqr();

		$respuesta = $tipo_pqr->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->tip_pqr_id.'>'.$reg->tip_pqr_nombre.'</option>';
		}
		break;

	case 'selectCategoria':
		// Se requiere la clase que va mostrar en el select
		require_once '../modelos/Categoria.php';
		// Se crea un nuevo objeto de la clase requerida
		$categoria_pgr = new Categoria();

		$respuesta = $categoria_pgr->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->cat_pqr_id.'>'.$reg->cat_pqr_nombre.' - '.$reg->cat_pqr_tiempo_h.' H</option>';
		}
		break;
	
	case 'selectArea':
		// Se requiere la clase que va mostrar en el select
		require_once '../modelos/Area.php';
		// Se crea un nuevo objeto de la clase requerida
		$area = new Area();

		$respuesta = $area->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->are_id.'>'.$reg->are_nombre.'</option>';
		}
		break;

	case 'selectUsuario':
		// Se requiere la clase que va mostrar en el select
		require_once '../modelos/Usuario.php';
		// Se crea un nuevo objeto de la clase requerida
		$usuario_log = new Usuario();

		$respuesta = $usuario_log->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->usu_id.'>'.$reg->usu_nombre.'</option>';
		}
		break;

	case 'numeroradicado':
		$respuesta = $registro_pqr->numeroradicado();
		echo json_encode($respuesta);			
		break;

	//  DESCRIPCION DE RELACION DE CAMPOS
		//  -------------------------------------------------------------------------------------
		// 	| ALIAS	| TABLA 	   | CAMPO 		 | RELACION			|							|
		//  -------------------------------------------------------------------------------------
		// 	| c 	|canal 		   | can_id 	 |can_nombre 		|reg_pqr_canal_id 			|
		// 	| t 	|tipo_canal    | tip_can_id  |tip_can_nombre 	|reg_pqr_tipo_canal_id 		|
		// 	| p 	|producto      | prod_id 	 |prod_nombre 		|reg_pqr_producto_id 		|
		// 	| q 	|tipo_pqr      | tip_pqr_id  |tip_pqr_nombre 	|reg_pqr_tipo_pqr_id 		|
		// 	| a 	|categoria_pgr | cat_pqr_id  |cat_pqr_nombre 	|reg_pqr_categoria_pqr_id 	|
		// 	| e 	|persona       | per_id 	 |per_num_documento	|reg_pqr_persona_id 		|
		// 	| r 	|area          | are_id		 |are_nombre 		|reg_pqr_remitido_id 		|
		// 	| u 	|usuario_log   | usu_id		 | usu_nombre		|reg_pqr_operador_id 		|
		// 	| s 	|estado_pqr    | est_pqr_id	 | est_pqr_nombre 	|reg_pqr_estado_id 			|
		//  -------------------------------------------------------------------------------------
	case 'listarpqrusuario':
		
		$respuesta = $seguimientoPqr->listarpqrusuario($per_id);
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		
		while ($reg = $respuesta->fetch_object()) {
			// Fecha y hora actual
			date_default_timezone_set("America/Bogota");
			$hoy = date('Y-m-d H:i:s');

			$strStart = $hoy; 
			$strEnd   = $reg->reg_pqr_fecha_fin;
			$dteStart = new DateTime($strStart); 
			$dteEnd   = new DateTime($strEnd);
			$dteDiff  = $dteStart->diff($dteEnd); 
			$inicio = new DateTime($reg->reg_pqr_fecha_inicio);
			
			$porvencer = strtotime("-12 hour", strtotime($strEnd));
			$porvencer = date('Y-m-d H:i:s',$porvencer);
			$dia 	= $dteDiff->format("%d");
			$hora 	= $dteDiff->format("%H");
			$minutos= $dteDiff->format("%I");
			
			$estado = null;
			$agregar = null;

			if ($reg->reg_pqr_estado_id == 2) {
				$verestado = 1;
				$estado = '<span class="label bg-blue">4-Cerrado</span>';
				$agregar = '<button  class="btn btn-warning" onclick="mostrar('.$reg->reg_pqr_id.'), listarseguimiento('.$reg->reg_pqr_id.'),ocultarinsertarob(),mostrarestado('.$verestado.')" ><i class="fa fa-eye"></i>
				</button>';
			}else{

				if ($hoy > $strEnd) {
					$verestado = 2;
					$estado = '<span class="label bg-red">1-Vencido</span>';
					$agregar = '<button  class="btn btn-success" onclick="mostrar('.$reg->reg_pqr_id.'), listarseguimiento('.$reg->reg_pqr_id.'),mostrarestado('.$verestado.')" ><i class="fa fa-plus-circle"></i></button>';
				}
				elseif ($hoy < $strEnd && $hoy > $porvencer ) {
					$verestado = 3;
					$estado = '<span class="label bg-orange">2-Por Vencer</span>';
					$agregar = '<button  class="btn btn-success" onclick="mostrar('.$reg->reg_pqr_id.'), listarseguimiento('.$reg->reg_pqr_id.'),mostrarestado('.$verestado.')" ><i class="fa fa-plus-circle"></i></button>';
				}
				else{
					$verestado = 4;
					$estado = '<span class="label bg-green">3-Activa</span>';
					$agregar = '<button  class="btn btn-success" onclick="mostrar('.$reg->reg_pqr_id.'), listarseguimiento('.$reg->reg_pqr_id.'),mostrarestado('.$verestado.')" ><i class="fa fa-plus-circle"></i></button>';
				}
			}

			$data[] = array(
				
				"0"=>$reg->reg_pqr_id."-"."<strong>".$reg->reg_pqr_num_radicado."<strong>",
				"1"=>$reg->per_num_documento,
				"2"=>$reg->per_nombre." ".$reg->per_apellido,
				"3"=>$reg->tip_pqr_nombre,
				"4"=>$reg->cat_pqr_nombre,
				"5"=>$reg->are_nombre,
				"6"=>$reg->reg_pqr_dias_respuesta." H",
				"7"=>$inicio->format("d/m/Y"),
				"8"=>$dteDiff->format("%d %H:%I"),
				"9"=>$reg->reg_pqr_observacion,
				"10"=>$agregar,
				"11"=>$estado
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
		
		$respuesta = $registro_pqr->listarcontrato($per_id);

		$data = Array();

		while ($res = $respuesta->fetch_object()) {

			if ($res->cont_permanencia == 0) {
				$permanencia = "NO";
			}else{
				$permanencia = "SI";
			}

			if ($res->cont_estado_servicio_id == 0) {
				$estadoservicio = 'Error ST1001';
			}
			elseif ($res->cont_estado_servicio_id == 1) {
				$estadoservicio = '<span class="label bg-yellow">Por instalar</span>';
			}
			elseif ($res->cont_estado_servicio_id == 2) {
				$estadoservicio = '<span class="label bg-green">Activo</span>';
			}
			elseif ($res->cont_estado_servicio_id == 3) {
				$estadoservicio = '<span class="label bg-red">Por Cortar</span>';
			}
			elseif ($res->cont_estado_servicio_id == 4) {
				$estadoservicio = '<span class="label bg-black">Cortado</span>';
			}
			elseif ($res->cont_estado_servicio_id == 5) {
				$estadoservicio = '<span class="label bg-blue">Por reconectar</span>';
			}
			elseif ($res->cont_estado_servicio_id == 6) {
				$estadoservicio = '<span class="label bg-gray">Suspendido</span>';
			}
			elseif ($res->cont_estado_servicio_id == 7) {
				$estadoservicio = '<span class="label bg-orange">Reco - Susp</span>';
			}
			elseif ($res->cont_estado_servicio_id == 8){
				$estadoservicio = '<span class="label bg-purple">Por suspender</span>';
			}
			elseif ($res->cont_estado_servicio_id == 9){
				$estadoservicio = '<span class="label bg-gray">Mantenimiento</span>';
			}
			elseif ($res->cont_estado_servicio_id == 10) {
				$estadoservicio = '<span class="label bg-gray">Retirado</span>';
			}
			elseif ($res->cont_estado_servicio_id == 11) {
				$estadoservicio = '<span class="label bg-gray">Corte por retiro</span>';
			}
			elseif ($res->cont_estado_servicio_id == 12) {
				$estadoservicio = '<span class="label bg-red">Por traslado</span>';
			}
			elseif ($res->cont_estado_servicio_id == 13) {
				$estadoservicio = '<span class="label bg-red">Pago Realizado</span>';	
			}
			elseif($res->cont_estado_servicio_id >= 14){
				$estadoservicio = 'Error ST1002';
			}

			$data[] = array(

				"0"=>$res->cont_no_contrato.'-'.$res->cont_id,
				"1"=>'$'.number_format($res->cont_valor_basico_mes),
				"2"=>$res->cont_direccion_serv,
				"3"=>$res->cont_vigencia_a_partir,
				"4"=>$permanencia,
				"5"=>$estadoservicio,
				"6"=>'<a href="../reportes/impContrato.php?cont_id='.$res->cont_id.'" target="_blanck" style="text-decoration:nome;">
					<span data-toggle="tooltip" data-placement="right" title="Imprimir contrato"  class="btn btn-default" class="btn btn-basic"><i class="fa fa-print"></i></span>
					</a>
					<button class="btn btn-primary" data-toggle="modal" data-target="#modalProductos"    onclick="listarproductos('.$res->cont_id.')" ><i class="fa fa-shopping-cart"></i></button> 
					<button class="btn btn-success" data-toggle="modal" data-target="#modalEstadoCta"    onclick="listarestadocuenta('.$res->cont_id.')"><i class="fa fa-usd"></i></button>
					<button class="btn btn-info"    data-toggle="modal" data-target="#modalEstadoServ"   onclick="listarestadoservicio('.$res->cont_id.')"><i class="fa fa-tag"></i></button> 
					<button class="btn btn-warning" data-toggle="modal" data-target="#modalCambioEstado" onclick="vermodal('.$res->cont_id.')">OT<i class="fa"></i></button> 
					'
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

	case 'listarproductos':
		
		$respuesta = $registro_pqr->listarproductos($cont_id);

		while ($reg = $respuesta->fetch_object()) {

			$data[] = array(

				"0"=>$reg->prod_id,
				"1"=>$reg->prod_nombre,
				"2"=>$reg->prod_descripcion,
				"3"=>'$'.number_format($reg->prod_valor),
				"4"=>'$'.number_format($reg->prod_valor_pronto_pago),
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

	case 'guardarnuevoestado':
		require_once "../modelos/Recaudo.php";
		$recaudo = new Recaudo();

		$respuesta = $recaudo->guardarnuevoestado($nuevoestado, $v_contratoid, $reg_pqr_operador_id);
		echo $respuesta ? "Estado actualizado correctamente":"Es estado no pudo ser actualizado";
		break;

	case 'listarestadoservicio':
		$respuesta = $registro_pqr->listarestadoservicio($cont_id);

		$data = Array();

		while ($reg = $respuesta->fetch_object()) {

			if ($reg->cc_est_ser_estado_id == 1) {
				$estadoservicio = '<span class="label bg-yellow">Por instalar</span>';
			}elseif ($reg->cc_est_ser_estado_id == 2) {
				$estadoservicio = '<span class="label bg-green">Activo</span>';
			}elseif ($reg->cc_est_ser_estado_id == 3) {
				$estadoservicio = '<span class="label bg-red">Por Cortar</span>';
			}elseif ($reg->cc_est_ser_estado_id == 4) {
				$estadoservicio = '<span class="label bg-black">Cortado</span>';
			}elseif ($reg->cc_est_ser_estado_id == 5) {
				$estadoservicio = '<span class="label bg-blue">Por reconectar</span>';
			}elseif ($reg->cc_est_ser_estado_id == 6) {
				$estadoservicio = '<span class="label bg-gray">Suspendido</span>';
			}elseif ($reg->cc_est_ser_estado_id == 7) {
				$estadoservicio = '<span class="label bg-orange">Reco - susp</span>';
			}elseif ($reg->cc_est_ser_estado_id == 8){
				$estadoservicio = '<span class="label bg-purple">Por suspender</span>';
			}elseif ($reg->cc_est_ser_estado_id == 9){
				$estadoservicio = '<span class="label bg-gray">Mantenimiento</span>';
			}

			$data[] = array(

				"0"=>$reg->cc_est_ser_id,
				"1"=>$estadoservicio,
				"2"=>$reg->cc_est_ser_fecha
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

	case 'insertarnotificacion':
		
		$respuesta = $registro_pqr->insertarnotificacion(
			$area_envio,
			$reg_pqr_remitido_id,
			$reg_pqr_categoria_pqr_id
		);

		echo $respuesta?"Notificacion enviada":"No fue posible enviar la notificacion";

		break;
}

?>