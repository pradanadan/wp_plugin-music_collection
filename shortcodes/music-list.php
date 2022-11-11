<?php

class DNMC_Music_List{
    public function __construct(){
        if(!shortcode_exists('music-list')){
            add_shortcode('music-list', [$this, 'render_content']);
        }
    }

    public function render_content($atts = [], $content = null){
        if(!$this->is_edit_page()){
            $this->enqueue_scripts();
            include DNMC_PATH . '/shortcodes/content/music-list-content.php';
        }

        return ob_get_clean();
    }

    function enqueue_scripts() {
        wp_enqueue_style( 'bootstrap-style', DNMC_URL . '/assets/css/bootstrap.min.css' );
        wp_enqueue_script( 'bootstrap-script', DNMC_URL . '/assets/js/bootstrap.bundle.min.js');
        wp_enqueue_style( 'main-style', DNMC_URL . '/assets/css/main.css' );
    }

    function is_edit_page($new_edit = null){
        global $pagenow;
        if (!is_admin()) return false;
    
        if($new_edit == "edit")
            return in_array( $pagenow, array( 'post.php',  ) );
        elseif($new_edit == "new")
            return in_array( $pagenow, array( 'post-new.php' ) );
        else
            return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
    }
}

new DNMC_Music_List();