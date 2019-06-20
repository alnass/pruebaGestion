<?php 
require_once "../modelos/Registro-pqr.php";

$registroPqr = new RegistroPqr();

if (isset($_GET['per_id'])	) {
	
	$respuesta = $registroPqr->listarpqrusuario($_GET['per_id']);
		// Declaracion de array para almacenamiento de los resultados
		$data = Array();
		
		while ($reg = $respuesta->fetch_object()) {
			// Fecha y hora actual
			date_default_timezone_set("America/Bogota");
			$hoy = date('Y-m-d H:i:s');

			$strStart = $hoy; 
			$strEnd   = $reg->reg_pqr_fecha_fin;
			$dteStart = new DateTime($strStart); 
			$dteEnd   = new DateTime($strEnd);
			$dteDiff  = $dteStart->diff($dteEnd); 
			$inicio = new DateTime($reg->reg_pqr_fecha_inicio);
			
			$porvencer = strtotime("-12 hour", strtotime($strEnd));
			$porvencer = date('Y-m-d H:i:s',$porvencer);
			$dia 	= $dteDiff->format("%d");
			$hora 	= $dteDiff->format("%H");
			$minutos= $dteDiff->format("%I");
			

			$estado = null;
			$agregar = null;

			if ($reg->reg_pqr_estado_id == 2) {
				$verestado = 1;
				$estado = '<span class="label bg-blue">4-Cerrado</span>';
				$agregar = '<button  class="btn btn-warning" onclick="mostrar('.$reg->reg_pqr_id.'), listarseguimiento('.$reg->reg_pqr_id.'),ocultarinsertarob(),mostrarestado('.$verestado.')" ><i class="fa fa-eye"></i>
				</button>';
			}else{

				if ($hoy > $strEnd) {
					$verestado = 2;
					$estado = '<span class="label bg-red">1-Vencido</span>';
					$agregar = '<button  class="btn btn-success" onclick="mostrar('.$reg->reg_pqr_id.'), listarseguimiento('.$reg->reg_pqr_id.'),mostrarestado('.$verestado.')" ><i class="fa fa-plus-circle"></i></button>';
				}
				elseif ($hoy < $strEnd && $hoy > $porvencer ) {
					$verestado = 3;
					$estado = '<span class="label bg-orange">2-Por Vencer</span>';
					$agregar = '<button  class="btn btn-success" onclick="mostrar('.$reg->reg_pqr_id.'), listarseguimiento('.$reg->reg_pqr_id.'),mostrarestado('.$verestado.')" ><i class="fa fa-plus-circle"></i></button>';
				}
				else{
					$verestado = 4;
					$estado = '<span class="label bg-green">3-Activa</span>';
					$agregar = '<button  class="btn btn-success" onclick="mostrar('.$reg->reg_pqr_id.'), listarseguimiento('.$reg->reg_pqr_id.'),mostrarestado('.$verestado.')" ><i class="fa fa-plus-circle"></i></button>';
				}
			}

			$data[] = array(
				
				"0"=>$reg->reg_pqr_id."-"."<strong>".$reg->reg_pqr_num_radicado."<strong>",
				
				"1"=>$reg->tip_pqr_nombre,
				"2"=>$reg->cat_pqr_nombre,
				"3"=>$reg->are_nombre,
				
				"4"=>$inicio->format("d/m/Y"),
				
				"5"=>$reg->reg_pqr_observacion,
				
				"6"=>$estado
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
	}
 ?>