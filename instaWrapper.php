<?php
/**
 * Created by PhpStorm.
 * User: gorcer
 * Date: 13.10.16
 * Time: 9:33
 */

class instaWrapper {

    static function getFeedByUrl($url) {

        $source = file_get_contents($url);
        if ($source == false) {
            echo "Connection problem";
            die();
        }

        $shards = explode('window._sharedData = ', $source);
        $insta_json = explode(';</script>', $shards[1]);

        $insta_array = json_decode($insta_json[0], TRUE);

        if (isset($insta_array['entry_data']['ProfilePage']))
            $nodes =   $insta_array['entry_data']['ProfilePage'][0]['user']['media']['nodes'];
        elseif (isset($insta_array['entry_data']['LocationsPage']))
            $nodes =   $insta_array['entry_data']['LocationsPage'][0]['location']['media']['nodes'];

        $result=[];
        foreach($nodes as $item) {

            $result[]=[
                "id"    => $item['id'],
                "code" => $item['code'],
                "url"  => "https://www.instagram.com/p/".$item['code'],
                "timestamp" => $item['date'],
                "date" => date("d.m.Y H:i:s", $item['date']),
                "caption" => (isset($item['caption'])?$item['caption']:false),
                "owner_id" => $item['owner']['id'],
                "thumbnail_src" => $item['thumbnail_src'],
                "image_src" => $item['display_src'],
                "is_video" => (boolean)$item['is_video'],
                "dimensions" => $item['dimensions']
            ];
        }
        return $result;
    }
}