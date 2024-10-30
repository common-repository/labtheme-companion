<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://labtheme.com/
 * @since             1.0.0
 * @package           Labtheme_Companion
 *
 * @wordpress-plugin
 * Plugin Name:       LabTheme Companion
 * Plugin URI:        https://wordpress.org/plugins/labtheme-companion
 * Description:       Labtheme Companion is a lightweight and safe premium plugin. The plugin generates seven custom post types (FAQs, Clients, Events, Services, Portfolios, Team, Courses and Testimonials), exclusive widgets, and some useful shortcodes.
 * Version:           1.0.2
 * Author:            Lab Theme
 * Author URI:        http://labtheme.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       labtheme-companion
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LABTC_PLUGIN_VERSION', '1.0.2' );
define( 'LABTC_BASE_PATH', dirname( __FILE__ ) );
define( 'LABTC_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'LABTC_TEMPLATE_PATH', LABTC_BASE_PATH.'/includes/labtheme-templates' );
define( 'LABTC_FILE_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-labtheme-companion-activator.php
 */
function activate_labtheme_companion() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-labtheme-companion-activator.php';
	Labtheme_Companion_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-labtheme-companion-deactivator.php
 */
function deactivate_labtheme_companion() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-labtheme-companion-deactivator.php';
	Labtheme_Companion_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_labtheme_companion' );
register_deactivation_hook( __FILE__, 'deactivate_labtheme_companion' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-labtheme-companion.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_labtheme_companion() {

	$plugin = new Labtheme_Companion();
	$plugin->run();

}
run_labtheme_companion();
