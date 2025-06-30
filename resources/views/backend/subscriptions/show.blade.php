@extends('backend.master')
@push('css')
    <!-- summernote -->
    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css')}}"> --}}
@endpush



@section('content')

    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Subscription</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.subscriptions.index') }}">Subscription</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Subscription</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>


    <!-- Main content -->
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payment Information</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 200px">User</th>
                                            <td>{{ $payment->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>User ID</th>
                                            <td>{{ $payment->user_id ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Subscription Plan ID</th>
                                            <td>{{ $payment->subcription->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Gateway</th>
                                            <td><span class="badge bg-info">{{ $payment->payment_gateway }}</span></td>
                                        </tr>
                                        <tr>
                                            <th>Transaction ID</th>
                                            <td><code>{{ $payment->transaction_id }}</code></td>
                                        </tr>
                                        <tr>
                                            <th>Amount</th>
                                            <td>${{ number_format($payment->amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                <span class="badge bg-success">{{ ucfirst($payment->status) }}</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Subscription Period</h3>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                             
                                                    
                                             
                                               
                                             
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-default">
                                <i class="fas fa-arrow-left"></i> Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->







    @endsection
    @push('js')
    @endpush
