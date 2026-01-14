<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if (!function_exists('chld_thm_cfg_locale_css')) :
    function chld_thm_cfg_locale_css($uri)
    {
        if (empty($uri) && is_rtl() && file_exists(get_template_directory() . '/rtl.css'))
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter('locale_stylesheet_uri', 'chld_thm_cfg_locale_css');

if (!function_exists('child_theme_configurator_css')) :
    function child_theme_configurator_css()
    {
        wp_enqueue_style('chld_thm_cfg_child', trailingslashit(get_stylesheet_directory_uri()) . 'style.css', array('hello-elementor', 'hello-elementor', 'hello-elementor-theme-style'));
    }
endif;
add_action('wp_enqueue_scripts', 'child_theme_configurator_css', 998);

// Attivo editor classic
add_filter('use_block_editor_for_post', '__return_false', 10);


function theme_add_js()
{
    wp_enqueue_script('bootstrap-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array(), '5.2.2', true);
    wp_enqueue_script('ova-js', get_stylesheet_directory_uri() . '/assets/js/ova.js', array('jquery'), '', true);
    wp_enqueue_script('spinner-js', get_stylesheet_directory_uri() . '/assets/js/bootstrap-input-spinner.js', array('jquery'), '', true);
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), '', true);
    wp_enqueue_script('lottie-js', get_stylesheet_directory_uri() . '/assets/js/lottie.min.js', array('jquery'), '', true);
    wp_enqueue_script('swiper', get_stylesheet_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), null, true);
}

add_action('wp_enqueue_scripts', 'theme_add_js', 11);

function resizemenu_js()
{
    wp_enqueue_script('resize-menu-js', get_stylesheet_directory_uri() . '/assets/js/resize-menu.js', array('jquery'), '', true);
}

add_action('wp_enqueue_scripts', 'resizemenu_js', 999);
/**
 *    function add_stylesheet_to_head() {
 *        echo "<link href='".get_stylesheet_directory_uri()."/assets/css/checkout.css' rel='stylesheet' type='text/css'>";
 *    }
 *    add_action( 'wp_head', 'add_stylesheet_to_head' );
 */

// Display Item Meta in Order Detail

remove_all_filters('woocommerce_display_item_meta');
function my_ovabrw_woocommerce_display_item_meta($html, $item, $args)
{
    $strings = array();
    $html = '';
    //unset ($args['label_before']);
    //var_dump($args);

    $args = wp_parse_args(
        array(
            'before' => '<ul class="wc-item-meta"><li>',
            'after' => '</li></ul>',
            'separator' => '</li><li class="list-|%NR%|">',
            'echo' => true,
            'autop' => false,
            'label_before' => '<strong class="wc-item-meta-label">',
            'label_after' => ':</strong>',
        ),
        $args
    );

    $product_id = $item['product_id'];
    $product = wc_get_product($product_id);
    $product_name = $product->get_name();

    if ($product) {

        $categories = get_the_terms($product_id, 'product_cat');

        if ($categories && !is_wp_error($categories)) {

            $category_names = array();

            foreach ($categories as $category) {

                $category_names[] = $category->name;
            }

           // var_dump($category_names);
             echo '<p style="font-weight: normal; text-align: start;" class="custom-category">' . implode(', ', $category_names) . '</p>';
        }
    }

    
    $counter = 1;
    foreach ($item->get_formatted_meta_data() as $meta_id => $meta) {


        if (in_array($meta->key, apply_filters('ovabrw_order_detail_hide_fields', array('ovabrw_pickup_date_real', 'ovabrw_pickoff_date_real', 'id_vehicle', 'define_day', 'ovabrw_amount_insurance')))) {
            $strings[] = '';
        } else {
            $value = $args['autop'] ? wp_kses_post($meta->display_value) : wp_kses_post(make_clickable(trim($meta->display_value)));
            $strings[] = str_replace("|%NR%|", $counter, $args['label_before']) . wp_kses_post($meta->display_key) . $args['label_after'] . $value;
        }
        $counter++;
    }

    if ($strings) {
        $html = $args['before'];
        $counter = 0;
        foreach ($strings as $string) {
            $html .= str_replace("|%NR%|", $counter, $args['separator']) . $string;
            $counter++;
        }
        $html .= $args['after'];
    }

    $html = str_replace('ovabrw_pickup_loc', esc_html__(' Pick-up Location ', 'ova-brw'), $html);
    $html = str_replace('ovabrw_pickoff_loc', esc_html__(' Drop-off Location ', 'ova-brw'), $html);
    $html = str_replace('ovabrw_pickup_date', esc_html__(' Pick-up date ', 'ova-brw'), $html);
    $html = str_replace('ovabrw_pickoff_date', esc_html__(' Drop-off date ', 'ova-brw'), $html);
    $html = str_replace('ovabrw_total_days', esc_html__(' Total Time ', 'ova-brw'), $html);
    $html = str_replace('ovabrw_price_detail', esc_html__(' Price Detail ', 'ova-brw'), $html);
    $html = str_replace('rental_type', esc_html__(' Rental Type', 'ova-brw'), $html);
    $html = str_replace('period_label', esc_html__(' Package', 'ova-brw'), $html);
    $html = str_replace('package_type', esc_html__(' Package Type', 'ova-brw'), $html);
    $html = str_replace('define_day', esc_html__(' Define day', 'ova-brw'), $html);
    $html = str_replace('ovabrw_original_order_id', esc_html__(' Original Order ', 'ova-brw'), $html);
    $html = str_replace('ovabrw_remaining_balance_order_id', esc_html__(' Remaining Balance Order ', 'ova-brw'), $html);

    return $html;
}

add_filter('woocommerce_display_item_meta', 'my_ovabrw_woocommerce_display_item_meta', 10, 3);



// // remove_all_actions('ovabrw_booking_form');
// remove_action('ovabrw_booking_form', 'ovabrw_booking_form_services', 20);
// function ovabrw_booking_form_services_i3($product_id)
// {
//     return ovabrw_get_template('single/booking-form/services.php', array('product_id' => $product_id));
// }

// add_action('ovabrw_booking_form', 'ovabrw_booking_form_services_i3', 4, 1);



/**
 * Format the price with a currency symbol.
 *
 * @param  float $price Raw price.
 * @param  array $args  Arguments to format a price {
 *     Array of arguments.
 *     Defaults to empty array.
 *
 *     @type bool   $ex_tax_label       Adds exclude tax label.
 *                                      Defaults to false.
 *     @type string $currency           Currency code.
 *                                      Defaults to empty string (Use the result from get_woocommerce_currency()).
 *     @type string $decimal_separator  Decimal separator.
 *                                      Defaults the result of wc_get_price_decimal_separator().
 *     @type string $thousand_separator Thousand separator.
 *                                      Defaults the result of wc_get_price_thousand_separator().
 *     @type string $decimals           Number of decimals.
 *                                      Defaults the result of wc_get_price_decimals().
 *     @type string $price_format       Price format depending on the currency position.
 *                                      Defaults the result of get_woocommerce_price_format().
 * }
 * @return string
 */

// /*
// function wc_price( $price, $args = array() ) {
// 	$args = apply_filters(
// 		'wc_price_args',
// 		wp_parse_args(
// 			$args,
// 			array(
// 				'ex_tax_label'       => false,
// 				'currency'           => '',
// 				'decimal_separator'  => wc_get_price_decimal_separator(),
// 				'thousand_separator' => wc_get_price_thousand_separator(),
// 				'decimals'           => wc_get_price_decimals(),
// 				'price_format'       => get_woocommerce_price_format(),
// 			)
// 		)
// 	);

// 	$original_price = $price;

// 	// Convert to float to avoid issues on PHP 8.
// 	$price = (float) $price;

// 	$unformatted_price = $price;
// 	$negative          = $price < 0;


// 	$price = apply_filters( 'raw_woocommerce_price', $negative ? $price * -1 : $price, $original_price );


