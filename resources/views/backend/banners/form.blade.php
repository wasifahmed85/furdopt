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
                    <h3 class="mb-0">Ad Banners</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Ad Banners</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ad Banner Create</li>
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
                            <h3 class="card-title">{{ __((isset($banner) ? 'Edit' : 'Create New') . ' Ad banner') }}
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- form start -->

                        <form role="form" id="submitFromDisable" method="POST"
                            action="{{ isset($banner) ? route('admin.banners.update', $banner->id) : route('admin.banners.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($banner))
                                @method('PUT')
                            @endif

                            <div class="card card-default">

                                <!-- /.card-header -->
                                <div class="card-body">




                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" class="form-control" name="title"
                                            value=" {{ $banner->title ?? '' }}" field-attributes="required autofocus">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                                                       <div class="form-group">
                                        <label for="exampleInputEmail1">Descriptions</label>
                                        <textarea name="descriptions" class="form-control">@isset($banner){{ $banner->descriptions }}@endisset</textarea>
                                        
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Category</label>
                                        <select name="category_id" required="" id="banner_type" class="form-control">
                                            <option>Select Type</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @isset($banner) {{ $banner->category_id == $category->id ? 'selected' : '' }}@endisset>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('banner_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="exampleInputEmail1">Type</label>
                                        <select name="banner_type" required="" id="banner_type" class="form-control">
                                            <option>Select Type</option>
                                            <option value="1"
                                                @isset($banner) {{ $banner->banner_type == 1 ? 'selected' : '' }}@endisset>
                                                Home Banner</option>
                                            <option value="2"
                                                @isset($banner) {{ $banner->banner_type == 2 ? 'selected' : '' }}@endisset>
                                                Top Banner</option>
                                            <option value="3"
                                                @isset($banner) {{ $banner->banner_type == 3 ? 'selected' : '' }}@endisset>
                                                Bottom Banner</option>
                                        </select>
                                        @error('banner_type')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div> --}}


                                    {{-- <div class="form-group">
                                        <label for="exampleInputEmail1">Url</label>
                                        <input type="text" class="form-control" name="url"
                                            value=" {{ $banner->url ?? '' }}" field-attributes="required autofocus">
                                        @error('url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div> --}}
                                    {{-- <div class="form-group">
                                            <label for="exampleInputEmail1">Caption 3</label>
                                            <input type="text" class="form-control" name="caption3"
                                                value=" {{ $banner->caption3 ?? ''  }}"
                                                field-attributes="required autofocus">
                                            @error('caption3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}} </strong>
                                            </span>
                                            @enderror
                                        </div> --}}





                                    <div class="form-group">


                                        <input type="file" name="banner" placeholder="Choose image" id="image">
                                        @error('image')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                        <img id="preview-image-before-upload"
                                            src="https://www.riobeauty.co.uk/images/banner_image_not_found.gif"
                                            alt="preview image" style="height: 100px; width:100px">

                                        @isset($banner)
                                            <img id="preview-image-before-upload"
                                                src="{{ asset('images') }}/{{ $banner->banner }}" alt="preview image"
                                                style="height: 100px; width:100px">
                                        @endisset

                                    </div>

                                    <div class="form-group">
                                        <label class="form-group-label" for="exampleInputEmail1">Status</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="1"
                                                @isset($banner)
                                        {{ $banner->status == 1 ? 'checked' : '' }}@endisset>
                                            <label class="form-check-label">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="0"
                                                @isset($banner)
                                            {{ $banner->status == 0 ? 'checked' : '' }}@endisset>
                                            <label class="form-check-label">Deactive</label>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div>
                                            <button type="submit" class="cursor btn btn-primary" id="submitBtnDisable">
                                                @isset($banner)
                                                    <i class="fas fa-arrow-circle-up"></i>
                                                    Update
                                                @else
                                                    <i class="fas fa-plus-circle"></i>
                                                    create
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
