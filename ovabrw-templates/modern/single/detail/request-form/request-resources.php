<?php if ( ! defined( 'ABSPATH' ) ) exit();
	if ( get_option( 'ova_brw_request_booking_form_show_extra_service', 'yes' ) != 'yes' ) return;

	global $product;
	if ( ! $product ) return;

	$product_id = $product->get_id();

	$resources_id = get_post_meta( $product_id, 'ovabrw_resource_id', true );
?>
<?php if ( ! empty( $resources_id ) && is_array( $resources_id ) ):
	$resources_name 	= get_post_meta( $product_id, 'ovabrw_resource_name', true );
	$resources_price 	= get_post_meta( $product_id, 'ovabrw_resource_price', true );
	$resources_type 	= get_post_meta( $product_id, 'ovabrw_resource_duration_type', true );
?>
	<div class="ovabrw-extra-services">
		<label><?php esc_html_e( 'Resources' ); ?></label>
		<div class="ovabrw_resource">
			<?php foreach ( $resources_id as $k => $id ):
				$name 	= isset( $resources_name[$k] ) ? $resources_name[$k] : '';
				$price 	= isset( $resources_price[$k] ) ? $resources_price[$k] : '';
				$type 	= isset( $resources_type[$k] ) ? $resources_type[$k] : '';

				if ( $type === 'days' ) $type = esc_html__( 'Day', 'ova-brw' );
				if ( $type === 'hours' ) $type = esc_html__( 'Hour', 'ova-brw' );
				if ( $type === 'total' ) $type = esc_html__( 'Total', 'ova-brw' );
			?>
				<?php if ( $id != '' && $name != '' ): ?>
					<div class="item">
						<div class="res-left">
							<label class="ovabrw-label-field">
								<?php echo esc_html( $name ); ?>
								<input 
									type="checkbox"
									name="ovabrw_resource_checkboxs[]"
									value="<?php echo esc_attr( $id ); ?>"
									data-resource_key="<?php echo esc_attr( $id ); ?>"
								/>
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="res-right">
							<span class="res-price"><?php echo ovabrw_wc_price( $price ); ?></span>
							<span class="slash">/</span>
							<span class="res-type"><?php echo esc_html( $type ); ?></span>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>