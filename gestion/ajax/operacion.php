<?php

session_start();
/*
oper_id
oper_nombre
oper_descripcion
oper_estado
*/


/// INPUT

//$oper_id

require_once "../modelos/Operacion.php"

$operacion 		= 	new Operacion();

$oper_id 		= 	isset($_POST['oper_id'])? limpiarCadena($_POST['oper_id']):"";


switch($_GET["op"])
{
	case 'mostrar':

	$respuesta 	= 	$operacion->mostrar($oper_id);
	echo json_encode($respuesta);
	break;

}



?>