<?php
/**
 * Widget Instagram
 *
 * @package Labtheme_Companion
 */

// register Labtheme_Instagram_Widget widget
function labtheme_register_instagram_widget() {
    register_widget( 'Labtheme_Instagram_Widget' );
}
add_action( 'widgets_init', 'labtheme_register_instagram_widget' );
 
/**
 * Adds Labtheme_Instagram_Widget widget.
 */
class Labtheme_Instagram_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'labtheme_instagram_widget', // Base ID
			__( 'Lab Theme: Instagram', 'labtheme-companion' ), // Name
			array( 'description' => __( 'A Instagram Widget that displays your latest Instagram photos.', 'labtheme-companion' ), ) // Args
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
    function widget( $args, $instance ) {

        if ( is_active_widget( false, false, $this->id_base, true ) ) {

          wp_enqueue_script( 'magnific-popup', LABTC_FILE_URL . '/public/js/jquery.magnific-popup.min.js', array( 'jquery' ), '1.0.0', false );
          wp_enqueue_style( 'magnific-popup', LABTC_FILE_URL . '/public/css/magnific-popup.min.css', array(), '1.0.0', 'all' );
        }

        $title              = empty( $instance['title'] ) ? '' : $instance['title'];
        $limit              = empty( $instance['number'] ) ? 6 : $instance['number'];
        $size               = empty( $instance['size'] ) ? 'img_standard' : $instance['size'];
        $per_row            = empty( $instance['per_row'] ) ? 5 : $instance['per_row'];
        $username           = ! empty( $instance['username'] ) ? $instance['username'] : '';
        $profile_link       = 'https://www.instagram.com/'.$username ;
        $profile_link_text  = empty( $instance['profile_link_text'] ) ? 'Follow Me!' : $instance['profile_link_text'];
        $meta               = isset( $instance['meta'] ) ? 'true' : 'false';

        echo $args['before_widget'];
        ob_start();

        if ( $title ) echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title'];
        if ( isset($username) && $username != '' ) 
        {   
            $ran = rand(1,100); $ran++;
            require_once LABTC_BASE_PATH . '/includes/vendor/InstagramSpider.php';
            ob_start();
            $obj =  new InstagramSpider;
            $photos_row = isset( $per_row ) ? esc_attr( $per_row ) :'5';
            $instaItems = $obj->getUserItems($username);
            if($instaItems=='')
            {
                _e('Please put a valid public username.','labtheme-companion');
                return;
            }
            add_filter('widget_text','do_shortcode');
            
            echo '<ul class="popup-gallery-'.$ran.' photos-'.$photos_row.'">';
            $i=0;
            foreach ($instaItems as $key) {
                if( $i<$limit )
                {
                    echo '<li><a href="'.esc_url($key['img_standard']).'"><img src="'.esc_url($key[$size]).'"></a>';
                    if( isset( $meta ) && $meta == 'true' )
                    {
                        echo '<div class="instagram-meta"><span class="like"><i class="fa fa-heart"></i>'.$key['likes'].'</span>'.'<span class="comment"><i class="fa fa-comment"></i>'.$key['comments'].'</span>'.'</div>';    
                    }
                    echo '</li>';
                }
                $i++;
            }
            echo '</ul>';
            echo 
            '<script>
            jQuery(document).ready(function($){
                $(".popup-gallery-'.$ran.'").magnificPopup({
                        delegate: "a",
                      type: "image",
                      gallery:{
                        enabled:true
                      }
                    });

                $(".popup-modal").magnificPopup({
                    type: "inline",
                    preloader: false,
                    focus: "#username",
                    modal: true
                });
                $(document).on("click", ".popup-modal-dismiss", function (e) {
                    e.preventDefault();
                    $.magnificPopup.close();
                });
            });
            </script>';
            echo '<a class="profile-link" href="'.esc_url($profile_link).'" target="_blank">'.esc_attr($profile_link_text).'</a>';
            $output = ob_get_clean();
            echo $output;
        }
        $html = ob_get_clean();
        echo apply_filters( 'labtheme_instagram_widget_filter', $html, $args, $instance );
        echo $args['after_widget'];
    }
    
    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    function form( $instance ) {
        $default = array( 
            'title'         => __( 'Instagram', 'labtheme-companion' ), 
            'number'        => 6, 
            'size'          => 'img_standard',
            'per_row'       => 5 
        );
        $instance = wp_parse_args( (array) $instance, $default );
        $username           = ! empty( $instance['username'] ) ? $instance['username'] : '';
        $title              = empty( $instance['title'] ) ? '' : $instance['title'];
        $limit              = empty( $instance['number'] ) ? 6 : $instance['number'];
        $size               = empty( $instance['size'] ) ? 'img_standard' : $instance['size'];
        $per_row            = empty( $instance['per_row'] ) ? 5 : $instance['per_row'];
        $profile_link       = 'https://www.instagram.com/'.$username;
        $profile_link_text  = empty( $instance['profile_link_text'] ) ? 'Follow Me!' : $instance['profile_link_text'];
        $meta               = !isset( $instance['meta'] ) ? '' : $instance['meta'];
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'labtheme-companion' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>"><?php esc_html_e( 'Username', 'labtheme-companion' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'username' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'username' ) ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of photos', 'labtheme-companion' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" min="1" step="1" max="20" value="<?php echo esc_attr( $limit ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Photo size', 'labtheme-companion' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" class="widefat">
                <option value="img_thumb" <?php selected( 'img_thumb', $size ) ?>><?php esc_html_e( 'Thumbnail', 'labtheme-companion' ); ?></option>
                <option value="img_low" <?php selected( 'img_low', $size ) ?>><?php esc_html_e( 'Small', 'labtheme-companion' ); ?></option>
                <option value="img_standard" <?php selected( 'img_standard', $size ) ?>><?php esc_html_e( 'Large', 'labtheme-companion' ); ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'per_row' ) ); ?>"><?php esc_html_e( 'Photos Per Row', 'labtheme-companion' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'per_row' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'per_row' ) ); ?>" type="number" min="1" max="5" step="1" value="<?php echo esc_attr( $per_row ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'meta' ) ); ?>">
            <input type="checkbox" value="1" id="<?php echo esc_attr( $this->get_field_id( 'meta' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'meta' ) ); ?>" <?php if ( isset( $meta ) ) { checked( $meta, true );} ?>>
            <?php esc_html_e( 'Display Comments/Likes', 'labtheme-companion' ); ?></label>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'profile_link_text' ) ); ?>"><?php esc_html_e( 'Profile Link Text', 'labtheme-companion' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'profile_link_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'profile_link_text' ) ); ?>" type="text" value="<?php echo esc_attr( $profile_link_text ); ?>" />
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
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        
        $instance['title']        = strip_tags( $new_instance['title'] );
        $instance['number']       = ! absint( $new_instance['number'] ) ? 6 : $new_instance['number'];
        $instance['size']         = $new_instance['size'];
        $instance['per_row']      = ! absint( $new_instance['per_row'] ) ? 5 : $new_instance['per_row'];
        $instance['meta']         = $new_instance['meta'];
        $instance['profile_link'] = 'https://www.instagram.com/'.$username;
        $instance['username']     = $new_instance['username'] ;

        return $instance;
    }
}// class Labtheme_Instagram_Widget/ class Labtheme_Instagram_Widget