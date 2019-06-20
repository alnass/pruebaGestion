<?php 

// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// seguimiento_pqr 

// NOMBRE DE LOS CAMPOS
// 		seg_id
// 		seg_registro_pqr_id
// 		seg_area_remite_id
// 		seg_area_recibe_id
// 		seg_responsable
// 		seg_fecha_envio
// 		seg_fecha_revision
// 		seg_observacion

// NOMBRES DE LOS INPUTS
// 		seg_id
// 		registros
// 		remite 
// 		recibe 
// 		responsable 
// 		fechaenvio
// 		fecharevision 
// 		obseguimiento
// NOMBRE DE LA CLASE
// 		seguimientoPqr

// NOMBREDE AJAX 
// 		seguimientoPqr

require_once "../modelos/SeguimientoPqr.php";

$seguimientoPqr = new SeguimientoPqr();


$reg_pqr_id  			= isset($_POST['reg_pqr_id'])? limpiarCadena($_POST['reg_pqr_id']):"";
$reg_pqr_canal_id 		= isset($_POST['canal'])? limpiarCadena($_POST['canal']):"";
$reg_pqr_tipo_canal_id 	= isset($_POST['tipoCanal'])? limpiarCadena($_POST['tipoCanal']):"";
$reg_pqr_producto_id 	= isset($_POST['producto'])? limpiarCadena($_POST['producto']):"";
$reg_pqr_tipo_pqr_id 	= isset($_POST['tipoPqr'])? limpiarCadena($_POST['tipoPqr']):"";
$reg_pqr_categoria_pqr_id = isset($_POST['categoriaPqr'])? limpiarCadena($_POST['categoriaPqr']):"";
$reg_pqr_persona_id 	= isset($_POST['persona'])? limpiarCadena($_POST['persona']):"";
$reg_pqr_remitido_id 	= isset($_POST['remitido'])? limpiarCadena($_POST['remitido']):"";
$reg_pqr_num_radicado 	= isset($_POST['numRadicado'])? limpiarCadena($_POST['numRadicado']):"";
$reg_pqr_fecha_inicio 	= isset($_POST['fechaInicio'])? limpiarCadena($_POST['fechaInicio']):"";
$reg_pqr_fecha_remision = isset($_POST['fechaRemision'])? limpiarCadena($_POST['fechaRemision']):"";
$reg_pqr_fecha_fin 		= isset($_POST['fechaFin'])? limpiarCadena($_POST['fechaFin']):"";
$reg_pqr_ticket_interno = isset($_POST['ticket'])? limpiarCadena($_POST['ticket']):"";
$reg_pqr_operador_id 	= isset($_POST['operador'])? limpiarCadena($_POST['operador']):"";
$reg_pqr_dias_respuesta = isset($_POST['dias'])? limpiarCadena($_POST['dias']):"";
$reg_pqr_observacion 	= isset($_POST['observacion'])? limpiarCadena($_POST['observacion']):"";

$seg_id 			= isset($_POST['seg_id'])? limpiarCadena($_POST['seg_id']):"";
$seg_registro_pqr_id= $reg_pqr_id;
$seg_area_remite_id = $_SESSION['usu_area_id'];
$seg_area_recibe_id = isset($_POST['nvoremision'])? limpiarCadena($_POST['nvoremision']):"";
$seg_responsable	= $_SESSION['usu_id'];
$seg_fecha_envio 	= isset($_POST['fechaenvio'])? limpiarCadena($_POST['fechaenvio']):"";
$seg_fecha_revision = isset($_POST['fechaRev'])? limpiarCadena($_POST['fechaRev']):"";
$seg_observacion 	= isset($_POST['obseguimiento'])? limpiarCadena($_POST['obseguimiento']):"";

 

$seg_area_recibe_id 	= isset($_POST['nvoremision'])? limpiarCadena($_POST['nvoremision']):"";	

switch ($_GET["op"]) {


	case 'guardaryeditar':

		$sql = "SELECT are_correo 
				FROM area
				WHERE are_id = '$seg_area_recibe_id'";

		$correo =  ejecutarConsultaSimpleFila($sql);
			// Convierte el array en cadena de texto
		$correo = implode("", $correo);
		

			$respuesta = $seguimientoPqr->insertar(
				$seg_id,
				$seg_registro_pqr_id,
				$seg_area_remite_id,
				$seg_area_recibe_id,
				$seg_responsable,
				$seg_fecha_envio,
				$seg_fecha_revision,
				$seg_observacion
			);
					
	echo $respuesta ? "Nueva Observacion registrada".$correo : "No fue posible registrar una nueva observacion"; 

	$asunto = "Seguimiento de PQR's"; 
		$cuerpo = ' 
		<html> 
		<head> 
		   <title>Seguimiento de PQR registrada</title> 
		</head> 
		<body> 
		<h1>Seguimiento de PQR´s</h1>
		<p>Se ha agregado una nueva observacion a una PQR y se dirigido a tu área</p> 
		<p>Observación:</p>
		<p>'.$seg_observacion.'</p>
		</body> 
		</html> 
		'; 
	
		//para el envío en formato HTML 
		$headers = "MIME-Version: 1.0\r\n"; 
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	
		//dirección del remitente 
		$headers .= "From: Sistema de gestión Globalplay <servicioalcliente@globalplay.tv>\r\n"; 
	
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
		$respuesta = $seguimientoPqr->desactivar($reg_pqr_id);
		echo $respuesta ? "PQR's desactivada" : "PQR's no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $seguimientoPqr->activar($reg_pqr_id);
		echo $respuesta ? "PQR's activada" : "PQR's no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $seguimientoPqr->mostrar($reg_pqr_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $seguimientoPqr->listar();
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
			
			$porvencer = strtotime("-36 hour", strtotime($strEnd));
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
			echo '<option value='.$reg->cat_pqr_id.'>'.$reg->cat_pqr_nombre.'</option>';
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
}

?>