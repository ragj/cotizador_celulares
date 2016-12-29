<?php
require_once('./Connections/conxx.php');
require_once('./Curl.php');
include_once('./herramientas/utils.php');

 class ModelServices
{
// function __construct()
// {
// 	$this->load->curl('Curl');
// }
public function ObtienePlanes ($MetodoWS,$data)
{

	$datos['segmento'] = $data['segmento'];
	$datos['rango'] = $data['rango'];
	$datos['claseplan']= $data['marca'];

	foreach ($datos as $key => &$value)
	    {
			$value = str_replace(" ", "%20", $value );	
		}
		$keys = array_keys( $datos );
		$valuesGets = implode('=%s&', $keys);
		$valuesGets .= '=%s';

		$url = vsprintf($MetodoWS."?".$valuesGets, $data);
		$curl = new Curl( $url );
		$response = $curl->getResponse();
		$err = $curl->getError();
		$result = new stdClass();
		$curl->closeCurl();	
		if($err)
		{
			$result->exito = false;
			$result->error =  $err;
		}
		else
		{
			$result->exito = true;
			//$result->response = $response;
			$xml = simplexml_load_string($response);
			/*$planes =array();
			$i = 1;	

			foreach ( $xml->SPS_SCL_ObtenPlanesRango_Result as $planDetalle ) 
			{

			}*/
			$resultado = new ModelServices();
			$result =$resultado->ObtieneDetallePlanRango('ObtieneDetallePlanRango',$xml);
			return $result->plan;



		}
		
		
}

public function ObtieneDetallePlanRango ($MetodoWS,$respuesta)
{
	$planes =array();
	$i = 1;	
	foreach ( $respuesta->SPS_SCL_ObtenPlanesRango_Result as $planDetalle )
	{
		$datos["plan"]=$planDetalle->plan;

		foreach ($datos as $key => &$value) {
			$value = str_replace(" ", "%20", $value );	

		}
		$keys = array_keys( $datos );
		$valuesGets = implode('=%s&', $keys);
		$valuesGets .= '=%s';
		$url = vsprintf($MetodoWS."?".$valuesGets, $value);
		$curl = new Curl( $url );
		$responseDetalle = $curl->getResponse();
		$err = $curl->getError();
		$result = new stdClass();
		$curl->closeCurl();	
		if($err)
		{
			$result->exito = false;
			$result->error =  $err;
		}
		else
		{
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
			$resultado->plan = $planes;
			$resultado->exito = true;
			return $resultado;
}


public function ObtieneEquiposRapido ($MetodoWS)//ObtieneMarcasAvanzadoAK
{
		$url = ($MetodoWS);
		$curl = new Curl( $url );
		$responseEquipos = $curl->getResponse();
		$err = $curl->getError();
		$result = new stdClass();
		$curl->closeCurl();	
		if($err)
		{
			$result->exito = false;
			$result->error =  $err;
		}
		else
		{
			$xml= simplexml_load_string($responseEquipos, 'SimpleXMLElement',LIBXML_NOCDATA);
				$array = json_decode(json_encode($xml), TRUE);

				$agrupado = AgruparEquipos($array['SPS_SCL_ObtieneEquipos_Result']);
				$marcas = array();
				$modelos = array();
				$jj = 1;
				foreach ($agrupado as $key => $value) 
				{
					$marca = new stdClass();
	
					$marca->html = '<li class="'.strtolower( str_replace(" ", "_",trim($value['Marca']))).'"><a href="javascript:void(0);"></a></li>';
					$mod = $value['Modelos'];
					array_push($marcas, $marca);
				}
			}

			$resultado->exito = true;
			//$resultado->marcas = $marcas;
			$resultado->marcas = $marcas;
			$resultado->modelos = $mod;

			return $resultado;

}

public function ObtieneCaracteristicasEquipo($MetodoWS,$datos)
{
	print_r($MetodoWS);
	print_r(" antes es el metodo ");
	print_r($datos);
	die();
}




public function inserTarClie ($datos_insert)
 {
 	global $pdo;
 //	$resultado->accion = $_POST['accion'];
$query = $pdo->prepare("INSERT INTO 
										cliente (NombreCliente,ApaternoCliente,AmaternoCliente,CelularCliente,TelefonoFijoCliente,EmailCliente,CalleCliente,NoExteriorCliente,NoInteriorCliente,ColoniaCliente,Del_MunCliente,EstadoCliente,CPcliente) 
										VALUES 
											(:nombre,:apaterno,:amaterno,:tel_cel,:tel_fijo,:email,:calle,:num_ext,:num_int,:colonia,:municipio,:estado,:cp);");

			$query->bindParam( 'nombre', $datos_insert['nombre'] ); 
			$query->bindParam( 'apaterno', $datos_insert['apaterno'] ); 
			$query->bindParam( 'amaterno', $datos_insert['amaterno'] ); 
			$query->bindParam( 'tel_cel', $datos_insert['tel_cel'] ); 
			$query->bindParam( 'tel_fijo', $datos_insert['tel_fijo'] ); 
			$query->bindParam( 'email', $datos_insert['email'] ); 
			$query->bindParam( 'calle', $datos_insert['calle'] ); 
			$query->bindParam( 'num_ext', $datos_insert['num_ext'] ); 
			$query->bindParam( 'num_int', $datos_insert['num_int'] ); 
			$query->bindParam( 'cp', $datos_insert['cp'] ); 
			$query->bindParam( 'colonia', $datos_insert['colonia'] ); 
			$query->bindParam( 'municipio', $datos_insert['municipio'] ); 
			$query->bindParam( 'estado', $datos_insert['estado'] ); 

		$registro = $query->execute();

		return $registro;

 }

public function obtienResultados($MetodoWS,$data)
{

				$datos['nombre'] = $data['nombre'];
				$datos['paterno'] = $data['apaterno'];
				$datos['materno'] = $data['amaterno'];
				$datos['telfijo'] = $data['tel_fijo'];
				$datos['eMail'] = $data['email'];
				$datos['calle'] = $data['calle'];
				$datos['no_Interior'] = $data['num_int'];
				$datos['celular'] = $data['tel_cel'];
				$datos['no_Exterior'] = $data['num_ext'];
				$datos['cp'] = $data['cp'];
				$datos['colonia'] = $data['colonia'];
				$datos['mun'] = $data['municipio'];
				$datos['estado'] = $data['estado'];


	foreach ($datos as $key => &$value)
	    {
			$value = str_replace(" ", "%20", $value );	
		}
				
		$keys = array_keys( $datos );
		$valuesGets = implode('=%s&', $keys);
		$valuesGets .= '=%s';

		$url = vsprintf($MetodoWS."?".$valuesGets, $datos);
		$curl = new Curl( $url );
		$response = $curl->getResponse();
		$err = $curl->getError();
		$result = new stdClass();
		if($err)
		{
			$result->exito = false;
			$result->error =  $err;
		}
		else
		{
			$result->exito = true;
			$result->response = $response;
		}
		$curl->closeCurl();	
		return $result;

}
}