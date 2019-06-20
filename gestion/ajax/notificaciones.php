<?php 
session_start();


require "../modelos/Notificaciones.php";
$notif = new Notificaciones();

$not_id = isset($_POST['not_id'])?limpiarCadena($_POST['not_id']):"";

switch ($_GET["op"]) {
	case 'cantidad':

		$respuesta = $notif->cantidad();
		echo json_encode($respuesta);
		
		break;
	
	case 'mostrarnotificacion':
		
		$respuesta = $notif->mostrarnotificacion();
		while ($res = $respuesta->fetch_object()) {
			echo '<p><span onclick="leernotificacion('.$res->not_id.')" style="cursor:pointer; color:blue;">'.$res->cat_pqr_nombre .'</span></br>'.$res->are_nombre.'</p>';
		}
		break;
	 case 'leernotificacion':
	 	
	 	$respuesta = $notif->leernotificacion($not_id);
	 	echo $respuesta?"Leido":"No leido";
	 	break;
}


?>