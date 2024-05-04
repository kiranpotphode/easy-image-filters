<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://kiranpotphode.com/
 * @since             1.0.0
 * @package           Easy_Image_Filters
 *
 * @wordpress-plugin
 * Plugin Name:       Easy Image Filters
 * Plugin URI:        https://wordpress.org/plugins/easy-image-filters
 * Description:       Add cool filters and effects to images without leaving site admin screen. Save new image without loosing original.
 * Version:           1.0.3
 * Author:            Kiran Potphode
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       easy-image-filters
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-easy-image-filters-activator.php
 */
function activate_easy_image_filters() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-easy-image-filters-activator.php';
	Easy_Image_Filters_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-easy-image-filters-deactivator.php
 */
function deactivate_easy_image_filters() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-easy-image-filters-deactivator.php';
	Easy_Image_Filters_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_easy_image_filters' );
register_deactivation_hook( __FILE__, 'deactivate_easy_image_filters' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-easy-image-filters.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_easy_image_filters() {

	$plugin = new Easy_Image_Filters();
	$plugin->run();

}
run_easy_image_filters();
