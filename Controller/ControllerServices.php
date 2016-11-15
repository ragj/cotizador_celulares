<?php
include("../Model/ModelServices.php");
$Resul=ObtieneModelosdeMarcasAK("samsung");
echo "pinta resultados ";
print_r($Resul);


//inicia seleccion de plan
function ObtienePlanesRango ($rango,$clasePlan) // busca en WS dependiendo de rango de precio, en caso de ser Iphone debe especificarse
	{
		$retorna =  array();
		$plan = array();
		$detaPlan = array();
		$obtPlanRango =  new ModelServices();
		$obtPlanRango->setSegmento(1);
		$obtPlanRango->setRango($rango);
		$obtPlanRango->setClasePlan($clasePlan);
		$planes = $obtPlanRango->ModelObtienePlanesRango($obtPlanRango);
		$return = ObtieneDetallePlanRango($planes);


		return  $return;
	}
function ObtieneDetallePlanRango ($plan)
	{

	$obtDetallePlan = new ModelServices();
	$obtDetallePlan->setPlan($plan);
	$return = $obtDetallePlan->ModelObtieneDetallePlanRango($obtDetallePlan);
	return $return;
	}
//termina seleccion de plan	
	//inicia seleccion de marcas, en caso de ser iphone se va dierecto por los modelos
function ValidaMarca ($Marca)
{
	if($Marca == "IPHONE")
	{

		$retorna = ObtieneModelosdeMarcasAK($Marca,1);
	}
	else 
	{
		$retorna = ObtieneMarcasAvanzadoAK(1);
	}

	return $retorna;

}
function ObtieneMarcasAvanzadoAK ($tarifario)
	{
		$obtMarcaAvanzadoAK = new ModelServices();
		$obtMarcaAvanzadoAK->setTipoPago(1);
		$obtMarcaAvanzadoAK->setTarifario(1);
		$marcasAK = $obtMarcaAvanzadoAK->ModelObtieneMarcasAvanzadoAK($obtMarcaAvanzadoAK);

		return $marcasAK;
	}
//termina seleccion de marcas distintas a iphone  '70009417' que es un galaxy A5 32bg color negro
  	function ObtieneModelosdeMarcasAK ($Marca)
  	{
  		$obtModeloMarcaAvanzadoAK = new ModelServices();
		$obtModeloMarcaAvanzadoAK->setMarca($Marca);
		$obtModeloMarcaAvanzadoAK->setTarifario(1);
		$marcasModeloAK = $obtModeloMarcaAvanzadoAK->ModelObtieneModelosdeMarcasAK($obtModeloMarcaAvanzadoAK);
		$buscaImagenes = ObtieneEquiposRapido($marcasModeloAK);
	//	$detalleModelo = ObtineDetalleModeloMarcasAK($marcasModeloAK);
		return $marcasModeloAK;
  	}


  	function ObtineDetalleModeloMarcasAK ($Modelo)
  	{	

  		$obtCodModel =  ObtieneEquiposRapido($Modelo);



  		/*$obtDetalleModeMarcaAK = new ModelServices();
  		
  		$memoriaModelo = array();
  		$deta_memo = array();
  		foreach ($Modelo as $mode)
  		{
  		$obtDetalleModeMarcaAK->setModelo($mode);
  		$obtDetalleModeMarcaAK->setTarifario(1);
  		$memoriaModelo["detalle_memoria"] = $obtDetalleModeMarcaAK->ModelObtieneMemoriadeModeloAK($obtDetalleModeMarcaAK);
  		array_push($deta_memo,$memoriaModelo);
  		}
  		print_r($deta_memo);
  		die();

  		$obtDetalleModeMarcaAK->setMemoria($memoriaModelo);
  		$coloresModelo = $obtDetalleModeMarcaAK->ModelObtieneColordeModeloMemoriaAK($obtDetalleModeMarcaAK);
  		$codEquipo = array_column($coloresModelo, "codEquipo");
  		$obtDetalleModeMarcaAK->setcodEquipo($codEquipo);
  		$caracteristicas = $obtDetalleModeMarcaAK->ModelObtieneCaracteristicasBasicas($obtDetalleModeMarcaAK);
  		print_r($obtDetalleModeMarcaAK);
  		die();
  		return $obtDetalleModeMarcaAK;*/
  		
  	}

	function ObtieneEquiposRapido ($busquedaGeneral)
	{

		$busquedaGenerica = new ModelServices();
		$busquedaGenerica->setbusquedaGeneral($busquedaGeneral);
		$busquedaRapida = $busquedaGenerica->ModelObtieneEquiposRapido($busquedaGenerica);
		$buscaImagen = array_column($busquedaRapida, "codEquipo");
		$buscaImagen = ObtieneImagenes($buscaImagen);

	}
  	function ObtieneImagenes ($BusquedaImagen)
  	{
 
  		$obtImagenes = new ModelServices();
  		$obtImagenes->setBuscaImagen($BusquedaImagen);
  		$obtImagenes = $obtImagenes->ModelObtieneImagenes($obtImagenes);
 		return $obtImagenes;
  	}

  	

?>
