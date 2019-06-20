<?php 
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
// est_cta_saldo_anterior	
// est_cta_saldo_actual
// est_cta_observacion	
// est_cta_usuario_id
// est_cta_estado

// Incluir la conexion a BDs
require '../config/conexion.php';

Class Recaudo {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Implementacion de metodo de registro sin prontopago
	public function insertar(
		$est_cta_id,
		$est_cta_persona_id,
		$est_cta_contrato_id,
		$est_cta_no_comprobante,
		$est_cta_fecha_comprobante,
		$est_cta_transaccion_id,
		$est_cta_concep_trans_id,
		$est_cta_debe,
		$est_cta_saldo_anterior,
		$est_cta_saldo_actual,
		$est_cta_observacion,	
		$est_cta_usuario_id
	){

		$sede = $_SESSION['usu_sede_id'];


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
				est_cta_fecha_comprobante,
				est_cta_transaccion_id,
				est_cta_concep_trans_id,
				est_cta_debe,
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
				'$est_cta_no_comprobante',
				'$est_cta_fecha_comprobante',
				'$est_cta_transaccion_id',
				'$est_cta_concep_trans_id',
				'$est_cta_debe',
				'$est_cta_saldo_anterior',
				'$est_cta_saldo_actual',
				'$est_cta_observacion',	
				'$sede',
				'$est_cta_usuario_id'
				)";

		return ejecutarConsulta($sql);

	}

	public function insertarprontopago(
		$est_cta_id,
		$est_cta_persona_id,
		$est_cta_contrato_id,
		$est_cta_no_comprobante,
		$est_cta_fecha_comprobante,
		$est_cta_transaccion_id,
		$est_cta_concep_trans_id,
		$prontopago,
		$est_cta_saldo_anterior,
		$est_cta_saldo_actual,
		$est_cta_observacion,	
		$est_cta_usuario_id
	){
		$sede = $_SESSION['usu_sede_id'];

		$sqlnvonumfac ="SELECT max(num_fac_id)
						AS num_fac_id
						FROM numeracion_recibo_caja";
		$numfac = ejecutarConsultaSimpleFila($sqlnvonumfac);
		$numfac = implode('', $numfac);

		$sqlprontopago = "INSERT INTO estado_cuenta_fin (
				est_cta_id,
				est_cta_persona_id,
				est_cta_contrato_id	,
				est_cta_no_transaccion,
				est_cta_no_comprobante,
				est_cta_fecha_comprobante,
				est_cta_transaccion_id,
				est_cta_concep_trans_id,
				est_cta_debe,
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
				'$est_cta_no_comprobante',
				'$est_cta_fecha_comprobante',
				'6',
				'10',
				'$prontopago',
				'$est_cta_saldo_anterior',
				'$est_cta_saldo_actual',
				'$est_cta_observacion',
				'$sede',	
				'$est_cta_usuario_id'
				)";

			return ejecutarConsulta($sqlprontopago);

	}

	// Implementacion de metodo de desactivacion
	public function anular($est_cta_id){
		$sql = "UPDATE estado_cuenta_fin 
				SET est_cta_estado = '0'
				WHERE est_cta_id = '$est_cta_id'";

		return ejecutarConsulta($sql);
	}

// TABLA contrato
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
// cont_estado
// cont_usuario_id	

// NOMBRE DE LOS INPUTS

