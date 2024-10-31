<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.pathwisesolutions.com
 * @since      1.0.0
 *
 * @package    Pws_Better_Widget_Title
 * @subpackage Pws_Better_Widget_Title/includes
 * @author     David He <david.he@pathwisesolutions.com>
 */
class Pws_Better_Widget_Title_i18n {
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'pws-better-widget-title',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}