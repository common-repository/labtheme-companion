<?php
/*
 * @author    Daan Vos de Wael
 * @copyright Copyright (c) 2013, Daan Vos de Wael, http://www.daanvosdewael.com
 * @license   http://en.wikipedia.org/wiki/MIT_License The MIT License
*/
  function labtheme_add_course_metabox($post_type) {
    $types = array('lab-course');

    if (in_array($post_type, $types)) {
      add_meta_box(
        'course-metabox',
        'Course Slider Images',
        'labtheme_course_meta_callback',
        $post_type,
        'normal',
        'high'
      );
    }
    add_meta_box(
        'event-gallery-metabox',
        'Event Gallery',
        'labtheme_event_gallery_meta_callback',
        'lab-event',
        'normal',
        'high'
    );
    add_meta_box( 
        'labtheme_faq_toggle_checkbox', 
        __( 'Open/Close Toggle', 'labtheme-companion' ), 
        'labtheme_faq_toggle_checkbox_meta_callback',
        'lab-faq', 
        'side', 
        'high'
    );
    add_meta_box( 
        'labtheme_client_toggle_checkbox', 
        __( 'Black and White', 'labtheme-companion' ), 
        'labtheme_client_toggle_bc_checkbox_meta_callback',
        'lab-client', 
        'side', 
        'high'
    );

  }
  add_action('add_meta_boxes', 'labtheme_add_course_metabox');

  function labtheme_course_meta_callback($post) {
    wp_nonce_field( basename(__FILE__), 'course_meta_nonce' );
    $ids = get_post_meta($post->ID, '_labtheme_images_course_id', true);
    ?>
    <table class="form-table">
      <tr><td>
        <a class="course-add button" href="#" data-uploader-title="Add image(s) to course" data-uploader-button-text="Add image(s)">Add image(s)</a>

        <ul id="course-metabox-list">
        <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>

          <li>
            <input type="hidden" name="_labtheme_images_course_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
            <img class="image-preview" src="<?php echo $image[0]; ?>">
            <a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image">Change image</a><br>
            <small><a class="remove-image" href="#">Remove image</a></small>
          </li>

        <?php endforeach; endif; ?>
        </ul>

      </td></tr>
    </table>
  <?php }

  function labtheme_course_meta_save($post_id) {
    // print_r($_POST['labthemek_images_course_id']);
    // die;
    if (!isset($_POST['course_meta_nonce']) || !wp_verify_nonce($_POST['course_meta_nonce'], basename(__FILE__))) return;

    if (!current_user_can('edit_post', $post_id)) return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if(isset($_POST['_labtheme_images_course_id'])) {
      update_post_meta($post_id, '_labtheme_images_course_id', $_POST['_labtheme_images_course_id']);
    } else {
      delete_post_meta($post_id, '_labtheme_images_course_id');
    }
  }
  add_action('save_post', 'labtheme_course_meta_save');

  // Evetns
  function labtheme_event_gallery_meta_callback($post) {
    wp_nonce_field( basename(__FILE__), 'event_meta_nonce' );
    $ids = get_post_meta($post->ID, '_labtheme_images_event_id', true);
    ?>
    <table class="form-table">
      <tr><td>
        <a class="event-add button" href="#" data-uploader-title="Add image(s) to Event" data-uploader-button-text="Add image(s)">Add image(s)</a>

        <ul id="event-metabox-list">
        <?php if ($ids) : foreach ($ids as $key => $value) : $image = wp_get_attachment_image_src($value); ?>

          <li>
            <input type="hidden" name="_labtheme_images_event_id[<?php echo $key; ?>]" value="<?php echo $value; ?>">
            <img class="image-preview" src="<?php echo $image[0]; ?>">
            <a class="change-image button button-small" href="#" data-uploader-title="Change image" data-uploader-button-text="Change image">Change image</a><br>
            <small><a class="remove-image" href="#">Remove image</a></small>
          </li>

        <?php endforeach; endif; ?>
        </ul>

      </td></tr>
    </table>
  <?php }

  function labtheme_event_gallery_meta_save($post_id) {
    // print_r($_POST['labthemek_images_course_id']);
    // die;
    if (!isset($_POST['event_meta_nonce']) || !wp_verify_nonce($_POST['event_meta_nonce'], basename(__FILE__))) return;

    if (!current_user_can('edit_post', $post_id)) return;

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if(isset($_POST['_labtheme_images_event_id'])) {
      update_post_meta($post_id, '_labtheme_images_event_id', $_POST['_labtheme_images_event_id']);
    } else {
      delete_post_meta($post_id, '_labtheme_images_event_id');
    }
  }
  add_action('save_post', 'labtheme_event_gallery_meta_save');


