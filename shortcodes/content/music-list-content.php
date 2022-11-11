<?php
$args = array(
	'post_type'      => 'my_music',
	'posts_per_page' => 10,
);
$loop = new WP_Query($args);
while ( $loop->have_posts() ) {
	$loop->the_post();
	?>
	<div class="entry-content">
		<?php the_title(); ?>
		<div><img src="<?php echo get_post_meta(get_the_ID() , 'dnmc_music_image', true)['url'] ?>" /></div>
	</div>
	<?php
}