// 	cont_id
// 	no_contrato
// 	suscriptor
// 	no_documento
// 	telefono
// 	estado_servicio 
// 	mensualidad
// 	servicio 

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($cont_id){
		$sql = "SELECT
				c.cont_id,
				c.cont_no_contrato,
				p.per_id,
				p.per_nombre,
				p.per_apellido,
				p.per_num_documento,
				p.per_telefono_1,
				p.per_direccion,
				p.per_barrio,
				c.cont_estado_servicio_id,
				c.cont_direccion_serv,
				c.cont_barrio,
				c.cont_minimo_mensual,
				c.cont_tv_analogica,
				c.cont_tv_digital,
				c.cont_internet,
				c.cont_max_dias_pago -- maintenance
				FROM contrato c
				INNER JOIN persona p 
				ON c.cont_persona_id = p.per_id
				WHERE cont_id = '$cont_id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Impementacion de metodo para listar registros

	public function listarcontrato(){

		$sede = $_SESSION['usu_sede_id'];

		if ($_SESSION['usu_alianza_id'] == 4) {
		
			$sql = "SELECT
					c.cont_id,
					c.cont_no_contrato,
					c.cont_estado,
					c.cont_direccion_serv,
					c.cont_estado_servicio_id,
					c.cont_valor_total_mes,
					p.per_id,
					p.per_nombre,
					p.per_apellido,
					p.per_num_documento,
					p.per_telefono_1,
					c.cont_internet,
					c.cont_tv_digital,
					c.cont_tv_analogica
				FROM contrato c 
				INNER JOIN persona p 
				ON c.cont_persona_id = p.per_id
				WHERE cont_estado = 1
				
				";

			return ejecutarConsulta($sql);

		}else{
			$alianza = $_SESSION['usu_alianza_id'];
				
				$sql = "SELECT
					c.cont_id,
					c.cont_no_contrato,
					c.cont_estado,
					c.cont_direccion_serv,
					c.cont_estado_servicio_id,
					c.cont_valor_total_mes,
					p.per_id,
					p.per_nombre,
					p.per_apellido,
					p.per_num_documento,
					p.per_telefono_1,
					c.cont_internet,
					c.cont_tv_digital,
					c.cont_tv_analogica
				FROM contrato c 
				INNER JOIN persona p 
				ON c.cont_persona_id = p.per_id
				WHERE cont_estado = 1
				AND cont_sede_id = '$sede'
				
				";

			return ejecutarConsulta($sql);

		}

	}

	public function saldos($cont_id){

		$sql = "SELECT * FROM estado_cuenta_fin
				WHERE est_cta_contrato_id = '$cont_id'
				AND est_cta_estado = 1
				ORDER BY est_cta_id DESC 
				LIMIT 1
				";
		return ejecutarConsultaSimpleFila($sql);
	}
	
	public function prontopago($cont_id){

		$sql = "SELECT SUM(p.prod_valor_pronto_pago) 
				AS prod_valor_pronto_pago
				FROM producto p 
				INNER JOIN contrato_producto cp
				ON cp.cont_prod_producto_id = p.prod_id
				WHERE cont_prod_contrato_id = '$cont_id'
				";
		return  ejecutarConsultaSimpleFila($sql);
	}

	public function listarestadocuenta($cont_id){
		$sql = "SELECT
				ec.est_cta_id,
				ec.est_cta_fecha_transacc,
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
			AND est_cta_estado = 1
			";
		return ejecutarConsulta($sql);
	}

	public function insertarntadebito(
		$est_cta_id,
		$est_cta_persona_id,
		$est_cta_contrato_id,
		$est_cta_no_comprobante,
		$est_cta_fecha_comprobante,
		$est_cta_transaccion_id,
		$est_cta_concep_trans_id,
		$est_cta_haber,
		$est_cta_saldo_anterior,
		$est_cta_saldo_actual,
		$est_cta_observacion,	
		$est_cta_usuario_id
	){
		// $sqlnvonumfac ="INSERT INTO numeracion_recibo_caja (num_fac_id)VALUES(null)";
		// $numfac = ejecutarConsulta_retornaID($sqlnvonumfac);
		$sede = $_SESSION['usu_sede_id'];

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
				est_cta_fecha_comprobante,
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
				'$est_cta_no_comprobante',
				'$est_cta_fecha_comprobante',
				'$est_cta_transaccion_id',
				'$est_cta_concep_trans_id',
				'$est_cta_haber',
				'$est_cta_saldo_anterior',
				'$est_cta_saldo_actual',
				'$est_cta_observacion',	
				'$sede',
				'$est_cta_usuario_id'
				)";

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
				AND ec.est_cta_estado = 1
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
				AND es.est_cta_estado = 1
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
				AND ec.est_cta_estado = 1
				";

		return ejecutarConsulta($sqlcuerpo);
	}

	public function ultimatransaccion($est_cta_no_transaccion){

		$sqlcuerpo = "SELECT * FROM estado_cuenta_fin
				WHERE est_cta_no_transaccion = '$est_cta_no_transaccion'
				AND est_cta_estado = 1
				ORDER BY est_cta_id DESC
				LIMIT 1
				";

		return ejecutarConsulta($sqlcuerpo);
	}

	public function ultimohaber($cont_id){

		$sql = "SELECT
				ec.est_cta_id,
				ec.est_cta_observacion,
				ct.con_tran_nombre,
				ec.est_cta_haber
				FROM estado_cuenta_fin ec
				INNER JOIN concepto_transaccion ct
				ON ec.est_cta_concep_trans_id = ct.con_tran_id
				WHERE est_cta_contrato_id = '$cont_id'
				AND ec.est_cta_transaccion_id = 1
				AND ec.est_cta_estado = 1
				ORDER BY est_cta_id DESC
				LIMIT 1
				";
		return ejecutarConsulta($sql);
	}

	public function nuevoestado(){

		$sql = "SELECT * FROM estado_servicio
				WHERE est_ser_area = 1";

		return ejecutarConsulta($sql);
	}

// Début de Maintenance
	public function cambioestadoproductos(){

		$sql = "SELECT * FROM estado_servicio
				WHERE est_ser_area = 3";

		return ejecutarConsulta($sql);
	}

	public function guardarnuevoestado ($estado, $cont_id, $usu_id, $observacion = null, $ot_id)
	{

		if($estado == 2)
		{
			$dias 	= 10;
		}
		elseif($estado == 9)
		{
			$dias 	= 10;
		}
		elseif($estado == 13)
		{
			$dias 	= 10;
		}
		else
		{
			$dias 	= 0;	
		}
		
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
				SET cont_estado_servicio_id = '$estado',
					cont_max_dias_pago 		= '$dias'
				WHERE cont_id = '$cont_id'"
				;

		return ejecutarConsulta($sql);
	}
	// Cambio de estado para el id de estado de cuenta
	public function ocultar_registro_tabla($est_cta_id) 
	{

        $sql = "UPDATE estado_cuenta_fin SET
        est_cta_estado= 0
        WHERE est_cta_id  =   '$est_cta_id'";

        return ejecutarConsulta($sql);
    }
// Fin de Maintenance





} 
?>