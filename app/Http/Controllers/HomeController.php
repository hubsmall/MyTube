<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlist;
use App\Models\Chanel;
use App\Models\Video;
use App\Console\Commands\JSONdbOperations;

class HomeController extends Controller {
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
    public function index() {
        
        $dataAccess = getDataAccess();
        if ($dataAccess) {
            $chanels = Chanel::all();
            $latestVideos = Video::with('playlist.chanel:id,name')->orderBy('original_date', 'desc')
                    ->take(6)
                    ->get();          
        } else {
            $chanels = JSONdbOperations::allChanels();
            $latestVideos = JSONdbOperations::latestVideos();
        }
       
        return view('home.index', [
            'chanels' => $chanels,
            'latestVideos' => $latestVideos,
        ]);
    }

}
