@extends('backend.master')

@section('title', 'Pages')

@push('css')
@endpush

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="app-content-header">
        <!-- Content Header (Page header) -->

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brand</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Brand</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    {{-- status --}}


                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Brand</h3>
                            <a href="{{ route('admin.brands.create') }}">
                                <h3 class="card-title float-right">Create Brand</h3>
                            </a>

                            @if (Session::has('status'))
                                <p style="text-align: center; color:red">{{ Session::get('status') }}</p>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl</th>
                                        <th class="text-center">Image</th>

                                        <th class="text-center">Name</th>

                                        <th class="text-center">Status</th>

                                        <th class="text-center">Feature Status</th>


                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($brands as $key => $brand)
                                        <tr>
                                            <td class="text-center text-muted">{{ $key + 1 }}</td>
                                            <td>
                                                <img src="{{ asset('images/backend') }}/{{ $brand->image }}"
                                                    alt="brand photo" width="50" height="50">

                                            </td>


                                            <td>{{ $brand->name }}</td>











                                            <td class="text-center">{{ $brand->status == 1 ? 'Published' : 'Unpublished' }}
                                            </td>
                                            <td class="text-center">{{ $brand->feature == 1 ? 'Published' : 'Unpublished' }}
                                            </td>
                                            <td class="text-center">

                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('admin.brands.edit', $brand->id) }}"><i
                                                        class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </a>


                                                <form action="{{ route('admin.brands.destroy', $brand->id) }}"
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
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection


@section('alert')


@endsection


@push('js')
    <script></script>
@endpush
