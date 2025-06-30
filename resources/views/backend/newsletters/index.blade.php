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
                    <h3 class="mb-0">Newsletter Subscriber</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Newsletter Subscriber</li>
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
                            <h3 class="card-title">Newsletter Subscriber</h3>
                            {{-- <a href="{{ route('admin.categories.create') }}">
                                <h3 class="card-title" style="float: right">Create Category</h3>
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


                                        <th class="text-center">Email</th>





                                        {{-- <th class="text-center">Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($newses as $key => $news)
                                        <tr>
                                            <td class="text-center text-muted">{{ $key + 1 }}</td>



                                            <td >{{ $news->email }}</td>


                                            {{-- 
                                            <td class="text-center">

                                            

                                                <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf()
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are your sure?')"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash-alt"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </form>



                                            </td> --}}
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