// 	$price = apply_filters( 'formatted_woocommerce_price', number_format( $price, $args['decimals'], $args['decimal_separator'], $args['thousand_separator'] ), $price, $args['decimals'], $args['decimal_separator'], $args['thousand_separator'], $original_price );

// 	if ( apply_filters( 'woocommerce_price_trim_zeros', false ) && $args['decimals'] > 0 ) {
// 		$price = wc_trim_zeros( $price );
// 	}

// 	$formatted_price = ( $negative ? '-' : '' ) . sprintf( $args['price_format'], '<span class="woocommerce-Price-currencySymbol">' . get_woocommerce_currency_symbol( $args['currency'] ) . '</span>', $price );
// 	$return          = '<span class="woocommerce-Price-amount amount"><bdi>' . $formatted_price . '</bdi></span>';

// 	if ( $args['ex_tax_label'] && wc_tax_enabled() ) {
// 		$return .= ' <small class="woocommerce-Price-taxLabel tax_label">' . WC()->countries->ex_tax_or_vat() . '</small>';
// 	}


// 	return apply_filters( 'wc_price', $return, $price, $args, $unformatted_price, $original_price );
// }
// */


add_filter('formatted_woocommerce_price', 'span_custom_prc', 10, 5);

function span_custom_prc($number_format, $price, $decimals, $decimal_separator, $thousand_separator)
{   
    global $WOOCS;
    global $post;
    
    if(is_null($WOOCS) || !isset($WOOCS)) return $number_format;

    if ( isset($WOOCS) && !is_null($WOOCS) && (isset($_REQUEST['action']) && $_REQUEST['action'] == "ovabrw_calculate_total") || ($post && $post->ID)) {
        $number_format = $WOOCS->woocs_exchange_value($number_format);
        return '<span class="custom-prc">' . $number_format . '</span>';
    } else {
        return $number_format;
    }
}


/**
 * Preview WooCommerce Emails.
 * @url https://github.com/WordImpress/woocommerce-preview-emails
 * If you are using a child-theme, then use get_stylesheet_directory() instead
 */

$preview = get_stylesheet_directory() . '/woocommerce/emails/woo-preview-emails.php';

if (file_exists($preview)) {
    require $preview;
}



if (!function_exists('my_ovabrw_search_vehicle')) {
    function my_ovabrw_search_vehicle($data_search)
    {
        $name_product   = isset($data_search['ovabrw_name_product']) ? sanitize_text_field($data_search['ovabrw_name_product']) : '';
        $pickup_loc     = isset($data_search['ovabrw_pickup_loc']) ? sanitize_text_field($data_search['ovabrw_pickup_loc']) : '';
        $pickoff_loc    = isset($data_search['ovabrw_pickoff_loc']) ? sanitize_text_field($data_search['ovabrw_pickoff_loc']) : '';
        $pickup_date    = isset($data_search['ovabrw_pickup_date'])  ? strtotime($data_search['ovabrw_pickup_date']) : '';
        $pickoff_date   = isset($data_search['ovabrw_pickoff_date']) ? strtotime($data_search['ovabrw_pickoff_date']) : '';
        $order          = $data_search['order'];
        $orderby        = $data_search['orderby'];
        $name_attribute = isset($data_search['ovabrw_attribute']) ? sanitize_text_field($data_search['ovabrw_attribute']) : '';
        $value_attribute = isset($data_search[$name_attribute]) ? sanitize_text_field($data_search[$name_attribute]) : '';
        $category       = isset($data_search['cat']) ? sanitize_text_field($data_search['cat']) : '';
        $tag_product    = isset($data_search['ovabrw_tag_product']) ? sanitize_text_field($data_search['ovabrw_tag_product']) : '';
        $list_taxonomy  = ovabrw_create_type_taxonomies();
        $arg_taxonomy_arr = [];

        if (!empty($list_taxonomy)) {
            foreach ($list_taxonomy as $taxonomy) {
                $taxonomy_get = isset($data_search[$taxonomy['slug'] . '_name']) ? sanitize_text_field($data_search[$taxonomy['slug'] . '_name']) : '';

                if ($taxonomy_get != '') {
                    $arg_taxonomy_arr[] = array(
                        'taxonomy' => $taxonomy['slug'],
                        'field' => 'slug',
                        'terms' => $taxonomy_get
                    );
                } else {
                    $arg_taxonomy_arr[] = '';
                }
            }
        }

        $statuses   = brw_list_order_status();
        $error      = array();
        $items_id   = $args_cus_tax_custom = array();

        if ($name_product == '') {
            $args_base = array(
                'post_type'         => 'product',
                'posts_per_page'    => '-1',
                'post_status'       => 'publish'
            );
        } else {
            $args_base = array(
                'post_type'         => 'product',
                'posts_per_page'    => '-1',
                's'                 => $name_product,
                'post_status'       => 'publish'
            );
        }
        if ($category != '') {
            $arg_taxonomy_arr[] = [
                'taxonomy'  => 'product_cat',
                'field'     => 'slug',
                'terms'     => $category
            ];
        }
        if ($name_attribute != '') {
            $arg_taxonomy_arr[] = [
                'taxonomy'  => 'pa_' . $name_attribute,
                'field'     => 'slug',
                'terms'     => [$value_attribute],
                'operator'  => 'IN',
            ];
        }
        if ($tag_product != '') {
            $arg_taxonomy_arr[] = [
                'taxonomy'  => 'product_tag',
                'field'     => 'name',
                'terms'     => $tag_product
            ];
        }
        if (!empty($arg_taxonomy_arr)) {
            $args_cus_tax_custom = array(
                'tax_query'     => array(
                    'relation'  => 'AND',
                    $arg_taxonomy_arr
                )
            );
        }

        $args = array_merge_recursive($args_base, $args_cus_tax_custom);

        // Get All products
        $items = new WP_Query($args);


        if ($items->have_posts()) : while ($items->have_posts()) : $items->the_post();
                // Product ID
                $id = get_the_id();
                if($pickup_date !== false){
                    $disabled_day = get_post_meta($id, 'ovabrw_product_disable_week_day');
                    if (is_array($disabled_day) && count($disabled_day) > 0 && $disabled_day[0] != '')
                    $disabled_day = explode(',', str_replace(' ', '', $disabled_day[0]));
                    else  $disabled_day = [];

                    $pd = date('w', $pickup_date);
                    
                    if (in_array($pd, $disabled_day)) continue;
                }

                // Check location
                if (!ovabrw_check_location($id, $pickup_loc, $pickoff_loc)) continue;

                // Set Pick-up, Drop-off Date again
                $new_input_date     = ovabrw_new_input_date($id, $pickup_date, $pickoff_date, '', $pickup_loc, $pickoff_loc);
                $pickup_date_new    = $new_input_date['pickup_date_new'];
                $pickoff_date_new   = $new_input_date['pickoff_date_new'];

                $ova_validate_manage_store = ova_validate_manage_store($id, $pickup_date_new, $pickoff_date_new, $pickup_loc, $pickoff_loc, $passed = false, $validate = 'search');

                if ($ova_validate_manage_store && $ova_validate_manage_store['status']) {
                    array_push($items_id, $id);
                }
            endwhile;
        else :
            return $items_id;
        endif;
        wp_reset_postdata();

        if ($items_id) {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            // $search_items_page = wc_get_default_products_per_row() * wc_get_default_product_rows_per_page();
            $search_items_page = 100;
            
            $args_product = array(
                'post_type'         => 'product',
                'posts_per_page'    => $search_items_page,
                'paged'             => $paged,
                'post_status'       => 'publish',
                'post__in'          => $items_id,
                'order'             => $order,
                'orderby'           => $orderby
            );
            $rental_products = new WP_Query($args_product);

            return $rental_products;
        }

        return false;
    }
}

// Shortcode to output custom PHP in Elementor
function wpc_elementor_shortcode($atts)
{
    $atts = array_change_key_case((array) $atts, CASE_LOWER);

    // override default attributes with user attributes
    if (isset($atts['key']) && $atts['key']) {
        return esc_html_e($atts['key'], 'hello-elementor-child');
    } else return 'traduzione non trovata';
}
add_shortcode('custom-translation', 'wpc_elementor_shortcode');

