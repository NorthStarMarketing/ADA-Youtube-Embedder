<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.northstarmarketing.com
 * @since      1.0.0
 *
 * @package    Ada_Youtube_Embedder
 * @subpackage Ada_Youtube_Embedder/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ada_Youtube_Embedder
 * @subpackage Ada_Youtube_Embedder/includes
 * @author     North Star Marketing <tech@northstarmarketing.com>
 */
class Ada_Youtube_Embedder_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ada-youtube-embedder',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
