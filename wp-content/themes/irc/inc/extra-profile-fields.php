<?php

/**
 * Extra fields for user profiles, e.g. LinkedIn
 *
 */

// Function for the display of the user profile fields
if ( ! function_exists('irc_profile_fields') ) :
function irc_profile_fields( $user ) { ?>

	<h3><?php _e( 'Public Information & Preferences', 'irc' ); ?></h3>

	<table class="form-table">
        <tr>
            <th><label for="accreditations"><?php _e( 'Accreditations', 'irc' ); ?></label></th>
            <td>
                <input type="text" name="accreditations" id="accreditations" class="regular-text" value="<?php echo get_the_author_meta( 'accreditations', $user->ID ); ?>" />
            </td>
        </tr>
		<tr>
			<th><label for="linkedin_url"><?php _e( 'LinkedIn profile URL', 'irc' ); ?></label></th>
			<td>
				<input type="text" name="linkedin_url" id="linkedin_url" class="regular-text" value="<?php echo get_the_author_meta( 'linkedin_url', $user->ID ); ?>" />
			</td>
		</tr>
		<tr>
			<th><label for="linkedin_preference"><?php _e( 'Display LinkedIn', 'irc' ); ?></label></th>
			<td>
				<input type="checkbox" name="linkedin_preference" id="linkedin_preference" value="1" <?php echo get_the_author_meta( 'linkedin_preference', $user->ID ) == '1' ? ' checked="checked"' : ''; ?> />
				<p class="description"><?php _e( 'Check to display LinkedIn information on your posts.', 'irc' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="email_preference"><?php _e( 'Display Email', 'irc' ); ?></label></th>
			<td>
				<input type="checkbox" name="email_preference" id="email_preference" value="1" <?php echo get_the_author_meta( 'email_preference', $user->ID ) == '1' ? ' checked="checked"' : ''; ?> />
				<p class="description"><?php _e( 'Check to display email information on your posts.', 'irc' ); ?></p>
			</td>
		</tr>
		<tr>
			<td></td>
			<td id="profile-picture-wrapper">
	<?php

	// Get WordPress' media upload URL
    $upload_link = esc_url( get_upload_iframe_src( 'file' ) );

    // See if there's a media library id already saved as post meta
    $attachment_id = get_the_author_meta( 'attachment_id', $user->ID );

    // For convenience, see if there is a file
    $res_has_file = !empty( $attachment_id );

    // Get the preview image/icon for the file src if there is a file
    $preview_thumb = $res_has_file ? wp_get_attachment_image( $attachment_id, 'thumbnail' ) : '';
    $preview_title = $res_has_file ? get_the_title( $attachment_id ) : '';
    $preview_url   = $res_has_file ? wp_get_attachment_url( $attachment_id ) : '';

    ?>
    <!-- A hidden input to set and post the chosen pdf id -->
    <input class="res-support-file-id" name="attachment_id" type="hidden" value="<?php echo esc_attr( $attachment_id ); ?>" />

    <div class="res-support-file-container <?php if ( ! $res_has_file  ) { echo 'hidden'; } ?>">
        <?php 
            printf( '<p><a href="%1$s" target="_blank">%2$s</a><br><a href="%1$s" target="_blank">%3$s</a></p>',
                $preview_url,
                $preview_thumb, 
                $preview_title 
            );
        ?>
    </div>

    <!-- add & remove pdf links -->
    <p class="hide-if-no-js plugins">
        <a class="upload-resfile <?php if ( $res_has_file  ) { echo 'hidden'; } ?>" 
           href="<?php echo $upload_link ?>">
            <?php _e( 'Set Profile Picture', 'irc' ); ?>
        </a>
        <a class="delete-resfile delete <?php if ( ! $res_has_file  ) { echo 'hidden'; } ?>" style="text-decoration:none;" 
          href="#">
            <?php _e( 'Remove Profile Picture', 'irc' ); ?>
        </a>
    </p>

    <script type="text/javascript">
        jQuery(function($){

            // Set all variables to be used in scope
            var frame,
                tableCell = $( '#profile-picture-wrapper' ),
                addFileLink = tableCell.find( '.upload-resfile' ),
                delFileLink = tableCell.find( '.delete-resfile' ),
                fileContainer = tableCell.find( '.res-support-file-container' ),
                fileIdInput = tableCell.find( '.res-support-file-id' );
      
            // ADD IMAGE LINK
            addFileLink.on( 'click', function( event ){
                
                event.preventDefault();
                
                // If the media frame already exists, reopen it.
                if ( frame ) {
                    frame.open();
                    return;
                }
                
                // Create a new media frame
                frame = wp.media({
                    title: '<?php _e( "Select or upload your Profile Picture", "irc"); ?>',
                    button: { text: '<?php _e( "Use Selected Image", "irc"); ?>' },
                    library: { type : 'image' },
                    multiple: false  // Set to true to allow multiple files to be selected
                });

                
                // When an file is selected in the media frame...
                frame.on( 'select', function() {
                  
                    // Get media attachment details from the frame state
                    var attachment = frame.state().get('selection').first().toJSON();

                    console.log(attachment);

                    // Send the attachment URL to our custom image input field.
                    fileContainer.append( 
                        '<p><a href="'+attachment.url+'" target="_blank">'+'<img src="'+attachment.sizes.thumbnail.url+'" /></a><br>' +
                        '<a href="'+attachment.url+'" " target="_blank">'+attachment.title+'</a></p>'
                    );

                    // Send the attachment id to our hidden input
                    fileIdInput.val( attachment.id );

                    // Hide the add PDF link
                    addFileLink.addClass( 'hidden' );

                    // Unhide the remove PDF link
                    delFileLink.removeClass( 'hidden' );

                    // Unhide the res box
                    fileContainer.removeClass( 'hidden' );
                });

                // Finally, open the modal on click
                frame.open();
            });
              
            // DELETE PDF FILE LINK
            delFileLink.on( 'click', function( event ){

                event.preventDefault();

                // Clear out the preview PDF
                fileContainer.html( '' );

                // Un-hide the add PDF link
                addFileLink.removeClass( 'hidden' );

                // Hide the delete PDF link
                delFileLink.addClass( 'hidden' );

                // Hide the res box
                fileContainer.addClass( 'hidden' );

                // Delete the PDF file id from the hidden input
                fileIdInput.val( '' );
            });
        });
    </script>

    		</td>
		</tr>
	</table>

<?php }
endif;
// Hook into the actions for viewing a user profile and your own profile
add_action( 'show_user_profile', 'irc_profile_fields', 1 );
add_action( 'edit_user_profile', 'irc_profile_fields', 1 );
add_action( 'user_new_form', 'irc_profile_fields', 1 );


// Function for saving the custom user / contractor fields
if ( ! function_exists('irc_save_profile_fields') ) :
function irc_save_profile_fields( $user_id ) {

	// If the current user doesn't have permission to edit the user then return
	if ( !current_user_can( 'edit_user', $user_id ) ) return false;

	// Update company information
    update_usermeta( $user_id, 'accreditations', esc_attr( $_POST['accreditations'] ) );
	update_usermeta( $user_id, 'email_preference', esc_attr( $_POST['email_preference'] ) );
	update_usermeta( $user_id, 'linkedin_preference', esc_attr( $_POST['linkedin_preference'] ) );
	update_usermeta( $user_id, 'linkedin_url', esc_attr( $_POST['linkedin_url'] ) );
	update_usermeta( $user_id, 'attachment_id', esc_attr( $_POST['attachment_id'] ) );
}
endif;
// Hook into the actions for updating a user profile and your own profile
add_action( 'personal_options_update',  'irc_save_profile_fields' );
add_action( 'edit_user_profile_update', 'irc_save_profile_fields' );
add_action( 'user_register', 'irc_save_profile_fields' );
