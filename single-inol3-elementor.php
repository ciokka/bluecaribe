<?php
if (!defined('ABSPATH')) exit;

get_header();

echo '<main id="content" class="site-main page type-page single-post mw-100">';

if (have_posts()) :
    while (have_posts()) : the_post();

        // Se Elementor è disponibile, renderizza il template globale
        if (did_action('elementor/loaded') && defined('INOL3_SINGLE_POST_ELEMENTOR_TEMPLATE_ID')) {
            $tid = (int) INOL3_SINGLE_POST_ELEMENTOR_TEMPLATE_ID;

            $html = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($tid);

            if (!empty($html)) {
                echo $html;
            } else {
                // fallback
                the_content();
            }
        } else {
            the_content();
        }

    endwhile;
endif;

echo '</main>';

get_footer();
