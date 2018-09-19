<?php

namespace App\Console\Commands;
use App\Models\Playlist;
use App\Models\Video;
use App\Models\Chanel;
use Alaouy\Youtube\Facades\Youtube;
use DateTime;

class YouTubeVideo 
{
    public function initialChanels()
    {
        $chanels = array('UC5dgoavpIertLkNDDITDoBQ','UCI0wUrfRUN2F-5G_AgTpR-w','UCrMnWbWKMm_D0cNvzkKP1jQ');
        foreach ($chanels as $chanel) {
            $channelResult = Youtube::getChannelById($chanel);
            $chanel = new Chanel;
            $chanel->name = $channelResult->snippet->title; 
            $chanel->description = $channelResult->snippet->description; 
            $chanel->youtube_id = $channelResult->id;
            $chanel->save();

            $defaultPlaylist = new Playlist;
            $defaultPlaylist->name = 'miscellaneous'; 
            $defaultPlaylist->chanel_id = $chanel->id;
            $defaultPlaylist->youtube_id = null;
            $defaultPlaylist->save();

        }
    }

    function cmp_function_asc($a, $b){
        return ($a->snippet->publishedAt > $b->snippet->publishedAt);
    }

    public function allVideosToMiscellaneous()
   {
        $chanels = Chanel::all();
        foreach ($chanels as  $chanel) {
            $params = array(
                'type'          => 'video',
                'part'          => 'id, snippet', 
                'channelId'     => $chanel->youtube_id,
                'maxResults'    => 50,
                'order'         => 'date'
            );
            $tmp       = Youtube::searchAdvanced($params, true);
            $videos =   $tmp['results'];
            $pageToken = $tmp['info']['nextPageToken'];
            $params['pageToken'] = $pageToken;
            while ($pageToken != null) {
                $tmp       = Youtube::searchAdvanced($params, true);
                $pageToken = $tmp['info']['nextPageToken'];
                $params['pageToken'] = $pageToken;
                if($tmp['results'])
                $videos = array_merge ($videos, $tmp['results']);                  
            }
            $videos = array_reverse($videos);

            foreach ($videos as $video) {
                $youtubeId = $video->id->videoId;
                $found = Video::where('youtube_id', $youtubeId)->exists();
                if (true === $found) {
                    continue;
                }
                $videoInfo = Youtube::getVideoInfo($video->id->videoId);
                $video = new Video;
                $video->name = $videoInfo->snippet->title; 
                $video->preview = $videoInfo->snippet->thumbnails->default->url;           
                $defaultPlaylist = Playlist::where('chanel_id', $chanel->id)->first();
                $video->playlist_id = $defaultPlaylist->id;
                $video->description = $videoInfo->snippet->description;
                $video->player = $videoInfo->player->embedHtml;

                $dateString = $videoInfo->snippet->publishedAt;
                $dateStringPieces = explode(".", $dateString);
                $date = str_replace("T", " ", $dateStringPieces[0]);
                $format = 'Y-m-d H:i:s';
                $date = DateTime::createFromFormat($format, $date);

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
                $video->save();
            }
        }
   }


   public function refresh()
   {
        //$this->initialChanels();
        //$this->allVideosToMiscellaneous();
        //$this->setPlaylists();
        $this->checkForEmptyPlaylists();
   	}

public function setPlaylists()
   {

        $chanels = Chanel::all();
        foreach ($chanels as  $chanel) {
            //get all the existing playlists from the chanel
        $params = [ 
            'maxResults'    => 50
         ];
        $playlists = Youtube::getPlaylistsByChannelId($chanel->youtube_id, $params);
        $pageToken = $playlists['info']['nextPageToken'];

        while ($pageToken != null) {
            $params['pageToken'] = $pageToken;
            $tmp = Youtube::getPlaylistsByChannelId('UCvjgXvBlbQiydffZU7m1_aw',$params);
            $playlists['results'] = array_merge ($playlists['results'], $tmp['results']);
            $pageToken = $tmp['info']['nextPageToken'];
        }

        //write all new playlists to db making parent_id chanel ID
        foreach ($playlists['results'] as $playlist) {
            $youtubeId = $playlist->id;
            $found = Playlist::where('youtube_id', $youtubeId)->exists();
            if (true === $found) {
                continue;
            }
            $section = new Playlist;
            $section->name = $playlist->snippet->title; 
            $section->chanel_id = $chanel->id;
            $section->youtube_id = $youtubeId;
            $section->save();

            $playlistItems = [];
            $playlistItemsTmp = Youtube::getPlaylistItemsByPlaylistId($playlist->id);
            $playlistItems =  $playlistItemsTmp['results'];
            $pageToken = $playlistItemsTmp['info']['nextPageToken'];          
            while (true === $pageToken ) {
                $tmp = Youtube::getPlaylistItemsByPlaylistId($playlist->id,$pageToken);
                $playlistItems = array_merge ($playlistItems, $tmp['results']);
                $pageToken = $tmp['info']['nextPageToken'];
            }
            //uasort($playlistItems, array($this,'cmp_function_asc'));
            foreach ($playlistItems as  $playlistItem) {

                 $youtubeVideoId = $playlistItem->contentDetails->videoId;           
                 $foundVideo = Video::where('youtube_id', $youtubeVideoId)->first();
                 if ($foundVideo != null) {          
                    $foundVideo->playlist_id = $section->id;
                    $foundVideo->save();
                 }          
            } 

        }
    }      
}

public function checkForEmptyPlaylists()
{
    $playlists = Playlist::with('videos')->get();
    foreach ($playlists as  $playlist) {
        if ($playlist->videos->count() === 0) {
            $playlist->delete();
        }
    }
}


}