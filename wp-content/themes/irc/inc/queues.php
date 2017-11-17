<?php
// Enqueue styles
function baytek_enqueue_styles() {

    wp_register_style('fontAwesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style( 'fontAwesome');

    wp_register_style('googleFonts', '//fonts.googleapis.com/css?family=Rubik:300,400,500');
    wp_enqueue_style( 'googleFonts');

    wp_register_style('slickCSS', get_stylesheet_directory_uri() . '/styles/slick.css');
    wp_enqueue_style( 'slickCSS');

    wp_register_style('slickThemeCSS', get_stylesheet_directory_uri() . '/styles/slick-theme.css');
    wp_enqueue_style( 'slickThemeCSS');

    //wp_dequeue_style( 'et-builder-modules-style' );
	  wp_enqueue_style( 'baytek-style', get_stylesheet_uri() );
    //wp_enqueue_style( 'et-builder-modules-style', ET_BUILDER_URI . '/styles/frontend-builder-plugin-style.css' , array( 'baytek-style' ) );
}
add_action('wp_print_styles', 'baytek_enqueue_styles', 20);

// Enqueue scripts
function baytek_enqueue_scripts() {
	wp_enqueue_script(
		'slick',
		get_stylesheet_directory_uri() . '/scripts/slick.js',
		array( 'jquery' ),
		false,
		true
	);

	wp_enqueue_script(
		'baytek-custom',
		get_stylesheet_directory_uri() . '/scripts/custom.js',
		array( 'jquery' ),
    false,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'baytek_enqueue_scripts' );

//Enqueue media scripts for user pages
function baytek_enqueue_admin_scripts_for_user() {
	$screen = get_current_screen();

	if ( $screen->base == 'user' || $screen->base == 'user-edit' ) {
		wp_enqueue_media();
	}
}
add_action( 'admin_enqueue_scripts', 'baytek_enqueue_admin_scripts_for_user' );
