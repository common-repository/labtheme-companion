<?php
    global $post;
    $labtheme_setting = get_post_meta( $post->ID, '_labtheme_setting', true );
    /**
    * Get faq post type fields
    *
    * @return array of default fields
    */
    function labtheme_get_faq_fields_array() {

        $fields = array(
            'toggle' => 
                    array( 
                        'name'          =>'Open/Close Toggle',
                        'key'           =>'toggle',
                        'class'         =>'',    
                        'id'            =>'toggle',
                        'type'          =>'checkbox',
                        'value'         => 0
                        ),
            );
        $fields = apply_filters( 'labtheme_get_faq_fields_array', $fields );
        return $fields;
    }
    $faq_fields = labtheme_get_faq_fields_array();
    foreach ($faq_fields as $key => $value) { ?>
        <div class="faq-info">
            <label for="<?php echo $key;?>"><?php _e($value['name'].':','labtheme-companion');?></label>
            <input type="<?php echo $value['type'];?>" class="<?php echo $value['class'];?>" name="<?php echo $value['value']; ?>" id="<?php echo $value['id'];?>" value="<?php echo $value['value']; ?>">
        </div>
        <?php
    }
?>
