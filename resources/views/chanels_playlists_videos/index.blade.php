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
                <a href="{{url('chanels/'. $playlist->chanel_id.'/playlists/'.$playlist->id.'/videos/'.$video->id) }}"
                    >{{$video->name}}</a>
            </div>
            <div class="video_element video_date">{{$video->difInTimeCarbon}}</div>
        </div>  
        @else
        <div class="video_item video_item_in_videos">
            <div class="video_element video_preview"><img src="{{$video->preview}}"></div>
            <div class="video_element video_name_in_videos">
                <a href="{{url('chanels/'. $playlist->chanel_id.'/playlists/'.$playlist->id.'/videos/'.$video->id) }}"
                    >{{$video->name}}</a>
            </div>
            <div class="video_element video_date">{{$video->difInTimeCarbon}}</div>
        </div>
        @endif        
        @endforeach
    </div>
    @endif 
</div>
@endsection




