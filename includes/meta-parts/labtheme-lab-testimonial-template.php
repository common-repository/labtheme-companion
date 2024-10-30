<?php
global $post;
$labtheme_setting = get_post_meta( $post->ID, '_labtheme_setting', true );
  /**
    * Get testimonial post type fields
    *
    * @return array of default fields
    */
    function labtheme_get_testimonial_fields_array() {

        $fields = array(
            'position' => 
                    array( 
                        'name'          =>'Position',
                        'key'           =>'position',
                        'class'         =>'',    
                        'id'            =>'position',
                        'type'          =>'text',
                        'placeholder'   => 'Manager'
                        ),
            'company' => 
                    array( 
                        'name'          =>'Company',
                        'key'           =>'company',
                        'class'         =>'',    
                        'id'            =>'company',
                        'type'          =>'text',
                        'placeholder'   => 'abc co ltd'
                        ),
            'rating' => 
                    array( 
                        'name'          =>'Rating(%)',
                        'key'           =>'rating',
                        'class'         =>'testimonial-rating',    
                        'id'            =>'rating',
                        'type'          =>'text',
                        'placeholder'   => 'Rating on % (0 to 100)'
                        ),
            );
        $fields = apply_filters( 'labtheme_get_testimonial_fields_array', $fields );
        return $fields;
    }

    $testimonial_fields = labtheme_get_testimonial_fields_array();
	foreach ($testimonial_fields as $key => $value) { ?>
    <div class="testimonial-info">
        <label for="<?php echo $key;?>"><?php _e($value['name'].':','labtheme-companion');?></label>
        <input type="<?php echo $value['type'];?>" placeholder="<?php echo $value['placeholder'];?>" class="<?php echo $value['class'];?>" name="labtheme_setting[testimonial][<?php echo $key;?>]" id="<?php echo $value['id'];?>" value="<?php echo isset($labtheme_setting['testimonial'][$key]) ? esc_attr($labtheme_setting['testimonial'][$key]): ''; ?>">
    </div>
<?php
}