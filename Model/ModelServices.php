<?php
class ModelServices
{
	private $segmento;
	private $rango;
	private $clasePlan;
	private $Plan;
	private $tipoPago;
	private $tarifario;
	private $marca;
	private $modelo;
	private $memoria;
	private $codEquipo;
	private $busquedaGeneral;
	private $buscaImagen;
	/*public function _construct($segmento,$rango,$clasePlan)
	{
		$this->segmento = $segmento;
		$this->rango = $rango;
		$this->clasePlan = $clasePlan;
	}*/

	public function getSegmento ()
	{
		return $this->segmento ;
	}
	public function getRango()
	{
		return $this->rango ;
	}
	public function getClasePlan ()
	{
		return $this->clasePlan;
	}
	public function getPlan ()
	{
		return $this->plan ;
	}
	public function getTipoPago ()
	{
		return $this->tipoPago;
	}
	public function getTarifario ()
	{
		return $this->tarifario ;
	}
	public function getMarca ()
	{
		return $this->marca;
	}
	public function getModelo ()
	{
		return $this->modelo; 
	}
	public function getMemoria ()
	{
		return $this->memoria ;
	}
	public function getcodEquipo ()
	{
		return $this->codEquipo ;
	}
	public function getbusquedaGeneral ()
	{
		return $this->busquedaGeneral;
	}
	public function getBuscaImagen ()
	{
		return $this->buscaImagen;
	}
	public function setSegmento ($segmento)
	{
		 $this->segmento = $segmento;
	}
	public function setRango($rango)
	{
		 $this->rango =$rango;
	}
	public function setClasePlan ($clasePlan)
	{
		 $this->clasePlan = $clasePlan;
	}
	public function setPlan ($Plan)
	{
		$this->plan = $Plan;
	}
	public function setTipoPago ($tipoPago)
	{
		$this->tipoPago = $tipoPago;
	}
	public function setTarifario ($tarifario)
	{
		$this->tarifario = $tarifario;
	}
	public function setMarca ($marca)
	{
		$this->marca = $marca;
	}
	public function setModelo ($modelo)
	{
		$this->modelo =$modelo;
	}
	public function setMemoria ($memoria)
	{
		$this->memoria = $memoria;
	}
	public function setcodEquipo ($codEquipo)
	{
		 $this->codEquipo = $codEquipo;
	}
	public function setbusquedaGeneral ($busquedaGeneral)
	{
		$this->busquedaGeneral = $busquedaGeneral;
	}
	public function setBuscaImagen ($buscaImagen)
	{
		$this->buscaImagen = $buscaImagen;
	}

