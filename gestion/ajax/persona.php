<?php 
session_start();
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA
// 		persona

// MONBRE DE LOS CAMPOS
	// 1	per_id
	// 2	per_prefijo
	// 3	per_marca
	// 4	per_precinto
	// 5	per_tipo_persona_id
	// 6	per_tipo_cliente_id
	// 7	per_alianza_id
	// 8	per_tipo_documento_id
	// 9	per_num_documento
	// 10	per_fecha_exped_doc
	// 11	per_nombre
	// 12	per_apellido
	// 13	per_fecha_nacimiento
	// 14	per_telefono_1
	// 15	per_telefono_2
	// 16	per_ciudad_id
	// 17	per_barrio
	// 18	per_tipo_vivienda_id
	// 19	per_direccion
	// 20	per_correo_personal
	// 21	per_correo_corp
	// 22	per_usuario
	// 23	per_contrasenia
	// 24	per_estado

// NOMBRES DE LOS INPUTS DEL HTMPL
	// -------------------------
	// |number  | 	per_id 		|
	// |text 	|	prefijo 	|
	// |text 	|	marca 		|
	// |text 	|	precinto 	|
	// |select  |	tipoPersona |
	// |select  |	tipoCliente |
	// |select  |	alianza 	|
	// |select  |	tipoDoc 	|
	// |number  |	numDoc 		|
	// |date 	|	expedDoc 	| 
	// |text 	|	nombre 		|
	// |text 	|	apellido 	| 
	// |date 	|	nacimiento 	|
	// |text 	|	tel1 		|
	// |text 	|	tel2 		|
	// |select  |	ciudad 		| 
	// |text 	|	barrio 		|
	// |select  |	tipoVivien 	|
	// |text 	|	direccion 	|
	// |text 	|	correoPer 	|
	// |text 	| 	correoCorp 	|
	// |text 	|	usuario 	|
	// |password|	pass 		|
	// -------------------------

// NOMBRE DE LA CLASE
	// 		Persona

// AJAX
	// 		persona 

require_once "../modelos/Persona.php";

$persona = new Persona();
date_default_timezone_set('America/Bogota');

$per_id 				= isset($_POST['per_id'])? limpiarCadena($_POST['per_id']):"";
$per_prefijo 			= $_SESSION['usu_sede_id'];
$per_marca 				= isset($_POST['marca'])? limpiarCadena($_POST['marca']):"";
$per_precinto 			= isset($_POST['precinto'])? limpiarCadena($_POST['precinto']):"";
$per_tipo_persona_id 	= isset($_POST['tipoPersona'])? limpiarCadena($_POST['tipoPersona']):"";
$per_tipo_cliente_id 	= isset($_POST['tipoCliente'])? limpiarCadena($_POST['tipoCliente']):"";
$per_alianza_id 		= $_SESSION['usu_alianza_id'];
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
$cont_id 				= isset($_POST['cont_id'])? limpiarCadena($_POST['cont_id']):"";
$cont_persona_id 		= isset($_POST['per_id'])? limpiarCadena($_POST['per_id']):"";
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
$cont_fecha_transaccion = date("Y-m-d H:i:s");
$cont_usuario_id		= $_SESSION['usu_id'];
$cont_sede_id			= $_SESSION['usu_sede_id'];

