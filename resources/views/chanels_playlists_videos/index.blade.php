@extends('layouts.app')

@section('content')
<div class="wrapper">
	<h3>Видео плейлиста {{$playlist->name}}</h3>
	


	@if(count($videos) > 0)
    <div class="video_continer">
    @foreach($videos as $iterator=> $video)

    @if( 0 == $iterator % 4 ) 
    </div>
    <div class="video_continer">
        <div class="video_item video_item_in_videos">
    		<div class="video_element video_preview"><img src="{{$video->preview}}"></div>
    		<div class="video_element video_name_in_videos">
    			<a href="{{ route('chanels.playlists.videos.show', [ $playlist->chanel_id, $playlist, $video]) }}">{{$video->name}}</a>
    		</div>
    		<div class="video_element video_date">{{$video->difInTimeCarbon}}</div>
	    </div>  
    @else
        <div class="video_item video_item_in_videos">
    		<div class="video_element video_preview"><img src="{{$video->preview}}"></div>
    		<div class="video_element video_name_in_videos">
    			<a href="{{ route('chanels.playlists.videos.show', [ $playlist->chanel_id, $playlist, $video]) }}">{{$video->name}}</a>
    		</div>
    		<div class="video_element video_date">{{$video->difInTimeCarbon}}</div>
	    </div>
    @endif        
    @endforeach
    </div>
    </div>
	@endif </div>






</div>
@endsection




