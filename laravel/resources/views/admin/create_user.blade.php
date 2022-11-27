@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Admin :: Create User</div>

                    <div class="card-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.save_user') }}" method="post">
                            @csrf
                            <div class="mb-3 row">
                                <label for="inputName" class="col-sm-2 col-form-label">Full Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control" id="inputName">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="email" id="staticEmail"
                                        value="">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="inputRole" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="role[]" multiple aria-label="Default select example">
                                        <option value="" selected>Select one role</option>
                                        @foreach ($role as $k => $v)
                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{route('admin.get_user_view')}}" class="btn btn-success ">User List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
