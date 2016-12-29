/********************************************************************************/
/* 	   ___                    _   ___      _   _              _             	*/
/* 	  / __\___ _ __   ___ ___| | / __\___ | |_(_)______ _  __| | ___  _ __  	*/
/* 	 / /  / _ \ '_ \ / __/ _ \ |/ /  / _ \| __| |_  / _` |/ _` |/ _ \| '__| 	*/
/*  / /__|  __/ | | | (_|  __/ / /__| (_) | |_| |/ / (_| | (_| | (_) | |    	*/
/*  \____/\___|_| |_|\___\___|_\____/\___/ \__|_/___\__,_|\__,_|\___/|_|    	*/
/* 																				*/
/* 				Desarrollador por el equipo Denumeris Interactive 				*/
/* 																				*/
/********************************************************************************/


$(document).ready(function(){

	/**********************/

 	var keys     = [];
 	var up = 38,
 	down = 40,
 	left = 37,
 	right = 39,
 	A = 65,
 	B = 66;
    var	code = [up,up,down,down,left,right,left,right,B,A];

    $(document)
    	.keydown(
	    	function(e) {
	    		keys.push( e.keyCode );
	    		if ( keys.toString().indexOf( code ) >= 0 ){
	        		e.preventDefault(); // PREVIENE EL SCROLL
	        
			        $('body form').find('input[type=text], textarea').each(function(index, el) {
			        	var placeholder = $(this).attr('placeholder');
			        	if( placeholder ){
			        		$(this).val(placeholder);
			        	}
			        });

		        	keys = [];
				}
			}
		);

    /**********************/

	// Pasar intro 
	$('.intro .button').on('click', function(){
		$('#celular').submit();		
	});

	$('#celular').validate({
            rules: {
                'numcelular': {
                    digits: true,
                    rangelength: [10, 10]
                },
            },
            messages: {
                'numcelular': {
                    digits: 'Número inválido',
                    rangelength: 'Número no válido'
                }
            },
            errorElement: 'span',
            success: 'valid',
            submitHandler: function(form){
                var $form = $(form), values = $form.serialize();

                if( $form.find('#numcelular').val() != '' ){
                    $.post('php/functions.php',{"accion":"registrarTelefono","numCelular":$form.find('#numcelular').val()}, function(data) { //ragj
                		console.log(data);        
                    });
                }

                $('.intro').fadeOut('400', function(){
					$('.row.titulo, .row.barra, .row.numpaso, .row.contenedor').show();

					$('#contenedor ul li#step-1').css({'width': $('#size-1').width()});
				});
            }
        });

	// Slider pasos
	var mainSlider 	= 	$("#slider-pasos").slider({
							tooltip: 'hide',
							ticks: [1, 2, 3, 4, 5, 6, 7],
							ticks_labels: ['1', '2', '3', '4', '5', '6', '7'],
							ticks_snap_bounds: 0,
							enabled: false,
							focus: true,
							natural_arrow_keys: true
						});

	// Agregar número para slider y deshabilitar al inicio
	$("#ex1Slider .slider-track .slider-tick").each(function(i, v){
		var anchorClass = (i >= 1) ? 'class="disabled step-' + (i + 1) + '"' : '';
		$(v).append('<a href="javascript:void(0);" ' + anchorClass + ' data-step="' + (i + 1) + '">' + (i + 1) + '</a>');
	});

	// Navegar desde la barra de pasos
	$('#wrapper .barra').on('click', '#ex1Slider .slider-tick a:not(.disabled)', function(){
		var $this = $(this), step = $this.data('step'), tick = $this.parent();

		mainSlider.slider('setValue', step, true);
		mainSlider.trigger('change', [event]);

		// Deshabilitar siguientes pasos 
		$this.closest('.slider-track').find('.slider-tick').filter( tick ).nextAll().find('a').addClass('disabled');
	});

	// Cambiar textos asociados a cada paso
	$("#slider-pasos").on('change', function(event){
		if( typeof event.value !== 'undefined' ){
			var newValue = event.value.newValue;
		}
		else {
			var newValue = event.target.value;
		}

		$('#ex1Slider').find('.slider-handle').removeClass().addClass('slider-handle min-slider-handle round pos-' + newValue );

		// Cambiar título de paso 
		$('.numpaso h2').hide().filter('.step-' + newValue).fadeIn();


		// Habilitar la navegación para el paso al que se avanzó
		$('#ex1Slider .slider-track .slider-tick a.step-' + newValue).removeClass('disabled');

		// Cambiar slide de contenedor principal 
		var slideWidth = 0;

		$('.contenedor > div li#step-' + newValue).prevAll().each(function(i, v){
			slideWidth += $(v).width();
		});

		$('.contenedor > div > ul').css({'margin-left': '-' + slideWidth + 'px'});

		// Adecuar tamaño 
		if( newValue == 1 ){
			$('#contenedor > div:not(.size)').removeClass().addClass('col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1 col-xs-12').css({'height': 400})
			.find('li#step-' + newValue).css({'width': $('#size-1').width() });
		}
		else if( newValue == 2 ){
			$('#contenedor > div:not(.size)').removeClass().addClass('col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12').css({'height': 585})
			.find('li#step-' + newValue).css({'width': $('#size-2').width() });
		}
		else if( newValue == 3 ){
			$('#contenedor > div:not(.size)').removeClass().addClass('col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12').css({'height': 640})
			.find('li#step-' + newValue).css({'width': $('#size-2').width() });
		}
		else if( newValue == 4 ){
			$('#contenedor > div:not(.size)').removeClass().addClass('col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12').css({'height': 490})
			.find('li#step-' + newValue).css({'width': $('#size-3').width() });
		}
		else if( newValue == 5 ){
			$('#contenedor > div:not(.size)').removeClass().addClass('col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1 col-xs-12').css({'height': 400})
			.find('li#step-' + newValue).css({'width': $('#size-1').width() });
		}
		else if( newValue == 6 ){
			$('#contenedor > div:not(.size)').removeClass().addClass('col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12').css({'height': 420})
			.find('li#step-' + newValue).css({'width': $('#size-3').width() });
		}
		else if( newValue == 7 ){
			$('#contenedor > div:not(.size)').removeClass().addClass('col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1 col-xs-12').css({'height': 350})
			.find('li#step-' + newValue).css({'width': $('#size-1').width() });
		}
		
	});

	// Slider rango de precios 
	var presupuestoSlider = $("#slider-presupuesto").slider({
								tooltip: 'always',
								ticks: [],
								ticks_labels: ['|', '|', '|', '|', '|', '|', '|', '|', '|', '|', '|', '|', '|', '|', '|', '|'],
								ticks_tooltip: true,
								enabled: true, 
								formatter: function(value){
									return '$ ' + value;
								},
							}).on('slideStop', function(ev){
								var newVal = $('#slider-presupuesto').data('slider').getValue();
								var marca = $('body').data('marca'), rango = 1;

								if( marca == "Iphone" ){
									$('#step-3 div.marcas').hide();
								}else{
									$('#step-3 div.marcas').show();
								}

								if(newVal < 400){
									rango = 1;
								}
								else if(newVal ==400 || newVal < 800){
									rango = 2;
								}
								else if(newVal==800 || newVal <1500){
									rango = 3;
								}
								else if( newVal > 1500 || newVal == 1500){
									rango = 4;
								}

								$('.detalle-planes').addClass('loading').find('.row-cell').remove();
								$.post('php/functions.php', { "accion": "ObtienePlanes",  "rango" : rango, "marca" : marca}, function(data){
									$.each( data.plan, function(index, element){
										// console.log(element.html);
										$('.detalle-planes').removeClass('loading').append( element.html );
									});

								});
							});

	// Paso 4 cambio de pantalla 
	$("#step-4").on('click', '.button.interno:not(.back)', function(){
		$('.phone-details').hide();
		$('.phone-plan').show();
	});

	$("#step-4").on('click', '.button.back.interno', function(){
		$('.phone-plan').hide();
		$('.phone-details').show();
	});

	// Avanzar en formulario 
	$("#contenedor").on('click', 'a.button:not(.interno),a.image', function(e){
		if( $(this).hasClass('disabled') ){
			e.preventDefault();
			return false;
		}
		var $this = $(this), step = $this.data('step'), reloadPlanes = $this.data('reload');

		var marca = $this.data('marca');
		if( marca ){
			$('body').attr('data-marca', marca);
		}

		// Paso uno 
		if(step == 1){
			$this.closest('.step').find('.image').removeClass('selected').filter( $this.closest('div').find('.image') ).addClass('selected');

			mainSlider.slider('setValue', (step + 1), true);
			mainSlider.trigger('change', [event]);

			presupuestoSlider.slider('setValue', 300, true);

			if( typeof reloadPlanes !== 'undefined' ){
				$('.detalle-planes').addClass('loading').find('.row-cell').remove();

				$.post('php/functions.php', { "accion": "ObtienePlanes",  "rango" : 1, "marca" : marca}, function(data){
					if( data.exito ){
						$('#step-2 a.button.disabled').removeClass('disabled');
						$.each( data.plan, function(index, element){
							// console.log(element.html);
							$('.detalle-planes').removeClass('loading').append( element.html );
						});
					}

				});
			}
			
		} else if( step == 2 ){
			
			var marca = $('#step-1').find('a.image.selected').data('marca');
				
			if( marca == 'Android' ){
				$('#step-3 div.marcas').show();
			}else{
				$('#step-3 div.marcas').hide();
			}

			// Validar si ya existe información 
			if( $('#step-3 div.phones').find('ul li').length == 0 ){

				$('#step-3 div.phones').addClass('loading');
				$.post('php/functions.php', { "accion" : "ObtieneEquiposRapido", "marca" : marca }, function(data) {
					if( data.exito ){
						$('#step-3 a.button.disabled').removeClass('disabled');

						$.each( data.marcas, function(index, element){
							$('#step-3 div.marcas ul').append( element.html );
						});

						var phoneWidth = $('#step-3 div.phones .sizer').outerWidth();

						$.each( data.modelos, function(index, element){
							var phone = $(element.html);

							if( marca == 'Android' ){
								if( phone.hasClass('apple') ){
									phone.hide();
								}
							}
							else {
								if( !phone.hasClass('apple') ){
									phone.hide();
								}	
							}

							$('#step-3 div.phones').removeClass('loading').find('ul').append( phone ).find('li')
												   .css({'width': phoneWidth}).filter(':visible:first input').prop('checked', true);

						});

						setTimeout(function(){
							widthPhones();
						}, 100);

					}
				});
			}
			else {
				if( marca == 'Android' ){
					$('#step-3 div.phones ul li').hide().filter(':not(.apple)').show();
				}
				else {
					$('#step-3 div.phones ul li').hide().filter('.apple').show();
				}

				$('#step-3 div.phones ul li:visible:first').find('input').prop('checked', true);

				setTimeout(function(){
					widthPhones();
				}, 100);
			}

			var plan = $('input[type=radio]').val();

			mainSlider.slider('setValue', (step + 1), true);
			mainSlider.trigger('change', [event]);

		} else if( step == 3 ){
			

			var item = $('#step-3 .phones input:checked').val();
			var nombre = $('#step-3 .phones input:checked').parent().find('span.nombre-phone').text();
			var imagen = $('#step-3 .phones input:checked').parent().find('img').attr('src');

			$.post('php/functions.php', { "accion" : "ObtieneCaracteristicasEquipo", "item" : item, "nombre" : nombre, "imagen" : imagen }, function(data) {

				$('#step-4 div.phone-details').find('.phone-nombre, .phone-sos, .capacidad, .color').remove();
				if( data.exito ){
					// $('#step-4 a.button.disabled').removeClass('disabled');
					$('#step-4 div.phone-details').prepend( data.html );
					$('#step-4 div.phone-image img').attr('src', data.imagen );
					
				}
			});

			mainSlider.slider('setValue', (step + 1), true);
			mainSlider.trigger('change', [event]);
		}	
		else {
			mainSlider.slider('setValue', (step + 1), true);
			mainSlider.trigger('change', [event]);

		}

	});

	// Calcular tamaños
	$('.banners ul li').each(function(i, v){
		var banner = $(v), bannerWidth = $('.banners .sizer').outerWidth();

			banner.css({'width': bannerWidth});
	});

	// Carrusel para banners
	$('.banners').on('click', '> a', function(){
		var $this = $(this), slides = $this.closest('.banners').find('ul li'),
		ws = slides.width(), fSlide = slides.first(), lSlide = slides.last();

		if( slides.is(':animated') ) {
			return false;
		}

		// Previa 
		if( $this.hasClass('prev-banner') ){ 	
			// console.log( $this );
			lSlide.css({'margin-left': '-' + ws + 'px'}).insertBefore( slides.first() ).parent().find('li').first().animate({'margin-left': '0px'}, 600, 'linear');
		}
		else { 			
			fSlide.animate({'margin-left': '-' + ws + 'px'}, 600, 'linear', function(){
				fSlide.css({'margin-left': '0px'}).appendTo( slides.parent() );
			});
		}	
	});

	// Lightbox para banners
	$("#banners").lightGallery({
		selector: 'ul li a',
		width: '60%'
	});

	// Flechas para mover entre teléfonos
	function widthPhones(){
		var phonesPerPage = 2;

		if( $(window).width() <= 677 ){
			phonesPerPage = 3;
		}

		var phones = $('#step-3 div.phones ul li:visible'), numPhones = Math.ceil(phones.closest('.inner-phones').outerWidth() / phones.outerWidth()), 
			numPages = Math.ceil( phones.length / (numPhones * phonesPerPage) ), widthContent = numPages * (phones.outerWidth() * numPhones); 

			phones.parent().attr('data-pages', numPages ).attr('data-position', 1).css( {'width': (widthContent + 1), 'margin-left': 0} );
			phones.parent().data('position', 1);
			phones.parent().data('pages', numPages);

			// Mostrar flechas 
			phones.closest('.phones').find('> a').fadeOut();
			if( phones.length > (numPhones * phonesPerPage) ){
				phones.closest('.phones').find('> a.next-phone').fadeIn();
			}
	}

	$('#step-3').on('click', '.phones > a', function(e){
		var $this = $(this), phones = $this.closest('.phones').find('ul li:visible'),
			contentPhones = phones.parent(), numPhones = phones.closest('.inner-phones').outerWidth() / phones.outerWidth(),
			widthContent =  phones.outerWidth() * numPhones;

		if( contentPhones.is(':animated') ) {
			return false;
		}

		// Previa 
		var position = contentPhones.data('position'), numPages = contentPhones.data('pages');

		if( $this.hasClass('prev-phone') ){ 
			if( position > 1 ) {
				contentPhones.animate({'margin-left': '-' + widthContent * (position - 2 ) + 'px'}, 600, 'linear', function(){
					contentPhones.data('position', (position - 1));

					if( position <= 2 ){
						$this.hide();
					}
				});

				$this.parent().find('a.next-phone').show();
			}
		}
		else { 			
			if( position < numPages ){
				contentPhones.animate({'margin-left': '-' + widthContent * position + 'px'}, 600, 'linear', function(){
					contentPhones.data('position', (position + 1));

					if( position + 1 == numPages ){
						$this.hide();
					}
				});

				$this.parent().find('a.prev-phone').show();
			}
		}

	});

	$('#step-3 .marcas ul').on('click', 'li a', function(event) {
		event.preventDefault();

		var marca = $(this).parent(), nombre_marca = marca.attr('class').trim();
		$('#step-3 .phones li').hide().filter( "." + nombre_marca ).show().first().find('input').prop('checked', true);
		$('#step-3 .marcas li').removeClass('active').filter( marca ).addClass('active');

		setTimeout(function(){
			widthPhones();
		}, 100);
	});

	$('#step-4 .phone-details').on('change', 'input.capacidad', function(event) {
		event.preventDefault();
		var $this = $(this), memoria = $this.val(), modelo = $('.phone-details .phone-nombre').text();

		// Activar etiqueta 
		$this.closest('div.capacidad').find('label').removeClass('active').filter('[for="' + $this.attr('id') + '"]').addClass('active');
		
		$('.phone-plan .datos span.gb').text(memoria);
		$('.phone-plan .phone-nombre').text(modelo);
		$('.phone-details div.color').remove();
		$.post('php/functions.php', { "accion" : "ObtieneColordeModeloMemoriaAK", "modelo" : modelo, "memoria" : memoria }, function(data) {
			$(data.html).insertBefore('#step-4 .phone-details .buttons.col-md-12');
		});
	});

	$('#step-4 .phone-details').on('change', 'input.variante', function(event) {
		var $this = $(this), color = $this.data('variante');
		$('.phone-plan span.color').removeClass().addClass( 'color '+ color );
		$('#step-4 a.button').removeClass('disabled');

		$this.closest('div.color').find('label').removeClass('active').filter('[for="' + $this.attr('id') + '"]').addClass('active');
	});

	$('#step-4 .phone-plan').on('change', 'input.plan', function(event) {
		var plan = $(this).val();
		var item = $('#step-4 .phone-details .color input:checked').val();
		$('#datos-clientes input[name="plan"]').val( plan );
		$('#datos-clientes input[name="item"]').val( item );
		
	});

	$('#step-4').on('click', '#btn-get-plan:not(.disabled)', function(event) {
		if($(this).hasClass('disabled')){
			event.preventDefault();
			event.stopPropagation();
			return false;
		}

		event.preventDefault();
		var plan = $('#step-2 .detalle-planes input:checked').val()
		var item = $('#step-4 .phone-details .color input:checked').val();
		$.post('php/functions.php', { "accion" : "ObtieneResultadosBusqueda", "plan" : plan, "item" : item }, function(data) {
			$('#step-4 .phone-plan .plan-details').html( "" );
			if( data.exito ){
				$('#step-4 .phone-plan .plan-details').html( data.html );
			}
		});
	});

	$('#step-5').on('click', 'a.button', function(event) {
		var boton = $(this);
		boton.closest('.planes').find('a.button').removeClass('active').filter( $(this) ).addClass('active');
		var accion = boton.data('accion');
		$('#datos-clientes input[name="tramite"]').val( accion );
		console.log( accion );
	});

	// Enviar formulario de datos
	$('#step-6').on('click', 'a.button.interno', function(e){
		e.preventDefault();

		$('#datos-clientes').submit();	
	});

	// Validar formulario
	$('#datos-clientes').validate({
		rules: {
			email: {
				email: true
			},
			tel_cel: {
				digits: true,
				rangelength: [8, 10]
			},
			tel_fijo: {
				digits: true,
				rangelength: [8, 10]
			},
			cp: {
				digits: true,
			},
			municipio: {
				required: true,
			},
			estado: {
				required: true,
			}
		},
		messages: {
			nombre: {
				required: 'Dato requerido'
			},
			apaterno: {
				required: 'Dato requerido'
			},
			amaterno: {
				required: 'Dato requerido'
			},
			email: {
				required: 'Dato requerido', 
				email: 'Correo electrónico inválido'
			},
			tel_cel: {
				required: 'Dato requerido',
				digits: 'Número inválido',
				rangelength: 'Número inválido'
			},
			tel_fijo: {
				required: 'Dato requerido',
				digits: 'Número inválido',
				rangelength: 'Número inválido'
			},
			calle: {
				required: 'Dato requerido',
			},
			num_ext: {
				required: 'Dato requerido',	
			},
			cp: {
				required: 'Dato requerido',
				digits: 'Número inválido'
			},
			colonia: {
				required: 'Dato requerido'
			},
			municipio: {
				required: 'Dato requerido'
			},
			estado: {
				required: 'Dato requerido'
			},
			terms: {
				required: '*'
			},
		},
		errorElement: 'span',
		success: 'valid',
		submitHandler: function(form){
			var $form = $(form), values = $form.serialize();

			$.post('php/functions.php', values, function(data) {
				if( data.exito ){
					$('#folio').text( data.tramite[0] ); 
					mainSlider.slider('setValue', 7, true);
					mainSlider.trigger('change', [event]);
				}else{

				}
			});
			
		}
	});
});