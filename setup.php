<?php
// Activate the plugin.
function dnmc_activate() { 
	dnmc_setup_custom_post_my_music(); 
	flush_rewrite_rules( false ); 
}
register_activation_hook( __FILE__, 'dnmc_activate' );


// Deactivation hook.
function dnmc_deactivate() {
	unregister_post_type( 'my_music' );
	flush_rewrite_rules( false );
}
register_deactivation_hook( __FILE__, 'dnmc_deactivate' );


// Register My Music custom post type
require_once( DNMC_PATH.'/admin/my_music.php' );

// Add metaboxes to My Music
require_once( DNMC_PATH.'/admin/my_music-metabox.php' );


// Filter My Music template
add_filter( 'single_template', 'dnmc_my_music_front_template', 11);
function dnmc_my_music_front_template($single_template){
	global $post;

	if (isset($post->post_type) && $post->post_type == 'my_music') {
		$single_template = DNMC_PATH . '/templates/single-my_music.php';
	}

	return $single_template;
}