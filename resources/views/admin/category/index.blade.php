@extends('layouts.app')

@section('content')
<div class="container">
   @if (session('success'))
   <div class="alert alert-success" role="alert">
       {{ session('success') }}
   </div>
   @endif

    <div>
        <a href="{{ route('category.create') }}" class="btn btn-success">Add Category</a>
    </div>
    <br/>

    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Image</th>
          <th>Slug</th>
          <th>Description</th>
          <th>Meta Title</th>
          <th>Meta Description</th>
          <th>Meta Keyword</th>
          <th>Action</th>
        </tr>
        @foreach ($categories as $category)
        <tr>
          <td>{{ $category->id }}</td>
          <td>{{ $category->name }}</td>
          <td><img src="{{ asset('images/'.$category->image) }}" alt="{{ $category->name }}" width="100px" height="100px"></td>
          <td>{{ $category->slug }}</td>
          <td>{{ $category->description }}</td>
            <td>{{ $category->meta_title }}</td>
            <td>{{ $category->meta_description }}</td>
            <td>{{ $category->meta_keyword }}</td>
          <td>
            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </td>
        </tr>
        @endforeach
      </table>
    </div>


</div>
@endsection
