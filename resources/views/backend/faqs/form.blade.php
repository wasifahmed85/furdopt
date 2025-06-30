@extends('backend.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs5.min.css" rel="stylesheet">
@endpush



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Faqs</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.faqs.index') }}">Faqs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">faq Create</li>
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
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __((isset($faq) ? 'Edit' : 'Create New') . ' faq') }}
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- form start -->

                        <form role="form" id="submitFromDisable" method="POST"
                            action="{{ isset($faq) ? route('admin.faqs.update', $faq->id) : route('admin.faqs.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($faq))
                                @method('PUT')
                            @endif

                            <div class="card card-default">

                                <!-- /.card-header -->
                                <div class="card-body">





                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" class="form-control" name="title"
                                            value=" {{ $faq->title ?? '' }}" field-attributes="required autofocus">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Descriptions</label>
                                        <textarea name="description" id="summernote" class="form-control summernote" field-attributes="required autofocus">
@isset($faq)
{{ $faq->description }}
@endisset
</textarea>

                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>





                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div>
                                            <button type="submit" class="cursor btn btn-primary" id="submitBtnDisable">
                                                @isset($faq)
                                                    <i class="fas fa-arrow-circle-up"></i>
                                                    Update
                                                @else
                                                    <i class="fas fa-plus-circle"></i>
                                                    Create
                                                @endisset
                                            </button>

                                        </div>
                                    </div>
                                </div>

                        </form>
                    </div>
                    <!-- /.card -->
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>







    @endsection
    @push('js')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

        <!-- Before closing body tag, add scripts in this order -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

        <script>
            $(function() {
                // Wait for document ready
                setTimeout(function() {
                    $('.summernote').summernote({
                        height: 300,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'underline', 'clear']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture']],
                            ['view', ['fullscreen', 'codeview', 'help']]
                        ]
                    });
                }, 100);
            });
        </script>
    @endpush