// Override OVR lingua INOL3
/*
$loc = substr($locale, 0, 2);
$text_domain = 'ova-brw';
$mofile = sprintf( '%s-%s.mo', $text_domain, $loc );
$original_language_file = ABSPATH . DIRECTORY_SEPARATOR . 'wp-content' . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . 'ova-brw' . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . 'ova-brw.pot';
$override_language_file = ABSPATH . DIRECTORY_SEPARATOR . 'wp-content' . DIRECTORY_SEPARATOR . 'themes' . DIRECTORY_SEPARATOR . 'hello-elementor-child' . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . $mofile ; 
// Unload the translation for the text domain of the plugin
unload_textdomain($text_domain);
// Load first the override file
load_textdomain($text_domain, $override_language_file );
// Then load the original translation file
load_textdomain($text_domain, $original_language_file );
*/

// Fix too many redirects wpml errore 500 INOL3

add_filter('mod_rewrite_rules', 'fix_rewritebase');
function fix_rewritebase($rules)
{
    $home_root = parse_url(home_url());
    if (isset($home_root['path'])) {
        $home_root = trailingslashit($home_root['path']);
    } else {
        $home_root = '/';
    }

    $wpml_root = parse_url(get_option('home'));
    if (isset($wpml_root['path'])) {
        $wpml_root = trailingslashit($wpml_root['path']);
    } else {
        $wpml_root = '/';
    }

    $rules = str_replace("RewriteBase $home_root", "RewriteBase $wpml_root", $rules);
    $rules = str_replace("RewriteRule . $home_root", "RewriteRule . $wpml_root", $rules);

    return $rules;
}


/**
 * Display item meta data.
 *
 * @since  3.0.0
 * @param  WC_Order_Item $item Order Item.
 * @param  array         $args Arguments.
 * @return string|void
 */
function custom_display_item_meta($item, $args = array())
{

    $exclude = array(
        // 'pick-up date',
        'drop-off date',
        'pick-up date real',
        'drop-off date real',
        // 'quantity',
        'total time',
        //'price detail',
        'rental type',
        'package type',
        //'ticket type'
        'ovabrw_pickup_date_real',
        'ovabrw_pickoff_date_real',
        'id_vehicle',
        'define_day',
        'amount of insurance'
    );
    $strings = array();
    $html    = '';
    $args    = wp_parse_args(
        $args,
        array(
            'before'       => '<ul class="wc-item-meta"><li>',
            'after'        => '</li></ul>',
            'separator'    => '</li><li>',
            'echo'         => true,
            'autop'        => false,
            'label_before' => '<strong class="wc-item-meta-label">',
            'label_after'  => ':</strong> ',
        )
    );
    

    foreach ($item->get_all_formatted_meta_data() as $meta_id => $meta) {
        if (!in_array(trim(strtolower($meta->display_key)), $exclude)) {
            $value     = $args['autop'] ? wp_kses_post($meta->display_value) : wp_kses_post(make_clickable(trim($meta->display_value)));
            $strings[] = $args['label_before'] . wp_kses_post($meta->display_key) . $args['label_after'] . $value;
        }
    }


    if ($strings) {
        $html = $args['before'] . implode($args['separator'], $strings) . $args['after'];
    }

    // $html = apply_filters('woocommerce_display_item_meta', $html, $item, $args);

    if ($args['echo']) {
        // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        echo $html;
    } else {
        return $html;
    }
}


// Filter Quantity for Cart INOL3
// remove_filter('woocommerce_widget_cart_item_quantity', 'ovabrw_woocommerce_widget_cart_item_quantity', 10, 3);
// add_filter('woocommerce_widget_cart_item_quantity', 'inol3_ovabrw_woocommerce_widget_cart_item_quantity', 10, 3);
// if (!function_exists('inol3_ovabrw_woocommerce_widget_cart_item_quantity')) {
//     function inol3_ovabrw_woocommerce_widget_cart_item_quantity($product_quantity, $cart_item, $cart_item_key)
//     {
//         if ($cart_item['data']->is_type('ovabrw_car_rental')) {
//             if (isset($cart_item['rental_type']) && ($cart_item['rental_type'] == 'period_time')) {
//                 if (isset($cart_item['ovabrw_number_vehicle']) && $cart_item['ovabrw_number_vehicle']) {
//                     return '<span class="qtyTxt">' . esc_html__('× ', 'ova-brw') . $cart_item['ovabrw_number_vehicle'] . '</span>';
//                 }

//                 return '<span class="qtyTxt">× 1</span>';
//             } else {
//                 $product_id             = $cart_item['product_id'];
//                 $ovabrw_pickup_date     = strtotime($cart_item['ovabrw_pickup_date']);
//                 $ovabrw_pickoff_date    = strtotime($cart_item['ovabrw_pickoff_date']);

//                 if ($cart_item['rental_type'] == 'transportation') {
//                     return esc_html__(' × Day(s)', 'ova-brw');
//                 } else {
//                     return '<span class="qtyTxt">× ' . get_real_quantity($product_quantity, $product_id, $ovabrw_pickup_date, $ovabrw_pickoff_date) . '</span>';
//                 }
//             }
//         } else {
//             return $product_quantity;
//         }
//     }
// }

// remove zoom product images INOL3
function remove_image_zoom_support_inol3()
{
    remove_theme_support('wc-product-gallery-zoom');
}
add_action('wp', 'remove_image_zoom_support_inol3', 100);

// cartella linguaggi tema INOL3
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup()
{
    load_theme_textdomain('hello-elementor-child', get_template_directory() . '/languages');
}


/**
 * Auto Complete all WooCommerce orders INOL3.
 */
add_action( 'woocommerce_before_thankyou', 'change_order_status_to_completed' );
function change_order_status_to_completed( $order_id ) {
    $order = wc_get_order( $order_id );
    
    if ( $order && $order->has_status( 'processing' ) ) {
        // Update order status to completed
        $order->update_status( 'completed' );

        // Log message and display notice
        //error_log( 'Order ' . $order_id . ' changed to completed status' );
        //wc_add_notice( 'Order ' . $order_id . ' changed to completed status', 'success' );

    } else {
        // Log message and display notice
        //error_log( 'Order ' . $order_id . ' status not changed' );
        //wc_add_notice( 'Order ' . $order_id . ' status not changed', 'error' );

    }
    remove_action( 'woocommerce_order_details_after_order_table', 'woocommerce_order_again_button' );
}

function datepicker()
{
?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            let locale = 'en';

            if (location.href.indexOf('/it/') != -1) {
                locale = 'it';
            }

            if (location.href.indexOf('/es/') != -1) {
                locale = 'es';
            }
            
                        if (location.href.indexOf('/fr/') != -1) {
                locale = 'fr';
            }
            
            if (location.href.indexOf('/de/') != -1) {
                locale = 'de';
            }

            jQuery.datetimepicker.setLocale(locale);
            jQuery.datetimepicker.setDateFormatter({
                parseDate: function(date, format) {
                    var d = moment(date, format);
                    return d.isValid() ? d.toDate() : false;
                },

                formatDate: function(date, format) {
                    return moment(date).format(format);
                },

                formatMask: function(format) {
                    return "D-M-Y";
                }
            });
        });
        jQuery(document).ready(function () {

            var translationData = {
        my_translatable_date: "<?php echo esc_js(__("d-m-Y", "hello-elementor-child")); ?>",
        my_translatable_string: "<?php echo esc_js(__("Read more", "hello-elementor-child")); ?>",

    };

    var myDate = translationData.my_translatable_date;
    var myString = translationData.my_translatable_string;

                 jQuery('input[placeholder="d-m-Y"]').attr('placeholder', myDate);
                 jQuery('.ovabrw_wd_search form .wrap_content input, .ovabrw_wd_search form .wrap_content select, .product-template-default .ovabrw_booking_form .wrap_fields select, .product-template-default .ovabrw_booking_form .wrap_fields input, .product-template-default .ovabrw_booking_form .wrap_fields .input-group').addClass('colorato');
                 jQuery('a.accordion-button.collapsed').text(myString);

        });
    </script>
