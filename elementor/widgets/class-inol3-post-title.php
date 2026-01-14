<?php
if (!defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Inol3_Post_Title_Widget extends Widget_Base {

    public function get_name() { return 'inol3-post-title'; }
    public function get_title() { return 'Post Title (Inol3)'; }
    public function get_icon() { return 'eicon-post-title'; }
    public function get_categories() { return ['inol3']; }

    protected function register_controls() {

        $this->start_controls_section('content', [
            'label' => 'Contenuto',
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('html_tag', [
            'label'   => 'Tag HTML',
            'type'    => Controls_Manager::SELECT,
            'default' => 'h1',
            'options' => [
                'h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3',
                'div' => 'DIV', 'p' => 'P',
            ],
        ]);

        $this->add_control('link_to_post', [
            'label'        => 'Link al post',
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => '',
        ]);

        $this->add_control('show_date', [
            'label'        => 'Mostra data',
            'type'         => \Elementor\Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => '',
        ]);

        $this->add_control('date_format', [
            'label'       => 'Formato data',
            'type'        => \Elementor\Controls_Manager::TEXT,
            'default'     => get_option('date_format'),
            'description' => 'Esempi: d/m/Y oppure F j, Y',
            'condition'   => [
                'show_date' => 'yes',
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style', [
            'label' => 'Stile',
            'tab'   => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('color', [
            'label'     => 'Colore',
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .inol3-post-title' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name'     => 'typography',
            'selector' => '{{WRAPPER}} .inol3-post-title',
        ]);

        $this->add_responsive_control('align', [
            'label'     => 'Allineamento',
            'type'      => Controls_Manager::CHOOSE,
            'options'   => [
                'left' => ['title' => 'Sinistra', 'icon' => 'eicon-text-align-left'],
                'center' => ['title' => 'Centro', 'icon' => 'eicon-text-align-center'],
                'right' => ['title' => 'Destra', 'icon' => 'eicon-text-align-right'],
            ],
            'selectors' => [
                '{{WRAPPER}} .inol3-post-title' => 'text-align: {{VALUE}};',
            ],
        ]);

        $this->add_control('date_color', [
            'label'     => 'Colore data',
            'type'      => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .inol3-post-date' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'show_date' => 'yes',
            ],
        ]);

        $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
            'name'      => 'date_typography',
            'selector'  => '{{WRAPPER}} .inol3-post-date',
            'condition' => [
                'show_date' => 'yes',
            ],
        ]);

        $this->add_responsive_control('date_spacing', [
            'label' => 'Spazio sopra (data)',
            'type'  => \Elementor\Controls_Manager::SLIDER,
            'range' => [
                'px' => ['min' => 0, 'max' => 50],
            ],
            'selectors' => [
                '{{WRAPPER}} .inol3-post-date' => 'margin-top: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'show_date' => 'yes',
            ],
        ]);


        $this->end_controls_section();
    }

    protected function render() {

        $post_id = inol3_get_effective_post_id_for_widget($this->get_settings_for_display());
        if ($post_id <= 0) return;

        inol3_with_preview_post(function() {

            $settings = $this->get_settings_for_display();
            $tag = $settings['html_tag'] ?: 'h1';

            $title = get_the_title();
            if (!$title) return;

            $inner = (!empty($settings['link_to_post']) && $settings['link_to_post'] === 'yes')
                ? '<a href="' . esc_url(get_permalink()) . '">' . esc_html($title) . '</a>'
                : esc_html($title);

            echo '<' . esc_attr($tag) . ' class="inol3-post-title">' . $inner . '</' . esc_attr($tag) . '>';

            // Data sotto al titolo (opzionale)
            if (!empty($settings['show_date']) && $settings['show_date'] === 'yes') {
                $format = !empty($settings['date_format']) ? $settings['date_format'] : get_option('date_format');
                $date = get_the_date($format);

                if ($date) {
                    echo '<div class="inol3-post-date">' . esc_html($date) . '</div>';
                }
            }

        }, $post_id);
    }


}
