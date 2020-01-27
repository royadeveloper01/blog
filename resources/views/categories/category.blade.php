@extends('layouts.app')

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
            <div class="card">
                <div class="card-header text-center">Category</div>
               
                    <form method="POST" action="{{ url('/addCategory') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="text" class="col-md-4 col-form-label text-md-right">Enter Category</label>

                            <div class="col-md-6">
                                <input id="text" type="category" class="form-control @error('text') is-invalid @enderror" 
                                name="category" value="{{ old('category') }}" 
                                required autocomplete="category" autofocus>

                                @if($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Category
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
