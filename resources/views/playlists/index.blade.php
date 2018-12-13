@extends('layouts.app')

@section('content')
<div class="wrapper">
	<h3>Плейлисты</h3>
	@if (count($playlists) > 0)
	<div class="panel panel-default">  
	    <div class="playlist_continer">
                <div id="accordion">
	    	@foreach ($playlists as $playlist)
	    	<div class="playlist_item">
	    		<div class="playlist_name"><span>{{$playlist->name}}</span></div>
	    		<div class="video_continer">                           
	    		@foreach ($playlist->limitedVideos as $video)	    		
		    		<div class="video_item video_item_in_playlist">
			    		<div class="video_element video_preview"><img src="{{$video->preview}}"></div>
			    		<div class="video_element video_name video_name_in_playlist"><span>{{$video->name}}</span></div>
			    		<div class="video_element video_date">{{$video->difInTimeCarbon}}</div>
		    		</div>
	    		@endforeach
	    			<div class="video_item video_item_in_playlist">
			    		<div class="video_element video_name video_name_in_playlist">
			    			<a class="nav-link" href="{{ route('chanels.playlists.videos.index', [ $playlist->chanel_id, $playlist]) }}">Все видео</a>
			    		</div>
		    		</div>
	    		</div>
	    	</div>
	    	@endforeach
	    </div></div>
	</div>
	@endif



</div>
@endsection




