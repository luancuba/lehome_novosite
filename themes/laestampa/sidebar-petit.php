<h3 class="filtros">Filtrar</h3>
<?php 

//$current_cat = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]); 

	
$children = get_terms( array('taxonomy' => 'product_cat', 'hide_empty' => false) ); 

$tema = get_terms( array('taxonomy' => 'tema', 'hide_empty' => false) ); 

$composicao = get_terms( array('taxonomy' => 'composicao', 'hide_empty' => false) ); 

$colecao = get_terms( array('taxonomy' => 'colecao', 'hide_empty' => false) ); 

$cor = get_terms( array('taxonomy' => 'cor', 'hide_empty' => false) ); 

//echo '<pre>' . print_r($children) . '</pre>';exit();

if ( empty( $children ) ) {

	$children = get_terms( [ 'taxonomy' => 'product_cat', 'hide_empty' => false] ); 

}



?>
	<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>

	<input type="hidden" class="actual-url" value="<?php echo $actual_link; ?>"/>
<?php if ( $children ): 

	if ( $_GET && isset( $_GET['tid'] ) ):
		echo '<div id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories filtromobile"><h4>FILTROS</h4><ul class="product-categories">';
		$tid = $_GET['tid'];
		foreach($tid as $t):  $c = get_term( intval( $t ) ); ?>
		<li>
			<a class="remove-category-url" data-id="<?php echo $c->term_id; ?>" href="#">
				<?php $icon = 'http://petitpapier.com.br/wp-content/uploads/2017/12/erase-x.png'; ?>
				<img src="<?php echo $icon; ?>" style="margin-top: -4px; margin-right: 5px;">
				<?php echo $c->name; ?>
			</a>
		</li>

<?php endforeach; echo '</ul></div>'; endif; ?>

<div class="boxFiltros">

<div id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories filtromobile">
	<h4>TEMA</h4>
	<ul class="product-categories">

		<?php foreach($tema as $c): ?>

		<li>
			<?php if ( is_int( stripos( $actual_link, '='.$c->term_id ) ) ) { ?>
				<a class="link-category active" data-id="<?php echo $c->term_id; ?>" data-slug="tema" href="#">
					<?php $icon = 'http://petitpapier.com.br/wp-content/uploads/2017/12/square-check-x.png'; ?>
					<img src="<?php echo $icon; ?>" style="margin-top: -4px; margin-right: 5px;">
					<?php echo $c->name; ?>
				</a>
			<?php } else { ?>
				<a class="link-category" data-id="<?php echo $c->term_id; ?>" data-slug="tema" href="#">
					<?php $icon = 'http://petitpapier.com.br/wp-content/uploads/2017/12/square-x.png'; ?>
					<img src="<?php echo $icon; ?>" style="margin-top: -4px; margin-right: 5px;">
					<?php echo $c->name; ?>
				</a>
			<?php } ?>
			
		</li>

		<?php 
			endforeach;
			wp_reset_postdata(); ?>

	</ul>
</div>

<div id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories">
	<h4>COMPOSIÇÃO</h4>
	<ul class="product-categories">

		<?php foreach($composicao as $c): ?>

		<li>
			<?php if ( is_int( stripos( $actual_link, '='.$c->term_id ) ) ) { ?>
				<a class="link-category active" data-id="<?php echo $c->term_id; ?>" data-slug="composicao" href="#">
					<?php $icon = 'http://petitpapier.com.br/wp-content/uploads/2017/12/square-check-x.png'; ?>
					<img src="<?php echo $icon; ?>" style="margin-top: -4px; margin-right: 5px;">
					<?php echo $c->name; ?>
				</a>
			<?php } else { ?>
				<a class="link-category" data-id="<?php echo $c->term_id; ?>" data-slug="composicao" href="#">
					<?php $icon = 'http://petitpapier.com.br/wp-content/uploads/2017/12/square-x.png'; ?>
					<img src="<?php echo $icon; ?>" style="margin-top: -4px; margin-right: 5px;">
					<?php echo $c->name; ?>
				</a>
			<?php } ?>
			
		</li>

		<?php 
			endforeach;
			wp_reset_postdata(); ?>

	</ul>
