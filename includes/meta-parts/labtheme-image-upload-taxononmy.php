<?php
/**
 * Plugin class
 **/
if ( ! class_exists( 'LABTHEME_TAX_META' ) ) {

    class LABTHEME_TAX_META {

        public function __construct() {
            //
        }
     
        /*
        * Initialize the class and start calling our hooks and filters
        * @since 1.0.0
        */
        public function init() {
            add_action( 'lab_course_categories_add_form_fields', array ( $this, 'labtheme_add_category_image' ), 10, 2 );
            add_action( 'created_lab_course_categories', array ( $this, 'labtheme_save_category_image' ), 10, 2 );
            add_action( 'lab_course_categories_edit_form_fields', array ( $this, 'labtheme_update_category_image' ), 10, 2 );
            add_action( 'edited_lab_course_categories', array ( $this, 'labtheme_updated_category_image' ), 10, 2 );
            add_filter( 'manage_edit-lab_course_categories_columns', array( $this, 'labtheme_taxonomy_custom_image_columns' ), 10, 2 );
            add_action( 'manage_lab_course_categories_custom_column', array( $this, 'labtheme_taxonomy_image_custom_columns' ), 10, 3 );

            add_action( 'lab_event_categories_add_form_fields', array ( $this, 'labtheme_add_category_image' ), 10, 2 );
            add_action( 'created_lab_event_categories', array ( $this, 'labtheme_save_category_image' ), 10, 2 );
            add_action( 'lab_event_categories_edit_form_fields', array ( $this, 'labtheme_update_category_image' ), 10, 2 );
            add_action( 'edited_lab_event_categories', array ( $this, 'labtheme_updated_category_image' ), 10, 2 );
            add_filter( 'manage_edit-lab_event_categories_columns', array( $this, 'labtheme_taxonomy_custom_image_columns' ), 10, 2 );
            add_action( 'manage_lab_event_categories_custom_column', array( $this, 'labtheme_taxonomy_image_custom_columns' ), 10, 3 );

            add_action( 'lab_portfolio_categories_add_form_fields', array ( $this, 'labtheme_add_category_image' ), 10, 2 );
            add_action( 'created_lab_portfolio_categories', array ( $this, 'labtheme_save_category_image' ), 10, 2 );
            add_action( 'lab_portfolio_categories_edit_form_fields', array ( $this, 'labtheme_update_category_image' ), 10, 2 );
            add_action( 'edited_lab_portfolio_categories', array ( $this, 'labtheme_updated_category_image' ), 10, 2 );
            add_filter( 'manage_edit-lab_portfolio_categories_columns', array( $this, 'labtheme_taxonomy_custom_image_columns' ), 10, 2 );
            add_action( 'manage_lab_portfolio_categories_custom_column', array( $this, 'labtheme_taxonomy_image_custom_columns' ), 10, 3 );

            add_action( 'lab_testimonial_categories_add_form_fields', array ( $this, 'labtheme_add_category_image' ), 10, 2 );
            add_action( 'created_lab_testimonial_categories', array ( $this, 'labtheme_save_category_image' ), 10, 2 );
            add_action( 'lab_testimonial_categories_edit_form_fields', array ( $this, 'labtheme_update_category_image' ), 10, 2 );
            add_action( 'edited_lab_testimonial_categories', array ( $this, 'labtheme_updated_category_image' ), 10, 2 );
            add_filter( 'manage_edit-lab_testimonial_categories_columns', array( $this, 'labtheme_taxonomy_custom_image_columns' ), 10, 2 );
            add_action( 'manage_lab_testimonial_categories_custom_column', array( $this, 'labtheme_taxonomy_image_custom_columns' ), 10, 3 );

            add_action( 'lab_team_categories_add_form_fields', array ( $this, 'labtheme_add_category_image' ), 10, 2 );
            add_action( 'created_lab_team_categories', array ( $this, 'labtheme_save_category_image' ), 10, 2 );
            add_action( 'lab_team_categories_edit_form_fields', array ( $this, 'labtheme_update_category_image' ), 10, 2 );
            add_action( 'edited_lab_team_categories', array ( $this, 'labtheme_updated_category_image' ), 10, 2 );
            add_filter( 'manage_edit-lab_team_categories_columns', array( $this, 'labtheme_taxonomy_custom_image_columns' ), 10, 2 );
            add_action( 'manage_lab_team_categories_custom_column', array( $this, 'labtheme_taxonomy_image_custom_columns' ), 10, 3 );

            add_action( 'lab_faq_categories_add_form_fields', array ( $this, 'labtheme_add_category_image' ), 10, 2 );
            add_action( 'created_lab_faq_categories', array ( $this, 'labtheme_save_category_image' ), 10, 2 );
            add_action( 'lab_faq_categories_edit_form_fields', array ( $this, 'labtheme_update_category_image' ), 10, 2 );
            add_action( 'edited_lab_faq_categories', array ( $this, 'labtheme_updated_category_image' ), 10, 2 );
            add_filter( 'manage_edit-lab_faq_categories_columns', array( $this, 'labtheme_taxonomy_custom_image_columns' ), 10, 2 );
            add_action( 'manage_lab_faq_categories_custom_column', array( $this, 'labtheme_taxonomy_image_custom_columns' ), 10, 3 );

            add_action( 'lab_service_categories_add_form_fields', array ( $this, 'labtheme_add_category_image' ), 10, 2 );
            add_action( 'created_lab_service_categories', array ( $this, 'labtheme_save_category_image' ), 10, 2 );
            add_action( 'lab_service_categories_edit_form_fields', array ( $this, 'labtheme_update_category_image' ), 10, 2 );
            add_action( 'edited_lab_service_categories', array ( $this, 'labtheme_updated_category_image' ), 10, 2 );
            add_filter( 'manage_edit-lab_service_categories_columns', array( $this, 'labtheme_taxonomy_custom_image_columns' ), 10, 2 );
            add_action( 'manage_lab_service_categories_custom_column', array( $this, 'labtheme_taxonomy_image_custom_columns' ), 10, 3 );

            add_action( 'lab_client_categories_add_form_fields', array ( $this, 'labtheme_add_category_image' ), 10, 2 );
            add_action( 'created_lab_client_categories', array ( $this, 'labtheme_save_category_image' ), 10, 2 );
            add_action( 'lab_client_categories_edit_form_fields', array ( $this, 'labtheme_update_category_image' ), 10, 2 );
            add_action( 'edited_lab_client_categories', array ( $this, 'labtheme_updated_category_image' ), 10, 2 );
            add_filter( 'manage_edit-lab_client_categories_columns', array( $this, 'labtheme_taxonomy_custom_image_columns' ), 10, 2 );
            add_action( 'manage_lab_client_categories_custom_column', array( $this, 'labtheme_taxonomy_image_custom_columns' ), 10, 3 );

            add_action( 'category_add_form_fields', array ( $this, 'labtheme_add_category_image' ), 10, 2 );
            add_action( 'created_category', array ( $this, 'labtheme_save_category_image' ), 10, 2 );
            add_action( 'category_edit_form_fields', array ( $this, 'labtheme_update_category_image' ), 10, 2 );
            add_action( 'edited_category', array ( $this, 'labtheme_updated_category_image' ), 10, 2 );
            add_filter( 'manage_edit-category_columns', array( $this, 'labtheme_taxonomy_custom_image_columns' ), 10, 2 );
            add_action( 'manage_category_custom_column', array( $this, 'labtheme_taxonomy_image_custom_columns' ), 10, 3 );

            add_action( 'admin_enqueue_scripts', array( $this, 'labtheme_load_media' ) );
            add_action( 'admin_footer', array ( $this, 'labtheme_add_script' ) );
        }

        public function labtheme_load_media() {
            wp_enqueue_media();
        }
     
        /*
        * Add a form field in the new category page
        * @since 1.0.0
        */
        public function labtheme_add_category_image ( $taxonomy ) { ?>
            <div class="form-field term-group">
                <label for="category-image-id"><?php _e('Image', 'labtheme-companion'); ?></label>
                <input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
                <div id="category-image-wrapper"></div>
                <p>
                    <input type="button" class="button button-secondary labtheme_tax_media_button" id="labtheme_tax_media_button" name="labtheme_tax_media_button" value="<?php _e( 'Add Image', 'labtheme-companion' ); ?>" />
                    <input type="button" class="button button-secondary labtheme_tax_media_remove" id="labtheme_tax_media_remove" name="labtheme_tax_media_remove" value="<?php _e( 'Remove Image', 'labtheme-companion' ); ?>" />
                </p>
            </div>
            <?php
        }

     
        /*
        * Save the form field
        * @since 1.0.0
        */
        public function labtheme_save_category_image ( $term_id, $tt_id ) {
            if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
                $image = $_POST['category-image-id'];
                add_term_meta( $term_id, 'category-image-id', $image, true );
            }
        }

     
        /*
        * Edit the form field
        * @since 1.0.0
        */
        public function labtheme_update_category_image ( $term, $taxonomy ) { ?>
            <tr class="form-field term-group-wrap">
                <th scope="row">
                    <label for="category-image-id"><?php _e( 'Image', 'labtheme-companion' ); ?></label>
                </th>
                <td>
                    <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
                <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
                    <div id="category-image-wrapper">
                        <?php if ( $image_id ) { ?>
                            <?php echo wp_get_attachment_image ( $image_id, 'thumbnail' ); ?>
                        <?php } ?>
                    </div>
                    <p>
                        <input type="button" class="button button-secondary labtheme_tax_media_button" id="labtheme_tax_media_button" name="labtheme_tax_media_button" value="<?php _e( 'Add Image', 'labtheme-companion' ); ?>" />
                        <input type="button" class="button button-secondary labtheme_tax_media_remove" id="labtheme_tax_media_remove" name="labtheme_tax_media_remove" value="<?php _e( 'Remove Image', 'labtheme-companion' ); ?>" />
                    </p>
                </td>
            </tr>
            <?php
        }

        /*
        * Update the form field value
        * @since 1.0.0
        */
        public function labtheme_updated_category_image ( $term_id, $tt_id ) {
            if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
                $image = $_POST['category-image-id'];
                update_term_meta ( $term_id, 'category-image-id', $image );
            } else {
                update_term_meta ( $term_id, 'category-image-id', '' );
            }
        }

        /*
        * Add script
        * @since 1.0.0
        */
        public function labtheme_add_script() { ?>
            <script>
                jQuery(document).ready( function($) {
                    function labtheme_media_upload(button_class) {
                        var _custom_media = true,
                        _orig_send_attachment = wp.media.editor.send.attachment;
                        $('body').on('click', button_class, function(e) {
                            var button_id = '#'+$(this).attr('id');
                            var send_attachment_bkp = wp.media.editor.send.attachment;
                            var button = $(button_id);
                            _custom_media = true;
                            wp.media.editor.send.attachment = function(props, attachment){
                                if ( _custom_media ) {
                                    $('#category-image-id').val(attachment.id);
                                    $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                                    $('#category-image-wrapper .custom_media_image').attr('src',attachment.url).css('display','block');
                                } else {
                                    return _orig_send_attachment.apply( button_id, [props, attachment] );
                                }
                            }
                            wp.media.editor.open(button);
                            return false;
                       });
                    }
                    labtheme_media_upload('.labtheme_tax_media_button.button'); 
                    $('body').on('click','.labtheme_tax_media_remove',function(){
                        $('#category-image-id').val('');
                        $('#category-image-wrapper').html('<img class="custom_media_image" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
                    });
                
                    // Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
                    $(document).ajaxComplete(function(event, xhr, settings) {
                        var queryStringArr = settings.data.split('&');
                        if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
                            var xml = xhr.responseXML;
                            $response = $(xml).find('term_id').text();
                            if($response!=""){
                                // Clear the thumb image
                                $('#category-image-wrapper').html('');
                            }
                        }
                    });
                });
            </script>
            <?php 
        }

        /**
        * Add column Thumbnail.
        *
        * @since    1.0.0
        */
        function labtheme_taxonomy_custom_image_columns($columns) {
            $new_columns = array(
                'thumb_id'    => __( 'Thumbnail', 'wp-travel-engine' ),
            );
            return array_merge( $columns, $new_columns );
        }

        /**
        * Show thumbnail.
        *
        * @since    1.0.0
        */
        function labtheme_taxonomy_image_custom_columns( $column,$term_id,$tid  ) {
            $image_id = get_term_meta ( $tid, 'category-image-id', true );
            if ( $image_id ) {
                echo wp_get_attachment_image ( $image_id, 'thumb' );
            } 
        }
    }
    $LABTHEME_TAX_META = new LABTHEME_TAX_META();
    $LABTHEME_TAX_META -> init();
}