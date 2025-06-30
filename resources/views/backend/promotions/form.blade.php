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
                    <h3 class="mb-0">Promotion Package</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.promotions.index') }}">Promotion Package</a></li>
                        <li class="breadcrumb-item active" aria-current="page">promotion Create</li>
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
                            <h3 class="card-title">
                                {{ __((isset($promotion) ? 'Edit' : 'Create New') . ' Subscription Plan') }}
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- form start -->

                        <form role="form" id="submitFromDisable" method="POST"
                            action="{{ isset($promotion) ? route('admin.promotions.update', $promotion->id) : route('admin.promotions.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($promotion))
                                @method('PUT')
                            @endif

                            <div class="card card-default">

                                <!-- /.card-header -->
                                <div class="card-body">




                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" class="form-control" name="promotion_name"
                                            value=" {{ old('promotion_name', $promotion->promotion_name ?? '') }}"
                                            field-attributes="required autofocus">
                                        @error('promotion_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Promotion Days</label>
                                        <input type="number" class="form-control" name="promotion_days"
                                            value=" {{ old('promotion_days', $promotion->promotion_days ?? '') }}"
                                            field-attributes="required autofocus">
                                        @error('promotion_days')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Spotlight</label>
                                        <input type="number" class="form-control" name="spotlight"
                                            value=" {{ old('spotlight', $promotion->spotlight ?? '') }}"
                                            field-attributes="required autofocus">
                                        @error('spotlight')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Price</label>
                                        <input type="text" class="form-control" name="price"
                                            value=" {{ old('price', $promotion->price ?? '') }}"
                                            field-attributes="required autofocus">
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>






                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        value="1"
                                                        @isset($promotion)
                                        {{ $promotion->status == true ? 'checked' : '' }}@endisset>
                                                    <label class="form-check-label">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="status"
                                                        value="0"
                                                        @isset($promotion)
                                            {{ $promotion->status == false ? 'checked' : '' }}@endisset>
                                                    <label class="form-check-label">Deactive</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div>
                                            <button type="submit" class="cursor" id="submitBtnDisable">
                                                @isset($promotion)
                                                    <i class="fas fa-arrow-circle-up"></i>
                                                    update
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
