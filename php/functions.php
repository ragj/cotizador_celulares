<?php

$resultado = new stdClass();

if( !empty( $_POST) ){

	switch ( $_POST['accion'] ) {
		
		case 'ObtieneEquiposRapido':

			$curl = curl_init();

			curl_setopt_array($curl, array(
				CURLOPT_PORT => "8020",
				CURLOPT_URL => sprintf("http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneMarcasAvanzadoAK?tipoPago=%s&tarifario=%s",1,1),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 300,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET"  ,
				));


			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);

			if ($err) 
			{
				$resultado->exito = false;
				$resultado->error = "cURL Error #:" . $err;
			} 
			else 
			{
				$xml = simplexml_load_string($response);
				$marcas = array();
				$modelos = array();
				$jj = 1;
				foreach ($xml->SPS_SCL_ItemBrandAK_Result as $xmls) 
				{
					$marca = new stdClass();
	
					$marca->html = '<li class="'.strtolower( $xmls->BRAND ).'"><a href="javascript:void(0);"></a></li>';
					$curl_modelos = curl_init();

					curl_setopt_array($curl_modelos, array(
			  		CURLOPT_PORT => "8020",
			  		CURLOPT_URL => sprintf( "http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneModelosdeMarcasAK?Marca=%s&tarifario=%s", $xmls->BRAND, 1 ),
			  		CURLOPT_RETURNTRANSFER => true,
			  		CURLOPT_ENCODING => "",
			  		CURLOPT_MAXREDIRS => 10,
			  		CURLOPT_TIMEOUT => 300,
			  		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  		CURLOPT_CUSTOMREQUEST => "GET"  ,
					));
			
						
					$response_modelos = curl_exec($curl_modelos);
					$err = curl_error($curl_modelos);
					curl_close($curl_modelos);

					if ($err) 
					{
				  		$resultado->error = "cURL Error #:" . $err;
					} 
					else 
					{

						$xml_modelos = simplexml_load_string($response_modelos);
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
			$resultado->modelos = $modelos;

			break;

		case 'ObtienePlanes':

		$curl = curl_init();

		$marca = ( $_POST['marca'] == 'Iphone' ) ? "Iphone" : "" ;

		curl_setopt_array($curl, array(
			CURLOPT_PORT => "8020",
			CURLOPT_URL => sprintf("http://smartcen.net:8020/CotizadorControlador.asmx/ObtienePlanesRango?segmento=%s&rango=%s&claseplan=%s",1,$_POST['rango'],$marca),
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET"  ,
			));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {

			$resultado->error = "cURL Error #:" . $err;

		} else {

			$xml = simplexml_load_string($response);
			$planes =array();

			$i = 1;				
			foreach ( $xml->SPS_SCL_ObtenPlanesRango_Result as $planDetalle ) {
				
				// $planDetalle = $detallesPlanRango;



				$planDetalle = str_replace(" ", "%20", $planDetalle->plan );
				$curl = curl_init();

				$url_curl = sprintf( "http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneDetallePlanRango?Plan=%s", $planDetalle );

				curl_setopt_array($curl, array(
					CURLOPT_PORT => "8020",
					CURLOPT_URL => $url_curl,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 300,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "GET"  ,
					));


				$response = curl_exec($curl);
				$err = curl_error($curl);
				curl_close($curl);

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