<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.northstarmarketing.com
 * @since      1.0.0
 *
 * @package    Ada_Youtube_Embedder
 * @subpackage Ada_Youtube_Embedder/includes
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
 * @package    Ada_Youtube_Embedder
 * @subpackage Ada_Youtube_Embedder/includes
 * @author     North Star Marketing <tech@northstarmarketing.com>
 */
class Ada_Youtube_Embedder {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Ada_Youtube_Embedder_Loader    $loader    Maintains and registers all hooks for the plugin.
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

		$this->plugin_name = 'ada-youtube-embedder';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Ada_Youtube_Embedder_Loader. Orchestrates the hooks of the plugin.
	 * - Ada_Youtube_Embedder_i18n. Defines internationalization functionality.
	 * - Ada_Youtube_Embedder_Admin. Defines all hooks for the admin area.
	 * - Ada_Youtube_Embedder_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ada-youtube-embedder-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-ada-youtube-embedder-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ada-youtube-embedder-admin.php';
		
		/**
		 * The class responsible for updating the plugin when github repo is updated.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'updater/updater.php';
		
		if ( is_admin() ) { // note the use of is_admin() to double check that this is happening in the admin
			$config = array(
				'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
				'proper_folder_name' => 'ada-youtube-embedder', // this is the name of the folder your plugin lives in
				'api_url' => 'https://api.github.com/repos/NorthStarMarketing/ADA-Youtube-Embedder', // the GitHub API url of your GitHub repo
				'raw_url' => 'https://raw.github.com/NorthStarMarketing/ADA-Youtube-Embedder/master', // the GitHub raw url of your GitHub repo
				'github_url' => 'https://github.com/NorthStarMarketing/ADA-Youtube-Embedder', // the GitHub url of your GitHub repo
				'zip_url' => 'https://github.com/NorthStarMarketing/ADA-Youtube-Embedder/zipball/master', // the zip url of the GitHub repo
				'sslverify' => true, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
				'requires' => '3.0', // which version of WordPress does your plugin require?
				'tested' => '3.3', // which version of WordPress is your plugin tested up to?
				'readme' => 'readme.md', // which file to use as the readme for the version number
				'access_token' => '', // Access private repositories by authorizing under Appearance > GitHub Updates when this example plugin is installed
			);
			new WP_GitHub_Updater($config);
		}

		$this->loader = new Ada_Youtube_Embedder_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Ada_Youtube_Embedder_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Ada_Youtube_Embedder_i18n();

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

		$plugin_admin = new Ada_Youtube_Embedder_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

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
	 * @return    Ada_Youtube_Embedder_Loader    Orchestrates the hooks of the plugin.
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
