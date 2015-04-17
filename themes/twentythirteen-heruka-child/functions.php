<?php add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
    // Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentythirteen-heruka-child-fonts', twentythirteen_heruka_child_fonts_url(), array(), null );

	// Loads JavaScript file with functionality specific to Twenty Thirteen Heruka Child.
	wp_enqueue_script( 'twentythirteen-heruka-child-script', get_stylesheet_directory_uri(). '/js/functions.js', array( 'jquery', 'jquery-masonry', 'twentythirteen-script' ), true );


}




$content_width = 800;

set_post_thumbnail_size( 800, 9999 );
add_image_size( 'thumb-large', 300, 200, true );
add_image_size( 'thumb-menu', 175, 100, true );


/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentythirteen_heruka_child_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );

	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,600,700,300italic,400italic,700italic';

		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}





/*function twentythirteen_heruka_fonts_url() {
	if ( 'off' !== $source_sans_pro) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:600';
	
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}
add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentythirteen_heruka_fonts_url() ) );
*/



function twentythirteen_heruka_body_class( $classes ) {
	$url = $_SERVER['REQUEST_URI'];
	$urlSplit = explode("/", $url);
	$classes[] = $urlSplit[1];
	

	return $classes;
}
add_filter( 'body_class', 'twentythirteen_heruka_body_class' );

add_action( 'after_setup_theme', 'child_theme_setup' );

if ( !function_exists( 'child_theme_setup' ) ):
function child_theme_setup() {

	register_sidebar( array(
		'name' => __( 'Header Right', 'twentythirteen' ),
		'id' => 'header-right',
		'description' => __( 'An optional horizontal widget area', 'twentythirteen' ),
	) );

	register_sidebar( array(
		'name' => __( 'Homepage Top', 'twentythirteen' ),
		'id' => 'home-top',
		'description' => __( 'An optional horizontal widget area', 'twentythirteen' ),
	) );

	register_sidebar( array(
		'name' => __( 'Homepage Middle', 'twentythirteen' ),
		'id' => 'home-middle',
		'description' => __( 'An optional horizontal widget area', 'twentythirteen' ),
	) );

	register_sidebar( array(
		'name' => __( 'Homepage Bottom', 'twentythirteen' ),
		'id' => 'home-bottom',
		'description' => __( 'An optional horizontal widget area', 'twentythirteen' ),
	) );

}
endif;


define( 'WP_MEMORY_LIMIT', '64M' );

add_shortcode('field', 'shortcode_field');

function shortcode_field($atts){
     extract(shortcode_atts(array(
                  'post_id' => NULL,
               ), $atts));
  if(!isset($atts[0])) return;
       $field = esc_attr($atts[0]);
       global $post;
       $post_id = (NULL === $post_id) ? $post->ID : $post_id;
       return get_post_meta($post_id, $field, true);
}

function post_thumbnail( $atts, $content = null ) {
	return '<div class="post_thumbnail">' . get_the_post_thumbnail($post_id) . '</div>';
}

add_shortcode("post_thumbnail", "post_thumbnail");

?>