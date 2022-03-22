@extends("layouts.admin")
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Profile</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
            </button>
        </div>
    </div>

    @if(Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
    @endif

    @if(Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
    @endif

       {{-- display the info about user and profile from controller --}}

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Basci Info</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img  src="{{ asset('images/profile/' . $profile->avatar) }}" alt="{{ $user->name }}"
                                class="rounded mx-auto d-block" width="100px" height="100px">
                        </div>
                        <div class="col-md-7">
                            <p>Name: {{ $user->name }}</p>
                            <p>Email: {{ $user->email }}</p>
                            <p>Phone: {{ $profile->phone }}</p>
                            <p>Country: {{ $profile->city }}, {{ $profile->country }}</p>
                            <p>Address: {{ $profile->address }}, {{ $profile->zip }}, {{ $profile->state }}</p>
                        </div>
                    </div>

                </div>



            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Update profile</h5>
                </div>
                <div class="card-body">




                    <form action="{{url('admin/profile/'.$profile->id)}}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                value="{{ $user->name }}">
                        </div>

                        <div class="form-group mb-3 ">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{$profile->phone}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" name="country" id="country" value="{{$profile->country}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="city">City</label>
                            <input type="text" class="form-control" name="city" id="city" value="{{$profile->city}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{$profile->address}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" name="zip" id="zip" value="{{$profile->zip}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="state">State</label>
                            <input type="text" class="form-control" name="state" id="state" value="{{$profile->state}}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="avatar" id="avatar">
                        </div>

                        <button type="submit" class="btn btn btn-outline-success">Update</button>
                    </form>
                </div>
            </div>
        </div>


    </div>



@endsection
