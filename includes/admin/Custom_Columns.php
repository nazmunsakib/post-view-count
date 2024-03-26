<?php
namespace PostViewCount\Admin;

defined('ABSPATH') || die();

/**
 * Plugin Custom_Columns class
 *
 * @package PostViewCount
 */
class Custom_Columns {

    /**
	 * Shortcode constructor
	 */
	public function __construct() {
        add_filter('manage_posts_columns', array( $this, 'manage_posts_columns_handler' ) );
        add_filter('manage_posts_custom_column', array( $this, 'manage_posts_custom_column_handler' ), 10, 2 );
        add_filter('manage_edit-post_sortable_columns', array( $this, 'sortable_column_handler' ) );
        add_filter( 'request', array( $this, 'views_columns_orderby'));
	}

    /**
	 * Manage custom post columns.
     * 
     * @param $columns
	 *
	 */
    public function manage_posts_columns_handler( $columns ) {
        $custom_columns = [];

        foreach ( $columns as $key => $value ) {
            $custom_columns[$key] = $value;

            if ( $key == 'title' ) {
                $custom_columns['post_views'] = __('Post Views', 'post-view-count');
            }
        }

        return $custom_columns;
    }

    /**
	 * Manage custom post columns.
     * 
     * @param $columns
     * @param $id
	 *
	 */
    public function manage_posts_custom_column_handler( $column, $id ) {

        if ( $column == 'post_views' ) {
            $total_count = get_post_meta( $id, 'post_view_count', true );
            $total_count = $total_count ? $total_count : 0;
            echo esc_html( $total_count );
        }
    }

    /**
	 * post views columns sortable.
     * 
     * @param $columns
     * @param $id
	 *
	 */
    public function sortable_column_handler( $columns ) {
        $columns['post_views'] = array('post_views', true); //__('Post Views', 'post-view-count');
        return $columns;
    }

     /**
	 * Evaluate the meta as a number
     * 
     * @param $vars
	 *
	 */
    public function views_columns_orderby( $vars ) {
        if ( isset( $vars['orderby'] ) && 'post_views' === $vars['orderby'] ) {
            $vars = array_merge( $vars,
                array(
                    'meta_key' => 'post_view_count',
                    'orderby'  => 'meta_value_num',
                )
            );
        }
        return $vars;
    }

}