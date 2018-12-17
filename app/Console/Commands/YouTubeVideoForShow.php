<?php

namespace App\Console\Commands;

use App\Models\Playlist;
use App\Models\Video;
use App\Models\Chanel;
use Alaouy\Youtube\Facades\Youtube;
use DateTime;

class YouTubeVideoForShow {

    static $playlistsG;
    static $videosG;

    public static function initialChanels($chanel_string) {

        self::$playlistsG = null;
        self::$videosG = null;
        $channelResult = Youtube::getChannelById($chanel_string)[0];
        $chanel = new Chanel;
        $chanel->name = $channelResult->snippet->title;
        $chanel->description = $channelResult->snippet->description;
        $chanel->youtube_id = $channelResult->id;

        $videos = self::CollectVideos($chanel);
        self::setPlaylists($chanel, $videos);
    }

    public static function CollectVideos($chanel) {

        $params = array(
            'type' => 'video',
            'part' => 'id, snippet',
            'channelId' => $chanel->youtube_id,
            'maxResults' => 50,
            'order' => 'date'
        );
        $tmp = Youtube::searchAdvanced($params, true);
        $videos = $tmp['results'];
        $pageToken = $tmp['info']['nextPageToken'];
        $params['pageToken'] = $pageToken;
        while ($pageToken != null) {
            $tmp = Youtube::searchAdvanced($params, true);
            $pageToken = $tmp['info']['nextPageToken'];
            $params['pageToken'] = $pageToken;
            if ($tmp['results'])
                $videos = array_merge($videos, $tmp['results']);
        }
        $videos = array_reverse($videos);

        $filled_videos = array();

        foreach ($videos as $video) {
            $youtubeId = $video->id->videoId;
//            $found = Video::where('youtube_id', $youtubeId)->exists();
//            if (true === $found) {
//                continue;
//            }
            $videoInfo = Youtube::getVideoInfo($video->id->videoId);
            $video = new Video;
            $video->name = $videoInfo->snippet->title;
            $video->preview = $videoInfo->snippet->thumbnails->default->url;
//            $defaultPlaylist = Playlist::where('chanel_id', $chanel->id)->first();
//            $video->playlist_id = $defaultPlaylist->id;
            $video->description = $videoInfo->snippet->description;
            $video->player = $videoInfo->player->embedHtml;

            $dateString = $videoInfo->snippet->publishedAt;
            $dateStringPieces = explode(".", $dateString);
            $date = str_replace("T", " ", $dateStringPieces[0]);
            $format = 'Y-m-d H:i:s';
            $date = DateTime::createFromFormat($format, $date);
            $date = $date->format('Y-m-d H:i:s');

            $video->original_date = $date;
            $video->youtube_id = $videoInfo->id;

            if (array_key_exists('tags', $videoInfo->snippet)) {
                $tags = $videoInfo->snippet->tags;
                $tagString = '';
                foreach ($tags as $tag) {
                    $tagString .= $tag;
                    $tagString .= ',';
                }
                $video->tags = $tagString;
            }
            $filled_videos[] = $video;
        }
        $vide = collect($filled_videos);
        return $vide;
    }

    public static function setPlaylists($chanel, $video_collection) {

        //get all the existing playlists from the chanel
        $params = [
            'maxResults' => 50
        ];
        $playlists = Youtube::getPlaylistsByChannelId($chanel->youtube_id, $params);
        $pageToken = $playlists['info']['nextPageToken'];

        while ($pageToken != null) {
            $params['pageToken'] = $pageToken;
            $tmp = Youtube::getPlaylistsByChannelId('UCvjgXvBlbQiydffZU7m1_aw', $params);
            $playlists['results'] = array_merge($playlists['results'], $tmp['results']);
            $pageToken = $tmp['info']['nextPageToken'];
        }
        $filled_playlists = array();

        $defaultPlaylist = new Playlist;
        $defaultPlaylist->name = 'miscellaneous';
        $defaultPlaylist->chanel_id = $chanel->id;
        $defaultPlaylist->youtube_id = null;
        $filled_playlists[] = $defaultPlaylist;

        //write all new playlists to db making parent_id chanel ID
        foreach ($playlists['results'] as $playlist) {
            $youtubeId = $playlist->id;
//            $found = Playlist::where('youtube_id', $youtubeId)->exists();
//            if (true === $found) {
//                continue;
//            }
            $section = new Playlist;
            $section->name = $playlist->snippet->title;
            $section->chanel_id = $chanel->id;
            $section->youtube_id = $youtubeId;
//            $section->save();
            $filled_playlists[] = $section;
            $collection = collect(["mother" => 1, "father" => 2, "sister" => 3]);

            $playlistItems = [];
            $playlistItemsTmp = Youtube::getPlaylistItemsByPlaylistId($playlist->id);
            $playlistItems = $playlistItemsTmp['results'];
            $pageToken = $playlistItemsTmp['info']['nextPageToken'];
            while (true === $pageToken) {
                $tmp = Youtube::getPlaylistItemsByPlaylistId($playlist->id, $pageToken);
                $playlistItems = array_merge($playlistItems, $tmp['results']);
                $pageToken = $tmp['info']['nextPageToken'];
            }
            foreach ($playlistItems as $playlistItem) {
                $youtubeVideoId = $playlistItem->contentDetails->videoId;
                // $foundVideo = Video::where('youtube_id', $youtubeVideoId)->first();             
                $foundVideo = $video_collection->where('youtube_id', $youtubeVideoId);
                if ($foundVideo != null) {
                    //$foundVideo->playlist_id = $youtubeId;
                    //$foundVideo->save();
                    $video_collection->where('youtube_id', $youtubeVideoId)->transform(function ($item, $key)use
                            ($youtubeId, $collection) {
                        $item->playlist_id = $youtubeId;
                        return $item;
                    });
                }
            }
        }
        $filled_playlists = collect($filled_playlists);
        $filled_playlists->transform(function ($item, $key)use
                ($video_collection) {
            $item->vidos = $video_collection->where('playlist_id', $item->youtube_id)->values();
            return $item;
        });
        self::$playlistsG = $filled_playlists;
        self::$videosG = $video_collection;
    }

}
