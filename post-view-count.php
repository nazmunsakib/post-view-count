<?php
/*
Plugin Name: Post View Count
Plugin URI: https://nazmunsakib.co/
Description: Display Post Or Page visitor view
Version: 1.0.0
Author: Nazmun Sakib
Author URI: https://nazmunsakib.com
License: GPL2
Text Domain: post-view-count
Domain Path: /languages
*/

defined('ABSPATH') || die();

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Post_view_Count class.
 *
 * @class Post_view_Count class
 */
final class Post_View_Count {

    /**
	 * Plugin instance
	 */
    private static $instance = null;

    /**
	 * Plugin version.
	 */
    private static $version = '1.0.0';

    /**
     * Class constructor.
     * 
     * @access private
     */
    private function __construct() {
        $this->add_hooks();
    }

    /**
     * Initializes the Post_View_Count() class.
     *
     * Checks for an existing Post_View_Count() instance
     * 
     *  @since 1.0.0
     *
	 * @access public
	 * @static
	 *
	 * @return Post_View_Count
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

    /**
     * Define plugin constants.
     * 
     * @since 1.0.0
     *
     * @return void
     */
    public function define_const() {
        define( 'PVC_VERSION', self::$version );
        define( 'PVC_FILE', __FILE__ );
        define( 'PVC_PATH', __DIR__ );
        define( 'PVC_URL', plugins_url( '', PVC_FILE ) );
        define( 'PVC_ASSETS', PVC_URL . '/assets' );
    }

    /**
     * Add Hooks.
     * 
     * @since 1.0.0
     * 
     * @return void
     */
    public function add_hooks() {
        add_action( 'init', array( $this, 'load_textdomain' ) );
        add_action('plugins_loaded', array( $this, 'init') );
    }

    /**
     * Plugins loaded.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function init() {
        $this->define_const();
        $this->includes();
    }

    /**
     * Includes classes.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function includes() {
        new PostViewCount\Enqueue();
        new PostViewCount\Frontend\View_Count();
        new PostViewCount\Frontend\Shortcode();

        if( is_admin() ){
            new PostViewCount\Admin\Custom_Columns();
        }
    }

    /**
     * Load Plugin Text domain.
     *
     * @uses load_plugin_textdomain()
     */
    public function load_textdomain() {
        load_plugin_textdomain( 'post-view-count', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }

}

/**
 * Initialize Post_View_Count().
 * 
 * @since 1.0.0
 *
 * @return \Post_View_Count
 */
function post_view_count() {
    return Post_View_Count::instance();
}

//run the plugin
post_view_count();