<?php
}

add_action('wp_footer', 'datepicker', 80);

function stampa_codice_nel_checkout() {
    ?>
    <div id="myOptional" style="display:none;"><?php echo esc_js(__("(optional)", "hello_elementor_child")); ?></div>
    <div id="myPassengers" style="display:none;"><?php echo esc_js(__("Passengers", "hello_elementor_child")); ?></div>
    <div id="myLanguage" style="display:none;"><?php echo esc_js(__("Tour language", "hello_elementor_child")); ?></div>
    <div id="myPassengersPlaceholder" style="display:none;"><?php echo esc_js(__("Enter the names of the passengers (separated by comma)", "hello_elementor_child")); ?></div>
    <div id="myLanguagePlaceholder" style="display:none;"><?php echo esc_js(__("Enter the tour language you prefer ", "hello_elementor_child")); ?></div>
    <?php
}
add_action('woocommerce_checkout_before_customer_details', 'stampa_codice_nel_checkout');

// Aggiungi la colonna alla lista di prodotti nel backend
add_filter( 'manage_edit-product_columns', 'add_operation_days_column' );
function add_operation_days_column( $columns ) {
    $columns['operation_days'] = 'Operation Days';
    return $columns;
}

// Popola la colonna con i valori dei termini associati alla tassonomia 'operation-days'
add_action( 'manage_product_posts_custom_column', 'populate_operation_days_column' );
function populate_operation_days_column( $column ) {
    global $post;
    
    if ( 'operation_days' === $column ) {
        $terms = get_the_terms( $post->ID, 'operation-days' );
        
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            $term_names = array();
            foreach ( $terms as $term ) {
                $term_names[] = $term->name;
            }
            echo implode( ', ', $term_names );
        } else {
            echo '-';
        }
    }
}

// Aggiungi i campi di modifica veloce per i termini
add_action( 'quick_edit_custom_box', 'add_operation_days_quick_edit_fields', 10, 2 );
function add_operation_days_quick_edit_fields( $column_name, $post_type ) {
    global $post;
    if ( 'product' === $post_type && 'operation_days' === $column_name ) {
        ?>
        <fieldset class="inline-edit-col-left">
            <div class="inline-edit-col">
                <label>
                    <span class="title">Operation Days</span>
                    <span class="input-text-wrap">
                        <?php
                        $operation_days_terms = get_terms( array(
                            'taxonomy' => 'operation-days',
                            'hide_empty' => false,
                        ) );
                        $product_terms = wp_get_post_terms( $post->ID, 'product_tag' );
                        $product_term_slugs = array();
                        
                        foreach ( $product_terms as $product_term ) {
                            $product_term_slugs[] = $product_term->slug;
                        }
                        
                        foreach ( $operation_days_terms as $term ) {
                            ?>
                            <label>
                                <input type="checkbox" name="operation_days[]" class="operation-days" value="<?php echo esc_attr( $term->slug ); ?>" <?php checked( in_array( $term->slug, $product_term_slugs ) ); ?>>
                                <?php echo esc_html( $term->name ); ?>
                            </label>
                            <br>
                            <?php
                        }
                        ?>
                    </span>
                </label>
            </div>
        </fieldset>
        <?php
    }
}

// Aggiorna i termini associati alla tassonomia 'operation-days' nel salvataggio del prodotto
add_action( 'save_post_product', 'save_operation_days_quick_edit', 10, 2 );
function save_operation_days_quick_edit( $post_id, $post ) {
    if ( isset( $_REQUEST['operation_days'] ) ) {
        $term_slugs = (array) $_REQUEST['operation_days'];
        $term_ids = array();
        
        foreach ( $term_slugs as $term_slug ) {
            $term = get_term_by( 'slug', $term_slug, 'operation-days' );
            
            if ( false !== $term ) {
                $term_ids[] = $term->term_id;
            }
        }
        
        wp_set_post_terms( $post_id, $term_ids, 'operation-days' );
    }
}

function add_custom_menu_item($items, $args) {

    if($args->menu->slug == 'menu-footer') { // Change 'primary-menu' to your menu location
        $items .= '<li class="menu-item"><a href="#" class="cky-banner-element hfe-menu-item">Cookie Settings</a></li>';

    }

    return $items;
}
add_filter('wp_nav_menu_items', 'add_custom_menu_item', 10, 2);

function rei_wc_add_to_cart_message( $message, $product_id ) {
    $titles = array();

    if ( is_array( $product_id ) ) {
        foreach ( $product_id as $id ) {
            $titles[] = get_the_title( $id );
        }
    } else {
        $titles[] = get_the_title( $product_id );
    }

    $titles     = array_filter( $titles );
    $added_text = sprintf( _n( '%s has been added to your cart.', '%s have been added to your cart.', sizeof( $titles ), 'woocommerce' ), wc_format_list_of_items( $titles ) );

    // Output success messages
    if ( 'yes' === get_option( 'woocommerce_cart_redirect_after_add' ) ) {
        $return_to = apply_filters( 'woocommerce_continue_shopping_redirect', wp_get_referer() ? wp_get_referer() : home_url() );
        $message   = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( $return_to ), esc_html__( 'Continue Shopping', 'woocommerce' ), esc_html( $added_text ) );
    } else {
        $message   = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( wc_get_page_permalink( 'checkout' ) ), esc_html__( 'Proceed to Checkout', 'woocommerce' ), esc_html( $added_text ) );
    }

    return $message;
}
add_filter('wc_add_to_cart_message','rei_wc_add_to_cart_message',10,2);

// add_filter('add_to_cart_redirect', 'cw_redirect_add_to_cart');
// function cw_redirect_add_to_cart() {
//    global $woocommerce;
//    $cw_redirect_url_checkout = $woocommerce->cart->get_checkout_url();
//    return $cw_redirect_url_checkout;
// }

// add_filter( 'woocommerce_product_single_add_to_cart_text', 'cw_btntext_cart' );
// add_filter( 'woocommerce_product_add_to_cart_text', 'cw_btntext_cart' );
// function cw_btntext_cart() {
//    return __( 'Buy Me', 'woocommerce' );
// }

// disable js INOL3 N.B. Da riattivare se Elementor non va (serve a OVA per i widget)
function rimuovi_script_fullcalendar($src) {
    // URL dello script che vuoi rimuovere
    $script_url = home_url('/wp-content/plugins/ova-brw/assets/libs/fullcalendar/main.js');

    // Se l'URL dello script corrisponde a quello che vuoi rimuovere, restituisci una stringa vuota
    if ($src == $script_url) {
        return '';
    }

    // Altrimenti, restituisci l'URL originale
    return $src;
}

add_filter('script_loader_src', 'rimuovi_script_fullcalendar', 10, 1);


add_filter( 'woocommerce_loop_add_to_cart_link', 'my_ovarbrw_woocommerce_loop_add_to_cart_link', 11, 3 );
if ( ! function_exists( 'my_ovarbrw_woocommerce_loop_add_to_cart_link' ) ) {
    function my_ovarbrw_woocommerce_loop_add_to_cart_link( $link, $product, $args ) {
        $product_link = $product->add_to_cart_url();

        if ( isset( $_GET['ovabrw_search'] ) ) {
            if ( isset( $_GET['ovabrw_pickup_date'] ) && $_GET['ovabrw_pickup_date'] ) {
                $product_link = add_query_arg( 'pickup_date', $_GET['ovabrw_pickup_date'], $product_link );
            }
            if ( isset( $_GET['ovabrw_pickoff_date'] ) && $_GET['ovabrw_pickoff_date'] ) {
                $product_link = add_query_arg( 'dropoff_date', $_GET['ovabrw_pickoff_date'], $product_link );
            }
            if ( isset( $_GET['ovabrw_pickup_loc'] ) && $_GET['ovabrw_pickup_loc'] ) {
                $product_link = add_query_arg( 'pickup_loc', $_GET['ovabrw_pickup_loc'], $product_link );
            }
            if ( isset( $_GET['ovabrw_pickoff_loc'] ) && $_GET['ovabrw_pickoff_loc'] ) {
                $product_link = add_query_arg( 'pickoff_loc', $_GET['ovabrw_pickoff_loc'], $product_link );
            }
        }

        return sprintf(
            '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            esc_url( $product_link ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            __('Prenota', 'hello-elementor-child')
        );
        
    }
}

