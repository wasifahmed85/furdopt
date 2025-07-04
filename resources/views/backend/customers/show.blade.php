@extends('backend.master')

@section('title', 'User Details')

@section('content')


    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ __('User Details') }}</h3>
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
        <div class="row">
            <div class="col-md-2">
                <div class="main-card mb-3 card">
                     <div class="card-body">
                        <img src="{{ asset('images') }}/{{ $user->avatar ?? 'default.jpg' }}"
                            class="img-fluid img-thumbnail mb-3" alt="avatar">
                            
                         @if($user->rehoming_centre !=null)
                            
                            <img  src="{{ asset('images/' . $detail->rehome_centre_p) }}" 
                                    class="img-fluid img-thumbnail">
                            @endif
                    </div>
                    
                   
                   
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-10">
                <div class="main-card card">
                    <div class="card-body p-0">
                        <table class="table table-hover mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row">Name:</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                 @if($user->rehoming_centre !=null)
                                <tr>
                                    <th scope="row">Rehome Centre:</th>
                                    <td>{{ $user->rehoming_centre }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Rehome Centre Id:</th>
                                    <td>{{ $user->Rehoming_centre_id }}</td>
                                </tr>
                                @endif

                                <tr>
                                    <th scope="row">Email:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Role:</th>
                                    <td>
                                        @if ($user->role)
                                            <span class="badge text-info">{{ $user->role->name }}</span>
                                        @else
                                            <span class="badge text-bg-danger">Customer</span>
                                        @endif
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <th scope="row">Status:</th>
                                    <td>
                                        @if ($user->status)
                                            <div class="badge badge-success">Active</div>
                                        @else
                                            <div class="badge badge-danger">Inactive</div>
                                        @endif
                                    </td>
                                </tr> --}}
                                <tr>
                                    <th scope="row">Joined At:</th>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Last Modified At:</th>
                                    <td>{{ $user->updated_at->diffForHumans() }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Last Login At:</th>
                                    <td>{{ $user->last_login_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="page-title-actions" style="float: right">
                            <div class="d-inline-block dropdown">
                                {{--
                                <a href="{{ route('admin.customers.edit', $user->id) }}" class="btn-shadow btn btn-info">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fas fa-edit fa-w-20"></i>
                                    </span>
                                    {{ __('Edit') }}
                                </a>
                                
                                --}}
                                <a href="{{ route('admin.customers.index') }}" class="btn-shadow btn btn-danger">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="fas fa-arrow-circle-left fa-w-20"></i>
                                    </span>
                                    {{ __('Back to list') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
