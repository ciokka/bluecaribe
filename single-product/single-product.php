<?php if (! defined('ABSPATH')) exit();

global $product;
$post_id = get_the_ID();
$images = get_attached_media('image', $post_id);

do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>

<div id="product-<?php the_ID(); ?>" class="product-single ovabrw-modern-product">

    <div class="mainGrid">
        <div class="div1">

            <div class="box-image-single">
                <?php echo do_shortcode('[custom_image_carousel]'); ?>
            </div>

            <div class="box-title-single">
                <div class="box-title">
                    <h1 class="wpr-product-title title-single-prod"><?php echo get_the_title(); ?></h1>
                    <?php ovabrw_get_template('modern/single/detail/ovabrw-product-categories.php', ['product_id' => $args['id']]); ?>
                </div>

                <div class="box-rating">
                    <?php include(get_stylesheet_directory() . '/woocommerce/single-product/rating.php'); ?>
                </div>
            </div>
        </div>
        <div class="div2">
            <div class="ovabrw-product-short-description box-desc">
                <?php echo $product->short_description; ?>
            </div>
            <div class="ovabrw-product-short-description" style="display: none;">
                <div class="text-content-short">
                    <!-- Mostra un riassunto del testo -->
                    <?php echo wp_trim_words($product->short_description, 30, '...'); ?>
                </div>

                <div class="text-content-full" style="display: none;">
                    <!-- Mostra tutto il testo, nascosto di default -->
                    <?php echo $product->short_description; ?>
                </div>

                <button class="read-more-btn"><?php echo icl_t('hello-elementor-child', 'Read more', 'Read more'); ?> <div class="svg-read-more"><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='#608DB7'>
                            <path fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z' />
                        </svg></div> </button>
            </div>
        </div>
        <div class="div3">
            <div class="cart-single-prod">
            <?php ovabrw_get_template( 'modern/single/detail/ovabrw-product-unavailable.php' ); ?>
                <div class="box-cart">
                    <div id="cart-cont" class="">
                        <div id="card-custom">
                            <div class="title-desc-card"><?php echo icl_t('hello-elementor-child', 'BOOK THIS TOUR', 'BOOK THIS TOUR'); ?></div>

                            <?php ovabrw_get_template('modern/single/detail/ovabrw-product-form-tabs.php', ['product_id' => $args['id']]); ?>

                        </div>
                    </div>
                </div>
                <div class="box-features">
                    <div class="elementor-element elementor-element-21c534d e-con-full e-flex e-con e-child"
                        data-id="21c534d" data-element_type="container">
                        <div class="elementor-element elementor-element-7afb7a3 e-flex e-con-boxed e-con e-child"
                            data-id="7afb7a3" data-element_type="container"
                            data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                            <div class="e-con-inner">
                                <div class="elementor-element elementor-element-e57678d elementor-widget elementor-widget-text-editor"
                                    data-id="e57678d" data-element_type="widget"
                                    data-widget_type="text-editor.default">
                                    <div class="elementor-widget-container notice-message">
                                        <?php echo icl_t('hello-elementor-child', 'PLEASE NOTE: Your Tour will be confirmed within 24h, you will receive the booking code by email.', 'PLEASE NOTE: Your Tour will be confirmed within 24h, you will receive the booking code by email.'); ?>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-d2f42c1 elementor-widget-divider--view-line elementor-widget elementor-widget-divider"
                            data-id="d2f42c1" data-element_type="widget" data-widget_type="divider.default">
                            <div class="elementor-widget-container">
                                <style>
                                    /*! elementor - v3.20.0 - 26-03-2024 */
                                    .elementor-widget-divider {
                                        --divider-border-style: none;
                                        --divider-border-width: 1px;
                                        --divider-color: #0c0d0e;
                                        --divider-icon-size: 20px;
                                        --divider-element-spacing: 10px;
                                        --divider-pattern-height: 24px;
                                        --divider-pattern-size: 20px;
                                        --divider-pattern-url: none;
                                        --divider-pattern-repeat: repeat-x
                                    }

                                    .elementor-widget-divider .elementor-divider {
                                        display: flex
                                    }

                                    .elementor-widget-divider .elementor-divider__text {
                                        font-size: 15px;
                                        line-height: 1;
                                        max-width: 95%
                                    }

                                    .elementor-widget-divider .elementor-divider__element {
                                        margin: 0 var(--divider-element-spacing);
                                        flex-shrink: 0
                                    }

                                    .elementor-widget-divider .elementor-icon {
                                        font-size: var(--divider-icon-size)
                                    }

                                    .elementor-widget-divider .elementor-divider-separator {
                                        display: flex;
                                        margin: 0;
                                        direction: ltr
                                    }

                                    .elementor-widget-divider--view-line_icon .elementor-divider-separator,
                                    .elementor-widget-divider--view-line_text .elementor-divider-separator {
                                        align-items: center
                                    }

                                    .elementor-widget-divider--view-line_icon .elementor-divider-separator:after,
                                    .elementor-widget-divider--view-line_icon .elementor-divider-separator:before,
                                    .elementor-widget-divider--view-line_text .elementor-divider-separator:after,
                                    .elementor-widget-divider--view-line_text .elementor-divider-separator:before {
                                        display: block;
                                        content: "";
                                        border-block-end: 0;
                                        flex-grow: 1;
                                        border-block-start: var(--divider-border-width) var(--divider-border-style) var(--divider-color)
                                    }

                                    .elementor-widget-divider--element-align-left .elementor-divider .elementor-divider-separator>.elementor-divider__svg:first-of-type {
                                        flex-grow: 0;
                                        flex-shrink: 100
                                    }

                                    .elementor-widget-divider--element-align-left .elementor-divider-separator:before {
                                        content: none
                                    }

                                    .elementor-widget-divider--element-align-left .elementor-divider__element {
                                        margin-left: 0
                                    }

                                    .elementor-widget-divider--element-align-right .elementor-divider .elementor-divider-separator>.elementor-divider__svg:last-of-type {
                                        flex-grow: 0;
                                        flex-shrink: 100
                                    }

                                    .elementor-widget-divider--element-align-right .elementor-divider-separator:after {
                                        content: none
                                    }

                                    .elementor-widget-divider--element-align-right .elementor-divider__element {
                                        margin-right: 0
                                    }

                                    .elementor-widget-divider--element-align-start .elementor-divider .elementor-divider-separator>.elementor-divider__svg:first-of-type {
                                        flex-grow: 0;
                                        flex-shrink: 100
                                    }

                                    .elementor-widget-divider--element-align-start .elementor-divider-separator:before {
                                        content: none
                                    }

                                    .elementor-widget-divider--element-align-start .elementor-divider__element {
                                        margin-inline-start: 0
                                    }

                                    .elementor-widget-divider--element-align-end .elementor-divider .elementor-divider-separator>.elementor-divider__svg:last-of-type {
                                        flex-grow: 0;
                                        flex-shrink: 100
                                    }

                                    .elementor-widget-divider--element-align-end .elementor-divider-separator:after {
                                        content: none
                                    }

                                    .elementor-widget-divider--element-align-end .elementor-divider__element {
                                        margin-inline-end: 0
                                    }

                                    .elementor-widget-divider:not(.elementor-widget-divider--view-line_text):not(.elementor-widget-divider--view-line_icon) .elementor-divider-separator {
                                        border-block-start: var(--divider-border-width) var(--divider-border-style) var(--divider-color)
                                    }

                                    .elementor-widget-divider--separator-type-pattern {
                                        --divider-border-style: none
                                    }

                                    .elementor-widget-divider--separator-type-pattern.elementor-widget-divider--view-line .elementor-divider-separator,
                                    .elementor-widget-divider--separator-type-pattern:not(.elementor-widget-divider--view-line) .elementor-divider-separator:after,
                                    .elementor-widget-divider--separator-type-pattern:not(.elementor-widget-divider--view-line) .elementor-divider-separator:before,
                                    .elementor-widget-divider--separator-type-pattern:not([class*=elementor-widget-divider--view]) .elementor-divider-separator {
                                        width: 100%;
                                        min-height: var(--divider-pattern-height);
                                        -webkit-mask-size: var(--divider-pattern-size) 100%;
                                        mask-size: var(--divider-pattern-size) 100%;
                                        -webkit-mask-repeat: var(--divider-pattern-repeat);
                                        mask-repeat: var(--divider-pattern-repeat);
                                        background-color: var(--divider-color);
                                        -webkit-mask-image: var(--divider-pattern-url);
                                        mask-image: var(--divider-pattern-url)
                                    }

                                    .elementor-widget-divider--no-spacing {
                                        --divider-pattern-size: auto
                                    }

                                    .elementor-widget-divider--bg-round {
                                        --divider-pattern-repeat: round
                                    }

                                    .rtl .elementor-widget-divider .elementor-divider__text {
                                        direction: rtl
                                    }

                                    .e-con-inner>.elementor-widget-divider,
                                    .e-con>.elementor-widget-divider {
                                        width: var(--container-widget-width, 100%);
                                        --flex-grow: var(--container-widget-flex-grow)
                                    }
                                </style>
                                <div class="elementor-divider"> <span class="elementor-divider-separator">
                                    </span></div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-0a984d1 elementor-widget elementor-widget-ovabrw_product_features"
                            data-id="0a984d1" data-element_type="widget"
                            data-widget_type="ovabrw_product_features.default">
                            <div class="elementor-widget-container">
                                <div class="ovabrw-modern-product">
                                    <?php ovabrw_get_template('modern/single/detail/ovabrw-product-features.php', ['product_id' => $args['id']]); ?>

                                </div>
                            </div>
                        </div>
                        <div class="elementor-element elementor-element-3aff52e e-flex e-con-boxed e-con e-child"
                            data-id="3aff52e" data-element_type="container"
                            data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                            <div class="e-con-inner">
                                <div class="info-message">
                                    <div class="elementor-element elementor-element-0ad5384 elementor-widget elementor-widget-text-editor"
                                        data-id="0ad5384" data-element_type="widget"
                                        data-widget_type="text-editor.default">
                                        <div class="elementor-widget-container">
                                            <h2>
                                                <?php echo icl_t('hello-elementor-child', 'Do you need informations about tours?', 'Do you need informations about tours?'); ?>

                                            </h2>
                                            <span></span>
                                        </div>
                                    </div>
                                    <div class="elementor-element elementor-element-f95b5df elementor-widget-mobile__width-inherit elementor-widget elementor-widget-text-editor"
                                        data-id="f95b5df" data-element_type="widget"
                                        data-widget_type="text-editor.default">
                                        <div class="elementor-widget-container">

                                            <p><?php echo icl_t('hello-elementor-child', 'Contact our team with the Live Chat!', 'Contact our team with the Live Chat!'); ?> </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <div class="div4">
        <div class="footer-product">
            <div class="elementor-element elementor-element-8955944 e-flex e-con-boxed e-con e-parent" data-id="8955944"
                data-element_type="container" data-core-v316-plus="true">
                <div class="e-con-inner">
                    <div class="elementor-element elementor-element-ffeef84 e-flex e-con-boxed e-con e-child"
                        data-id="ffeef84" data-element_type="container"
                        data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
                        <div class="e-con-inner">
                            <div class="elementor-element elementor-element-e2901e4 e-con-full e-flex e-con e-child"
                                data-id="e2901e4" data-element_type="container">
                                <div class="elementor-element elementor-element-9aa445c elementor-widget elementor-widget-spacer"
                                    data-id="9aa445c" data-element_type="widget" data-widget_type="spacer.default">
                                    <div class="elementor-widget-container">
                                        <style>
                                            /*! elementor - v3.20.0 - 26-03-2024 */
                                            .elementor-column .elementor-spacer-inner {
                                                height: var(--spacer-size)
                                            }

                                            .e-con {
                                                --container-widget-width: 100%
                                            }

                                            .e-con-inner>.elementor-widget-spacer,
                                            .e-con>.elementor-widget-spacer {
                                                width: var(--container-widget-width, var(--spacer-size));
                                                --align-self: var(--container-widget-align-self, initial);
                                                --flex-shrink: 0
                                            }

                                            .e-con-inner>.elementor-widget-spacer>.elementor-widget-container,
                                            .e-con>.elementor-widget-spacer>.elementor-widget-container {
                                                height: 100%;
                                                width: 100%
                                            }

                                            .e-con-inner>.elementor-widget-spacer>.elementor-widget-container>.elementor-spacer,
                                            .e-con>.elementor-widget-spacer>.elementor-widget-container>.elementor-spacer {
                                                height: 100%
                                            }

                                            .e-con-inner>.elementor-widget-spacer>.elementor-widget-container>.elementor-spacer>.elementor-spacer-inner,
                                            .e-con>.elementor-widget-spacer>.elementor-widget-container>.elementor-spacer>.elementor-spacer-inner {
                                                height: var(--container-widget-height, var(--spacer-size))
                                            }

                                            .e-con-inner>.elementor-widget-spacer.elementor-widget-empty,
                                            .e-con>.elementor-widget-spacer.elementor-widget-empty {
                                                position: relative;
                                                min-height: 22px;
                                                min-width: 22px
                                            }

                                            .e-con-inner>.elementor-widget-spacer.elementor-widget-empty .elementor-widget-empty-icon,
                                            .e-con>.elementor-widget-spacer.elementor-widget-empty .elementor-widget-empty-icon {
                                                position: absolute;
                                                top: 0;
                                                bottom: 0;
                                                left: 0;
                                                right: 0;
                                                margin: auto;
                                                padding: 0;
                                                width: 22px;
                                                height: 22px
                                            }
                                        </style>
                                        <div class="elementor-spacer">
                                            <div class="elementor-spacer-inner"></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="swiper-container review-slider thumb-slider">
                                    <div class="swiper-wrapper">
                                        <?php
                                        $args = array(
                                            'post_type' => 'reviews',
                                            'posts_per_page' => 100, // Puoi modificarlo a seconda delle necessità
                                        );

                                        $new_post_loop = new WP_Query($args);
                                        while ($new_post_loop->have_posts()) {
                                            $new_post_loop->the_post();
                                        ?>
                                            <div class="swiper-slide">
                                                <div class="carousel-item">
                                                    <div class="review-header">
                                                        <span class="far fa-user"></span> <!-- Icona utente -->
                                                        <span class="reviewer-name"><?php the_field('customer'); ?><br></span>
                                                    </div>
                                                    <div class="review-title"><?php the_title(); ?></div>
                                                    <div class="review-description">
                                                        <?php the_content(); ?>
                                                    </div>
                                                    <div class="review-source"><?php the_field('platform'); ?></div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>


                                    <div class="review-pagination"></div>
                                    <div class="review-button-next"></div>
                                    <div class="review-button-prev"></div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>
    </div>
    

</div>

<div class="section-heading">
    <p class="text-mid">
        <?php echo icl_t('hello-elementor-child', 'You might also be interested in', 'You might also be interested in'); ?>
    </p>
</div>
<div class="section-background">
    <div class="section-container">
        <div class="item-container">
            <?php echo do_shortcode('[other_products]'); ?>
        </div>
    </div>
</div>

<?php do_action('woocommerce_after_single_product'); ?>