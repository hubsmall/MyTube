@extends('layouts.app')

@section('content')
<div class="wrapper">
	

 <div class="video_continer">
	@if($video)
 
        <div class="video_continer video_player flex_column_center">
        
            <div class="video_item">
                <div class="video_player_frame">
                    <iframe width="100%" height="100%" src="//www.youtube.com/embed/{{$video->youtube_id}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="video_player_name"><h5>{{$video->name}}</h5></div>
                <div class="video_player_date">Дата публикации: {{$video->DateNoTimeCarbon}}</div><br>
                <div class="video_player_date video_player_description">Описание: {{$video->description}}</div>
                <a id="more" href="#">Read more </a>
            </div>
            <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,gplus,twitter"></div>
        </div>
 
	@endif 

    
        <div class="playlist_continer playlist_continer_player">
            @foreach ($randomVideos as $randomVideo)
            <div class="flex_column_center">
                <div class="video_element video_preview"><img src="{{$randomVideo->preview}}"></div>
                <div class="video_element video_name video_name_player">
                    <a href="{{url('chanels/'.$randomVideo->playlist->chanel->id.'/videos/'.$randomVideo->id) }}"
                        >{{$randomVideo->name}}</a>
                </div>             
                <div class="video_element video_date">                  
                    <a class="nav-link"  href="{{url('chanels/'.$randomVideo->playlist->chanel->id.'/playlists') }}"
               >
                    {{$randomVideo->playlist->chanel->name}}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
   
</div>





</div>
@endsection




