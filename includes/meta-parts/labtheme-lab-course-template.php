<?php
    global $post;
    $labtheme_setting = get_post_meta( $post->ID, '_labtheme_setting', true );
    /**
    * Get course post type fields
    *
    * @return array of default fields
    */
    function labtheme_get_course_fields_array() {

        $fields = array(
            'sdate' => 
                    array( 
                        'name'          =>'Start Date',
                        'key'           =>'sdate',
                        'class'         =>'date-cpt',    
                        'id'            =>'sdate',
                        'type'          =>'text'
                        ),
            'edate' => 
                    array( 
                        'name'          =>'End Date',
                        'key'           =>'edate',
                        'class'         =>'date-cpt',    
                        'id'            =>'edate',
                        'type'          =>'text'
                        ),
            'staff' => 
                    array( 
                        'name'          =>'Class Staff',
                        'key'           =>'staff',
                        'class'         =>'',    
                        'id'            =>'staff',
                        'type'          =>'text'
                        ),
            'size' => 
                    array( 
                        'name'          =>'Class Size',
                        'key'           =>'size',
                        'class'         =>'',    
                        'id'            =>'size',
                        'type'          =>'text'
                        ),
            'transportation' => 
                    array( 
                        'name'          =>'Transport',
                        'key'           =>'transportation',
                        'class'         =>'',    
                        'id'            =>'transportation',
                        'type'          =>'text'
                        ),
            'old' => 
                    array( 
                        'name'          =>'Years Old',
                        'key'           =>'old',
                        'class'         =>'',    
                        'id'            =>'old',
                        'type'          =>'text'
                        ),
            'duration' => 
                    array( 
                        'name'          =>'Duration',
                        'key'           =>'duration',
                        'class'         =>'',    
                        'id'            =>'duration',
                        'type'          =>'text'
                        ),
            'join' => 
                    array( 
                        'name'          =>'Join Now',
                        'key'           =>'join',
                        'class'         =>'',    
                        'id'            =>'join',
                        'type'          =>'text'
                        ),
            'joinlink' => 
                    array( 
                        'name'          =>'Join Link',
                        'key'           =>'joinlink',
                        'class'         =>'',    
                        'id'            =>'joinlink',
                        'type'          =>'text'
                        ),
            );
        $fields = apply_filters( 'labtheme_get_course_fields_array', $fields );
        return $fields;
    }
$course_fields = labtheme_get_course_fields_array();
foreach ($course_fields as $key => $value) { ?>
    <div class="course-info">
        <label for="<?php echo $key;?>"><?php _e($value['name'].':','labtheme-companion');?></label>
        <input type="<?php echo $value['type'];?>" class="<?php echo $value['class'];?>" name="labtheme_setting[course][<?php echo $key;?>]" id="<?php echo $value['id'];?>" value="<?php echo isset($labtheme_setting['course'][$key]) ? esc_attr($labtheme_setting['course'][$key]): ''; ?>">
    </div>
<?php
}
?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $( "#sdate" ).datepicker({ minDate:0 });
        $( "#edate" ).datepicker({ minDate:0 });
    });
</script>