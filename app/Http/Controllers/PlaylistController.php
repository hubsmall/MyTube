<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Chanel;
use App\Models\Video;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function test()
    {
        $chanels = Chanel::all();
        foreach ($chanels as  $chanel) {
            $playlists = Playlist::where('chanel_id', $chanel->id)->get();
            foreach ($playlists as $playlist) {
                echo "<br>";echo "<br>";echo "<br>";echo "<br>";
                echo "<br>";echo "<br>";echo "<br>";echo "<br>";
                echo "=========================================";
                echo $playlist->name;
                echo "=========================================";echo "<br>";echo "<br>";           
                $videos = Video::where('playlist_id', $playlist->youtube_id)->get();
                foreach ($videos as $video) {
                    echo "****************************************";
                    echo $video->name;
                    echo "****************************************";
                    echo "<br>";echo "<br>";echo "<br>";echo "<br>";
                }
            }
        }
    }

    public function index(Chanel $chanel)
    {
        $chanels = Chanel::all();
        $playlists = Playlist::where('chanel_id', $chanel->id)->get();


        return view('playlists.index', [
            'chanels' => $chanels,
            'playlists' => $playlists,
        ]);
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
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function show(Playlist $playlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Playlist $playlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Playlist  $playlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Playlist $playlist)
    {
        //
    }
}