// rimuove l'indentatura nella dropdown delle categorie in homepage
add_filter( 'wp_dropdown_cats', 'remove_dropdown_spaces' , 999 , 3);
function remove_dropdown_spaces($args){
    $args = str_replace('&nbsp;&nbsp;&nbsp;', '- ', $args);
    return $args;
}

// // cambio titolo risultati ricerca test cambio nome

// add_filter('pre_get_document_title', 'change_the_title', 999 , 3);
// function change_the_title() {
//     if (has_class('search-result')) {
//         // dd("la trova");
//     $title =  __('Titolo search', 'hello-elementor-child') . ' | ' . get_bloginfo('name');
//     return $title;
//     }
//     else{
//        // dd("non la trova");
//     }
// }

function has_class($class) {
    global $post;
    $post_content = $post->post_content;
    return (bool) preg_match('/<[^>]*class=[\'"]' . $class . '[\'"][^>]*>/', $post_content);
}




// // Visualizza le categorie nel carrello
// function visualizza_categorie_nel_carrello($cart_item, $cart_item_key)
// {

//     $product_id = $cart_item['product_id'];
//     $product = wc_get_product($product_id);
//     global $wp;


//     if ($product) {

//         $categories = get_the_terms($product_id, 'product_cat');

//         if ($categories && !is_wp_error($categories)) {

//             $category_names = array();

//             foreach ($categories as $category) {

//                 $category_names[] = $category->name;
//             }

//             echo '<p style="font-weight: normal; text-align: start;">' . implode(', ', $category_names) . '</p>';
//         }
//     }
// }
// add_action('woocommerce_after_cart_item_name', 'visualizza_categorie_nel_carrello', 10, 3);


// function visualizza_categorie_nel_checkout($cart_item, $cart_item_key)
// {

//     $product_id = $cart_item['product_id'];
//     $product = wc_get_product($product_id);
//     global $wp;


//     if ($product) {

//         $categories = get_the_terms($product_id, 'product_cat');

//         if ($categories && !is_wp_error($categories)) {

//             $category_names = array();

//             foreach ($categories as $category) {

//                 $category_names[] = $category->name;
//             }

//             echo '<p style="font-weight: normal; text-align: start;">' . implode(', ', $category_names) . '</p>';
//         }
//     }
// }
// add_action('woocommerce_after_checkout_item_name', 'visualizza_categorie_nel_checkout', 10, 3);


// function plugin_republic_get_item_data( $item_data, $cart_item ) {
//     var_dump ($cart_item);
    
//     if( isset( $cart_item['pr_field'] ) ) {
//     $item_data[] = array(
//     'key' => __( 'Your name', 'plugin-republic' ),
//     'value' => wc_clean( $cart_item_data['pr_field'] )
//     );
//     }
//     return $item_data;
//    }
//    add_filter( 'woocommerce_get_item_data', 'plugin_republic_get_item_data', 10, 2 );



// // Visualizza le categorie nel riepilogo dell'ordine
// function visualizza_categorie_riepilogo_ordine($product_name, $cart_item)
// {
//     $product_id = $cart_item['product_id'];
//     $product = wc_get_product($product_id);
//     $product_name = $product->get_name();

//     if ($product) {

//         $categories = get_the_terms($product_id, 'product_cat');

//         if ($categories && !is_wp_error($categories)) {

//             $category_names = array();

//             foreach ($categories as $category) {

//                 $category_names[] = $category->name;
//             }


//             echo '<div style="display: flex; flex-direction: column;" class="productItemName"><div>' . $product_name . '</div>' . '<p style="font-weight: normal; text-align: start;">' . implode(', ', $category_names) . '</p></div>';
//         }
//     }
// }
// add_action('woocommerce_order_item_name', 'visualizza_categorie_riepilogo_ordine', 10, 2);

// add_filter('pre_get_document_title', 'change_the_title', 999 , 3);
// function change_the_title() {
//     if (is_404()) {
//         $title =  esc_html__('Page not found', 'hello-elementor-child') . ' - ' . get_bloginfo('name');
//         return $title;
//     }
// }

// Aggiunge i dettagli dei prodotti prima dei dettagli del cliente nel checkout
// add_action('woocommerce_checkout_before_customer_details', 'stampare_dettagli_prodotti_checkout', 10);


// Aggiungi le categorie del prodotto al template del carrello
add_filter('woocommerce_get_item_data', 'aggiungi_categorie_al_template_carrello', 999, 2);

function aggiungi_categorie_al_template_carrello($cart_data, $cart_item) {
    // Verifica se $cart_item è definito
    if (isset($cart_item['product_id']) && !empty($cart_item['product_id'])) {
        $product_id = $cart_item['product_id'];
        $categories = get_the_terms($product_id, 'product_cat');

        if ($categories && !is_wp_error($categories)) {
            $categorie_array = array();

            // Estrai i nomi delle categorie
            foreach ($categories as $categoria) {
                $categorie_array[] = $categoria->name;
            }
            // Aggiungi le categorie al template del carrello
            $cart_data[] = array(
                'name' => esc_html__('Tour type', 'hello-elementor-child'),
                'value' => implode(', ', $categorie_array),
            );
        }
    }

    return $cart_data;
}

