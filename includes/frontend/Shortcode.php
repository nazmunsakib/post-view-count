<?php
namespace PostViewCount\Frontend;

defined('ABSPATH') || die();

/**
 * Plugin Shortcode class
 *
 * @package PostViewCount
 */
class Shortcode {

    /**
	 * Shortcode constructor
	 */
	public function __construct() {
        add_shortcode('post_view_count', array( $this, 'display_post_views' ));
	}

    /**
	 * Display related posts bottom of each post
     * @param $atts
	 *
	 */
    public function display_post_views( $atts ) {

        $default_value = array(
            'post_id' => 0,
        );

        $settings = shortcode_atts( $default_value, $atts );

        ob_start();
    
        $post_id = intval( $settings['post_id'] );
        wp_enqueue_style('post-view-count');
        ?>
        <section class="pvc-post-count-wrapper">
            <div class="pvc-container">
                <div class="pcc-card">
                    <?php 
                        if( $post_id > 0 ) : 
                            $post_views = get_post_meta( $post_id, 'post_view_count', true );
                            $total_count = $post_views ? $post_views : 0;
                            ?>
                            <div class="pvc-section-head">
                                <span class="dashicons dashicons-plus-alt"></span>
                                <h3 class="pvc-section-title"><?php _e('Post View Count', 'post-view-count' ); ?></h3>
                            </div>
                            <p class="pvc-total-count"><?php _e('Total Post Views:', 'post-view-count' ); ?> <span><?php echo esc_html( $total_count ); ?></span></p>
                    <?php else : ?>
                        <p class="pvc-total-count"><?php _e( 'Invalid post ID', 'post-view-count' ); ?></span></p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
        <?php
        return ob_get_clean();
    } 
}