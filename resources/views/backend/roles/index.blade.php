@extends('backend.master')

@section('title', 'Roles')

@push('css')
@endpush

@section('content')

    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Roles</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Roles</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>



    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Role</h3>
                            <a href="{{ route('admin.roles.create') }}">
                                <h3 class="card-title" style="float: right;">Create Role</h3>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Permissions</th>
                                        <th class="text-center">Since</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $key => $role)
                                        <tr>
                                            <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                            <td class="text-center">{{ $role->name }}</td>
                                            <td class="text-center">
                                                @if ($role->permissions->count() > 0)
                                                    <span
                                                        class="badge text-bg-success">{{ $role->permissions->count() }}</span>
                                                    {{--                                        <span class="badge badge-info">{{ $role->permissions->name }}</span> --}}
                                                @else
                                                    <span class="badge text-bg-danger">No permission found :(</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $role->created_at ? $role->created_at->diffForHumans() : 'N/A' }}</td>
                                          
                                            <td class="text-center">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('admin.roles.edit', $role->id) }}"><i
                                                        class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </a>
                                                @if ($role->deletable == true)
                                                    <form action="{{ route('admin.roles.destroy', $role->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf()
                                                        @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are your sure?')"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash-alt"></i>
                                                            <span>Delete</span>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach


                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->





@endsection

@push('js')
@endpush
