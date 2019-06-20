<?php
// # encodé par @Anderson Ferrucho 
require '../config/conexion.php';

class ActualizacionSuscriptor
{
	public function __construct()
	{
	}
	public function Insertar($id_suscriptor,
							 $cont_suscriptor,
							 $doc_suscriptor,
							 $tel_suscriptor,
							 $direc_suscriptor,
							 $barrio_suscriptor,
							 $direc_contrato,
							 $barrio_contrato,
							 $nombres,
							 $apellidos,
							 $concepto)
	{

		$usuario  	= 	$_SESSION['usu_id'];		

		$sql 	= 	"INSERT INTO cc_persona(
						cc_per_id, 
						cc_per_persona_id,
						cc_per_contrato_id,
						cc_per_documento,
						cc_per_telefono,
						cc_per_direccion_per,
						cc_per_usuario_id,
						cc_per_direccion_ser,
						cc_per_barrio_ser,
						cc_per_barrio_per, 
						cc_per_nombres,
						cc_per_apellidos,
						cc_per_concepto)
					VALUES (
						null,
						'$id_suscriptor',
						'$cont_suscriptor',
						'$doc_suscriptor',
						'$tel_suscriptor',
						'$direc_suscriptor',
						'$usuario',
						'$barrio_suscriptor',
						'$direc_contrato',
						'$barrio_contrato', 
						'$nombres',
						'$apellidos',
						'$concepto')";

			return ejecutarConsulta($sql);
	}

	public function Update($id_suscriptor,
							$cont_suscriptor,
							$documento_upg,
							$nombres_upg,
							$apellidos_upg,
							$telefono_upg_sus,
							$barrio_upg_sus,
							$direccion_upg_sus,
							$direccion_upg_ser,
							$barrio_upg_ser)
	{
		
		$sql_p	= 	"UPDATE persona 
				SET per_num_documento 	= '$documento_upg',
					per_nombre 			= '$nombres_upg',
					per_apellido 		= '$apellidos_upg',
					per_telefono_1 		= '$telefono_upg_sus',
					per_barrio 			= '$barrio_upg_sus',
					per_direccion 		= '$direccion_upg_sus'
				WHERE per_id 			= '$id_suscriptor'";  

				ejecutarConsulta($sql_p);

		$sql_c 	= 	"UPDATE contrato 
				SET cont_direccion_serv	= '$direccion_upg_ser',
					cont_barrio			= '$barrio_upg_ser'
				WHERE cont_id 			= '$cont_suscriptor'";

				ejecutarConsulta($sql_c);
			
			return true;
	}

}


