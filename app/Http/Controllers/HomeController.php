<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Chanel;
use App\Models\Video;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chanels = Chanel::all();
        $latestVideos = Video::with('playlist.chanel:id,name')->orderBy('original_date', 'desc')
               ->take(6)
               ->get();
  
        return view('home.index', [
            'chanels' => $chanels,
            'latestVideos' => $latestVideos,
        ]);
    }
}
