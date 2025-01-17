<?php
/**
 * Call To Action Widget
 *
 * @package Labtheme_Companion
 */

// register Labtheme_Companion_Cta widget
function labtheme_register_cta_widget() {
    register_widget( 'Labtheme_Companion_Cta' );
}
add_action('widgets_init', 'labtheme_register_cta_widget');
 /**
 * Adds Labtheme_Companion_Cta widget.
 */
class Labtheme_Companion_Cta extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        add_action( 'admin_footer-widgets.php', array( $this, 'print_scripts' ), 9999 );
        add_action( 'load-widgets.php', array( $this, 'labtheme_load_cta_colorpicker' ) );
        parent::__construct(
            'labtheme_companion_cta_widget', // Base ID
            __( 'Lab Theme: Call To Action Widget', 'labtheme-companion' ), // Name
            array( 'description' => __( 'A Call To Action Widget.', 'labtheme-companion' ), ) // Args
        );
    }

    function Labtheme_Featured_Page_Button_Alignment(){
        $array = array(
            'right'     => 'right',
            'centered'  => 'centered'
        );
        return $array;
    }

    function Labtheme_Featured_Page_Button_Numbers(){
        $array = array(
            '1'      => '1',
            '2'      => '2',
        );
        return $array;
    }

    function labtheme_load_cta_colorpicker() {    
        wp_enqueue_style( 'wp-color-picker' );        
        wp_enqueue_script( 'wp-color-picker' );    
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
        
        $obj              = new Labtheme_Companion_Functions();
        $title            = ! empty( $instance['title'] ) ? $instance['title'] : '' ;        
        $content          = ! empty( $instance['content'] ) ? $instance['content'] : '';
        $button_alignment = ! empty( $instance['button_alignment'] ) ? $instance['button_alignment'] : apply_filters('labtheme_cta_btn_alignment','right');
        $button_number    = ! empty( $instance['button_number'] ) ? $instance['button_number'] : '1';
        $button1_text     = ! empty( $instance['button1_text'] ) ? $instance['button1_text'] : '' ;
        $button2_text     = ! empty( $instance['button2_text'] ) ? $instance['button2_text'] : '' ;
        $button1_url      = ! empty( $instance['button1_url'] ) ? $instance['button1_url'] : '' ;
        $button2_url      = ! empty( $instance['button2_url'] ) ? $instance['button2_url'] : '' ;
        $btn1_color       = apply_filters('labtheme_cta_btn1_color','#ffffff');
        $btn2_color       = apply_filters('labtheme_cta_btn2_color','#ffffff');
        $button1_color    = ! empty($instance['button1_color']) ? esc_attr($instance['button1_color']):$btn1_color;
        $button2_color    = ! empty($instance['button2_color']) ? esc_attr($instance['button2_color']):$btn2_color;
        $bgcolor          = apply_filters('labtheme_cta_bg_color','#fff');
        $widget_bg_color  = ! empty($instance['widget-bg-color']) ? esc_attr($instance['widget-bg-color']):$bgcolor;
        $widget_bg_image  = !empty($instance['widget-bg-image']) ? esc_attr($instance['widget-bg-image']):'';
        $target           = ! empty( $instance['target'] ) ? esc_url( $instance['target'] ) : '';

        if( isset( $target ) && $target != '' ){
            $newtab = 'target="_blank"';
        }
        else{
            $newtab = '';
        }
        echo $args['before_widget'];
        ob_start(); 

        // CTA Background
        $size = apply_filters('labtheme_cta_img_size','full');
        if( $widget_bg_image ){
            /** Added to work for demo content compatible */            
            $attachment_id = $widget_bg_image;
            $cta_img_size  = apply_filters('cta_img_size','full');
            $image_url     = wp_get_attachment_image_url( $attachment_id, $cta_img_size);

            $ctaclass      = ' labtheme-cta-bg';
            $bg            = ' style="background:url(' . esc_url( $image_url ) . ') no-repeat; background-size: cover; background-position: center"';
        }
        else{
            $ctaclass = ' text';
            $bg = ' style="background:' . sanitize_hex_color( $widget_bg_color ) . '"';
        }

        // Button colors
        $btn1 = ' style="background:' . sanitize_hex_color( $button1_color ) . '"';
        $btn2 = ' style="background:' . sanitize_hex_color( $button2_color ) . '"';
        ?>        
        <div class="<?php echo esc_attr( $button_alignment . $ctaclass ); ?>"<?php echo $bg;?>>
            <div class="labtheme-cta-container">
                <?php
                if( $title ) echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title']; ?>
                <div class="text-holder">
                        <?php if( $content ) echo wpautop( wp_kses_post( $content ) ); ?>
                    <div class="button-wrap">
                        <?php
                            if( $button_number == '1' ){
                                if( isset( $button1_text ) && $button1_url!='' ) echo '<a ' .$newtab. ' href="' . esc_url( $button1_url ) . '" class="btn-cta btn-1"' . $btn1 . '>' . esc_html( $button1_text ) . '</a>';
                            }
                            if( $button_number == '2' ){
                                if( isset( $button1_text ) && $button1_url!='' ) echo '<a ' .$newtab. 'href="' . esc_url( $button1_url ) . '" class="btn-cta btn-1" ' . $btn1 . '>' . esc_html( $button1_text ) . '</a>';
                                if( isset( $button2_text ) && $button2_url!='' ) echo '<a ' .$newtab. ' href="' . esc_url( $button2_url ) . '" class="btn-cta btn-2" ' . $btn2 . '>' . esc_html( $button2_text ) . '</a>';
                            }
                        ?>
                    </div>
                </div>
            </div> 
        </div>        
        <?php
        $html = ob_get_clean();
        echo apply_filters( 'labtheme_companion_cta_widget_filter', $html, $args, $instance ); 
        echo $args['after_widget'];
    }


    public function print_scripts() {
        ?>
        <script>

            ( function( $ ){

                function initColorPicker( widget ) {
                    widget.find( '.my-widget-color-field' ).wpColorPicker( {
                        change: _.throttle( function() { // For Customizer
                            $(this).trigger( 'change' );
                        }, 3000 )
                    });
                }

                function onFormUpdate( event, widget ) {
                    initColorPicker( widget );
                }

                $( document ).on( 'widget-added widget-updated', onFormUpdate );

                $( document ).ready( function() {
                    $( '#widgets-right .widget:has(.my-widget-color-field)' ).each( function () {
                        initColorPicker( $( this ) );
                    } );
                } );

            }( jQuery ) );

        </script>
        <?php
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form( $instance ) {
        $obj              = new Labtheme_Companion_Functions();
        $title            = ! empty( $instance['title'] ) ? $instance['title'] : '' ;        
        $content          = ! empty( $instance['content'] ) ? $instance['content'] : '';
        $button_alignment = ! empty( $instance['button_alignment'] ) ? $instance['button_alignment'] : apply_filters('labtheme_cta_btn_alignment','right');
        $button_number    = ! empty( $instance['button_number'] ) ? $instance['button_number'] : '';
        $button1_text     = ! empty( $instance['button1_text'] ) ? $instance['button1_text'] : '' ;
        $button2_text     = ! empty( $instance['button2_text'] ) ? $instance['button2_text'] : '' ;
        $button1_url      = ! empty( $instance['button1_url'] ) ? $instance['button1_url'] : '' ;
        $button2_url      = ! empty( $instance['button2_url'] ) ? $instance['button2_url'] : '' ;
        $btn1_color       = apply_filters('labtheme_cta_btn1_color','#ffffff');
        $btn2_color       = apply_filters('labtheme_cta_btn2_color','#ffffff');
        $button1_color    = ! empty($instance['button1_color']) ? esc_attr($instance['button1_color']):$btn1_color;
        $button2_color    = ! empty($instance['button2_color']) ? esc_attr($instance['button2_color']):$btn2_color;
        $bgcolor          = apply_filters('labtheme_cta_bg_color','#ffffff');
        $widget_bg_color  = ! empty($instance['widget-bg-color']) ? esc_attr($instance['widget-bg-color']):$bgcolor;
        $widget_bg_image  = !empty($instance['widget-bg-image']) ? esc_attr($instance['widget-bg-image']):'';
        $target           = !empty($instance['target']) ? esc_attr($instance['target']):'';

        ?>
        <!-- title -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />            
        </p>
        <!-- Description -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"><?php esc_html_e( 'Description', 'labtheme-companion' ); ?></label>
            <textarea name="<?php echo esc_attr( $this->get_field_name( 'content' ) ); ?>" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'content' ) ); ?>"><?php print $content; ?></textarea>
        </p>
        <!-- Button number -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'button_number' ) ); ?>"><?php esc_html_e( 'Number of Call-to-Action Buttons:', 'labtheme-companion' ); ?></label>
            <select name="<?php echo esc_attr( $this->get_field_name( 'button_number' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'button_number' ) ); ?>" class="widefat cta-button-number">
                <?php
                $button_number_options = $this->Labtheme_Featured_Page_Button_Numbers();
                foreach ( $button_number_options as $option ) { ?>
                    <option value="<?php echo $option; ?>" id="<?php echo esc_attr( $this->get_field_id( $option ) ); ?>" <?php selected( $option, $button_number ); ?>><?php echo $option; ?></option>
                <?php } ?>
            </select>
        </p>
        <!-- Button one -->
        <div class="button-one-info">
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button1_text' ) ); ?>"><?php esc_html_e( 'Button 1 Label', 'labtheme-companion' ); ?></label>
                <input id="<?php echo esc_attr( $this->get_field_id( 'button1_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button1_text' ) ); ?>" type="text" value="<?php echo esc_attr( $button1_text ); ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button1_url' ) ); ?>"><?php esc_html_e( 'Button 1 Link', 'labtheme-companion' ); ?></label>
                <input id="<?php echo esc_attr( $this->get_field_id( 'button1_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button1_url' ) ); ?>" type="text" value="<?php echo esc_url( $button1_url ); ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button1_color' ) ); ?>"><?php esc_html_e( 'Button 1 Color', 'labtheme-companion' ); ?></label>
                <input type="text" class="my-widget-color-field" name="<?php echo esc_attr( $this->get_field_name( 'button1_color' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'button1_color' ) ); ?>" value="<?php echo esc_attr( $button1_color ); ?>" />
            </p>
        </div>
        <!-- Button 2 -->
        <div class="button-two-info" <?php if( $button_number=='' || isset($button_number) && $button_number == 1 ) { echo "style='display:none;'";} ?>>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button2_text' ) ); ?>"><?php esc_html_e( 'Button 2 Label', 'labtheme-companion' ); ?></label>
                <input id="<?php echo esc_attr( $this->get_field_id( 'button2_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button2_text' ) ); ?>" type="text" value="<?php echo esc_attr( $button2_text ); ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button2_url' ) ); ?>"><?php esc_html_e( 'Button 2 Link', 'labtheme-companion' ); ?></label>
                <input id="<?php echo esc_attr( $this->get_field_id( 'button2_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button2_url' ) ); ?>" type="text" value="<?php echo esc_url( $button2_url ); ?>" />
            </p>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'button2_color' ) ); ?>"><?php esc_html_e( 'Button 2 Color', 'labtheme-companion' ); ?></label>
                <input type="text" class="my-widget-color-field" name="<?php echo esc_attr( $this->get_field_name( 'button2_color' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'button2_color' ) ); ?>" value="<?php echo esc_attr( $button2_color ); ?>" />
            </p>
        </div>        
        <!-- Open in New tab -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>"><?php esc_html_e( 'Open in New Tab', 'labtheme-companion' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="checkbox" value="1" <?php echo checked( $target, '1' );?> />            
        </p>
        <!-- Button aligment -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'button_alignment' ) ); ?>"><?php esc_html_e( 'Button Alignment:', 'labtheme-companion' ); ?></label>
            <select name="<?php echo esc_attr( $this->get_field_name( 'button_alignment' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'button_alignment' ) ); ?>" class="widefat cta-button-alignment">
                <?php
                $align_options = $this->Labtheme_Featured_Page_Button_Alignment();
                foreach ( $align_options as $options ) { ?>
                    <option value="<?php echo $options; ?>" id="<?php echo esc_attr( $this->get_field_id( $options ) ); ?>" <?php selected( $options, $button_alignment ); ?>><?php echo $options; ?></option>
                <?php } ?>
            </select>
        </p>
        <!-- Widget color or Background -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'widget-bg-color' ) ); ?>"><?php esc_html_e( 'Background Color', 'labtheme-companion' ); ?></label>
            <input type="text" class="my-widget-color-field" name="<?php echo esc_attr( $this->get_field_name( 'widget-bg-color' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'widget-bg-color' ) ); ?>" value="<?php echo esc_attr( $widget_bg_color ); ?>" />
        </p>
        Or,
        <?php
            $obj->labtheme_companion_get_image_field( $this->get_field_id( 'widget-bg-image' ), $this->get_field_name( 'widget-bg-image' ),  $widget_bg_image, __( 'Upload Image', 'labtheme-companion' ) );

    echo 
    '<script>
    $(".cta-button-number").change(function() {
        if( $(this).val()== 2 )
        {
            $(this).parent().siblings(".button-one-info, .button-two-info").show();
        }
        else{
            $(this).parent().siblings(".button-two-info").fadeOut();
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
        $instance                     = array();
        $instance['title']            = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '' ;
        $instance['content']          = ! empty( $new_instance['content'] ) ? wp_kses_post( $new_instance['content'] ) : '';
        $instance['button_number']    = ! empty( $new_instance['button_number'] ) ? esc_attr( $new_instance['button_number'] ) : '';
        $instance['button_alignment'] = ! empty( $new_instance['button_alignment'] ) ? esc_attr( $new_instance['button_alignment'] ) : 'center';
        $instance['button1_url']      = ! empty( $new_instance['button1_url'] ) ? esc_url_raw( $new_instance['button1_url'] ) : '';
        $instance['button2_url']      = ! empty( $new_instance['button2_url'] ) ? esc_url_raw( $new_instance['button2_url'] ) : '';
        $instance['button1_text']     = ! empty( $new_instance['button1_text'] ) ? sanitize_text_field( $new_instance['button1_text'] ) : '';
        $instance['button2_text']     = ! empty( $new_instance['button2_text'] ) ? sanitize_text_field( $new_instance['button2_text'] ) : '';
        $btn1_color                   = apply_filters('labtheme_cta_btn1_color','#ffffff');
        $btn2_color                   = apply_filters('labtheme_cta_btn2_color','#ffffff');
        $instance['button1_color']    = isset($new_instance['button1_color']) ? esc_attr($new_instance['button1_color']):$btn1_color;
        $instance['button2_color']    = isset($new_instance['button2_color']) ? esc_attr($new_instance['button2_color']):$btn2_color;
        $bgcolor                      = apply_filters('labtheme_cta_bg_color','#fff');
        $instance['widget-bg-color']  = isset($new_instance['widget-bg-color']) ? esc_attr($new_instance['widget-bg-color']):$bgcolor;
        $instance['widget-bg-image']  = isset($new_instance['widget-bg-image']) ? esc_attr($new_instance['widget-bg-image']):'';
        $instance['target']           = isset($new_instance['target']) ? esc_attr($new_instance['target']):'';
        
        return $instance;
    }
    
}