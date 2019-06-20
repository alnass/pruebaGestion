<?php 
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA 
// 	alianza

// CAMPOS DE LA TABLA 
// 	ali_id
// 	ali_nombre
//	ali_no_documento
//	ali_descripcion
//	ali_num_contacto
//	ali_nombre_contacto
//	ali_apellido_contacto
//	ali_correo_contacto
//	ali_correo_corporativo
//	ali_telefono_oficina
//	ali_direccion_oficina
//	ali_ciudad_id
//	ali_barrio
//	ali_cobertura
// 	ali_estado

// NOMBRES DE LOS INPUTS
// 	ali_id
// 	nombre
// 	documento
// 	desc
// 	num_contacto
// 	nombre_contacto
// 	apellido_contacto
// 	correo_contacto
// 	correo_corporativo
// 	telefono_oficina
// 	direccion_oficina
// 	ciudad_id
// 	barrio
// 	cobertura

// NOMBRE DE LA CLASE
// 	Alianza

// AJAX
// 	alianza

require_once "../modelos/Alianza.php";

$alianza = new Alianza();

$ali_id         		=	isset($_POST['ali_id'])? limpiarCadena($_POST['ali_id']):"";
$ali_nombre 			=	isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$ali_no_documento 		=	isset($_POST['documento'])? limpiarCadena($_POST['documento']):"";
$ali_descripcion 		=	isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";
$ali_num_contacto 		=	isset($_POST['num_contacto'])? limpiarCadena($_POST['num_contacto']):"";
$ali_nombre_contacto 	=	isset($_POST['nombre_contacto'])? limpiarCadena($_POST['nombre_contacto']):"";
$ali_apellido_contacto 	=	isset($_POST['apellido_contacto'])? limpiarCadena($_POST['apellido_contacto']):"";
$ali_correo_contacto 	=	isset($_POST['correo_contacto'])? limpiarCadena($_POST['correo_contacto']):"";
$ali_correo_corporativo =	isset($_POST['correo_corporativo'])? limpiarCadena($_POST['correo_corporativo']):"";
$ali_telefono_oficina 	=	isset($_POST['telefono_oficina'])? limpiarCadena($_POST['telefono_oficina']):"";
$ali_direccion_oficina 	=	isset($_POST['direccion_oficina'])? limpiarCadena($_POST['direccion_oficina']):"";
$ali_ciudad_id 			=	isset($_POST['ciudad_id'])? limpiarCadena($_POST['ciudad_id']):"";
$ali_barrio 			=	isset($_POST['barrio'])? limpiarCadena($_POST['barrio']):"";
$ali_cobertura 			=	isset($_POST['cobertura'])? limpiarCadena($_POST['cobertura']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($ali_id)) {
			$respuesta = $alianza->insertar(
				$ali_id, 
				$ali_nombre, 
				$ali_no_documento,
				$ali_descripcion,
				$ali_num_contacto,
				$ali_nombre_contacto,
				$ali_apellido_contacto,
				$ali_correo_contacto,
				$ali_correo_corporativo,
				$ali_telefono_oficina,
				$ali_direccion_oficina,
				$ali_ciudad_id,
				$ali_barrio,
				$ali_cobertura
			);
			echo $respuesta ? "Alianza registrada" : "La alianza no se pudo registrar"; 
		}else{
			$respuesta = $alianza->editar(
				$ali_id, 
				$ali_nombre, 
				$ali_no_documento,
				$ali_descripcion,
				$ali_num_contacto,
				$ali_nombre_contacto,
				$ali_apellido_contacto,
				$ali_correo_contacto,
				$ali_correo_corporativo,
				$ali_telefono_oficina,
				$ali_direccion_oficina,
				$ali_ciudad_id,
				$ali_barrio,
				$ali_cobertura
			);
			echo $respuesta ? "Alianza actualizada" : "La alianza no se pudo actualizar";
		}
		break;
	case 'desactivar':
		$respuesta = $alianza->desactivar($ali_id);
		echo $respuesta ? "Alianza desactivada" : "La alianza no se pudo desctivar";
		break;
	case 'activar':
		$respuesta = $alianza->activar($ali_id);
		echo $respuesta ? "Alianza activada" : "La alianza no se pudo activar";
		break;
	case 'mostrar':
		$respuesta = $alianza->mostrar($ali_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;
	case 'listar':
		$respuesta = $alianza->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->ali_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->ali_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->ali_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->ali_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->ali_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->ali_nombre,
				"2"=>$reg->ali_ciudad_id,
				"3"=>$reg->ali_nombre_contacto.' '.$reg->ali_apellido_contacto,
				"4"=>$reg->ali_telefono_oficina,
				"5"=>$reg->ali_correo_contacto,
				"6"=>($reg->ali_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
				);
		}
		$results = array(
			// Informacion para el datatable
			"sEcho"=>1,
			// Envio el total de los regstros al datatable
			"iTotalRecords"=>count($data),
			// Envio del total de registros a visualizar
			"iTotalDisplayRecords"=>count($data),
			//Envio de los valores resultantes
			"aaData"=>$data);
		echo json_encode($results);
		break;
	case 'selectCiudad':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/Ciudad.php';
		// Se crea un nuevo objeto de la clase requerida
		$ciudad = new Ciudad();
		$respuesta = $ciudad->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->ciu_id.'>'.$reg->ciu_nombre.'</option>';
		}
		break;
}

?>