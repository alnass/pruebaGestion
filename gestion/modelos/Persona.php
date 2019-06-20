<?php 
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

// Incluir la conexion a BDs
require '../config/conexion.php';

Class Persona {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro
	public function insertar(
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
		$per_contrasenia){

		$sede = $_SESSION['usu_sede_id'];
		$alianza = $_SESSION['usu_alianza_id'];

		$sql = "INSERT INTO persona (
				per_id,
				per_prefijo,
				per_marca,
				per_precinto,
				per_tipo_persona_id,
				per_tipo_cliente_id,
				per_alianza_id,
				per_tipo_documento_id,
				per_num_documento,
				per_fecha_exped_doc,
				per_nombre,
				per_apellido,
				per_fecha_nacimiento,
				per_telefono_1,
				per_telefono_2,
				per_ciudad_id,
				per_barrio,
				per_tipo_vivienda_id,
				per_direccion,
				per_correo_personal,
				per_correo_corp,
				per_usuario,
				per_contrasenia
				)
			VALUES (
				null,
				'$sede',
				'B',
				'$per_precinto',
				'$per_tipo_persona_id',
				'$per_tipo_cliente_id',
				'$alianza',
				'$per_tipo_documento_id',
				'$per_num_documento',
				'$per_fecha_exped_doc',
				'$per_nombre',
				'$per_apellido',
				'$per_fecha_nacimiento',
				'$per_telefono_1',
				'$per_telefono_2',
				'$per_ciudad_id',
				'$per_barrio',
				'$per_tipo_vivienda_id',
				'$per_direccion',
				'$per_correo_personal',
				'$per_correo_corp',
				'$per_usuario',
				'$per_contrasenia')";

		return ejecutarConsulta_retornaID($sql);
	}

	// Implementacion de metodo de edicion
	public function editar(
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
		$per_contrasenia){

		$sql = "UPDATE persona 
				SET per_prefijo 			= '$per_prefijo',
					per_marca 				= '$per_marca',
					per_precinto 			= '$per_precinto',
					per_tipo_persona_id 	= '$per_tipo_persona_id',
					per_tipo_cliente_id 	= '$per_tipo_cliente_id',
					per_alianza_id 			= '$per_alianza_id',
					per_tipo_documento_id 	= '$per_tipo_documento_id',
					per_num_documento 		= '$per_num_documento',
					per_fecha_exped_doc 	= '$per_fecha_exped_doc',
					per_nombre 				= '$per_nombre',
					per_apellido 			= '$per_apellido',
					per_fecha_nacimiento 	= '$per_fecha_nacimiento',
					per_telefono_1 			= '$per_telefono_1',
					per_telefono_2 			= '$per_telefono_2',
					per_ciudad_id 			= '$per_ciudad_id',
					per_barrio 				= '$per_barrio',
					per_tipo_vivienda_id 	= '$per_tipo_vivienda_id',
					per_direccion 			= '$per_direccion',
					per_correo_personal 	= '$per_correo_personal',
					per_correo_corp 		= '$per_correo_corp',
					per_usuario 			= '$per_usuario',
					per_contrasenia 		= '$per_contrasenia'

				WHERE per_id = '$per_id'";

		return ejecutarConsulta($sql);
	}
	// Implementacion de metodo de desactivacion
	public function desactivar($per_id){
		$sql = "UPDATE persona 
				SET per_estado = '0'
				WHERE per_id = '$per_id'";

		return ejecutarConsulta($sql);
	}
	// Implementacion de metodo de activacion
	public function activar($per_id){
		$sql = "UPDATE persona 
				SET per_estado = '1'
				WHERE per_id = '$per_id'";

		return ejecutarConsulta($sql);
	}
	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($per_id){
		$sql = "SELECT * FROM persona
				WHERE per_id = '$per_id'";

		return ejecutarConsultaSimpleFila($sql);
	}
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

	public function listar(){
		if ($_SESSION['usu_area_id'] == 5) {

			$sql = "SELECT
					p.per_id,	
					p.per_num_documento, 
					p.per_nombre ,
					p.per_apellido, 
					p.per_telefono_1 ,
					ci.ciu_nombre,
					p.per_direccion ,
					p.per_correo_personal,
					p.per_estado
				FROM persona p 

				INNER JOIN ciudad ci 
				ON p.per_ciudad_id	= ci.ciu_id		
				";

			return ejecutarConsulta($sql);
		}else{
			$sede = $_SESSION['usu_sede_id'];
			$sql = "SELECT
					p.per_id,	
					p.per_num_documento, 
					p.per_nombre ,
					p.per_apellido, 
					p.per_telefono_1 ,
					ci.ciu_nombre,
					p.per_direccion ,
					p.per_correo_personal,
					p.per_estado

				FROM persona p 

				INNER JOIN ciudad ci 
				ON p.per_ciudad_id	= ci.ciu_id	
				WHERE per_prefijo = '$sede'
				";

			return ejecutarConsulta($sql);
		}
	}

	public function contratopermanencia(
		$cont_id, 	
		$cont_no_contrato,
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

		$cont_prod_producto_id,
		$cont_prod_cantidad,
		$cont_prod_precio,

		$cargo_adicional
			
		){
			// Insercion en la tabla de contrato 
			$sql_contrato = "INSERT INTO contrato(
				cont_id, 	
				cont_no_contrato,
				cont_persona_id,	
				cont_direccion_serv,
				cont_barrio,
				cont_tipo_vivienda_id,
				cont_estrato,	
				cont_minimo_mensual,	
				cont_vigencia_a_partir,	
				cont_renovacion_auto,	
				cont_tv_analogica,	
				cont_tv_digital,
				cont_internet,
				cont_adicional,
				cont_fecha_activacion,
				cont_valor_basico_mes,	
				cont_valor_total_mes,	
				cont_permanencia,
				cont_cargo_conexion,
				cont_valor_diferido,
				cont_fecha_ini_perm,
				cont_fecha_fin_perm,	
				cont_costo_reconexion,
				cont_fecha_transaccion,
				cont_sede_id,
				cont_usuario_id
				)
			VALUES(
				null, 	
				'$cont_no_contrato',
				'$cont_persona_id',	
				'$cont_direccion_serv',
				'$cont_barrio',
				'$cont_tipo_vivienda_id',
				'$cont_estrato',	
				'$cont_minimo_mensual',	
				'$cont_vigencia_a_partir',	
				'$cont_renovacion_auto',	
				'$cont_tv_analogica',	
				'$cont_tv_digital',
				'$cont_internet',
				'$cont_adicional',
				'$cont_fecha_activacion',
				'$cont_valor_basico_mes',	
				'$cont_valor_total_mes',	
				'$cont_permanencia',
				'$cont_cargo_conexion',
				'$cont_valor_diferido',
				'$cont_fecha_ini_perm',
				'$cont_fecha_fin_perm',	
				'$cont_costo_reconexion',
				'$cont_fecha_transaccion',
				'$cont_sede_id',
				'$cont_usuario_id'
			)";

		$id_contrato = ejecutarConsulta_retornaID($sql_contrato);

		$num_elementos = 0;
		$sw = true;

		// Insercion de los productos del contrato
		while ($num_elementos < count($cont_prod_producto_id)) {
			
			$sql_detalle = "INSERT INTO contrato_producto(
				cont_prod_contrato_id,
				cont_prod_producto_id,
				cont_prod_cantidad,
				cont_prod_precio			
				)
				VALUES(
				'$id_contrato',
				'$cont_prod_producto_id[$num_elementos]',
				'$cont_prod_cantidad[$num_elementos]',
				'$cont_prod_precio[$num_elementos]'
				)"; 

				ejecutarConsulta($sql_detalle) or $sw = false;
				$num_elementos++;
		}

		// Insercion de la primera mensualidad en la tabla estado de cueta
		$comprobante = $cont_no_contrato."-".$id_contrato;
		$concepto = 4;

		$sqlnvonumfac ="INSERT INTO numeracion_recibo_caja (
				num_fac_id,
				num_fac_sede_id
				)VALUES(
				null,
				'$cont_sede_id'
				)";
		$numfac = ejecutarConsulta_retornaID($sqlnvonumfac);
		
		if ($cargo_adicional != 0) {
			
			$sqladicional = "INSERT INTO estado_cuenta_fin(
					est_cta_id,
					est_cta_persona_id,
					est_cta_contrato_id,
					est_cta_no_transaccion,
					est_cta_no_comprobante,
					est_cta_fecha_comprobante,
					est_cta_transaccion_id,
					est_cta_concep_trans_id,
					est_cta_haber,
					est_cta_saldo_actual,
					est_cta_observacion,
					est_cta_sede_id,
					est_cta_usuario_id
					)
					VALUES(
					null,
					'$cont_persona_id',	
					'$id_contrato',
					'$numfac',
					'$comprobante',
					'$cont_vigencia_a_partir',
					'1',
					'13',
					'$cargo_adicional',
					'$cargo_adicional',
					'$cont_adicional',
					'$cont_sede_id',
					'$cont_usuario_id'
					)";

			$saldofinal = $cont_valor_diferido + $cargo_adicional;
			ejecutarConsulta($sqladicional) or $sw = false;
		}else{
			$saldofinal = $cont_valor_diferido;
		}

		if ($cont_valor_diferido != 0) {
			
			$sqldiferido = "INSERT INTO estado_cuenta_fin(
					est_cta_id,
					est_cta_persona_id,
					est_cta_contrato_id,
					est_cta_no_transaccion,
					est_cta_no_comprobante,
					est_cta_fecha_comprobante,
					est_cta_transaccion_id,
					est_cta_concep_trans_id,
					est_cta_haber,
					est_cta_saldo_anterior,
					est_cta_saldo_actual,
					est_cta_sede_id,
					est_cta_usuario_id
					)
					VALUES(
					null,
					'$cont_persona_id',	
					'$id_contrato',
					'$numfac',
					'$comprobante',
					'$cont_vigencia_a_partir',
					'4',
					'$concepto',
					'$cont_valor_diferido',
					'$cargo_adicional',
					'$saldofinal',
					'$cont_sede_id',
					'$cont_usuario_id'
					)";

			ejecutarConsulta($sqldiferido) or $sw = false;
		}

		$sqlcc_mensualidad = "INSERT INTO cc_mensualidad(
				cc_mens_id,
				cc_mens_contrato_id,
				cc_mens_valor,
				cc_mens_usuario_id
				)VALUES(
				null,
				'$id_contrato',
				'$cont_valor_basico_mes',
				'$cont_usuario_id'
				)";
			ejecutarConsulta($sqlcc_mensualidad) or $sw = false;

		$sqlcc_estado = "INSERT INTO cc_estado_servicio(
				cc_est_ser_id,
				cc_est_ser_contrato_id,
				cc_est_ser_usuario_id,
				cc_est_ser_estado_id,
				cc_est_ser_fecha
				)VALUES(
				null,
				'$id_contrato',
				'$cont_usuario_id',
				'1',
				null
				)";
			ejecutarConsulta($sqlcc_estado) or $sw = false;

		return $sw;
	}

	public function contratoSINpermanencia(
		$cont_id, 	
		$cont_no_contrato,
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

		$cont_prod_producto_id,
		$cont_prod_cantidad,
		$cont_prod_precio,

		$cargo_adicional
			
		){
		// Insercion en la tabla de contrato 
			$sql_contrato = "INSERT INTO contrato(
				cont_id, 	
				cont_no_contrato,
				cont_persona_id,	
				cont_direccion_serv,
				cont_barrio,
				cont_tipo_vivienda_id,
				cont_estrato,	
				cont_minimo_mensual,	
				cont_vigencia_a_partir,	
				cont_renovacion_auto,	
				cont_tv_analogica,	
				cont_tv_digital,
				cont_internet,
				cont_adicional,
				cont_fecha_activacion,
				cont_valor_basico_mes,	
				cont_valor_total_mes,	
				cont_permanencia,
				cont_cargo_conexion,
				cont_valor_diferido,
				cont_fecha_ini_perm,
				cont_fecha_fin_perm,	
				cont_costo_reconexion,
				cont_fecha_transaccion,
				cont_sede_id,
				cont_usuario_id
				)
			VALUES(
				null, 	
				'$cont_no_contrato',
				'$cont_persona_id',	
				'$cont_direccion_serv',
				'$cont_barrio',
				'$cont_tipo_vivienda_id',
				'$cont_estrato',	
				'$cont_minimo_mensual',	
				'$cont_vigencia_a_partir',	
				'$cont_renovacion_auto',	
				'$cont_tv_analogica',	
				'$cont_tv_digital',
				'$cont_internet',
				'$cont_adicional',
				'$cont_fecha_activacion',
				'$cont_valor_basico_mes',	
				'$cont_valor_total_mes',	
				'$cont_permanencia',
				'$cont_cargo_conexion',
				'$cont_valor_diferido',
				'$cont_fecha_ini_perm',
				'$cont_fecha_fin_perm',	
				'$cont_costo_reconexion',
				'$cont_fecha_transaccion',
				'$cont_sede_id',
				'$cont_usuario_id'
			)";

		$id_contrato = ejecutarConsulta_retornaID($sql_contrato);

		$num_elementos = 0;
		$sw = true;

		// Insercion de los productos del contrato
		while ($num_elementos < count($cont_prod_producto_id)) {
			
			$sql_detalle = "INSERT INTO contrato_producto(
				cont_prod_contrato_id,
				cont_prod_producto_id,
				cont_prod_cantidad,
				cont_prod_precio			
				)
				VALUES(
				'$id_contrato',
				'$cont_prod_producto_id[$num_elementos]',
				'$cont_prod_cantidad[$num_elementos]',
				'$cont_prod_precio[$num_elementos]'
				)"; 

				ejecutarConsulta($sql_detalle) or $sw = false;
				$num_elementos++;
		}

		$sqlnvonumfac ="INSERT INTO numeracion_recibo_caja (
				num_fac_id,
				num_fac_sede_id
				)VALUES(
				null,
				'$cont_sede_id'
				)";
		$numfac = ejecutarConsulta_retornaID($sqlnvonumfac);

		// // Insercion de la primera mensualidad en la tabla estado de cueta
		$comprobante = $cont_no_contrato."-".$id_contrato;
		// $concepto = 3;

		// $sqlestadocuenta = "INSERT INTO estado_cuenta_fin(
			// 		est_cta_id,
			// 		est_cta_persona_id,
			// 		est_cta_contrato_id,
			// 		est_cta_no_transaccion,
			// 		est_cta_no_comprobante,
			// 		est_cta_fecha_comprobante,
			// 		est_cta_transaccion_id,
			// 		est_cta_concep_trans_id,
			// 		est_cta_haber,
			// 		est_cta_saldo_actual,
			// 		est_cta_sede_id,
			// 		est_cta_usuario_id
			// 		)
			// 		VALUES(
			// 		null,
			// 		'$id_persona',	
			// 		'$id_contrato',
			// 		'$numfac',
			// 		'$comprobante',
			// 		'$cont_vigencia_a_partir',
			// 		'1',
			// 		'$concepto',
			// 		'$cont_minimo_mensual',
			// 		'$cont_minimo_mensual',
			// 		'$cont_sede_id',
			// 		'$cont_usuario_id'
			// 		)";

		// ejecutarConsulta($sqlestadocuenta) or $sw = false;


		// Insercion del valor de la conexion cuando no tiene permanencia 
		$concepto = 4;
		// $saldoactual = $cont_cargo_conexion + $cont_minimo_mensual;
		$saldoactual = $cont_cargo_conexion;

		

		if ($cargo_adicional != 0) {
			
			$sqladicional = "INSERT INTO estado_cuenta_fin(
					est_cta_id,
					est_cta_persona_id,
					est_cta_contrato_id,
					est_cta_no_transaccion,
					est_cta_no_comprobante,
					est_cta_fecha_comprobante,
					est_cta_transaccion_id,
					est_cta_concep_trans_id,
					est_cta_haber,
					est_cta_saldo_actual,
					est_cta_observacion,
					est_cta_sede_id,
					est_cta_usuario_id
					)
					VALUES(
					null,
					'$cont_persona_id',	
					'$id_contrato',
					'$numfac',
					'$comprobante',
					'$cont_vigencia_a_partir',
					'1',
					'13',
					'$cargo_adicional',
					'$cargo_adicional',
					'$cont_adicional',
					'$cont_sede_id',
					'$cont_usuario_id'
					)";

			$saldofinal = $cont_cargo_conexion + $cargo_adicional;
			ejecutarConsulta($sqladicional) or $sw = false;
		}else{
			$saldofinal = $cont_cargo_conexion;
		}

		$sqlnopermanencia = "INSERT INTO estado_cuenta_fin(
			est_cta_id,
			est_cta_persona_id,
			est_cta_contrato_id,
			est_cta_no_transaccion,
			est_cta_no_comprobante,
			est_cta_fecha_comprobante,
			est_cta_transaccion_id,
			est_cta_concep_trans_id,
			est_cta_haber,
			est_cta_saldo_actual,
			est_cta_saldo_anterior,
			est_cta_sede_id,
			est_cta_usuario_id
			)
			VALUES(
			null,
			'$cont_persona_id',	
			'$id_contrato',
			'$numfac',
			'$comprobante',
			'$cont_vigencia_a_partir',
			'1',
			'$concepto',
			'$cont_cargo_conexion',
			'$saldofinal',
			'$cargo_adicional',
			'$cont_sede_id',
			'$cont_usuario_id'
			)";

		ejecutarConsulta($sqlnopermanencia) or $sw = false;

		$sqlcc_mensualidad = "INSERT INTO cc_mensualidad(
				cc_mens_id,
				cc_mens_contrato_id,
				cc_mens_valor,
				cc_mens_usuario_id
				)VALUES(
				null,
				'$id_contrato',
				'$cont_valor_basico_mes',
				'$cont_usuario_id'
				)";
			ejecutarConsulta($sqlcc_mensualidad) or $sw = false;

		$sqlcc_estado = "INSERT INTO cc_estado_servicio(
				cc_est_ser_id,
				cc_est_ser_contrato_id,
				cc_est_ser_usuario_id,
				cc_est_ser_estado_id,
				cc_est_ser_fecha
				)VALUES(
				null,
				'$id_contrato',
				'$cont_usuario_id',
				'1',
				null
				)";
			ejecutarConsulta($sqlcc_estado) or $sw = false;

		return $sw;
	}

	
}
?>