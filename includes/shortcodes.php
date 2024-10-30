<?php
/**
 * Labtheme Custom Shortcodes
 *
 * @package Labtheme
 */

// Enable font size & font family selects in the editor
if ( ! function_exists( 'labtheme_mce_buttons' ) ) {
	function labtheme_mce_buttons( $buttons ) {
		array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
		return $buttons;
	}
}
add_filter( 'mce_buttons_2', 'labtheme_mce_buttons' );

// Customize mce editor font sizes
if ( ! function_exists( 'labtheme_mce_text_sizes' ) ) {
	function labtheme_mce_text_sizes( $initArray ){
		$initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
		return $initArray;
	}
}
add_filter( 'tiny_mce_before_init', 'labtheme_mce_text_sizes' );

// Add Formats Dropdown Menu To MCE
if ( ! function_exists( 'labtheme_style_select' ) ) {
	function labtheme_style_select( $buttons ) {
		array_push( $buttons, 'styleselect' );
		return $buttons;
	}
}
add_filter( 'mce_buttons', 'labtheme_style_select' );

// Register new button in the editor
function labtheme_register_mce_button( $buttons ) {
	array_push( $buttons, 'labtheme_mce_button' );
	return $buttons;
}
add_filter( 'mce_buttons', 'labtheme_register_mce_button' );


if ( ! function_exists( 'labtheme_paragraph_br_fix' ) ){
	function labtheme_paragraph_br_fix( $content, $paragraph_tag=false, $br_tag=false ){
		$content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );

		$content = preg_replace( '#<br \/>#', '', $content );

		if ( $paragraph_tag ) $content = preg_replace( '#<p>|</p>#', '', $content );

		return trim( $content );
	}
}

if ( ! function_exists( 'labtheme_content_helper' ) ){
	function labtheme_content_helper( $content, $paragraph_tag=false, $br_tag=false ){
		return labtheme_paragraph_br_fix( do_shortcode( shortcode_unautop( $content ) ), $paragraph_tag, $br_tag );
	}
}

/**********************LAYOUTS********************/

/**
 * Short Code for Grid Column 
 */
function labtheme_column_shortcode( $atts, $content=null ){
	extract( shortcode_atts( 
		array(
			'span' => '6',
			), $atts, 'labtheme_column'
    ) );
	$column = '<div class="labtheme_column labtheme-span' . esc_attr( $span ) . '">';
	$column .= labtheme_content_helper( $content );
	$column .= '</div>';
	return $column;
}
add_shortcode( 'labtheme_column', 'labtheme_column_shortcode' );

function labtheme_column_wrap_shortcode( $atts, $content=null ){
	$column_wrap = '<div class="clearfix labtheme-row">';
	$column_wrap .= labtheme_content_helper( $content );
	$column_wrap .= '</div>';
	return $column_wrap;
}
add_shortcode( 'labtheme_column_wrap', 'labtheme_column_wrap_shortcode' );

/**
 * Short Code for Divider 
 */
function labtheme_divider_shortcode( $atts ) { 
	extract( shortcode_atts( 
		array(
			'color'      => '#CCCCCC',
			'style'      => 'solid',
			'width'      => '100%',
			'thickness'  => '1px',
			'mar_top'    => '20px',
			'mar_bot'    => '20px',
			), $atts, 'labtheme_divider'
   ) );
	$divider = '<div class="divider" style="margin-top:' . esc_attr( $mar_top ) . '; margin-bottom:' . esc_attr( $mar_bot ) . '; border-top:' . esc_attr( $thickness ) . ' ' . esc_attr( $style ) . ' ' . esc_attr( $color ) . ';width:' . esc_attr( $width ) . '"/></div>';
	return $divider;
}
add_shortcode( 'labtheme_divider', 'labtheme_divider_shortcode' );

/**
 * Short Code for Spacing 
 */
function labtheme_spacing_shortcode( $atts ) { 
	extract( shortcode_atts( 
		array(
			'spacing_height' => '10px',
			), $atts, 'labtheme_spacing'
    ) );
	$spacing = '<div class="labtheme-spacing" style="height:' . esc_attr( $spacing_height ) . '"></div>';
	return $spacing;
}
add_shortcode( 'labtheme_spacing', 'labtheme_spacing_shortcode' );

/**********************LAYOUTS ENDS********************/


/**********************ELEMENTS********************/

/**
 * Short Code for Social Links 
 */
