@extends('layouts.app')

@section('content')
<div class="wrapper">
	

 <div class="video_continer">
	@if($video)
 
        <div class="video_continer video_player">
        
            <div class="video_item">
                <div class=" ">
                    <iframe width="100%" height="450" src="//www.youtube.com/embed/{{$video->youtube_id}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="video_player_name"><h5>{{$video->name}}</h5></div>
                <div class="video_player_date">Дата публикации: {{$video->DateNoTimeCarbon}}</div><br>
                <div class="video_player_date">Описание: {{$video->description}}</div>
            </div>
            <script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>
<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,gplus,twitter"></div>
        </div>
 
	@endif 

    
        <div class="playlist_continer playlist_continer_player">
            @foreach ($randomVideos as $randomVideo)
            <div class="video_player">
                <div class="video_element video_preview"><img src="{{$randomVideo->preview}}"></div>
                <div class="video_element video_name video_name_player">
                    <a href="{{ route('chanels.videos.show', [ $randomVideo->playlist->chanel->id, $randomVideo]) }}">{{$randomVideo->name}}</a>
                </div>             
                <div class="video_element video_date">                  
                    <a class="nav-link" href="{{ route('chanels.playlists.index', [ $randomVideo->playlist->chanel->id]) }}">
                    {{$randomVideo->playlist->chanel->name}}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
   
</div>





</div>
@endsection




