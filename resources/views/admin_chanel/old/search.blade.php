@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="panel-body">
        @if ($channelResult)
        <div class="panel panel-default">  
           
                <div class="chanel_item">
                    <div class="video_element video_preview"><img src="{{$channelResult->snippet->thumbnails->default->url}}"></div>
                    <div class="video_element">{{$channelResult->snippet->title}}</div>
                    <div class="video_element">{{$channelResult->snippet->description}}</div>
                </div>
    
                    @if (count($playlists) > 0)
                   
                        <div class="playlist_continer">
                            @foreach ($playlists as $playlist)
                            <div class="playlist_item">
                                <div class="playlist_name"><span>{{$playlist->name}}</span></div>

                                <div class="video_continer">
                                    @foreach($playlist->videos as $iterator=> $video)

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
                            @endforeach
                        </div>
                  
                    @endif           
            <form action="{{ url('admin.transaction') }}" method="GET" class="form-horizontal">
                {{ csrf_field() }}
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <input type="text" name="answer" value="{{request()->input("chanel")}}"
                               id="answer-name" class="form-control" hidden="">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-plus">Accept</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        @else
        No result
        @endif
    </div>
</div>
@endsection
