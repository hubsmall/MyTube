<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Chanel;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Chanel $chanel, Playlist $playlist)
    {
        $chanels = Chanel::all();
        $videos = Video::where('playlist_id', $playlist->id)->orderBy('original_date', 'desc')->get();

        return view('chanels_playlists_videos.index', [
            'chanels' => $chanels,
            'videos' => $videos,
            'playlist' => $playlist,
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
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Chanel $chanel, Playlist $playlist, Video $video)
    {
        $chanels = Chanel::all();
        $randomVideos = Video::with('playlist.chanel:id,name')->orderBy(\DB::raw('RAND()'))->take(6)->get();
        return view('chanels_playlists_videos.show', [
            'chanels' => $chanels,
            'video' => $video,
            'playlist' => $playlist,
            'randomVideos' => $randomVideos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
