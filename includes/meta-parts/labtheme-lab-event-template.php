<?php
global $post;
$labtheme_setting = get_post_meta( $post->ID, '_labtheme_setting', true );
    /**
    * Get event post type fields
    *
    * @return array of default fields
    */
    function labtheme_get_event_fields_array() {

        $fields = array(
            'sdate' => 
                    array( 
                        'name'          =>'Start Date',
                        'key'           =>'sdate',
                        'class'         =>'date-cpt',    
                        'id'            =>'sdate',
                        'type'          =>'text',
                        'placeholder'   => 'May 9, 2019'
                        ),
            'edate' => 
                    array( 
                        'name'          =>'End Date',
                        'key'           =>'edate',
                        'class'         =>'date-cpt',    
                        'id'            =>'edate',
                        'type'          =>'text',
                        'placeholder'   => 'May 10, 2019'
                        ),
            'cost' => 
                    array( 
                        'name'          =>'Cost',
                        'key'           =>'cost',
                        'class'         =>'',    
                        'id'            =>'staff',
                        'type'          =>'text',
                        'placeholder'   => '$ 200'
                        ),
            'organizer' => 
                    array( 
                        'name'          =>'Organizer',
                        'key'           =>'organizer',
                        'class'         =>'',    
                        'id'            =>'organizer',
                        'type'          =>'text',
                        'placeholder'   => 'XYZ Company'
                        ),
            'phone' => 
                    array( 
                        'name'          =>'Phone',
                        'key'           =>'phone',
                        'class'         =>'',    
                        'id'            =>'phone',
                        'type'          =>'text',
                        'placeholder'   => '+1 4800000000'
                        ),
            'email' => 
                    array( 
                        'name'          =>'Email',
                        'key'           =>'email',
                        'class'         =>'',    
                        'id'            =>'email',
                        'type'          =>'email',
                        'placeholder'   => 'admin@example.com'
                        ),
            'website' => 
                    array( 
                        'name'          =>'Website',
                        'key'           =>'website',
                        'class'         =>'',    
                        'id'            =>'website',
                        'type'          =>'text',
                        'placeholder'   => 'https://www.example.com'
                        ),
            'stime' => 
                    array( 
                        'name'          =>'Start Time',
                        'key'           =>'stime',
                        'class'         =>'time-cpt',    
                        'id'            =>'stime',
                        'type'          =>'text',
                        'placeholder'   => '00:30:00'
                        ),
            'etime' => 
                    array( 
                        'name'          =>'End Time',
                        'key'           =>'etime',
                        'class'         =>'time-cpt',    
                        'id'            =>'etime',
                        'type'          =>'text',
                        'placeholder'   => '00:50:00'
                        ),
            'address' => 
                    array( 
                        'name'          =>'Address',
                        'key'           =>'address',
                        'class'         =>'',    
                        'id'            =>'address',
                        'type'          =>'text',
                        'placeholder'   => 'USA'
                        ),
            'venue' => 
                    array( 
                        'name'          =>'Venue',
                        'key'           =>'venue',
                        'class'         =>'',    
                        'id'            =>'venue',
                        'type'          =>'text',
                        'placeholder'   => 'XYZ Events'
                        ),
            'map' => 
                    array( 
                        'name'          =>'Map',
                        'key'           =>'map',
                        'class'         =>'iframe',    
                        'id'            =>'map',
                        'type'          =>'text',
                        'placeholder'   => 'Enter google map iframe here'
                        ),
            );
        $fields = apply_filters( 'labtheme_get_event_fields_array', $fields );
        return $fields;
    }
    $event_fields = labtheme_get_event_fields_array();
    foreach ($event_fields as $key => $value) { ?>
        <div class="event-info">
            <label for="<?php echo $key;?>"><?php _e($value['name'].':','labtheme-companion');?></label>
            <input type="<?php echo $value['type'];?>" placeholder="<?php echo $value['placeholder'];?>" class="<?php echo $value['class'];?>" name="labtheme_setting[event][<?php echo $key;?>]" id="<?php echo $value['id'];?>" value="<?php echo isset($labtheme_setting['event'][$key]) ? esc_attr($labtheme_setting['event'][$key]): ''; ?>">
        </div>
    <?php
    }
    ?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.time-cpt').timepicker({ 'timeFormat': 'H:i:s'});
        $( "#sdate" ).datepicker({ minDate:0 });
        $( "#edate" ).datepicker({ minDate:0 });
    });
</script>