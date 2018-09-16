@extends('layouts.app')

@section('content')
<div class="wrapper">
	<h3>Плейлисты</h3>
	@if (count($playlists) > 0)
	<div class="panel panel-default">  
	    <div class="video_continer">
	    	@foreach ($playlists as $playlist)
	    	<div class="video_item">
	    		<div class="video_element video_name"><span>{{$playlist->name}}</span></div>
	    		@foreach ($playlist->limitedVideos as $video)
	    		<div class="video_item">
		    		<div class="video_element video_preview"><img src="{{$video->preview}}"></div>
		    		<div class="video_element video_name"><span>{{$video->name}}</span></div>
		    		<div class="video_element video_date">{{$video->difInTime}}</div>
	    		</div>
	    		@endforeach
	    	</div>
	    	@endforeach
	    </div>
	</div>
	@endif



</div>
@endsection




