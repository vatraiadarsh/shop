@extends("layouts.admin")
@section('content')
    <div class="modal modal-signin position-static d-block bg-light py-5" tabindex="-1" role="dialog" id="editCategory">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-5 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Edit category</h2>
                </div>

                <div class="modal-body">
                    <form action=" {{ url('admin/category/' . $category->id) }} " enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                value={{ $category->name }}>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3">{{ $category->description }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox"
                                    {{ $category->status == 'on' ? 'checked' : '' }} name="status" role="switch"
                                    id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">Status</label>
                            </div>
                        </div>



                        <div class="mb-3">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @if ($category->image)
                                <br>
                                <img src="{{ asset('images/category/' . $category->image) }}" alt="{{ $category->name }}"
                                    class="rounded mx-auto d-block" width="100px" height="100px">
                            @endif
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <a href="/admin/category" type="button" class="btn btn-secondary">Go Back</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
