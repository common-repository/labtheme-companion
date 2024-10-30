<?php
/**
 * Client Logo Widget
 *
 * @package Labtheme_Companion
 */

// register Labtheme_Client_Logo_Widget widget
function labtheme_register_client_logo_widget(){
    register_widget( 'Labtheme_Client_Logo_Widget' );
}
add_action('widgets_init', 'labtheme_register_client_logo_widget');
 
 /**
 * Adds Labtheme_Client_Logo_Widget widget.
 */
class Labtheme_Client_Logo_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
			'labtheme_client_logo_widget', // Base ID
			__( 'Lab Theme: Client Logo Widget', 'labtheme-companion' ), // Name
			array( 'description' => __( 'A Client Logo Widget.', 'labtheme-companion' ), ) // Args
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
        
        $obj   = new Labtheme_Companion_Functions();
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '' ;
        $image = ! empty( $instance['image'] ) ? $instance['image'] : '';
        $link  = ! empty( $instance['link'] ) ? $instance['link'] : '';

        $display_bw = '';
        if ( isset( $instance['display_bw'] ) && $instance['display_bw']!= '' )
        {
            $display_bw = 'black-white';
        }
        echo $args['before_widget'];
        ob_start(); 
        ?>
            <div class="labtheme-client-logo-holder">
                <div class="labtheme-client-logo-inner-holder">
                    <?php
                    if( $title ) { echo $args['before_title']; echo apply_filters( 'widget_title', $title, $instance, $this->id_base ); echo $args['after_title']; }
                    if( isset( $instance['image'] ) && $instance['image']!='' )
                    {
                        foreach ($instance['image'] as $key => $value) {
                            if( isset( $instance['image'][$key] ) && $instance['image'][$key]!='' ){
                                    $attachment_id = $instance['image'][$key];
                                    $cta_img_size = apply_filters('labtheme_cl_img_size','full');

                                    $target = 'target="_self"';
                                    if( isset($instance['target']) && $instance['target']!='' )
                                    {
                                        $target = 'target="_blank"';
                                    }
                                ?>
                                <div class="image-holder <?php echo esc_attr( $display_bw ); ?>">
                                    <?php
                                    if( isset($instance['link'][$key]) && $instance['link'][$key]!='' )
                                    { ?>
                                        <a href="<?php echo esc_url($instance['link'][$key]);?>" <?php echo $target;?>>
                                    <?php
                                    }
                                    echo wp_get_attachment_image( $attachment_id, $cta_img_size, false, 
                                        array( 'alt' => esc_html( $title )));
                                    if( isset($instance['link'][$key]) && $instance['link'][$key]!='' )
                                    {
                                    echo '</a>';                                
                                    }
                                    ?> 
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>					
                </div>
			</div>
        <?php
        $html = ob_get_clean();
        echo apply_filters( 'labtheme_companion_client_logo', $html, $args, $title, $image, $link );   
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
        $obj        = new Labtheme_Companion_Functions();
        $title      = ! empty( $instance['title'] ) ? $instance['title'] : '' ;
        $display_bw = ! empty( $instance['display_bw'] ) ? $instance['display_bw'] : '' ;
        $image      = ! empty( $instance['image'] ) ? $instance['image'] : '';
        $target     = ! empty( $instance['target'] ) ? $instance['target'] : '';
        $link       = ! empty( $instance['link'] ) ? $instance['link'] : '';
        
        ?>
		
        <script type='text/javascript'>
            jQuery(document).ready(function($) {
                $('.widget-client-logo-repeater').sortable({
                    cursor: 'move',
                    update: function (event, ui) {
                        $('.widget-client-logo-repeater .link-image-repeat input').trigger('change');
                    }
                });
                $('.check-btn-wrap').on('click', function( event ){
                    $(this).trigger('change');
                });
            });
        </script>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />            
		</p>
        
        <p>
            <label class="check-btn-wrap" for="<?php echo esc_attr( $this->get_field_id( 'display_bw' ) ); ?>"><?php esc_html_e( 'Display logo in black and white', 'labtheme-companion' ); ?><input id="<?php echo esc_attr( $this->get_field_id( 'display_bw' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_bw' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $display_bw ); ?>/></label>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open in New Tab', 'labtheme-companion' ); ?>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="checkbox" value="1" <?php echo checked($target,1);?> /> </label>
        </p>

        <div class="widget-client-logo-repeater" id="<?php echo esc_attr( $this->get_field_id( 'labthemecompanion-logo-repeater' ) ); ?>">
            <p>
            <?php
            if(isset($instance['image']))
            {
                if( count( array_filter( $instance['image'] ) ) != 0 )
                { 
                    foreach ( $instance['image'] as $key => $value) 
                    {   ?>
                        <div class="link-image-repeat" data-id="<?php echo $key;?>"><span class="cross"><i class="fas fa-times"></i></span>
                            <?php
                            $obj->labtheme_companion_get_image_field( $this->get_field_id( 'image['.$key.']' ), $this->get_field_name( 'image['.$key.']' ),  $instance['image'][$key], __( 'Upload Image', 'labtheme-companion' ) ); ?>
                            <label for="<?php echo esc_attr( $this->get_field_id( 'link['.$key.']' ) ); ?>"><?php esc_html_e( 'Featured Link', 'labtheme-companion' ); ?></label> 
                            <input class="widefat demo" id="<?php echo esc_attr( $this->get_field_id( 'link['.$key.']' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link['.$key.']' ) ); ?>" type="text" value="<?php echo isset($instance['link'][$key]) && !empty($instance['link'][$key]) ? esc_url( $instance['link'][$key] ) : ''; ?>" />            
                        </div>
                <?php
                    }
                }
            }
            ?>
            </p>
        <span class="labtheme-repeater-holder"></span>
        </div>
        <button id="add-logo" class="button"><?php _e('Add Another Logo','labtheme-companion');?></button>
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

        $instance               = array();
        $instance['title']      = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '' ;
        $instance['display_bw'] = ! empty( $new_instance['display_bw'] ) ? sanitize_text_field( $new_instance['display_bw'] ) : '' ;
        $instance['target']     = ! empty( $new_instance['target'] ) ? esc_attr( $new_instance['target'] ) : '';
        
        if(isset($new_instance['image']))
        {
            if( count( array_filter( $new_instance['image'] ) ) != 0 )
            { 
                foreach ( $new_instance['image'] as $key => $value ) {
                    $instance['image'][$key]   = $value;
                }
            }
        }

        if(isset($new_instance['link']))
        {
            if( count( array_filter( $new_instance['link'] ) ) != 0 )
            { 
                foreach ( $new_instance['link'] as $key => $value ) {
                    $instance['link'][$key]    = $value;
                }
            }
        }
        
        return $instance;
	}
    
}  // class Labtheme_Client_Logo_Widget