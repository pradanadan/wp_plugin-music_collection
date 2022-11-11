<?php
$args = array(
	'post_type'      => 'my_music',
	'posts_per_page' => 10,
);
$loop = new WP_Query($args); ?>
<div class="container">
    <div class="row d-flex flex-row">
        <?php
        while ( $loop->have_posts() ) {
            $loop->the_post();
            ?>
            <div class="col-lg-5 mx-3 musicCard">
            <a href="<?php echo get_post_permalink(); ?>">
                <h4>
                    <?php the_title(); ?>
                </h4>
                <img src="<?php echo get_post_meta(get_the_ID() , 'dnmc_music_image', true)['url'] ?>" />
            </a>
            </div>
            <?php
        } ?>
    </div>
</div>