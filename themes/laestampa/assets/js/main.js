jQuery( function( $ ) {
	$('.bxsliderHome').bxSlider({
	  auto: true,
	  autoControls: false,
	  stopAutoOnClick: true,
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

	var acionaBusca = $('.lupa-busca');
	var fecharBusca = $('.fechar-modalBusca');

	// acionaBusca.on('click', function(){
	// 	$('.modal-busca').slideDown();
	// 	$('body').css('overflow', 'hidden');
	// });

	// fecharBusca.on('click', function(){
	// 	$('.modal-busca').slideUp();
	// 	$('body').css('overflow', 'auto');
	// });

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
	calculo_metro.on('keyup', function(){
		var valorDigitado = $(this).val();

		$('input.qty').val(valorDigitado);

		var total_valor = valorDigitado * price_product;

		//validacao compra de quantidade
		if( valorDigitado > stock ){
			calculo_metro.tooltip({disabled: false});
			$('.single_customButtom').attr('disabled', '');
			
		}else{
			calculo_metro.tooltip({disabled: true});
			$('.single_customButtom').removeAttr('disabled', '');
			result_calculo_metros.data('price', total_valor);
			result_calculo_metros.html(total_valor + ',00');
		}

	});


	$('.single_customButtom').on('click', function(){
		
		
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




	
	

});














