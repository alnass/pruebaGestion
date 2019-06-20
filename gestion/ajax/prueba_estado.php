<?php session_start();


require_once "../modelos/OrdenTrabajo.php";
require_once "../modelos/Contrato.php";
require_once "../modelos/Persona.php";
require_once "../modelos/EquipoDetalle.php";

$ordenTrabajo = new OrdenTrabajo();

$respuesta = $ordenTrabajo->listar();

while ($reg = $respuesta->fetch_object()) 
{
	$estado		= 	$ordenTrabajo->fechaEstado($reg->cont_id);
	
}
$oT 		= 	$ordenTrabajo->listar();
print_r($oT);
?>