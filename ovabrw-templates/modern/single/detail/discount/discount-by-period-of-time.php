<?php if ( ! defined( 'ABSPATH' ) ) exit();
	global $product;
	if ( ! $product ) return;

	$product_id = $product->get_id();

	$peoftime_label = get_post_meta( $product_id, 'ovabrw_petime_label', true ); 
	$peoftime_price = get_post_meta( $product_id, 'ovabrw_petime_price', true );
?>
<?php if ( ! empty( $peoftime_label ) && ! empty( $peoftime_price ) ): ?>
	<!-- modifica per prezzi scheda prodotto pubblici INOL3-->
	<div class="ovabrw-product-discount ovabrw-product-price boxPrezzi flex-column">
		<?php foreach ( $peoftime_label as $k => $label ):
			$price 				= isset( $peoftime_price[$k] ) ? $peoftime_price[$k] : '';
			$peoftime_discount 	= get_post_meta( $product_id, 'ovabrw_petime_discount', true );
			$discount_price 	= isset( $peoftime_discount[$k]['price'] ) ? $peoftime_discount[$k]['price'] : '';
			$discount_start 	= isset( $peoftime_discount[$k]['start_time'] ) ? $peoftime_discount[$k]['start_time'] : '';
			$discount_end 		= isset( $peoftime_discount[$k]['end_time'] ) ? $peoftime_discount[$k]['end_time'] : '';
		?>

			<?php if ( ! empty( $discount_price ) ):
				$date_format = ovabrw_get_date_format() . ' ' . ovabrw_get_time_format_php();
			?>
				<?php foreach ( $discount_price as $dsc_k => $dsc_price ):
					$start 	= isset( $discount_start[$dsc_k] ) ? $discount_start[$dsc_k] : '';
					$end 	= isset( $discount_end[$dsc_k] ) ? $discount_end[$dsc_k] : '';
					$priceint = intval($price); // Converte il valore in intero
					$discount_priceint = intval($dsc_price ); // Converte il valore in intero
					$discount_percentage = (($priceint - $discount_priceint) / $priceint) * 100;
					$discount_percentage = round($discount_percentage);
				?>
					<?php if ( $dsc_price != '' && $start != '' && $end != '' ): ?>
						<div class="d-flex flex-row align-items-center ">
							<span class="unit textPrezzo"><?php esc_html_e($label, 'hello-elementor-child'); ?></span>
							<span class="prezzo sconto"><?php echo ovabrw_wc_price( $dsc_price ); ?></span>
							<span class="prezzo barrato"><?php echo ovabrw_wc_price( $price ); ?></span>
							<div class="badge"><?php echo "-" . $discount_percentage . "%"; ?></div>
						</div>
				<?php endif; ?>
				<?php endforeach; ?>

			<?php else: ?>
				<div class="d-flex flex-row align-items-center ">
					<span class="unit textPrezzo"><?php esc_html_e($label, 'hello-elementor-child'); ?>:</span>
					<span class="amount prezzo"><?php echo ovabrw_wc_price( $price ); ?></span>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
		
	</div>
<?php endif; ?>