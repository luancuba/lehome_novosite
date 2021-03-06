<?php
/**
 * Storefront engine room
 *
 * @package storefront
 */

/**
 * Assign the Storefront version to a var
 */
$theme              = wp_get_theme( 'storefront' );
$storefront_version = $theme['Version'];

/**
         * WooCommerce product data tab definition
         *
         * @return array
         */

        add_action('wc_cpdf_init', 'prefix_custom_product_data_tab_init', 10, 0);
        if(!function_exists('prefix_custom_product_data_tab_init')) :

           function prefix_custom_product_data_tab_init(){

             $custom_product_data_fields = array();

             /** First product data tab starts **/
             /** ===================================== */

             $custom_product_data_fields['custom_data_1'] = array(

               array(
                     'tab_name'    => __('Campos Adicionais', 'wc_cpdf'),
               ),
               array(
                     'id'          => 'tipo_produto',
                     'type'        => 'text',
                     'label'       => __('Tipo do Produto: ', 'wc_cpdf'),
                     'placeholder' => __('', 'wc_cpdf'),
                     'class'       => 'large',
                     'description' => __('Field description.', 'wc_cpdf'),
                     'desc_tip'    => true,
               ),
             );
             return $custom_product_data_fields;

           }

        endif;

add_action( 'after_setup_theme', 'remove_pgz_theme_support', 100 );
function remove_pgz_theme_support() { 
	remove_theme_support( 'wc-product-gallery-zoom' );
	remove_theme_support( 'wc-product-gallery-lightbox' );
}

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1140; /* pixels */
}


$storefront = (object) array(
	'version' => $storefront_version,

	/**
	 * Initialize all the things.
	 */
	'main'       => require 'inc/class-storefront.php',
	'customizer' => require 'inc/customizer/class-storefront-customizer.php',
);



require 'inc/storefront-functions.php';
require 'inc/storefront-template-hooks.php';
require 'inc/storefront-template-functions.php';


require 'hooks-custom/hooks.php';
require 'hooks-custom/function.php';
require 'hooks-custom/campos-acf.php';
require 'hooks-custom/cpts.php';
require 'hooks-custom/theme-functions.php';

$usuario = current_user();
if( $usuario == "pj" ){
	require 'hooks-custom/pagamento-functions.php';
}




if ( class_exists( 'Jetpack' ) ) {
	$storefront->jetpack = require 'inc/jetpack/class-storefront-jetpack.php';
}

if ( storefront_is_woocommerce_activated() ) {
	$storefront->woocommerce = require 'inc/woocommerce/class-storefront-woocommerce.php';

	require 'inc/woocommerce/storefront-woocommerce-template-hooks.php';
	require 'inc/woocommerce/storefront-woocommerce-template-functions.php';
}

if ( is_admin() ) {
	$storefront->admin = require 'inc/admin/class-storefront-admin.php';

	require 'inc/admin/class-storefront-plugin-install.php';
}

//add style bootstrap
add_action( 'wp_enqueue_scripts', 'style_bootstrap' );
function style_bootstrap(){
	wp_enqueue_style( 'bootstrap.min', get_template_directory_uri().'/assets/laestampa/boostrap/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-grid.min', get_template_directory_uri().'/assets/laestampa/boostrap/bootstrap-grid.min.css' );
	wp_enqueue_style( 'bootstrap-reboot.min', get_template_directory_uri().'/assets/laestampa/boostrap/bootstrap-reboot.min.css' );
	//JS
	wp_enqueue_script( 'popover-js', get_template_directory_uri().'/assets/js/popper.min.js' );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri().'/assets/js/bootstrap.min.js' );
}

//add style jquery
add_action( 'wp_enqueue_scripts', 'style_jqueryui' );
function style_jqueryui(){
	wp_enqueue_style( 'jqueryui-custom', get_template_directory_uri().'/assets/css/custom/jquery-ui.css' );
	//JS
	wp_enqueue_script( 'jqueryui-js', get_template_directory_uri().'/assets/js/jquery_ui.js' );
}

//add style slider e afins
add_action( 'wp_enqueue_scripts', 'style_jsliderOutros' );
function style_jsliderOutros(){
	wp_enqueue_style( 'style-custom', get_template_directory_uri().'/assets/css/style.css' );
	//JS
	wp_enqueue_script( 'bxslider-js', get_template_directory_uri().'/assets/js/jquery.bxslider.js' );
	wp_enqueue_script( 'isotopen-js', get_template_directory_uri().'/assets/js/isotopen.js' );
}

//add style e js com if
add_action( 'wp_enqueue_scripts', 'style_condicionais' );
function style_condicionais(){
	if( is_post_type_archive('parceiros') ){
		//wp_enqueue_script( 'masonry-js', get_template_directory_uri().'/assets/js/masonry.js' );
		//wp_enqueue_script( 'mosaicflow-js', get_template_directory_uri().'/assets/js/mosaicflow.min.js' );
		wp_enqueue_script( 'bsxlider-js', get_template_directory_uri().'/assets/js/bxslider.js' );		
	}
	if( is_page_template('templates/faq.php') ){
		wp_enqueue_script( 'accordion-js', get_template_directory_uri().'/assets/js/jquery.accordion.js' );
		wp_enqueue_style( 'style-jquery.accordion', get_template_directory_uri().'/assets/css/jquery.accordion.css' );
		wp_enqueue_style( 'style-demo', get_template_directory_uri().'/assets/css/demo.css' );
	}
}


function style_custom(){	
	wp_enqueue_script( 'filtro-js', get_template_directory_uri().'/assets/js/filtro.js' );
	wp_enqueue_script( 'modal-js', get_template_directory_uri().'/assets/js/modal.min.js' );	
	wp_enqueue_script( 'main-js', get_template_directory_uri().'/assets/js/main.js' ); 
	
}
add_action( 'wp_enqueue_scripts', 'style_custom' );

/**
 * NUX
 * Only load if wp version is 4.7.3 or above because of this issue;
 * https://core.trac.wordpress.org/ticket/39610?cversion=1&cnum_hist=2
 */
if ( version_compare( get_bloginfo( 'version' ), '4.7.3', '>=' ) && ( is_admin() || is_customize_preview() ) ) {
	require 'inc/nux/class-storefront-nux-admin.php';
	require 'inc/nux/class-storefront-nux-guided-tour.php';

	if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.0.0', '>=' ) ) {
		require 'inc/nux/class-storefront-nux-starter-content.php';
	}
}

/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woocommerce/theme-customisations
 */

if( function_exists('acf_add_options_page') ) {
 	
 	// add parent
	$parent = acf_add_options_page(array(
		'page_title' 	=> 'Home',
		'menu_title' 	=> 'Theme Settings',
		'redirect' 		=> false
	));	
	
	// add sub page
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Social Settings',
		'menu_title' 	=> 'Social',
		'parent_slug' 	=> $parent['menu_slug'],
	));
	
}	
