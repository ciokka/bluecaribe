<?php if ( ! defined( 'ABSPATH' ) ) exit();
	global $product;
	
	if ( isset( $args['product_id'] ) && $args['product_id'] ) {
		$product = wc_get_product( $args['product_id'] );
	}
	
	if ( ! $product ) return;
	//$short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);
	$short_description = $product->get_short_description();
?>
<?php if ( $short_description ): ?>
	<div class="ovabrw-product-short-description">
		<?php echo apply_filters( 'woocommerce_short_description', $short_description ); ?>
	</div>
<?php endif; ?>

<!-- INOL3 descrizione mobile -->
<div class="accordion accordion-flush" id="accordionShortdesc">
	<div class="accordion-item">
			<div class="card-body">
				<p class="prodExcerpt"><?php
				$short_description_words = array_slice(str_word_count(strip_tags($short_description), 1), 0, 20);
				$short_description_ellipsis = implode(' ', $short_description_words) . '...';
				echo $short_description_ellipsis;
				?>
			</p>
			</div>
			
		<h2 class="accordion-header" id="flush-headingTwo">
		<a class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
			data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
			<?php esc_html_e( 'Read more', 'hello-elementor-child' ); ?>
			</a>

		</h2>
		<div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
			data-bs-parent="#accordionFlushExample">
			<div class="accordion-body">
			<?php echo wpautop($short_description); // WPCS: XSS ok. ?>
			</div>
		</div>
	</div>
</div>