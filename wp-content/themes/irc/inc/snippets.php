<?php

add_action( 'footer_credits', 'baytek_footer_credits', 11, 2 );

if ( ! function_exists('baytek_footer_credits') ) :

	function baytek_footer_credits($author) { ?>

		<div class="footer-credits">
			<div class="copyright">
				
			</div>

			<div class="author">
				<span><?php _e('Design by', 'irc'); ?> <a href="http://www.baytek.ca/" target="_blank">baytek</a></span>
			</div>
		</div>

	<?php }

endif;



add_action( 'divi_library_item', 'display_divi_library_item', 10, 1 );

if ( ! function_exists('display_divi_library_item') ) :

	/**
	 * Displays the stored Divi Library item specified. 
	 * Intended to be used within template files. Will throw PHP Error Notice if not found.
	 * @author Chad <chad@baytek.ca>
	 * @see http://php.net/manual/en/function.trigger-error.php
	 *
	 */
	function display_divi_library_item( $divi_libraryitem_title = null ) {

		// If they didn't tell us what to grab, get outta here!
		if ( empty( $divi_libraryitem_title )) return;

		// Get the post from the DB for the global Divi library item for what was passed 
		$library_item = get_page_by_title( $divi_libraryitem_title, 'OBJECT', 'et_pb_layout' );


		// If library item requested was not found return an error
		if ( empty( $library_item) ) {
			trigger_error( 
				sprintf( "%s : %s",
					__( 'Divi library item requested does not exist', 'irc'), 
					$divi_libraryitem_title
				),
				E_USER_NOTICE 
			);

			return;
		}

		
		echo do_shortcode( $library_item->post_content );

	}

endif;

//Show the Attachment ID in the media library

if ( ! function_exists( 'admin_table_column_id' ) ) {

	/**
	 * Filters media library columns to add an ID column
	 *
	 * @param  array  $columns  An associative array of columns
	 *
	 * @return array  $columns  The modified array of columns
	 */
	function admin_table_column_id( $columns ) {
		$columns['colID'] = __('ID', 'irc');
		return $columns;
	}
}

if ( ! function_exists( 'admin_table_column_id_row' ) ) {

	/**
	 * Show the media library item ID in the ID column
	 *
	 * @param  string  $columnName  The name of the current column
	 * @param  int     $post_id 	The ID of the current media library item
	 */
	function admin_table_column_id_row( $columnName, $post_id ) {
		if ( $columnName == 'colID') {
			echo $post_id;
		}
	}
}

//Filter the permalink to link to an attachment ID, if it exists on custom post types
if ( ! function_exists( 'irc_add_id_columns' ) ) {

	/**
	 * Add ID columns to media library and other post types
	 */
	function irc_add_id_columns() {

		//Add media library ID
		add_filter( 'manage_media_columns', 'admin_table_column_id' );
		add_filter( 'manage_media_custom_column', 'admin_table_column_id_row', 10, 2 );

		//Add posts table ID
		add_filter( 'manage_posts_columns', 'admin_table_column_id' );
		add_filter( 'manage_posts_custom_column', 'admin_table_column_id_row', 10, 2 );

		//Add the filters for each post type to show the column
		$post_types = get_post_types( array( '_builtin' => false, 'public' => true ), 'names' );

		//Add custom post IDs
		foreach ( $post_types as $type ) {
			add_filter( 'manage_'.$type.'_posts_columns', 'admin_table_column_id' );
			add_filter( 'manage_'.$type.'_posts_custom_column', 'admin_table_column_id_row', 10, 2 );
		}
	}
}

add_action( 'wp_loaded', 'irc_add_id_columns' );

//Filter the 'read more' text, to change to 'download' if there's a PDF
if ( ! function_exists( 'irc_filter_read_more_text' ) ) {

	/**
	 * Change 'read more' to download if there is an attachment
	 *
	 * @param  string  $text     'Read more' by default usually
	 * @param  int     $post_id  The ID of the current post
	 *
	 * @return string  $text     The modified read more text
	 */
	function irc_filter_read_more_text( $text, $post_id = '' ) {

		if ( empty( $post_id ) )
			return $text;

		$attachment_id = get_post_meta( $post_id, 'attachment_id', true );

		if ( !empty ( $attachment_id ) && get_post_type( $attachment_id ) == 'attachment' )
			$text = __( 'Download', 'irc' );

		return $text;
	}

}

add_filter( 'feature_read_more_text', 'irc_filter_read_more_text', 10, 2 );
add_filter( 'irc_read_more_text', 'irc_filter_read_more_text', 10, 2 );

//Filter the permalink to link to an attachment ID, if it exists on custom post types
if ( ! function_exists( 'filter_permalink_on_attachment_id_post_meta' ) ) {

	/**
	 * If a post has attachment_id set, return the permalink for the attachment instead
	 *
	 * @param  string   $url   		The current post link
	 * @param  WP_POST  $post  		The post object
	 * @param  bool     $leavename  Whether to keep the post/page name, default false
	 * @param  bool 	$sample 	Whether this is a sample
	 *
	 * @return string   $url 		The modified url
	 */
	function filter_permalink_on_attachment_id_post_meta( $url, $post, $leavename = false, $sample = false ) {

		//Get a single attachment_id post meta for this post
		$attachment_id = get_post_meta( $post->ID, 'attachment_id', true );

		//If the post has an attachment ID set and it is a post of type attachment, change the url
		if ( !empty ( $attachment_id ) && get_post_type( $attachment_id ) == 'attachment' )
			$url = wp_get_attachment_url( $attachment_id );

		return $url;
	}

}

add_filter( 'post_link', 'filter_permalink_on_attachment_id_post_meta', 10, 4 );

/**
 * Action to load the free trial pre-form and free trial request forms in the footer
 */
function irc_free_trial_forms() {
	get_template_part('template-parts/forms', 'free-trial');
}
add_action( 'wp_footer', 'irc_free_trial_forms' );

/**
 * Add excerpt support for pages, so we can have proper excerpts in our search results
 */
function irc_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'irc_add_excerpts_to_pages' );
