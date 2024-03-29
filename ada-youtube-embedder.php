<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.northstarmarketing.com
 * @since             1.0.0
 * @package           Ada_Youtube_Embedder
 *
 * @wordpress-plugin
 * Plugin Name:       ADA Youtube Embedder
 * Plugin URI:        http://www.northstarmarketing.com
 * Description:       Adds a button to the TinyMCE editor that embeds a youtube video that complies with ADA standards.
 * Version:           1.0.0
 * Author:            North Star Marketing
 * Author URI:        http://www.northstarmarketing.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ada-youtube-embedder
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ada-youtube-embedder-activator.php
 */
function activate_ada_youtube_embedder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ada-youtube-embedder-activator.php';
	Ada_Youtube_Embedder_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ada-youtube-embedder-deactivator.php
 */
function deactivate_ada_youtube_embedder() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ada-youtube-embedder-deactivator.php';
	Ada_Youtube_Embedder_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ada_youtube_embedder' );
register_deactivation_hook( __FILE__, 'deactivate_ada_youtube_embedder' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ada-youtube-embedder.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ada_youtube_embedder() {

	$plugin = new Ada_Youtube_Embedder();
	$plugin->run();

}
run_ada_youtube_embedder();
