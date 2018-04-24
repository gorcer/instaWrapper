<?php
/**
 * Created by PhpStorm.
 * User: gorcer
 * Date: 13.10.16
 * Time: 9:33
 */

class instaWrapper {

    static function getFeedByUrl($url) {

    if ($url == "") return;

        $source = file_get_contents($url);
        if ($source == false) {
            echo "Connection problem";
            die();
        }

        $shards = explode('window._sharedData = ', $source);
        $insta_json = explode(';</script>', $shards[1]);

        $insta_array = json_decode($insta_json[0], TRUE);

        if (isset($insta_array['entry_data']['ProfilePage']))
            $nodes =   $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
        elseif (isset($insta_array['entry_data']['LocationsPage']))
            $nodes =   $insta_array['entry_data']['LocationsPage'][0]['graphql']['location']['edge_location_to_media']['edges'];
        elseif (isset($insta_array['entry_data']['TagPage']))
            $nodes =   $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];


        $result=[];
if (is_array($nodes))
        foreach($nodes as $item) {
$item = $item['node'];
            $result[]=[
                "id"    => $item['id'],
                "code" => $item['shortcode'],
                "url"  => "https://www.instagram.com/p/".$item['shortcode'],
                "timestamp" => $item['taken_at_timestamp'],
                "date" => date("d.m.Y H:i:s", $item['taken_at_timestamp']),
                "caption" => (isset($item['caption'])?$item['caption']:false),
                "owner_id" => $item['owner']['id'],
                "thumbnail_src" => $item['thumbnail_src'],
                "image_src" => $item['display_url'],
                "is_video" => (boolean)$item['is_video'],
                "dimensions" => $item['dimensions']
            ];
        }
        return $result;
    }
}