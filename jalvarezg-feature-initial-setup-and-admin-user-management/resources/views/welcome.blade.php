@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Welcome to the Legal Questions Platform.
                    <p>Please <a href="{{ url('/login') }}">login</a> or <a href="{{ url('/register') }}">register</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
