<?php
function beau_instagram_image($username, $slice = 12) {

    $username = strtolower($username);

    if (!$instagram = get_transient('instagram-media-'.sanitize_title_with_dashes($username))) {
        $remote = wp_remote_get('http://instagram.com/'.trim($username));

        if (is_wp_error($remote)){
            return new WP_Error('site_down', __('Unable to communicate with Instagram.', 'bebostore'));
        }

        if ( 200 != wp_remote_retrieve_response_code( $remote ) ){
            return new WP_Error('invalid_response', __('Instagram did not return a 200.', 'bebostore'));
        }

        $shards = explode('window._sharedData = ', $remote['body']);

        $insta_json = explode(';</script>', $shards[1]);

        $insta_array = json_decode($insta_json[0], TRUE);
        $username_fromur = $insta_array['entry_data']['ProfilePage'][0]["graphql"]['user']['username'];
        $images = $insta_array['entry_data']['ProfilePage'][0]["graphql"]['user']['edge_owner_to_timeline_media']['edges'];
        $instagram = array();
		if(is_array($images)){
			foreach ($images as $images) {
				if ($username_fromur == $username) {
					$instagram[] = array(
						'link'          => $images['node']['thumbnail_src'],
						'time'          => $images['node']['taken_at_timestamp'],
						'link_to'       => 'https://instagram.com/p/'.$images['node']['shortcode'].'/?taken-by='.$username,
						'comments'      => $images['node']['edge_media_to_comment']['count'],
						'likes'         => $images['node']['edge_media_preview_like']['count'],
						'type'          => $images['node']['is_video'],
						'code'          => $images['node']['shortcode'],
					);
				}
			}
		}
        $instagram = base64_encode( serialize( $instagram ) );
        set_transient('instagram-media-'.sanitize_title_with_dashes($username), $instagram, apply_filters('null_instagram_cache_time', HOUR_IN_SECONDS*2));
    }
    $instagram = unserialize( base64_decode( $instagram ) );
    return array_slice($instagram, 0, $slice);
}
?>