<?php

class DNMC_Music_List{
    public function __construct(){
        if(!shortcode_exists('music-list')){
            add_shortcode('music-list', [$this, 'render_content']);
        }
    }

    public function render_content($atts = [], $content = null){
        include DNMC_PATH . '/shortcodes/content/music-list-content.php';

        return ob_get_clean();
    }
}

new DNMC_Music_List();