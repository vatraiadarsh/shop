@extends("layouts.admin")
@section('content')
    <div class="modal modal-signin position-static d-block bg-light py-5" tabindex="-1" role="dialog" id="editProduct">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content rounded-5 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Edit product</h2>
                </div>

                <div class="modal-body">
                    <form action=" {{ url('admin/product/' . $product->id) }} " enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                value={{ $product->name }}>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category">Category</label>
                            <select class="form-select form-select-sm" multiple size="3" id="category" name="categories[]">
                                @foreach ($categories as $category)
                                    <option {{ $product->categories->contains($category->id) ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-text">use ctrl+click to select multiple categories</div>

                        </div>

                        <div class="mb-3">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if ($product->image)
                                <br>
                                <img src="{{ asset('images/product/' . $product->image) }}" alt="{{ $product->name }}"
                                    class="rounded mx-auto d-block" width="100px" height="100px">
                            @endif
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                                value={{ $product->title }}>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Enter price"
                                value={{ $product->price }}>
                            @error('price')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                placeholder="Enter quantity" value={{ $product->quantity }}>
                            @error('quantity')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                    {{ $product->status == 'on' ? 'checked' : '' }} name="status" role="switch"
                                    id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Status</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="/admin/product" type="button" class="btn btn-secondary">Go Back</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
