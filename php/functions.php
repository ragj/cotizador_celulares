<?php
require_once(__DIR__ . '/Curl.php');
include_once(__DIR__ . '/conxx.php' );

$resultado = new stdClass();

if( !empty( $_POST) ){

	switch ( $_POST['accion'] ) {

		case 'registrar':
			
			$resultado->accion = $_POST['accion'];


			$query = $pdo->prepare("INSERT INTO 
										cliente (NombreCliente,ApaternoCliente,AmaternoCliente,CelularCliente,TelefonoFijoCliente,EmailCliente,CalleCliente,NoExteriorCliente,NoInteriorCliente,ColoniaCliente,Del_MunCliente,EstadoCliente,CPcliente) 
										VALUES 
											(:nombre,:apaterno,:amaterno,:tel_cel,:tel_fijo,:email,:calle,:num_ext,:num_int,:colonia,:municipio,:estado,:cp);");

			$query->bindParam( 'nombre', $_POST['nombre'] ); 
			$query->bindParam( 'apaterno', $_POST['apaterno'] ); 
			$query->bindParam( 'amaterno', $_POST['amaterno'] ); 
			$query->bindParam( 'tel_cel', $_POST['tel_cel'] ); 
			$query->bindParam( 'tel_fijo', $_POST['tel_fijo'] ); 
			$query->bindParam( 'email', $_POST['email'] ); 
			$query->bindParam( 'calle', $_POST['calle'] ); 
			$query->bindParam( 'num_ext', $_POST['num_ext'] ); 
			$query->bindParam( 'num_int', $_POST['num_int'] ); 
			$query->bindParam( 'cp', $_POST['cp'] ); 
			$query->bindParam( 'colonia', $_POST['colonia'] ); 
			$query->bindParam( 'municipio', $_POST['municipio'] ); 
			$query->bindParam( 'estado', $_POST['estado'] ); 

			if( $registro = $query->execute() ){
				$resultado->exito = true;
				$resultado->folio = $pdo->lastInsertId();

				$datos['nombre'] = $_POST['nombre'];
				$datos['paterno'] = $_POST['apaterno'];
				$datos['materno'] = $_POST['amaterno'];
				$datos['telfijo'] = $_POST['tel_fijo'];
				$datos['eMail'] = $_POST['email'];
				$datos['calle'] = $_POST['calle'];
				$datos['no_Interior'] = $_POST['num_int'];
				$datos['celular'] = $_POST['tel_cel'];
				$datos['no_Exterior'] = $_POST['num_ext'];
				$datos['cp'] = $_POST['cp'];
				$datos['colonia'] = $_POST['colonia'];
				$datos['mun'] = $_POST['municipio'];
				$datos['estado'] = $_POST['estado'];
				
				$responseGenera = obtienResultados( 'GeneraCliente', $datos);
				$response = simplexml_load_string($responseGenera->response);
				$resultado->no_cliente = $response->SPI_DAT_GeneraClienteCot_Result->ID_CLIENTE;

				if( $response ){
					//sprintf(http://smartcen.net:8020/CotizadorControlador.asmx/GeneraData?id_Cliente=?'%s'&tipoTramiteN1='%s'&plan='%s'&itemIMEI='%s'&ubicacion=CENTMK,)
					$data['id_Cliente'] = $resultado->no_cliente;
					$data['tipoTramiteN1'] = $_POST['tramite'];
					$data['plan'] = $_POST['plan'];
					$data['itemIMEI'] = $_POST['item'];
					$data['ubicacion'] = 'CENTMK';
					$responseTramite = obtienResultados( 'GeneraData', $data);
					if( $responseTramite->exito ){
						$response_tramite = simplexml_load_string($responseTramite->response);
						$resultado->tramite = $response_tramite;
					}else{
						$resultado->error = $responseTramite->error;
					}
					

				}else{

				}


			}else{
				$resultado->exito = false;
				$resultado->error = $pdo->errorInfo();
			}

			break;

		case 'ObtieneResultadosBusqueda':

			$url = sprintf( "http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneResultadosBusqueda?plan=%s&equipo=%s", str_replace(" ", "%20", $_POST['plan']), $_POST['item'] );
			$busquedaUrl = new Curl( $url );
				
			$responseBusqueda = $busquedaUrl->getResponse();
			$err = $busquedaUrl->getError();
			$busquedaUrl->closeCurl();
			$resultadosBusqueda = simplexml_load_string($responseBusqueda);
			$resultado->resultados = $resultadosBusqueda;
			
			if( $resultadosBusqueda ){
				$resultado->exito = true;
				$resultado->html = '<div class="header">Código</div>
                                    <div class="header">Plazo</div>
                                    <div class="header">Diferencia</div>
                                    <div class="header">Renta</div>
                                    <div class="header"></div>
                                    <div class="clear"></div>';
			}

			$i = 0;
			foreach ($resultadosBusqueda->SPS_SCL_DiferenciasEquipo_Result as $plan) {
				$checked = ($i == 0) ? 'checked="checked"' : '';
				$resultado->html .= ' 	<div class="row-cell">
	                                        <div class="cell">'.$plan->Code.'</div>
	                                        <div class="cell">'.$plan->PLAZO.'</div>
	                                        <div class="cell">$'.$plan->DIFERENCIA_A_PAGAR.'</div>
	                                        <div class="cell">$'.$plan->RENTA.'</div>
	                                        <div class="cell"><input type="radio" class="plan" name="tipo-plan" value="'.$plan->Code.'" ' . $checked . ' ></div>
	                                    </div>';
	            $i++;
			}

			break;

		case 'ObtieneColordeModeloMemoriaAK':

			//http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneColordeModeloMemoriaAK?Modelo=galaxy%20A5&memoria=32&tarifario=1
			$url = sprintf( "http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneColordeModeloMemoriaAK?Modelo=%s&memoria=%s&tarifario=1", str_replace(" ", "%20", $_POST['modelo']), $_POST['memoria'] );
			$variantes_equipo = new Curl( $url );
				
			$responseVariantes = $variantes_equipo->getResponse();
			$err = $variantes_equipo->getError();
			$variantes_equipo->closeCurl();
			$variantes = simplexml_load_string($responseVariantes);
			$resultado->variantes = $variantes;

			if ( $variantes ){
				$resultado->html = '<div class="color">
				                        <p>Color</p>';
				$resultado->exito = $variantes;
				foreach ($variantes->SPS_SCL_ObtieneColoresEquiposNuevoDataAK_Result as $variante) {
					$resultado->html .= '<input type="radio" class="variante" data-variante="'.  strtolower( str_replace( " ", "-", $variante->Color ) ) .'" name="variante" value="'.$variante->No_.'"> <label> '.$variante->Color.' </label> ';
				}

				$resultado->html .= '</div>';
			}

			

			break;

		case 'ObtieneCaracteristicasEquipo':


			$url = sprintf( "http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneCaracteristicas?item=%s", $_POST['item'] );
			$detalle_equipo = new Curl( $url );
				
			$responseDetalle = $detalle_equipo->getResponse();
			$err = $detalle_equipo->getError();
			$detalle_equipo->closeCurl();
			$resultado->url = $url;
			

			if ($err) 
			{
				$resultado->exito = false;
				$resultado->error = "cURL Error #:" . $err;
			} 
			else 
			{
				$detalle = simplexml_load_string($responseDetalle);
				$internal_memory = $detalle->SPS_SCL_ObtieneCaracteristicas_Result->Internal_Memory;
				$multiple_sim = $detalle->SPS_SCL_ObtieneCaracteristicas_Result->Multiple_Sim;
				$operating_system = $detalle->SPS_SCL_ObtieneCaracteristicas_Result->Operating_System;
				$technology = $detalle->SPS_SCL_ObtieneCaracteristicas_Result->Technology;
				$camera = $detalle->SPS_SCL_ObtieneCaracteristicas_Result->camera;
				$description = $detalle->SPS_SCL_ObtieneCaracteristicas_Result->description;

				$resultado->detalle = $detalle;
				$resultado->url = $url;


				$url_capacidades = sprintf( "http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneMemoriadeModeloAK?Modelo=%s&tarifario=1", str_replace( " ", "%20", $_POST['nombre'] ) );
				$capacidad_equipo = new Curl( $url_capacidades );
					
				$responseCapacidad = $capacidad_equipo->getResponse();
				$err = $capacidad_equipo->getError();
				$capacidad_equipo->closeCurl();
				$capacidad = simplexml_load_string($responseCapacidad);
				$inputs = '';

				foreach ($capacidad->SPS_SCL_ObtieneMemoriaEquiposNuevoDataAK_Result as $capacidad) {
					$inputs .= '<input type="radio" class="capacidad" name="capacidad[]" value="'.$capacidad->MemoriaInterna.'"> <label> '.$capacidad->MemoriaInterna.' GB </label>';
				}

				$resultado->html = '	<div class="phone-nombre">'.$_POST['nombre'].'</div>
					                    <div class="phone-sos">
					                        <span><b>Cámara Trasera: </b> '.$camera.' megapixeles</span>
					                        <span><b>Tecnología: </b> '.$technology.'</span>
					                        <span><b>Sistema Operativo: </b> '.$operating_system.'</span>
					                    </div>
					                    <div class="capacidad">
					                        <p>Capacidad</p>
					                        '.$inputs.'
					                    </div>';
		        $resultado->imagen = $_POST['imagen'];
		        $resultado->exito = true;
		     }

			break;
		
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
								$imagen = $xml_imagen->SPS_SCL_ObtieneImagenes_Result->Imagen;
								$modelo->detalle = $imagen;

								$modelo->html = '<li style="display:'.$display.'" class="col-md-4 col-sm-6 '.strtolower( $xmls->BRAND ).'">
	                                            <span class="prev-phone"><img src="https://smartcen.net:8005/Content/Images/Equipos/'.$imagen.'"></span>
	                                            <span class="nombre-phone">'.$xmls_modelo->Modelo.'</span>
	                                            <input type="radio" name="telefono" value="'.$item.'" '.$checked.'/>
	                                        </li>';
							}					
						
							
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

	function obtienResultados( $method, $data = [] )
	{
		foreach ($data as $key => &$value) {
			$value = str_replace(" ", "%20", $value );	
		}

		$keys = array_keys( $data );
		$valuesGets = implode('=%s&', $keys);
		$valuesGets .= '=%s';
		
		$url = vsprintf( "http://smartcen.net:8020/CotizadorControlador.asmx/".$method."?" . $valuesGets, $data ); 

		$curl = new Curl( $url );
		$response = $curl->getResponse();
		$err = $curl->getError();
		$result = new stdClass();
		if($err){
			$result->exito = false;
			$result->error =  $err;
		}else{
			$result->exito = true;
			$result->response = $response;
		}
		$curl->closeCurl();	
		return $result;
	}

	header('Content-type: text/json');
	echo json_encode($resultado); 