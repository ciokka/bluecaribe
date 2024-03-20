<?php if ( ! defined( 'ABSPATH' ) ) exit();
	if ( get_option( 'ova_brw_request_booking_form_show_service', 'yes' ) != 'yes' ) return;

	global $product;
	if ( ! $product ) return;

	$product_id = $product->get_id();
?>
<?php if ( get_option( 'ova_brw_request_booking_form_show_extra_info', 'yes' ) === 'yes' ): ?>
		<div class="ovabrw-request-extra">
			<label><?php esc_html_e( 'Extra Information', 'ova-brw' ); ?></label>
			<textarea name="extra"></textarea>
		</div>
	<?php endif; ?>
<button type="submit" class="submit"><?php esc_html_e( 'Send', 'ova-brw' ); ?> </button>
<input type="hidden" name="product_name" value="<?php echo esc_attr( get_the_title() ); ?>" />
<input type="hidden" name="product_id" value="<?php echo esc_attr( $product_id ); ?>" />
<input type="hidden" name="request_booking" value="request_booking" />