<?php
/**
 * Advertisement widget
 *
 * @package Labtheme_Companion
 */

// register Labtheme_AD_Widget widget
function labtheme_register_ad_widget(){
    register_widget( 'Labtheme_AD_Widget' );
}
add_action('widgets_init', 'labtheme_register_ad_widget');

if( ! class_exists( 'Labtheme_AD_Widget' ) ) : 
    /**
    * Adds Labtheme_AD_Widget widget.
    */
    class Labtheme_AD_Widget extends WP_Widget {

        /**
        * Register widget with WordPress.
        */
        public function __construct() {
            parent::__construct(
    			'labtheme_advertisement_widget', // Base ID
    			__( 'Lab Theme: AD Widget', 'labtheme-companion' ), // Name
    			array( 'description' => __( 'A widget for Advertisement.', 'labtheme-companion' ), ) // Args
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
            $obj = new Labtheme_Companion_Functions();
            $html 	        = '';
            $title          = ! empty( $instance['title'] ) ? $instance['title'] : '' ;		
            $adcode         = ! empty( $instance['adcode'] ) ? $instance['adcode'] : '';
            $image          = ! empty( $instance['image'] ) ? esc_attr( $instance['image'] ) : '';
            $url            = ! empty( $instance['url'] ) ? esc_url_raw( $instance['url'] ) : '';
            $attachment_id = $image;

            if( $image ){
                $attachment_id = $image;
                // if ( !filter_var( $image, FILTER_VALIDATE_URL ) === false ) {
                //     $attachment_id = $obj->labtheme_companion_get_attachment_id( $image );
                // }

                $icon_img_size = apply_filters('icon_img_size','full');
                $image_array   = wp_get_attachment_image_src( $attachment_id, $icon_img_size);
                $image         = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $image_array[0]);
                $fimg_url      = $image_array[0];   
            }

            echo $args['before_widget'];
            ob_start(); 
            if( $title ) echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title'];

            $target = 'target="_blank"';
            if( isset($instance['target']) && $instance['target']!='' )
            {
                $target = 'target="_self"';
            }
        
            if ( $adcode != '' ) {
                $html .= $adcode;
            } elseif ( $image != '' ){
                $html .= '<div class="ads360-wrap">';
                
                if ( $url != '' ) $html .= '<a href="' . esc_url( $url ) . '" '.$target.'>';
                
                $html .= '<img src="' . esc_url( $fimg_url ) . '" alt="' . esc_attr( $title ) . '" />';
                
                if ( $url != '' ) $html .= '</a>';
                    
                $html .= '</div>';
            }

            print $html;
            $html = ob_get_clean();
            echo apply_filters( 'labtheme_ad_widget_filter', $html, $args, $instance );
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
            
            $obj = new Labtheme_Companion_Functions();
            $title  = ! empty( $instance['title'] ) ? $instance['title'] : '';		
            $adcode = ! empty( $instance['adcode'] ) ? $instance['adcode'] : '';
            $image  = ! empty( $instance['image'] ) ? absint( $instance['image'] ) : '';
            $target = ! empty( $instance['target'] ) ? $instance['target'] : '';
            $url    = ! empty( $instance['url'] ) ? esc_url_raw( $instance['url'] ) : '';
            /* Make the ad code read-only if the user can't work with unfiltered HTML. */
            $read_only = '';
            if ( !current_user_can( 'unfiltered_html' ) ) {
                $read_only = ' readonly="readonly"';
            }
            
            ?>
		
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'labtheme-companion' ); ?></label> 
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />            
    		</p>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'adcode' ) ); ?>"><?php esc_html_e( 'Ad Code', 'labtheme-companion' ); ?></label>
                <textarea name="<?php echo esc_attr( $this->get_field_name( 'adcode' ) ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'adcode' ) ); ?>"<?php echo esc_attr( $read_only ); ?>><?php print $adcode; ?></textarea>
            </p>
            
            <p><strong><?php esc_html_e( 'or', 'labtheme-companion' ); ?></strong></p>
            
            <?php $obj->labtheme_companion_get_image_field( $this->get_field_id( 'image' ), $this->get_field_name( 'image' ), $image, __( 'Upload Image', 'labtheme-companion' ) ); ?>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>">
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="checkbox" value="1" <?php echo checked($target,1);?> /><?php esc_html_e( 'Open in Same Tab', 'labtheme-companion' ); ?> </label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"><?php esc_html_e( 'Link URL', 'labtheme-companion' ); ?></label> 
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="text" value="<?php echo esc_url( $url ); ?>" />
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
    		$instance = array();
    		
            $instance['title']  = ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '';
            $instance['adcode'] = ! empty( $new_instance['adcode'] ) ? $new_instance['adcode'] : '';
            $instance['image']  = ! empty( $new_instance['image'] ) ? absint( $new_instance['image'] ) : '';
            $instance['url']    = ! empty( $new_instance['url']) ? esc_url_raw( $new_instance['url'] ) : '';
            $instance['target'] = ! empty($new_instance['target']) ? esc_attr($new_instance['target']) : '';
            
            if ( !current_user_can( 'unfiltered_html' ) )
            $instance['adcode'] = $old_instance['adcode'];
                
    		return $instance;
    	}

    }  // class Labtheme_AD_Widget 
endif;