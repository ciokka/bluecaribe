<?php 
    $post_id = get_the_ID();
    $images = get_attached_media('image', $post_id);

    if ($images) {
        ?>
     <div class="swiper-container main-slider">
        <div class="swiper-wrapper">
            <?php
        $test = []; 
        foreach ($images as $image) {
            $image_url = wp_get_attachment_image_src($image->ID, 'full')[0];
            if (!in_array($image_url, $test)) {
                ?>
                <div class="swiper-slide">
                    <a data-elementor-open-lightbox="yes" data-elementor-lightbox-title="<?php echo esc_attr($image->post_title); ?>" href="<?php echo esc_url($image_url); ?>">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image->post_title); ?>"/>
                    </a>
                </div>
                <?php 
                $test[] = $image_url;
            }
        }
        ?>
        </div>

       </div>

       <div class="swiper-container thumb-slider">
        <div class="swiper-wrapper">
        <?php
        foreach ($images as $image) {
            $image_url = wp_get_attachment_image_src($image->ID, 'thumbnail')[0];
         ?>   
            <div class="swiper-slide"><img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image->post_title); ?>"/></div>
        <?php    
        }
        ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        </div>
    <?php 
    }
