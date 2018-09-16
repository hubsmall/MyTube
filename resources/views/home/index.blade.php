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
	    		<div class="video_element video_name"><span>{{$latestVideo->name}}</span></div>
	    		<div class="video_element video_date">{{$latestVideo->difInTime}}</div>
	    	</div>
	    	@endforeach
	    </div>
	</div>
	@endif



</div>
@endsection




