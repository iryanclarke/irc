<?php

// Meta boxes for pages

add_action( 'add_meta_boxes', 'irc_add_hero_metabox' );

/**
 * Add an Editor metabox to the post
 *
 * @param  WP_Post  $post  The post being edited
 */
function irc_add_hero_metabox( $post ) {

    add_meta_box(
        'hero_meta_box',
        __( 'Hero Banner Settings', 'irc' ),
        'irc_render_hero_meta_box',
        'page',
        'normal',
        'default'
    );
}

/**
 * Draws the Editor metabox for a post
 *
 * @param  WP_Post  $post  The post being edited
 */
function irc_render_hero_meta_box( $post ) {

    // Add nonce to validate the meta data
    wp_nonce_field( 'hero_meta', 'hero_metabox_nonce' );

    // Show old data, if it exists
    $hero_subtitle = $hero_paragraph_text = '';
    $hero_title = '';

    if ( isset( $post->ID ) ) {
        $hero_title = get_post_meta( $post->ID, 'hero_title', true );
        $hero_subtitle = get_post_meta( $post->ID, 'hero_subtitle', true );
        $hero_paragraph_text = get_post_meta( $post->ID, 'hero_paragraph_text', true );
    }
?>

<div class="form-field">
    <label for="hero_title"><?php _e( 'Title', 'irc' ); ?></label>
    <input class="widefat" type="text" id="hero_title" name="hero_title" value="<?php echo $hero_title; ?>" />
</div>
<div class="form-field">
    <label for="hero_subtitle"><?php _e( 'Subtitle', 'irc' ); ?></label>
    <input class="widefat" type="text" id="hero_subtitle" name="hero_subtitle" value="<?php echo $hero_subtitle; ?>" />
</div>
<div class="form-field">
    <label for="hero_paragraph_text"><?php _e( 'Button Text', 'irc' ); ?></label>
    <input class="widefat" type="text" id="hero_paragraph_text" name="hero_paragraph_text" value="<?php echo $hero_paragraph_text; ?>" />
</div>
<?php
}

// hook into save action to save the Resources meta data (aka custom fields)
add_action( 'save_post', 'irc_save_custom_fields', 1, 2 );

/**
 * Save the Metabox Data
 */
function irc_save_custom_fields( $post_id, $post ) {

    // If empty, return as there's something wrong
    if ( empty( $post_id ) || empty( $post ) || empty( $_POST ) ) return;

    // Don't save meta on autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( is_int( wp_is_post_autosave( $post ) ) ) return;

    // Don't store custom data twice
    if ( is_int( wp_is_post_revision( $post ) ) ) return;

    // If quick edit dont save any custom info
    $screen = get_current_screen();
    if ( $screen->base != 'post' ) return;

    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post_id )) {
        return $post_id;
    }

    //Make sure this is a page
    if ( $post->post_type != 'page' ) return;

    //Save the metadata
    if ( check_admin_referer( 'hero_meta' , 'hero_metabox_nonce' ) ) {

        $meta = array();

        //Sanitize inputs
        $meta['hero_title'] = sanitize_text_field( $_POST['hero_title'] );
        $meta['hero_subtitle'] = sanitize_text_field( $_POST['hero_subtitle'] );
        $meta['hero_paragraph_text'] = sanitize_text_field( $_POST['hero_paragraph_text'] );

        foreach ( $meta as $key => $value ) {

            //Delete or update the post meta
            if ( empty( $value ) ) {
                delete_post_meta( $post_id, $key, $value );
            } else {
                update_post_meta( $post_id, $key, $value );
            }
        }
    }
}
