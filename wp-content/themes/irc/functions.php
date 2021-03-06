<?php
/**
 * Baytek Template functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package irc
 */

if ( ! function_exists( 'irc_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function irc_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Baytek Template, use a find and replace
	 * to change 'irc' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'irc', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'latest-news', 340, 230, true );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'irc_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'irc_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function irc_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'irc_content_width', 640 );
}
add_action( 'after_setup_theme', 'irc_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function irc_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'irc' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'irc_widgets_init' );


// Title Shortcode
function myshortcode_title( ){
   return get_the_title();
}
add_shortcode( 'page_title', 'myshortcode_title' );


// Leadership close button
function do_leadership_close_button( ){
   return "<span class='close'></span>";
}
add_shortcode( 'leadership-close', 'do_leadership_close_button' );


/*
* Registering custom post types to use Divi page builder
*
*/
function my_et_builder_post_types( $post_types ) {
    $post_types[] = 'news';
    return $post_types;
}
add_filter( 'et_builder_post_types', 'my_et_builder_post_types' );

function wpdocs_irc_scripts() {
    wp_enqueue_style( 'fontawesome.min', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_irc_scripts' );



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require 'inc/helpers.php';
require 'inc/queues.php';
require 'inc/cpt.php';
require 'inc/snippets.php';
require 'inc/metaboxes.php';
require 'inc/extra-profile-fields.php';
