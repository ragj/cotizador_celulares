<?php

function AgruparEquipos ($dato)
{

	$info = grouparray($dato,"Marca");
	$equipo =  array();
	$jj=1;
	$modelos = array();
foreach ($info as $key => $value) 
{
  $marca = array();
  //array_push($marca, $value['Marca']);
  $modelo = grouparray($value['groupeddata'],"Modelo");

 foreach ($modelo as $key => $valueM) 
 { 

  $modelo = new stdClass();
   // $modelo['Modelo'] = $valueM['Modelo'];
  $imagen = ObtenerImagen($valueM['groupeddata']);
  $item = obtenerItem($valueM['groupeddata']);
  $checked = ( $jj == 1 ) ? 'checked="checked"' : '';

    $modelo->html = '<li class="col-md-4 col-sm-6 '.strtolower( str_replace(" ", "_",trim($value['Marca']))).'">
	                                            <span class="prev-phone"><img src="https://smartcen.net:8005/Content/Images/Equipos/'.$imagen.'"></span>
	                                            <span class="nombre-phone">'.$valueM['Modelo'].'</span>
	                                            <input type="radio" name="telefono" value="'.$item.'" '.$checked.'/>
	                                        </li>';
    //$modelo['info'] = $value['groupeddata'];
    array_push($modelos, $modelo);
 }
$marca['Marca'] = $value['Marca'];
$marca['Modelos'] = $modelos;
  array_push($equipo,$marca);
}

return $equipo;
}

function ObtenerImagen($dat)
{
	foreach ($dat as $key => $values) 
	{
		$imagen = $values['Imagen'];
	}
	return $imagen;
}

function obtenerItem ($it)
{
	foreach ($it as $key => $valueItem)
	 {
		$item = $valueItem['No_'];
	}
	return $item;

}

function grouparray($array,$groupkey)
{	

 if (count($array)>0)
 {
 	$keys = array_keys($array[0]);
 	$removekey = array_search($groupkey, $keys);	
 	if ($removekey===false)
 		return array("Clave \"$groupkey\" no existe");
 	else
 		unset($keys[$removekey]);
 	$groupcriteria = array();
 	$return=array();
 	foreach($array as $value)
 	{
 		$item=null;
 		foreach ($keys as $key)
 		{
      $item[$key] = $value[$key];
 		}
 	 	$busca = array_search($value[$groupkey], $groupcriteria);
 		if ($busca === false)
 		{
 			$groupcriteria[]=$value[$groupkey];
 			$return[]=array($groupkey=>$value[$groupkey],'groupeddata'=>array());
 			$busca=count($return)-1;
 		}
 		$return[$busca]['groupeddata'][]=$item;

 	}

 	return $return;
 }
 else
 	return array();
}
?>
