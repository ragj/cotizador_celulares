<?php
include_once(__DIR__ ."/Model/modelServices.php");
include_once(__DIR__."/herramientas/utils.php");

$resultado = new stdClass();
if( !empty( $_POST) )
{
	//inicia switch
	switch ( $_POST['accion'] ) 
	{
		case 'ObtienePlanes':

		$obPlanes = array();
		if($_POST['marca'] == 'Iphone')
		{
			$obPlanes['segmento'] = 1;
			$obPlanes['rango']=1;
			$obPlanes['marca'] = 'Iphone';
			
		}
		else
		{
			$obPlanes['segmento'] = 1;
			$obPlanes['rango']=1;
			$obPlanes['marca']= " ";
		}

		$marcas = new ModelServices();
		$planes = $marcas->ObtienePlanes('ObtienePlanesRango',$obPlanes);

		// lo que viene abajo se debe borrar
		if(!empty($planes))
		{
			$resultado->plan = $planes;
			$resultado->exito = true;
			
		}
		else
		{
		$resultado->exito = false;
		}
		break;

	case 'ObtieneEquiposRapido':	

		$obEquipoRapido = new ModelServices();
		$obEquiRapi = $obEquipoRapido->ObtieneEquiposRapido('ObtieneEquiposRango');
		if(!empty($obEquiRapi))
		{
			
			$resultado->marcas = $obEquiRapi->marcas;
			$resultado->modelos = $obEquiRapi->modelos;
			$resultado->exito = true;
		}
		else 
		{
			$resultado->exito= false;
		}
		break;

		case 'ObtieneCaracteristicasEquipo':

			$ObtCaracteristicas = new ModelServices();
			$detallesEquipos = $ObtCaracteristicas->ObtieneCaracteristicasEquipo("ObtieneCaracteristicas",$_POST['item']);
//aqui termina la primera parte de este case
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

				$k = 1;
				foreach ($capacidad->SPS_SCL_ObtieneMemoriaEquiposNuevoDataAK_Result as $capacidad) {
					$inputs .= '<input type="radio" class="capacidad" id="capacidad-' . $k . '" name="capacidad[]" value="'.$capacidad->MemoriaInterna.'"> 
								<label class="datos" for="capacidad-' . $k . '"><span>' . $capacidad->MemoriaInterna . '</span> GB </label>';
					$k++;
				}

				$resultado->html = '	<div class="phone-nombre">'.$_POST['nombre'].'</div>
					                    <div class="phone-sos">
					                        <span><b>Cámara Trasera: </b> '.$camera.' megapixeles</span>
					                        <span><b>Tecnología: </b> '.$technology.'</span>
					                        <span><b>Sistema Operativo: </b> '.$operating_system.'</span>
					                    </div>
					                    <div class="capacidad col-xs-4">
					                        <p>Capacidad</p>
					                        '.$inputs.'
					                    </div>';
		        $resultado->imagen = $_POST['imagen'];
		        $resultado->exito = true;
		     }

			break;

	}
	// finaliza el switch
}
else
{
	$resultado->exito = false;
}
header('Content-type: text/json');
	echo json_encode($resultado); 
?>