<?php
/**
 * Created by PhpStorm.
 * User: gorcer
 * Date: 13.10.16
 * Time: 9:33
 */

class instaWrapper {

    static function getFeedByUrl($url, $proxy=false) {

    if ($url == "") return;

     //   $source = file_get_contents($url);

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL,$url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36');

	    if ($proxy !== false) {
		    curl_setopt($ch, CURLOPT_PROXYTYPE, 7);
		    curl_setopt($ch, CURLOPT_PROXY, $proxy);
	    }

	    $source=curl_exec($ch);
	    curl_close($ch);


        if ($source == false || $source == ' ') {
            // echo "Connection problem";
            return;
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

if (isset($item['edge_media_to_caption']['edges'][0]['node']['text']))
    $caption = $item['edge_media_to_caption']['edges'][0]['node']['text'];
else
    $caption='';


            $result[]=[
                "id"    => $item['id'],
                "code" => $item['shortcode'],
                "url"  => "https://www.instagram.com/p/".$item['shortcode'],
                "timestamp" => $item['taken_at_timestamp'],
                "date" => date("d.m.Y H:i:s", $item['taken_at_timestamp']),
                "caption" => $caption,
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