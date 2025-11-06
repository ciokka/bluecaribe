<?php
/**
 * Email Styles
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-styles.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 8.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load colors.
$bg        = get_option( 'woocommerce_email_background_color' );
$body      = get_option( 'woocommerce_email_body_background_color' );
$base      = get_option( 'woocommerce_email_base_color' );
$base_text = wc_light_or_dark( $base, '#202020', '#608DB7' );
$text      = get_option( '#515151' );

// Pick a contrasting color for links.
$link_color = wc_hex_is_light( $base ) ? $base : $base_text;

if ( wc_hex_is_light( $body ) ) {
	$link_color = wc_hex_is_light( $base ) ? $base_text : $base;
}

$bg_darker_10    = wc_hex_darker( $bg, 10 );
$body_darker_10  = wc_hex_darker( $body, 10 );
$base_lighter_20 = wc_hex_lighter( $base, 20 );
$base_lighter_40 = wc_hex_lighter( $base, 40 );
$text_lighter_20 = wc_hex_lighter( $text, 20 );
$text_lighter_40 = wc_hex_lighter( $text, 40 );

// !important; is a gmail hack to prevent styles being stripped if it doesn't like something.
// body{padding: 0;} ensures proper scale/positioning of the email in the iOS native email app.
?>
body {
	background-color: <?php echo esc_attr( $bg ); ?>;
	padding: 0;
	text-align: center;
}

#outer_wrapper {
	background-color: <?php echo esc_attr( $bg ); ?>;
}

#wrapper {
	margin: 0 auto;
	padding: 20px 0;
	-webkit-text-size-adjust: none !important;
	width: 100%;
	max-width: 600px;
}

#template_container {
	box-shadow: 0;
	background-color: <?php echo esc_attr( $bg ); ?>;
	border: none;
	border-radius: 3px !important;
}

#template_header {
	background-color: <?php echo esc_attr( $bg ); ?>;
	border-radius: 3px 3px 0 0 !important;
	color: <?php echo esc_attr( $base_text ); ?>;
	border-bottom: 0;
	font-weight: bold;
	line-height: 100%;
	vertical-align: middle;
	font-family: 'Poppins', sans-serif;
}

#template_header h1,
#template_header h1 a {
	color: <?php echo esc_attr( $base_text ); ?>;
	background-color: inherit;
}
#template_header_image {
	text-align: left;
}
#template_header_image img {
	margin-left: 20px;
	margin-right: 0;
	width: 170px;
}

#template_footer td {
	padding: 0px;
	border-radius: 6px;
}

#template_footer #credit {
	border: 0;
	color: <?php echo esc_attr( $text_lighter_40 ); ?>;
	font-family: 'Poppins', sans-serif;
	font-size: 12px;
	line-height: 150%;
	text-align: center;
	padding: 24px 0;
}

#template_footer #credit p {
	margin: 0 0 16px;
}

#body_content {
	background-color: <?php echo esc_attr( $bg ); ?>;
}

#body_content table td {
	padding: 0 48px 32px;
}

#body_content table td.mainTd {
	padding: 0 20px !important;
}

#body_content table.td {
	border-spacing: 0;
	border-collapse: separate;
	border-radius: 15px;
	background-color: #fff;
}
#body_content table.td thead tr {
	background-color:#608DB7
}
#body_content table.td thead th.first {
	border-radius: 15px 0 0 0;
	border: none;
	border-spacing: 0;
	background-color:#608DB7;
	padding: 10px 20px;
}
#body_content table.td thead th.last {
	border-radius: 0 15px 0 0;
	border: none;
	border-spacing: 0;
	background-color:#608DB7;
	padding: 10px 20px;
}

#body_content table.td tfoot th,
#body_content table.td tfoot td {
	padding: 10px 20px;
	border-top: solid 1px <?php echo esc_attr( $bg ); ?>;
}
#body_content table.td tfoot tr:last-child th,
#body_content table.td tfoot tr:last-child td {
	padding: 10px 20px 40px 20px;
}

#body_content table td td {
	padding: 20px;
}

#body_content table td th {
	padding: 0px;
}

#body_content td ul.wc-item-meta {
	font-size: 14px;
	margin: 1em 0 0;
	padding: 0;
	list-style: none;
}

#body_content td ul.wc-item-meta li {
	margin: 0.5em 0 0;
	padding: 0;
}

#body_content td ul.wc-item-meta li p {
	margin: 0;
}

#body_content p {
	margin: 0 0 4px;
	padding: 0 20px;
}

#body_content_inner {
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	font-family: 'Poppins', sans-serif;
	font-size: 14px;
	line-height: 150%;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

.td {
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	border: none;
	vertical-align: middle;
}

.address {
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	border: none;
	font-family: 'Poppins', sans-serif;
	font-style: normal;
	font-size: 14px;
}

.additional-fields {
	padding: 12px 12px 0;
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	border: 1px solid <?php echo esc_attr( $body_darker_10 ); ?>;
	list-style: none outside;
}

#addresses table {
	padding: 0px 0px 0px 20px;
}


.text {
	color: <?php echo esc_attr( $text ); ?>;
	font-family: 'Poppins', sans-serif;
}

.link {
	color: <?php echo esc_attr( $link_color ); ?>;
}

#header_wrapper {
	padding: 36px 38px 10px 38px;
	display: block;
}

.inspire_checkout_fields_additional_information {
	padding: 0px 0px 0px 20px;
}

h1 {
	color: <?php echo esc_attr( $base ); ?>;
	font-family: 'Poppins', sans-serif;
	font-size: 30px;
	font-weight: 600;
	line-height: 100%;
	margin: 0;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
	text-shadow: none;
}

h2 {
	color: <?php echo esc_attr( $base ); ?>;
	display: block;
	font-family: 'Poppins', sans-serif;
	font-size: 18px;
	font-weight: bold;
	line-height: 130%;
	margin: 0 0 18px;
	padding: 0px 0px 0px 20px;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

h3 {
	color: <?php echo esc_attr( $base ); ?>;
	display: block;
	font-family: 'Poppins', sans-serif;
	font-size: 16px;
	font-weight: 400;
	line-height: 130%;
	margin: 16px 0 8px;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

h4 {
	color: <?php echo esc_attr( $text_lighter_20 ); ?>;
	display: block;
	font-family: 'Poppins', sans-serif;
	font-size: 16px;
	font-weight: 500;
	line-height: 130%;
	margin: 25px 0 25px;
	text-align: <?php echo is_rtl() ? 'right' : 'left'; ?>;
}

a {
	color: #000;
	font-weight: normal;
	text-decoration: underline;
}

img {
	border: none;
	display: inline-block;
	font-size: 14px;
	font-weight: bold;
	height: auto;
	outline: none;
	text-decoration: none;
	text-transform: capitalize;
	vertical-align: middle;
	margin-<?php echo is_rtl() ? 'left' : 'right'; ?>: 10px;
	max-width: 100%;
}

.boxed {
	background-color: #FFFFFF;
	border-radius: 20px;
	padding: 20px;
	margin-top: 20px !important;
}

.txtFooter {
	padding: 0px 0px 0px 20px;
}

.wc-bacs-bank-details-account-name {
	padding: 0px 0px 0px 20px;
}

.wc-bacs-bank-details-heading {
	padding: 20px 0px 0px 20px;
}

.linkFooterEmail {
	padding-bottom: 50px;
}
.payment-text a {
    font-weight: normal;
    background-color: #608DB7;
    border-radius: 30px 30px 30px 30px;
    padding: 12px 22px 12px 22px;
    color: #fff;
    display: inline-block;
    height: 16px;
    width: auto;
    line-height: 16px;
    text-decoration: none;
    margin: 20p 0;
}

/**
 * Media queries are not supported by all email clients, however they do work on modern mobile
 * Gmail clients and can help us achieve better consistency there.
 */
@media screen and (max-width: 600px) {
	#header_wrapper {
		padding: 27px 20px !important;
		font-size: 24px;
	}

	#body_content table > tbody > tr > td {
		padding: 20px !important;
	}

	#body_content_inner {
		font-size: 13px !important;
	}

	h2 {
		font-size: 18px;
		padding: 10px 20px;
	}

	h1 {
		padding: 0px 0px 0px 20px !important;
	}

}



<?php
