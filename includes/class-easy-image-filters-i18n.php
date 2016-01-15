<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://kiranpotphode.com/
 * @since      1.0.0
 *
 * @package    Easy_Image_Filters
 * @subpackage Easy_Image_Filters/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Easy_Image_Filters
 * @subpackage Easy_Image_Filters/includes
 * @author     Kiran Potphode <kiranpotphode15@gmail.com>
 */
class Easy_Image_Filters_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'easy-image-filters',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
