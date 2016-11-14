<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Cotizador Cencel</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/7.0.2/css/bootstrap-slider.min.css">
    <link href="css/lightgallery.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://use.fontawesome.com/d9394ef45b.js"></script>
  </head>
  <body>
    <div id="wrapper">
    	<div class="container-fluid">
            <div class="row header">
                <ul>
                    <li class="slide-1"></li>
                    <li class="slide-2"></li>
                    <li class="slide-3"></li>
                </ul>
            </div>
    		<div class="row titulo">
    			<div class="col-lg-8 col-lg-offset-2">
    				<h1>Cotiza un plan a tu medida</h1>
    				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
    			</div>
    		</div>
    		<!-- Barra de avance -->
    		<div class="row barra">
    			<div class="col-lg-8 col-lg-offset-2">
    				<input id="slider-pasos" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="7" data-slider-step="1" data-slider-value="1" data-slider-handle="round"/>
    			</div>
    		</div>
    		<!-- Título paso actual -->
    		<div class="row numpaso">
    			<div class="col-lg-8 col-lg-offset-2">
	    			<h2 class="step-1">
	    				<span>1</span>
	    				Selecciona el plan que buscas
	    			</h2>
                    <h2 class="step-2">
                        <span>2</span>
                        Dinos cuál es tu presupuesto y selecciona un plan
                    </h2>
                    <h2 class="step-3">
                        <span>3</span>
                        Selecciona la marca y equipo de preferencia
                    </h2>
                    <h2 class="step-4">
                        <span>4</span>
                        Escoge el color y capacidad de tu equipo
                    </h2>
                    <h2 class="step-5">
                        <span>5</span>
                        Tu tipo de contrato es ...
                    </h2>
                    <h2 class="step-6">
                        <span>6</span>
                        Regálanos tus datos
                    </h2>
                    <h2 class="step-7">
                        <span>7</span>
                        ¡Éxito!
                    </h2>
	    		</div>
    		</div>
    		<!-- Sección principal -->
    		<div class="row contenedor" id="contenedor">
                <div class="size col-md-6" id="size-1"></div>
                <div class="size col-md-10" id="size-2"></div>

    			<div class="col-md-6 col-md-offset-3">
    				<ul>
                        <!-- Paso Uno -->
    					<li class="step step-1" id="step-1">
                            <div class="col-md-4 col-md-offset-1">
                                <p>Los <b>mejores smartsphones</b> <br> del mercado a tu alcance</p>
                                <a class="image" href="javascript:void(0);" data-step="1">
                                    <img src="img/tel_android.png">
                                </a>
                                <a class="button" href="javascript:void(0);" data-step="1">
                                    Seleccionar 
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div class="col-md-4 col-md-offset-2">
                                <p>Los <b>iPhone de tus sueños</b> <br> está aquí</p>
                                <a class="image" href="javascript:void(0);" data-step="1">
                                    <img src="img/tel_iphone.png">
                                </a>
                                <a class="button" href="javascript:void(0);" data-step="1">
                                    Seleccionar 
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>
                        <!-- Paso dos -->
    					<li class="step step-2" id="step-2">
                            <div class="col-md-10 col-md-offset-1">
                                <p><b>Selecciona en la barra</b> tu presupuesto y te <b> mostraremos los mejores planes </b> que se adapten a él </p>

                                <div class="presupuesto col-md-12">
                                    <input id="slider-presupuesto" data-slider-id='ex2Slider' type="text" data-slider-min="0" data-slider-max="1500" data-slider-step="100" data-slider-value="300" data-slider-handle="round"/>
                                </div>
                                <div class="planes col-md-12">
                                    <div class="detalle-planes">
                                        <!-- Encabezados -->
                                        <div class="header titulo-plan"></div>
                                        <div class="header minutos">Minutos incluidos</div>
                                        <div class="header mensajes">SMS incluidos</div>
                                        <div class="header internet">Internet</div>
                                        <div class="header redes">Redes sociales</div>
                                        <div class="header radio"></div>
                                        <div class="clear"></div>
                                        <!-- Filas -->
                                        <div class="row-cell">
                                            <div class="cell titulo-plan"> Mixto 3000</div>
                                            <div class="cell minutos">Ilimitado</div>
                                            <div class="cell mensajes">Ilimitado</div>
                                            <div class="cell internet">3000 MB</div>
                                            <div class="cell redes"> <span class="check"></span> </div>
                                            <div class="cell radio"> <input type="radio" name="plan" value="1" checked="checked"> </div>
                                        </div>
                                        <div class="row-cell">
                                            <div class="cell titulo-plan"> Mixto 2000</div>
                                            <div class="cell minutos">Ilimitado</div>
                                            <div class="cell mensajes">Ilimitado</div>
                                            <div class="cell internet">2000 MB</div>
                                            <div class="cell redes"> </div>
                                            <div class="cell radio"> <input type="radio" name="plan" value="2"> </div>
                                        </div>
                                        <div class="row-cell">
                                            <div class="cell titulo-plan"> Mixto 3000</div>
                                            <div class="cell minutos">Ilimitado</div>
                                            <div class="cell mensajes">Ilimitado</div>
                                            <div class="cell internet">3000 MB</div>
                                            <div class="cell redes"> <span class="check"></span> </div>
                                            <div class="cell radio"> <input type="radio" name="plan" value="3"> </div>
                                        </div>
                                        <div class="row-cell">
                                            <div class="cell titulo-plan"> Mixto 2000</div>
                                            <div class="cell minutos">Ilimitado</div>
                                            <div class="cell mensajes">Ilimitado</div>
                                            <div class="cell internet">2000 MB</div>
                                            <div class="cell redes"> <span class="check"></span> </div>
                                            <div class="cell radio"> <input type="radio" name="plan" value="4"> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttons col-md-12">
                                    <a class="button back" href="javascript:void(0);" data-step="0">
