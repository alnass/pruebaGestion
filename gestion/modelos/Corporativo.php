<?php
// # encodé par @Anderson Ferrucho 

require '../config/conexion.php';

Class Corporativo 
{

	// Implimentacion de constructor
	public function __construct(){

	}

	public function listarCorporativo()
	{

			$sede = $_SESSION['usu_sede_id'];

			$sql = "SELECT
						c.cont_id,
						c.cont_no_contrato,
						c.cont_minimo_mensual,
						c.cont_vigencia_a_partir,
						c.cont_permanencia,
						c.cont_fecha_fin_perm,
						c.cont_estado,
						c.cont_fecha_transaccion,
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
						c.cont_tv_analogica,
                        p.per_tipo_persona_id
					FROM contrato c 
					INNER JOIN persona p 
					ON c.cont_persona_id = p.per_id
					WHERE cont_estado = 1
					AND p.per_tipo_persona_id = 2";

				return ejecutarConsulta($sql);
		}
}