</div>



<div id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories">
	<h4>PRODUTO</h4>
	<ul class="product-categories">

		<?php foreach($children as $c): ?>

		<li>
			<?php if ( is_int( stripos( $actual_link, '='.$c->term_id ) ) ) { ?>
				<a class="link-category active" data-id="<?php echo $c->term_id; ?>" data-slug="product_cat" href="#">
					<?php $icon = 'http://petitpapier.com.br/wp-content/uploads/2017/12/square-check-x.png'; ?>
					<img src="<?php echo $icon; ?>" style="margin-top: -4px; margin-right: 5px;">
					<?php echo $c->name; ?>
				</a>
			<?php } else { ?>
				<a class="link-category" data-id="<?php echo $c->term_id; ?>" data-slug="product_cat" href="#">
					<?php $icon = 'http://petitpapier.com.br/wp-content/uploads/2017/12/square-x.png'; ?>
					<img src="<?php echo $icon; ?>" style="margin-top: -4px; margin-right: 5px;">
					<?php echo $c->name; ?>
				</a>
			<?php } ?>
			
		</li>

		<?php 
			endforeach;
			wp_reset_postdata(); ?>

	</ul>
</div>






<div id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories">
	<h4>COLEÇÃO</h4>
	<ul class="product-categories">

		<?php foreach($colecao as $c): ?>

		<li>
			<?php if ( is_int( stripos( $actual_link, '='.$c->term_id ) ) ) { ?>
				<a class="link-category active" data-id="<?php echo $c->term_id; ?>" data-slug="colecao" href="#">
					<?php $icon = 'http://petitpapier.com.br/wp-content/uploads/2017/12/square-check-x.png'; ?>
					<img src="<?php echo $icon; ?>" style="margin-top: -4px; margin-right: 5px;">
					<?php echo $c->name; ?>
				</a>
			<?php } else { ?>
				<a class="link-category" data-id="<?php echo $c->term_id; ?>" data-slug="colecao" href="#">
					<?php $icon = 'http://petitpapier.com.br/wp-content/uploads/2017/12/square-x.png'; ?>
					<img src="<?php echo $icon; ?>" style="margin-top: -4px; margin-right: 5px;">
					<?php echo $c->name; ?>
				</a>
			<?php } ?>
			
		</li>

		<?php 
			endforeach;
			wp_reset_postdata(); ?>

	</ul>
</div>


<div id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories">
	<h4>COR</h4>
	<ul class="product-categories">

		<?php foreach($cor as $c): ?>

		<li>
			<?php if ( is_int( stripos( $actual_link, '='.$c->term_id ) ) ) { ?>
				<a class="link-category active" data-id="<?php echo $c->term_id; ?>" data-slug="cor" href="#">
					<?php $icon = 'http://petitpapier.com.br/wp-content/uploads/2017/12/square-check-x.png'; ?>
					<img src="<?php echo $icon; ?>" style="margin-top: -4px; margin-right: 5px;">
					<?php echo $c->name; ?>
				</a>
			<?php } else { ?>
				<a class="link-category" data-id="<?php echo $c->term_id; ?>" data-slug="cor" href="#">
					<?php $icon = 'http://petitpapier.com.br/wp-content/uploads/2017/12/square-x.png'; ?>
					<img src="<?php echo $icon; ?>" style="margin-top: -4px; margin-right: 5px;">
					<?php echo $c->name; ?>
				</a>
			<?php } ?>
			
		</li>

		<?php 
			endforeach;
			wp_reset_postdata(); ?>

	</ul>
</div>

</div>

<?php endif; ?>



<?php dynamic_sidebar('widgetized-area'); ?>