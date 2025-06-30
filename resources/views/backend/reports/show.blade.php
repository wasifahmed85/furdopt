@extends('backend.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs5.min.css" rel="stylesheet">
    <style>
        .table th {
            background-color: #f4f6f9;
        }

        .table td,
        .table th {
            padding: 1rem;
            vertical-align: top;
        }
    </style>
@endpush



@section('content')

    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Reports</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Reports</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Page Create</li>
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
                            <h3 class="card-title">Detail View</h3>
                            <div class="card-tools">
                                <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back
                                </a>
                                <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 200px">Name</th>
                                            <td>{{ $page->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Serial</th>
                                            <td>{{ $page->serial }}</td>
                                        </tr>
                                        <tr>
                                            <th>Slug</th>
                                            <td>{{ $page->slug }}</td>
                                        </tr>
                                        <tr>
                                            <th>Title</th>
                                            <td>{{ $page->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Headline</th>
                                            <td>{{ $page->headline }}</td>
                                        </tr>
                                        <tr>
                                            <th>Header</th>
                                            <td>{{ $page->header }}</td>
                                        </tr>
                                        <tr>
                                            <th>Summary</th>
                                            <td>{{ $page->summery }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{!! $page->descriptions !!}</td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $page->created_at->format('d M Y H:i:s') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated At</th>
                                            <td>{{ $page->updated_at->format('d M Y H:i:s') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                {{ $page->status == 1 ? 'Published' : 'Unpublished' }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>






    @endsection
    @push('js')
    @endpush
