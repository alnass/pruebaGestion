<?php 
// # encodé par @Anderson Ferrucho 
// maintenance effectuee par Anderson Ferrucho

// Incluir la conexion a BDs
require '../config/conexion.php';

Class CobroAutomatico {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro sin prontopago
	public function listarestadocuenta($cont_id){
		$sql = "SELECT
				ec.est_cta_id,
				DATE_FORMAT(ec.est_cta_fecha_transacc, '%Y/%m/%d') as fecha,
				ec.est_cta_no_transaccion,
				ec.est_cta_no_comprobante,
				ec.est_cta_fecha_comprobante,
				ec.est_cta_observacion,
				ct.con_tran_nombre,
				ec.est_cta_haber,
				ec.est_cta_debe,
				ec.est_cta_saldo_anterior,
				ec.est_cta_saldo_actual		
			FROM estado_cuenta_fin ec 
			INNER JOIN concepto_transaccion ct
			ON ec.est_cta_concep_trans_id = ct.con_tran_id
			WHERE est_cta_contrato_id = '$cont_id'
			AND est_cta_transaccion_id = 1";
		return ejecutarConsulta($sql);
	}

	public function ultimoCobro($cont_id){
		$sql = "SELECT
				ec.est_cta_id,
				DATE_FORMAT(ec.est_cta_fecha_transacc, '%Y/%m/%d') as fecha,
				ec.est_cta_no_transaccion,
				ec.est_cta_no_comprobante,
				ec.est_cta_fecha_comprobante,
				ec.est_cta_observacion,
				ct.con_tran_nombre,
				ec.est_cta_haber,
				ec.est_cta_debe,
				ec.est_cta_saldo_anterior,
				ec.est_cta_saldo_actual		
			FROM estado_cuenta_fin ec 
			INNER JOIN concepto_transaccion ct
			ON ec.est_cta_concep_trans_id = ct.con_tran_id
			WHERE est_cta_contrato_id = '$cont_id'
			AND est_cta_transaccion_id = 1
			ORDER BY ec.est_cta_id DESC LIMIT 1";
		return ejecutarConsulta($sql);
	}

	public function insertarntadebito(
		$est_cta_persona_id,
		$est_cta_contrato_id,
		$est_cta_haber,
		$est_cta_saldo_anterior,
		$est_cta_saldo_actual,
		$est_cta_observacion
	){
		
		$sede 				= $_SESSION['usu_sede_id'];
		$est_cta_usuario_id = $_SESSION['usu_id'];

		$sqlnvonumfac ="INSERT INTO numeracion_recibo_caja (
				num_fac_id,
				num_fac_sede_id 
				)
				VALUES(
				null,
				'$sede'
				)";
		$numfac = ejecutarConsulta_retornaID($sqlnvonumfac);

		$sql = "INSERT INTO estado_cuenta_fin (
				est_cta_id,
				est_cta_persona_id,
				est_cta_contrato_id	,
				est_cta_no_transaccion,
				est_cta_no_comprobante,
				est_cta_transaccion_id,
				est_cta_concep_trans_id,
				est_cta_haber,
				est_cta_saldo_anterior,
				est_cta_saldo_actual,
				est_cta_observacion,
				est_cta_sede_id,
				est_cta_usuario_id
				)
			VALUES(
				null,
				'$est_cta_persona_id',
				'$est_cta_contrato_id',
				'$numfac',
				0,
				1,
				1,
				'$est_cta_haber',
				'$est_cta_saldo_anterior',
				'$est_cta_saldo_actual',
				'$est_cta_observacion',	
				'$sede',
				'$est_cta_usuario_id')";

		return ejecutarConsulta($sql);
	}

	public function cabeceraticket(){

		$sede = $_SESSION['usu_sede_id'];

		$sqlnum = "SELECT max(num_fac_id)
				AS num_fac_id
				FROM numeracion_recibo_caja
				WHERE num_fac_sede_id = '$sede'
				";

		$num = ejecutarConsultaSimpleFila($sqlnum);
		$num = implode("", $num);

		$sqlcabecera = "SELECT
				c.cont_id,
				c.cont_no_contrato,
				c.cont_estado_servicio_id,
				p.per_nombre,
				p.per_apellido,
				p.per_num_documento,
				ec.est_cta_fecha_transacc,
				ec.est_cta_no_transaccion,
				ec.est_cta_saldo_actual,
				ec.est_cta_id
				FROM estado_cuenta_fin ec
				INNER JOIN contrato c
				ON ec.est_cta_contrato_id = c.cont_id
				INNER JOIN persona p
				ON ec.est_cta_persona_id = p.per_id
				WHERE est_cta_no_transaccion = '$num'
				";

		return ejecutarConsulta($sqlcabecera);
	}

	public function copiacabeceraticket($num_trans){

		$sqlcabecera = "SELECT
				c.cont_id,
				c.cont_no_contrato,
				p.per_nombre,
				p.per_apellido,
				p.per_num_documento,
				ec.est_cta_fecha_transacc,
				ec.est_cta_no_transaccion,
				ec.est_cta_saldo_actual,
				ec.est_cta_id
				FROM estado_cuenta_fin ec
				INNER JOIN contrato c
				ON ec.est_cta_contrato_id = c.cont_id
				INNER JOIN persona p
				ON ec.est_cta_persona_id = p.per_id
				WHERE est_cta_no_transaccion = '$num_trans'
				";

		return ejecutarConsulta($sqlcabecera);
	}


	public function cuerpoticket($est_cta_no_transaccion){

		$sqlcuerpo = "SELECT
				ec.est_cta_debe,
				ec.est_cta_haber,
				ec.est_cta_observacion,
				ct.con_tran_nombre
				FROM estado_cuenta_fin ec
				INNER JOIN concepto_transaccion ct
				ON ec.est_cta_concep_trans_id = ct.con_tran_id
				WHERE est_cta_no_transaccion = '$est_cta_no_transaccion'
				";

		return ejecutarConsulta($sqlcuerpo);
	}

	public function ultimatransaccion($est_cta_no_transaccion){

		$sqlcuerpo = "SELECT * FROM estado_cuenta_fin
				WHERE est_cta_no_transaccion = '$est_cta_no_transaccion'
				ORDER BY est_cta_id DESC
				LIMIT 1
				";

		return ejecutarConsulta($sqlcuerpo);
	}

	public function ultimohaber($cont_id){

		$sql = "SELECT
				ec.est_cta_id,
				ec.est_cta_observacion,
				ct.con_tran_nombre
				FROM estado_cuenta_fin ec
				INNER JOIN concepto_transaccion ct
				ON ec.est_cta_concep_trans_id = ct.con_tran_id
				WHERE est_cta_contrato_id = '$cont_id'
				ORDER BY est_cta_haber DESC
				LIMIT 1
				";
		return ejecutarConsulta($sql);
	}

	public function nuevoestado(){

		$sql = "SELECT * FROM estado_servicio
				WHERE est_ser_area = 1";

		return ejecutarConsulta($sql);
	}

	public function guardarnuevoestado ($estado, $cont_id, $usu_id, $observacion = null, $ot_id){

		$sqlcambio = "INSERT INTO cc_estado_servicio(
				cc_est_ser_id,
				cc_est_ser_contrato_id,
				cc_est_ser_usuario_id,
				cc_est_ser_estado_id,
				cc_est_ser_observacion,
				cc_est_ser_ot_id
				)VALUES(
				null,
				'$cont_id',
				'$usu_id',
				'$estado',
				'$observacion',
				'$ot_id'
				)";

		ejecutarConsulta($sqlcambio);

		$sql = "UPDATE contrato
				SET cont_estado_servicio_id = '$estado'
				WHERE cont_id = '$cont_id'"
				;

		return ejecutarConsulta($sql);
	}

	public function cargarCobro ($cont_id, $usu_id, $observacion = null, $ot_id){

		$sqlcambio = "INSERT INTO cc_estado_servicio(
				cc_est_ser_id,
				cc_est_ser_contrato_id,
				cc_est_ser_usuario_id,
				cc_est_ser_estado_id,
				cc_est_ser_observacion,
				cc_est_ser_ot_id
				)VALUES(
				null,
				'$cont_id',
				'$usu_id',
				'$estado',
				'$observacion',
				'$ot_id'
				)";

		ejecutarConsulta($sqlcambio);

		$sql = "UPDATE contrato
				SET cont_estado_servicio_id = '$estado'
				WHERE cont_id = '$cont_id'"
				;

		return ejecutarConsulta($sql);
	}

