<?php
/**
 * Widget Recent Events
 *
 * @package Labtheme_Companion
 */
 
// register Labtheme_Recent_Events widget
function labtheme_register_recent_events_widget() {
    register_widget( 'Labtheme_Recent_Events' );
}
add_action( 'widgets_init', 'labtheme_register_recent_events_widget' );
 
 /**
 * Adds Labtheme_Recent_Events widget.
 */
class Labtheme_Recent_Events extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'labtheme_recent_events', // Base ID
            __( 'Lab Theme: Recent Events Widget', 'labtheme-companion' ), // Name
            array( 'description' => __( 'A Recent Events Widget', 'labtheme-companion' ), ) // Args
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
       
        $title      = ! empty( $instance['title'] ) ?  $instance['title'] : __( 'Recent Events', 'labtheme-companion' );
        $num_post   = ! empty( $instance['num_post'] ) ? $instance['num_post'] : 3 ;
        $show_thumb = ! empty( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : '';
        $show_date  = ! empty( $instance['show_postdate'] ) ? $instance['show_postdate'] : '';
        $target = 'target="_self"';
        if( isset($instance['target']) && $instance['target']!='' )
        {
            $target = 'target="_blank"';
        }

        $qry = new WP_Query( array(
            'post_type'             => 'lab-event',
            'post_status'           => 'publish',
            'posts_per_page'        => $num_post,
            'ignore_sticky_posts'   => true
        ) );
        if( $qry->have_posts() ){
            echo $args['before_widget'];
            ob_start();
            if( $title ){ echo $args['before_title'].apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title']; }
            ?>
            <ul>
                <?php 
                while( $qry->have_posts() ){
                    $qry->the_post();
                ?>
                    <li>
                        <?php 
                        if( $show_thumb ){ 
                            if( has_post_thumbnail() )
                            {
                            ?>
                            <a <?php echo $target; ?> href="<?php the_permalink();?>" class="post-thumbnail">
                                <?php  
                                    $recent_img_size = apply_filters('labtheme_recent_img_size','thumbnail');
                                    the_post_thumbnail( $recent_img_size ); 
                                ?>
                            </a>
                        <?php 
                            }
                            else{ ?>
                                <a <?php echo $target; ?> href="<?php the_permalink();?>" class="post-thumbnail">
                                    <img src="<?php echo LABTC_FILE_URL.'/public/css/images/no-featured-img.png';?>">
                                </a>
                            <?php
                            }
                        }?>
                        <div class="entry-header">
                            <h3 class="entry-title"><a <?php echo $target; ?> href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
                            <?php if( $show_date ) { ?>
                                <div class="entry-meta">
                                    <span class="posted-on"><a <?php echo $target; ?> href="<?php the_permalink(); ?>">
                                        <time datetime="<?php printf( __( '%1$s', 'labtheme-companion' ), get_the_date('Y-m-d') ); ?>"><?php printf( __( '%1$s', 'labtheme-companion' ), get_the_date('F j, Y') ); ?></time></a>
                                    </span>
                                </div>
                            <?php } ?>
                        </div>                        
                    </li>        
                <?php    
                }
            ?>
            </ul>
            <?php
            $html = ob_get_clean();
            echo apply_filters( 'labtheme_companion_recent_post_widget_filter', $html, $args, $instance );
            echo $args['after_widget'];   
        }
        wp_reset_postdata();  
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        
        $title          = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Recent Events', 'labtheme-companion' );
        $num_post       = ! empty( $instance['num_post'] ) ? $instance['num_post'] : 3 ;
        $show_thumbnail = ! empty( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : '';
        $show_postdate  = ! empty( $instance['show_postdate'] ) ? $instance['show_postdate'] : '';
        $target         = ! empty( $instance['target'] ) ? $instance['target'] : '';
        ?>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'num_post' ) ); ?>"><?php esc_html_e( 'Number of Events', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'num_post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'num_post' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $num_post ); ?>" />
        </p>
        
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_thumbnail' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_thumbnail ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>"><?php esc_html_e( 'Show Post Thumbnail', 'labtheme-companion' ); ?></label>
        </p>
        
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_postdate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_postdate' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_postdate ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_postdate' ) ); ?>"><?php esc_html_e( 'Show Post Date', 'labtheme-companion' ); ?></label>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>">
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="checkbox" value="1" <?php echo checked($target,1);?> /><?php esc_html_e( 'Open in New Tab', 'labtheme-companion' ); ?> </label>
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
        
        $instance['title']          = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : __( 'Recent Events', 'labtheme-companion' );
        $instance['num_post']       = ! empty( $new_instance['num_post'] ) ? absint( $new_instance['num_post'] ) : 3 ;        
        $instance['show_thumbnail'] = ! empty( $new_instance['show_thumbnail'] ) ? absint( $new_instance['show_thumbnail'] ) : '';
        $instance['show_postdate']  = ! empty( $new_instance['show_postdate'] ) ? absint( $new_instance['show_postdate'] ) : '';
        $instance['target']         = ! empty( $new_instance['target'] ) ? esc_attr( $new_instance['target'] ) : '';
        
        return $instance;
        
    }

} // class Labtheme_Recent_Events