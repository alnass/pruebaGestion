<?php 
// # encoded by @Francisco Monsalve

// Incluir la conexion a BDs
require '../config/conexion.php';

Class Permiso {

	// Implimentacion de constructor
	public function __construct(){

	}

	// Impementacion de metodo para listar registros
	public function listar(){
		$sql = "SELECT * FROM permisos";

		return ejecutarConsulta($sql);
	}
	
}


?>