switch ($_GET["op"]) {
	case 'guardaryeditar':

		$sql = "SELECT ciu_depto_codigo, ciu_codigo FROM ciudad WHERE ciu_id = '$per_ciudad_id'";
		$a = ejecutarConsultaSimpleFila($sql);

		$sqlExistente = "SELECT * FROM persona
						WHERE per_num_documento = '$per_num_documento'
						";
		$existente = ejecutarConsultaSimpleFila($sqlExistente);

		if ($existente) {

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

			if ($cont_permanencia == 1) {
				$respuesta = $persona->contratopermanencia(
					$cont_id, 	
					$cont_no_contrato = $a['ciu_depto_codigo'].$a['ciu_codigo'],
					$per_id,	
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
				echo $respuesta ? "Contrato registrado exitosamente" : "El contrato con permanencia no pudo ser registrado completamente"; 
			}else{
				$respuesta = $persona->contratoSINpermanencia (
					$cont_id, 	
					$cont_no_contrato = $a['ciu_depto_codigo'].$a['ciu_codigo'],
					$per_id,	
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
				
				echo $respuesta ? "Contrato registrado exitosamente" : "El contrato sin permanencia no pudo ser registrado completamente";
			}
		}else{
			if (empty($per_id)) {
				$respuesta = $persona->insertar(
					$per_id,
					// $per_prefijo,
					$per_marca,
					$per_precinto,
					$per_tipo_persona_id,
					$per_tipo_cliente_id,
					// $per_alianza_id,
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

				//$res = $respuesta->fetch_object(); 

					if ($cont_permanencia == 1) {
					$respuesta = $persona->contratopermanencia(
						$cont_id, 	
						$cont_no_contrato = $a['ciu_depto_codigo'].$a['ciu_codigo'],
						$respuesta,	
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
					echo $respuesta ? "Contrato registrado exitosamente" : "El nuevo contrato con permanencia no pudo ser registrado completamente"; 
				}else{
					$respuesta = $persona->contratoSINpermanencia (
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
					
					echo $respuesta ? "Contrato registrado exitosamente" : "El nuevo contrato sin permanencia no pudo ser registrado completamente";
				}
				echo $respuesta ? "Persona registrado" : "Persona no se pudo registrar"; 
			}else{		
				echo "El suscriptor ya se encontraba registrado en la base de datos. Puede realizar la busqueda nueamente y actualizar sus datos";
			}
		}
		break;

	case 'desactivar':
		$respuesta = $persona->desactivar($per_id);
		echo $respuesta ? "Persona desactivada" : "Persona no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $persona->activar($per_id);
		echo $respuesta ? "Persona activada" : "Persona no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $persona->mostrar($per_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $persona->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->per_estado)?'<button  class="btn btn-success" data-toggle="tooltip" title="Agregar contrato" onclick="mostrar('.$reg->per_id.')"><i class="fa fa-book"></i></button>'
				// ." ".'<button  class="btn btn-danger" data-toggle="tooltip" title="Desactivar" onclick="desactivar('.$reg->per_id.')"><i class="fa fa-close"></i></button>'
				:
				'<button  class="btn btn-warning" data-toggle="tooltip" title="Agregar contrato" onclick="mostrar('.$reg->per_id.')"><i class="fa fa-pencil"></i></button>'
				// ." ".'<button  class="btn btn-primary" data-toggle="tooltip" title="Activar" onclick="activar('.$reg->per_id.')"><i class="fa fa-check"></i></button>'
				,
				"1"=>$reg->per_num_documento,
				"2"=>$reg->per_nombre." ".$reg->per_apellido,
				"3"=>$reg->per_telefono_1,
				"4"=>$reg->ciu_nombre,
				"5"=>$reg->per_direccion,
				"6"=>$reg->per_correo_personal,
				"7"=>($reg->per_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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

	// DESCRIPCION DE RELACIONES DE LA TABLAS
		// --------------------------------------------------------------------------
		// |ALI | TABLA 		| CAMPO 	|				| RELACION 				|
		// --------------------------------------------------------------------------
		// | p  |persona		|			|				|per_id 				|
		// | p  |				|			|				|per_prefijo 			|
		// | p  |				|			|				|per_marca 				|
		// | p  |				|			|				|per_precinto 			|
		// | tp |tipo_persona   |tip_per_id	|tip_per_nombre |per_tipo_persona_id 	|
		// | tc |tipo_cliente   |tip_cli_id	|tip_cli_nombre |per_tipo_cliente_id 	|
		// | al |alianza 		|ali_id		|ali_nombre 	|per_alianza_id 		|
		// | td |tipo_documento |tip_doc_id	|tip_doc_nombre |per_tipo_documento_id 	|	
		// | p  |				|			|				|per_num_documento 		|
		// | p  |				|			|				|per_fecha_exped_doc 	|
		// | p  |				|			|				|per_nombre 			|
		// | p  |				|			|				|per_apellido 			|
		// | p  |				|			|				|per_fecha_nacimiento 	|
		// | p  |				|			|				|per_telefono_1 		|
		// | p  |				|			|				|per_telefono_2 		|
		// | ci |ciudad 		|ciu_id		|ciu_nombre 	|per_ciudad_id 			|
		// | p  |				|			|				|per_barrio 			|
		// | tv |tipo_vivienda  |tip_viv_id	|tip_viv_nombre	|per_tipo_vivienda_id 	|
		// | p  |				|			|				|per_direccion  		|
		// | p  |				|			|				|per_correo_personal 	|
		// | p  |				|			|				|per_correo_corp 		| 
		// | p  |				|			|				|per_usuario 			|
		// | p  |				|			|				|per_contrasenia 		|
		// | p  |				|			|				|per_estado 			|
		// --------------------------------------------------------------------------

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

}

?>