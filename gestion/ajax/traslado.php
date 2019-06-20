<?php
session_start();

require_once "../modelos/Traslado.php";

$traslado 	= 	new Traslado;

$usuario_id		 = 	$_SESSION['usu_id'];
$sede_actual	 = 	isset($_POST['sed_actl'])? limpiarCadena($_POST['sed_actl']):"";
$concepto 		 = 	isset($_POST['concepto'])? limpiarCadena($_POST['concepto']):"";
$sede_id_destino = 	isset($_POST['sede'])? limpiarCadena($_POST['sede']):"";
$equipo_id 		 = 	isset($_POST['equipo_id'])? limpiarCadena($_POST['equipo_id']):"";
$equipo_estd 	 = 	isset($_POST['eqp_est'])? limpiarCadena($_POST['eqp_est']):"";


switch ($_GET["op"]) {
	case 'guardartraslado':

		if($equipo_estd != 1)
		{
			$result = $traslado->insertar($usuario_id, $sede_actual, 'Ingreso Stock', 1, $equipo_id);
			$result = $traslado->trasladar_equipo($equipo_id, $sede_id_destino);

			echo "Traslado realizado Exitosamente";
		}
		else
		{
			echo "Un equipo en uso no puede ser trasladado de sede";	
		}


	break;

	case 'listarultimotraslado':
		
		$result	= $traslado->listarTraslados();

		echo json_encode($result);

	break;


}
