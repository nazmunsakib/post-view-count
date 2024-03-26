<?php
/**
 * Plugin Enqueue Assets.
 *
 * @package Enqueue
 */
namespace PostViewCount;

defined('ABSPATH') || die();

class Enqueue {

	/**
	 * Class constructor.
	 */
	public function __construct() {
		add_action('wp_enqueue_scripts', array( $this, 'frontend_enqueue' ), 100 );
	}

	/**
	 * Enqueue frontend assets.
	 *
	 * Frontend assets handler
	 *
	 * @return void
	 */
	public function frontend_enqueue() {
		wp_register_style(
			'post-view-count',
			PVC_ASSETS . '/css/frontend-style.css',
			null,
			PVC_VERSION
		);
	}

}