<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.pathwisesolutions.com
 * @since             1.0.0
 * @package           Pws_Better_Widget_Title
 *
 * @wordpress-plugin
 * Plugin Name:       PWS Better Widget Title
 * Plugin URI:        https://wordpress.org/plugins/pws-better-widget-title/
 * Description:       Hide widget titles that are inside the square brackets, "[]". Handles multiple occurrence. Compatible with WordPress version 3.0+.
 * Version:           1.0.4
 * Author:            David He
 * Author URI:        https://davidhe2018.wordpress.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pws-better-widget-title
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
define( 'PWS_BETTER_WIDGET_TITLE_VERSION', '1.0.4' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pws-better-widget-title-activator.php
 */
function activate_pws_better_widget_title() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pws-better-widget-title-activator.php';
	Pws_Better_Widget_Title_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pws-better-widget-title-deactivator.php
 */
function deactivate_pws_better_widget_title() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pws-better-widget-title-deactivator.php';
	Pws_Better_Widget_Title_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pws_better_widget_title' );
register_deactivation_hook( __FILE__, 'deactivate_pws_better_widget_title' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pws-better-widget-title.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pws_better_widget_title() {

	$plugin = new Pws_Better_Widget_Title();
	$plugin->run();

}
run_pws_better_widget_title();
