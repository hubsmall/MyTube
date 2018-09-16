<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Chanel;
use App\Models\Video;
use Illuminate\Http\Request;
use Alaouy\Youtube\Facades\Youtube;


class ChanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function index()
    {
        

        $chanels = Chanel::all();

        $latestVideos = Video::orderBy('original_date', 'desc')
               ->take(6)
               ->get();

  
        return view('home.index', [
            'chanels' => $chanels,
            'latestVideos' => $latestVideos,
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
     * @param  \App\Models\Chanel  $chanel
     * @return \Illuminate\Http\Response
     */
    public function show(Chanel $chanel)
    {

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
