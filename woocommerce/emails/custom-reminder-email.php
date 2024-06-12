<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Custom Reminder Email
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/custom-reminder-email.php.
 *
 * @package WooCommerce/Templates/Emails
 * @version 2.5.0
 */

do_action( 'woocommerce_email_header', $email_heading, $email );

// Content of your email
?>
<p><?php printf( __( 'Dear %s,', 'woocommerce' ), $order->get_billing_first_name() ); ?></p>
<p><?php _e( 'This is a reminder for your upcoming order:', 'woocommerce' ); ?></p>
<ul>
    <li><?php printf( __( 'Product: %s', 'woocommerce' ), $product_name ); ?></li>
    <li><?php printf( __( 'Pickup Date: %s', 'woocommerce' ), $ovabrw_pickup_date ); ?></li>
</ul>
<p><?php _e( 'Thank you for shopping with us!', 'woocommerce' ); ?></p>
<?php

do_action( 'woocommerce_email_footer', $email );
