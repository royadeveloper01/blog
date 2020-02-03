@extends('layouts.app')
   
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(session('response'))
                <div class="alert alert-success">{{session('response')}}</div>
                @endif
            <div class="card text-center">
                <div class="card-header">Post View</div>

                <div class="panel-body"></div>
                    <div class="col-md-4">
                    <ul class="list-group">
                        @if(count($categories) > 0)
                            @foreach($categories->all() as $category)
                            <li class="list-group-item"><a href='{{ url("category/{$category->
                            id}") }}'>{{$category->category}}</a></li>
                            @endforeach
                        @else
                            <p>No Category Found!</p>
                        @endif
                        
                    </ul>

                    </div>
                    <div class="col-md-8">
                    @if(count($posts) > 0)
                        @foreach($posts->all() as $post)
                            <h4>{{$post->post_title}}</h4>
                            <img class="img" src="{{ $post->post_image }}" alt="">
                            <p>{{ $post->post_body }}</p>

                            <ul class="nav nav-pills">
                                <li role="presentation">
                                    <a href='{{ url("/like/{$post->id}") }}'>
                                        <span class="fas fa-eye">Like({{ $likeCtr }}) </span>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href='{{ url("/dislike/{$post->id}") }}'>
                                        <span class="fas fa-trash ml-2">Dislike({{ $dislikeCtr }}) </span>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href='{{ url("/comment/{$post->id}") }}'>
                                        <span class="ml-2">Comment</span>
                                    </a>
                                </li>
                            </ul>
                            
                        @endforeach
                    @else
                        <p>No Posts Available!</p>
                    @endif

                    <form method="POST" action='{{ url("/comment/{$post->id}") }}'>
                        {{csrf_field()}}
                            <div class="form-group">
                                <textarea name="comment" id="comment" cols="10" rows="6" 
                                class="form-control required autofocus"></textarea>
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-success btn-lg btn-block">
                            POST COMMENT</button>
                            </div>
                    </form>
                    <h3>Comments</h3>
                    @if(count($comments) > 0)
                        @foreach($comments->all() as $comment)
                            <p>{{ $comment->comment }}</p>
                            <p>Posted by: {{ $comment->name }}</p>
                        @endforeach
                    @else
                        <p>No Comments Available!</p>
                    @endif
                </div>
                    
            </div>
        </div>
    </div>
</div>
@endsection
