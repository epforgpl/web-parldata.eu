<?php

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function sc_add_custom_box() {

    $screens = array( 'post', 'page', 'advanced', 'high' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'sc_sectionid',
            __( 'Dynamic Heading Text', 'scribe' ),
            'sc_inner_custom_box',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'sc_add_custom_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function sc_inner_custom_box( $post ) {

  // Add an nonce field so we can check for it later.
  wp_nonce_field( 'sc_inner_custom_box', 'sc_inner_custom_box_nonce' );

  /*
   * Use get_post_meta() to retrieve an existing value
   * from the database and use the value for the form.
   */
  $value = get_post_meta( $post->ID, '_sc_meta_value_key', true );

  echo '<label for="sc_new_field">';
       _e( "Enter replacement text ", 'scribe' );
  echo '</label> ';
  echo '<input type="text" id="sc_new_field" name="sc_new_field" value="' . esc_attr( $value ) . '" size="25" />';
 _e( " (Wrap title text to be replaced in 'span' tags)", 'scribe' );
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function sc_save_postdata( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['sc_inner_custom_box_nonce'] ) )
    return $post_id;

  $nonce = $_POST['sc_inner_custom_box_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'sc_inner_custom_box' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;

  // Check the user's permissions.
  if ( 'page' == $_POST['post_type'] ) {

    if ( ! current_user_can( 'edit_page', $post_id ) )
        return $post_id;
  
  } else {

    if ( ! current_user_can( 'edit_post', $post_id ) )
        return $post_id;
  }

  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
  $scdata = sanitize_text_field( $_POST['sc_new_field'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, '_sc_meta_value_key', $scdata );
}
add_action( 'save_post', 'sc_save_postdata' );

function sc_move_deck() {

    # Get the globals:
    global $post, $wp_meta_boxes;

    # Output the "advanced" meta boxes:
    do_meta_boxes(get_current_screen(), 'advanced', $post);

    # Remove the initial "advanced" meta boxes:
    unset($wp_meta_boxes['post']['advanced']);
	unset($wp_meta_boxes['page']['advanced']);

}

add_action('edit_form_after_title', 'sc_move_deck');

