<?php 

require '../config/conexion.php';

Class AnulacionRegistro {

	// Implimentacion de constructor
	public function __construct(){

	}

	// control de cambios registro anulado
	public function insertar(
		$nombre_tabla,
		$reg_anulado,
		$reg_anul_concpto,
	){

		$usu_id = $_SESSION['usu_id'];

		$sql =	" INSERT INTO registros_anulados (
				reg_anul_tabla,
				reg_anul_id_anulado,
				reg_anul_id_usu_anula,
				reg_anul_concepto
				)
				VALUES(
				null,
				'$nombre_tabla',
				'$reg_anulado',
				'$reg_anul_concpto')";

		return ejecutarConsulta($sql);

	}

	// Implementacion de metodo de desactivacion
	public function anularRegistroEstadoCuenta($est_cta_id)
	{
		$sql = "UPDATE estado_cuenta_fin 
				SET est_cta_estado = '0'
				WHERE est_cta_id = '$est_cta_id'";

		return ejecutarConsulta($sql);
	}

	// Implementacion de metodo para mostrar los datos de un registro a modificar
	public function mostrar($reg_anul){
		$sql = "SELECT
				ec.est_cta_contrato_id,
				ec.est_cta_persona_id,
				ra.reg_anul_fecha,
				ra.reg_anul_concepto,
				u.usu_nombre,
				u.usu_apellido,
				p.per_nombre,
				p.per_apellido
				FROM registros_anulados ra
				INNER JOIN estado_cuenta_fin ec 
				ON ra.reg_anul_id_anuldo = ec.est_cta_id
				INNER JOIN persona p 
				ON ec.est_cta_persona_id = p.per_id
				INNER JOIN usuario_log u 
				ON ra.reg_anul_id_usu_anula = u.usu_id
				WHERE reg_anul_id = '$reg_anul'";

		return ejecutarConsultaSimpleFila($sql);
	}

	// Cambio de estado para el id de estado de cuenta
	public function anularRegistroSalidas($sal_id) 
	{

        $sql = "UPDATE salidas 
        		SET sal_estado = 0
        		WHERE sal_id  =   '$sal_id'";

        return ejecutarConsulta($sql);
    }
// Fin de Maintenance





} 
?>