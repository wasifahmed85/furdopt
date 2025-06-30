@extends('backend.master')
@push('css')
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
                    <h3 class="mb-0">Buyer's checklist</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.scams.index') }}">Buyer's checklist</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checklist Create</li>
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
                            <h3 class="card-title">{{ __((isset($scam) ? 'Edit' : 'Create New') . ' Checklist') }}
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- form start -->

                        <form role="form" id="submitFromDisable" method="POST"
                            action="{{ isset($scam) ? route('admin.scams.update', $scam->id) : route('admin.scams.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($scam))
                                @method('PUT')
                            @endif

                            <div class="card card-default">

                                <!-- /.card-header -->
                                <div class="card-body">





                                  
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" class="form-control" name="title"
                                            value=" {{ $scam->title ?? '' }}" field-attributes="required autofocus">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>





                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div>
                                            <button type="submit" class="cursor btn btn-primary" id="submitBtnDisable">
                                                @isset($scam)
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
        <!-- Summernote -->
        <script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
        <script>
            $(function() {
                // Summernote
                $('#summernote').summernote()

                // CodeMirror
                CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                    mode: "htmlmixed",
                    theme: "monokai"
                });
            })
        </script>

        <script>
            $(function() {
                // Summernote
                $('#summernote2').summernote()

                // CodeMirror
                CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                    mode: "htmlmixed",
                    theme: "monokai"
                });
            })
        </script>
    @endpush
