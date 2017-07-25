<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.northstarmarketing.com
 * @since      1.0.0
 *
 * @package    Ada_Youtube_Embedder
 * @subpackage Ada_Youtube_Embedder/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ada_Youtube_Embedder
 * @subpackage Ada_Youtube_Embedder/admin
 * @author     North Star Marketing <tech@northstarmarketing.com>
 */
class Ada_Youtube_Embedder_Admin {

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
		
		// Register the youtube shortcode
		add_shortcode( 'youtube', array( $this, 'nsm_youtube_embed') );

		// Add a button to tinyMCE that imports the shortcode automatically
		add_action( 'init', array( $this, 'youtube_shortcode') );
		

	}
	
	/*
   * Handles the shortcode
	 */
	public function nsm_youtube_embed( $atts ) {

		// Attributes
		$atts = ( shortcode_atts(
			array(
				'src' => '',
				'title' => '',
				'alt' => '',
			),
			$atts
		));

		$title = $atts['title'];
	  $alt = $atts['alt'];
	  preg_match('~(?:youtube(?:-nocookie)?\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})~', $atts['src'], $matches);
		$src = $matches[1];
	  
	  $content = '<div class="fve-video-wrapper fve-image-embed fve-thumbnail-image youtube" style="padding-bottom:56.25%;">';
	  $content .= '<iframe src="//www.youtube.com/embed/'. $src .'?wmode=transparent&amp;modestbranding=1&amp;autohide=1&amp;showinfo=0&amp;rel=0" title="'. $title .'" alt="'. $alt .'" width="100%" height="100%" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>';
	  $content .= '</div>';
	  
	  return $content;

	}
	
	public function youtube_shortcode() {
	    add_filter( "mce_external_plugins", array( $this, "nsm_add_youtube_shortcode" ) );
	    add_filter( 'mce_buttons', array( $this, 'nsm_register_youtube_shortcode' ) );
	}

	public function nsm_add_youtube_shortcode( $plugin_array ) {
	    $plugin_array['nsm'] = plugin_dir_url( dirname( __FILE__ ) ) . 'admin/js/youtube-plugin.js';
	    return $plugin_array;
	}

	public function nsm_register_youtube_shortcode( $buttons ) {
	    array_push( $buttons, 'youtube');
	    return $buttons;
	}
	
	public function enqueue_styles() {
		
	}
	
	public function enqueue_scripts() {
		
	}

}
