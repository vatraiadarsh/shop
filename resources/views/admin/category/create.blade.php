@extends('layouts.app')

@section('content')
<div class="container">
   <h1>Add Category</h1>

    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
    @endif


   @error('record')

   @enderror

    <form action="{{route('category.store')}}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{old('description')}}</textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image" >
            @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <div class="form-group">
            <label for="meta title">Meta Title</label>
            <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter meta title" value="{{ old('meta_title') }}">
            @error('meta_title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter mata name" value="{{ old('meta_description') }}">
            @error('meta_description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>
        <div class="form-group">
            <label for="meta keyword">Meta Keyword</label>
            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter meta keyword" value="{{ old('meta_keywords') }}">
            @error('meta_keywords')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        </div>

        <br>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="submit" name="ctn" class="btn btn-success">Submit & Continue</button>
    </form>


</div>
@endsection
