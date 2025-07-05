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
                    <h3 class="mb-0">Promote Pet Listing</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Promote Pet</li>
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
                        <div class="card-body">
                            <table id="myDataTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl</th>
                                        <th class="text-center">User Name</th>
                                        <th class="text-center">Pet Name</th>
                                        <th class="text-center">Promote Amount</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Transaction ID</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($pets as $key => $pet)
                                        <tr>
                                            <td class="text-center text-muted">{{ $key + 1 }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.customers.show', $pet->owner_id) }}" wire:navigate style="text-decoration: none;">
                                                    {{ $pet->user->name }}
                                                <a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.pets.show', $pet->id) }}" wire:navigate style="text-decoration: none;">
                                                    {{ $pet->name }}
                                                <a>
                                            </td>
                                            <td class="text-center text-muted">
                                                {{ $pet->promotePayments->isNotEmpty() ? $pet->promotePayments->last()->amount : 'N/A' }}
                                            </td>
                                            <td class="text-center text-muted">
                                                {{ $pet->promotePayments->isNotEmpty() ? ($pet->promotePayments->last()->status === 'COMPLETED' ? 'Paid' : 'Unpaid') : 'Unpaid' }}
                                            </td>
                                            <td class="text-center text-muted">
                                                {{ $pet->promotePayments->isNotEmpty() ? $pet->promotePayments->last()->transaction_id : 'N/A' }}
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
