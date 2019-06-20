<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA
// 		persona

// MONBRE DE LOS CAMPOS - PERSONA
	// 1	per_id
	// 5	per_tipo_persona_id
	// 6	per_tipo_cliente_id
	// 7	per_alianza_id
	// 8	per_tipo_documento_id
	// 9	per_num_documento
	// 11	per_nombre
	// 12	per_apellido
	// 14	per_telefono_1
	// 15	per_telefono_2
	// 16	per_ciudad_id
	// 17	per_barrio
	// 18	per_tipo_vivienda_id
	// 19	per_direccion
	// 20	per_correo_personal
	// 24	per_estado

// MONBRE DE LOS CAMPOS - CONTRATO
	// cont_id 	
	// cont_no_contrato
	// cont_persona_id	
	// cont_direccion_serv	
	// cont_estrato	
	// cont_minimo_mensual	
	// cont_vigencia_a_partir	
	// cont_renovacion_auto	
	// cont_tv_analogica	
	// cont_tv_digital
	// cont_internet
	// cont_adicional
	// cont_fecha_activacion
	// cont_valor_basico_mes	
	// cont_valor_total_mes	
	// cont_permanencia
	// cont_cargo_conexion
	// cont_valor_diferido
	// cont_fecha_ini_perm
	// cont_fecha_fin_perm	
	// cont_costo_reconexion
	// cont_fecha_transaccion
	// cont_sede_id	
	// cont_estado
	// cont_usuario_id

// NOMBRE DE LOS CAMPOS DE CONTRATO PRODUCTO
	// cont_prod_id 			int(11)	No				
	// cont_prod_contrato_id	int(11)	No		
	// cont_prod_producto_id	int(11)	No	
	// cont_prod_precio	
	// cont_prod_cantidad	
	// cont_prod_rango			int(11)	No				
	// cont_prod_usuario_id		int(11)	No				
	// cont_prod_estado			tinyint(4)		
	// cont_prod_fecha

// NOMBRES DE LOS INPUTS DEL HTMPL
// -------------------------
// |number  | 	per_id 		|
// |select  |	tipoPersona |
// |select  |	tipoCliente |
// |select  |	alianza 	|
// |select  |	tipoDoc 	|
// |number  |	numDoc 		|
// |text 	|	nombre 		|
// |text 	|	apellido 	| 
// |text 	|	tel1 		|
// |text 	|	tel2 		|
// |select  |	ciudad 		| 
// |text 	|	barrio 		|
// |select  |	tipoVivien 	|
// |text 	|	direccion 	|
// |text 	|	correoPer 	|
// -------------------------

//INPUTS DEL CONTRATO
	// cont_id 					number
	// cont_no_contrato			text
	// cont_persona_id			number
	// cont_direccion_serv		text
	// cont_estrato				select->sin BD
	// cont_minimo_mensual		select->sin BD
	// cont_vigencia_a_partir	date
	// cont_renovacion_auto		checkbox
	// cont_tv_analogica		checkbox
	// cont_tv_digital			checkbox
	// cont_internet			checkbox
	// cont_adicional			text
	// cont_fecha_activacion	date
	// cont_valor_basico_mes	number
	// cont_valor_total_mes		number
	// cont_permanencia			check
	// cont_cargo_conexion		number
	// cont_valor_diferido		number
	// cont_fecha_ini_perm		date
	// cont_fecha_fin_perm		date
	// cont_costo_reconexion	number
	// cont_fecha_transaccion	date
	// cont_usuario_id			hidden




// NOMBRE DE LA CLASE
// 		Contrato

// AJAX
// 		contrato 

// Incluir la conexion a BDs
require '../config/conexion.php';

