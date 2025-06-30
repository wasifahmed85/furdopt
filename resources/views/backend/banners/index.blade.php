@extends('backend.master')

@section('title', 'Pages')

@push('css')
@endpush

@section('content')

    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Ad Banners</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ad Banners</li>
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

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ad Banner</h3>
                            <a href="{{ route('admin.banners.create') }}">
                                <h3 class="card-title btn btn-secondary" style="float: right; color:#ffffff">Create Ad Banner</h3>
                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sl</th>
                                        <th class="text-center">Banner</th>
                                        <th class="text-center">Category</th>

                                        <th class="text-center">Title</th>



                                        <th class="text-center">Status</th>


                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($banners as $key => $banner)
                                        <tr>
                                            <td class="text-center text-muted">{{ $key + 1 }}</td>
                                            <td>
                                                <img src="{{ asset('images') }}/{{ $banner->banner }}" alt="banner photo"
                                                    width="100" height="100">

                                            </td>


                                            <td>{{ $banner->category->name }}</td>
                                            <td>{{ $banner->title }}</td>

                                            <td class="text-center">{{ $banner->status == 1 ? 'Published' : 'Unpublished' }}
                                            </td>
                                            <td class="text-center">

                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('admin.banners.edit', $banner->id) }}"><i
                                                        class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </a>


                                                <form action="{{ route('admin.banners.destroy', $banner->id) }}"
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
