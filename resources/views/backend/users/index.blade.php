@extends('backend.master')

@section('title', 'Users')


@push('css')
@endpush
@section('content')


    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Users</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>




    <!-- Main content -->
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {{-- status --}}


                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Users</h3>
                            <a href="{{ route('admin.users.create') }}">
                                <h3 class="card-title btn btn-secondary" style="float: right; color:#ffffff">Create user
                                </h3>
                            </a>

                            @if (Session::has('status'))
                                <p style="text-align: center; color:red">{{ Session::get('status') }}</p>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="myDataTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Avatar</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Role</th>
                                        <th class="text-center">Email</th>
                                        {{-- <th class="text-center">Status</th> --}}
                                        <th class="text-center">Joined At</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($users as $key => $user)
                                        <tr>
                                            <td class="text-center text-muted">#{{ $key + 1 }}</td>
                                            <td class="text-center text-muted"><img width="40" class="rounded-circle"
                                                    src="{{ asset('images') }}/{{ $user->avatar }}" alt="User Avatar"></td>


                                            <td class="text-center">{{ $user->name ?? '' }}</td>
                                            <td class="text-center">{{ $user->role->name ?? '' }}</td>
                                            <td class="text-center">{{ $user->email }}</td>
                                            {{-- <td class="text-center">
                                                @if ($user->status)
                                                    <div class="badge badge-success">Active</div>
                                                @else
                                                    <div class="badge badge-danger">Inactive</div>
                                                @endif
                                            </td> --}}
                                            <td class="text-center">{{ $user->created_at->diffForHumans() }}</td>
                                            <td class="text-center">
                                                <a class="btn btn-secondary btn-sm"
                                                    href="{{ route('admin.users.show', $user->id) }}"><i
                                                        class="fas fa-eye"></i>
                                                    <span>Show</span>
                                                </a>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('admin.users.edit', $user->id) }}"><i
                                                        class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </a>
                                                @if (Auth::user()->id == $user->id)
                                                @else
                                                    <form action="{{ route('admin.users.destroy', $user->id) }}"
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
                                </tbody>
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
    <!-- /.content-wrapper -->






@endsection


@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.min.js"></script>
@endpush
