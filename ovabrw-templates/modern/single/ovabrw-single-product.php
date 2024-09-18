<?php if ( ! defined( 'ABSPATH' ) ) exit();

get_header( 'shop' );
	do_action( 'woocommerce_before_main_content' );
	while ( have_posts() ):
		the_post();
		include get_stylesheet_directory() . '/single-product/single-product.php';
	endwhile;
	do_action( 'woocommerce_after_main_content' );
	do_action( 'woocommerce_sidebar' );
get_footer( 'shop' );
?>