/**
 * Outputs the content of the meta box
 */

function labtheme_faq_toggle_checkbox_meta_callback( $post ) {
    $values = get_post_meta( $post->ID );
    $check = isset( $values['toggle_box_check'] ) ? esc_attr( $values['toggle_box_check'][0] ) : '';
    wp_nonce_field( basename( __FILE__ ), 'toggle_checkbox_nonce' );
    $faq_toggle_stored_meta = get_post_meta( $post->ID );
    ?>

    <p>
        <div class="toggle-row-content">
            <label for="featured-checkbox">
                <input type="checkbox" name="featured-checkbox" id="featured-checkbox" value="yes" <?php if ( isset ( $faq_toggle_stored_meta['featured-checkbox'] ) ) checked( $faq_toggle_stored_meta['featured-checkbox'][0], 'yes' ); ?> />
                <?php _e( 'Open toggle', 'labtheme-companion' )?>
            </label><br />
        </div>
    </p>   
    <?php
}


/**
 * Saves the custom meta input
 */
function labtheme_faq_toggle_meta_save( $post_id ) {

    // Checks save status - overcome autosave, etc.
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'toggle_checkbox_nonce' ] ) && wp_verify_nonce( $_POST[ 'toggle_checkbox_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for input and saves - save checked as yes and unchecked at no
    //This line of code is my hack (just keeps the boxes from saving pretty much)
    //if (!empty($_POST['featured-checkbox']) && !empty($_POST['list-checkbox'])) {
            if( isset( $_POST[ 'featured-checkbox' ] ) ) {
                update_post_meta( $post_id, 'featured-checkbox', 'yes' );
            } else {
                update_post_meta( $post_id, 'featured-checkbox', 'no' );
            };
        // (bracket ending the first if statement) }
    }
    add_action( 'save_post', 'labtheme_faq_toggle_meta_save' );


add_action( 'admin_head' , 'wpdocs_remove_post_custom_fields' );


/**
 * Outputs the content of the meta box
 */

function labtheme_client_toggle_bc_checkbox_meta_callback( $post ) {
    $values = get_post_meta( $post->ID );
    $check = isset( $values['blackandwhite_box_check'] ) ? esc_attr( $values['blackandwhite_box_check'][0] ) : '';
    wp_nonce_field( basename( __FILE__ ), 'blackandwhite_checkbox_nonce' );
    $client_black_stored_meta = get_post_meta( $post->ID );
    ?>

    <p>
        <div class="toggle-row-content">
            <label for="featured-checkbox_bandw">
                <input type="checkbox" name="featured-checkbox_bandw" id="featured-checkbox_bandw" value="yes" <?php if ( isset ( $client_black_stored_meta['featured-checkbox_bandw'] ) ) checked( $client_black_stored_meta['featured-checkbox_bandw'][0], 'yes' ); ?> />
                <?php _e( 'Black and White', 'labtheme-companion' )?>
            </label><br />
        </div>
    </p>   
    <?php
}


/**
 * Saves the custom meta input
 */
function labtheme_client_meta_save( $post_id ) {

    // Checks save status - overcome autosave, etc.
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'blackandwhite_checkbox_nonce' ] ) && wp_verify_nonce( $_POST[ 'blackandwhite_checkbox_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    // Checks for input and saves - save checked as yes and unchecked at no
    //This line of code is my hack (just keeps the boxes from saving pretty much)
    //if (!empty($_POST['featured-checkbox_bandw']) && !empty($_POST['list-checkbox'])) {
            if( isset( $_POST[ 'featured-checkbox_bandw' ] ) ) {
                update_post_meta( $post_id, 'featured-checkbox_bandw', 'yes' );
            } else {
                update_post_meta( $post_id, 'featured-checkbox_bandw', 'no' );
            };
        // (bracket ending the first if statement) }
    }
    add_action( 'save_post', 'labtheme_client_meta_save' );


add_action( 'admin_head' , 'wpdocs_remove_post_custom_fields' );
 
/**
 * Remove Custom Fields meta box
 */
function wpdocs_remove_post_custom_fields() {
    remove_meta_box( 'labtheme_lab-faq_id', 'lab-faq', 'side' ); 
    // remove_meta_box( 'labtheme_lab-service_id', 'lab-service', 'side' ); 
    // remove_meta_box( 'labtheme_lab-client_id', 'lab-client', 'side' ); 
}
?>