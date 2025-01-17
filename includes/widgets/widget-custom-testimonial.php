<?php
/**
 * Testimonial Widget
 *
 * @package Lab_Theme_Companion
 */

// register Labtheme_Companion_Testimonial_Widget widget
function labtheme_companion_register_testimonial_widget(){
    register_widget( 'Labtheme_Companion_Testimonial_Widget' );
}
add_action('widgets_init', 'labtheme_companion_register_testimonial_widget');
 
 /**
 * Adds Labtheme_Companion_Testimonial_Widget widget.
 */
class Labtheme_Companion_Testimonial_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'labtheme_companion_testimonial_widget', // Base ID
            __( 'Lab Theme: Custom Testimonial Widget', 'labtheme-companion' ), // Name
            array( 'description' => __( 'A custom Testimonial Widget.', 'labtheme-companion' ), ) // Args
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
        $testimonial = ! empty( $instance['testimonial'] ) ? $instance['testimonial'] : '';
        $image       = ! empty( $instance['image'] ) ? $instance['image'] : '';

        if( $image )
        {
             $attachment_id = $image;
             $icon_img_size = apply_filters('icon_img_size','labtheme-thumb');
        }
        
        echo $args['before_widget'];
        ob_start(); 
        ?>
        
            <div class="labtheme-testimonial-holder">
                <div class="labtheme-testimonial-inner-holder">
                    <?php if( $image ){ ?>
                        <div class="img-holder">
                            <?php echo wp_get_attachment_image( $attachment_id, $icon_img_size, false, 
                                        array( 'alt' => esc_attr( $name ))) ;?>
                        </div>
                    <?php }?>
        
                    <div class="text-holder">
                        <div class="testimonial-meta">
                           <?php 
                                if( $name ) { echo '<span class="name">'.$name.'</span>'; }
                                if( isset( $designation ) && $designation!='' ){
                                    echo ' - <span class="designation">'.esc_attr($designation).'</span>';
                                }
                            ?>
                        </div>                              
                        <?php if( $testimonial ) echo '<div class="testimonial-content">'.wpautop( wp_kses_post( $testimonial ) ).'</div>'; ?>
                    </div>
                </div>
            </div>
        <?php 
        $html = ob_get_clean();
        echo apply_filters( 'labtheme_companion_testimonial_widget_filter', $html, $args, $instance );   
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
        $testimonial = ! empty( $instance['testimonial'] ) ? $instance['testimonial'] : '';
        $image       = ! empty( $instance['image'] ) ? $instance['image'] : '';
        $designation = ! empty( $instance['designation'] ) ? $instance['designation'] : '';
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
            <label for="<?php echo esc_attr( $this->get_field_id( 'testimonial' ) ); ?>"><?php esc_html_e( 'Testimonial', 'labtheme-companion' ); ?></label>
            <textarea name="<?php echo esc_attr( $this->get_field_name( 'testimonial' ) ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'testimonial' ) ); ?>"><?php print $testimonial; ?></textarea>
        </p>
        
        
        <?php $obj->labtheme_companion_get_image_field( $this->get_field_id( 'image' ), $this->get_field_name( 'image' ), $image, __( 'Upload Image', 'labtheme-companion' ) ); ?>
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
        $instance['testimonial'] = ! empty( $new_instance['testimonial'] ) ? wp_kses_post( $new_instance['testimonial'] ) : '';
        $instance['image']       = ! empty( $new_instance['image'] ) ? esc_attr( $new_instance['image'] ) : '';
        $instance['designation'] = ! empty( $new_instance['designation'] ) ? esc_attr( $new_instance['designation'] ) : '';
        
        return $instance;
    }
    
}  