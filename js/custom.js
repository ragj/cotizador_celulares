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

	// Pasar intro 
	$('.intro .button').on('click', function(){
		$(this).closest('.intro').fadeOut('400', function(){
			$('.row.titulo, .row.barra, .row.numpaso, .row.contenedor').show();
		});
	});

	// Slider pasos
	var mainSlider 	= 	$("#slider-pasos").slider({
		tooltip: 'hide',
		ticks: [1, 2, 3, 4, 5, 6, 7],
		ticks_labels: ['1', '2', '3', '4', '5', '6', '7'],
		ticks_snap_bounds: 0,
		enabled: false
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

		// Cambiar slide de contenedor principal 
		var slideWidth = 0;

		$('.contenedor > div li#step-' + newValue).prevAll().each(function(i, v){
			// console.log( $(v).width() );
			slideWidth += $(v).width();
		});

		$('.contenedor > div > ul').css({'margin-left': '-' + slideWidth + 'px'});

		// Adecuar tamaño 
		if( newValue == 1 ){
			$('#contenedor > div:not(.size)').removeClass().addClass('col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1').css({'height': 400})
			.find('li#step-' + newValue).css({'width': $('#size-1').width() });
		}
		else if( newValue == 2 ){
			$('#contenedor > div:not(.size)').removeClass().addClass('col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1').css({'height': 540})
			.find('li#step-' + newValue).css({'width': $('#size-2').width() });
		}
		else if( newValue == 3 ){
			$('#contenedor > div:not(.size)').removeClass().addClass('col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1').css({'height': 640})
			.find('li#step-' + newValue).css({'width': $('#size-2').width() });
		}
		else if( newValue == 4 ){
			$('#contenedor > div:not(.size)').removeClass().addClass('col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1').css({'height': 420})
			.find('li#step-' + newValue).css({'width': $('#size-3').width() });
		}
		else if( newValue == 5 ){
			$('#contenedor > div:not(.size)').removeClass().addClass('col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1').css({'height': 400})
			.find('li#step-' + newValue).css({'width': $('#size-1').width() });
		}
		else if( newValue == 6 ){
			$('#contenedor > div:not(.size)').removeClass().addClass('col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1').css({'height': 400})
			.find('li#step-' + newValue).css({'width': $('#size-3').width() });
		}
		else if( newValue == 7 ){
			$('#contenedor > div:not(.size)').removeClass().addClass('col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1').css({'height': 350})
			.find('li#step-' + newValue).css({'width': $('#size-1').width() });
		}
		
	});

	// Slider rango de precios 
	$("#slider-presupuesto").slider({
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
		var marca = $('body').data('marca'), rango=1;

		if( marca == "Iphone" ){
			$('#step-3 div.marcas').hide();
		}else{
			$('#step-3 div.marcas').show();
		}

		if(newVal < 400){
			rango=1;
		}
		else if(newVal ==400 || newVal < 800){
			rango=2;
		}
		else if(newVal==800 || newVal <1500){
			rango=3;
		}
		else if( newVal > 1500 || newVal == 1500){
			rango=4;
		}

		$('.detalle-planes').addClass('loading').find('.row-cell').remove();
		$.post('/php/functions.php', { "accion": "ObtienePlanes",  "rango" : rango, "marca" : marca}, function(data){
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

			if( typeof reloadPlanes !== 'undefined' ){
				$('.detalle-planes').addClass('loading').find('.row-cell').remove();

				$.post('/php/functions.php', { "accion": "ObtienePlanes",  "rango" : 1, "marca" : marca}, function(data){
					$.each( data.plan, function(index, element){
						// console.log(element.html);
						$('.detalle-planes').removeClass('loading').append( element.html );
					});

				});
			}
			
		} else if( step == 2 ){
			
			var marca = $('#step-1').find('a.image.selected').data('marca');
				
			if( marca == 'Android' ){
				$('#step-3 div.marcas').show();
			}else{
				$('#step-3 div.marcas').hide();
			}

			$('#step-3 div.phones').addClass('loading').find('ul').empty();

			$.post('/php/functions.php', { "accion" : "ObtieneEquiposRapido", "marca" : marca }, function(data) {
				if( data.exito ){
					$.each( data.marcas, function(index, element){
						$('#step-3 div.marcas ul').append( element.html );
					});
					$.each( data.modelos, function(index, element){
						$('#step-3 div.phones').removeClass('loading').find('ul').append( element.html ).find('li:visible:first input').prop('checked', true);
					});
				}
			});
				
			
			var plan = $('input[type=radio]').val();

			mainSlider.slider('setValue', (step + 1), true);
			mainSlider.trigger('change', [event]);
		} else if( step == 3 ){
			

			var item = $('#step-3 .phones input:checked').val();
			var nombre = $('#step-3 .phones input:checked').parent().find('span.nombre-phone').text();
			var imagen = $('#step-3 .phones input:checked').parent().find('img').attr('src');

			$.post('/php/functions.php', { "accion" : "ObtieneCaracteristicasEquipo", "item" : item, "nombre" : nombre, "imagen" : imagen }, function(data) {

				$('#step-4 div.phone-details').find('.phone-nombre, .phone-sos, .capacidad, .color').remove();
				if( data.exito ){
					
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
		var banner = $(v), bannerWidth = $('.banners').width();

		banner.css({'width': (bannerWidth / 3)});
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

	$('#step-3 .marcas ul').on('click', 'li a', function(event) {
		event.preventDefault();
		var marca = $(this).parent(), nombre_marca = marca.attr('class').trim();
		$('#step-3 .phones li').hide().filter( "." + nombre_marca ).show().first().find('input').prop('checked', true);
		console.log(marca);
		$('#step-3 .marcas li').removeClass('active').filter( marca ).addClass('active');
	});

<<<<<<< HEAD
=======
	$('#step-4 .phone-details').on('change', 'input.capacidad', function(event) {
		event.preventDefault();
		var memoria = $(this).val();
		var modelo = $('.phone-details .phone-nombre').text();
		
		$('.phone-plan .datos span.gb').text(memoria);
		$('.phone-plan .phone-nombre').text(modelo);
		$('.phone-details div.color').remove();
		$.post('/php/functions.php', { "accion" : "ObtieneColordeModeloMemoriaAK", "modelo" : modelo, "memoria" : memoria }, function(data) {
			$(data.html).insertBefore('#step-4 .phone-details .buttons.col-md-12');
		});
	});

	$('#step-4 .phone-details').on('change', 'input.variante', function(event) {
		var color = $(this).data('variante');
		$('.phone-plan span.color').removeClass().addClass( 'color '+ color );
	});

	$('#step-4').on('click', '#btn-get-plan', function(event) {
		event.preventDefault();
		var plan = $('#step-2 .detalle-planes input:checked').val()
		var item = $('#step-4 .phone-details .color input:checked').val()
		$.post('/php/functions.php', { "accion" : "ObtieneResultadosBusqueda", "plan" : plan, "item" : item }, function(data) {
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
		console.log( accion );
	});

>>>>>>> 41de7eb4eca5e33944c1fd3d6a906ec74ef0b693
});