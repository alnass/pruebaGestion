<?php 
 session_start();
// # encoded by @Francisco Monsalve

// NOMBRE DE LA TABLA
// 	sede

// CAMPOS DE LA TABLA 
// 	sed_id
// 	sed_nombre
// 	sed_direccion
// 	sed_barrio
// 	sed_ciudad_id
// 	sed_telefono_1
// 	sed_telefono_2
// 	sed_descripcion
// 	sed_estado

// NOMBRE DE LA CLASE 
// 	Sede 

// AJAX
// 	sede

// NAMES DE LOS INPUTS
// 	sed_id
// 	nombre
// 	direccion
//  barrio
// 	ciudad
// 	tel1
// 	tel2
// 	desc
// 	estado


require_once "../modelos/Sede.php";

$sede = new Sede();

$sed_id         	= isset($_POST['sed_id'])? limpiarCadena($_POST['sed_id']):"";
$sed_nombre 		= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$sed_direccion 		= isset($_POST['direccion'])? limpiarCadena($_POST['direccion']):"";
$sed_barrio 	 	= isset($_POST['barrio'])? limpiarCadena($_POST['barrio']):"";
$sed_ciudad_id 		= isset($_POST['ciudad'])? limpiarCadena($_POST['ciudad']):"";
$sed_telefono_1 	= isset($_POST['tel1'])? limpiarCadena($_POST['tel1']):"";
$sed_telefono_2 	= isset($_POST['tel2'])? limpiarCadena($_POST['tel2']):"";
$sed_descripcion 	= isset($_POST['desc'])? limpiarCadena($_POST['desc']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		if (empty($sed_id)) {
			$respuesta = $sede->insertar(
				$sed_id, 
				$sed_nombre, 
				$sed_direccion, 
				$sed_barrio,
				$sed_ciudad_id,
				$sed_telefono_1,
				$sed_telefono_2,
				$sed_descripcion,
				$_POST['producto']
			);
			echo $respuesta ? "Sede registrado" : "Sede no se pudo registrar"; 
		}else{
			$respuesta = $sede->editar(
				$sed_id, 
				$sed_nombre, 
				$sed_direccion, 
				$sed_barrio,
				$sed_ciudad_id,
				$sed_telefono_1,
				$sed_telefono_2,
				$sed_descripcion,
				$_POST['producto']
			);
			echo $respuesta ? "Sede actualizado" : "Sede no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $sede->desactivar($sed_id);
		echo $respuesta ? "Sede desactivada" : "Sede no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $sede->activar($sed_id);
		echo $respuesta ? "Sede activada" : "Sede no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $sede->mostrar($sed_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':

		if($_SESSION['usu_sede_id'] == 14 || $_SESSION['usu_sede_id'] == 11)
		{
			$respuesta = $sede->listarSedeUsuario($_SESSION['usu_sede_id']);
		}
		else
		{
			$respuesta = $sede->listar();
		}
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->sed_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->sed_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->sed_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->sed_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->sed_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->sed_nombre,
				"2"=>$reg->sed_direccion,
				"3"=>$reg->sed_barrio,
				"4"=>$reg->ciu_nombre,
				"5"=>$reg->sed_telefono_1,
				"6"=>$reg->sed_telefono_2,
				"7"=>$reg->sed_descripcion,
				"8"=>($reg->sed_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
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
	
	case 'slectCategoria':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/Ciudad.php';
		// Se crea un nuevo objeto de la clase requerida
		$ciudad = new Ciudad();

		$respuesta = $ciudad->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->ciu_id.'>'.$reg->ciu_nombre." - ".$reg->ciu_departamento.'</option>';
		}
		break;

	case 'productos':
		// Obtiene el listado de productos
		require_once "../modelos/Producto.php";
		$producto  = new Producto();
		$respuesta = $producto->listarActivos();

		// Obtiene los productos marcados por sede
		$id = $_GET['id'];
		$marcados = $sede->listamarcados($id);

		// Declaracion de array para almacenamiento de los productos 
		$valores = array();

		// Almacenamiento de los productose el array 
		while ($pro = $marcados->fetch_object()) {
			array_push($valores, $pro->sed_prod_producto_id);
		}

		// Mostrar el listado de permisos en la vista 
		while ($reg = $respuesta->fetch_object()) {
			$sw = in_array($reg->prod_id, $valores)?'checked':'';

			echo '<li>
					<input type="checkbox" '.$sw.' name="producto[]" value="'.$reg->prod_id.'">
					'.$reg->prod_nombre.' - $'.number_format($reg->prod_valor) .'
				</li>';
		}

		break;
}

?>