<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Chanel;
use App\Models\Video;
use Illuminate\Http\Request;
use Alaouy\Youtube\Facades\Youtube;
use App\Console\Commands\JSONdbOperations;


class ChanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
        

        echo "string";
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
     * @param  \App\Models\Chanel  $chanel
     * @return \Illuminate\Http\Response
     */
    public function show($chanelId, $videoId)
    {
        try {
            $chanels = Chanel::all();
            $randomVideos = Video::with('playlist.chanel:id,name')->orderBy(\DB::raw('RAND()'))->take(6)->get();
            $video = Video::where('id', $videoId)->first();
        } catch (\Exception $e) {
            $chanels = JSONdbOperations::allChanels();
            $randomVideos = JSONdbOperations::randomVideos();          
            $video = JSONdbOperations::convertToVideo(JSONdbOperations::readFromJson('Video'))
                    ->where('id', $videoId)->first();
        }
        return view('chanels_playlists_videos.show', [
            'chanels' => $chanels,
            'video' => $video,
            'randomVideos' => $randomVideos,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chanel  $chanel
     * @return \Illuminate\Http\Response
     */
    public function edit(Chanel $chanel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chanel  $chanel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chanel $chanel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chanel  $chanel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chanel $chanel)
    {
        //
    }
}
