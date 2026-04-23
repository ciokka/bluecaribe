<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$template_content = '';

if ( class_exists( 'Elementor\\Plugin' ) && is_404() ) {
	$template = get_page_by_path( '404-page', OBJECT, 'elementor_library' );

	if ( $template instanceof WP_Post ) {
		$elementor_template_id = (int) $template->ID;

		if ( $elementor_template_id > 0 ) {
			$lang = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : '';

			if ( ! $lang ) {
				$request_path = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
				$segments = explode( '/', trim( $request_path, '/' ) );
				$lang = isset( $segments[0] ) ? sanitize_key( $segments[0] ) : '';
			}

			if ( $lang && in_array( $lang, [ 'en', 'it', 'es', 'de', 'fr' ], true ) ) {
				global $wpdb;
				$table_name = $wpdb->prefix . 'icl_translations';
				$trid = $wpdb->get_var(
					$wpdb->prepare(
						"SELECT trid FROM {$table_name} WHERE element_id = %d",
						$elementor_template_id
					)
				);

				if ( $trid ) {
					$translated_id = $wpdb->get_var(
						$wpdb->prepare(
							"SELECT element_id FROM {$table_name} WHERE trid = %d AND language_code = %s",
							(int) $trid,
							$lang
						)
					);

					if ( $translated_id ) {
						$elementor_template_id = (int) $translated_id;
					}
				}
			}

			$elementor_instance = Elementor\Plugin::instance();
			$template_content = (string) $elementor_instance->frontend->get_builder_content( $elementor_template_id );

			if ( $template_content && defined( 'ICL_LANGUAGE_CODE' ) ) {
				$template_content = (string) apply_filters(
					'wpml_translate_single_string',
					$template_content,
					'hello-elementor-child',
					'Translation String',
					ICL_LANGUAGE_CODE
				);
			}
		}
	}
}
?>
<main id="content" class="site-main">
	<?php if ( $template_content ) : ?>
		<?php echo $template_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php else : ?>
		<?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
			<div class="page-header">
				<h1 class="entry-title"><?php echo esc_html__( 'The page can&rsquo;t be found.', 'hello-elementor' ); ?></h1>
			</div>
		<?php endif; ?>
		<div class="page-content">
			<p><?php echo esc_html__( 'It looks like nothing was found at this location.', 'hello-elementor' ); ?></p>
		</div>
	<?php endif; ?>
</main>
