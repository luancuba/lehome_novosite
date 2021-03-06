<?php

// add_filter( 'wcbcf_billing_fields', 'function_doido' );
// function function_doido( $new_fields ) {
// 	$tipo = $new_fields['billing_persontype'];
// 	$user_tipo = current_user();
// 	if( $user_tipo == "pj" ){
// 		$aux = $new_fields['billing_persontype']['options'][1];
// 		$new_fields['billing_persontype']['options'][1] = $new_fields['billing_persontype']['options'][2];
// 		$new_fields['billing_persontype']['options'][2] = $aux;	
// 	}
// 	return $new_fields;
// }

//functions tema
function banner_page($page_id){
$imagem = get_field('imagem_banner', $page_id);
$cor_fundo = get_field('cor_fundo_banner', $page_id);
$cor_title = get_field('cor_titulo_banner', $page_id);
	
	if( $imagem ){
		echo '<div class="banner-page" style="background: url('.$imagem.') no-repeat;background-size: 100% auto;">';
		echo '<div class="title_page sr-only">';
	}else{
		echo '<div class="banner-page" style="background-color: '.$cor_fundo.'">';
		echo '<div class="title_page text-center">';	
	}
?>	
	<h1 style="color:<?php echo $cor_title; ?>"><?php echo get_the_title(); ?></h1>		
		</div>	
	</div>
<?php
	return;	
}

//quantidade de produtos no loop de produtos
add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  if ( isset( $_POST['per_page'] ) ) {
	  $cols = $_POST['per_page'];
	  ob_start();
	  $_SESSION['per_page'] = $cols;
  } else {
  	$cols = 21;
	  ob_start();
	$_SESSION['per_page'] = $cols;
  }
  return $cols;
}




function include_category( $query ) {
	$tipo = isset( $_GET['tipo'] ) ? $_GET['tipo'] : false;
	if ( !$tipo ) return;
    if ( $query->is_main_query() ) {
    	$tax_query = array(
    		array(
    			'taxonomy' => 'product_cat',
    			'field' => 'slug',
    			'terms' => $tipo
    		)
    	);
        $query->set( 'tax_query', $tax_query );
    }
}
add_action( 'pre_get_posts', 'include_category' );




function my_custom_add_to_cart_redirect( $url ) {
	$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$url .= '?add_to_cart=true';
	return $url;
}
add_filter( 'woocommerce_add_to_cart_redirect', 'my_custom_add_to_cart_redirect' );



function nova_ordem_catalogo( $orderby ) {
    unset($orderby["popularity"]);
    unset($orderby["rating"]);
    return $orderby;
}
add_filter( "woocommerce_catalog_orderby", "nova_ordem_catalogo", 20 );

/* Remove a Verificação de Força */
function iconic_remove_password_strength() {
    wp_dequeue_script( 'wc-password-strength-meter' );
}
add_action( 'wp_print_scripts', 'iconic_remove_password_strength', 10 );


add_filter( 'woocommerce_shipping_local_pickup_is_available', 'is_local_pickup_available', 10, 2 );
function is_local_pickup_available($available, $package){
	//logica
	$userCurrency = get_current_user_id();		
  	$available = get_field('habilitar_retiradaLocal', 'user_'.$userCurrency);
  	$available = json_decode($available);
	return $available;
}

//function cupom arquiteto
add_action( 'woocommerce_applied_coupon', 'cupom_arquiteto', 10, 3 );
function cupom_arquiteto($array){
	$cupom = new WC_Coupon($array);
	$idCupom = $cupom->get_id();
	$nomeArquiteto = get_field('nome_arquiteto', $idCupom);

	if( !($idCupom && $nomeArquiteto == '' ) ){
		$nomeArquiteto = 'Nenhum';
		return;
	}
	session_start();
	$_SESSION["nome_arquiteto"] = $nomeArquiteto;
}

add_action( 'woocommerce_add_order_item_meta', 'add_order_item_meta', 10, 2 );

function add_order_item_meta($item_id, $values) {
		session_start();
    $key = 'order_vendedor'; // Define your key here
    if( !isset($_SESSION["nome_arquiteto"])) {
    	wc_add_order_item_meta($item_id, $key, $_SESSION["nome_arquiteto"]);
  	} else {
    	wc_add_order_item_meta($item_id, $key, 'Nenhum');
  	}
}

//add_action('woocommerce_checkout_create_order', 'before_checkout_create_order', 20, 2);
function before_checkout_create_order( $order, $data ) {
	session_start();
	if( !isset($_SESSION["nome_arquiteto"]) ){
		$order->update_meta_data( 'order_vendedor', 'Nenhum' );
		return;
	}
    $order->update_meta_data( 'order_vendedor', $_SESSION["nome_arquiteto"] );
}







