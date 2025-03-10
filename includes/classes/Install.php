<?php 

namespace PostAggregator\Classes;

use PostAggregator\Trait\Hook;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Install {
    use Hook;

    public static function init() {
        $self = new self();
        $self->action( 'init', [$self, 'register_post_type'] );
    }

    public function register_post_type() {
        $args = array(
            'labels' => array(
                'name'               => 'Aggregated Contents',
                'singular_name'      => 'Aggregated Content',
                'add_new'            => 'Add New',
                'add_new_item'       => 'Add New Content',
                'edit_item'          => 'Edit Content',
                'new_item'           => 'New Content',
                'view_item'          => 'View Content',
                'search_items'       => 'Search Content',
                'not_found'          => 'No content found',
                'not_found_in_trash' => 'No content found in Trash',
                'all_items'          => 'All Contents',
                'menu_name'          => 'Aggregated Content',
                'name_admin_bar'     => 'Aggregated Content',
            ),
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_rest'        => true,
            'supports'            => array( 'title', 'editor', 'thumbnail' ),
            'has_archive'         => true,
            'rewrite'             => array( 'slug' => 'aggregated-content' ),
            'menu_icon'           => 'dashicons-media-text',
        );
        
        register_post_type( 'aggregated-content', $args );
    }

}