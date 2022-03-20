@extends("layouts.admin")
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Category</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <form action="{{ route('category.index') }}" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="s" placeholder="Search"
                        value="{{ request()->s }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">
                            <span data-feather="search"></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="btn-toolbar mb-2 mb-md-0">
            <a type="button" data-bs-toggle="modal" data-bs-target="#addCategory" class="btn btn-sm btn-secondary">
                Add Category
                <span data-feather="plus-square"></span>
            </a>
        </div>

    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Hey {{ Auth::user()->name }} !</strong> Failed to add category. You should check in on some of those
            fields you have entered.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif





    <table class="table table-hover">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Image</th>
            <th>Slug</th>
            <th>Description</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td><img src="{{ asset('images/' . $category->image) }}" alt="{{ $category->name }}" width="70px"
                        height="70px"></td>
                <td>{{ $category->slug }}</td>
                <td>{{ $category->description }}</td>
                <td>
                    @if ($category->status === 'on')
                        <span class="badge rounded-pill bg-success">active</span>
                    @else
                        <span class="badge rounded-pill bg-danger">Inactive</span>
                    @endif
                </td>
                <td>



                    <a href="{{ route('category.edit', $category->id) }}" type="button"
                        class="btn btn-sm btn-outline-success">
                        Edit
                        <span data-feather="edit-3"></span>
                    </a>

                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger"> Delete
                            <span data-feather="trash-2"></span></button>
                    </form>

                </td>


                </div>

                </div>
                </td>
            </tr>
        @endforeach
    </table>


    <div class="modal fade py-5" id="addCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-5 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Add category</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <form action="{{ route('category.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>


                    </form>


                </div>

            </div>
        </div>

    </div>
    {{ $categories->onEachSide(1)->links() }}
@endsection
