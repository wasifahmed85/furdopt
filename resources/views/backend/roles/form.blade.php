@extends('backend.master')

@section('title', 'Roles')

@section('content')






    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ isset($role) ? 'Edit' : 'Create New' }} Roles & Permissions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Back to List</a></li>
                        <li class="breadcrumb-item active">Create Module</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create Module</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="submitFromDisable" role="form" method="POST"
                            action="{{ isset($role) ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}">
                            @csrf
                            @if (isset($role))
                                @method('PUT')
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">Create Role</h5>


                                <input type="text" name="name" class="form-control mt-2" value="{{ $role->name ?? '' }}">



                                <div class="text-center mt-2">
                                    <strong>Manage permissions for role</strong>
                                    @error('permissions')
                                        <p class="p-2">
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        </p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="select-all">
                                        <label class="custom-control-label" for="select-all">Select All</label>
                                    </div>
                                </div>
                                @forelse($modules->chunk(3) as $key => $chunks)
                                    <div class="row">
                                        @foreach ($chunks as $key => $module)
                                            <div class="col-md-4">
                                                <h5>Module: {{ $module->name }}</h5>
                                                @foreach ($module->permissions as $key => $permission)
                                                    <div class="mb-3 ml-4">
                                                        <div class="custom-control custom-checkbox mb-2">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="permission-{{ $permission->id }}"
                                                                value="{{ $permission->id }}" name="permissions[]"
                                                                @if (isset($role)) @foreach ($role->permissions as $rPermission)
                                                              {{ $permission->id == $rPermission->id ? 'checked' : '' }}
                                                              @endforeach @endif>
                                                            <label class="custom-control-label"
                                                                for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                @empty
                                    <div class="row">
                                        <div class="col text-center">
                                            <strong>No Module Found.</strong>
                                        </div>
                                    </div>
                                @endforelse

                                <button type="button" class="btn btn-danger" onClick="resetForm('roleFrom')">
                                    <i class="fas fa-redo"></i>
                                    <span>Reset</span>
                                </button>

                                <button type="submit" class="btn btn-primary" id="submitBtnDisable">
                                    @isset($role)
                                        <i class="fas fa-arrow-circle-up"></i>
                                        <span>Update</span>
                                    @else
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Create</span>
                                    @endisset
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->

        </div>
        <!-- /.content-wrapper -->








    @endsection

    @push('js')
        <script type="text/javascript">
            // Listen for click on toggle checkbox
            $('#select-all').click(function(event) {
                if (this.checked) {
                    // Iterate each checkbox
                    $(':checkbox').each(function() {
                        this.checked = true;
                    });
                } else {
                    $(':checkbox').each(function() {
                        this.checked = false;
                    });
                }
            });
        </script>
    @endpush