	public function ModelObtienePlanesRango ($ObjServices)
	{	
			
		$curl = curl_init();

		curl_setopt_array($curl, array(
  		CURLOPT_PORT => "8020",
  		CURLOPT_URL => sprintf("http://smartcen.net:8020/CotizadorControlador.asmx/ObtienePlanesRango?segmento=%s&rango=%s&claseplan=%s",$ObjServices->segmento,$ObjServices->rango,$ObjServices->clasePlan),
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
		
  		echo "cURL Error #:" . $err;
	} else {

		$xml = simplexml_load_string($response);
		$plan =array();
		foreach ($xml->SPS_SCL_ObtenPlanesRango_Result as $xmls) {
			array_push($plan, $xmls->plan);
			
		}
		return $plan;	
	}
		
  }

  public function ModelObtieneDetallePlanRango ($ObjServicesRango)
  {
  		$detallesPlanes=array();
  		foreach ($ObjServicesRango->plan as $detallesPlanRango)
  		{

				$planDetalle = $detallesPlanRango;

 				$planDetalle=str_replace(" ", "%20", $planDetalle);
  	 			$curl = curl_init();

				curl_setopt_array($curl, array(
		  		CURLOPT_PORT => "8020",
		  		CURLOPT_URL => sprintf("http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneDetallePlanRango?Plan=%s",$planDetalle),
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
			  		echo "cURL Error #:" . $err;
				} 
					else
					 {
						$xml = simplexml_load_string($response);
						$detallePlan =array();
						foreach ($xml->SPS_SCL_ObtenDetallesPlanRango_Result as $xmls) 
						{
						
						
						$detallePlan["plan"]= $xmls->plan;
						$detallePlan["renta"] = $xmls->Rent;
						$detallePlan["minutos"] = $xmls->Minutos;
						$detallePlan["megas"] = $xmls->Megas;
						$detallePlan["sms"] = $xmls->SMS;
						$detallePlan["numgratis"] = $xmls->NumGratis;
						$detallePlan["codigo_plan"] = $xmls->Code;
						$detallePlan["twitter"] = ($xmls->Twitter== 1)?"Incluido":"No Incluido";
						$detallePlan["facebook"]= ($xmls->Facebook == 1)?"Incluido":"No Incluido";
						$detallePlan["whatsapp"] = ($xmls->Whatsapp == 1)?"Incluido":"No Incluido";
			
						}
			
					}
		array_push($detallesPlanes, $detallePlan);
	}
		return $detallesPlanes;
	
  }

  public function ModelObtieneMarcasAvanzadoAK ($ObjServicesMarcasAvanAK)
  {

  				$curl = curl_init();

				curl_setopt_array($curl, array(
		  		CURLOPT_PORT => "8020",
		  		CURLOPT_URL => sprintf("http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneMarcasAvanzadoAK?tipoPago=%s&tarifario=%s",$ObjServicesMarcasAvanAK->tipoPago,$ObjServicesMarcasAvanAK->tarifario),
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
			  		echo "cURL Error #:" . $err;
				} 
				else 
				{
					$xml = simplexml_load_string($response);
					$marca = array();
					foreach ($xml->SPS_SCL_ItemBrandAK_Result as $xmls) 
					{
						array_push($marca, $xmls->BRAND);
			
			        }
						return $marca;
		        }
  }

public function ModelObtieneModelosdeMarcasAK ($ObjServicesModeloMarcaAK)
{

				$curl = curl_init();

				curl_setopt_array($curl, array(
		  		CURLOPT_PORT => "8020",
		  		CURLOPT_URL => sprintf("http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneModelosdeMarcasAK?Marca=%s&tarifario=%s",$ObjServicesModeloMarcaAK->marca,$ObjServicesModeloMarcaAK->tarifario),
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
			  		echo "cURL Error #:" . $err;
				} 
				else 
				{

					$xml = simplexml_load_string($response);
					$modelo = array();
					foreach ($xml->SPS_SCL_ObtieneEquiposNuevoDataAK_Result as $xmls) 
					{
						array_push($modelo, $xmls->Modelo);
			
			        }
			        
						return $modelo;
		        }
}

public function ModelObtieneMemoriadeModeloAK ($ObjServicesMemoriaAK)
{
		$memoDetalleModel = array();
	foreach ($ObjServicesMemoriaAK->modelo as $model) 
	 {
	
	$modelo=str_replace(" ", "%20", $model);
				$curl = curl_init();

				curl_setopt_array($curl, array(
		  		CURLOPT_PORT => "8020",
		  		CURLOPT_URL => sprintf("http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneMemoriadeModeloAK?Modelo=%s&tarifario=%s",$modelo,$ObjServicesMemoriaAK->tarifario),
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
			  		echo "cURL Error #:" . $err;
				} 
				else 
				{

					$xml = simplexml_load_string($response);
					
					$memoria = array();
					$memo = array();
					foreach ($xml->SPS_SCL_ObtieneMemoriaEquiposNuevoDataAK_Result as $xmls) 
					{

						$memo["memoria_interna"] = $xmls->MemoriaInterna;
						//$memo["modelo"] = $model;
						array_push($memoDetalleModel,$memo);
						//echo "iniica ";
						//print_r($memo);
						//echo "termina ";
			        }
			        $memoDetalleModel["Modelo"] = $model;
			        array_push($memoDetalleModel,$memoria);
						
		        }
		        
		        
		    }//ragj
		    //die();
		    return $memoDetalleModel;

}
public function ModelObtieneColordeModeloMemoriaAK ($ObjServicesColorMemoria)
{

		$detallesColorMemoria=array();
  		foreach ($ObjServicesColorMemoria->memoria as $detallesColorMemo)
  		{
		$modelo=str_replace(" ", "%20", $ObjServicesColorMemoria->modelo);
		$memoria = $detallesColorMemo;

				$curl = curl_init();

				curl_setopt_array($curl, array(
		  		CURLOPT_PORT => "8020",
		  		CURLOPT_URL => sprintf("http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneColordeModeloMemoriaAK?Modelo=%s&Memoria=%s&tarifario=%s",$modelo,$memoria,$ObjServicesColorMemoria->tarifario),
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
			  		echo "cURL Error #:" . $err;
				} 
				else 
				{

					$xml = simplexml_load_string($response);
					$detalleColor = array();
					foreach ($xml->SPS_SCL_ObtieneColoresEquiposNuevoDataAK_Result as $xmls) 
					{
						$detalleColor["color"]= $xmls->Color;
						$detalleColor["codEquipo"] = $xmls->No_;
			
			        }
			        array_push($detallesColorMemoria, $detalleColor);
					
		        }
		    }
		    return $detallesColorMemoria;
 }

 public function ModelObtieneCaracteristicasBasicas ($ObjServicesCaracteristicas)
 {
 		$detallesEqupo = array();
		foreach ($ObjServicesCaracteristicas->codEquipo as $codigo) 
		{
		
 				$curl = curl_init();

				curl_setopt_array($curl, array(
		  		CURLOPT_PORT => "8020",
		  		CURLOPT_URL => sprintf("http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneCaracteristicas?item=%s",$codigo),
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
			  		echo "cURL Error #:" . $err;
				} 
				else 
				{

					$xml = simplexml_load_string($response);
					$detalleEquipo = array();
					foreach ($xml->SPS_SCL_ObtieneCaracteristicas_Result as $xmls) 
					{
						$detalleEquipo["codEquipo"]= $xmls->no_;
						$detalleEquipo["description"] = $xmls->description;
						$detalleEquipo["camara"] = $xmls->camera;
						$detalleEquipo["Operating_System"] = $xmls->Operating_System;
						$detalleEquipo["Technology"] = $xmls->Technology;
						$detalleEquipo["Internal_Memory"] = $xmls->Internal_Memory;
						$detalleEquipo["External_Memory"] = $xmls->External_Memory;
						$detalleEquipo["Multiple_Sim"] = ($xmls->Multiple_Sim == 0)? "Solo Una Sim":"Multiple Sim";
			
			        }
			        array_push($detallesEqupo, $detalleEquipo);
					
		        }
		        return $detallesEqupo;
		    }
		}

public function ModelObtieneEquiposRapido ($ObjServicesEquipoRapido)
{
				$busqueda = array();	
				foreach ($ObjServicesEquipoRapido->busquedaGeneral as $busca) 
				{

				$busca=str_replace(" ", "%20", $busca);
 				$curl = curl_init();

				curl_setopt_array($curl, array(
		  		CURLOPT_PORT => "8020",
		  		CURLOPT_URL => sprintf("http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneEquiposRapido?Variable=%s",$busca),
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
			  		echo "cURL Error #:" . $err;
				} 
				else 
				{

					$xml = simplexml_load_string($response);
					
					$busquedaRapida = array();
					
						
					foreach ($xml->SPS_SCL_ObtieneBusquedaRapidaEquipos_Result as $xmls) 
					    {
					    	
						$busquedaRapida["Equipos"]= $xmls->Equipos;
						$busquedaRapida["Tipo"] = $xmls->Tipo;
						$busquedaRapida["codEquipo"] = $xmls->Item;
						
			             }
					array_push($busqueda,$busquedaRapida);
			             //return $busqueda;
			         }
			         
			     }
			    
		    return $busqueda;
}

public function ModelObtieneImagenes ($ObjServicesImagenes)
{


	$buscaImagenes = array();
		foreach ($ObjServicesImagenes->buscaImagen as $codigo) 
		{

 				$curl = curl_init();

				curl_setopt_array($curl, array(
		  		CURLOPT_PORT => "8020",
		  		CURLOPT_URL => sprintf("http://smartcen.net:8020/CotizadorControlador.asmx/ObtieneImagenes?item=%s",$codigo),
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
			  		echo "cURL Error #:" . $err;
				} 
				else 
				{

					$xml = simplexml_load_string($response);
					$detalleImag = array();
					$detaIMG = array();
					foreach ($xml->SPS_SCL_ObtieneImagenes_Result as $xmls) 
					{

						$detalleImag["IdImagen"]= $xmls->IdImagen;
						$detalleImag["Imagen"] = $xmls->Imagen;
						$detalleImag["codEquipo"] = $xmls->Item;
						$detalleImag["Estatus"] = $xmls->Estatus;
						//array_push($buscaImagenes, $detalleImag);
			
			        }
			        $detaIMG['Imagenes'] = $detalleImag;
			        array_push($buscaImagenes, $detaIMG);
			        
					
		        }
		        
		    }
		   return $buscaImagenes;
}


}

?>