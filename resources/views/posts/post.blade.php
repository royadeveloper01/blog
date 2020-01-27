@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Post</div>

                <div class="card-body">
                 <div class="row">
                 <form method="POST" action="{{ url('/addPost') }}" 
                 enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="post_title" class="col-md-4 col-form-label text-md-right">
                            {{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="post_title" type="text" class="form-control 
                                @error('post_title') is-invalid @enderror" name="post_title" 
                                value="{{ old('post_title') }}" required autofocus>

                                @error('post_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_body" class="col-md-4 col-form-label text-md-right">
                            {{ __('Body') }}</label>

                            <div class="col-md-6">
                                <textarea id="post_body" rows="6" class="form-control" name="post_body" 
                                value="{{ old('post_body') }}" required></textarea>

                                @error('post_body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">
                            {{ __('Category') }}</label>

                            <div class="col-md-6">
                                <select id="category_id" type="category_id" class="form-control" 
                                name="category_id" required>
                                <option value="">Select</option>
                                @if(count($categories) > 0)
                                    @foreach($categories->all() as $category)
                                    <option value="{{ $category->id }}">{{$category-> category }}</option>
                                    @endforeach
                                @endif
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_image" class="col-md-4 col-form-label 
                            text-md-right">{{ __('Featured Image') }}</label>

                            <div class="col-md-6">
                                <input id="post_image" type="file" class="form-control 
                                @error('post_image') is-invalid @enderror" 
                                name="post_image" required>

                                @error('post_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-large btn-block">
                                    {{ __('Publish Post') }}
                                </button>
                            </div>
                        </div>
                    </form>
                 </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
