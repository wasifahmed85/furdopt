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
                    <h3 class="mb-0">Subscriber List</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Subscriber List</li>
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
                            <h3 class="card-title">Subscriber List</h3>

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


                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Duration (Month)</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Ad Allowed</th>
                                        <th class="text-center">Feature</th>
                                        <th class="text-center">Top Search</th>





                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($subscriptions as $key => $subscripttion)
                                        <tr>
                                            <td class="text-center text-muted">{{ $key + 1 }}</td>


                                            <td class="text-center">{{ $subscripttion->user->name }}</td>
                                            <td class="text-center">{{ $subscripttion->amount }}</td>

                                            <td class="text-center">{{ $subscripttion->subcription->duration }}</td>
                                            <td class="text-center">{{ $subscripttion->subcription->price }}</td>
                                            <td class="text-center">{{ $subscripttion->subcription->max_pets_allowed }}</td>
                                            <td class="text-center">
                                                {{ $subscripttion->subcription->can_feature_pets == true ? 'Allowed' : 'Not Allowed' }}
                                            </td>
                                            <td class="text-center">
                                                {{ $subscripttion->subcription->can_top_search_pets == true ? 'Yes' : 'No' }}
                                            </td>



                                            <td class="text-center">

                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('admin.subscriptions.show', $subscripttion->id) }}"><i
                                                        class="fas fa-eye"></i>
                                                    <span>Show</span>
                                                </a>






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