<i class="fa fa-angle-double-left" aria-hidden="true"></i> Regresar </a>
                                    <a class="button" href="javascript:void(0);" data-step="2">Continuar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </li>
    					<li class="step step-3" id="step-3">
                            <div class="col-md-10 col-md-offset-1">
                                <p>Tenemos <b>las mejores marcas de smartphones</b> para ti </p>
                            
                                <div class="marcas">
                                    <ul>
                                        <li class="lanix"><a href="javascript:void(0);"></a></li>
                                        <li class="samsung"><a href="javascript:void(0);"></a></li>
                                        <li class="azumi"><a href="javascript:void(0);"></a></li>
                                        <li class="lg"><a href="javascript:void(0);"></a></li>
                                        <li class="sony"><a href="javascript:void(0);"></a></li>
                                        <li class="huawei"><a href="javascript:void(0);"></a></li>
                                        <li class="htc"><a href="javascript:void(0);"></a></li>
                                        <li class="zte"><a href="javascript:void(0);"></a></li>
                                    </ul>
                                </div>
                                <div class="phones">
                                    <ul>
                                        <li class="col-md-4">
                                            <span class="prev-phone"><img src="img/tel_img_no_disponible.png"></span>
                                            <span class="nombre-phone">Nombre teléfono 1</span>
                                            <input type="radio" name="telefono" value="1"/>
                                        </li>
                                        <li class="col-md-4">
                                            <span class="prev-phone"><img src="img/tel_img_no_disponible.png"></span>
                                            <span class="nombre-phone">Nombre teléfono 2</span>
                                            <input type="radio" name="telefono" value="2"/>
                                        </li>
                                        <li class="col-md-4">
                                            <span class="prev-phone"><img src="img/tel_img_no_disponible.png"></span>
                                            <span class="nombre-phone">Nombre teléfono 3</span>
                                            <input type="radio" name="telefono" value="3"/>
                                        </li>
                                        <li class="col-md-4">
                                            <span class="prev-phone"><img src="img/tel_img_no_disponible.png"></span>
                                            <span class="nombre-phone">Nombre teléfono 4</span>
                                            <input type="radio" name="telefono" value="4"/>
                                        </li>
                                        <li class="col-md-4">
                                            <span class="prev-phone"><img src="img/tel_img_no_disponible.png"></span>
                                            <span class="nombre-phone">Nombre teléfono 5</span>
                                            <input type="radio" name="telefono" value="5"/>
                                        </li>
                                        <li class="col-md-4">
                                            <span class="prev-phone"><img src="img/tel_img_no_disponible.png"></span>
                                            <span class="nombre-phone">Nombre teléfono 6</span>
                                            <input type="radio" name="telefono" value="6"/>
                                        </li>
                                        <li class="col-md-4">
                                            <span class="prev-phone"><img src="img/tel_img_no_disponible.png"></span>
                                            <span class="nombre-phone">Nombre teléfono 4</span>
                                            <input type="radio" name="telefono" value="4"/>
                                        </li>
                                        <li class="col-md-4">
                                            <span class="prev-phone"><img src="img/tel_img_no_disponible.png"></span>
                                            <span class="nombre-phone">Nombre teléfono 5</span>
                                            <input type="radio" name="telefono" value="5"/>
                                        </li>
                                        <li class="col-md-4">
                                            <span class="prev-phone"><img src="img/tel_img_no_disponible.png"></span>
                                            <span class="nombre-phone">Nombre teléfono 6</span>
                                            <input type="radio" name="telefono" value="6"/>
                                        </li>
                                    </ul>
                                </div>
                                <div class="buttons col-md-12">
                                    <a class="button back" href="javascript:void(0);" data-step="1">
    <i class="fa fa-angle-double-left" aria-hidden="true"></i> Regresar </a>
                                    <a class="button" href="javascript:void(0);" data-step="3">Continuar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </li>
    					<li class="step step-4" id="step-4"></li>
    					<li class="step step-5" id="step-5"></li>
    					<li class="step step-6" id="step-6"></li>
    					<li class="step step-7" id="step-7"></li>
    				</ul>
    			</div>
    		</div>

            <!-- Banner de promociones --> 
            <div class="row banners" id="banners">
                <ul>
                    <li class="col-md-4 banner-1"><a href="img/promos/promo1.jpg"></a></li>
                    <li class="col-md-4 banner-2 active"><a href="img/promos/promo2.jpg"></a></li>
                    <li class="col-md-4 banner-3"><a href="img/promos/promo3.jpg"></a></li>
                    <li class="col-md-4 banner-4"><a href="img/promos/promo4.jpg"></a></li>
                    <li class="col-md-4 banner-5"><a href="img/promos/promo5.jpg"></a></li>
                    <li class="col-md-4 banner-6"><a href="img/promos/promo6.jpg"></a></li>
                </ul>
                <a href="javascript:void(0);" class="prev-banner"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
                <a href="javascript:void(0);" class="next-banner"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            </div>

    		<!-- Suscríbete al newsletter -->
    		<div class="row newsletter">
    			<div class="col-md-8 col-md-offset-2">
    				<div class="col-md-6">
    					<h2>¡Suscríbete a nuestro Newsletter y recibe ofertas especiales!</h2>
    				</div>
    				<div class="col-md-6">
    					<form id="newsletter">
    						<input type="text" name="email"/>
    						<input type="submit" name="enviar" value="Enviar">
    					</form>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/7.0.2/bootstrap-slider.min.js"></script>
    <script src="js/lightgallery.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>