<?php 
session_start();
// # encoded by @Francisco Monsalve
// maintenance effectuee par Anderson Ferrucho

// NOMBRE DE LA TABLA
// 	usuario_log

// CAMPOS DE LA TABLA 
	// 		usu_id
	// 		usu_ciudad_id
	// 		usu_sede_id
	// 		usu_area_id
	// 		usu_cargo_id
	// 		usu_tipo_documento_id
	// 		usu_num_documento
	// 		usu_nombre
	// 		usu_apellido
	// 		usu_fecha_nacimiento
	// 		usu_telefono_1
	// 		usu_telefono_2
	// 		usu_direccion
	// 		usu_correo_personal
	// 		usu_correo_cop
	// 		usu_login
	// 		usu_pass
	// 		usu_imagen
	// 		usu_permiso
	// 		usu_estado

// NOMBRE DE LA CLASE 
// 	Usuario

// AJAX
// 	usuario

// NOMBRES DE LOS INPUTS DEL HTMPL
	// 		usu_id
	// 		ciudad
	// 		sede
	// 		area
	// 		cargo
	// 		tipoDoc
	// 		numDoc
	// 		nombre
	// 		apellido
	// 		nacimiento
	// 		tel1
	// 		tel2
	// 		direccion
	// 		correoPer
	// 		correoCorp
	// 		login
	// 		pass
	//		imagen
	// 		permiso 
	// 		estado 


require_once "../modelos/Usuario.php";

$usuario = new Usuario();
	 
