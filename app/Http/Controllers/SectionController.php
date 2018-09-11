<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Video;
use Illuminate\Http\Request;
use Alaouy\Youtube\Facades\Youtube;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function indjex()
    {
        
        //get all the existing playlists from the chanel
        $params = [ 
            'maxResults'    => 50
         ];
        $playlists = Youtube::getPlaylistsByChannelId('UCvjgXvBlbQiydffZU7m1_aw', $params);
        $pageToken = $playlists['info']['nextPageToken'];

        while ($pageToken != null) {
            $params['pageToken'] = $pageToken;
            $tmp = Youtube::getPlaylistsByChannelId('UCvjgXvBlbQiydffZU7m1_aw',$params);
            $playlists['results'] = array_merge ($playlists['results'], $tmp['results']);
            $pageToken = $tmp['info']['nextPageToken'];
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
                echo "****************************************";
                echo $playlistItem->snippet->title;
                echo "****************************************";
                echo "<br>";echo "<br>";echo "<br>";echo "<br>";
            }
            echo "=========================================";echo "=========================================";
            echo "=========================================";echo "========================================="; 
        }
    
    }
    public function index()
    {
        // $section = new Section;
        // $section->name = "The Coding Train"; 
        // $section->youtube_id = 'UCvjgXvBlbQiydffZU7m1_aw';
        // $section->save();

        // $section2 = new Section;
        // $section2->name = "sentdex"; 
        // $section2->youtube_id = 'UCfzlCWGWYyIQ0aLC5w48gBQ';
        // $section2->save();

        // $section3 = new Section;
        // $section3->name = "Siraj Raval"; 
        // $section3->youtube_id = 'UCWN3xxRkmTPmbKwht9FuE5A';
        // $section3->save();

        //$playlist = Youtube::getPlaylistById('PLRqwX-V7Uu6YPSwT06y_AEYTqIwbeam3y');
        //dd($playlist);
        //$playlistItems = Youtube::getPlaylistItemsByPlaylistId('PLRqwX-V7Uu6YPSwT06y_AEYTqIwbeam3y');
        //dd($playlistItems);

        $chanels = Section::where('parent_id', null)->get();
        foreach ($chanels as  $chanel) {
            $playlists = Section::where('parent_id', $chanel->id)->get();
            foreach ($playlists as $playlist) {
                echo "<br>";echo "<br>";echo "<br>";echo "<br>";
                echo "<br>";echo "<br>";echo "<br>";echo "<br>";
                echo "=========================================";
                echo $playlist->name;
                echo "=========================================";echo "<br>";echo "<br>";           
                $videos = Video::where('section_id', $playlist->youtube_id)->get();
                foreach ($videos as $video) {
                    echo "****************************************";
                    echo $video->name;
                    echo "****************************************";
                    echo "<br>";echo "<br>";echo "<br>";echo "<br>";
                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        //
    }
}