function labtheme_social_shortcodes( $atts ){
	extract( shortcode_atts( 
		array(
			'facebook'   => '',
			'twitter'    => '',
			'instagram'  => '',
            'gplus'      => '',
			'pinterest'  => '',
            'linkedin'   => '',
			'youtube'    => '',
			'vimeo'      => '',
            'dribbble'   => '',
            'foursquare' => '',
            'flickr'     => '',
            'reddit'     => '',
            'skype'      => '',
            'stumbleupon'=> '',
            'tumblr'     => '',
			), $atts, 'labtheme_social'
    ) );

	$social = '<div class="social-shortcode">';
	if( $facebook ){
	$social .= '<a href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
	}
	if( $twitter ){
	$social .= '<a href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i></a>';
	}
    if( $instagram ){
	$social .= '<a href="' . esc_url( $instagram ) . '" target="_blank"><i class="fa fa-instagram"></i></a>';
	}
	if( $gplus ){
	$social .= '<a href="' . esc_url( $gplus ) . '" target="_blank"><i class="fa fa-google-plus"></i></a>';
	}
	if( $pinterest ){
	$social .= '<a href="' . esc_url( $pinterest ) . '" target="_blank"><i class="fa fa-pinterest-p"></i></a>';
	}
    if( $linkedin ){
	$social .= '<a href="' . esc_url( $linkedin ) . '" target="_blank"><i class="fa fa-linkedin"></i></a>';
	}
	if( $youtube ){
	$social .= '<a href="' . esc_url( $youtube ) . '" target="_blank"><i class="fa fa-youtube"></i></a>';
	}
	if( $vimeo ){
	$social .= '<a href="' . esc_url( $vimeo ) . '" target="_blank"><i class="fa fa-vimeo"></i></a>';
	}
    if( $dribbble ){
	$social .= '<a href="' . esc_url( $dribbble ) . '" target="_blank"><i class="fa fa-dribbble"></i></a>';
	}
    if( $foursquare ){
	$social .= '<a href="' . esc_url( $foursquare ) . '" target="_blank"><i class="fa fa-foursquare"></i></a>';
	}
    if( $flickr ){
	$social .= '<a href="' . esc_url( $flickr ) . '" target="_blank"><i class="fa fa-flickr"></i></a>';
	}
    if( $reddit ){
	$social .= '<a href="' . esc_url( $reddit ) . '" target="_blank"><i class="fa fa-reddit"></i></a>';
	}
    if( $skype ){
	$social .= '<a href="' . esc_url( $skype ) . '"><i class="fa fa-skype"></i></a>';
	}
    if( $stumbleupon ){
	$social .= '<a href="' . esc_url( $stumbleupon ) . '" target="_blank"><i class="fa fa-stumbleupon"></i></a>';
	}
    if( $tumblr ){
	$social .= '<a href="' . esc_url( $tumblr ) . '" target="_blank"><i class="fa fa-tumblr"></i></a>';
	}
	$social .='</div>';
	return $social;
}
add_shortcode( 'labtheme_social', 'labtheme_social_shortcodes' );

/**
 * Short Code for Call To Action 
 */
function labtheme_call_to_action_shortcode( $atts, $content=null ){
	extract(shortcode_atts( 
		array(
			'title'       => __( 'Call to Action Title', 'labtheme-theme-toolkit-pro' ),
            'button_text' => __( 'View', 'labtheme-theme-toolkit-pro' ),
			'button_url'  => '#',
            'target'      => '_self',
			'button_align'=> 'center'
			), $atts, 'labtheme_call_to_action'));

	$call_to_action  = '<div class="labtheme_call_to_action clearfix ' . esc_attr( $button_align ) . '">';
	$call_to_action .='<div class="labtheme_call_to_action_content"><h3>' . esc_html( $title ) . '</h3>' . labtheme_content_helper( $content ) . '</div>';
	$call_to_action .='<a href="' . esc_url( $button_url ) . '" target="' . esc_attr( $target ) . '" class="labtheme_call_to_action_button">' . esc_html( $button_text ) . '</a>';
	$call_to_action .='</div>';
	return $call_to_action;
}
add_shortcode( 'labtheme_call_to_action', 'labtheme_call_to_action_shortcode' );

/**
 * Short Code for Slider 
 */
function labtheme_slide_shortcode( $atts, $content=null ){
	extract(shortcode_atts( 
		array(
			'caption' => '',
			'link' => '',
			'target' => '_self'
			), $atts, 'labtheme_slide'
    ));
            
	$slide = '<li class="labtheme-slide">';
	if( $link ) $slide .= '<a href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '">';
	
	$slide .= '<img title="' . esc_attr( $caption ) . '" src="' . esc_url( $content ) . '">';
	if( $caption ) $slide .= '<p class="flex-caption">' . esc_html( $caption ) . '</p>';
    if( $link ) $slide .= '</a>';
	
	$slide .= '</li>';
	
    return $slide;
}
add_shortcode( 'labtheme_slide', 'labtheme_slide_shortcode' );

