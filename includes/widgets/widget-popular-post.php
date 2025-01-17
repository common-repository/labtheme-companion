<?php
/**
 * Widget Popular Post
 *
 * @package Labtheme_Companion
 */
 
// register Labtheme_Popular_Post widget
function labtheme_register_popular_post_widget() {
    register_widget( 'Labtheme_Popular_Post' );
}
add_action( 'widgets_init', 'labtheme_register_popular_post_widget' );

if( ! class_exists( 'Labtheme_Popular_Post' ) ) : 
 /**
 * Adds Labtheme_Popular_Post widget.
 */
class Labtheme_Popular_Post extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct(){
        if( ! is_customize_preview() ) add_action( 'wp', array( $this, 'labtheme_set_views' ) );
        
        parent::__construct(
            'Labtheme_popular_post', // Base ID
            esc_html__( 'Lab Theme: Popular Post Widget', 'labtheme-companion' ), // Name
            array( 'description' => esc_html__( 'A Popular Post Widget', 'labtheme-companion' ), ) // Args
        );
    }
    
    /**
     * Function to add the post view count 
     */
    function labtheme_set_views( $post_id ) {
        if ( in_the_loop() ) {
            $post_id = get_the_ID();
          } 
        else {
            global $wp_query;
            $post_id = $wp_query->get_queried_object_id();
        }
        if( is_singular( 'post' ) )
        {
            $count_key = '_labtheme_view_count';
            $count = get_post_meta( $post_id, $count_key, true );
            if( $count == '' ){
                $count = 0;
                delete_post_meta( $post_id, $count_key );
                add_post_meta( $post_id, $count_key, '1' );
            }else{
                $count++;
                update_post_meta( $post_id, $count_key, $count );
            }
        }
    }

    /**
     * Function to get the post view count 
     */
    function labtheme_get_views( $post_id ){
        $count_key = '_labtheme_view_count';
        $count = get_post_meta( $post_id, $count_key, true );
        if( $count == '' ){        
            return __( "0 View", 'labtheme-companion' );
        }elseif($count<=1){
            return $count. __(' View', 'labtheme-companion' );
        }else{
            return $count. __(' Views', 'labtheme-companion' );    
        }    
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
       
        $title      = ! empty( $instance['title'] ) ?  $instance['title'] : __( 'Popular Posts', 'labtheme-companion' );
        $num_post    = ! empty( $instance['num_post'] ) ? $instance['num_post'] : 3 ;
        $show_thumb  = ! empty( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : '';
        $show_date   = ! empty( $instance['show_postdate'] ) ? $instance['show_postdate'] : '';
        $based_on    = ! empty( $instance['based_on'] ) ? $instance['based_on'] : 'views';
        $comment_num = ! empty( $instance['comment_num'] ) ? $instance['comment_num'] : '';
        $view_count  = ! empty( $instance['view_count'] ) ? $instance['view_count'] : '';
        
        $cat = get_theme_mod( 'exclude_categories' );
        if( $cat ) $cat = array_diff( array_unique( $cat ), array('') );
        
        $arg = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'posts_per_page'        => $num_post,
            'ignore_sticky_posts'   => true,
            'category__not_in'      => $cat
        );
        
        if( $based_on == 'views' ){
            $arg['orderby'] = 'meta_value_num';
            $arg['meta_key'] = '_labtheme_view_count';
        }elseif( $based_on == 'comments' ){
            $arg['orderby'] = 'comment_count';
        }
        
        $qry = new WP_Query( $arg );
        
        if( $qry->have_posts() ){
            echo $args['before_widget'];
            ob_start();
            if( $title ) echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title'];
            $target = 'target="_self"';
            if( isset($instance['target']) && $instance['target']!='' )
            {
                $target = 'target="_blank"';
            }
            ?>
            <ul>
                <?php 
                while( $qry->have_posts() ){
                    $qry->the_post();
                ?>
                    <li>
                        <?php if( $show_thumb ){ 
                                if( has_post_thumbnail() ){
                                    ?>
                                    <a <?php echo $target;?> href="<?php the_permalink();?>" class="post-thumbnail">
                                        <?php 
                                        $labtheme_popular_post_size = apply_filters('lab_popular_post_size', 'thumbnail');
                                        the_post_thumbnail( $labtheme_popular_post_size );?>
                                    </a>
                        <?php }
                                else{ ?>
                                    <a <?php echo $target;?> href="<?php the_permalink();?>" class="post-thumbnail">
                                        <img src="<?php echo LABTC_FILE_URL.'/public/css/images/no-featured-img.png'; ?>">
                                    </a>
                               <?php
                                }
                        }?>
                        <div class="entry-header">
                            <h3 class="entry-title"><a <?php echo $target;?> href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
                            <?php 
                            if( $show_date  ){ ?>
                                <div class="entry-meta"> 
                                    <?php $obj = new Labtheme_Companion_Functions;
                                    $obj->labtheme_posted_on(); ?>
                                </div>
                            <?php
                            }
                            
                            if( $based_on == 'views' && $view_count ){ ?>
                                <span class="view-count"><?php echo esc_html( $this->labtheme_get_views( get_the_ID() ) );?></span>
                            <?php }elseif( $based_on == 'comments' && $comment_num ){ ?>
                                <span class="comment-count"><i class="fa fa-comment" aria-hidden="true"></i><?php echo absint( get_comments_number() ); ?></span>
                            <?php 
                            }
                            ?>
                        </div>                        
                    </li>        
                <?php    
                }
                wp_reset_postdata();
            ?>
            </ul>
            <?php
            $html = ob_get_clean();
            echo apply_filters( 'labtheme_companion_popular_post_widget_filter', $html, $args, $instance );
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
        
        $title      = ! empty( $instance['title'] ) ?  $instance['title'] : __( 'Popular Posts', 'labtheme-companion' );
        $num_post       = ! empty( $instance['num_post'] ) ? $instance['num_post'] : 3 ;
        $show_thumbnail = ! empty( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : '';
        $show_postdate  = ! empty( $instance['show_postdate'] ) ? $instance['show_postdate'] : '';
        $based_on       = ! empty( $instance['based_on'] ) ? $instance['based_on'] : 'views';
        $comment_num    = ! empty( $instance['comment_num'] ) ? $instance['comment_num'] : '';
        $view_count     = ! empty( $instance['view_count'] ) ? $instance['view_count'] : '';
        $target         = ! empty( $instance['target'] ) ? $instance['target'] : '';
        
        ?>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) );  ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'num_post' ) ); ?>"><?php esc_html_e( 'Number of Posts', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'num_post' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'num_post' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $num_post ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'based_on' ) ); ?>"><?php esc_html_e( 'Popular based on:', 'labtheme-companion' ); ?></label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'based_on' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'based_on' ) ); ?>" class="based-on">
                <option value="views" <?php selected( $based_on, 'views' ); ?>><?php esc_html_e( 'Post Views', 'labtheme-companion' ); ?></option>
                <option value="comments" <?php selected( $based_on, 'comments' ); ?>><?php esc_html_e( 'Comment Count', 'labtheme-companion' ); ?></option>
            </select>
        </p>
        
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_thumbnail' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_thumbnail ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_thumbnail' ) ); ?>"><?php esc_html_e( 'Show Post Thumbnail', 'labtheme-companion' ); ?></label>
        </p>
        
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_postdate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_postdate' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_postdate ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_postdate' ) ); ?>"><?php esc_html_e( 'Show Post Date', 'labtheme-companion' ); ?></label>
        </p>
        
        <div class="based_on_comments" <?php echo ($based_on == "comments") ? "style='display:block;'" : "style='display:none;'" ;?>>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'comment_num' ) ); ?>">
                    <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'comment_num' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'comment_num' ) ); ?>" value="1" <?php checked( 1, $comment_num ); ?> />
                    <?php esc_html_e( 'Show number of comments', 'labtheme-companion' ); ?>
                </label>
            </p>
        </div>
        
        <div class="based_on_views" <?php echo ($based_on == "views" || $based_on=="") ? "style='display:block;'" : "style='display:none;'" ;?>>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'view_count' ) ); ?>">
                    <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'view_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'view_count' ) ); ?>" value="1" <?php checked( 1, $view_count ); ?> />
                    <?php esc_html_e( 'Show number of views', 'labtheme-companion' ); ?>
                </label>
            </p>
        </div>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>">
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="checkbox" value="1" <?php echo checked($target,1);?> /><?php esc_html_e( 'Open in New Tab', 'labtheme-companion' ); ?> </label>
        </p>
        <?php
        echo 
        '<script>
        $(".based-on").change(function() {
            if( $(this).val()== "comments" )
            {
                $(this).parent().siblings(".based_on_views").hide();
                $(this).parent().siblings(".based_on_comments").show();
            }
            else if($(this).val()== "views")
            {
                $(this).parent().siblings(".based_on_views").show();
                $(this).parent().siblings(".based_on_comments").hide();
            }
        });
        </script>'; 
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
        
        $instance['title']          = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : __( 'Popular Posts', 'labtheme-companion' );
        $instance['num_post']       = ! empty( $new_instance['num_post'] ) ? absint( $new_instance['num_post'] ) : 3 ;        
        $instance['show_thumbnail'] = ! empty( $new_instance['show_thumbnail'] ) ? absint( $new_instance['show_thumbnail'] ) : '';
        $instance['show_postdate']  = ! empty( $new_instance['show_postdate'] ) ? absint( $new_instance['show_postdate'] ) : '';
        $instance['based_on']       = ! empty( $new_instance['based_on'] ) ? esc_attr( $new_instance['based_on'] ) : 'views';
        $instance['comment_num']    = ! empty( $new_instance['comment_num'] ) ? absint( $new_instance['comment_num'] ) : '';
        $instance['view_count']     = ! empty( $new_instance['view_count'] ) ? absint( $new_instance['view_count'] ) : '';
        $instance['target']         = ! empty( $new_instance['target'] ) ? esc_attr( $new_instance['target'] ) : '';
        
        return $instance;
                
    }

} // class Labtheme_Popular_Post 
endif;