<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.pathwisesolutions.com
 * @since      1.0.0
 *
 * @package    Pws_Better_Widget_Title
 * @subpackage Pws_Better_Widget_Title/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pws_Better_Widget_Title
 * @subpackage Pws_Better_Widget_Title/admin
 * @author     David He <david.he@pathwisesolutions.com>
 */
class Pws_Better_Widget_Title_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
	/**
	 * Replace the string between two markers.
	 *
	 * @since     1.0.0
	 * @param     string    $original_text  	The string to be updated.
	 * @param     string    $marker_a			The starting marker.
	 * @param     string    $marker_b     		The ending marker.
	 * @param     string    $replacement    	The replacement string.
	 * @param     boolean   $remove_markers		Remove markers.
	 * @param     int    	$indx_a      		The point to start from.
	 * @param     boolean   $is_multiple     	Replace multiple occurances.
	 * @return    string    Updated string.
	 */
	private function replace_between($original_text, $marker_a, $marker_b, $replacement, $remove_markers = false, $indx_a = 0, $is_multiple = false) {
		if ($indx_a >= mb_strlen($original_text)) {
			return $original_text;
		}
		$pos_start = mb_strpos($original_text, $marker_a, $indx_a);
		if ($pos_start === false) {
			return $original_text;
		}
		$start = $pos_start + ($remove_markers ? 0 : mb_strlen($marker_a));
		$pos_end = mb_strpos($original_text, $marker_b, $start);
		if ($pos_end === false) {
			return $original_text;
		}
		$length = $pos_end - $start + ($remove_markers ? mb_strlen($marker_b) : 0);
		$result = substr_replace($original_text, $replacement, $start, $length);
		if ($is_multiple) {
			$temp_indx = $start + mb_strlen($replacement) + mb_strlen($marker_b);
			if ($temp_indx >= mb_strlen($original_text)) {
				return $result;
			}
			return $this->replace_between($result, $marker_a, $marker_b, $replacement, $remove_markers, $temp_indx, true);
		}
		return $result;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pws_Better_Widget_Title_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pws_Better_Widget_Title_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pws-better-widget-title-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pws_Better_Widget_Title_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pws_Better_Widget_Title_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pws-better-widget-title-admin.js', array( 'jquery' ), $this->version, false );

	}
	/**
	 * Only display the widget title outside of square brackets, "[]"
	 * For instance, Widget Title:  Contact [Button Version] Dan Bashaw – 'Contact Dan Bashaw' will show on the front end. 
	 * 'Button version' will not show. 
	 * Widget Title: [Contact Dan Bashaw] – Nothing will show on the front end.
	 * Widget Title: Contact [Dan Bashaw] – 'Contact' will show on the front end. Dan Bashaw will not show.
	 * Widget Title: Contact [Dan] Support [Bashaw] – 'Contact Support' will show on the front end. 
	 *
	 * @since     1.0.0
	 * @param     string    $wt       The title of the widget.
	 * @return    string    The title of the widget.
	 */
	public function do_widget_title_process($wt){
		return $this->replace_between($wt, '[', ']', '', true, 0, true);
	}
}