<?php get_header();
	global $post;
	$post_id = $post->ID;
    $post_meta = get_post_meta($post_id)
?>
    <h1><?php echo $post->post_title ?></h1>
    <img src="<?php echo get_post_meta($post_id , 'dnmc_music_image', true)['url'] ?>" />
    <p>Album: <?php echo $post_meta['dnmc_music_album'][0] ?></p>
    <audio controls>
        <source src="<?php echo get_post_meta($post_id , 'dnmc_music_file', true)['url'] ?>" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
<?php get_footer(); ?>