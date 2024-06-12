<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$text_align = is_rtl() ? 'right' : 'left';
$text_align_end  = is_rtl() ? 'left' : 'right';

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">


<h2 style="text-align:<?php echo esc_attr( $text_align ); ?>; vertical-align: middle; font-family: 'Poppins', sans-serif; word-wrap:break-word;">
	<?php
	if ( $sent_to_admin ) {
		$before = '<a class="link" href="' . esc_url( $order->get_edit_order_url() ) . '">';
		$after  = '</a>';
	} else {
		$before = '';
		$after  = '';
	}
	/* translators: %s: Order ID. */
	echo wp_kses_post( $before . sprintf( __( '[Order #%s]', 'woocommerce' ) . $after . ' (<time datetime="%s">%s</time>)', $order->get_order_number(), $order->get_date_created()->format( 'c' ), wc_format_datetime( $order->get_date_created() ) ) );
	?>
</h2>

<div style="margin-bottom: 40px; margin-top: 40px">
	<table class="td" cellspacing="0" cellpadding="6" style="width: 100%; font-family: 'Poppins', sans-serif; border=1">
		<thead style="background-color:#44aef2">
			<tr>
				<th class="td first" colspan="2" scope="col" style="text-align:<?php echo esc_attr( $text_align ); ?>; color: #ffffff"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="td last" scope="col" style="color: #ffffff; text-align:<?php echo esc_attr( $text_align_end ); ?>;"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
			echo wc_get_email_order_items( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$order,
				array(
					'show_sku'      => $sent_to_admin,
					'show_image'    => false,
					'image_size'    => array( 32, 32 ),
					'plain_text'    => $plain_text,
					'sent_to_admin' => $sent_to_admin,
				)
			);
			?>
		</tbody>
		<tfoot>
			<?php
			$item_totals = $order->get_order_item_totals();

			if ( $item_totals ) {
				$i = 0;
				foreach ( $item_totals as $total ) {
					$i++;
					?>
					<tr>
						<th class="td" scope="row" colspan="2" style="text-align:<?php echo esc_attr( $text_align ); ?>; <?php echo ( 1 === $i ) ? 'border-top-width: 1px;' : ''; ?>"><?php echo wp_kses_post( $total['label'] ); ?></th>
						<td class="td" style="text-align:<?php echo esc_attr( $text_align_end ); ?>; <?php echo ( 1 === $i ) ? 'border-top-width: 1px;' : ''; ?>"><?php echo wp_kses_post( $total['value'] ); ?></td>
					</tr>
					<?php
				}
			}
			?>
			<tr>
				<td colspan="3" class="td" style="text-align:<?php echo esc_attr( $text_align_end ); ?>;">
					&nbsp;
				</td>
			</tr>
			<?php
			if ( $order->get_customer_note() ) {
				?>
				<tr>
					<th class="td" scope="row" colspan="2" style="text-align:<?php echo esc_attr( $text_align ); ?>;"><?php esc_html_e( 'Note:', 'woocommerce' ); ?></th>
					<td class="td" style="text-align:<?php echo esc_attr( $text_align_end ); ?>;"><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
				</tr>
				<?php
			}
			?>
			<?php
			if ( $order->is_created_via('checkout') ) { ?>
			<tr>
				<th class="td" scope="row" colspan="2" style="text-align:<?php echo esc_attr( $text_align ); ?>;">
					<?php echo '<strong>' . esc_html__('Passengers', 'hello-elementor-child') . ':</strong>' ?>
				</th>
				<td class="td" style="text-align:<?php echo esc_attr( $text_align_end ); ?>;">
					<?php echo get_post_meta( $order->get_id(), '_billing_passeggeri', true ) ?>
				</td>
			</tr>
			<tr>
				<th class="td" scope="row" colspan="2" style="text-align:<?php echo esc_attr( $text_align ); ?>;">
					<?php echo '<strong>' . esc_html__('Tour language', 'hello-elementor-child') . ':</strong>' ?>
				</th>
				<td class="td" style="text-align:<?php echo esc_attr( $text_align_end ); ?>;">
					<?php echo get_post_meta( $order->get_id(), '_billing_tlang', true ) ?>
				</td>
			</tr>
			<tr>
				<th class="td" scope="row" colspan="2" style="text-align:<?php echo esc_attr( $text_align ); ?>;">
					<?php echo '<strong>' . esc_html__('Hotel', 'hello-elementor-child') . ':</strong>' ?>
				</th>
				<td class="td" style="text-align:<?php echo esc_attr( $text_align_end ); ?>;">
					<?php echo get_post_meta( $order->get_id(), '_billing_hotel', true ) ?>
				</td>
			</tr>
			<?php
			}
			?>
		</tfoot>
	</table>
</div>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>
