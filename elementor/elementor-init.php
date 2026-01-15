<?php
if (!defined('ABSPATH')) exit;

function inol3_is_elementor_editor(): bool {
    if (!did_action('elementor/loaded')) return false;
    $plugin = \Elementor\Plugin::$instance;
    return (!empty($plugin->editor) && $plugin->editor->is_edit_mode());
}

/**
 * Ritorna l'ID del post da usare come preview nell'editor:
 * 1) se c'è ?inol3_preview_post=ID in URL, usa quello
 * 2) altrimenti null
 */
function inol3_get_global_preview_post_id(): ?int {
    if (!inol3_is_elementor_editor()) return null;
    if (empty($_GET['inol3_preview_post'])) return null;

    $id = (int) $_GET['inol3_preview_post'];
    return $id > 0 ? $id : null;
}

function inol3_get_effective_post_id_for_widget(array $settings = []): int {
    // In frontend: usa il post reale
    if (!inol3_is_elementor_editor()) {
        return (int) get_the_ID();
    }

    // In editor: se c'è il preview globale via URL, usa quello
    $gid = inol3_get_global_preview_post_id();
    if ($gid) return $gid;

    // Fallback: template stesso (non utile, ma evita 0)
    return (int) get_the_ID();
}

/**
 * Esegue una callback "dentro" il contesto del post di preview (solo in editor).
 * Ripristina sempre il contesto originale a fine esecuzione.
 */
function inol3_with_preview_post(callable $cb, int $post_id) {
    $original_post = $GLOBALS['post'] ?? null;

    $p = get_post($post_id);
    if ($p) {
        $GLOBALS['post'] = $p;
        setup_postdata($p);
    }

    $result = $cb();

    // ripristino
    if ($original_post) {
        $GLOBALS['post'] = $original_post;
        setup_postdata($original_post);
    } else {
        wp_reset_postdata();
    }

    return $result;
}

/**
 * Registra la categoria "Widget Inol3"
 */
add_action('elementor/elements/categories_registered', function ($elements_manager) {
    $elements_manager->add_category(
        'inol3',
        [
            'title' => 'Widget Inol3',
            'icon'  => 'fa fa-plug',
        ]
    );
});

/**
 * Registra i widget
 */
add_action('elementor/widgets/register', function ($widgets_manager) {

    if (!did_action('elementor/loaded')) return;

    require_once __DIR__ . '/widgets/class-inol3-post-title.php';
    require_once __DIR__ . '/widgets/class-inol3-featured-image.php';
    require_once __DIR__ . '/widgets/class-inol3-post-content.php';
    require_once __DIR__ . '/widgets/class-inol3-post-navigation.php';

    $widgets_manager->register(new \Inol3_Post_Title_Widget());
    $widgets_manager->register(new \Inol3_Featured_Image_Widget());
    $widgets_manager->register(new \Inol3_Post_Content_Widget());
    $widgets_manager->register(new \Inol3_Post_Navigation_Widget());
});


