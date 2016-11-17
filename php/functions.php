<?php

require_once(__DIR__ . '/Curl.php');

$resultado = new stdClass();

if( !empty( $_POST) ){

	switch ( $_POST['accion'] ) {
		case 'ObtienePlanes':


		$curl = curl_init();

		$marca = ( $_POST['marca'] == 'Iphone' ) ? "Iphone" : "" ;
		$url = sprintf("http://smartcen.net:8020/CotizadorControlador.asmx/ObtienePlanesRango?segmento=%s&rango=%s&claseplan=%s",1,$_POST['rango'],$marca);
		$curlPlanes = new Curl( $url );

		$response = $curlPlanes->getResponse();
		$err = $curlPlanes->getError();

		$curlPlanes->closeCurl();

		if ($err) {

			$resultado->error = "cURL Error #:" . $err;

		} else {

			$xml = simplexml_load_string($response);
			$planes =array();

			$i = 1;				
			foreach ( $xml->SPS_SCL_ObtenPlanesRango_Result as $planDetalle ) {
				
				// $planDetalle = $detallesPlanRango;



				$planDetalle = str_replace(" ", "%20", $planDetalle->plan );
				$url_curl = sprintf( "http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneDetallePlanRango?Plan=%s", $planDetalle );
				
				$curlPlanesDetalle = new Curl( $url_curl );
				
				$response = $curlPlanesDetalle->getResponse();
				$err = $curlPlanesDetalle->getError();
				$curlPlanesDetalle->closeCurl();

				if ($err){

					$resultado->error = "cURL Error #:" . $err;
					
				} else {

					$xml_detalles = simplexml_load_string($response);

					$resultado->xml = $xml_detalles;


					$detalle_plan = new stdClass();

					$checked = ( $i == 1 ) ? 'checked' : '';

					$detalle_plan->html='
					<div class="row-cell">
						<div class="cell titulo-plan">'.$xml_detalles->SPS_SCL_ObtenDetallesPlanRango_Result->plan.'</div> 
						<div class="cell minutos">'.$xml_detalles->SPS_SCL_ObtenDetallesPlanRango_Result->Minutos.'</div>
						<div class="cell mensajes">'.$xml_detalles->SPS_SCL_ObtenDetallesPlanRango_Result->SMS.'</div>
						<div class="cell internet">'.$xml_detalles->SPS_SCL_ObtenDetallesPlanRango_Result->Megas.'</div>
						<div class="cell redes"> <span class="check"></span> </div>
						<div class="cell radio"> <input type="radio" name="plan" value="'.$xml_detalles->SPS_SCL_ObtenDetallesPlanRango_Result->plan.'" '.$checked.'></div>';
					}

					array_push($planes, $detalle_plan);
					$i++;
				}
			}

			$resultado->plan = $planes;
			$resultado->exito = true;
			break;

			default:
			# code...
			break;
		}

	}else{
		$resultado->exito = false;
	}

	header('Content-type: text/json');
	echo json_encode($resultado); 