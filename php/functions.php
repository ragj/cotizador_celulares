<?php

require_once(__DIR__ . '/Curl.php');

$resultado = new stdClass();

if( !empty( $_POST) ){

	switch ( $_POST['accion'] ) {
		
		case 'ObtieneEquiposRapido':

			$url = sprintf("http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneMarcasAvanzadoAK?tipoPago=%s&tarifario=%s",1,1);

			$equiposRapido = new Curl( $url );
				
			$responseEquipos = $equiposRapido->getResponse();
			$err = $equiposRapido->getError();
			$equiposRapido->closeCurl();

			if ($err) 
			{
				$resultado->exito = false;
				$resultado->error = "cURL Error #:" . $err;
			} 
			else 
			{
				$xml = simplexml_load_string($responseEquipos);
				$marcas = array();
				$modelos = array();
				$jj = 1;
				foreach ($xml->SPS_SCL_ItemBrandAK_Result as $xmls) 
				{
					$marca = new stdClass();
	
					$marca->html = '<li class="'.strtolower( $xmls->BRAND ).'"><a href="javascript:void(0);"></a></li>';

					$url = sprintf( "http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneModelosdeMarcasAK?Marca=%s&tarifario=%s", $xmls->BRAND, 1 );

					$obtieneModelos = new Curl( $url );
				
					$responseModelos = $obtieneModelos->getResponse();
					$err = $obtieneModelos->getError();
					$obtieneModelos->closeCurl();

					if ($err) 
					{
				  		$resultado->error = "cURL Error #:" . $err;
					} 
					else 
					{

						$xml_modelos = simplexml_load_string($responseModelos);
						$modelo = array();
						
						foreach ($xml_modelos->SPS_SCL_ObtieneEquiposNuevoDataAK_Result as $xmls_modelo) 
						{
							$modelo = new stdClass();
							$checked = ( $jj == 1 ) ? 'checked="checked"' : '';
							if( $_POST['marca'] == "Iphone" ){
								$display = ( $xmls->BRAND == 'APPLE') ? 'block' : 'none' ;
							}else{
								$display = ( $xmls->BRAND == 'APPLE') ? 'none' : 'block' ;
							}

							$url_modelo_detalle = sprintf( "http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneEquiposRapido?Variable=%s", str_replace(" ", "%20", $xmls_modelo->Modelo) );


							$modelo_detallado = new Curl( $url_modelo_detalle );
								
							$responseModeloDetallado = $modelo_detallado->getResponse();
							$err = $modelo_detallado->getError();
							$modelo_detallado->closeCurl();
							$xml_detallado = simplexml_load_string($responseModeloDetallado);
							
							
							if( isset( $xml_detallado->SPS_SCL_ObtieneBusquedaRapidaEquipos_Result[0]->Item ) ){
								$item = $xml_detallado->SPS_SCL_ObtieneBusquedaRapidaEquipos_Result[0]->Item;
								
								$url_modelo_detalle = sprintf( "http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneImagenes?item=%s", $item );

								$imagen_modelo = new Curl( $url_modelo_detalle );
								$responseImagenModelo = $imagen_modelo->getResponse();
								$err = $imagen_modelo->getError();
								$imagen_modelo->closeCurl();
								$xml_imagen = simplexml_load_string($responseImagenModelo);
								$modelo->imagen = $xml_imagen;
								$modelo->url_imagen = $url_modelo_detalle;
							}					
						
							$modelo->html = '<li style="display:'.$display.'" class="col-md-4 col-sm-6 '.strtolower( $xmls->BRAND ).'">
	                                            <span class="prev-phone"><img src="img/tel_img_no_disponible.png"></span>
	                                            <span class="nombre-phone">'.$xmls_modelo->Modelo.'</span>
	                                            <input type="radio" name="telefono" value="'.$xmls_modelo->Modelo.'" '.$checked.'/>
	                                        </li>';
							$jj++;
							array_push($modelos, $modelo);
				        }
				        
			        }
	
					array_push($marcas, $marca);
				}
			}

			$resultado->exito = true;
			$resultado->marcas = $marcas;
			$resultado->marcas = $marcas;
			$resultado->modelos = $modelos;

			break;

		case 'ObtienePlanes':

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
				
				$responseDetalle = $curlPlanesDetalle->getResponse();
				$err = $curlPlanesDetalle->getError();
				$curlPlanesDetalle->closeCurl();

				if ($err){

					$resultado->error = "cURL Error #:" . $err;
					
				} else {

					$xml_detalles = simplexml_load_string($responseDetalle);

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

	function obtienResultadosBusqueda( $plan, $equipo )
	{
		$plan = str_replace(" ", "%20", $plan );
		$equipo = str_replace(" ", "%20", $equipo );
		$url = sprintf( "http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneResultadosBusqueda?plan=%s&equipo=%s", $plan, $equipo ); 

		$curl = new Curl( $url );
		$response = $curl->getResponse();
		$err = $curlPlanes->getError();
		$result = new stdClass();
		if($err){
			$result->exito = false;
			$result->error =  $err;
		}else{
			$result->exito = true;
			$result->response = $response;
		}
		$curlPlanes->closeCurl();	
		return $result;
	}

	header('Content-type: text/json');
	echo json_encode($resultado); 