<?php


/**
 * Allows uploading of SVG files.
 */
function custom_mtypes( $m ){
    $m['svg'] = 'image/svg+xml';
    $m['svgz'] = 'image/svg+xml';
    return $m;
}
add_filter( 'upload_mimes', 'custom_mtypes' );


/**
 * Adds support for the Divi Page Builder to be used on additional post types.
 * @param   array   $post_types  The current collection of post types that can use the page builder
 * @return  array   The filtered collection of post types that can use the page builder
 *
 * @author  Chad Sehn
 * @see     et_builder_get_builder_post_types
 */
function custom_et_builder_post_types( $post_types ) {

    // $post_types[] = 'custom post type';
    $post_types[] = 'baytek-robots';
    $post_types[] = 'baytek-products';
     
    return $post_types;

}
add_filter( 'et_builder_post_types', 'custom_et_builder_post_types' );


// Remove default link on attached images
function wpb_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	
	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'wpb_imagelink_setup', 10);


// Custom excerpt length
function excerpt($limit) {

	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ", $excerpt).'...';
	} 
	else {
		$excerpt = implode(" ", $excerpt);
	}
	$excerpt = preg_replace('`[[^]]*]`', '', $excerpt);

	return $excerpt;

}


// Increase upload size
@ini_set( 'upload_max_size' , '20M' );
@ini_set( 'post_max_size', '20M');
@ini_set( 'max_execution_time', '300' );

