@extends('layouts.app')
    <style type="text/css">
        .avatar{
            border-radius: 100%;
            max-width: 100px;
        }
        .img{
            max-width: 100px;
            max-height: 180px;
        }
    </style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{$error}}</div>
                    @endforeach
            @endif

            @if(session('response'))
                <div class="alert alert-success">{{session('response')}}</div>
            @endif
            <div class="card text-center">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">Dashboard</div>
                        <div class="col-md-8">
                            <form method="POST" action='{{ url("/search") }}'>
                            {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                    placeholder="Search for...">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-default">
                                                GO!
                                            </button>
                                        </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body row">
                    <div class="col-md-4">
                        @if(!empty($profile))
                            <img src="{{ $profile->profile_pic }}" 
                            class="avatar" alt="">
                        @else
                            <img src="{{ url('images/avatar.png') }}" 
                            class="avatar" alt="">
                        @endif

                        @if(!empty($profile))
                        <p class="lead">{{ $profile->name }}</p>
                        @else
                        <p></p>
                        @endif

                        @if(!empty($profile))
                            <p class="lead">{{ $profile->designation }}</p>
                        @else
                            <p></p>
                        @endif

                    </div>
               
                <div class="col-md-8">
                    @if(count($posts) > 0)
                        @foreach($posts->all() as $post)
                            <h4>{{$post->post_title}}</h4>
                            <img class="img" src="{{ $post->post_image }}" alt="">
                            <p>{{ substr($post->post_body, 0, 150) }}</p>

                            <ul class="nav nav-pills">
                                <li role="presentation">
                                    <a href='{{ url("/view/{$post->id}") }}'>
                                        <span>View</span>
                                    </a>
                                </li>
                                @if(Auth::id() == 1)
                                <li role="presentation">
                                    <a href='{{ url("/edit/{$post->id}") }}'>
                                        <span class="ml-3">Edit</span>
                                    </a>
                                </li>
                                @endif

                                @if(Auth::id() == 1)
                                <li role="presentation">
                                    <a href='{{ url("/delete/{$post->id}") }}'>
                                        <span class="ml-3">Delete</span>
                                    </a>
                                </li>
                                @endif
                                
                            </ul>
                            <cite style="float:left;">Posted on: {{date('M j, Y H:i',
                            strtotime($post->update_at))}}</cite>
                            <cite style="float:left;">Posted by: {{$post->name))}}</cite>
                            <hr/>
                        @endforeach
                    @else
                        <p>No Posts Available!</p>
                    @endif

                    {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
