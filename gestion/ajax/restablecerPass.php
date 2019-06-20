<?php 

require '../modelos/RestablecerPass.php';

$restablecerPass = new RestablecerPass();

$usu_login = isset($_POST['logina'])? limpiarCadena($_POST['logina']):"";
$usu_pass  = isset($_POST['clavea'])? limpiarCadena($_POST['clavea']):"";
$usu_newpass = isset($_POST['newpass'])? limpiarCadena($_POST['newpass']):"";

switch ($_GET['op']) {
	case 'validarusu':
		$pass = hash("SHA256", $usu_pass);
		$newpass = hash("SHA256", $usu_newpass);

		$respuesta = $restablecerPass->validarusu($usu_login, $pass);
		
		if ($respuesta) {
			
			$resp = $restablecerPass->cambiarpass($usu_login, $pass, $newpass);
			if ($resp) {
				echo "Los datos han sido cambiados correctamente";
			}else{
				echo "No ha sido posible cambiar los datos";
			}

		}else{
			echo "Los datos del usuario no son correctos";
		}
	
			
		break;

}

?>