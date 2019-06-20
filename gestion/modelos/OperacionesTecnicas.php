<?php 

require '../config/conexion.php';

Class OperacionesTecnicas{

	public function __construct(){

	}

	public function listarcontrato(){
	
		$sql = "SELECT
				c.cont_id,
				c.cont_no_contrato,
				c.cont_estado,
				c.cont_direccion_serv,
				c.cont_barrio,
				c.cont_estado_servicio_id,
				c.cont_valor_total_mes,
				c.cont_tv_analogica,
				c.cont_tv_digital,
				c.cont_internet,
				p.per_id,
				p.per_nombre,
				p.per_apellido,
				p.per_num_documento,
				p.per_telefono_1,
				p.per_tipo_persona_id
			FROM contrato c 
			INNER JOIN persona p 
			ON c.cont_persona_id = p.per_id
			WHERE cont_estado_servicio_id = 2
			AND p.per_tipo_persona_id = 1
			";

		return ejecutarConsulta($sql);

	}

}

 ?>