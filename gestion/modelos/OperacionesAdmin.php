<?php 

// # maintenance par @Anderson Ferrucho 
require '../config/conexion.php';
// Esta clase maneja todas la operaciones realizadas desde el modulo de operraciones administrativas
Class OperacionesAdmin{

	public function __construct(){

	}

	public function listarsede(){

				
		$sql = "SELECT MAX(cie_fin_id)
				AS cierre
				FROM cierre_final
				GROUP BY cie_fin_sede_id
				";		

		return ejecutarConsulta($sql);
	}

	public function activarrecaudo($cierre_id){

		$sql = "UPDATE cierre_final 
			SET cie_fin_estado = '1'
			WHERE cie_fin_id = '$cierre_id'
			";

		return ejecutarConsulta($sql);

	}

	public function desactivarrecaudo($cierre_id){

		$sql = "UPDATE cierre_final 
			SET cie_fin_estado = '0'
			WHERE cie_fin_id = '$cierre_id'
			";

		return ejecutarConsulta($sql);

	}

	public function facturar($mes, $anio){

		
		$sw = "";

		$sql = "SELECT c.cont_id,
			c.cont_persona_id,
			c.cont_estado_servicio_id,
			c.cont_valor_total_mes,
			c.cont_sede_id,
			es.est_serv_cobro,
			es.est_serv_id,
			p.per_tipo_persona_id
			FROM contrato c 
			INNER JOIN estado_servicio es 
			ON es.est_serv_id = c.cont_estado_servicio_id
			INNER JOIN persona p 
			ON c.cont_persona_id = p.per_id
			WHERE es.est_serv_cobro = '1'
			AND p.per_tipo_persona_id = 1";

		$resut = ejecutarConsulta($sql) or $sw = 'Select';
		
		while ($res = $resut->fetch_object()) {

			$suscriptor_id = $res->cont_persona_id;
			$contrato_id = $res->cont_id;
			$mensuelidad = $res->cont_valor_total_mes;
			$transaccion_id = "1";
			$concepto_trans = "1";
			$sede = $res->cont_sede_id;
			$usuario = $_SESSION['usu_id'];
			$observacion = $mes." ".$anio;
						
			$sqltransaccion = "INSERT INTO numeracion_recibo_caja(
				num_fac_id,
				num_fac_sede_id
				)VALUES(
				null,
				'$sede'
				)";

			$notransaccion = ejecutarConsulta_retornaID($sqltransaccion) or $sw = 'Numeracion de recibos';

			$sqlsaldos = "SELECT * FROM estado_cuenta_fin
						WHERE est_cta_contrato_id = '$contrato_id'
						ORDER BY est_cta_id DESC 
						LIMIT 1
						";
			$saldos = ejecutarConsulta($sqlsaldos) or $sw = 'Select de estado de cuenta';
			$sal = $saldos->fetch_object();
			$saldoianterior = $sal->est_cta_saldo_anterior;
			$saldoactual = $sal->est_cta_saldo_actual;

			$saldofinal = $saldoactual+$mensuelidad;
			
			$sqlregistro = "INSERT INTO estado_cuenta_fin(
				est_cta_id,
				est_cta_persona_id,
				est_cta_contrato_id,
				est_cta_no_transaccion,
				est_cta_transaccion_id,
				est_cta_concep_trans_id,
				est_cta_haber,
				est_cta_saldo_anterior,
				est_cta_saldo_actual,
				est_cta_observacion,
				est_cta_sede_id,
				est_cta_usuario_id
				)VALUES(
				null,
				'$suscriptor_id',
				'$contrato_id',
				'$notransaccion',
				'$transaccion_id',
				'$concepto_trans',
				'$mensuelidad',
				'$saldoactual',
				'$saldofinal',
				'$observacion',
				'$sede',
				'$usuario'
				)";

			// début maintenance 

			$no_est_cta 		= 	ejecutarConsulta_retornaID($sqlregistro);

			$impr_ctas_cobro 	=  	"INSERT INTO impresion_cuentas(
				imp_ctas_id,
				imp_ctas_est_cta_id,
				imp_ctas_sede_id)
				VALUES(
				null,
				'$no_est_cta',
				'$sede')";

				ejecutarConsulta($impr_ctas_cobro) or $sw = "Registro";


			// fin maintenance
		}
		
	}

	public function control_impr_cuentas($estado, $usuario)
	{
		$cntrl_ctas_cobro 	=  	"INSERT INTO cntrl_imp_cuentas(
				cntrl_imp_cuentas_id,
				cntrl_imp_cuentas_usu_id,
				cntrl_imp_cuentas_estado)
				VALUES(
				null,
				'$usuario',
				$estado)";

				ejecutarConsulta($cntrl_ctas_cobro);	
	}

	public function se_listar(){
		$sql = "SELECT es.cc_est_ser_id,
			es.cc_est_ser_contrato_id,
			es.cc_est_ser_usuario_id,
			es.cc_est_ser_estado_id,
			es.cc_est_ser_fecha,
			u.usu_nombre,
			u.usu_apellido,
			c.cont_id,
			c.cont_no_contrato,
			c.cont_persona_id,
			p.per_id,
			p.per_nombre,
			p.per_apellido,
			p.per_num_documento
			FROM cc_estado_servicio es 
			INNER JOIN usuario_log u 
			ON es.cc_est_ser_usuario_id = u.usu_id
			INNER JOIN contrato c 
			ON c.cont_id = es.cc_est_ser_contrato_id
			INNER JOIN persona p
			ON p.per_id = c.cont_persona_id
			";

			return ejecutarConsulta($sql);

	}

	public function listarpostcierre($fecha_inicio, $fecha_fin){

		$sql = "SELECT cc.cc_est_ser_id,
			cc.cc_est_ser_contrato_id,
			cc.cc_est_ser_estado_id,		
			DATE(cc.cc_est_ser_fecha)
			AS cc_est_ser_fecha,
			c.cont_id,
			c.cont_no_contrato,
			c.cont_persona_id,
			c.cont_estado_servicio_id,
			c.cont_valor_total_mes,
			p.per_id,
			p.per_nombre,
			p.per_apellido,
			p.per_num_documento
			FROM cc_estado_servicio cc 
			INNER JOIN contrato c 
			ON cc.cc_est_ser_contrato_id = c.cont_id
			INNER JOIN persona p 
			ON c.cont_persona_id = p.per_id
			WHERE DATE(cc_est_ser_fecha)>= '$fecha_inicio'
			AND DATE(cc_est_ser_fecha)<= '$fecha_fin'
			AND c.cont_estado_servicio_id = 2
			
			
		";

		return ejecutarConsulta($sql);
	}

	public function listarcontrato(){

		$sede = $_SESSION['usu_sede_id'];

		if ($_SESSION['usu_alianza_id'] == 4){
			$sql = "SELECT
					c.cont_id,
					c.cont_no_contrato,
					c.cont_minimo_mensual,
					c.cont_direccion_serv,
					c.cont_estado_servicio_id,
					c.cont_max_dias_pago,
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
				WHERE c.cont_estado = 1
				";
		}else{
			
			$sql = "SELECT
					c.cont_id,
					c.cont_no_contrato,
					c.cont_minimo_mensual,
					c.cont_direccion_serv,
					c.cont_estado_servicio_id,
					c.cont_max_dias_pago,
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
				AND c.cont_estado = 1
				";

		}

		return ejecutarConsulta($sql);
	}

	public function cambifechappindividual($dia, $cont_id){

		$sql ="UPDATE contrato 
			SET cont_max_dias_pago = '$dia' 
			WHERE cont_id = '$cont_id'";

		return ejecutarConsulta($sql);
	}

	public function ultimohaber($cont_id){

		$sql = "SELECT
				est_cta_observacion
				FROM estado_cuenta_fin
				WHERE est_cta_haber > 0
				AND est_cta_contrato_id = '$cont_id'
				ORDER BY est_cta_id desc 
				LIMIT 1
				";
		return ejecutarConsultaSimpleFila($sql);
	}
	

}

?>