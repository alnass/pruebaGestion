<?php 
// # encoded by @Francisco Monsalve
// # maintenance par @Anderson Ferrucho 

require "../config/conexion.php";

Class Facturacion{

	// Implementacion del constructor 
	public function __construct(){

	}

	// Implementacion de registro de factura 
	public function facturar(){

		$sql = "SELECT
				c.cont_id,
				c.cont_minimo_mensual,
				c.cont_estado_servicio_id,
				es.est_serv_cobro
				FROM contrato c 
				INNER JOIN estado_servicio es 
				ON es.est_serv_id = c.cont_estado_servicio_id
				WHERE es.est_serv_cobro = '1'
				";

		$respuesta = ejecutarConsulta($sql);

		while ($res = $respuesta->fetch_object()) {
			
			$num = "INSERT INTO numeracion_recibo_caja(
					num_fac_id,
					num_fac_sede_id
					)
					VALUES(
					null,
					'$res->cont_estado'
					)";
			$idrecibo = ejecutarConsulta_retornaID($num);

			// début maintenance
		}
	}
}



	
 ?>