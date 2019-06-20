<?php 
require '../config/conexion.php';

Class AgregarImagen
{
	public function __construct()
	{

	}

	public function insertarImagen($cont_id, $doc_tipo, $ruta, $ot_id)
	{
		
		$usuario_id 	= 	$_SESSION['usu_id'];

		$sql 	= 	"INSERT INTO documentos(
						doc_id,
						doc_cont_id,
						doc_usu_id,
						doc_tipo,
						doc_ruta,
						doc_ot_id)
					VALUES (
						null,
						'$cont_id',
						'$usuario_id',
						'$doc_tipo',
						'$ruta',
						'$ot_id')";

		return 	ejecutarConsulta($sql);

	}

	public function validarImagen($ot_id, $tipo)
	{
		$sql 	= 	"SELECT * FROM documentos 
					 WHERE doc_ot_id = '$ot_id'
					 AND doc_tipo = '$tipo'";

		ejecutarConsulta($sql);
	}

	public function updateImagen($usu_id, $ruta, $ot_id)
	{
		$sql 	= 	"UPDATE documentos SET 
						doc_usu_id 	= 	$usu_id,
						doc_ruta 	= 	$ruta
					 WHERE doc_ot_id = $ot_id";

		ejecutarConsulta($sql);
	}	
}
?>