public function listarporSede($sede_id){
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
				co.cont_id,
				co.cont_no_contrato,
				co.cont_estrato,
				co.cont_direccion_serv,
				co.cont_barrio,
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
				co.cont_costo_reconexion,
				co.cont_estado_servicio_id,
				es.est_serv_nombre,
				s.sed_direccion,
				s.sed_telefono_2	
				FROM contrato co
				INNER JOIN persona p 
				ON co.cont_persona_id = p.per_id
				INNER JOIN ciudad ci
				ON p.per_ciudad_id = ci.ciu_id
				INNER JOIN estado_servicio es
				ON es.est_serv_id = co.cont_estado_servicio_id
				INNER JOIN sede s
				ON s.sed_id = co.cont_sede_id
				WHERE co.cont_sede_id = '$sede_id'
				AND co.cont_estado_servicio_id = 2
				AND p.per_tipo_persona_id = 1";

		return ejecutarConsulta($sql);
	}

	public function listarporSedePar($sede_id){
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
				co.cont_id,
				co.cont_no_contrato,
				co.cont_estrato,
				co.cont_direccion_serv,
				co.cont_barrio,
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
				co.cont_costo_reconexion,
				co.cont_estado_servicio_id,
				es.est_serv_nombre,
				s.sed_direccion,
				s.sed_telefono_2	
				FROM contrato co
				INNER JOIN persona p 
				ON co.cont_persona_id = p.per_id
				INNER JOIN ciudad ci
				ON p.per_ciudad_id = ci.ciu_id
				INNER JOIN estado_servicio es
				ON es.est_serv_id = co.cont_estado_servicio_id
				INNER JOIN sede s
				ON s.sed_id = co.cont_sede_id
				WHERE co.cont_sede_id = '$sede_id'
				AND co.cont_estado_servicio_id = 2
				AND mod(co.cont_id,2)=1";

		return ejecutarConsulta($sql);
	}

	public function listarporSedeImpar($sede_id){
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
				co.cont_id,
				co.cont_no_contrato,
				co.cont_estrato,
				co.cont_direccion_serv,
				co.cont_barrio,
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
				co.cont_costo_reconexion,
				co.cont_estado_servicio_id,
				es.est_serv_nombre,
				s.sed_direccion,
				s.sed_telefono_2	
				FROM contrato co
				INNER JOIN persona p 
				ON co.cont_persona_id = p.per_id
				INNER JOIN ciudad ci
				ON p.per_ciudad_id = ci.ciu_id
				INNER JOIN estado_servicio es
				ON es.est_serv_id = co.cont_estado_servicio_id
				INNER JOIN sede s
				ON s.sed_id = co.cont_sede_id
				WHERE co.cont_sede_id = '$sede_id'
				AND co.cont_estado_servicio_id = 2
				AND mod(cont_id,2)=0";

		return ejecutarConsulta($sql);
	}

	
} 
?>