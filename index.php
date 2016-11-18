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
  <body data-marca="">
    <div id="wrapper">
    	<div class="container-fluid">
            <div class="row header">
                <ul>
                    <li class="slide-1"></li>
                    <li class="slide-2"></li>
                    <li class="slide-3"></li>
                </ul>
            </div>

            <div class="row intro">
                <div class="col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1">
                    <h1>¡Bienvenido a Cencel!</h1>
                    <p>La manera más fácil de cotizar tu smartphone con TELCEL</p>
                    <a class="button" href="javascript:void(0);">
                        Comenzar 
                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                    </a>
                </div>
            </div>

    		<div class="row titulo">
    			<div class="col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1">
    				<h1>Cotiza un plan a tu medida</h1>
    				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
    			</div>
    		</div>
    		<!-- Barra de avance -->
    		<div class="row barra">
    			<div class="col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1">
    				<input id="slider-pasos" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="7" data-slider-step="1" data-slider-value="1" data-slider-handle="round"/>
    			</div>
    		</div>
    		<!-- Título paso actual -->
    		<div class="row numpaso">
    			<div class="col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1">
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
                <div class="size col-md-6 col-sm-10" id="size-1"></div>
                <div class="size col-md-10 col-sm-10" id="size-2"></div>
                <div class="size col-md-8 col-sm-10" id="size-3"></div>

    			<div class="col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1">
    				<ul>
                        <!-- Paso Uno -->
    					<li class="step step-1" id="step-1">
                            <div class="col-md-4 col-md-offset-1 col-sm-6">
                                <p>Los <b>mejores smartsphones</b> <br> del mercado a tu alcance</p>
                                <a class="image" href="javascript:void(0);" data-step="1" data-marca="Android" data-reload="1">
                                    <img src="img/tel_android.png">
                                </a>
                                <a class="button" href="javascript:void(0);" data-step="1" data-marca="Android" data-reload="1">
                                    Seleccionar 
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                </a>
                            </div>
                            <div class="col-md-4 col-md-offset-2 col-sm-6">
                                <p>Los <b>iPhone de tus sueños</b> <br> está aquí</p>
                                <a class="image" href="javascript:void(0);" data-step="1" data-marca="Iphone" data-reload="1">
                                    <img src="img/tel_iphone.png">
                                </a>
                                <a class="button" href="javascript:void(0);" data-step="1" data-marca="Iphone" data-reload="1">
                                    Seleccionar 
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>
                        <!-- Paso dos -->
    					<li class="step step-2" id="step-2">
                            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                                <p><b>Selecciona en la barra</b> tu presupuesto y te <b> mostraremos los mejores planes </b> que se adapten a él </p>

                                <div class="presupuesto col-md-12">
                                    <input id="slider-presupuesto" data-slider-id='ex2Slider' type="text" data-slider-min="0" data-slider-max="1500" data-slider-step="100" data-slider-value="300" data-slider-handle="round"/>
                                </div>
                                <div class="planes col-md-12">
                                    <!-- Encabezados -->
                                    <div class="header titulo-plan"></div>
                                    <div class="header minutos">Minutos incluidos</div>
                                    <div class="header mensajes">SMS incluidos</div>
                                    <div class="header internet">Internet</div>
                                    <div class="header redes">Redes sociales</div>
                                    <div class="header radio"></div>
                                    <div class="clear"></div>
                                    <div class="detalle-planes">
                                        <!-- Filas -->
                                        
                                    </div>
                                </div>
                                <div class="buttons col-md-12 col-sm-12">
                                    <a class="button back" href="javascript:void(0);" data-step="0">
