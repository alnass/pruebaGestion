<?php

session_start();

require '../modelos/ActualizacionSuscriptor.php';

$actualizar 		= 	new ActualizacionSuscriptor();


$id_suscriptor		= 	isset($_POST['no_suscriptor'])? limpiarCadena($_POST['no_suscriptor']):"";	
$cont_suscriptor	= 	isset($_POST['contratoid'])? limpiarCadena($_POST['contratoid']):"";		
// DATOS ANTERIORES
$doc_suscriptor		= 	isset($_POST['documento_ant'])? limpiarCadena($_POST['documento_ant']):"";	
$tel_suscriptor		= 	isset($_POST['telefono_ant'])? limpiarCadena($_POST['telefono_ant']):"";	
$direc_suscriptor	= 	isset($_POST['direccion_ant_sus'])? limpiarCadena($_POST['direccion_ant_sus']):"";		
$barrio_suscriptor	= 	isset($_POST['barrio_ant_sus'])? limpiarCadena($_POST['barrio_ant_sus']):"";		
$direc_contrato		= 	isset($_POST['direccion_ant_ser'])? limpiarCadena($_POST['direccion_ant_ser']):"";	
$barrio_contrato	= 	isset($_POST['barrio_ant_ser'])? limpiarCadena($_POST['barrio_ant_ser']):"";		
$nombres			= 	isset($_POST['nombres_ant'])? limpiarCadena($_POST['nombres_ant']):"";
$apellidos			= 	isset($_POST['apellidos_ant'])? limpiarCadena($_POST['apellidos_ant']):"";
//NUEVOS DATOS
$documento_upg		= 	isset($_POST['documento_upg'])? limpiarCadena($_POST['documento_upg']):"";
$telefono_upg_sus	= 	isset($_POST['telefono_upg'])? limpiarCadena($_POST['telefono_upg']):"";
$direccion_upg_sus	= 	isset($_POST['direccion_upg_sus'])? limpiarCadena($_POST['direccion_upg_sus']):"";
$barrio_upg_sus		= 	isset($_POST['barrio_upg_sus'])? limpiarCadena($_POST['barrio_upg_sus']):"";
$direccion_upg_ser	= 	isset($_POST['direccion_upg_ser'])? limpiarCadena($_POST['direccion_upg_ser']):"";
$barrio_upg_ser		= 	isset($_POST['barrio_upg_ser'])? limpiarCadena($_POST['barrio_upg_ser']):"";
$nombres_upg		= 	isset($_POST['nombres_upg'])? limpiarCadena($_POST['nombres_upg']):"";
$apellidos_upg		= 	isset($_POST['apellidos_upg'])? limpiarCadena($_POST['apellidos_upg']):"";

switch ($_GET["op"]) 
{
	case 'actualizarsuscriptor':
		if(!empty($id_suscriptor))
		{
			$respuesta 	= 	$actualizar->insertar(
					$id_suscriptor,
					$cont_suscriptor,
					$doc_suscriptor,
					$tel_suscriptor,
					$direc_suscriptor,
					$barrio_suscriptor,
					$direc_contrato,
					$barrio_contrato,
					$nombres,
					$apellidos,
					'1') + 
					$actualizar->update(
					$id_suscriptor,
					$cont_suscriptor,
					$documento_upg,
					$nombres_upg,
					$apellidos_upg,
					$telefono_upg_sus,
					$barrio_upg_sus,
					$direccion_upg_sus,
					$direccion_upg_ser,
					$barrio_upg_ser);

			echo $respuesta ? "Datos Actualizados" : "No pudo actualizarse correctamente";
		}
		else
		{
			echo $respuesta ? "Faltan datos en la persona" : "No se pudo correctamente";	
		}
		
		break;
	
	default:
		
		break;
}