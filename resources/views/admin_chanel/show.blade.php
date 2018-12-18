@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="panel-body">
        <form id="chanelEdit" action="" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group">
                <input hidden="" name="chanelid" value="{{$chanel->id}}">
                <label for="chanel-name" class="col-sm-3 control-label">               
                    {{ __('chanel name') }}
                </label>
                <div class="col-sm-6">
                    <input type="text" name="chanelname" value="{{$chanel->name}}"
                           id="chanel-name" class="form-control">
                </div>
                <label for="chanel-description" class="col-sm-3 control-label">               
                    {{ __('chanel description') }}
                </label>
                <div class="col-sm-6">
                    <textarea name="chaneldescription" id="chanel-description" class="form-control">{{$chanel->description}}</textarea>
                </div>

            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus">Update chanel</i>
                    </button>
                </div>
            </div>
        </form>       
    </div>
</div>
@endsection