function labtheme_slider_shortcode( $atts, $content=null ){
	$slider = '<div class="shortcode-slider"><ul class="slides">';
	$slider .= labtheme_content_helper( $content );
	$slider .= '</ul></div>';
	return $slider;
}
add_shortcode( 'labtheme_slider', 'labtheme_slider_shortcode' );

/**
 * Short Code for Toggle 
 */
function labtheme_toggle_shortcode( $atts, $content=null ){
	extract(shortcode_atts( 
		array(
			'title' => '',
			'status' => 'close'
			), $atts, 'labtheme_toggle'
    ));

	$accordion  = '<div class="labtheme_toggle ' . esc_attr( $status ) . '">';
	$accordion .='<div class="labtheme_toggle_title">' . esc_html( $title ) . '</div>';
	$accordion .='<div class="labtheme_toggle_content clearfix">' . labtheme_content_helper( $content ) . '</div>';
	$accordion .='</div>';
	return $accordion;
}
add_shortcode( 'labtheme_toggle', 'labtheme_toggle_shortcode' );

/**
 * Short Code for Tabs 
 */
function labtheme_tab_shortcode( $atts, $content=null ){
	extract(shortcode_atts( 
		array(
			'title' => '',
			), $atts, 'labtheme_tab'
    ));

	$tab  ='<div class="labtheme_tab ' . sanitize_title( $title ) . '">';
	$tab .='<div class="tab-title" id="' . sanitize_title( $title ) . '">' . esc_html( $title ) . '</div>';
	$tab .= labtheme_content_helper( $content );
	$tab .='</div>';
	return $tab;
}
add_shortcode( 'labtheme_tab', 'labtheme_tab_shortcode' );

function labtheme_tab_wrap_shortcode( $atts, $content=null ){
	extract(shortcode_atts( 
		array(
			'type' => 'horizontal',
			), $atts, 'labtheme_tab_group'
    ));
	$tab_wrap = '<div class="clearfix labtheme_tab_wrap ' . esc_attr( $type ) . '">';
	$tab_wrap .= labtheme_content_helper( $content );
	$tab_wrap .= '</div>';
	return $tab_wrap;
}
add_shortcode( 'labtheme_tab_group', 'labtheme_tab_wrap_shortcode' );

/**
 * Short Code for List Items 
 */
function labtheme_list_shortcode( $atts, $content=null ){
    extract(shortcode_atts( 
		array(
			'list_type' => 'labtheme-list-style1',
			), $atts, 'labtheme_list'
    ));
	$list = '<ul class="labtheme-list ' . esc_attr( $list_type ) . '">';
	$list .= labtheme_content_helper( $content );
	$list .= '</ul>';
	return $list;
}
add_shortcode( 'labtheme_list', 'labtheme_list_shortcode' );

function labtheme_li_shortcode( $atts, $content=null ){
	$li = '<li>';
	$li .= labtheme_content_helper( $content );
	$li .= '</li>';
	return $li;
}
add_shortcode( 'labtheme_li', 'labtheme_li_shortcode' );

/**
 * Short Code for Accordian 
 */
function labtheme_accordian_shortcode( $atts, $content=null ){
	extract(shortcode_atts( 
		array(
			'title' => '',			
			), $atts, 'labtheme_accordian'
    ));
	$accordion = '<div class="labtheme_accordian">';
	$accordion .='<div class="labtheme_accordian_title">' . esc_html( $title ) . '</div>';
	$accordion .='<div class="labtheme_accordian_content">' . labtheme_content_helper( $content ) . '</div>';
	$accordion .='</div>';
	return $accordion;
}
add_shortcode( 'labtheme_accordian', 'labtheme_accordian_shortcode' );

function labtheme_accordian_shortcode_wrap( $atts, $content=null ){	
	return '<div class="accordion-wrap">' . labtheme_content_helper( $content ) . '</div>';
}
add_shortcode( 'labtheme_accordian_wrap', 'labtheme_accordian_shortcode_wrap' );

/**
 * Short Code for Dropcap 
 */
function labtheme_drop_cap_shortcode( $atts, $content=null ){
	extract(shortcode_atts( 
		array(
			'font_size' => 'labtheme-drop-cap2',
			), $atts, 'labtheme_drop_cap'
    ));

	$drop_cap = '<span class="' . esc_attr( $font_size ) . '">';
	$drop_cap .= wp_kses_post( $content );
	$drop_cap .='</span>';
	return $drop_cap;
}

add_shortcode( 'labtheme_drop_cap', 'labtheme_drop_cap_shortcode' );