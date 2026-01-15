<?php
if (!defined('ABSPATH')) exit;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

class Inol3_Post_Navigation_Widget extends Widget_Base {

    public function get_name() { return 'inol3_post_navigation'; }
    public function get_title() { return 'INOL3 Post Navigation'; }
    public function get_icon() { return 'eicon-arrow-right'; }
    public function get_categories() { return ['inol3']; }

    private function is_elementor_editor(): bool {
        if (!did_action('elementor/loaded')) return false;
        $plugin = \Elementor\Plugin::$instance;
        return (!empty($plugin->editor) && $plugin->editor->is_edit_mode());
    }

    private function get_preview_post_id(): ?int {
        if (!$this->is_elementor_editor()) return null;
        if (empty($_GET['inol3_preview_post'])) return null;
        $id = (int) $_GET['inol3_preview_post'];
        return $id > 0 ? $id : null;
    }

    protected function register_controls() {

        // CONTENT
        $this->start_controls_section('section_content', [
            'label' => 'Contenuto',
        ]);

        $this->add_control('show_prev', [
            'label' => 'Mostra precedente',
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->add_control('show_next', [
            'label' => 'Mostra successivo',
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->add_control('prev_text', [
            'label' => 'Testo precedente',
            'type' => Controls_Manager::TEXT,
            'default' => 'Articolo precedente',
            'condition' => ['show_prev' => 'yes'],
        ]);

        $this->add_control('next_text', [
            'label' => 'Testo successivo',
            'type' => Controls_Manager::TEXT,
            'default' => 'Articolo successivo',
            'condition' => ['show_next' => 'yes'],
        ]);

        $this->add_control('show_titles', [
            'label' => 'Mostra titolo post adiacente',
            'type' => Controls_Manager::SWITCHER,
            'default' => '',
        ]);

        $this->add_control('hide_if_none', [
            'label' => 'Nascondi se non c’è né prev né next',
            'type' => Controls_Manager::SWITCHER,
            'default' => 'yes',
        ]);

        $this->add_control('prev_icon', [
            'label' => 'Icona precedente',
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-arrow-left',
                'library' => 'fa-solid',
            ],
            'condition' => ['show_prev' => 'yes'],
        ]);

        $this->add_control('next_icon', [
            'label' => 'Icona successivo',
            'type' => Controls_Manager::ICONS,
            'default' => [
                'value' => 'fas fa-arrow-right',
                'library' => 'fa-solid',
            ],
            'condition' => ['show_next' => 'yes'],
        ]);

        $this->add_control('icon_position', [
            'label' => 'Posizione icona',
            'type' => Controls_Manager::SELECT,
            'default' => 'before',
            'options' => [
                'before' => 'Prima del testo',
                'after'  => 'Dopo il testo',
            ],
        ]);

        $this->end_controls_section();

        // STYLE - WRAPPER
        $this->start_controls_section('section_style_wrap', [
            'label' => 'Stile layout',
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('justify', [
            'label' => 'Distribuzione',
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => ['title' => 'Sinistra', 'icon' => 'eicon-text-align-left'],
                'center' => ['title' => 'Centro', 'icon' => 'eicon-text-align-center'],
                'flex-end' => ['title' => 'Destra', 'icon' => 'eicon-text-align-right'],
                'space-between' => ['title' => 'Spazio', 'icon' => 'eicon-justify-space-between'],
            ],
            'default' => 'space-between',
            'selectors' => [
                '{{WRAPPER}} .inol3-post-nav' => 'justify-content: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('gap', [
            'label' => 'Spazio tra i due blocchi',
            'type' => Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => 0, 'max' => 120]],
            'selectors' => [
                '{{WRAPPER}} .inol3-post-nav' => 'gap: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // STYLE - ITEM
        $this->start_controls_section('section_style_item', [
            'label' => 'Stile pulsanti',
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_responsive_control('item_padding', [
            'label' => 'Padding',
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .inol3-post-nav a' =>
                    'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('item_radius', [
            'label' => 'Border radius',
            'type' => Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => 0, 'max' => 60]],
            'selectors' => [
                '{{WRAPPER}} .inol3-post-nav a' => 'border-radius: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_group_control(Group_Control_Border::get_type(), [
            'name' => 'item_border',
            'selector' => '{{WRAPPER}} .inol3-post-nav a',
        ]);

        $this->add_group_control(Group_Control_Box_Shadow::get_type(), [
            'name' => 'item_shadow',
            'selector' => '{{WRAPPER}} .inol3-post-nav a',
        ]);

        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'typography',
            'selector' => '{{WRAPPER}} .inol3-post-nav a',
        ]);

        $this->add_responsive_control('icon_size', [
            'label' => 'Dimensione icona',
            'type' => Controls_Manager::SLIDER,
            'range' => ['px' => ['min' => 8, 'max' => 80]],
            'selectors' => [
                '{{WRAPPER}} .inol3-post-nav .inol3-ico' => 'font-size: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->start_controls_tabs('tabs_colors');

        $this->start_controls_tab('tab_normal', ['label' => 'Normale']);

        $this->add_control('text_color', [
            'label' => 'Colore testo',
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .inol3-post-nav a' => 'color: {{VALUE}};',
                '{{WRAPPER}} .inol3-post-nav a .inol3-title' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('bg_color', [
            'label' => 'Sfondo',
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .inol3-post-nav a' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->start_controls_tab('tab_hover', ['label' => 'Hover']);

        $this->add_control('text_color_hover', [
            'label' => 'Colore testo',
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .inol3-post-nav a:hover' => 'color: {{VALUE}};',
                '{{WRAPPER}} .inol3-post-nav a:hover .inol3-title' => 'color: {{VALUE}};',
            ],
        ]);

        $this->add_control('bg_color_hover', [
            'label' => 'Sfondo',
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .inol3-post-nav a:hover' => 'background-color: {{VALUE}};',
            ],
        ]);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $s = $this->get_settings_for_display();

        // Supporto preview builder: ?inol3_preview_post=ID
        $preview_id = $this->get_preview_post_id();

        $old_post = null;
        if ($preview_id) {
            global $post;
            $old_post = $post ?? null;
            $post = get_post($preview_id);
            if ($post) setup_postdata($post);
        }

        // Globali su tutti i post: in_same_term = false
        $prev = ($s['show_prev'] === 'yes') ? get_previous_post(false) : null;
        $next = ($s['show_next'] === 'yes') ? get_next_post(false) : null;

        if ($preview_id) {
            wp_reset_postdata();
            if ($old_post) {
                global $post;
                $post = $old_post;
                setup_postdata($post);
            }
        }

        if ($s['hide_if_none'] === 'yes' && !$prev && !$next) {
            return;
        }

        echo '<div class="inol3-post-nav" style="display:flex;align-items:center;">';

        // PREV
        if ($prev instanceof \WP_Post) {
            $url = get_permalink($prev->ID);
            echo '<a class="inol3-prev" rel="prev" href="' . esc_url($url) . '" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;">';

            if ($s['icon_position'] === 'before') {
                echo '<span class="inol3-ico" aria-hidden="true">';
                Icons_Manager::render_icon($s['prev_icon'], ['class' => 'inol3-ico'], 'i');
                echo '</span>';
            }

            echo '<span class="inol3-label">';
            echo esc_html($s['prev_text']);
            if ($s['show_titles']) {
                echo '<span class="inol3-title" style="display:block;opacity:.85;">' . esc_html(get_the_title($prev->ID)) . '</span>';
            }
            echo '</span>';

            if ($s['icon_position'] === 'after') {
                echo '<span class="inol3-ico" aria-hidden="true">';
                Icons_Manager::render_icon($s['prev_icon'], ['class' => 'inol3-ico'], 'i');
                echo '</span>';
            }

            echo '</a>';
        } else {
            echo '<div></div>';
        }

        // NEXT
        if ($next instanceof \WP_Post) {
            $url = get_permalink($next->ID);
            echo '<a class="inol3-next" rel="next" href="' . esc_url($url) . '" style="display:inline-flex;align-items:center;gap:10px;text-decoration:none;">';

            if ($s['icon_position'] === 'before') {
                echo '<span class="inol3-ico" aria-hidden="true">';
                Icons_Manager::render_icon($s['next_icon'], ['class' => 'inol3-ico'], 'i');
                echo '</span>';
            }

            echo '<span class="inol3-label" style="text-align:right;">';
            echo esc_html($s['next_text']);
            if ($s['show_titles']) {
                echo '<span class="inol3-title" style="display:block;opacity:.85;">' . esc_html(get_the_title($next->ID)) . '</span>';
            }
            echo '</span>';

            if ($s['icon_position'] === 'after') {
                echo '<span class="inol3-ico" aria-hidden="true">';
                Icons_Manager::render_icon($s['next_icon'], ['class' => 'inol3-ico'], 'i');
                echo '</span>';
            }

            echo '</a>';
        }

        echo '</div>';
    }
}
