<?php 

require_once "../modelos/SeguimientoPqr.php";
$seguimientoPqr = new SeguimientoPqr();

if (isset($_GET['reg_pqr_id'])) {
	$respuesta = $seguimientoPqr->cerrarpqr($_GET['reg_pqr_id']);
	echo $respuesta ? "La PQR se ha cerrado exitosamente" : "No es posible cerrar la PQR";
}
 ?>