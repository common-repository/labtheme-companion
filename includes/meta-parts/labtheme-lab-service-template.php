<?php
    global $post;
    $labtheme_setting = get_post_meta( $post->ID, '_labtheme_setting', true );
    /**
    * Get service post type fields
    *
    * @return array of default fields
    */
    function labtheme_get_service_fields_array() {

        $fields = array(
            'subtitle' => 
                    array( 
                        'name'          =>'Subtitle',
                        'key'           =>'subtitle',
                        'class'         =>'',    
                        'id'            =>'subtitle',
                        'type'          =>'text'
                        ),
            'view-service' => 
                    array( 
                        'name'          =>'service Label',
                        'key'           =>'view-service',
                        'class'         =>'',    
                        'id'            =>'view-service',
                        'type'          =>'text'
                        ),
            'servicelink' => 
                    array( 
                        'name'          =>'service Link',
                        'key'           =>'servicelink',
                        'class'         =>'',    
                        'id'            =>'servicelink',
                        'type'          =>'text'
                        ),
            );
        $fields = apply_filters( 'labtheme_get_service_fields_array', $fields );
        return $fields;
    }
$service_fields = labtheme_get_service_fields_array();
foreach ($service_fields as $key => $value) { ?>
    <div class="service-info">
        <label for="<?php echo $key;?>"><?php _e($value['name'].':','labtheme-companion');?></label>
        <input type="<?php echo $value['type'];?>" class="<?php echo $value['class'];?>" name="labtheme_setting[service][<?php echo $key;?>]" id="<?php echo $value['id'];?>" value="<?php echo isset($labtheme_setting['service'][$key]) ? esc_attr($labtheme_setting['service'][$key]): ''; ?>">
    </div>
<?php
}
?>