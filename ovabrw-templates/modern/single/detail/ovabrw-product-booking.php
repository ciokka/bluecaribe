<?php 
	if(isset($_POST['tourOperatorLogin'])) {
		if(isset($_POST['code']) && password_verify($_POST['code'], '$2a$12$hraYa1qapHqc/ZZOS8HTo.yq.YdIrihPZDl2sqPsKJ2MnCfU4C9PK')) {
			setcookie("tourOperator", 1, strtotime( '+30 days' ), '/');
			$_COOKIE["tourOperator"] = 1;
		} 
		else {
			setcookie('tourOperator', 0, 1, '/');
			unset($_COOKIE["tourOperator"]);
		}
	}
?>

<?php
	ob_start();
?>
<?php if ( ! defined( 'ABSPATH' ) ) exit();
	global $product;

	if ( isset( $args['product_id'] ) && $args['product_id'] ) {
		$product = wc_get_product( $args['product_id'] );
	}
	
	if ( ! $product ) return;

	// Loading reCAPTCHA
	ovabrw_loading_reCAPTCHA();
?>
<form
	action=""
	method="POST"
	enctype="multipart/form-data"
	id="booking_form"
	class="ovabrw-form"
	data-mesg_required="<?php esc_html_e( 'This field is required.', 'ova-brw' ); ?>"
	data-run_ajax="<?php esc_attr_e( apply_filters( 'ovabrw_booking_form_run_ajax', 'true' ) ); ?>">
	<div class="ovabrw-product-fields test">
		<!-- ?php do_action('ovabrw_modern_product_price'); RIMOSSO DOPO ATTIVAZIONE SCONTI SU SITO, IMPLEMENTATO INSERENDO IL TEMPLATE DISCOUNT QUI SOTTO INOL3 ?-->
		<?php ovabrw_get_template( 'modern/single/detail/discount/discount-by-period-of-time.php' ); /* da rimuovere */?>
		<?php ovabrw_get_template('modern/single/detail/booking-form/booking-fields.php'); ?>
		<?php ovabrw_get_template('modern/single/detail/booking-form/booking-custom-checkout-fields.php'); ?>
	</div>
	<?php ovabrw_get_template('modern/single/detail/booking-form/booking-resources.php'); ?>
	<?php ovabrw_get_template('modern/single/detail/booking-form/booking-services.php'); ?>
	<?php ovabrw_get_template('modern/single/detail/booking-form/booking-deposit.php'); ?>
	<?php ovabrw_get_template('modern/single/detail/booking-form/booking-show-total.php'); ?>
	<?php ovabrw_get_template('modern/single/detail/booking-form/booking-submit.php'); ?>
</form>
<?php
	$output = ob_get_contents();
	ob_end_clean();
	if( get_field( 'private' ) != 1 ){

				echo $output;
			
		
	} else echo '<style type="text/css">#booking-box .elementor-widget-text-editor { display: none !important; }</style><a class="btn_tran contact" href="'. get_permalink(3332) .'">'.__( 'Contact us', 'hello-elementor-child' ).'</a>';
?>