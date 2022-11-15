<?php get_header();
	global $post;
	$post_id = $post->ID;
    $post_meta = get_post_meta($post_id)
?>
    <div class="c-containter">
        <div class="music-container">
            <section class="album-cover">
                
                <button class="arrow left" id="prev">
                    <img src="https://snowleo208.github.io/100-Days-of-Code/7.%20Music%20Player/img/arrow_left.svg" alt="Next Music">
                </button>
                <img src="<?php echo get_post_meta($post_id , 'dnmc_music_image', true)['url'] ?>" class="cover" alt="From One To Nine by Marcel Pequel">
                
                <button class="arrow right" id="next">
                    <img src="https://snowleo208.github.io/100-Days-of-Code/7.%20Music%20Player/img/arrow_right.svg" alt="Next Music">
                </button>
            </section>
            <section class="music-player">
                <h1 class="music-player__title"></h1>
                <h2 class="music-player__author"></h2>
                <div class="music-time">
                    <p class="music-time__current"></p>
                    <p class="music-time__last"></p>
                </div>
                <div class="music-bar" id="progress">
                    <div id="length"></div>
                </div>
                <div class="music-order">
                    <div class="music-order__loop is-loop" id="loop">
                        <img src="https://snowleo208.github.io/100-Days-of-Code/7.%20Music%20Player/img/loop.svg" alt="Loop music">
                    </div>
                    <div class="music-order__shuffle" id="shuffle">
                        <img src="https://snowleo208.github.io/100-Days-of-Code/7.%20Music%20Player/img/shuffle.svg" alt="Shuffle music">
                    </div>
                </div>
                <div class="music-control">
                    <div class="music-control__backward" id="backward">
                        <img src="https://snowleo208.github.io/100-Days-of-Code/7.%20Music%20Player/img/backward.svg" alt="Backward">
                    </div>
                    <div class="music-control__play" id="play">
                        <img src="https://snowleo208.github.io/100-Days-of-Code/7.%20Music%20Player/img/play.svg" alt="Play" class="play">
                    </div>
                    <div class="music-control__forward" id="forward">
                        <img src="https://snowleo208.github.io/100-Days-of-Code/7.%20Music%20Player/img/forward.svg" alt="Forward">
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        const list = [
            {
            id: 1,
            url:
            "<?php echo get_post_meta($post_id , 'dnmc_music_file', true)['url'] ?>",
            author: "<?php echo $post_meta['dnmc_music_album'][0] ?>",
            title: "<?php echo $post->post_title ?>",
            cover:
            "<?php echo get_post_meta($post_id , 'dnmc_music_image', true)['url'] ?>" }];
        IIFE(); 
    </script>
<?php get_footer(); ?>