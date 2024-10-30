<?php
	global $post;
	$labtheme_setting = get_post_meta( $post->ID, '_labtheme_setting', true );
  /**
    * Get team post type fields
    *
    * @return array of default fields
    */
    function labtheme_get_team_fields_array() {

        $fields = array(
            'position' => 
                    array( 
                        'name'          =>'Position',
                        'key'           =>'position',
                        'class'         =>'',    
                        'id'            =>'position',
                        'type'          =>'text'
                        ),
            'email' => 
                    array( 
                        'name'          =>'Email',
                        'key'           =>'email',
                        'class'         =>'',    
                        'id'            =>'email',
                        'type'          =>'email'
                        ),
            'telephone' => 
                    array( 
                        'name'          =>'Telephone',
                        'key'           =>'telephone',
                        'class'         =>'',    
                        'id'            =>'telephone',
                        'type'          =>'tel'
                        ),
            );
        $fields = apply_filters( 'labtheme_get_team_fields_array', $fields );
        return $fields;
    }
$team_fields = labtheme_get_team_fields_array();
foreach ($team_fields as $key => $value) { ?>
    <div class="team-info">
        <label for="<?php echo $key;?>"><?php _e($value['name'].':','labtheme-companion');?></label>
        <input type="<?php echo $value['type'];?>" class="<?php echo $value['class'];?>" name="labtheme_setting[team][<?php echo $key;?>]" id="<?php echo $value['id'];?>" value="<?php echo isset($labtheme_setting['team'][$key]) ? esc_attr($labtheme_setting['team'][$key]): ''; ?>">
    </div>
<?php
}
?>

<ul class="labtheme-team-sortable-icons">
	<?php
    $obj = new Labtheme_Companion_Functions;
	if(isset($labtheme_setting['team']['social']))
	{
	    $icons  = $labtheme_setting['team']['social'];
	    $arr_keys  = array_keys( $icons );
	    foreach ($arr_keys as $key => $value)
	    { 
            if ( array_key_exists( $value, $labtheme_setting['team']['social'] ) )
	        { 
	            if(isset($labtheme_setting['team']['social'][$value]) && !empty($labtheme_setting['team']['social'][$value]))
                {
                    if(!isset($labtheme_setting['team']['social_profile'][$value]) || (isset($labtheme_setting['team']['social_profile'][$value]) && $labtheme_setting['team']['social_profile'][$value] == ''))
                    {
                        $icon = $obj->labtheme_get_team_social_icon_name( $labtheme_setting['team']['social'][$value] );
                        $class = ($icon == 'rss') ? 'fas fa-'.$icon : 'fab fa-'.$icon;
                    }
                    elseif(isset($labtheme_setting['team']['social_profile'][$value]) && !empty($labtheme_setting['team']['social_profile'][$value]))
                    {
                        $icon = $labtheme_setting['team']['social_profile'][$value] ;
                        $class = ($icon == 'rss') ? 'fas fa-'.$icon : 'fab fa-'.$icon;
                    }
    	            ?>
    	            <li class="labtheme-social-icon-wrap" data-id="<?php echo $value;?>">
	                    <span class="labtheme-social-icons-field-handle"><i class="<?php echo esc_attr($class);?>"></i></span>
                        <input class="team-social-profile" name="labtheme_setting[team][social_profile][<?php echo esc_attr($value);?>]" type="text" value="<?php echo esc_attr($icon);?>" />
	                    <input class="team-social-length" name="labtheme_setting[team][social][<?php echo esc_attr($value);?>]" type="text" value="<?php echo esc_url($labtheme_setting['team']['social'][$value]);?>" />
	                    <span class="del-team-icon"><i class="fas fa-times"></i></span>
    	            </li>
	           <?php
                }
	        }
	    }
	}
	?>
    <div class="labtheme-social-icon-holder"></div>
</ul>
<input class="labtheme-team-social-add button-secondary" type="button" value="<?php _e('Add Icon','labtheme-companion');?>">
<span class="widget-note"><?php _e('Click the above button to add social icons.','labtheme-companion');?></span>

