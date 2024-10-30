<?php
/**
 * Widget Author Bio
 *
 * @package Labtheme_Companion
 */
 
// register Labtheme_Author_Bio widget
function labtheme_register_author_bio_widget() {
    register_widget( 'Labtheme_Author_Bio' );
}
add_action( 'widgets_init', 'labtheme_register_author_bio_widget' );

if( ! class_exists( 'Labtheme_Author_Bio' ) ) : 
 /**
 * Adds Labtheme_Author_Bio widget.
 */
class Labtheme_Author_Bio extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'labtheme_author_bio_widget', // Base ID
			__( 'Lab Theme: Author Bio Widget', 'labtheme-companion' ), // Name
			array( 'description' => __( 'An Author Bio Widget', 'labtheme-companion' ), ) // Args
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
        $title         = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$content       = ! empty( $instance['content'] ) ? $instance['content'] : '';
        $image         = ! empty( $instance['image'] ) ? $instance['image'] : '';
        $label         = ! empty( $instance['label'] ) ? $instance['label'] : '';
        $link          = ! empty( $instance['link'] ) ? $instance['link'] : '';
        if( $image ){
            $attachment_id = $image;
            // if ( !filter_var( $image, FILTER_VALIDATE_URL ) === false ) {
            //     $attachment_id = $obj->labtheme_companion_get_attachment_id( $image );
            // }

            $icon_img_size = apply_filters('icon_img_size','thumbnail');
            $image_array   = wp_get_attachment_image_src( $attachment_id, $icon_img_size);
            $image         = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $image_array[0]);
            $fimg_url      = $image_array[0];   
        }
                
        echo $args['before_widget'];
        ob_start();
        
        if( $title ) echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title']; 
        ?>
        <div class="labtheme-author-bio-holder">
            <?php if( $image ){ ?>
                <div class="image-holder">
                    <img src="<?php echo esc_url( $fimg_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
				</div>
			<?php } ?>                
            <div class="author-bio-wrap">
	            <?php echo wpautop( wp_kses_post( $content ) ); ?>
	            
	            <?php if( $link && $label ){ ?>
	            <a href="<?php echo esc_url( $link ); ?>" class="readmore" <?php if(isset($instance['target']) && $instance['target']=='1'){ echo "target=_blank"; } ?>><?php echo esc_html( $label );?></a>
	            <?php } ?>
	        </div>
	    </div>
        <?php    
        $html = ob_get_clean();
        echo apply_filters( 'labtheme_author_bio_widget_filter', $html, $args, $instance );
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
        $title   = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$content = ! empty( $instance['content'] ) ? $instance['content'] : '';
        $image   = ! empty( $instance['image'] ) ? $instance['image'] : '';
        $label   = ! empty( $instance['label'] ) ? $instance['label'] : '';
        $target     = ! empty( $instance['target'] ) ? $instance['target'] : '';
        $link    = ! empty( $instance['link'] ) ? $instance['link'] : '';
        
        ?>
		
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"><?php esc_html_e( 'Content', 'labtheme-companion' ); ?></label>
            <textarea name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"><?php echo wp_kses_post( $content ); ?></textarea>
        </p>
        
        <?php $obj->labtheme_companion_get_image_field( $this->get_field_id( 'image' ), $this->get_field_name( 'image' ), $image, __( 'Upload Image', 'labtheme-companion' ) ); ?>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>"><?php esc_html_e( 'Button Label', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'label' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'label' ) ); ?>" type="text" value="<?php echo esc_attr( $label ); ?>" />
		</p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"><?php esc_html_e( 'Button Link', 'labtheme-companion' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>" type="text" value="<?php echo esc_url( $link ); ?>" />
            
		</p>
		<p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="checkbox" value="1" <?php echo checked($target,1);?> /> 
            <?php esc_html_e( 'Open in New Tab', 'labtheme-companion' ); ?></label>
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
		
        $instance['title']   = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['content'] = ! empty( $new_instance['content'] ) ? wp_kses_post( $new_instance['content'] ) : '';
        $instance['image']   = ! empty( $new_instance['image'] ) ? absint( $new_instance['image'] ) : '';
        $instance['label']   = ! empty( $new_instance['label'] ) ? sanitize_text_field( $new_instance['label'] ) : '';
        $instance['link']    = ! empty( $new_instance['link'] ) ? esc_url_raw( $new_instance['link'] ) : '';
        $instance['target'] = ! empty($new_instance['target']) ? esc_attr($new_instance['target']) : '';
        
		return $instance;
        
	}

} // class Labtheme_Author_Bio
endif;