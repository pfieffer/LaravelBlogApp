@extends('layouts.app')

@section('content')
    <div class="container">
        <h1> Posts </h1>
        @if(count($posts)>0)
            @foreach($posts as $post)
                <div class="well">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                           <img width="100%" height="200px" src="/storage/cover_images/{{$post -> cover_image}}" alt="Image for Blog Post">
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                        </div>
                    </div>

                </div>
            @endforeach
            {{$posts->links()}} <!--for pagination-->
        @else
            <p>No posts found</p>
        @endif
    </div>
@endsection