Class Contrato {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de registro de contrato 
	// tambien registra el valor de la primera mensualidad en estado de cuenta
	public function insertar(

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
		$cont_prod_precio
			
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
		$concepto = 3;

		$sqlnvonumfac ="INSERT INTO numeracion_recibo_caja (
				num_fac_id,
				num_fac_sede_id
				)VALUES(
				null,
				'$cont_sede_id'
				)";
		$numfac = ejecutarConsulta_retornaID($sqlnvonumfac);
		
		$sqlestadocuenta = "INSERT INTO estado_cuenta_fin(
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
				est_cta_sede_id,
				est_cta_usuario_id
				)
				VALUES(
				null,
				'$id_persona',	
				'$id_contrato',
				'$numfac',
				'$comprobante',
				'$cont_vigencia_a_partir',
				'1',
				'$concepto',
				'$cont_minimo_mensual',
				'$cont_minimo_mensual',
				'$cont_sede_id',
				'$cont_usuario_id'
				)";

		ejecutarConsulta($sqlestadocuenta) or $sw = false;

		return $sw;
	}

	public function insertarsinpermanencia(
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
		$cont_prod_precio
			
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

		// Insercion de la primera mensualidad en la tabla estado de cueta
		$comprobante = $cont_no_contrato."-".$id_contrato;
		$concepto = 3;

		$sqlestadocuenta = "INSERT INTO estado_cuenta_fin(
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
				est_cta_sede_id,
				est_cta_usuario_id
				)
				VALUES(
				null,
				'$id_persona',	
				'$id_contrato',
				'$numfac',
				'$comprobante',
				'$cont_vigencia_a_partir',
				'1',
				'$concepto',
				'$cont_minimo_mensual',
				'$cont_minimo_mensual',
				'$cont_sede_id',
				'$cont_usuario_id'
				)";

		ejecutarConsulta($sqlestadocuenta) or $sw = false;

		
		// Insercion del valor de la conexion cuando no tiene permanencia 
		$concepto = 4;
		$saldoactual = $cont_cargo_conexion + $cont_minimo_mensual;



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
			'$id_persona',	
			'$id_contrato',
			'$numfac',
			'$comprobante',
			'$cont_vigencia_a_partir',
			'1',
			'$concepto',
			'$cont_cargo_conexion',
			'$saldoactual',
			'$cont_minimo_mensual',
			'$cont_sede_id',
			'$cont_usuario_id'
			)";

		ejecutarConsulta($sqlnopermanencia) or $sw = false;

		return $sw;
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

				WHERE cont_id = '$cont_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de desactivacion
	public function desactivar($cont_id){
		$sql = "UPDATE contrato 
				SET per_estado = '0'
				WHERE cont_id = '$cont_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo de activacion
	public function activar($cont_id){
		$sql = "UPDATE contrato 
				SET per_estado = '1'
				WHERE cont_id = '$cont_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($cont_id){
		$sql = "SELECT 
				p.per_ciudad_id,
				p.per_nombre,
				p.per_apellido,
				p.per_num_documento,
				p.per_telefono_1,
				p.per_correo_personal,
				p.per_direccion,
				ci.ciu_nombre,
				ci.ciu_departamento,
				co.cont_estrato,
				co.cont_direccion_serv,
				co.cont_minimo_mensual,
				co.cont_vigencia_a_partir,
				co.cont_renovacion_auto,
				co.cont_internet,
				co.cont_tv_analogica,
				co.cont_tv_digital,
				co.cont_adicional,
				co.cont_fecha_activacion,
				co.cont_valor_basico_mes,
				co.cont_valor_total_mes,
				co.cont_permanencia,
				co.cont_cargo_conexion,
				co.cont_valor_diferido,
				co.cont_fecha_ini_perm,
				co.cont_fecha_fin_perm,
				co.cont_costo_reconexion				
				FROM contrato co
				INNER JOIN persona p 
				ON co.cont_persona_id = p.per_id
				INNER JOIN ciudad ci
				ON p.per_ciudad_id = ci.ciu_id
				WHERE cont_id = '$cont_id'";

		return ejecutarConsulta($sql);
	}

	public function select(){
		$sql = "SELECT * FROM contrato 
				WHERE cont_estado = 1";

		return ejecutarConsulta($sql);
	}

	public function listar(){

		$sede = $_SESSION['usu_sede_id'];

		$sql = "SELECT
				c.cont_id,
				c.cont_no_contrato,
				c.cont_minimo_mensual,
				c.cont_direccion_serv,
				c.cont_estado_servicio_id,
				p.per_nombre ,
				p.per_apellido, 
				p.per_num_documento, 
				p.per_telefono_1 ,
				c.cont_vigencia_a_partir,
				c.cont_permanencia,
				c.cont_fecha_fin_perm,
				c.cont_estado,
				c.cont_fecha_transaccion
			FROM contrato c
			INNER JOIN persona p
			ON c.cont_persona_id = p.per_id	
			WHERE cont_sede_id = '$sede'
			";

		return ejecutarConsulta($sql);
	}

	public function productos($cont_id){
		
		$sql = "SELECT
				cp.cont_prod_id,
				p.prod_id,
				p.prod_nombre,
				cp.cont_prod_cantidad,
				p.prod_valor
				FROM contrato_producto cp
				INNER JOIN producto p 
				ON cp.cont_prod_producto_id = p.prod_id
				WHERE cont_prod_contrato_id = '$cont_id'
				";

		return ejecutarConsulta($sql);
	}
}
?>