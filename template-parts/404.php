<?php
global $wpdb;
/**
 * The template for displaying 404 pages (not found).
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<main id="content" class="page type-page status-publish hentry" role="main">
    <?php
    // Include Elementor content
	if ( class_exists( 'Elementor\Plugin' ) && is_404() ) {
        $langs = array("en", "it", "es", "de", "fr");
        $myUrl = $_SERVER['HTTP_HOST'];   
        $myUrl.= $_SERVER['REQUEST_URI'];  
        $urlArray = explode("/",$myUrl);
        $lang = $urlArray[1];
        
        $slug = '404-page';
        $template = get_page_by_path( '404-page', OBJECT, 'elementor_library' );

        $element_id = $template->ID;

       
        if (in_array($lang, $langs)) {
            $table_name = $wpdb->prefix . 'icl_translations';
            //$element_id = 10005;
            
            $queryTrid = $wpdb->prepare("SELECT trid FROM $table_name WHERE element_id = $element_id");
            $trid = $wpdb->get_var($queryTrid);
    
            $query = $wpdb->prepare("SELECT element_id FROM $table_name WHERE trid = $trid AND language_code = '$lang'");
            $result = $wpdb->get_var($query);
        } else {
            $result =  $element_id;
        }



        $elementor_template_id = $result; //9794; 
		$elementor_instance = Elementor\Plugin::instance();
        
		// Get the content of the Elementor template by its ID
		$content = $elementor_instance->frontend->get_builder_content( $elementor_template_id );
        
		// Traduci il contenuto utilizzando WPML
		$translated_content = apply_filters( 'wpml_translate_single_string', $content, 'hello-elementor-child', 'Translation String', ICL_LANGUAGE_CODE );


		// Visualizza il contenuto tradotto
		echo $translated_content;
	} else {
        // Fallback content if Elementor is not active
        ?>
        <header class="page-header">
            <h1 class="entry-title"><?php esc_html_e( 'The page can&rsquo;t be found.', 'hello-elementor-child' ); ?></h1>
        </header>
        <div class="page-content">
            <p><?php esc_html_e( 'It looks like nothing was found at this location.', 'hello-elementor-child' ); ?></p>
        </div>
        <?php
    }
    ?>
</main>


