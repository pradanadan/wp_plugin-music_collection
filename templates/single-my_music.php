<?php get_header();
	global $post;
	$post_id = $post->ID;
    $post_meta = get_post_meta($post_id)
?>
    <div class="container" >
        <div class="row">
            <div class="col-lg-4 d-flex flex-row-reverse">
                <div><img src="<?php echo get_post_meta($post_id , 'dnmc_music_image', true)['url'] ?>" /></div>
            </div>
            <div class="col-lg-8 px-4">
                <h1><?php echo $post->post_title ?></h1>
                <p><?php echo $post_meta['dnmc_music_album'][0] ?></p>
                <audio controls>
                    <source src="<?php echo get_post_meta($post_id , 'dnmc_music_file', true)['url'] ?>" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </div>
    </div>
<?php get_footer(); ?>