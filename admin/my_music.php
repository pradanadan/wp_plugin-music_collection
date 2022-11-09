<?php

function dnmc_setup_custom_post_my_music() {
    $labels = array (
        'name' => _x('Music', 'my_music'),
        'singular_name' => _x('Music', 'my_music'),
        'add_new' => _x('Add New Music', 'my_music'),
        'add_new_item' => __('Add New Music'),
        'edit_item' => __('Edit Music'),
        'new_item' => __('New Music'),
        'all_items' => __('All Music'),
        'view_item' => __('View Music'),
        'search_items' => __('Search Music'),
        'not_found' => __('No Music found'),
        'not_found_in_trash' => __('No Music found in Trash'),
        'oarent_item_colon' => '',
        'menu_name' => 'My Music' 
    );
    $args = array(
        'labels' => $labels,
        'description' => 'Music',
        'public' => true,
        'menu_position' => null,
        'supports' => array(null),
        'has_archive' => true,
        'menu_icon' => 'dashicons-playlist-audio'
    );
    register_post_type('my_music', $args);
}
add_action('init', 'dnmc_setup_custom_post_my_music');