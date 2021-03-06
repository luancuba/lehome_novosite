jQuery( function( $ ) {
	$('.bxsliderHome').bxSlider({
	  auto: true,
	  autoControls: false,
	  stopAutoOnClick: true,
	  speed: 2000,
	  pager: false,
	  responsive: true,
	  adaptiveHeight: true,
	});


	$('#modalLogin').on('click', function(){
		$('#modal_login').modal('show');
	});

	$('.woo-login-popup-sc-close a').attr('data-dismiss', 'modal');

	// on orienation change we need to reload the bxslider when the new image is done loading
    $(window).on("orientationchange",function(){
      imagesLoaded( document.querySelector('.js-full-width-slideshow'), function( instance ) {
        slider.reloadSlider();
      });
    });

	$('.modal-busca').hide();
	$('#modal-busca').hide();

	var acionaBusca = $('.lupa-busca');
	var fecharBusca = $('.fechar-modalBusca');



	acionaBusca.on('click', function(){
		console.log('click');
		$('.modal-busca').slideDown();
		$('#modal-busca').slideDown();
		
	});

	fecharBusca.on('click', function(){
		$('.modal-busca').slideUp();
		$('body').css('overflow', 'auto');
	});

	$( ".col-boxCompraHome" ).hover(
	  function() {
	    $( this ).addClass( "hover" );
	  }, function() {
	    $( this ).removeClass( "hover" );
	  }
	);
	var price_product = $('.price_product').val();
	var calculo_metro = $('.calculo-metro .calculo-metros');
	var result_calculo_metros = $('.result-calculo-metros');
	var stock = $('.quantidade_necessario').data('stockproduct');

	var quantidade_digitada = $('.quantidade_necessario');

	var backorders = quantidade_digitada.data('backorders');

	

	var is_tipo = calculo_metro.data('tipo');

		calculo_metro.on('keyup', function(){

		var valorDigitado = $(this).val();
		var resultOfMod = valorDigitado % 3;

		if( is_tipo == 'papel' ){

			if( resultOfMod != 0 ){
				calculo_metro.val('');
				result_calculo_metros.html('<bold> - </bold>');	
				calculo_metro.tooltip({disabled: true});
				$('.single_customButtom').attr('disabled', '');	
				result_calculo_metros.data('price', total_valor);
					
			}else{
				$('.single_customButtom').removeAttr('disabled', '');
				result_calculo_metros.data('price', '00,00');
				
			}
		}

		$('input.qty').val(valorDigitado);

		var total_valor = valorDigitado * price_product;
		//validacao compra de quantidade
		if( valorDigitado > stock && backorders == 'no' ){
			calculo_metro.tooltip({disabled: false});
			$('.single_customButtom').attr('disabled', '');			
		}else{
			calculo_metro.tooltip({disabled: true});
			$('.single_customButtom').removeAttr('disabled', 'disabled');
			//if( resultOfMod == 0  ){
				result_calculo_metros.data('price', total_valor);
				result_calculo_metros.html(total_valor + ',00');
			//}else{
				//result_calculo_metros.data('price', '00,00');
				//result_calculo_metros.html('000,00');
			//}
			
		}

	});

	window.bxSlider = false;

	$('.gridItem-parceiros').on('click', function(){

		var content = $(this).data('content');
		content = JSON.parse(content);

		$('.contentParceiro').empty();
		$('.contentParceiro').append(content);
		

		if ( window.bxSlider ) {
			window.bxSlider.destroySlider();
			$('.bxslider').empty();
			
		}
		var imagens = $(this).data('imagens');
		if ( imagens.length == undefined ) return;
		var html = '';
		for (i in imagens) {
			var image = new Image();
				html += '<div><img src="'+ imagens[i].url +'" title="Funky roots"></div>';
			}
			$('.bxslider').append( html );

			setTimeout(function(){
				window.bxSlider = $('.bxslider').bxSlider();
			}, 500)
	});


	$('.quantity').ready(function(){
		$('input.qty').attr('oninvalid', 'this.setCustomValidity("A quantidade que você quer é maior do que temos disponível no momento!")');
	});

	//calculadora papel de parede
		$('.box_selec').hide();
	$('.msgAltura').hide();
	$('.recebe_valRolo').hide();
	$('.calculadora_largura').click(function(){
		$('.box_selec').slideToggle('show');
			$('.calculadora_largura .title_calculator i').toggleClass("fa-arrow-up fa-arrow-down");;
	});
	var altura = $("input#altura");
	var largura = $("input#largura");

	altura.on('keyup', function(e) {
        var val = $(this).val();

        val = Math.round(val);
        if(val > 3){
        	$('.msgAltura').show();
        	$('.recebe_valRolo').hide();
        	$('input#largura').prop( "disabled", true );
        	$('input#largura').val('');
        }else if(val == 0){
        	$('input#largura').prop( "disabled", true );
        	$('input#largura').val('');
        	$("input#altura").val('');
        	$('.recebe_valRolo').hide();
        	$('.msgAltura').hide();
        }else{
        	$('.msgAltura').hide();
        	$('input#largura').prop( "disabled", false );
        }        
	});
	largura.on('keyup', function(e) {
        var val = $(this).val();
        val = Math.round(val);
        var quant_rolo = val / 1.34;
        var quant_rolo = Math.ceil(quant_rolo)
        var metro = quant_rolo * 3;
        $('.recebe_valRolo .quant_rolo').html(Math.ceil(metro) + ' Metros');
        $('.recebe_valRolo').show();

        if(val == 0){
        	$('.recebe_valRolo').hide();
        }

	});

	//add icon favoritos add cart
	var favorito = $('.favorito_prod .yith-wcwl-add-to-wishlist a');

	favorito.html('<i class="fa fa-heart" aria-hidden="true"></i>');

	//add a aba que ira aparecer na single de podutos
	$('.tabsSingle_product li:nth-child(1) a').addClass('active');
	$('.tab-content .tab-pane:nth-child(1)').addClass('show');
	$('#myTabContent .tab-pane:first-child').addClass('active');

$(document).on( 'click', '.quantity-up', function(e){
	var $that = $(this);
	var parent = $that.parent().parent();
	var input = parent.find('input[type="number"]');
	var oldValue = parseInt(input.val());
	var max = parseInt( input.attr('max') );
	var step = parseInt(input.attr('step'))
	if (oldValue >= max) {
    var newVal = oldValue;
  } else {
  	console.log(oldValue, step)
    var newVal = oldValue + step;
  }
  input.val(newVal);
  input.trigger('change')
} );

$(document).on( 'click', '.quantity-down', function(e){
	var $that = $(this);
	var parent = $that.parent().parent();
	var input = parent.find('input[type="number"]');
	var oldValue = parseInt(input.val());
	var max = parseInt( input.attr('max') );
	var step = parseInt(input.attr('step'))
	if (oldValue >= max) {
    var newVal = oldValue;
  } else {
  	console.log(oldValue, step)
    var newVal = oldValue - step;
  }
  input.val(newVal);
  input.trigger('change')
} );

	$("#shipping_method li input").change(function(){
    window.location = '/carrinho';
	});
//main imput number
    $('.quantity').each(function() {
      var spinner = $(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');



      // btnUp.click(function() {
      //   var oldValue = parseFloat(input.val());

      //   var step = parseInt(input.attr('step'));

      //   console.log(123213213);

      //   if (oldValue >= max) {
      //     var newVal = oldValue;
      //   } else {
      //     var newVal = oldValue + step;
      //   }
      //   spinner.find("input").val(newVal);
      //   spinner.find("input").trigger("change");
      // });

      // btnDown.click(function() {
      //   var oldValue = parseFloat(input.val());
      //    var step = parseInt(input.attr('step'));
      //   if (oldValue <= min) {
      //     var newVal = oldValue;
      //   } else {
      //     var newVal = oldValue - step;
      //   }
      //   spinner.find("input").val(newVal);
      //   spinner.find("input").trigger("change");
      // });

    });

    //carregar lista do carrinho no menu
    var url_cart = window.location.href;
    if( url_cart.indexOf('add_to_cart') != -1 ){
    	$('.listCart').slideDown(1000);
    }

    var menuCart = $('.itemMenu-topHeaderCart');
		menuCart.on('click', function(){
			$('.listCart').slideToggle(500);
		});

		var fechar = $('.close_moldaCart');
		fechar.on('click', function(){
			$('.listCart').hide();
		});

		//criando regra para que se for papel add sempre ultiplo de 3.

		$('.row-lojas').isotope({
		  // options
		  itemSelector: '.item-loja',
		  layoutMode: 'fitRows'
		});

		$(document).on('ready', function(){
			var $row = $('.row-lojas');
			var $filter = $('.filtrar-revenda');
			$filter.on('click', function(e){
				e.preventDefault();
				var filter = $(this).data('filter');
				$row.isotope({ filter: '.' + filter.toString() });
			})
		});


		$(document).on('ready', function(){
			$('.accordion').accordion({
			    "transitionSpeed": 400,
			    "contentElement": '[data-contents]'
			});
		});

		//botao next cadastro de reservas
		$(document).on('ready', function(){
			$('.cf7mls_next').html('Próximo');
			$('.cf7mls_back').html('Voltar');
			
		});


		$(document).on('ready', function(){
			//pega a largura da resolução da tela
			var width = screen.width;
			//pega a altura da resolução da tela
			var height = screen.height;

			console.log(width);

			//verifica se a resolução dará uma boa visão do site
			if (width <= 415){
				$('.boxFiltros').addClass('boxFiltros-responsivo');
				$('.widget-areaSidebar h3').removeClass('filtros');
				$('.widget-areaSidebar h3').addClass('filtrosMobile');

			}else{
				$('.boxFiltros').removeClass('boxFiltros-responsivo');

			}
				
		});

		$(document).on('click', '.filtrosMobile', function(){
			$('.boxFiltros-responsivo').slideToggle();
		});

		//PAGAMENTO

		jQuery('#forma_pagamento').on('change', function(e){
		var pagamento = jQuery(this).val();

		jQuery.ajax({
			'type' : 'POST',
			'dataType': 'json',
			'url' : window.ajaxurl,
			'data' : {
				'action' : 'le_forma_pagamento',
				'pagamento': pagamento
			},
			'success': function(e){
				jQuery( 'body' ).trigger( 'update_checkout' );
			}
		});
	})

});














