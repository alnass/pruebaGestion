<?php 
	require_once "global.php";

	$conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

	mysqli_query($conexion, 'SET NAMES "'.DB_ENCODE.'"');

	if (mysqli_connect_errno()) {
		printf("Fallo de conexion: %s\n",mysql_connect_errno());
		exit();
	}

	if (!function_exists('ejecutarConsulta')) {

		function ejecutarConsulta($sql){
			
			global $conexion;
			$query = $conexion->query($sql);
			return $query;
		}

		function ejecutarConsultaSimpleFila($sql){

			global $conexion;
			$query = $conexion->query($sql);
			$row = $query->fetch_assoc();
			return $row;
		}

		function ejecutarConsulta_retornaID($sql){

			global $conexion;
			$query = $conexion->query($sql);
			return $conexion->insert_id;
		}

		function limpiarCadena($str){

			global $conexion;
			$str = mysqli_real_escape_string($conexion,trim($str));
			return htmlspecialchars($str);
		}

		function backupdb($sql){

			$host = DB_HOST;
			$user = DB_USERNAME;
			$pass = DB_PASSWORD;
			$name = DB_NAME;

			$fecha = date("Ymd-His");
			$salida_sql = $name.'_'.$fecha.'.sql';
			$dump = "mysqldump -h$host -u$user -p$pass --opt $name > $salida_sql";

			system($dump, $output);
		}
	}


 ?>