<i class="fa fa-angle-double-left" aria-hidden="true"></i> Regresar </a>
                                    <a class="button" href="javascript:void(0);" data-step="2">Continuar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </li>
    					<li class="step step-3" id="step-3">
                            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                                <p>Tenemos <b>las mejores marcas de smartphones</b> para ti </p>
                            
                                <div class="marcas">
                                    <ul>
                                        
                                    </ul>
                                </div>
                                <div class="phones">
                                    <ul>
                                        
                                    </ul>
                                </div>
                                <div class="buttons col-md-12 col-sm-12">
                                    <a class="button back" href="javascript:void(0);" data-step="1">
    <i class="fa fa-angle-double-left" aria-hidden="true"></i> Regresar </a>
                                    <a class="button" href="javascript:void(0);" data-step="3">Continuar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </li>
    					<li class="step step-4" id="step-4">
                            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                                <div class="col-md-5 col-sm-5">
                                    <div class="phone-image col-md-12">
                                        <img src="img/tel_img_no_disponible.png"/>
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-7">
                                    <!-- Detalles del teléfono -->
                                    <div class="phone-details col-md-12">
                                        <div class="phone-nombre">Samsung Galaxy S7</div>

                                        <div class="phone-sos">
                                            <span><b>Memoria externa: </b> Expandible hasta 64GB</span>
                                            <span><b>Cámara Trasera: </b> 16 megapixeles</span>
                                            <span><b>Tecnología: </b> LTE</span>
                                            <span><b>Sistema Operativo: </b> Android</span>
                                        </div>
                                        <div class="color">
                                            <p>Color</p>
                                            <span class="black"></span>
                                            <span class="white"></span>
                                            <span class="gold"></span>
                                            <span class="silver"></span>
                                            <span class="pink"></span>
                                        </div>
                                        <div class="capacidad">
                                            <p>Capacidad</p>
                                            <span><span>32</span> Gb</span>
                                            <span class="active"><span>64</span> Gb</span>
                                        </div>

                                        <div class="buttons col-md-12">
                                            <a class="button back" href="javascript:void(0);" data-step="2">
            <i class="fa fa-angle-double-left" aria-hidden="true"></i> Regresar </a>
                                            <a class="button interno" href="javascript:void(0);" data-step="4">Continuar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>

                                    <!-- Detalle de plan y teléfono -->
                                    <div class="phone-plan col-md-12">
                                        <div class="phone-nombre">Samsung Galaxy S7</div>
                                        <div class="phone-resumen">
                                            <div class="color">
                                                <span>Color </span> 
                                                <span class="color silver"></span>
                                            </div>
                                            <div class="capacidad">
                                                <span>Capacidad </span> 
                                                <span class="datos"><span>64</span> Gb</span>
                                            </div>
                                            <div class="plan"></div>
                                            <div class="clear"></div>
                                            <div class="plan-details">
                                                <div class="header">Código</div>
                                                <div class="header">Plazo</div>
                                                <div class="header">Diferencia</div>
                                                <div class="header">Renta</div>
                                                <div class="header"></div>
                                                <div class="clear"></div>
                                                <div class="row-cell">
                                                    <div class="cell">S4984</div>
                                                    <div class="cell">12 Meses</div>
                                                    <div class="cell">$4093</div>
                                                    <div class="cell">$599</div>
                                                    <div class="cell"><input type="radio" name="tipo-plan" value="1"></div>
                                                </div>
                                                <div class="row-cell">
                                                    <div class="cell">S4984</div>
                                                    <div class="cell">12 Meses</div>
                                                    <div class="cell">$4093</div>
                                                    <div class="cell">$599</div>
                                                    <div class="cell"><input type="radio" name="tipo-plan" value="2"></div>
                                                </div>
                                                <div class="row-cell">
                                                    <div class="cell">S4984</div>
                                                    <div class="cell">12 Meses</div>
                                                    <div class="cell">$4093</div>
                                                    <div class="cell">$599</div>
                                                    <div class="cell"><input type="radio" name="tipo-plan" value="3"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="buttons col-md-12 col-sm-12">
                                            <a class="button back interno" href="javascript:void(0);" data-step="2">
            <i class="fa fa-angle-double-left" aria-hidden="true"></i> Regresar </a>
                                            <a class="button" href="javascript:void(0);" data-step="4">Continuar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </li>
    					<li class="step step-5" id="step-5">
                            <div class="planes col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                                <div class="col-md-6 col-sm-6">
                                    <span>Disfruta tu nuevo plan <br> a la medida</span>
                                    <a class="button nueva" href="javascript:void(0);" data-step="5">Nueva línea</a>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <span>Tu plan ha expirado</span>
                                    <a class="button renovacion" href="javascript:void(0);" data-step="5">Renovación</a>
                                </div>
                                <div class="clear"></div>
                                <div class="col-md-6 col-sm-6">
                                    <span>Existen nuevas posibilidades <br> a tus necesidades</span>
                                    <a class="button cambio" href="javascript:void(0);" data-step="5">Cambio de plan</a>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <span>Cambia de compañia <br> sin perder tu número</span>
                                    <a class="button porta" href="javascript:void(0);" data-step="5">Portabilidad</a>
                                </div>
                                <div class="buttons col-md-12 col-sm-12">
                                    <a class="button back" href="javascript:void(0);" data-step="3">
    <i class="fa fa-angle-double-left" aria-hidden="true"></i> Regresar </a>
                                </div>
                            </div>              
                        </li>
    					<li class="step step-6" id="step-6">
                            <div class="formulario col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                                <form id="datos-clientes">
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" name="nombre" class="input-form" placeholder="Nombre(s) *" required>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" name="apaterno" class="input-form" placeholder="Apellido Paterno *" required>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" name="amaterno" class="input-form" placeholder="Apellido Materno *" required>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" name="tel_cel" class="input-form" placeholder="Tel Celular *" required>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" name="tel_fijo" class="input-form" placeholder="Tel Fijo *" required>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="email" name="email" class="input-form" placeholder="Correo electrónico *" required>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" name="calle" class="input-form" placeholder="Calle *" required>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" name="num_ext" class="input-form small" placeholder="No. Ext. *" required>
                                        <input type="text" name="num_int" class="input-form small" placeholder="No. Int.">
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" name="cp" class="input-form" placeholder="Código Postal *" required>
                                    </div>
                                    <div class="clear"></div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="text" name="colonia" class="input-form" placeholder="Colonia *" required>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <input type="checkbox" name="terms" value="1" required/>
                                        <label>
                                            Acepto <a href="http://www.cencel.com.mx/privacidad.html" target="_blank">Política de privacidad</a>
                                        </label>
                                    </div>
                                    <div class="col-md-4 col-sm-4">
                                        <a class="button interno" href="javascript:void(0);">Enviar <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                    </div>
                                </form>
                                <div class="buttons col-md-12 col-sm-12">
                                    <a class="button back" href="javascript:void(0);" data-step="4">
    <i class="fa fa-angle-double-left" aria-hidden="true"></i> Regresar </a>
                                </div>
                            </div>               
                        </li>
    					<li class="step step-7" id="step-7">
                            <div class="exito col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                                <h2>Tu trámite se ha generado correctamente con el </h2>
                                <h3>Folio: 39348349</h3>
                                <h4>Recuerda tener tu folio a la mano</h4>
                            </div>
                        </li>
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
    			<div class="col-md-8 col-md-offset-2 col-sm-12">
    				<div class="col-md-6 col-sm-12">
    					<h2>¡Suscríbete a nuestro Newsletter y recibe ofertas especiales!</h2>
    				</div>
    				<div class="col-md-6 col-sm-12">
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
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>