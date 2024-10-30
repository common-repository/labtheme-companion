<?php
    global $post;
    $labtheme_setting = get_post_meta( $post->ID, '_labtheme_setting', true );
    /**
    * Get portfolio post type fields
    *
    * @return array of default fields
    */
    function labtheme_get_portfolio_fields_array() {

        $fields = array(
            'subtitle' => 
                    array( 
                        'name'          =>'Subtitle',
                        'key'           =>'subtitle',
                        'class'         =>'',    
                        'id'            =>'subtitle',
                        'type'          =>'text'
                        ),
            'view-portfolio' => 
                    array( 
                        'name'          =>'Label',
                        'key'           =>'view-portfolio',
                        'class'         =>'',    
                        'id'            =>'view-portfolio',
                        'type'          =>'text'
                        ),
            'portfoliolink' => 
                    array( 
                        'name'          =>'Link',
                        'key'           =>'portfoliolink',
                        'class'         =>'',    
                        'id'            =>'portfoliolink',
                        'type'          =>'text'
                        ),
            );
        $fields = apply_filters( 'labtheme_get_portfolio_fields_array', $fields );
        return $fields;
    }
$portfolio_fields = labtheme_get_portfolio_fields_array();
foreach ($portfolio_fields as $key => $value) { ?>
    <div class="portfolio-info">
        <label for="<?php echo $key;?>"><?php _e($value['name'].':','labtheme-companion');?></label>
        <input type="<?php echo $value['type'];?>" class="<?php echo $value['class'];?>" name="labtheme_setting[portfolio][<?php echo $key;?>]" id="<?php echo $value['id'];?>" value="<?php echo isset($labtheme_setting['portfolio'][$key]) ? esc_attr($labtheme_setting['portfolio'][$key]): ''; ?>">
    </div>
<?php
}
?>