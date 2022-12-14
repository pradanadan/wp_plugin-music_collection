<?php

class DNMC_My_Music_Metabox{
    public function __construct(){
        add_action('post_edit_form_tag', [$this, 'update_edit_form']);
        add_action('add_meta_boxes', [$this, 'add_metaboxes'] );
        add_action('post_updated', [$this, 'save_description']);
    }

    function update_edit_form() {
        echo ' enctype="multipart/form-data"';
    }

    public function add_metaboxes(){
        add_meta_box( 'music_description_metabox', __( 'Music Description', 'my_music' ), [$this, 'render_description'], 'my_music');
    }

    public function render_description(){
        $post_id = get_the_ID();
        $is_edit = $this->is_edit_page('edit');

        $music_title = $is_edit ? get_the_title($post_id) : null;
        $music_album = $is_edit ? get_post_meta($post_id , 'dnmc_music_album', true) : null;
        $music_image = $is_edit ? get_post_meta($post_id , 'dnmc_music_image', true)['url'] : null;
        $music_file = $is_edit ? get_post_meta($post_id , 'dnmc_music_file', true)['url'] : null;
        
        wp_nonce_field(plugin_basename(__FILE__), 'dnmc_add_music_nonce');

        $this->admin_enqueue_scripts();
        ?>
        <div class="metaboxForm">
        <div class="row textRow">
            <div class="col-lg-1"><label for="dnmc_music_title">Title: </label></div>
            <div class="col-lg-10"><input type="text" name="post_title" class="metaboxInput" value="<?php echo $music_title ?>"/></div>
        </div>
        <div class="row textRow">
            <div class="col-lg-1"><label for="dnmc_music_album">Album: </label></div>
            <div class="col-lg-10"><input type="text" class="metaboxInput" name="dnmc_music_album" value="<?php echo $music_album ?>"/></div>
        </div>
        <div class="row previewRow">
            <div class="col-lg-1"></div>
            <div class="col-lg-3 d-flex justify-content-center">
                <div>
                <?php if (empty($music_image)){ ?>
                    <img id="imgPreview" src="<?php echo DNMC_URL . '/assets/images/blank_img.png' ?>"/>
                <?php } else { ?>
                    <img src="<?php echo $music_image ?>" id="imgPreview"/>
                <?php } ?>
                </div>
            </div>
            <div class="col-lg-7 d-flex justify-content-center">
                <div class="align-self-center">
                <audio controls id="audioControl">
                    <?php if (empty($music_file)){ ?>
                        <source id="audioSrcPreview" src="" type="audio/mpeg">
                    <?php } else { ?>
                        <source id="audioSrcPreview" src="<?php echo $music_file ?>" type="audio/mpeg">
                    <?php } ?>
                    Your browser does not support the audio element.
                </audio>
                </div>
            </div>
        </div>
        <div class="row labelRow">
            <div class="col-lg-1"></div>
            <div class="col-lg-3 d-flex justify-content-center">
                <div>
                <?php if (empty($music_image)){ ?>
                    <label for="music_image_input" class="fileInputLabel" id="imageBtnLabel">Upload IMG</label>
                <?php } else { ?>
                    <label for="music_image_input" class="fileInputLabel" id="imageBtnLabel">Change IMG</label>
                <?php } ?>
                <input type="file" name="dnmc_music_image" id="music_image_input" accept="image/*" onchange="showPreview(event);">
                </div>     
            </div>
            <div class="col-lg-7 d-flex justify-content-center">
                <div>
                <?php if (empty($music_file)){ ?>
                    <label for="music_file_input" id="fileBtnLabel" class="fileInputLabel">Upload MP3</label>
                <?php } else { ?>
                    <label for="music_file_input" id="fileBtnLabel" class="fileInputLabel">Change MP3</label>
                <?php } ?>
                <input type="file" name="dnmc_music_file" id="music_file_input" accept="audio/*" onchange="showAudio(event);">
                </div>
            </div>
        </div>
        <?php

    }

    public function save_description( $post_id ) {    
        // Security Verification
        if(!wp_verify_nonce($_POST['dnmc_add_music_nonce'], plugin_basename(__FILE__))) {
            return $post_id;
        }
            
        if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
            
        if('page' == $_POST['post_type']) {
            if(!current_user_can('edit_page', $post_id)) {
            return $post_id;
            }
        } else {
            if(!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        }

        // Saving Data
		if(isset($_POST['dnmc_music_album'])){

            $music_album = sanitize_text_field($_POST['dnmc_music_album']);

            update_post_meta($post_id, 'dnmc_music_album', $music_album );

        }
        if(!empty($_FILES['dnmc_music_image']['name'])){  
            $music_image = $_FILES['dnmc_music_image'];

            $supported_types = array('image/jpeg', 'image/jpg', 'image/png');
            $arr_file_type = wp_check_filetype(basename($music_image['name']));
            $uploaded_type = $arr_file_type['type'];

            if(in_array($uploaded_type, $supported_types)) {
                $upload = wp_upload_bits($music_image['name'], null, file_get_contents($music_image['tmp_name']));
         
                if(isset($upload['error']) && $upload['error'] != 0) {
                    wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
                } else {
                    update_post_meta($post_id, 'dnmc_music_image', $upload);     
                } 
            } 
            else {
                wp_die("The file type that you've uploaded is not an image.");
            }
            
		}
        if(!empty($_FILES['dnmc_music_file']['name'])){  
            $music_file = $_FILES['dnmc_music_file'];

            $supported_types = array('audio/mpeg');
            $arr_file_type = wp_check_filetype(basename($music_file['name']));
            $uploaded_type = $arr_file_type['type'];

            if(in_array($uploaded_type, $supported_types)) {
                $upload = wp_upload_bits($music_file['name'], null, file_get_contents($music_file['tmp_name']));
         
                if(isset($upload['error']) && $upload['error'] != 0) {
                    wp_die('There was an error uploading your file. The error is: ' . $upload['error']);
                } else {
                    update_post_meta($post_id, 'dnmc_music_file', $upload);     
                } 
            } 
            else {
                wp_die("The file type that you've uploaded is not a MP3.");
            }
            
		}

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

    function admin_enqueue_scripts() {
        wp_enqueue_style( 'bootstrap-style', DNMC_URL . '/assets/css/bootstrap.min.css' );
        wp_enqueue_style( 'admin-style', DNMC_URL . '/assets/css/admin.css' );
        wp_enqueue_script( 'bootstrap-script', DNMC_URL . '/assets/js/bootstrap.bundle.min.js');
        wp_enqueue_script( 'admin-script', DNMC_URL . '/assets/js/admin.js');
    } 
  
}

new DNMC_My_Music_Metabox();