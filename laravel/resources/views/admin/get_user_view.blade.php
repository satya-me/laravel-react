@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin :: Get User</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form>
                            @csrf
                            <div class="mb-3 row">
                                <label for="inputRole" class="col-sm-2 col-form-label">Role wise</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="role" id="role"
                                        aria-label="Default select example" onchange="getUser();">
                                        <option value="" selected>Select one role</option>
                                        @foreach ($role as $k => $v)
                                            <option value="{{ $v->id }}">{{ $v->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mt-1" id="get-user">
                    <div class="card-header">Get User</div>
                    <table class="table">
                        <h5 class="text-center mt-2">User not found!</h5>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function getUser() {
            var role = $('#role').val();
            var get_user = $('#get-user');
            get_user.empty();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "{{ route('admin.get_user') }}",
                data: {
                    role_id: role,
                },
                success: function(resp) {
                    console.log(resp);
                    get_user.append(resp);
                }
            });
        }
    </script>
@endsection
