<?php if ( ! defined( 'ABSPATH' ) ) exit();
	global $product;
	if ( ! $product ) return;

	$title = $product->get_title();
?>
<?php if ( $title ): ?>
	<h2 class="ovabrw-product-title"><?php echo esc_html( $title ); ?></h2>
<?php endif; ?>