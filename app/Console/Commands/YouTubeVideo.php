<?php

namespace App\Console\Commands;
use App\Models\Section;
use App\Models\Video;
use Alaouy\Youtube\Facades\Youtube;

class YouTubeVideo 
{


   public function refresh()
   {

        $chanels = Section::where('parent_id', null)->get();
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
            $found = Section::where('youtube_id', $youtubeId)->exists();
            if (true === $found) {
                continue;
            }
            $section = new Section;
            $section->name = $playlist->snippet->title; 
            $section->parent_id = $chanel->id;
            $section->youtube_id = $youtubeId;
            $section->save();
        }

        // retrieve all videos from $playlists get rid of pagination write new videos to db
        foreach ($playlists['results'] as $playlist) {
            $playlistItems = Youtube::getPlaylistItemsByPlaylistId($playlist->id);
            $pageToken = $playlistItems['info']['nextPageToken'];          
            while (true === $pageToken ) {
                $tmp = Youtube::getPlaylistItemsByPlaylistId('UCvjgXvBlbQiydffZU7m1_aw',$pageToken);
                $playlistItems['results'] = array_merge ($playlistItems['results'], $tmp['results']);
                $pageToken = $tmp['info']['nextPageToken'];
            }
            foreach ($playlistItems['results'] as  $playlistItem) {
                 $playlistId = $playlistItem->id;
                 $found = Video::where('youtube_id', $playlistId)->exists();
                 if (true === $found) {
                     continue;
                 }
                 $video = new Video;
                 $video->name = $playlistItem->snippet->title; 
                 $video->description = $playlistItem->snippet->description; 
                 $video->preview = $playlistItem->snippet->thumbnails->default->url;
                 $video->section_id = $playlistItem->snippet->playlistId;
                 $video->youtube_id = $playlistItem->id;
                 $video->save();
            } 
        }
    }


   	    
   }



}