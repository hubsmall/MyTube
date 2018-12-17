@extends('layouts.app')

@section('content')
<div class="wrapper">
    <h3>Новые видео</h3>
    @if (count($latestVideos) > 0)
    <div class="panel panel-default">  
        <div class="video_continer">
            @foreach ($latestVideos as $latestVideo)
            <div class="video_item">
                <div class="video_element video_preview"><img src="{{$latestVideo->preview}}"></div>
                <div class="video_element video_name">
                    <a href="{{ route('chanels.videos.show', [ $latestVideo->playlist->chanel->id, $latestVideo]) }}">{{$latestVideo->name}}</a>
                </div> 
                <div class="video_element video_date">{{$latestVideo->difInTimeCarbon}}</div>
                <div class="video_element video_date">                  
                    <a class="nav-link" href="{{url('chanels/'. $latestVideo->playlist->chanel->id.'/playlists') }}">
                        {{$latestVideo->playlist->chanel->name}}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection




