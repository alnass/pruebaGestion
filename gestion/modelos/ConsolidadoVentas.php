<?php  
// maintenance effectuee par Anderson Ferrucho
require "../config/conexion.php";

class ConsolidadoVentas
{
	
	function __construct()
	{
		# code...
	}

	public function traerMes(){
		$sql = "SELECT MONTH(est_cta_fecha_transacc)
			AS fecha
			FROM estado_cuenta_fin
			GROUP BY fecha";

		return ejecutarConsulta($sql);
	}

	public function traerSedes(){
		$sql = "SELECT sed_id, sed_nombre 
			FROM sede";

		return ejecutarConsulta($sql);
	}

	public function traerAnios(){
		$sql = "SELECT YEAR(est_cta_fecha_transacc)
			AS fecha
			FROM estado_cuenta_fin
			GROUP BY fecha";

		return ejecutarConsulta($sql);
	}

	public function facturadoAliadosCorpDetalle($mes, $anio, $sede)
	{

		$sql = "SELECT 	ec.est_cta_haber,
                  		ec.est_cta_contrato_id,
						ec.est_cta_transaccion_id,
						t.tran_id,
						t.tran_ingreso,
						p.per_tipo_persona_id
				FROM estado_cuenta_fin ec
				INNER JOIN persona p
				ON ec.est_cta_persona_id = p.per_id
				INNER JOIN transaccion t
				ON ec.est_cta_transaccion_id = t.tran_id
				WHERE ec.est_cta_concep_trans_id = 1
				AND MONTH(est_cta_fecha_transacc) = '$mes'
		        AND YEAR(est_cta_fecha_transacc) = '$anio'
				AND est_cta_sede_id = '$sede'
				AND p.per_tipo_persona_id = 1
				AND p.per_tipo_cliente_id = 3";

			return ejecutarConsulta($sql);
	}

