<?php
    $post_id = get_the_ID();
    $product = wc_get_product($post_id);
    $attachment_ids = $product->get_gallery_image_ids(); // Ottiene gli ID delle immagini della galleria

    if (has_post_thumbnail($post_id) || !empty($attachment_ids)) {
        ?>
        <div class="swiper-container main-slider">
            <div class="swiper-wrapper">
                <?php
                // Aggiungi l'immagine principale del prodotto
                if (has_post_thumbnail($post_id)) {
                    $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'full')[0];
                    ?>
                    <div class="swiper-slide">
                        <a data-elementor-open-lightbox="yes" data-elementor-lightbox-title="<?php echo esc_attr(get_the_title($post_id)); ?>" href="<?php echo esc_url($image_url); ?>">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>" />
                        </a>
                    </div>
                    <?php
                }

                // Aggiungi le immagini della galleria
                foreach ($attachment_ids as $attachment_id) {
                    $image_url = wp_get_attachment_image_src($attachment_id, 'full')[0];
                    ?>
                    <div class="swiper-slide">
                        <a data-elementor-open-lightbox="yes" data-elementor-lightbox-title="<?php echo esc_attr(get_the_title($attachment_id)); ?>" href="<?php echo esc_url($image_url); ?>">
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title($attachment_id)); ?>" />
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="swiper-container thumb-slider">
            <div class="swiper-wrapper">
                <?php
                // Miniatura dell'immagine principale
                if (has_post_thumbnail($post_id)) {
                    $image_url = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'thumbnail')[0];
                    ?>
                    <div class="swiper-slide">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>" />
                    </div>
                    <?php
                }

                // Miniature delle immagini della galleria
                foreach ($attachment_ids as $attachment_id) {
                    $image_url = wp_get_attachment_image_src($attachment_id, 'thumbnail')[0];
                    ?>
                    <div class="swiper-slide">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title($attachment_id)); ?>" />
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    <?php
    }
?>

