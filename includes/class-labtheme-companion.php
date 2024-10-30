<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://labtheme.com/
 * @since      1.0.0
 *
 * @package    Labtheme_Companion
 * @subpackage Labtheme_Companion/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Labtheme_Companion
 * @subpackage Labtheme_Companion/includes
 * @author     Lab Theme <info@labtheme.com>
 */
class Labtheme_Companion {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Labtheme_Companion_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'LABTC_PLUGIN_VERSION' ) ) {
			$this->version = LABTC_PLUGIN_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'labtheme-companion';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Labtheme_Companion_Loader. Orchestrates the hooks of the plugin.
	 * - Labtheme_Companion_i18n. Defines internationalization functionality.
	 * - Labtheme_Companion_Admin. Defines all hooks for the admin area.
	 * - Labtheme_Companion_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-labtheme-companion-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-labtheme-companion-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-labtheme-companion-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-labtheme-companion-public.php';

		/**
		 * include custom post type
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/custom/class-labtheme-companion-custom-post-type.php';

		/**
		 * include custom metabox
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/custom/class-labtheme-companion-custom-metabox.php';

		
		require_once LABTC_BASE_PATH . '/includes/meta-parts/labtheme-image-upload-taxononmy.php';

		/**
		 * The class responsible for defining all the required functions.
		 */
		include LABTC_BASE_PATH . '/includes/class-labtheme-companion-functions.php';

		/**
		 *  widget.
		 */
		require_once LABTC_BASE_PATH . '/includes/widgets/widgets.php';

		/**
		 * Shortcodes
		 */
		require LABTC_BASE_PATH . '/includes/shortcodes.php';

		$this->loader = new Labtheme_Companion_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Labtheme_Companion_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Labtheme_Companion_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Labtheme_Companion_Admin( $this->get_plugin_name(), $this->get_version() );

		// $this->loader->add_action( 'admin_menu', $plugin_admin, 'labtheme_remove_metaboxes' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_footer',  $plugin_admin, 'labtheme_team_social_template' );
		$this->loader->add_action( 'admin_print_footer_scripts', $plugin_admin, 'labtheme_faq_template' );
		$this->loader->add_action( 'admin_print_footer_scripts', $plugin_admin, 'labtheme_client_logo_template' );
		$this->loader->add_action( 'admin_footer',  $plugin_admin,'labtheme_client_logo_template', 0 );
		$this->loader->add_action( 'admin_print_footer_scripts', $plugin_admin, 'labtheme_icon_list_enqueue' );
		$this->loader->add_filter( 'mce_external_plugins', $plugin_admin, 'labtheme_add_tinymce_plugin' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'labtheme_enable_pages' );
		$this->loader->add_action( 'admin_init', $plugin_admin, 'labtheme_register_settings' );
		$this->loader->add_filter( 'option_page_capability_labtheme_descriptions', $plugin_admin, 'labtheme_allow_edit_posts' );
		$this->loader->add_action( 'admin_bar_menu', $plugin_admin, 'labtheme_admin_bar_links',  100);
		$this->loader->add_filter( 'get_the_archive_description', $plugin_admin, 'labtheme_archive_description' );
		if ( ! defined( 'QTX_VERSION' ) ) {
			$this->loader->add_filter( 'labtheme_wp_editor_settings', $plugin_admin, 'labtheme_qtranslate_editor_args' );
			$this->loader->add_filter( 'qtranslate_load_admin_page_config', $plugin_admin, 'labtheme_qtranslate_support', 99); // 99 priority is important, loaded after registered post types
		}
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'labtheme_create_boxes' );
		$this->loader->add_action( 'save_post', $plugin_admin, 'labtheme_save_meta_box_data' );

		$plugin_admin_post_type = new Labtheme_Companion_Admin_Post_Type( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'init', $plugin_admin_post_type, 'labtheme_register_post_types' );
		$this->loader->add_action( 'init', $plugin_admin_post_type, 'labtheme_create_post_type_taxonomies', 0 );
		$this->loader->add_action( 'init', $plugin_admin_post_type, 'labtheme_create_post_type_taxonomies_tags', 0 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Labtheme_Companion_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_filter( 'script_loader_tag', $plugin_public, 'labtheme_js_defer_files', 10 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Labtheme_Companion_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