	public function facturadoAliados($mes, $anio)
	{
		$sql = "SELECT SUM(ec.est_cta_haber)
						AS sumatoria,
                  		COUNT(ec.est_cta_contrato_id)
                        AS total_reg,
						ec.est_cta_transaccion_id,
						t.tran_id,
						t.tran_ingreso,
						p.per_tipo_persona_id
				FROM estado_cuenta_fin ec
				INNER JOIN persona p
				ON ec.est_cta_persona_id = p.per_id
				INNER JOIN transaccion t
				ON ec.est_cta_transaccion_id = t.tran_id
				WHERE ec.est_cta_concep_trans_id = 1
				AND MONTH(est_cta_fecha_transacc) = '$mes'
		        AND YEAR(est_cta_fecha_transacc) = '$anio'
				AND est_cta_sede_id = 14
				AND p.per_tipo_cliente_id = 3";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function facturadoCorporativo($mes, $anio)
	{
		$sql = "SELECT SUM(ec.est_cta_haber)
						AS sumatoria,
                  		COUNT(ec.est_cta_contrato_id)
                        AS total_reg,
						ec.est_cta_transaccion_id,
						t.tran_id,
						t.tran_ingreso,
						p.per_tipo_persona_id
				FROM estado_cuenta_fin ec
				INNER JOIN persona p
				ON ec.est_cta_persona_id = p.per_id
				INNER JOIN transaccion t
				ON ec.est_cta_transaccion_id = t.tran_id
				WHERE ec.est_cta_concep_trans_id = 1
				AND MONTH(est_cta_fecha_transacc) = '$mes'
		        AND YEAR(est_cta_fecha_transacc) = '$anio'
				AND est_cta_sede_id = 11
				AND p.per_tipo_persona_id = 2";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function facturacionGeneralDetalle($mes, $anio, $sede)
	{
			$sql = "SELECT ec.est_cta_haber,
						ec.est_cta_contrato_id,
						ec.est_cta_transaccion_id,
						t.tran_id,
						t.tran_ingreso,
						p.per_tipo_persona_id
				FROM estado_cuenta_fin ec
				INNER JOIN persona p
				ON ec.est_cta_persona_id = p.per_id
				INNER JOIN transaccion t
				ON ec.est_cta_transaccion_id = t.tran_id
				WHERE t.tran_id = 1
				AND MONTH(est_cta_fecha_transacc) = '$mes'
		        AND YEAR(est_cta_fecha_transacc) = '$anio'
				AND est_cta_sede_id = '$sede'
				AND p.per_tipo_persona_id = 1
				AND p.per_tipo_cliente_id = 1";

			return ejecutarConsulta($sql);
	}

	public function facturacionGeneral($mes, $anio, $sede)
	{
			$sql = "SELECT SUM(ec.est_cta_haber)
						AS sumatoria,
						COUNT(ec.est_cta_contrato_id)
                        AS total_reg,
						ec.est_cta_transaccion_id,
						t.tran_id,
						t.tran_ingreso,
						p.per_tipo_persona_id
				FROM estado_cuenta_fin ec
				INNER JOIN persona p
				ON ec.est_cta_persona_id = p.per_id
				INNER JOIN transaccion t
				ON ec.est_cta_transaccion_id = t.tran_id
				WHERE t.tran_id = 1
				AND MONTH(est_cta_fecha_transacc) = '$mes'
		        AND YEAR(est_cta_fecha_transacc) = '$anio'
				AND est_cta_sede_id = '$sede'
				AND p.per_tipo_persona_id = 1
				AND p.per_tipo_cliente_id = 1";

			return ejecutarConsultaSimpleFila($sql);
	}



	public function facturadoMes($mes, $anio, $sede)
	{

		$sql = "SELECT SUM(ec.est_cta_haber)
						AS sumatoria,
						COUNT(ec.est_cta_contrato_id)
						AS cuenta_contrato,
						ec.est_cta_transaccion_id,
						t.tran_id,
						t.tran_ingreso,
						p.per_tipo_persona_id
				FROM estado_cuenta_fin ec
				INNER JOIN persona p
				ON ec.est_cta_persona_id = p.per_id
				INNER JOIN transaccion t
				ON ec.est_cta_transaccion_id = t.tran_id
				WHERE ec.est_cta_concep_trans_id = 1
				AND MONTH(est_cta_fecha_transacc) = '$mes'
		        AND YEAR(est_cta_fecha_transacc) = '$anio'
				AND est_cta_sede_id = '$sede'
				AND p.per_tipo_persona_id = 1
				AND p.per_tipo_cliente_id = 1";

		return ejecutarConsultaSimpleFila($sql);
	}


	public function conBogota($mes){
		$sql = "SELECT SUM(ec.est_cta_debe)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_ingreso = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 3
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance


		return ejecutarConsultaSimpleFila($sql);
	}

	public function recaudoSede($mes, $sede){
		$sql = "SELECT SUM(ec.est_cta_debe)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_ingreso = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = '$sede'
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance


		return ejecutarConsultaSimpleFila($sql);
	}

	public function cobroSede($mes, $sede){
		$sql = "SELECT SUM(ec.est_cta_haber)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_id = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = '$sede'
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance


		return ejecutarConsultaSimpleFila($sql);
	}

	public function mensualidadBogota($mes){
		$sql = "SELECT SUM(ec.est_cta_haber)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_id = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 3
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance


		return ejecutarConsultaSimpleFila($sql);
	}

	public function conPaipa($mes){
		$sql = "SELECT SUM(ec.est_cta_debe)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_ingreso = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 9
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance
			
		return ejecutarConsultaSimpleFila($sql);
	}
	
	public function mensualidadPaipa($mes){
		$sql = "SELECT SUM(ec.est_cta_haber)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_id = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 9
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance


		return ejecutarConsultaSimpleFila($sql);
	}

	public function conFira($mes){
		$sql = "SELECT SUM(ec.est_cta_debe)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_ingreso = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 8
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance

		return ejecutarConsultaSimpleFila($sql);
	}

	public function mensualidadFira($mes){
		$sql = "SELECT SUM(ec.est_cta_haber)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_id = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 8
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance


		return ejecutarConsultaSimpleFila($sql);
	}
	public function conTibasosa($mes){
		$sql = "SELECT SUM(ec.est_cta_debe)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_ingreso = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 6
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance

		return ejecutarConsultaSimpleFila($sql);
	}
	public function mensualidadTibasosa($mes){
		$sql = "SELECT SUM(ec.est_cta_haber)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_id = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 6
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance


		return ejecutarConsultaSimpleFila($sql);
	}

	public function conIza($mes){
		$sql = "SELECT SUM(ec.est_cta_debe)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_ingreso = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 10
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance

		return ejecutarConsultaSimpleFila($sql);
	}

	public function mensualidadIza($mes){
		$sql = "SELECT SUM(ec.est_cta_haber)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_id = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 10
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance


		return ejecutarConsultaSimpleFila($sql);
	}

	public function conFomeque($mes){
		$sql = "SELECT SUM(ec.est_cta_debe)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_ingreso = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 4
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance

		return ejecutarConsultaSimpleFila($sql);
	}

	public function mensualidadFomeque($mes){
		$sql = "SELECT SUM(ec.est_cta_haber)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_id = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 4
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance


		return ejecutarConsultaSimpleFila($sql);
	}
	public function conSnAntonio($mes){
		$sql = "SELECT SUM(ec.est_cta_debe)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_ingreso = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 5
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance

		return ejecutarConsultaSimpleFila($sql);
	}

	public function mensualidadSAntonio($mes){
		$sql = "SELECT SUM(ec.est_cta_haber)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_id = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 5
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance


		return ejecutarConsultaSimpleFila($sql);
	}
// Début maintenance
	public function conMadrid($mes){
		$sql = "SELECT SUM(ec.est_cta_debe)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_ingreso = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = 7
			AND p.per_tipo_persona_id = 1
			AND p.per_tipo_cliente_id = 1";// maintenance

		return ejecutarConsultaSimpleFila($sql);
	}
	public function conCorp($mes){
		$sql = "SELECT SUM(ec.est_cta_debe)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_ingreso = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND p.per_tipo_persona_id = 2
			AND p.per_tipo_cliente_id = 1";// maintenance

		return ejecutarConsultaSimpleFila($sql);
	}

	public function conCorpAlcaldia($mes){
		$sql = "SELECT SUM(ec.est_cta_debe)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_ingreso = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND p.per_tipo_persona_id = 2
			AND p.per_tipo_cliente_id = 2";// maintenance

		return ejecutarConsultaSimpleFila($sql);
	}

	public function total($mes){
		$sql = "SELECT SUM(ec.est_cta_debe)
				AS sumatoria,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_ingreso = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'";// maintenance

		return ejecutarConsultaSimpleFila($sql);
	}

	public function listarcontrato($cont_id){

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
				WHERE cont_id = '$cont_id'";

			return ejecutarConsulta($sql);

		}

	public function estadoCuentaContrato($mes)
	{
		$sql ="SELECT ec.est_cta_id,
				ec.est_cta_contrato_id, 
				ec.est_cta_debe,
				ec.est_cta_transaccion_id,
				ec.est_cta_sede_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id,
				ec.est_cta_fecha_transacc
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE ec.est_cta_transaccion_id = 2
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND YEAR(est_cta_fecha_transacc) = 2019
			AND p.per_tipo_persona_id = 1
			OR ec.est_cta_transaccion_id = 3
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND YEAR(est_cta_fecha_transacc) = 2019
			AND p.per_tipo_persona_id = 1
			OR ec.est_cta_transaccion_id = 4
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND YEAR(est_cta_fecha_transacc) = 2019
			AND p.per_tipo_persona_id = 1";

			return ejecutarConsulta($sql);
	}

	public function estadoCuentaFactura($mes)
	{
		$sql ="SELECT ec.est_cta_contrato_id, 
				ec.est_cta_haber,
				ec.est_cta_transaccion_id,
				ec.est_cta_sede_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE ec.est_cta_transaccion_id = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND YEAR(est_cta_fecha_transacc) = 2019
			AND p.per_tipo_persona_id = 1";

			return ejecutarConsulta($sql);
	}

	public function estadoCuentaContratoCorp($mes)
	{
		$sql ="SELECT ec.est_cta_id,
				ec.est_cta_contrato_id, 
				ec.est_cta_debe,
				ec.est_cta_transaccion_id,
				ec.est_cta_sede_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id,
				ec.est_cta_fecha_transacc
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE ec.est_cta_transaccion_id = 2
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND YEAR(est_cta_fecha_transacc) = 2019
			AND p.per_tipo_persona_id = 2
			OR ec.est_cta_transaccion_id = 3
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND YEAR(est_cta_fecha_transacc) = 2019
			AND p.per_tipo_persona_id = 2
			OR ec.est_cta_transaccion_id = 4
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND YEAR(est_cta_fecha_transacc) = 2019
			AND p.per_tipo_persona_id = 2";

			return ejecutarConsulta($sql);
	}

	public function estadoCuentaFacturaCorp($mes)
	{
		$sql ="SELECT ec.est_cta_contrato_id, 
				ec.est_cta_haber,
				ec.est_cta_transaccion_id,
				ec.est_cta_sede_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id,
				ec.est_cta_transaccion_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE ec.est_cta_concep_trans_id = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND YEAR(est_cta_fecha_transacc) = 2019
			AND p.per_tipo_persona_id = 2";

			return ejecutarConsulta($sql);
	}
	public function estadoCuentaAliado($mes)
	{
		$sql ="SELECT ec.est_cta_id,
				ec.est_cta_contrato_id, 
				ec.est_cta_debe,
				ec.est_cta_transaccion_id,
				ec.est_cta_sede_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id,
				ec.est_cta_fecha_transacc
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE ec.est_cta_transaccion_id = 2
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND YEAR(est_cta_fecha_transacc) = 2019
			AND p.per_tipo_cliente_id = 3
			OR ec.est_cta_transaccion_id = 3
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND YEAR(est_cta_fecha_transacc) = 2019
			AND p.per_tipo_cliente_id = 3
			OR ec.est_cta_transaccion_id = 4
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND YEAR(est_cta_fecha_transacc) = 2019
			AND p.per_tipo_cliente_id = 3";

			return ejecutarConsulta($sql);
	}	


	public function estadoCuentaFacturaAliado($mes)
	{
		$sql ="SELECT ec.est_cta_contrato_id, 
				ec.est_cta_haber,
				ec.est_cta_transaccion_id,
				ec.est_cta_sede_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE ec.est_cta_concep_trans_id = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND YEAR(est_cta_fecha_transacc) = 2019
			AND p.per_tipo_cliente_id = 3";

			return ejecutarConsulta($sql);
	}

	public function estadoCuentaContratoPorSede($mes, $sede)
	{
		$sql ="SELECT ec.est_cta_contrato_id, 
				ec.est_cta_debe,
				ec.est_cta_transaccion_id,
				t.tran_id,
				t.tran_ingreso,
				p.per_tipo_persona_id
			FROM estado_cuenta_fin ec
			INNER JOIN persona p
			ON ec.est_cta_persona_id = p.per_id
			INNER JOIN transaccion t
			ON ec.est_cta_transaccion_id = t.tran_id
			WHERE t.tran_ingreso = 1
			AND MONTH(est_cta_fecha_transacc) = '$mes'
			AND est_cta_sede_id = '$sede'";

			return ejecutarConsulta($sql);
	}


	public function validarProductoTv($cont_id)
	{
		$sql ="	SELECT 	p.prod_prefijo,
						p.prod_valor_pronto_pago,
						cp.cont_prod_precio,
						cp.cont_prod_cantidad,
						c.cont_id
				FROM 	contrato c
				INNER JOIN 	contrato_producto cp
				ON cp.cont_prod_contrato_id = '$cont_id'
                INNER JOIN 	producto p
				ON p.prod_id = cp.cont_prod_producto_id
                WHERE c.cont_id = '$cont_id'
                AND p.prod_prefijo = 'TVA'
                AND cp.cont_prod_estado = 1";

            return ejecutarConsulta($sql);
	}

	public function validarProductoTvDG($cont_id)
	{
		$sql ="	SELECT 	p.prod_prefijo,
						p.prod_valor_pronto_pago,
						cp.cont_prod_precio,
						cp.cont_prod_cantidad,
						c.cont_id
				FROM 	contrato c
				INNER JOIN 	contrato_producto cp
				ON cp.cont_prod_contrato_id = '$cont_id'
                INNER JOIN 	producto p
				ON p.prod_id = cp.cont_prod_producto_id
                WHERE c.cont_id = '$cont_id'
                AND p.prod_prefijo = 'TVD'
                AND cp.cont_prod_estado = 1";

            return ejecutarConsulta($sql);
	}

	public function validarProductoOtro($cont_id)
	{
		$sql ="	SELECT 	p.prod_prefijo,
						p.prod_valor_pronto_pago,
						cp.cont_prod_precio,
						cp.cont_prod_cantidad,
						c.cont_id
				FROM 	contrato c
				INNER JOIN 	contrato_producto cp
				ON cp.cont_prod_contrato_id = '$cont_id'
                INNER JOIN 	producto p
				ON p.prod_id = cp.cont_prod_producto_id
                WHERE c.cont_id = '$cont_id'
                AND p.prod_prefijo = 'ARR-FBR'
                OR p.prod_prefijo = 'ADM'
                AND cp.cont_prod_estado = 1";

            return ejecutarConsulta($sql);
	}

	public function validarSede()
	{
		$sql ="SELECT * FROM sede";

            return ejecutarConsulta($sql);
	}

// Fin maintenance
}

?>