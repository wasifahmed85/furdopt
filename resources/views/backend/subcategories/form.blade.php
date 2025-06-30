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
                    <h3 class="mb-0">Breeds</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.subCategories.index') }}">Breeds</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Breed Create</li>
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
                            <h3 class="card-title">{{ __((isset($subCategory) ? 'Edit' : 'Create New') . ' Breed') }}
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- form start -->

                        <form role="form" id="submitFromDisable" method="POST"
                            action="{{ isset($subCategory) ? route('admin.subCategories.update', $subCategory->id) : route('admin.subCategories.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($subCategory))
                                @method('PUT')
                            @endif

                            <div class="card card-default">

                                <!-- /.card-header -->
                                <div class="card-body">




                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select name="category_id" class="form-control" required>
                                            <option disabled selected>Selectet Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{$category->id}}" @isset($subCategory)
                                                @if($subCategory->category_id == $category->id) selected @endif
                                            @endisset>{{$category->name}}</option>

                                            @endforeach
                                        </select>

                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" name="name"
                                            value=" {{ old('name', $subCategory->name ?? '') }}"
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
                                            value=" {{ old('meta_title', $subCategory->meta_title ?? '') }}"
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
                                            value=" {{ old('meta_keywords', $subCategory->meta_keywords ?? '') }}"
                                            field-attributes="required autofocus">
                                        @error('meta_keywords')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">SEO Descriptions</label>
                                        <textarea n class="form-control" name="meta_description">@isset($subCategory){{$subCategory->meta_description}}

                                        @endisset</textarea>

                                        @error('meta_description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Published Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        value="1"
                                                        @isset($subCategory)
                                        {{ $subCategory->status == 1 ? 'checked' : '' }}@endisset>
                                                    <label class="form-check-label">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        value="0"
                                                        @isset($subCategory)
                                            {{ $subCategory->status == 0 ? 'checked' : '' }}@endisset>
                                                    <label class="form-check-label">Deactive</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div>
                                            <button type="submit" class="cursor btn btn-primary" id="submitBtnDisable">
                                                @isset($subCategory)
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
