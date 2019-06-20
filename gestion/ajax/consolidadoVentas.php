<?php  
// maintenance effectuee par Anderson Ferrucho
require "../modelos/ConsolidadoVentas.php";
require "../modelos/Sede.php";

$consolidadoVentas = new ConsolidadoVentas();

switch ($_GET['op']) {
	
	case 'listar':

		$filtro 	= 	isset($_REQUEST['mes_anio']);

		if(empty($filtro))
		{
			$start_mes 	=	0;
			$anio 	= 2019;	
		}
		else
		{
			if($filtro == 1 || $filtro == 3)
			{
				$start_mes 	=	0;

				if($filtro == 1)
				{
					$anio 	= 2018;
				}
				else
				{
					$anio 	= 2019;	
				}
			}
			else
			{
				$start_mes 	= 		6;

				if($filtro == 2)
				{
					$anio 	= 2018;
				}
				if($filtro == 4)
				{
					$anio 	= 2019;	
				}
			}
		}


		$respuesta 	= 	$consolidadoVentas->traerSedes();		
		$data = Array();

		while ($regis = $respuesta->fetch_object()) 
		{
			if($regis->sed_id != 12)
			{
				$sede = Array();
				$t_reg = Array();
				$mes 		= 	$start_mes;
				$mesCorpAli	= 	0;

				while($mes < 6)
				{
					$mes++;
					$consolidadoVentas = new ConsolidadoVentas();

					if($regis->sed_id == 14)
					{
						$mesCorpAli = 	$mes+1;
						$facturado 	= 	$consolidadoVentas->facturadoAliados($mesCorpAli, $anio);	
						$factDetlle = 	$consolidadoVentas->facturadoAliadosCorpDetalle($mesCorpAli, $anio, $regis->sed_id);	
					}
					else if($regis->sed_id == 11)
					{
						$mesCorpAli = 	$mes+1;
						$facturado 	= 	$consolidadoVentas->facturadoCorporativo($mesCorpAli, $anio);	
						$factDetlle = 	$consolidadoVentas->facturadoAliadosCorpDetalle($mesCorpAli, $anio, $regis->sed_id);	
					}
					else
					{
						$facturado 	= 	$consolidadoVentas->facturacionGeneral($mes, $anio, $regis->sed_id);
						$factDetlle	= 	$consolidadoVentas->facturacionGeneralDetalle($mes, $anio, $regis->sed_id);
					}

					array_push($sede, "$". number_format($facturado['sumatoria']));
					array_push($t_reg, $facturado['total_reg']);

					while ($reg = $factDetlle->fetch_object()) 
					{
						// echo 'Sede '. $regis->sed_nombre. ' Mes '. $mes . ' Contrato '. $reg->est_cta_contrato_id . ' Mensualidad ' . $reg->est_cta_haber.'<br>';

						// // print_r($reg);
					}

				}

				if($regis->sed_id != 11 || $regis->sed_id != 14)
				{
					$data[] = 	array(
							"0"=>$regis->sed_nombre,
							"1"=>"0",
							"2"=>"$",
							"3"=>'<strong>'.$t_reg[0].'</strong>',
							"4"=>$sede[0],
							"5"=>'<strong>'.$t_reg[1].'</strong>',
							"6"=>$sede[1],
							"7"=>'<strong>'.$t_reg[2].'</strong>',
							"8"=>$sede[2],
							"9"=>'<strong>'.$t_reg[3].'</strong>',
							"10"=>$sede[3],
							"11"=>'<strong>'.$t_reg[4].'</strong>',
							"12"=>$sede[4]);
				}
				else
				{
					$data[] = 	array(
							"0"=>$regis->sed_nombre,
							"1"=>$t_reg[0],
							"2"=>$sede[0],
							"3"=>$t_reg[1],
							"4"=>$sede[1],
							"5"=>$t_reg[2],
							"6"=>$sede[2],
							"7"=>$t_reg[3],
							"8"=>$sede[3],
							"9"=>$t_reg[4],
							"10"=>$sede[4],
							"11"=>$t_reg[5],
							"12"=>$sede[5]);
				}

			}

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

//***** Début maintenance **** /// 
		
}

// Funciones para llamar los datos

public function mostrar datos()
{
	
}

?>