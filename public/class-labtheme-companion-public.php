<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://labtheme.com/
 * @since      1.0.0
 *
 * @package    Labtheme_Companion
 * @subpackage Labtheme_Companion/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Labtheme_Companion
 * @subpackage Labtheme_Companion/public
 * @author     Lab Theme <info@labtheme.com>
 */
class Labtheme_Companion_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = LABTC_PLUGIN_VERSION;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Labtheme_Companion_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Labtheme_Companion_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name.'fontawesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.css', array(), $this->version, 'all' );
		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/labtheme-companion-public.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'lightslider', plugin_dir_url( __FILE__ ). 'css/lightslider.min.css', array(), '1.1.5', 'all' );
    		wp_enqueue_style( $this->plugin_name.'lightsidr', plugin_dir_url( __FILE__ ). 'css/jquery.sidr.light.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Labtheme_Companion_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Labtheme_Companion_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		$all = apply_filters('labtheme_all_enqueue',true);
		if($all == true)
		{
			wp_enqueue_script( 'all', plugin_dir_url( __FILE__ ) . 'js/fontawesome/all.min.js', array( 'jquery' ), '5.3.1', false );
		}

		$shims = apply_filters('labtheme_shims_enqueue',true);
		if($shims == true)
		{
			wp_enqueue_script( 'v4-shims', plugin_dir_url( __FILE__ ) . 'js/fontawesome/v4-shims.min.js', array( 'jquery' ), '5.3.1', false );
		}

		$isotope = apply_filters('labtheme_isotope_enqueue',true);
		if($isotope == true)
		{
        	wp_enqueue_script( 'isotope', plugin_dir_url( __FILE__ ) . 'js/jquery.isotope.min.js', array( 'jquery' ), '1.5.25', false );
        }

		$lightslider = apply_filters('labtheme_lightslider_enqueue',true);
		if($lightslider == true)
		{
        	wp_enqueue_script( 'lightslider', plugin_dir_url( __FILE__ ) . 'js/lightslider.min.js', array( 'jquery' ), '1.1.6', false );
        }

        wp_enqueue_script( 'labtheme-portfolio-settings', plugin_dir_url( __FILE__ ) . 'js/settings.min.js', array( 'jquery' ), $this->version, false );
        wp_enqueue_script( 'labtheme-portfolio-isotope', plugin_dir_url( __FILE__ ) . 'js/isotope.pkgd.min.js', array( 'jquery' ), $this->version, false );
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/labtheme-companion-public.min.js', array( 'jquery' ), $this->version, false );
	}

	function labtheme_js_defer_files($tag){
		$labtheme_assets = apply_filters('labtheme_public_assets_enqueue',true);

		if( is_admin() || $labtheme_assets == true ) return $tag;

		$async_files = apply_filters( 'labtheme_js_async_files', array(
			plugin_dir_url( __FILE__ ) . 'js/odometer.min.js', 
			plugin_dir_url( __FILE__ ) . 'js/waypoint.min.js',
			plugin_dir_url( __FILE__ ) . 'js/jquery.isotope.min.js',		
	        plugin_dir_url( __FILE__ ) . 'js/lightslider.min.js',
	        plugin_dir_url( __FILE__ ) . 'js/settings.min.js',
	        plugin_dir_url( __FILE__ ) . 'js/labtheme-companion-public.min.js',
	        plugin_dir_url( __FILE__ ) . 'js/isotope.pkgd.min.js',
	        plugin_dir_url( __FILE__ ) . 'js/jquery.magnific-popup.min.js',
	        plugin_dir_url( __FILE__ ) . 'js/fontawesome/all.min.js',
	        plugin_dir_url( __FILE__ ) . 'js/fontawesome/v4-shims.min.js'	
		 ) );
		
		$add_async = false;
		foreach( $async_files as $file ){
			if( strpos( $tag, $file ) !== false ){
				$add_async = true;
				break;
			}
		}

		if( $add_async ) $tag = str_replace( ' src', ' defer="defer" src', $tag );

		return $tag;
}

}
