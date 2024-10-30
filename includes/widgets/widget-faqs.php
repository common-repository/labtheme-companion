<?php
/**
 * Stat Counter Widget
 *
 * @package Labtheme_Companion
 */

// register Labtheme_FAQs_Widget widget
function labtheme_faqs_widget(){
    register_widget( 'Labtheme_FAQs_Widget' );
}
add_action('widgets_init', 'labtheme_faqs_widget');
 
 /**
 * Adds Labtheme_FAQs_Widget widget.
 */
class Labtheme_FAQs_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'labtheme_companion_faqs_widget', // Base ID
            __( 'Lab Theme: FAQs Widget', 'labtheme-companion' ), // Name
            array( 'description' => __( 'A Widget for FAQs.', 'labtheme-companion' ), ) // Args
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
        $title            = ! empty( $instance['title'] ) ? $instance['title'] : '' ;
        $content          = ! empty( $instance['content'] ) ? $instance['content'] : '';
        $toggle   = ! empty( $instance['toggle'] ) ? $instance['toggle'] : '' ;     

        echo $args['before_widget']; 
        ob_start();
        ?>
        <div class="col">
            <div class="labtheme-faq-holder">
                <?php
                if( $title ) echo $args['before_title'] . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $args['after_title']; ?>
                    <?php 
                    if( $content ) echo wpautop( wp_kses_post( $content ) );
                    if( $toggle ) { ?>
                        <a href="javascript:void(0);" class="expand-faq">
                            <i class="fas fa-toggle-off" aria-hidden="true"></i>
                            <?php
                                _e('Expand/Close', 'labtheme-companion'); ?>
                        </a>
                        <?php
                    } ?>
                <ul class="accordion">
                    <?php
                    if(isset($instance['question']))
                    {
                        foreach ($instance['question'] as $key => $value) { ?>
                             <li><a class="toggle" href="javascript:void(0);"><?php echo esc_attr($value);?></a> 
                                <div class="inner">
                                    <?php echo esc_attr($instance['answer'][$key]) ?>         
                                </div>
                            </li>
                        <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php
        $html = ob_get_clean();
        echo apply_filters( 'labtheme_faqs_widget_filter', $html, $args, $instance );
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
        $title            = ! empty( $instance['title'] ) ? $instance['title'] : '' ;       
        $content          = ! empty( $instance['content'] ) ? $instance['content'] : '';
        $toggle   = ! empty( $instance['toggle'] ) ? $instance['toggle'] : '' ;        
        $question   = ! empty( $instance['question'] ) ? $instance['question'] : '' ;        
        $answer   = ! empty( $instance['answer'] ) ? $instance['answer'] : '' ;

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
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'toggle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'toggle' ) ); ?>" type="checkbox" value="1" <?php checked( '1', $toggle ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'toggle' ) ); ?>"><?php esc_html_e( 'Enable FAQs Toggle', 'labtheme-companion' ); ?></label>
        </p>
        <div class="widget-client-faq-repeater" id="<?php echo esc_attr( $this->get_field_id( 'labthemecompanion-faq-repeater' ) ); ?>">
            <?php 
            if( !isset( $question ) || $question=='' )
            { ?>
                <div class="faqs-repeat" data-id="1"><span class="cross"><i class="fas fa-times"></i></span>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'question[1]' ) ); ?>"><?php esc_html_e( 'Question', 'labtheme-companion' ); ?></label> 
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'question[1]' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'question[1]' ) ); ?>" type="text" value="" />   
                    <label for="<?php echo esc_attr( $this->get_field_id( 'answer[1]' ) ); ?>"><?php esc_html_e( 'Answer', 'labtheme-companion' ); ?></label> 
                    <textarea id="<?php echo esc_attr( $this->get_field_id( 'answer[1]' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'answer[1]' ) ); ?>"></textarea>         
                </div>
            <?php
            }
            if( isset( $instance['question'] ) && $instance['question']!='' )
            {
                $arr = $instance['question'];
                $max = max(array_keys($arr)); 
                for ($i=1; $i <= $max; $i++) { 
                    if( array_key_exists($i, $arr) )
                    { ?>
                        <div class="faqs-repeat" data-id="<?php echo $i; ?>"><span class="cross"><i class="fas fa-times"></i></span>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'question['.$i.']' ) ); ?>"><?php esc_html_e( 'Question', 'labtheme-companion' ); ?></label> 
                        <input class="widefat demo" id="<?php echo esc_attr( $this->get_field_id( 'question['.$i.']' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'question['.$i.']' ) ); ?>" type="text" value="<?php echo esc_attr($instance['question'][$i]);?>" />   
                        <label for="<?php echo esc_attr( $this->get_field_id( 'answer['.$i.']' ) ); ?>"><?php esc_html_e( 'Answer', 'labtheme-companion' ); ?></label> 
                        <textarea class="answer" id="<?php echo esc_attr( $this->get_field_id( 'answer['.$i.']' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'answer['.$i.']' ) ); ?>"><?php echo esc_attr($instance['answer'][$i]) ?></textarea>         
                        </div>
                <?php
                    }
                }
            }
            ?>
            <span class="labtheme-faq-holder"></span>
        </div>
        <button id="add-faq" class="button"><?php _e('Add FAQs','labtheme-companion');?></button>
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
        $instance['title']            = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '' ;
        $instance['content']          = ! empty( $new_instance['content'] ) ? wp_kses_post( $new_instance['content'] ) : '';
        $instance['toggle']   = ! empty( $new_instance['toggle'] ) ? sanitize_text_field( $new_instance['toggle'] ) : '' ;
        if(isset($new_instance['question']))
        {
            foreach ( $new_instance['question'] as $key => $value ) {
                $instance['question'][$key]   = $value;
            }
        }

        if(isset($new_instance['answer']))
        {
            foreach ( $new_instance['answer'] as $key => $value ) {
                $instance['answer'][$key]    = $value;
            }
        }

        return $instance;
    }
    
}  // class Labtheme_FAQs_Widget