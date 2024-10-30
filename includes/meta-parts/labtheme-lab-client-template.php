<?php
    global $post;
    $labtheme_setting = get_post_meta( $post->ID, '_labtheme_setting', true );
    /**
    * Get client post type fields
    *
    * @return array of default fields
    */
    function labtheme_get_client_fields_array() {

        $fields = array(
            'subtitle' => 
                    array( 
                        'name'          =>'Subtitle',
                        'key'           =>'subtitle',
                        'class'         =>'',    
                        'id'            =>'subtitle',
                        'type'          =>'text'
                        ),
            'view-client' => 
                    array( 
                        'name'          =>'Label',
                        'key'           =>'view-client',
                        'class'         =>'',    
                        'id'            =>'view-client',
                        'type'          =>'text'
                        ),
            'clientlink' => 
                    array( 
                        'name'          =>'Link',
                        'key'           =>'clientlink',
                        'class'         =>'',    
                        'id'            =>'clientlink',
                        'type'          =>'text'
                        ),
            );
        $fields = apply_filters( 'labtheme_get_client_fields_array', $fields );
        return $fields;
    }
$client_fields = labtheme_get_client_fields_array();
foreach ($client_fields as $key => $value) { ?>
    <div class="client-info">
        <label for="<?php echo $key;?>"><?php _e($value['name'].':','labtheme-companion');?></label>
        <input type="<?php echo $value['type'];?>" class="<?php echo $value['class'];?>" name="labtheme_setting[client][<?php echo $key;?>]" id="<?php echo $value['id'];?>" value="<?php echo isset($labtheme_setting['client'][$key]) ? esc_attr($labtheme_setting['client'][$key]): ''; ?>">
    </div>
<?php
}
?>