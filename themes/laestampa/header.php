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

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'storefront_before_site' ); ?>

<div id="page" class="hfeed site">
	<?php do_action( 'storefront_before_header' ); ?>

	<header id="masthead" class="header-top" role="banner" style="<?php storefront_header_styles(); ?>">
		<div class="header-1">
			<div class="header-fixed">
				<div class="container-fluid">
				<div class="row">				
						<div class="col-6 top-redessociais">
							<ul class="nav justify-content-center">
								<li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
								<li class="nav-item"><a class="nav-link" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<div class="col-6 top-menu">menu</div>
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
						<div class="col-12">
							<?php storefront_primary_navigation(); ?>
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
			<div class="container-fluid">
				<div class="row">
					<div class="line_menu">
						<hr/>
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