$usu_id         		= isset($_POST['usu_id'])? limpiarCadena($_POST['usu_id']):"";
$usu_ciudad_id 			= isset($_POST['ciudad'])? limpiarCadena($_POST['ciudad']):"";
$usu_sede_id 			= isset($_POST['sede'])? limpiarCadena($_POST['sede']):"";
$usu_area_id 			= isset($_POST['area'])? limpiarCadena($_POST['area']):"";
$usu_cargo_id 			= isset($_POST['cargo'])? limpiarCadena($_POST['cargo']):"";
$usu_alianza_id 		= isset($_POST['alianza'])? limpiarCadena($_POST['alianza']):"";
$usu_tipo_documento_id 	= isset($_POST['tipoDoc'])? limpiarCadena($_POST['tipoDoc']):"";
$usu_num_documento 		= isset($_POST['numDoc'])? limpiarCadena($_POST['numDoc']):"";
$usu_nombre 			= isset($_POST['nombre'])? limpiarCadena($_POST['nombre']):"";
$usu_apellido 			= isset($_POST['apellido'])? limpiarCadena($_POST['apellido']):"";
$usu_fecha_nacimiento 	= isset($_POST['nacimiento'])? limpiarCadena($_POST['nacimiento']):"";
$usu_telefono_1 		= isset($_POST['tel1'])? limpiarCadena($_POST['tel1']):"";
$usu_telefono_2 		= isset($_POST['tel2'])? limpiarCadena($_POST['tel2']):"";
$usu_direccion 			= isset($_POST['direccion'])? limpiarCadena($_POST['direccion']):"";
$usu_correo_personal 	= isset($_POST['correoPer'])? limpiarCadena($_POST['correoPer']):"";
$usu_correo_cop 		= isset($_POST['correoCorp'])? limpiarCadena($_POST['correoCorp']):"";
$usu_login 				= isset($_POST['login'])? limpiarCadena($_POST['login']):"";
$usu_pass 				= isset($_POST['pass'])? limpiarCadena($_POST['pass']):"";
$usu_imagen				= isset($_POST['imagen'])? limpiarCadena($_POST['imagen']):"";
$usu_permiso 			= isset($_POST['permiso[]'])? limpiarCadena($_POST['permiso[]']):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
		// Verifica si existe y si se ha carga la imagen 
		if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
			$usu_imagen=$_POST['imagenactual'];
		}else{
			// Verifica la exetncion de la imagen cargada
			$ext = explode(".", $_FILES["imagen"]["name"]);
			// Valida el tipo de extencion que se cargo 
			if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png" || $_FILES['imagen']['type'] == "image/PNG") {
				// Cambia el nombre de la imagen con un formato de tiempo para no repetirla y adhiere la extencion
				$usu_imagen = round(microtime(true)) . '.' . end($ext);
				// Subir el archivo a la carpeta dentro del servidor
				move_uploaded_file($_FILES["imagen"]["tmp_name"] , "../files/perfiles/".$usu_imagen);
			}else{
				echo "Valide a extencion del archivo";
			}

		}

		// Encriptacion de la contraseña mediante hash sha256
		$usu_pass = hash("SHA256", $usu_pass);

		if (empty($usu_id)) {
			$respuesta = $usuario->insertar(
				$usu_id,
				$usu_ciudad_id,
				$usu_sede_id,
				$usu_area_id,
				$usu_cargo_id,
				$usu_alianza_id,
				$usu_tipo_documento_id,
				$usu_num_documento,
				$usu_nombre,
				$usu_apellido,
				$usu_fecha_nacimiento,
				$usu_telefono_1,
				$usu_telefono_2,
				$usu_direccion,
				$usu_correo_personal,
				$usu_correo_cop,
				$usu_login,
				$usu_pass,
				$usu_imagen,
				$usu_permiso,
				$_POST['permiso']				
			);
			echo $respuesta ? "Ususario registrado" : "No es posible registrar todos los datos del usuario"; 
		}else{
			$respuesta = $usuario->editar(
				$usu_id,
				$usu_ciudad_id,
				$usu_sede_id,
				$usu_area_id,
				$usu_cargo_id,
				$usu_alianza_id,
				$usu_tipo_documento_id,
				$usu_num_documento,
				$usu_nombre,
				$usu_apellido,
				$usu_fecha_nacimiento,
				$usu_telefono_1,
				$usu_telefono_2,
				$usu_direccion,
				$usu_correo_personal,
				$usu_correo_cop,
				$usu_login,
				$usu_pass,
				$usu_imagen,
				$usu_permiso,
				$_POST['permiso']
			);
			echo $respuesta ? "Ususario actualizado" : "Ususario no se pudo actualizar";
		}
		break;

	case 'desactivar':
		$respuesta = $usuario->desactivar($usu_id);
		echo $respuesta ? "Ususario desactivado" : "Ususario no se pudo desctivar";
		break;

	case 'activar':
		$respuesta = $usuario->activar($usu_id);
		echo $respuesta ? "Ususario activado" : "Ususario no se pudo activar";
		break;

	case 'mostrar':
		$respuesta = $usuario->mostrar($usu_id);
		// Codificar el resultado mediante json
		echo json_encode($respuesta);
		break;

	case 'listar':
		$respuesta = $usuario->listar();
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		// Estructura de recorrido de la BD
		while ($reg = $respuesta->fetch_object()) {
			$data[] = array(
				// Declaracion de indices de almacenamiento dentro del array
				"0"=>($reg->usu_estado)?'<button  class="btn btn-warning" onclick="mostrar('.$reg->usu_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-danger" onclick="desactivar('.$reg->usu_id.')"><i class="fa fa-close"></i></button>':
					'<button  class="btn btn-warning" onclick="mostrar('.$reg->usu_id.')"><i class="fa fa-pencil"></i></button>'." ".
					'<button  class="btn btn-primary" onclick="activar('.$reg->usu_id.')"><i class="fa fa-check"></i></button>',
				"1"=>$reg->ali_nombre,
				"2"=>$reg->ciu_nombre,
				"3"=>$reg->sed_nombre,
				"4"=>$reg->usu_nombre ." ". $reg->usu_apellido,
				"5"=>$reg->usu_num_documento,
				"6"=>$reg->usu_direccion,
				"7"=>$reg->usu_telefono_1,
				"8"=>$reg->usu_correo_personal,
				"9"=>($reg->usu_estado)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>',
				"10"=>"<img src='../files/perfiles/".$reg->usu_imagen."' height='50px' width='50px'>"
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
//  DESCRIPCION DE RELACION DE CAMPOS
//  -----------------------------------------------------------------
// 	| ALIAS	| TABLA 	    | CAMPO 		|MUESTRA |		RELACION				|	
//  -----------------------------------------------------------------				|
// 	|	u	|				|				|				|usu_id 				|
// 	|	c	|ciudad 		| ciu_id 		|ciu_nombre 	|usu_ciudad_id			|
// 	|	s	|sede 			| sed_id 		|sed_nombre 	|usu_sede_id			|
// 	|	a	|area   		| are_id 		|are_nombre 	|usu_area_id			|
// 	|	g	|cargo  		| car_id 		|car_nombre 	|usu_cargo_id			|
// 	|	t	|tipo_documento | tip_doc_id 	|tip_doc_nombre |usu_tipo_documento_id	|

//  -----------------------------------------------------------------

	
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

	case 'selectSede':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/Sede.php';
		// Se crea un nuevo objeto de la clase requerida
		$sede = new Sede();

		$respuesta = $sede->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->sed_id.'>'.$reg->sed_nombre.'</option>';
		}
		break;

	case 'selectArea':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/Area.php';
		// Se crea un nuevo objeto de la clase requerida
		$area = new Area();

		$respuesta = $area->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->are_id.'>'.$reg->are_nombre.'</option>';
		}
		break;

	case 'selectCargo':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/Cargo.php';
		// Se crea un nuevo objeto de la clase requerida
		$cargo = new Cargo();

		$respuesta = $cargo->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->car_id.'>'.$reg->car_nombre.'</option>';
		}
		break;

	case 'selectTipDoc':
		// Se requiere la clase que va  mostrar en el select
		require_once '../modelos/TipoDocumento.php';
		// Se crea un nuevo objeto de la clase requerida
		$tipoDocumento = new TipoDocumento();

		$respuesta = $tipoDocumento->select();
		while ($reg = $respuesta->fetch_object()) {
			echo '<option value='.$reg->tip_doc_id.'>'.$reg->tip_doc_nombre.'</option>';
		}
		break;

	case 'permisos':
		// Obtener todos los permiss de la tabla permisos
		require_once "../modelos/Permiso.php";
		$permiso = new Permiso();
		$respuesta = $permiso->listar();

		// Obtener los permisos asignados al usuario
		$id = $_GET['id'];
		$marcados = $usuario->listamarcados($id);

		// Decalaracionde array que almacena los permisos
		$valores=array();

		// Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object()) {
			array_push($valores, $per->usu_per_permiso_id);
		}

		// Mostrar la lista de permisos en la vista y si estan marcados o no 
		while ($reg = $respuesta->fetch_object()) {
			$sw = in_array($reg->permi_id, $valores)?'checked':'';

			echo '<li> <input type="checkbox" '.$sw.' name="permiso[]" value="'.$reg->permi_id.'"> '.$reg->permi_nombre.' </li>';
		}
		
		break;

		// Valida el acceso a la aplicacion 
	case 'verificar':
		$logina = $_POST['logina'];
		$clavea = $_POST['clavea'];

		$clavehash = hash("SHA256", $clavea);

		$respuesta = $usuario->verificar($logina, $clavehash);

		$fetch = $respuesta->fetch_object();

		if (isset($fetch)) {
			// Declaracion de variables de session
			$_SESSION['usu_id']=$fetch->usu_id;
			$_SESSION['usu_nombre']=$fetch->usu_nombre;
			$_SESSION['usu_apellido']=$fetch->usu_apellido;
			$_SESSION['usu_correo_personal']=$fetch->usu_correo_personal;
			$_SESSION['usu_imagen']=$fetch->usu_imagen;
			$_SESSION['usu_login']=$fetch->usu_login;
			$_SESSION['usu_area_id']=$fetch->usu_area_id;
			$_SESSION['usu_sede_id']=$fetch->usu_sede_id;
			$_SESSION['usu_alianza_id']=$fetch->usu_alianza_id;
			$_SESSION['usu_grupo_tecnica']=$fetch->usu_grupo_tecnica;
			$_SESSION['usu_permiso']=$fetch->usu_permiso;

			// Objeto con los permisos de usuario
			$marcados = $usuario->listamarcados($fetch->usu_id);
			// Declaracion de array para almacenamiento de los permisos
			$valores = array();

			// Registro en el log de usuario
			$ipusuario = $_SERVER["REMOTE_ADDR"];//identifica la IP de usuario
			$usuario = $_SESSION['usu_id'];


			date_default_timezone_set("America/Bogota");
             $hoy = date('Y-m-d');

              	$sede = $_SESSION['usu_sede_id'];

              	$sql = "SELECT 
              			cie_fin_id,
              			cie_fin_fecha 
              		FROM cierre_final
                    WHERE '$sede' = cie_fin_sede_id
                    ORDER BY cie_fin_id DESC 
                    LIMIT 1
                      ";

              	$valida = ejecutarConsultaSimpleFila($sql);
              	$cierre_id = $valida['cie_fin_id'];
              	$result = $valida['cie_fin_estado'];
              	$fecha_cierre = $valida['cie_fin_fecha'];
              	
              	if($hoy > $fecha_cierre ){
              		$sql = "UPDATE cierre_final 
              				SET cie_fin_estado = '1'
              				WHERE cie_fin_id = '$cierre_id'";
              		ejecutarConsulta($sql);
              	}


			
			$log = "INSERT INTO log_usuario (log_usu_usuario_id, log_usu_ip) VALUES ('$usuario','$ipusuario')";
			ejecutarConsulta($log);

			
			// Almacenamiento de los permisos marcados en el array
			while ($per = $marcados->fetch_object()) {
				array_push($valores, $per->usu_per_permiso_id);
			}

			// Determinacion de accesos a los ususarios
			in_array(1,  $valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
			// Ingreso al modulo de de accesos
			in_array(5,  $valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
			// Ingreso al modulo de parametros de la PQR´s
			in_array(25, $valores)?$_SESSION['paramet']=1:$_SESSION['paramet']=0;
			// Ingreso al modulo de gestión de PQR´s
			in_array(24, $valores)?$_SESSION['registroPqr']=1:$_SESSION['registroPqr']=0;
			// Ingreso al modulo de configuracion general 
			in_array(26, $valores)?$_SESSION['configGeneral']=1:$_SESSION['configGeneral']=0;
			// Ingreso al modulo de gestion de productos
			in_array(27, $valores)?$_SESSION['gestionProductos']=1:$_SESSION['gestionProductos']=0;
			// Ingreso al modulo de gestion de suscriptor
			in_array(28, $valores)?$_SESSION['gestionSuscript']=1:$_SESSION['gestionSuscript']=0;
			// Ingresi al modulo de reportes
			in_array(29, $valores)?$_SESSION['reportes']=1:$_SESSION['reportes']=0;
			// Ingreso a recaudos
			in_array(30, $valores)?$_SESSION['recaudos']=1:$_SESSION['recaudos']=0;
			// Ingreso a equipos
			in_array(31, $valores)?$_SESSION['equipos']=1:$_SESSION['equipos']=0;// maintenance
			// Ingreso a contratos
			in_array(32, $valores)?$_SESSION['contrato']=1:$_SESSION['contrato']=0;
			// Ingreso a orden de trabajo
			in_array(33, $valores)?$_SESSION['ordenTrabajo']=1:$_SESSION['ordenTrabajo']=0;// maintenance
			// Notas debito y credito
			in_array(34, $valores)?$_SESSION['notasdebcred']=1:$_SESSION['notasdebcred']=0;
			// inventario
			in_array(35, $valores)?$_SESSION['inventario']=1:$_SESSION['inventario']=0;// maintenance
			// Operaciones tecnicas 
			in_array(36, $valores)?$_SESSION['opTecnicas']=1:$_SESSION['opTecnicas']=0;
			// Operaciones Administrativas
			in_array(37, $valores)?$_SESSION['opAdmin']=1:$_SESSION['opAdmin']=0;
			// Informes Administrativos
			in_array(38, $valores)?$_SESSION['informes']=1:$_SESSION['informes']=0;
			//ingreso a cuentas de cobro
			in_array(39, $valores)?$_SESSION['cuentasCobro']=1:$_SESSION['cuentasCobro']=0;// maintenance
			//ingreso a promociones
			in_array(40, $valores)?$_SESSION['notasdebito']=1:$_SESSION['notasdebito']=0;// maintenance
			//ingreso a sedes
			in_array(41, $valores)?$_SESSION['notascredito']=1:$_SESSION['notascredito']=0;// maintenance
			/*==========================================================================================
			 |								ACCESO TEMPORAL COMPRAS										|
			  ==========================================================================================*/

			if($_SESSION['usu_area_id'] == 1 || $_SESSION['usu_area_id'] == 7)
			{
				$_SESSION['compras']=1;
				$_SESSION['compra']=2;
			}
			else if($_SESSION['usu_id'] == 32)
			{
				$_SESSION['compras']=1;
				$_SESSION['compra']=1;
			}
			else
			{
				$_SESSION['compras']=2;
				$_SESSION['compra']=2;
			}

			/*==========================================================================================
			 |								FIN ACCESO TEMPORAL COMPRAS									|
			  ==========================================================================================*/
		}
		echo json_encode($fetch);

		break;

	case 'salir':
		// Destruir todas las variables de session
		session_destroy();
		//Limpiar las variables de sesion
		session_unset();
		// Redireccionamiento al index
		header("Location: ../index.php");
		break;

}

?>