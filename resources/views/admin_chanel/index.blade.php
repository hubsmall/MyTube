@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="panel-body">
        <form action="{{ url('admin.search') }}" method="GET" class="form-horizontal">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="chanel-name" class="col-sm-3 control-label">               
                    {{ __('chanel youtube-id') }}
                </label>
                <div class="col-sm-6">
                    <input type="text" name="chanel" id="chanel-name" class="form-control">
                </div>

            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus">Search chanel</i>
                    </button>
                </div>
            </div>
        </form>
        <h4>Current Chanels</h4>
        @if (count($chanels) > 0)
        <ul>
            @foreach ($chanels as $chanel)
            <li  class="chanelInList{{$chanel->id}}">
                <span data-chanelid="{{$chanel->id}}" data-chanelname="{{$chanel->name}}" 
                      data-chaneldescription="{{$chanel->description}}"
                      class="chanel_click">{{$chanel->name}}</span> 
            </li>
            @endforeach
        </ul>
        @endif  
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>           
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="chanelname">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" name="chanelid" hidden=""  id="chanelI">                          
                            <input type="text" name="chanelname" class="form-control" id="chanelN">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="chaneldescription">Description:</label>
                        <div class="col-sm-10">
                            <textarea rows="7"  name="chaneldescription" class="form-control" id="chanelD"></textarea>
                        </div>
                    </div>
                </form>
                <div class="deleteContent">
                    Are you Sure you want to delete <span class="dname"></span> ? <span
                        class="hidden did"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button" class='glyphicon'> </span>
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/AdminControlAjax.js') }}" defer></script>
@endsection




