<?php
if (!defined('ABSPATH')) exit;

use Elementor\Widget_Base;

class Inol3_Post_Content_Widget extends Widget_Base {

    public function get_name() { return 'inol3-post-content'; }
    public function get_title() { return 'Post Content (Inol3)'; }
    public function get_icon() { return 'eicon-post-content'; }
    public function get_categories() { return ['inol3']; }

    protected function render() {

        $post_id = inol3_get_effective_post_id_for_widget($this->get_settings_for_display());
        if ($post_id <= 0) return;

        inol3_with_preview_post(function() use ($post_id) {

            $raw = get_post_field('post_content', $post_id);
            if ($raw === null) return;

            echo '<div class="inol3-post-content">' . apply_filters('the_content', $raw) . '</div>';

        }, $post_id);
    }

}
