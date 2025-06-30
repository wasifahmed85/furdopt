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
                    <h3 class="mb-0">Categories</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Categories</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category Create</li>
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
                            <h3 class="card-title">{{ __((isset($category) ? 'Edit' : 'Create New') . ' category') }}
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- form start -->

                        <form role="form" id="submitFromDisable" method="POST"
                            action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($category))
                                @method('PUT')
                            @endif

                            <div class="card card-default">

                                <!-- /.card-header -->
                                <div class="card-body">




                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value=" {{ old('name', $category->name ?? '') }}"
                                            field-attributes="required autofocus">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">SEO Title</label>
                                        <input type="text" class="form-control" name="meta_title"
                                            value=" {{ old('meta_title', $category->meta_title ?? '') }}"
                                            field-attributes="required autofocus">
                                        @error('meta_title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">SEO Keywords</label>
                                        <input type="text" class="form-control" name="meta_keywords"
                                            value=" {{ old('meta_keywords', $category->meta_keywords ?? '') }}"
                                            field-attributes="required autofocus">
                                        @error('meta_keywords')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">SEO Descriptions</label>
                                        <textarea n class="form-control" name="meta_description">
@isset($category)
{{ $category->meta_description }}
@endisset
</textarea>

                                        @error('meta_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">


                                        <input type="file" name="image" placeholder="Choose image" id="image" >
                                        @error('image')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                        <img id="preview-image-before-upload" src="" style="max-height: 250px;">

                                        @isset($category)
                                            <img src="{{ asset('images') }}/{{ $category->image }}" alt="banner photo"
                                                    width="100" height="100">
                                        @endisset

                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Published Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        value="1"
                                                        @isset($category)
                                        {{ $category->status == 1 ? 'checked' : '' }}@endisset>
                                                    <label class="form-check-label">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        value="0"
                                                        @isset($category)
                                            {{ $category->status == 0 ? 'checked' : '' }}@endisset>
                                                    <label class="form-check-label">Deactive</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div>
                                            <button type="submit" class="cursor btn btn-primary" id="submitBtnDisable">
                                                @isset($category)
                                                    <i class="fas fa-arrow-circle-up"></i>
                                                    update
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

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->







    @endsection
    @push('js')
        {{-- <!-- Summernote -->
<script src="{{ asset('backend/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $(function () {
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
    $(function () {
      // Summernote
      $('#summernote2').summernote()

      // CodeMirror
      CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
        mode: "htmlmixed",
        theme: "monokai"
      });
    })
  </script> --}}
    @endpush
