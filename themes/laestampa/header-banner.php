<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
		<div class="modal modal-busca" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="container">
			<div class="box_buscaModal">
				<div class="fechar-modalBusca">
					<span data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></span>
				</div>
				<div class="modal-conteudo">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL LOGIN -->
<div id="modal_login" class="modal fade modalLogin" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-superlg">
    <div class="modal-content">
      <div class="form-login_menu">
					<?php 
						echo do_shortcode('[woo-login-popup]');
					?>
				</div>
    </div>
  </div>
</div>

<?php do_action( 'storefront_before_site' ); ?>

<div id="page" class="hfeed site">
	<?php do_action( 'storefront_before_header' ); ?>

	<header id="masthead" class="header-top" role="banner" style="<?php storefront_header_styles(); ?>">
		<div class="container-fluid console_slide">
			<div class="row ">
				<div class="bxsliderHome">
					<?php
						$bannerHome = get_field('banner_home');
							if($bannerHome){
								foreach($bannerHome as $banner){

									$imagem = $banner['imagem_banner'];
									$tarja = $banner['tarja'];
									$cor_tarja = $banner['cor_tarja'];
									$opacidade = $banner['opacidade_banner'];
									

									//echo '<pre>' . print_r($tarja,true) . '</pre>';
									if( $imagem ){
										if($tarja == true){
											echo '<div>
														<div class="tarja" style="background-color:'.$cor_tarja.';opacity:0.'.$opacidade.'"> </div>
														<img src="'.$imagem.'">
													</div>';
										}else{
											echo '<div>
														<img src="'.$imagem.'">
													</div>';
										}
										
									}
									
								}
							}

						?>
					</div>
			</div>
			<div class="boxMenuGeral">
			<div class="header-fixed">
				<div class="row">				
						<div class="col-12 col-md-6 top-redessociais">
							<ul class="nav justify-content-center">
								<li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<div class="col-12 col-md-6 box_topMenu">
							<div class="top-menu menuLogin">
								<div class="media itemMenu-topHeader">
								  <i class="fa fa-user" aria-hidden="true"></i>
								  <div id="modalLogin" class="media-body" data-toggle="modal" data-target="#modal_login">
								    Login / Cadastre-se
								  </div>
								</div>
							</div>
							<div class="top-menu menuWishilist">
								<div class="media itemMenu-topHeader">
								  <i class="fa fa-heart" aria-hidden="true"></i>
								  <div class="media-body">
								    Wishilist
								  </div>
								</div>
							</div>
							<div class="top-menu menuCart">
								<div class="media itemMenu-topHeader itemMenu-topHeaderCart">
								  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
								</div>
							</div>
						</div>
					</div>
			</div>

			<div class="container">
				<div class="header-primary">
					<div class="row">
						<div class="col-12">
							<div class="logo-principal">
								<?php 
									storefront_site_title_or_logo();
								?>
							</div>
						</div>
					</div>
					<div class="row menu-principal">
						<div class="col-11">
							<?php storefront_primary_navigation(); ?>
						</div>
						<div class="col-1">
							<div class="lupa-busca" data-toggle="modal" data-target=".modal-busca">
								<span><i class="fa fa-search" aria-hidden="true"></i></span>
							</div>
						</div>
					</div>

						<?php
						/**
						 * Functions hooked into storefront_header action
						 *
						 * @hooked storefront_skip_links                       - 0
						 * @hooked storefront_social_icons                     - 10
						 * @hooked storefront_site_branding                    - 20
						 * @hooked storefront_secondary_navigation             - 30
						 * @hooked storefront_product_search                   - 40
						 * @hooked storefront_primary_navigation_wrapper       - 42
						 * @hooked storefront_primary_navigation               - 50
						 * @hooked storefront_header_cart                      - 60
						 * @hooked storefront_primary_navigation_wrapper_close - 68
						 */
						//do_action( 'storefront_header' ); ?>
				</div>
			</div>
		</div>


		</div>
		</div>
	</header><!-- #masthead -->

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 */
	do_action( 'storefront_before_content' ); ?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full">

		<?php
		/**
		 * Functions hooked in to storefront_content_top
		 *
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action( 'storefront_content_top' );