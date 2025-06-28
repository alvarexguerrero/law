@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <p>Your role: {{ Auth::user()->role }}</p>

                    {{-- We can add role specific content here later --}}
                    @if (Auth::user()->isClient())
                        <p><a href="#">Ask a New Question</a></p>
                        <p><a href="#">View Your Questions</a></p>
                    @elseif (Auth::user()->isLawyer())
                        <p><a href="#">View Open Questions</a></p>
                        <p><a href="#">Your Answered Questions</a></p>
                    @elseif (Auth::user()->isAdmin())
                        <p><a href="#">Manage Users</a></p>
                        <p><a href="#">Manage Categories</a></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
