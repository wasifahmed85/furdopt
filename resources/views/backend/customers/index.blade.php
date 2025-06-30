@extends('backend.master')

@section('title', 'Pages')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.1/css/buttons.bootstrap5.min.css">
@endpush

@section('content')

    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Customers</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Customer</li>
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
                            <h3 class="card-title">Customer</h3>
                            {{-- <a href="{{ route('admin.categories.create') }}">
                                <h3 class="card-title btn btn-secondary" style="float: right; color:#ffffff">Create Category
                                </h3>
                            </a> --}}

                            @if (Session::has('status'))
                                <p style="text-align: center; color:red">{{ Session::get('status') }}</p>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="myDataTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl</th>


                                        <th class="text-center">Name</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Type</th>
                                        <th class="text-center">Verify Status</th>





                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($customers as $key => $customer)
                                        <tr>
                                            <td class="text-center text-muted">{{ $key + 1 }}</td>



                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->pet_owner_type }}</td>
                                            <td>{{ $customer->verify_status == 1 ? 'Verified' : 'Unverified' }}</td>


                                            <td class="text-center">

                                                <form method="post" action="{{ route('admin.customer.statuschange') }}">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $customer->id }}">
                                                    <div class="col-12">


                                                        <select name="account_manager" class="form-control mb-2"
                                                            onchange="this.form.submit()">
                                                            <option value="" selected disabled>Verify Status Change
                                                            </option>

                                                            <option value="1">Verify</option>
                                                            <option value="0">Unverified</option>

                                                        </select>

                                                    </div>


                                                </form>

                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('admin.customers.show', $customer->id) }}"><i
                                                        class="fas fa-eye"></i>
                                                    <span>Show</span>
                                                </a>


                                                <form action="{{ route('admin.customers.destroy', $customer->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf()
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are your sure?')"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </form>



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


@section('alert')


@endsection


@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.min.js"></script>
@endpush
