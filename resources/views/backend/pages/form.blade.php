@extends('backend.master')
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs5.min.css" rel="stylesheet">
@endpush



@section('content')

    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Pages</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Pages</a></li>
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
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-body">
                            <form role="form" id="submitFromDisable" method="POST"
                                action="{{ isset($page) ? route('admin.pages.update', $page->id) : route('admin.pages.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                @if (isset($page))
                                    @method('PUT')
                                @endif

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="@isset($page)
{{ old('name', $page->name ?? '') }}
@endisset"
                                        placeholder="Enter Page Name">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slug">Serial</label>
                                    <input type="text" name="serial" id="serial"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="@isset($page)
{{ old('serial', $page->serial ?? '') }}
@endisset">
                                    @error('serial')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="@isset($page)
{{ old('title', $page->title ?? '') }}
@endisset">
                                    @error('title')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- 
                                <div class="form-group">
                                    <label for="headline">Headline</label>
                                    <input type="text" name="headline" id="headline"
                                        class="form-control @error('headline') is-invalid @enderror"
                                        value="@isset($page)
{{ old('headline', $page->headline ?? '') }}
@endisset">
                                    @error('headline')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div> --}}

                                {{-- <div class="form-group">
                                    <label for="header">Header</label>
                                    <input type="text" name="header" id="header"
                                        class="form-control @error('header') is-invalid @enderror"
                                        value="@isset($page)
{{ old('header', $page->header ?? '') }}
@endisset">
                                    @error('header')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div> --}}

                                {{-- <div class="form-group">
                                    <label for="summery">Summary</label>
                                    <input type="text" name="summery" id="summery"
                                        class="form-control @error('summery') is-invalid @enderror"
                                        value="@isset($page)
{{ old('summery', $page->summery ?? '') }}
@endisset">
                                    @error('summery')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div> --}}

                                <div class="form-group">
                                    <label for="descriptions">Description</label>

                                    <textarea name="descriptions" class="form-control summernote" @error('descriptions') is-invalid @enderror">
@isset($page)
{{ old('descriptions', $page->descriptions ?? '') }}
@endisset
</textarea>
                                    @error('descriptions')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Published Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="1"
                                            @isset($page)
                            {{ $page->status == 1 ? 'checked' : '' }}@endisset>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="0"
                                            @isset($page)
                                {{ $page->status == 0 ? 'checked' : '' }}@endisset>
                                        <label class="form-check-label">Deactive</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Header Menu Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="header_menu" value="1"
                                            @isset($page)
                            {{ $page->header_menu == 1 ? 'checked' : '' }}@endisset>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="header_menu" value="0"
                                            @isset($page)
                                {{ $page->header_menu == 0 ? 'checked' : '' }}@endisset>
                                        <label class="form-check-label">Deactive</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Footer Menu Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="footer_menu" value="1"
                                            @isset($page)
                            {{ $page->footer_menu == 1 ? 'checked' : '' }}@endisset>
                                        <label class="form-check-label">Active</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="footer_menu" value="0"
                                            @isset($page)
                                {{ $page->footer_menu == 0 ? 'checked' : '' }}@endisset>
                                        <label class="form-check-label">Deactive</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Terms of Conditions Page Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="terms_status"
                                            value="1"
                                            @isset($page)
                            {{ $page->terms_status == 1 ? 'checked' : '' }}@endisset>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="terms_status"
                                            value="0"
                                            @isset($page)
                                {{ $page->terms_status == 0 ? 'checked' : '' }}@endisset>
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Privacy Page Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="privacy_status"
                                            value="1"
                                            @isset($page)
                            {{ $page->privacy_status == 1 ? 'checked' : '' }}@endisset>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="privacy_status"
                                            value="0"
                                            @isset($page)
                                {{ $page->privacy_status == 0 ? 'checked' : '' }}@endisset>
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cookie Page Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cookie_status"
                                            value="1"
                                            @isset($page)
                            {{ $page->cookie_status == 1 ? 'checked' : '' }}@endisset>
                                        <label class="form-check-label">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="cookie_status"
                                            value="0"
                                            @isset($page)
                                {{ $page->cookie_status == 0 ? 'checked' : '' }}@endisset>
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>



                                <label for="meta_title">Meta Title</label>
                                <input type="text" name="meta_title" id="meta_title"
                                    class="form-control @error('meta_title') is-invalid @enderror"
                                    value="@isset($page)
{{ old('meta_title', $page->meta_title ?? '') }}
@endisset">
                                @error('meta_title')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                        
                        <label for="meta_keywords">Meta Keyward</label>
                        <input type="text" name="meta_keywords" id="meta_keywords"
                            class="form-control @error('header') is-invalid @enderror"
                            value="@isset($page)
{{ old('meta_keywords', $page->meta_keywords ?? '') }}
@endisset">
                        @error('meta_keywords')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    

                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <input type="text" name="meta_description" id="meta_description"
                            class="form-control @error('meta_description') is-invalid @enderror"
                            value="@isset($page)
{{ old('meta_description', $page->meta_description ?? '') }}
@endisset">
                        @error('meta_description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-2">
                         @isset($page)
                        <button type="submit" class="btn btn-primary">Update</button>
                    @else
                        <button type="submit" class="btn btn-primary">Submit</button>
                    @endisset
                    </div>
                   

                    </form>
                </div>
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->

    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->







@endsection
@push('js')
    <!--<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">-->

    <!-- Before closing body tag, add scripts in this order -->
    <!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>-->
    <!--<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>-->

    <!--<script>
        -- >
        <
        !--$(function() {
            -- >
            // Wait for document ready
            <
            !--setTimeout(function() {
                -- >
                <
                !--$('.summernote').summernote({
                    -- >
                    <
                    !--height: 300,
                    -- >
                    <
                    !--toolbar: [-- >
                            <
                            !--['style', ['style']], -- >
                            <
                            !--['font', ['bold', 'underline', 'clear']], -- >
                            <
                            !--['color', ['color']], -- >
                            <
                            !--['para', ['ul', 'ol', 'paragraph']], -- >
                            <
                            !--['table', ['table']], -- >
                            <
                            !--['insert', ['link', 'picture']], -- >
                            <
                            !--['view', ['fullscreen', 'codeview', 'help']]-- >
                            <
                            !--
                        ]-- >
                        <
                        !--
                });
                -- >
                <
                !--
            }, 100);
            -- >
            <
            !--
        });
        -- >
        <
        !--
    </script>-->
@endpush
