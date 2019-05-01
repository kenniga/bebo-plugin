<?php
// Some function want fhor this theme
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'image-content', 530, 340, true ); //(cropped)
}
//Remove comment field url email
if(!function_exists('remove_comment_fields')){
    function remove_comment_fields($fields) {
        unset($fields['url']);
        return $fields;
    }
    add_filter('comment_form_default_fields','remove_comment_fields');
}


// Get mailchimp list
function beau_get_mailchimplist($mailchimp_api){
    // echo $mailchimp_api;
    $options = array(__('Nothing Found...','bebostore'));
    if($mailchimp_api == $beau_option['mailchimp-api']){
        if(!class_exists('MCAPI')) require(BEAU_PLUGIN_DIR.'/libs/MCAPI.class.php');
        $api = new MCAPI($mailchimp_api);
        // var_dump($api);
        $lists = $api->lists();
        if ($api->errorCode){
            $options = array(__("Unable to load MailChimp lists, check your API Key.", 'bebostore'));
        }else{
            if ($lists['total'] == 0){
                $options = array(__("You have not created any lists at MailChimp",'bebostore'));
            }else{
                $options = array(__('Select a list','bebostore'));
                foreach ($lists['data'] as $list){
                    $options[$list['id']] = $list['name'];
                }
            }
        }
    }
    return $options;
}




// Add custom class next prev nav detail
add_filter('next_post_link', 'beau_link_attributes_next');
add_filter('previous_post_link', 'beau_link_attributes');
function beau_link_attributes($output) {
    $injection = 'class="next-back prev-post"';
    return str_replace('<a href=', '<a '.$injection.' href=', $output);
}
function beau_link_attributes_next($output) {
    $injection = 'class="next-back next-post"';
    return str_replace('<a href=', '<a '.$injection.' href=', $output);
}


// Get excerp by ID
function bebostore_excerpt_by_id($post_id){
    $the_post = get_post($post_id); //Gets post ID
    $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
    $excerpt_length = 35; //Sets excerpt length by word count
    $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
    $words = explode(' ', $the_excerpt, $excerpt_length + 1);

    if(count($words) > $excerpt_length) :
        array_pop($words);
        array_push($words, '...');
        $the_excerpt = implode(' ', $words);
    endif;

    $the_excerpt = '<p>' . $the_excerpt . '</p>';

    return $the_excerpt;
}

//Beau Excerpt
function bebostore_excerpt($length = 35, $echo = FALSE)
{
    global $post;

    $the_excerpt = strip_shortcodes( $post->post_content );
    $the_excerpt = str_replace(']]>', ']]&gt;', $the_excerpt);
    $the_excerpt = strip_tags($the_excerpt);
    $words = preg_split("/[\n\r\t ]+/", $the_excerpt, $length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $length ) {
        array_pop($words);
        $the_excerpt = implode(' ', $words);
        $the_excerpt = $the_excerpt . ' ...';
    } else {
        $the_excerpt = implode(' ', $words);
    }

    $the_excerpt = wpautop($the_excerpt);

    if ( $echo ) echo $the_excerpt;

    return $the_excerpt;
}


//Check extension
function bebostore_findExtension ($filename)
{
    $filename = strtolower($filename) ;
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    // var_dump($ext);
    return $ext;
}


 //Return Attactment ID
 function beau_get_attachment_id_from_url( $attachment_url = '' ) {
    global $wpdb;
    $attachment_id = false;
    if ( '' == $attachment_url )
        return;
    $upload_dir_paths = wp_upload_dir();
    if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
        $attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
        $attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
        $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
    }
    return $attachment_id;
}

function domain($domainb){
     
    $bits = explode('/', $domainb);
     
    if ($bits[0]=='http:' || $bits[0]=='https:')
     
    {
     
    $domainb= $bits[2];
     
    } else {
     
    $domainb= $bits[0];
     
    }
     
    unset($bits);
     
    $bits = explode('.', $domainb);
     
    $idz=count($bits);
     
    $idz-=3;
     
    if (strlen($bits[($idz+2)])==2) {
     
    $url=$bits[$idz].'.'.$bits[($idz+1)].'.'.$bits[($idz+2)];
     
    } else if (strlen($bits[($idz+2)])==0) {
     
    $url=$bits[($idz)].'.'.$bits[($idz+1)];
     
    } else {
     
    $url=$bits[($idz+1)].'.'.$bits[($idz+2)];
     
    }
     
    return $url;
     
    }
?>