<?php 

require '../config/conexion.php';

Class RestablecerPass{

	public function __construct(){

	}

	public function validarusu($usu_login, $usu_pass){

		$sql = "SELECT * FROM usuario_log
			WHERE usu_login = '$usu_login'
			AND usu_pass = '$usu_pass'
			";
		
		
		return 	ejecutarConsultaSimpleFila($sql) ;
		
	}

	public function cambiarpass($usu_login, $usu_pass, $new_pass){
		$sql = "UPDATE usuario_log
			SET usu_pass = '$new_pass'
			WHERE usu_login = '$usu_login'
			AND usu_pass = '$usu_pass'
			";
		return ejecutarConsulta($sql);
	}
}

 ?>