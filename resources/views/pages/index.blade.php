@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>{{$title}}</h1>
        <p>This is the homepage for the blog site</p>
        @if(Auth::user())
        <!--The user is logged in-->
        <p>
            Hello {{ Auth::user()->name }}
        </p>
        @else
        <p>
            <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Login</a>
            <a class="btn btn-success btn-lg" href="{{ route('register') }}" role="button">Register</a>
        </p>
        @endif
    </div>
@endsection


