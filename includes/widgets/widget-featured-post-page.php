<?php
/**
 * Widget Featured page and post
 *
 * @package Labtheme_Companion
 */
 
// register Labtheme_Featured_Page_Post_Widget widget
function labtheme_register_featured_page_post_widget() {
    register_widget( 'Labtheme_Featured_Page_Post_Widget' );
}
add_action( 'widgets_init', 'labtheme_register_featured_page_post_widget' );
 
 /**
 * Adds Labtheme_Featured_Page_Post_Widget widget.
 */
class Labtheme_Featured_Page_Post_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
            'labtheme_featured_page_Post_widget', // Base ID
            __( 'Lab Theme: Featured Post/page Widget', 'labtheme-companion' ), // Name
            array( 'description' => __( 'A Featured Page and post Widget', 'labtheme-companion' ), ) // Args
        );
    }

    function Labtheme_Featured_Page_Image_Alignment()
    {
        $array = apply_filters('labtheme_img_alignment',array(
            'right'     => __('Right','labtheme-companion'),
            'left'      => __('Left','labtheme-companion'),
            'centered'  => __('Centered','labtheme-companion')
        ));
        return $array;
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
        $title             = !empty( $instance['title'] ) ? $instance['title'] : __( '', 'labtheme-companion' );         
        $read_more         = !empty( $instance['readmore'] ) ? $instance['readmore'] : __( 'Read More', 'labtheme-companion' );      
        $show_feat_img     = !empty( $instance['show_feat_img'] ) ? $instance['show_feat_img'] : '' ;  
        $show_page_title   = !empty( $instance['show_page_title'] ) ? $instance['show_page_title'] : '' ;        
        $show_page_content = !empty( $instance['show_page_content'] ) ? $instance['show_page_content'] : '' ;        
        $show_readmore     = !empty( $instance['show_readmore'] ) ? $instance['show_readmore'] : '' ;        
        $page_list         = !empty( $instance['page_list'] ) ? $instance['page_list'] : 1 ;
        $image_alignment   = apply_filters( 'labtheme_featured_img_alignment', 'right' );
        $image_alignment   = !empty( $instance['image_alignment'] ) ? $instance['image_alignment'] : $image_alignment;

        if( !isset( $page_list ) || $page_list == '' ) return;
        
        $post_no = get_post($page_list); 
        $trim_me = $post_no->post_content;

        $target = 'target="_blank"';
        if( isset($instance['target']) && $instance['target']!='' )
        {
            $target = 'target="_self"';
        }
        
        if( get_post_type( $page_list ) == 'post' ){
            $qry = new WP_Query( "p=$page_list" );
        }else{
            $qry = new WP_Query( "page_id=$page_list" );
        }

        if( $qry->have_posts() ){
            echo $args['before_widget'];
            ob_start();
            while( $qry->have_posts() ){
                $qry->the_post();
                ?>
                <?php if( has_post_thumbnail() && $show_feat_img ){ 
                    $add_class = ' has-featured-image';
                }else{
                    $add_class = ' no-featured-image';
                } ?>
                <div class="widget-featured-holder <?php echo esc_attr($image_alignment);?><?php echo esc_attr($add_class);?>">
                    <?php
                    if( isset( $show_page_title ) && $show_page_title!='' ){
                        echo is_page_template( 'templates/about.php' ) ? '<h1 class="section-subtitle">' : '<p class="section-subtitle">'; //Done for SEO?>
                        <span><?php echo esc_html( $post_no->post_title ); ?></span>
                        <?php
                        echo is_page_template( 'templates/about.php' ) ? '</h1>' : '</p>';
                    } 
                    ?>
                    
                    <div class="text-holder">
                        <?php
                        if( isset( $title ) && $title!='' )
                        { ?>
                            <h2 class="widget-title"><?php echo esc_html( $title ); ?></h2>
                        <?php } ?>
                        <div class="featured_page_content">
                            <?php 
                            if( isset( $show_page_content ) && $show_page_content!='' )
                            {
                                echo apply_filters('the_content',$post_no->post_content);
                                ?>
                                <?php
                                if( isset( $show_readmore ) && $show_readmore!='' )
                                { ?>
                                <a href="<?php the_permalink();?>" <?php echo $target;?> class="btn-readmore"><?php echo esc_html( $read_more );?></a>
                            <?php
                                }
                            }
                            else{
                                echo apply_filters( 'the_excerpt', get_the_excerpt( $post_no ) );
                                ?>
                                <?php
                                if( isset( $show_readmore ) && $show_readmore!='' )
                                { ?>
                                <a href="<?php the_permalink();?>" <?php echo $target;?> class="btn-readmore"><?php echo esc_html( $read_more );?></a>
                            <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php if( has_post_thumbnail() && $show_feat_img ){ ?>
                    <div class="img-holder">
                        <a <?php echo $target;?> href="<?php the_permalink(); ?>">
                            <?php 
                            $featured_img_size = apply_filters( 'labtheme_featured_img_size', 'full' );
                            the_post_thumbnail( $featured_img_size ); ?>
                        </a>
                    </div>
                    <?php } ?>
                </div>        
            <?php    
            }
            wp_reset_postdata();
            $html = ob_get_clean();
            echo apply_filters( 'labtheme_companion_featured_page_widget_filter', $html, $args, $instance );
            echo $args['after_widget'];   
        }
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $postlist[0] = array(
            'value' => 0,
            'label' => __('--Choose--', 'labtheme-companion'),
        );
        $arg = array( 'posts_per_page' => -1, 'post_type' => array( 'page', 'post' ) );
        $posts = get_posts($arg); 
        
        foreach( $posts as $p ){ 
            $postlist[$p->ID] = array(
                'value' => $p->ID,
                'label' => $p->post_title
            );
        }
        // $instance['show_page_title'] = 1;
        // $instance['show_feat_img'] = 1;
        // $instance['show_page_content'] = 1;
        
        $title             = !empty( $instance['title'] ) ? $instance['title'] : __( '', 'labtheme-companion' );   
        $target    = ! empty( $instance['target'] ) ? $instance['target'] : '';      
        $read_more         = !empty( $instance['readmore'] ) ? $instance['readmore'] : __( 'Read More', 'labtheme-companion' );      
        $show_feat_img     = !empty( $instance['show_feat_img'] ) ? $instance['show_feat_img'] : '' ;  
        $show_page_title   = !empty( $instance['show_page_title'] ) ? $instance['show_page_title'] : '' ;        
        $show_page_content = !empty( $instance['show_page_content'] ) ? $instance['show_page_content'] : '' ;        
        $show_readmore     = !empty( $instance['show_readmore'] ) ? $instance['show_readmore'] : '' ;        
        $page_list         = !empty( $instance['page_list'] ) ? $instance['page_list'] : 1 ;
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'page_list' ) ); ?>"><?php esc_html_e( 'Page:', 'labtheme-companion' ); ?></label>
            <select name="<?php echo esc_attr( $this->get_field_name( 'page_list' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'page_list' ) ); ?>" class="widefat">
                <?php
                foreach ( $postlist as $single_post ) { ?>
                    <option value="<?php echo $single_post['value']; ?>" id="<?php echo esc_attr( $this->get_field_id( $single_post['label'] ) ); ?>" <?php selected( $single_post['value'], $page_list ); ?>><?php echo $single_post['label']; ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_feat_img' ) ); ?>" class="check-btn-wrap">
                <input id="<?php echo esc_attr( $this->get_field_id( 'show_feat_img' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_feat_img' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_feat_img ); ?>/>
                <?php esc_html_e( 'Show Featured Image', 'labtheme-companion' ); ?>
            </label>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_page_title' ) ); ?>" class="check-btn-wrap">
                <input id="<?php echo esc_attr( $this->get_field_id( 'show_page_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_page_title' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_page_title ); ?>/>
                <?php esc_html_e( 'Show Page Title', 'labtheme-companion' ); ?>
            </label>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_page_content' ) ); ?>" class="check-btn-wrap">
                <input class="full-content" id="<?php echo esc_attr( $this->get_field_id( 'show_page_content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_page_content' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_page_content ); ?>/>
                <?php esc_html_e( 'Show Page Full Content', 'labtheme-companion' ); ?>
            </label>
        </p>

        <div class="read-more" <?php echo isset($show_page_content) && ($show_page_content =='1') ? "style='display:none;'" : "style='display:block;'" ;?>>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'readmore' ) ); ?>"><?php esc_html_e( 'Read More Text', 'labtheme-companion' ); ?></label> 
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'readmore' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'readmore' ) ); ?>" type="text" value="<?php echo esc_attr( $read_more ); ?>" />
            </p>
           
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'show_readmore' ) ); ?>" class="check-btn-wrap">
                    <input id="<?php echo esc_attr( $this->get_field_id( 'show_readmore' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_readmore' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $show_readmore ); ?>/>
                    <?php esc_html_e( 'Show Read More', 'labtheme-companion' ); ?>
                </label>
            </p>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" class="check-btn-wrap">
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="checkbox" value="1" <?php echo checked($target,1);?> /><?php esc_html_e( 'Open in Same Tab', 'labtheme-companion' ); ?> </label>
            </p>
        </div>

        <?php
        echo 
        '<script>
        $(".full-content").on("change", function(e) {
            var checked = $(this).is(":checked");
            if( checked )
            {
                $(this).parent().parent().siblings(".read-more").hide();
            }
            else{
                $(this).parent().parent().siblings(".read-more").show();
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
        $instance                      = array();
        $instance['title']             = !empty( $new_instance['title'] ) ? $new_instance['title'] : '';
        $instance['show_page_title']   = !empty( $new_instance['show_page_title'] ) ? $new_instance['show_page_title'] : '' ;
        $instance['show_page_content'] = !empty( $new_instance['show_page_content'] ) ? $new_instance['show_page_content'] : '' ;
        $instance['show_readmore']     = !empty( $new_instance['show_readmore'] ) ? $new_instance['show_readmore'] : '' ;
        $instance['readmore']          = ! empty( $new_instance['readmore'] ) ? sanitize_text_field( $new_instance['readmore'] ) : __( 'Read More', 'labtheme-companion' );
        $instance['page_list']         = ! empty( $new_instance['page_list'] ) ? absint( $new_instance['page_list'] ) : 1;
        $instance['show_feat_img']     = ! empty( $new_instance['show_feat_img'] ) ? absint( $new_instance['show_feat_img'] ) : '';
        $instance['target']         = ! empty( $new_instance['target'] ) ? esc_attr( $new_instance['target'] ) : '';
        return $instance;
    }

} // class Labtheme_Featured_Page_Post_Widget
