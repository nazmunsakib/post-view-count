<?php
namespace PostViewCount\Frontend;

defined('ABSPATH') || die();

/**
 * Plugin View_Count class
 *
 * @package PostViewCount
 */
class View_Count {

    /**
	 * Shortcode constructor
	 */
	public function __construct() {
        add_action('wp_head', array( $this, 'view_count') );
	}

    /**
	 * Count post views.
	 *
	 * @return mixed
	 */
    public function view_count() {
        if ( ! is_single() ) {
            return;
        }

        $post_views = get_post_meta( get_the_ID(), 'post_view_count', true );
        $post_views = $post_views ? $post_views : 0;
        $post_views++;
        update_post_meta( get_the_ID(), 'post_view_count', $post_views );
    }
}