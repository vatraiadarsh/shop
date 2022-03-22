
@extends('layouts.admin')
@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Product</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <form action="{{ route('product.index') }}" method="get">
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
        <a type="button" data-bs-toggle="modal" data-bs-target="#addProduct" class="btn btn-sm btn-secondary">
            Add Product
            <span data-feather="plus-square"></span>
        </a>
    </div>
</div>
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Hey {{ Auth::user()->name }} !</strong> Failed to add product. You should check in on some of those
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
            <th>Title</th>
            <th>categories</th>
            <th>Description</th>
            <th>Price</th>
            <th>Quantity</th>

            <th>Status</th>
            <th>Action</th>
        </tr>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td><img src="{{ asset('images/product/' . $product->image) }}" alt="{{ $product->name }}" width="70px"
                        height="70px"></td>
                <td>{{ $product->title }}</td>
                <td>
                    @foreach ($product->categories as $category)
                        <span class="badge rounded-pill bg-secondary" >{{ $category->name }}</span>
                    @endforeach
                </td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->quantity }}</td>

                <td>
                    @if ($product->status === 'on')
                        <span class="badge rounded-pill bg-success">active</span>
                    @else
                        <span class="badge rounded-pill bg-danger">Inactive</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-outline-secondary">Edit
                        <span data-feather="edit"></span>
                    </a>
                    <form action="{{ route('product.destroy', $product->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete
                            <span data-feather="trash"></span>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach



    </table>
    <div class="modal fade py-5" id="addProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-5 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h2 class="fw-bold mb-0">Add Product</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form action="{{ route('product.store') }}" enctype="multipart/form-data" method="POST">
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
                        <label for="category">Category</label>
                        <select class="form-select form-select-sm" multiple size="3" id="category" name="categories[]">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">use ctrl+click to select multiple categories</div>

                    </div>

                    <div class="mb-3">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                            value="{{ old('title') }}">
                        @error('title')
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
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Enter price"
                            value="{{ old('price') }}">
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity"
                            value="{{ old('quantity') }}">
                        @error('quantity')
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
{{ $products->onEachSide(1)->links() }}


@endsection
