@extends('backend.master')
@push('css')
@endpush

@section('title', 'Users')

@section('content')


    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create User</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>


    <div class="app-content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- form start -->
                    <form role="form" id="userFrom" method="POST"
                        action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @if (isset($user))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">

                                        <label for="Name">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $user->name ?? '' }}" field-attributes="required autofocus">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror



                                        <label for="Name">Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ $user->email ?? '' }}" field-attributes="required autofocus">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror

                                        <label for="Name">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            {{ !isset($user) ? 'required' : '' }} }}>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror

                                        <label for="Name">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            {{ !isset($user) ? 'required' : '' }}>
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <div class="col-md-6">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">



                                        <label for="Select Role" name="role" class=""> Select Role</label>
                                        <select class="js-example-basic-multiple form-control" name="role_id">
                                            <option>Select Roles</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->id }}"
                                                    @isset($user) {{ $user->role_id == $role->id ? 'selected' : '' }} @endisset>
                                                    {{ $role->name }}</option>
                                            @endforeach

                                            {{-- <option value="admin"
                                                @isset($user) {{ $user->role == 'admin' ? 'selected' : '' }} @endisset>
                                                Admin</option>
                                            <option value="owner"
                                                @isset($user) {{ $user->role == 'owner' ? 'selected' : '' }} @endisset>
                                                Customer</option> --}}


                                        </select>

                                        <div class="form-group">

                                            <div>
                                                <input type="file" name="avatar" placeholder="Choose image"
                                                    id="image">
                                                @error('image')
                                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                @enderror
                                                <img id="preview-image-before-upload"
                                                    src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                    alt="preview image" style="max-height: 250px;">
                                            </div>

                                        </div>






                                        <button type="submit" class="cursor btn btn-primary mt-2">
                                            @isset($user)
                                                <i class="fas fa-arrow-circle-up"></i>
                                                update
                                            @else
                                                <i class="fas fa-plus-circle"></i>
                                                create
                                            @endisset
                                        </button>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


@push('js')
    <script type="text/javascript">
        $(document).ready(function(e) {


            $('#image').change(function() {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('#preview-image-before-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });
    </script>
@endpush
