<?php
if (!defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Inol3_Featured_Image_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'inol3-featured-image';
    }
    public function get_title()
    {
        return 'Featured Image (Inol3)';
    }
    public function get_icon()
    {
        return 'eicon-featured-image';
    }
    public function get_categories()
    {
        return ['inol3'];
    }

    protected function register_controls()
    {

        $this->start_controls_section('content', [
            'label' => 'Immagine',
            'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('size', [
            'label'   => 'Size',
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'large',
            'options' => [
                'thumbnail' => 'thumbnail',
                'medium'    => 'medium',
                'large'     => 'large',
                'full'      => 'full',
            ],
        ]);

        $this->end_controls_section();

        // ----- STILE -----
        $this->start_controls_section('style', [
            'label' => 'Stile',
            'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
        ]);

        // Larghezza (responsive)
        $this->add_responsive_control('img_width', [
            'label' => 'Larghezza',
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'vw'],
            'range' => [
                'px' => ['min' => 0, 'max' => 2000],
                '%'  => ['min' => 0, 'max' => 100],
                'vw' => ['min' => 0, 'max' => 100],
            ],
            'selectors' => [
                '{{WRAPPER}} .inol3-featured-image img' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]);

        // Altezza (responsive)
        $this->add_responsive_control('img_height', [
            'label' => 'Altezza',
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'size_units' => ['px', 'vh'],
            'range' => [
                'px' => ['min' => 0, 'max' => 1600],
                'vh' => ['min' => 0, 'max' => 100],
            ],
            'selectors' => [
                '{{WRAPPER}} .inol3-featured-image img' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]);

        // Object-fit
        $this->add_control('object_fit', [
            'label'   => 'Object Fit',
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'cover',
            'options' => [
                'cover'      => 'cover',
                'contain'    => 'contain',
                'fill'       => 'fill',
                'none'       => 'none',
                'scale-down' => 'scale-down',
            ],
            'selectors' => [
                '{{WRAPPER}} .inol3-featured-image img' => 'object-fit: {{VALUE}};',
            ],
        ]);

        // Object-position (utile quando fai cover/contain)
        $this->add_control('object_position', [
            'label'   => 'Object Position',
            'type'    => \Elementor\Controls_Manager::SELECT,
            'default' => 'center center',
            'options' => [
                'center center' => 'center center',
                'center top'    => 'center top',
                'center bottom' => 'center bottom',
                'left center'   => 'left center',
                'right center'  => 'right center',
                'left top'      => 'left top',
                'right top'     => 'right top',
                'left bottom'   => 'left bottom',
                'right bottom'  => 'right bottom',
            ],
            'selectors' => [
                '{{WRAPPER}} .inol3-featured-image img' => 'object-position: {{VALUE}};',
            ],
            'condition' => [
                'object_fit!' => 'fill', // non è obbligatorio, ma spesso inutile con fill
            ],
        ]);

        // Border radius (quello che avevi)
        $this->add_responsive_control('radius', [
            'label' => 'Border radius',
            'type' => \Elementor\Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => 0, 'max' => 80]],
            'selectors' => [
                '{{WRAPPER}} .inol3-featured-image img' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $post_id = inol3_get_effective_post_id_for_widget($settings);
        if ($post_id <= 0) return;

        inol3_with_preview_post(function() use ($settings, $post_id) {

            if (!has_post_thumbnail($post_id)) return;

            $size = !empty($settings['size']) ? $settings['size'] : 'large';

            echo '<div class="inol3-featured-image">';
            echo get_the_post_thumbnail($post_id, $size);
            echo '</div>';

        }, $post_id);
    }

}