// video nella pagina prodotto
function get_video() {
    global $product;

    // Ottieni l'URL del video personalizzato
    $video_id = get_post_meta($product->get_id(), 'video_id', true);

    // Verifica se è presente un URL del video
    if ($video_id) {
        // Output del video di YouTube
        //return '<div data-thumb="https://img.youtube.com/vi/' . esc_attr($video_id) . '/maxresdefault.jpg" data-thumb-alt="" class="woocommerce-product-gallery__image">
        return '<div data-thumb="' . get_stylesheet_directory_uri() . '/assets/images/logo-video.jpg" data-thumb-alt="" class="woocommerce-product-gallery__image" data-lg-size="1280-720" data-src="https://www.youtube.com/watch?v=' . esc_attr($video_id) . '" data-poster="https://img.youtube.com/vi/' . esc_attr($video_id) . '/maxresdefault.jpg">
        <a class="youtube-video" data-poster="https://img.youtube.com/vi/' . esc_attr($video_id) . '/maxresdefault.jpg" data-src="https://www.youtube.com/watch?v=' . esc_attr($video_id) . '" data-lg-size="1280-720">
            
            <iframe src="https://www.youtube.com/embed/' . esc_attr($video_id) . '?controls=1&modestbranding=1&rel=0&color=white&disablekb=1" frameborder="0" allow="accelerometer; autoplay;picture-in-picture; clipboard-write; encrypted-media" allowfullscreen></iframe>
        </a>
        </div>';
    }
    return false;
}
function my_wc_get_gallery_image_html( $attachment_id, $main_image = false ) {
    if($main_image) {
        $video = get_video();
        if(get_video()) {
            return $video;
        }
    }
    // codice qui sotto lasciato ma non viene utilizzato
	$flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
	$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
	$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
	$image_size        = apply_filters( 'woocommerce_gallery_image_size', $flexslider || $main_image ? 'woocommerce_single' : $thumbnail_size );
	$full_size         = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
	$thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
	$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
	$alt_text          = trim( wp_strip_all_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );
	$image             = wp_get_attachment_image(
		$attachment_id,
		$image_size,
		false,
		apply_filters(
			'woocommerce_gallery_image_html_attachment_image_params',
			array(
				'title'                   => _wp_specialchars( get_post_field( 'post_title', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
				'data-caption'            => _wp_specialchars( get_post_field( 'post_excerpt', $attachment_id ), ENT_QUOTES, 'UTF-8', true ),
				'data-src'                => esc_url( $full_src[0] ),
				'data-large_image'        => esc_url( $full_src[0] ),
				'data-large_image_width'  => esc_attr( $full_src[1] ),
				'data-large_image_height' => esc_attr( $full_src[2] ),
				'class'                   => esc_attr( $main_image ? 'wp-post-image' : '' ),
			),
			$attachment_id,
			$image_size,
			$main_image
		)
	);

	return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" data-thumb-alt="' . esc_attr( $alt_text ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_src[0] ) . '">' . $image . '</a></div>';
}

// FINE video nella pagina prodotto


add_action( 'wp_print_footer_scripts', 'theme_add_end_js', ( PHP_INT_MAX - 2 ) );
function theme_add_end_js()
{
    // echo '<script src="' . get_stylesheet_directory_uri() . '/assets/js/lg-video.min.js"></script>'; DA RIATTIVARE PER IL VIDEO NELLA LIGHTBOX TODO
    echo '<script src="' . get_stylesheet_directory_uri() . '/assets/js/custom-end.js"></script>';
}

// Aggiungi campo "Passeggeri" al checkout di WooCommerce
add_filter( 'woocommerce_checkout_fields' , 'aggiungi_campo_passeggeri_checkout' );

function aggiungi_campo_passeggeri_checkout( $fields ) {
    $fields['billing']['billing_passeggeri'] = array(
        'type' => 'text',
        'label' => esc_html__('Passengers', 'hello-elementor-child'),
        'placeholder' => esc_html__('Enter the names of the passengers (separated by comma)', 'hello-elementor-child'),
        'required' => true,
        'class' => array('form-row-wide')
    );

    // Aggiungi altri due campi di testo
    $fields['billing']['billing_tlang'] = array(
        'type' => 'text',
        'label' => esc_html__('Tour language', 'hello-elementor-child'),
        'placeholder' => esc_html__('Enter the tour language you prefer', 'hello-elementor-child'),
        'required' => false,
        'class' => array('form-row-wide')
    );

    $fields['billing']['billing_hotel'] = array(
        'type' => 'text',
        'label' => esc_html__('Hotel', 'hello-elementor-child'),
        'placeholder' => esc_html__('Enter the name of the hotel/airbnb where you reside', 'hello-elementor-child'),
        'required' => false,
        'class' => array('form-row-wide')
    );

    return $fields;
}

function mostra_campo_passeggeri_ordine_backend( $order ){
    echo '<p class="campiExtra"><strong>' . esc_html__('Passengers', 'hello-elementor-child') . ':</strong> ' . get_post_meta( $order->get_id(), '_billing_passeggeri', true ) . '</p>';
    echo '<p class="campiExtra"><strong>' . esc_html__('Tour language', 'hello-elementor-child') . ':</strong> ' . get_post_meta( $order->get_id(), '_billing_tlang', true ) . '</p>';
    echo '<p class="campiExtra"><strong>' . esc_html__('Hotel', 'hello-elementor-child') . ':</strong> ' . get_post_meta( $order->get_id(), '_billing_hotel', true ) . '</p>';
}
// Mostra il campo "Passeggeri" nella thankyou page
add_action( 'woocommerce_order_details_after_order_table', 'mostra_campo_passeggeri_ordine_backend', 11 );
// Mostra il campo "Passeggeri" nell'ordine nel backend di WooCommerce
add_action( 'woocommerce_admin_order_data_after_billing_address', 'mostra_campo_passeggeri_ordine_backend', 10, 1 );


// Funzione per aggiungere WP PUSHER nella barra di amministrazione
function aggiungi_voce_wpadminbar($wp_admin_bar) {
    // Cambia "Nuova Voce" con il testo desiderato per la tua voce nella barra di amministrazione
    $wp_admin_bar->add_menu(array(
        'id' => 'wppusheritem',
        'title' => 'Aggiorna da GIT Repo',
        'href' => '/wp-admin/admin.php?page=wppusher-themes',
        'meta' => array(
            'title' => 'Per eseguire l\'update del tema dalla repository', // Descrizione opzionale
        ),
    ));
}

// Aggiungi la funzione alla barra di amministrazione
add_action('admin_bar_menu', 'aggiungi_voce_wpadminbar', 999);


// OVERRIDE PER PLUGIN DEPOSITO 20%
function custom_awcdp_locate_template($template, $template_name, $template_path) {
    // Percorso dei template personalizzati nel tema child
    $custom_templates = array(
        'checkout/awcdp-checkout-deposit.php' => get_stylesheet_directory() . '/woocommerce/checkout/awcdp-checkout-deposit.php',
        'emails/email-partial-payments-details.php' => get_stylesheet_directory() . '/woocommerce/emails/email-partial-payments-details.php'
    );

    // Sovrascrive il percorso del template per il checkout e le email
    if (array_key_exists($template_name, $custom_templates)) {
        $custom_template_path = $custom_templates[$template_name];
        if (file_exists($custom_template_path)) {
            return $custom_template_path;
        } else {
            error_log('Custom AWCDP template not found: ' . $custom_template_path);
        }
    }

    // Blocca il caricamento dei template specifici per gli ordini
    if ($template_name == 'order/awcdp-order-details.php' || $template_name == 'order/awcdp-partial-payment-details.php') {
        error_log('Blocking AWCDP template: ' . $template_name);
        return ''; // Puoi restituire anche un percorso a un template alternativo se preferisci
    }

    error_log('Template not matching: ' . $template_name);

    return $template;
}
add_filter('awcdp_locate_template', 'custom_awcdp_locate_template', 10, 3);


// function add_custom_email_class( $email_classes ) {
//     require_once get_stylesheet_directory() . '/includes/class-wc-email-customer-reminder.php';
//     $email_classes['WC_Email_Customer_Reminder'] = new WC_Email_Customer_Reminder();
//     error_log('Custom email class registered.');
//     return $email_classes;
// }
// add_filter( 'woocommerce_email_classes', 'add_custom_email_class' );




/// ####### 6-6-2024 CRON per invio link per pagamento ordini parziali

// Rimuovi eventuali eventi cron duplicati
function clear_duplicate_cron_jobs() {
    $timestamp = wp_next_scheduled( 'send_order_invoice_email_event' );

    while ( $timestamp ) {
        wp_unschedule_event( $timestamp, 'send_order_invoice_email_event' );
        $timestamp = wp_next_scheduled( 'send_order_invoice_email_event' );
    }

    // Pianifica nuovamente l'evento di cron se non esiste già
    if ( ! wp_next_scheduled( 'send_order_invoice_email_event' ) ) {
        wp_schedule_event( time(), 'daily', 'send_order_invoice_email_event' );
    }
}

add_action( 'init', 'clear_duplicate_cron_jobs' );



// Pianifica l'evento di cron se non è già pianificato
if ( ! wp_next_scheduled( 'inol3_send_order_invoice_email_event' ) ) {
    wp_schedule_event( time(), 'daily', 'inol3_send_order_invoice_email_event' );
}

// Hook per la funzione che invia l'email
add_action( 'inol3_send_order_invoice_email_event', 'send_order_invoice_email' );


function send_order_invoice_email() {
    // Ottieni tutti gli ordini con stato "wc-partially-paid"
    $args = array(
        'status' => 'wc-partially-paid',
        'limit' => -1, // Ottieni tutti gli ordini senza limiti
        'return' => 'ids' // Ottieni solo gli ID degli ordini
    );
    $orders = wc_get_orders( $args );

    if ( ! empty( $orders ) && is_array( $orders ) ) {
        foreach ( $orders as $order_id ) {
            $order = wc_get_order( $order_id );
            $pickup_dates_sent = array(); // Array per tenere traccia delle date di ritiro per cui l'email è stata inviata

            foreach ( $order->get_items() as $item_id => $item ) {
                $pickup_date = isset( $item['ovabrw_pickup_date'] ) ? strtotime( $item['ovabrw_pickup_date'] ) : 0;
                $one_day_before_pickup = $pickup_date - 24 * 60 * 60 * 7;
                $current_time = current_time( 'timestamp' );

                // Verifica se l'email è già stata inviata per questa data di ritiro
                if ( in_array( $pickup_date, $pickup_dates_sent ) ) {
                    continue;
                }

                // Verifica se l'email è già stata inviata per questo elemento
                $email_sent = get_post_meta( $order_id, '_ovabrw_email_sent_' . $item_id, true );

                if ( $current_time >= $one_day_before_pickup && $current_time < $pickup_date && !$email_sent ) {
                    // Invia l'email di fattura
                    $emails = WC_Emails::instance();
                    $emails->customer_invoice( $order );

                    // Imposta il flag per evitare invii duplicati
                    update_post_meta( $order_id, '_ovabrw_email_sent_' . $item_id, true );

                    // Aggiungi la data di ritiro all'array delle date inviate
                    $pickup_dates_sent[] = $pickup_date;
                }
            }
        }
    }
}



/// ####### 6-6-2024 CRON per invio link per pagamento ordini parziali FINE


// Aggiungi questa funzione al file functions.php del tuo tema child

function dropdown_products_exclude_private_tours() {
    // Query per ottenere i prodotti
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1, // Ottieni tutti i prodotti
        'post_status' => 'publish',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => 'private-tour',
                'operator' => 'NOT IN', // Escludi la categoria "private-tours"
            ),
        ),
    );
    
    $products = new WP_Query($args);
    
    // Inizia l'output del dropdown
    $output = '<select name="products_dropdown" id="products_dropdown">';
    $output .= '<option value="">' . esc_js(__("Select a Tour", "hello-elementor-child")) . '</option>';
    if ($products->have_posts()) {
        while ($products->have_posts()) {
            $products->the_post();
            $product_id = get_the_ID();
            $product_title = get_the_title();
            $product_permalink = get_permalink();
            
            // Ottieni le categorie del prodotto
            $terms = get_the_terms($product_id, 'product_cat');
            $categories_string = '';
            
            if ($terms && !is_wp_error($terms)) {
                $categories = array();
                foreach ($terms as $term) {
                    $categories[] = $term->name;
                }
                $categories_string = implode(', ', $categories);
            }
            
            // Aggiungi l'opzione alla select
            $output .= '<option class="product_dropdown" value="' . $product_permalink . '">' . $product_title . ' - ' . $categories_string . '</option>';
        }
    } else {
        $output .= '<option value="">Nessun prodotto disponibile</option>';
    }
    
    $output .= '</select>';
    
    // Resetta il post data
    wp_reset_postdata();
    
    return $output;
}

