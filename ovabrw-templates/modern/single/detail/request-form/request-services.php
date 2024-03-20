<?php if ( ! defined( 'ABSPATH' ) ) exit();
	if ( get_option( 'ova_brw_request_booking_form_show_service', 'yes' ) != 'yes' ) return;

	global $product;
	if ( ! $product ) return;

	$product_id 	= $product->get_id();
	$services_label = get_post_meta( $product_id, 'ovabrw_label_service', true );
?>
<?php if ( ! empty( $services_label ) && is_array( $services_label ) ):
	$services_required 	= get_post_meta( $product_id, 'ovabrw_service_required', true );
	$services_id 		= get_post_meta( $product_id, 'ovabrw_service_id', true );
	$services_name 		= get_post_meta( $product_id, 'ovabrw_service_name', true );
?>
	<div class="ovabrw-services">
		<label><?php esc_html_e( 'Services', 'ova-brw' ); ?></label>
		<div class="ovabrw-service">
			<?php for ( $i = 0; $i < count( $services_label ); $i++ ):
				$label 		= $services_label[$i];
				$required 	= isset( $services_required[$i] ) ? $services_required[$i] : '';

				// Option
				$serv_ids = isset( $services_id[$i] ) ? $services_id[$i] : '';
			?>
				<div class="rental_item">
					<div class="error_item">
						<label><?php esc_html_e( 'This field is required', 'ova-brw' ) ?></label>
					</div>
					<select name="ovabrw_service[]" <?php if ( $required === 'yes' ) echo 'class="required"'; ?>>
						<option value="">
							<?php printf( esc_html__( 'Select %s', 'ova-brw' ), $label ); ?>
						</option>
						<?php if ( ! empty( $serv_ids ) && is_array( $serv_ids ) ): ?>
							<?php foreach ( $serv_ids as $k => $id ):
								$name = isset( $services_name[$i][$k] ) ? $services_name[$i][$k] : '';
							?>
								<option value="<?php echo esc_attr( $id ); ?>">
									<?php echo esc_html( $name ); ?>
								</option>
							<?php endforeach; ?>
						<?php endif; ?>
					</select>
				</div>
			<?php endfor; ?>
		</div>
	</div>
<?php endif; ?>