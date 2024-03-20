<?php if ( ! defined( 'ABSPATH' ) ) exit();
	global $product;

    if ( isset( $args['product_id'] ) && $args['product_id'] ) {
        $product = wc_get_product( $args['product_id'] );
    }
    
    if ( ! $product ) return;

	$product_url 	= $product->get_permalink();
	$review_count   = $product->get_review_count();
	$rating         = $product->get_average_rating();
?>
<?php if ( wc_review_ratings_enabled() && $rating > 0 ): ?>
    <div class="ovabrw-product-review">
        <div class="ovabrw-star-rating" role="img" aria-label="<?php echo sprintf( __( 'Rated %s out of 5', 'ova-brw' ), $rating ); ?>">
        	<i aria-hidden="true" class="brwicon-star-3"></i>
        	<i aria-hidden="true" class="brwicon-star-3"></i>
        	<i aria-hidden="true" class="brwicon-star-3"></i>
        	<i aria-hidden="true" class="brwicon-star-3"></i>
        	<i aria-hidden="true" class="brwicon-star-3"></i>
            <span class="ovabrw-rating-percent" style="width: <?php echo esc_attr( ( $rating / 5 ) * 100 ).'%'; ?>;">
            	<i aria-hidden="true" class="brwicon-star-3"></i>
            	<i aria-hidden="true" class="brwicon-star-3"></i>
            	<i aria-hidden="true" class="brwicon-star-3"></i>
            	<i aria-hidden="true" class="brwicon-star-3"></i>
            	<i aria-hidden="true" class="brwicon-star-3"></i>
            </span>
        </div>
        <a href="<?php echo esc_url( $product_url.'#reviews' ); ?>" class="ovabrw-review-link" rel="nofollow">
            <?php printf( _n( '%s review', '%s reviews', $review_count, 'ova-brw' ), esc_html( $review_count ) ); ?>
        </a>
    </div>
<?php endif; ?>
<div class="pdfTour">
	<?php do_action('woocommerce_after_add_to_cart_button'); ?>
	<?php if (get_field('pdf_tour')): ?>
		<a class="submit downloadPDF" href="<?php the_field('pdf_tour'); ?>">
			<img class="iconPdf" src="<?php echo get_stylesheet_directory_uri() . '/assets/images/pdf-file.svg'; ?>" width="32" ; height="32"/><span class="txtPdf"><?php esc_html_e('download tour pdf', 'hello-elementor-child'); ?>
			</a>
		</span>
	<?php endif; ?>
</div>