// Registra lo shortcode
add_shortcode('products_dropdown', 'dropdown_products_exclude_private_tours');

function dropdown_product_tags() {
    $terms = get_terms(array(
        'taxonomy' => 'product_tag',
        'hide_empty' => false,
        'post_status' => 'publish'
    ));

    $output = '<select name="product_tags_dropdown" id="product_tags_dropdown">';
    $output .= '<option value="0">' . esc_js(__("Select a feature", "hello-elementor-child")) . '</option>';
    
    foreach ($terms as $term) {
        $output .= '<option value="' . get_term_link($term) . '" data-tag-id="' . $term->term_id . '">' . $term->name . '</option>';
    }

    $output .= '</select>';

    return $output;
}


// Shortcode per utilizzare questa funzione
add_shortcode('product_tags_dropdown', 'dropdown_product_tags');

function ajax_get_products_by_tag() {
    if (!isset($_POST['tag_id'])) {
        wp_send_json_error('Invalid tag ID.');
        wp_die();
    }

    $tag_id = intval($_POST['tag_id']);
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'post_status' => 'publish',
    );

    if ($tag_id !== 0) {
        $args['tax_query'] = array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'product_tag',
                'field' => 'term_id',
                'terms' => $tag_id,
            ),
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => 'private-tour',
                'operator' => 'NOT IN', // Exclude "private-tours" category
            ),
        );
    } else {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => 'private-tour',
                'operator' => 'NOT IN', // Exclude "private-tours" category
            ),
        );
    }

    $query = new WP_Query($args);

    $products = array();

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $terms = wp_get_post_terms(get_the_ID(), 'product_cat', array('fields' => 'slugs'));
            if (!in_array('private-tour', $terms)) {
                $products[] = array(
                    'id' => get_the_ID(),
                    'title' => html_entity_decode(get_the_title(), ENT_QUOTES, 'UTF-8'),
                    'url' => get_permalink(),
                    'categories' => implode(', ', $terms)
                );
            }
        }
    }
    error_log(print_r($products, true));
    wp_reset_postdata();

    if (empty($products)) {
        wp_send_json_error("No products found");
    } else {
        wp_send_json_success($products);
    }
    wp_die();
}

add_action('wp_ajax_get_products_by_tag', 'ajax_get_products_by_tag');
add_action('wp_ajax_nopriv_get_products_by_tag', 'ajax_get_products_by_tag');

// custom-carousel


function enqueue_custom_swiper_script() {
    // Swiper CSS e JS
    // wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css');
    // wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js', array(), null, true);
    //wp_enqueue_script('swiper-js', get_stylesheet_directory_uri() . '/assets/js/swiper-bundle.min.js', array('jquery'), '', true);

    // Aggiungi il tuo script personalizzato dal tema child
    wp_enqueue_script('custom-swiper-init', get_stylesheet_directory_uri() . '/assets/js/swiper-init.js', array('swiper'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_swiper_script', 12);

function custom_image_carousel_shortcode($atts)
{
    ob_start();
    include 'shortcodes/carousel.php';
    $output = ob_get_clean();
    return $output;
}
add_shortcode('custom_image_carousel', 'custom_image_carousel_shortcode');


function get_other_products_shortcode() {
    // Ottieni l'ID del prodotto corrente
    $current_product_id = get_the_ID();

    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 3, // Numero di prodotti da mostrare
        'post_status'    => 'publish',
        'orderby'        => 'rand', // Ordina casualmente
        'post__not_in'   => array($current_product_id), // Escludi il prodotto corrente
    );

    $query = new WP_Query($args);
    $output = '<div class="item-container">'; // Aggiungi qui la classe item-container

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            $title = get_the_title();
            $thumbnail_id = get_post_thumbnail_id();
            $image = wp_get_attachment_image_src($thumbnail_id, 'full')[0];
            $categories = wp_get_post_terms(get_the_ID(), 'product_cat');

            // Ottieni i tag, ma mostri solo il primo
            $tags = wp_get_post_terms(get_the_ID(), 'product_tag', array('fields' => 'names'));
            $first_tag = !empty($tags) ? $tags[0] : ''; // Prende solo il primo tag, se esiste

            $link = get_permalink();

            // Solo l'immagine è cliccabile
            $output .= '<div class="item">';
            $output .= '<a href="' . esc_url($link) . '"><img src="' . esc_url($image) . '" alt="' . esc_attr($title) . '"></a>';
            if (!empty($first_tag)) {
                $output .= '<div class="item-tag">' . esc_html($first_tag) . '</div>'; // Mostra solo il primo tag
            }
            $output .= '<a href="' . esc_url($link) . '"><div class="item-title">' . esc_html($title) . '</div></a>';
            $output .= '<div class="item-description">';
            if (!empty($categories)) {
                $cat_links = array();
                foreach ($categories as $category) {
                    $category_link = get_term_link($category);
                    $cat_links[] = '<a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a>';
                }
                $output .= implode(', ', $cat_links);
            }
            $output .= '</div>';
            $output .= '</div>';
        }
        wp_reset_postdata();
    }

    $output .= '</div>'; // Chiudi item-container
    return $output;
}

