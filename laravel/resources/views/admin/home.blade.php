@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin :: Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('admin.create_user_view') }}" type="button" class="btn btn-primary">Create User</a>
                        <a href="{{ route('admin.get_user_view') }}" type="button" class="btn btn-secondary">User list</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
