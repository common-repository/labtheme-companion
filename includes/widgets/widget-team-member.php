<?php
/**
 * Team Member Widget
 *
 * @package Labtheme_Companion
 */

// register Labtheme_Companion_Team_Member_Widget widget
function labtheme_register_team_member_widget(){
    register_widget( 'Labtheme_Companion_Team_Member_Widget' );
}
add_action('widgets_init', 'labtheme_register_team_member_widget');
 
 /**
 * Adds Labtheme_Companion_Team_Member_Widget widget.
 */
class Labtheme_Companion_Team_Member_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'labtheme_description_widget', // Base ID
            __( 'Lab Theme: Team Member', 'labtheme-companion' ), // Name
            array( 'description' => __( 'A Team Member Widget.', 'labtheme-companion' ), ) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        
        $obj         = new Labtheme_Companion_Functions();
        $name        = ! empty( $instance['name'] ) ? $instance['name'] : '' ;        
        $designation = ! empty( $instance['designation'] ) ? $instance['designation'] : '' ;        
        $description = ! empty( $instance['description'] ) ? $instance['description'] : '';
        $linkedin    = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '';
        $twitter     = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '';
        $facebook    = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '';
        $instagram   = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '';
        $youtube     = ! empty( $instance['youtube'] ) ? $instance['youtube'] : '';
        $dribbble    = ! empty( $instance['dribbble'] ) ? $instance['dribbble'] : '';
        $behence     = ! empty( $instance['behence'] ) ? $instance['behence'] : '';
        $image       = ! empty( $instance['image'] ) ? $instance['image'] : '';

        $target = 'target="_blank"';
        if( isset($instance['target']) && $instance['target']=='1' )
        {
            $target = 'target="_self"';
        }

        echo $args['before_widget'];
        ob_start(); 
        ?>
            <div class="labtheme-team-holder">
                <div class="labtheme-team-inner-holder">
                    <?php
                    if( $image ){
                        $attachment_id = $image;
                        $icon_img_size = apply_filters('tmw_icon_img_size','full');
                    }
                    ?>
                    <?php if( $image ){ ?>
                        <div class="image-holder">
                            <?php echo wp_get_attachment_image( $attachment_id, $icon_img_size ) ;?>
                        </div>
                    <?php } ?>

                    <div class="text-holder">
                    <?php 
                        if( $name ) { echo '<span class="name">'.$name.'</span> - '; }
                        if( isset( $designation ) && $designation !='' ){
                            echo '<span class="designation">'.esc_attr($designation).'</span>';
                        }
                        if( $description ) echo '<div class="description">'.wpautop( wp_kses_post( $description ) ).'</div>';
                    ?>                              
                    </div>
                    <ul class="social-profile">
                        <?php if( isset( $linkedin ) && $linkedin!='' ) { echo '<li><a '.$target.' href="'.esc_url($linkedin).'"><i class="fab fa-linkedin-in"></i></a></li>'; }?>
                        <?php if( isset( $twitter ) && $twitter!='' ) { echo '<li><a '.$target.' href="'.esc_url($twitter).'"><i class="fab fa-twitter"></i></a></li>'; }?>
                        <?php if( isset( $facebook ) && $facebook!='' ) { echo '<li><a '.$target.' href="'.esc_url($facebook).'"><i class="fab fa-facebook-f"></i></a></li>'; }?>
                        <?php if( isset( $instagram ) && $instagram!='' ) { echo '<li><a '.$target.' href="'.esc_url($instagram).'"><i class="fab fa-instagram"></i></a></li>'; }?>
                        <?php if( isset( $youtube ) && $youtube!='' ) { echo '<li><a '.$target.' href="'.esc_url($youtube).'"><i class="fab fa-youtube"></i></a></li>'; }?>
                        <?php if( isset( $dribbble ) && $dribbble!='' ) { echo '<li><a '.$target.' href="'.esc_url($dribbble).'"><i class="fab fa-dribbble"></i></a></li>'; }?>
                        <?php if( isset( $behence ) && $behence!='' ) { echo '<li><a '.$target.' href="'.esc_url($behence).'"><i class="fab fa-behance"></i></a></li>'; }?>
                    </ul>
                </div>
            </div>

            <div class="labtheme-team-holder-modal">
                <div class="labtheme-team-inner-holder-modal">
                    <?php
                    $obj         = new Labtheme_Companion_Functions();
                    $name        = ! empty( $instance['name'] ) ? $instance['name'] : '' ;        
                    $designation = ! empty( $instance['designation'] ) ? $instance['designation'] : '' ;        
                    $description = ! empty( $instance['description'] ) ? $instance['description'] : '';
                    $linkedin    = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '';
                    $twitter     = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '';
                    $facebook    = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '';
                    $instagram   = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '';
                    $youtube     = ! empty( $instance['youtube'] ) ? $instance['youtube'] : '';
                    $dribbble    = ! empty( $instance['dribbble'] ) ? $instance['dribbble'] : '';
                    $behence     = ! empty( $instance['behence'] ) ? $instance['behence'] : '';
                    $image       = ! empty( $instance['image'] ) ? $instance['image'] : '';

                    if( $image ){
                        /** Added to work for demo content compatible */
                        $theme_slug = apply_filters('theme_slug','labtheme-companion');
                        $cta_img_size = apply_filters('rlabtheme_cl_img_size','full');
                    }
                    ?>
                    <?php if( $image ){ ?>
                        <div class="image-holder">
                            <?php echo wp_get_attachment_image( $image, $cta_img_size ) ;?>
                        </div>
                    <?php } ?>

                    <div class="text-holder">
                    <?php 
                        if( $name ) { echo '<span class="name">'.$name.'</span>'; }
                        if( isset( $designation ) && $designation!='' ){
                            echo '<span class="designation">'.esc_attr($designation).'</span>';
                        }
                        if( $description ) echo '<div class="description">'.wpautop( wp_kses_post( $description ) ).'</div>';
                    ?>                              
                    </div>
                    <ul class="social-profile">
                        <?php if( isset( $linkedin ) && $linkedin!='' ) { echo '<li><a '.$target.' href="'.esc_url($linkedin).'"><i class="fa fa-linkedin"></i></a></li>'; }?>
                        <?php if( isset( $twitter ) && $twitter!='' ) { echo '<li><a '.$target.' href="'.esc_url($twitter).'"><i class="fa fa-twitter"></i></a></li>'; }?>
                        <?php if( isset( $facebook ) && $facebook!='' ) { echo '<li><a '.$target.' href="'.esc_url($facebook).'"><i class="fa fa-facebook"></i></a></li>'; }?>
                        <?php if( isset( $instagram ) && $instagram!='' ) { echo '<li><a '.$target.' href="'.esc_url($instagram).'"><i class="fa fa-instagram"></i></a></li>'; }?>
                        <?php if( isset( $youtube ) && $youtube!='' ) { echo '<li><a '.$target.' href="'.esc_url($youtube).'"><i class="fa fa-youtube"></i></a></li>'; }?>
                        <?php if( isset( $dribbble ) && $dribbble!='' ) { echo '<li><a '.$target.' href="'.esc_url($dribbble).'"><i class="fa fa-dribbble"></i></a></li>'; }?>
                        <?php if( isset( $behence ) && $behence!='' ) { echo '<li><a '.$target.' href="'.esc_url($behence).'"><i class="fa fa-behance"></i></a></li>'; }?>
                    </ul>
                </div>
                <a href="#" class="close_popup"><?php _e('closepopup','labtheme-companion');?></a>
            </div>
        <?php
        echo 
        "
        <style>
            .labtheme-team-holder-modal{
                display: none;
            }
        </style>
        <script>
            jQuery(document).ready(function($) {
              $('.labtheme-team-holder').click(function(){
                $(this).siblings('.labtheme-team-holder-modal').addClass('show');
                $(this).siblings('.labtheme-team-holder-modal').css('display', 'block');
              });

              $('.close_popup').click(function(){
                $(this).parent('.labtheme-team-holder-modal').removeClass('show');
                $(this).parent().css('display', 'none');
                return false;
              }); 
            });
        </script>";
        $html = ob_get_clean();
        echo apply_filters( 'labtheme_companion_team_member_widget_filter', $html, $args, $instance );    
        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        
        $obj         = new Labtheme_Companion_Functions();
        $name        = ! empty( $instance['name'] ) ? $instance['name'] : '' ;        
        $description = ! empty( $instance['description'] ) ? $instance['description'] : '';
        $target      = ! empty( $instance['target'] ) ? $instance['target'] : '';
        $linkedin    = ! empty( $instance['linkedin'] ) ? $instance['linkedin'] : '';
        $twitter     = ! empty( $instance['twitter'] ) ? $instance['twitter'] : '';
        $facebook    = ! empty( $instance['facebook'] ) ? $instance['facebook'] : '';
        $instagram   = ! empty( $instance['instagram'] ) ? $instance['instagram'] : '';
        $youtube     = ! empty( $instance['youtube'] ) ? $instance['youtube'] : '';
        $dribbble    = ! empty( $instance['dribbble'] ) ? $instance['dribbble'] : '';
        $behence     = ! empty( $instance['behence'] ) ? $instance['behence'] : '';
        $designation = ! empty( $instance['designation'] ) ? $instance['designation'] : '';
        $image       = ! empty( $instance['image'] ) ? $instance['image'] : '';
        ?>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php esc_html_e( 'Name', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />            
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'designation' ) ); ?>"><?php esc_html_e( 'Designation', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'designation' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'designation' ) ); ?>" type="text" value="<?php echo esc_attr( $designation ); ?>" />            
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Description', 'labtheme-companion' ); ?></label>
            <textarea name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" rows="5" cols="50"><?php print $description; ?></textarea>
        </p>
        
        <?php $obj->labtheme_companion_get_image_field( $this->get_field_id( 'image' ), $this->get_field_name( 'image' ), $image, __( 'Upload Photo', 'labtheme-companion' ) ); ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open in Same Tab', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="checkbox" value="1" <?php echo checked($target,1);?> /> 
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>"><?php esc_html_e( 'LinkedIn Profile', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'linkedin' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'linkedin' ) ); ?>" type="text" value="<?php echo esc_url( $linkedin ); ?>" />            
        </p>
        
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>"><?php esc_html_e( 'Twitter Profile', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'twitter' ) ); ?>" type="text" value="<?php echo esc_url( $twitter ); ?>" />            
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>"><?php esc_html_e( 'Facebook Profile', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'facebook' ) ); ?>" type="text" value="<?php echo esc_url( $facebook ); ?>" />            
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>"><?php esc_html_e( 'Instagram Profile', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'instagram' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'instagram' ) ); ?>" type="text" value="<?php echo esc_url( $instagram ); ?>" />            
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>"><?php esc_html_e( 'YouTube Profile', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'youtube' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'youtube' ) ); ?>" type="text" value="<?php echo esc_url( $youtube ); ?>" />            
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>"><?php esc_html_e( 'Dribbble Profile', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'dribbble' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'dribbble' ) ); ?>" type="text" value="<?php echo esc_url( $dribbble ); ?>" />            
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'behence' ) ); ?>"><?php esc_html_e( 'Behance Profile', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'behence' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'behence' ) ); ?>" type="text" value="<?php echo esc_url( $behence ); ?>" />            
        </p>


        <?php
    }
    
    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
        $instance                = array();        
        $instance['name']        = ! empty( $new_instance['name'] ) ? sanitize_text_field( $new_instance['name'] ) : '' ;
        $instance['description'] = ! empty( $new_instance['description'] ) ? wp_kses_post( $new_instance['description'] ) : '';
        $instance['designation'] = ! empty( $new_instance['designation'] ) ? esc_attr( $new_instance['designation'] ) : '';
        $instance['target']      = ! empty( $new_instance['target'] ) ? esc_attr( $new_instance['target'] ) : '';
        $instance['linkedin']    = ! empty( $new_instance['linkedin'] ) ? $new_instance['linkedin'] : '';
        $instance['twitter']     = ! empty( $new_instance['twitter'] ) ? $new_instance['twitter'] : '';
        $instance['facebook']    = ! empty( $new_instance['facebook'] ) ? $new_instance['facebook'] : '';
        $instance['instagram']   = ! empty( $new_instance['instagram'] ) ? $new_instance['instagram'] : '';
        $instance['youtube']     = ! empty( $new_instance['youtube'] ) ? $new_instance['youtube'] : '';
        $instance['dribbble']    = ! empty( $new_instance['dribbble'] ) ? $new_instance['dribbble'] : '';
        $instance['behence']     = ! empty( $new_instance['behence'] ) ? $new_instance['behence'] : '';
        $instance['image']       = ! empty( $new_instance['image'] ) ? esc_attr( $new_instance['image'] ) : '';

        return $instance;
    }
    
}  // class Labtheme_Companion_Team_Member_Widget 