add_shortcode('other_products', 'get_other_products_shortcode');

add_action( 'pre_get_posts', 'filter_orders_by_alphanumeric_coupon_for_user_role_partner' );
function filter_orders_by_alphanumeric_coupon_for_user_role_partner( $query ) {
    // Verifica se siamo nel backend e che l'utente appartenga al ruolo "partner"
    if ( is_admin() && $query->is_main_query() && current_user_can( 'partner' ) ) {
        global $wpdb;
        $current_user = wp_get_current_user();
        $username = $current_user->user_login;

        // Verifica che lo username abbia la forma "partfk01", "partab12", ecc.
        if ( preg_match( '/^partner([a-zA-Z]{2})(\d{2})$/', $username, $matches ) ) {
            // Estrai le lettere e i numeri dallo username
            $alpha_part = strtoupper( $matches[1] ); // Trasforma le lettere in maiuscolo
            $numeric_part = $matches[2];

            // Crea il codice coupon corrispondente
            $coupon_code = 'PROM' . $alpha_part . $numeric_part; // esempio PROMOFK01

            // Recupera gli ID degli ordini che hanno usato questo coupon
            $order_ids = $wpdb->get_col( $wpdb->prepare(
                "
                SELECT order_items.order_id
                FROM {$wpdb->prefix}woocommerce_order_items AS order_items
                JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS itemmeta
                ON order_items.order_item_id = itemmeta.order_item_id
                WHERE order_items.order_item_type = 'coupon'
                AND itemmeta.meta_key = 'coupon_info'
                AND itemmeta.meta_value LIKE %s
                ",
                '%' . $coupon_code . '%'
            ));

            // Se non ci sono ordini, impedisci la visualizzazione di ordini
            if ( empty( $order_ids ) ) {
                // Imposta un array con un ID inesistente
                $order_ids = array( 0 );
            }

            // Filtra la query principale per mostrare solo gli ordini con il coupon corrispondente
            $query->set( 'post__in', $order_ids );
        }
    }
}
add_action('wp_enqueue_scripts', 'debug_enqueue_scripts_styles', 99);
function debug_enqueue_scripts_styles() {
    global $wp_scripts;
    global $wp_styles;
    
    echo '<!-- Scripts: ';
    foreach( $wp_scripts->queue as $handle ) {
        echo $handle . ' | ';
    }
    echo '-->';

    echo '<!-- Styles: ';
    foreach( $wp_styles->queue as $handle ) {
        echo $handle . ' | ';
    }
    echo '-->';
}

function disable_woocommerce_gallery_photoswipe() {
    if (is_product()) {
        // Rimuove la galleria di WooCommerce e PhotoSwipe
        remove_theme_support('wc-product-gallery-zoom');
        remove_theme_support('wc-product-gallery-lightbox');
        remove_theme_support('wc-product-gallery-slider');

        // Disabilita gli script e gli stili di PhotoSwipe
        wp_dequeue_script('photoswipe');
        wp_deregister_script('photoswipe');

        wp_dequeue_script('photoswipe-ui-default');
        wp_deregister_script('photoswipe-ui-default');
        
        wp_dequeue_style('photoswipe-default-skin');
        wp_deregister_style('photoswipe-default-skin');
    }
}
add_action('wp', 'disable_woocommerce_gallery_photoswipe');

// Rimuovere Flexslider dalle pagine prodotto di WooCommerce
add_action('wp_enqueue_scripts', 'remove_flexslider_scripts', 100);
function remove_flexslider_scripts() {
    // Controlla se siamo su una pagina prodotto
    if (is_product()) {
        // Dequeue e deregistra lo script Flexslider
        wp_dequeue_script('flexslider');
        wp_deregister_script('flexslider');
        
        // Rimuovi anche eventuali stili associati
        wp_dequeue_style('flexslider');
        wp_deregister_style('flexslider');
        
        // Forzare la rimozione dallo script registrato
        global $wp_scripts;
        if (isset($wp_scripts->registered['flexslider'])) {
            unset($wp_scripts->registered['flexslider']);
        }
    }
}

// Rimuovere carousel dalle pagine prodotto di WooCommerce
add_action('wp_enqueue_scripts', 'remove_carousel_scripts', 101);
function remove_carousel_scripts() {
    // Controlla se siamo su una pagina prodotto
    if (is_product()) {
        // Dequeue e deregistra lo script carousel
        wp_dequeue_script('carousel');
        wp_deregister_script('carousel');
        
        // Rimuovi anche eventuali stili associati
        wp_dequeue_style('carousel');
        wp_deregister_style('carousel');
        
        // Forzare la rimozione dallo script registrato
        global $wp_scripts;
        if (isset($wp_scripts->registered['carousel'])) {
            unset($wp_scripts->registered['carousel']);
        }
    }
}

// Rimuovere lottie-js dalle pagine prodotto di WooCommerce
add_action('wp_enqueue_scripts', 'remove_lottiejs_scripts', 102);
function remove_lottiejs_scripts() {
    // Controlla se siamo su una pagina prodotto
    if (is_product()) {
        // Dequeue e deregistra lo script lottie-js
        wp_dequeue_script('lottie-js');
        wp_deregister_script('lottie-js');
        
        // Rimuovi anche eventuali stili associati
        wp_dequeue_style('lottie-js');
        wp_deregister_style('lottie-js');
        
        // Forzare la rimozione dallo script registrato
        global $wp_scripts;
        if (isset($wp_scripts->registered['lottie-js'])) {
            unset($wp_scripts->registered['lottie-js']);
        }
    }
}

// Rimuovere woocommerce_stripe dalle pagine prodotto di WooCommerce
add_action('wp_enqueue_scripts', 'remove_woocommercestripe_scripts', 98);
function remove_woocommercestripe_scripts() {
    // Controlla se siamo su una pagina prodotto
    if (is_product()) {
        // Dequeue e deregistra lo script woocommerce_stripe
        wp_dequeue_script('woocommerce_stripe');
        wp_deregister_script('woocommerce_stripe');
        
        // Rimuovi anche eventuali stili associati
        wp_dequeue_style('woocommerce_stripe');
        wp_deregister_style('woocommerce_stripe');
        
        // Forzare la rimozione dallo script registrato
        global $wp_scripts;
        if (isset($wp_scripts->registered['woocommerce_stripe'])) {
            unset($wp_scripts->registered['woocommerce_stripe']);
        }
    }
}

// Aggiungi i coupon usati nelle email dell'ordine
add_action('woocommerce_email_order_meta', 'aggiungi_coupon_email', 20, 4);

function aggiungi_coupon_email($order, $sent_to_admin, $plain_text, $email) {
    // Ottieni i coupon utilizzati nell'ordine
    $coupons = $order->get_coupon_codes();

    // Verifica se ci sono coupon nell'ordine
    if (!empty($coupons)) {
        if ($plain_text) {
            echo "Coupon utilizzato: " . implode(', ', $coupons) . "\n"; // Email in testo semplice
        } else {
            echo '<p><strong>Coupon utilizzato:</strong> ' . implode(', ', $coupons) . '</p>'; // Email in HTML
        }
    }
}

/**
 * INOL3 — Template Elementor globale per tutti i post + widgets custom
 */
define('INOL3_SINGLE_POST_ELEMENTOR_TEMPLATE_ID', 12119);

/**
 * Carica bootstrap dei widget Elementor (child theme)
 */
add_action('after_setup_theme', function () {
    $base = get_stylesheet_directory() . '/elementor/elementor-init.php';
    if (file_exists($base)) {
        require_once $base;
    }
});

/**
 * Forza un template PHP custom per tutti i post (single post)
 * Così dentro mettiamo il rendering del template Elementor #12119
 */
add_filter('single_template', function ($single) {

    if (!is_singular('post')) return $single;

    $custom = get_stylesheet_directory() . '/single-inol3-elementor.php';
    if (file_exists($custom)) return $custom;

    return $single;
});
