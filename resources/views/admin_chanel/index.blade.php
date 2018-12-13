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
</div>
</div>
@endsection




