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
                    <h3 class="mb-0">Locations</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.cities.index') }}">Locations</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Location Create</li>
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
                            <h3 class="card-title">{{ __((isset($city) ? 'Edit' : 'Create New') . ' Location') }}
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- form start -->

                        <form role="form" id="submitFromDisable" method="POST"
                            action="{{ isset($city) ? route('admin.cities.update', $city->id) : route('admin.cities.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($city))
                                @method('PUT')
                                <input type="hidden" name="city_id" value="{{$city->id}}">
                            @endif

                            <div class="card card-default">

                                <!-- /.card-header -->
                                <div class="card-body">




                                  
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Location</label>
                                        <input type="text" class="form-control" name="state"
                                            value=" {{ old('state', $city->state ?? '') }}"
                                            field-attributes="required autofocus">
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                  
                                


                                  


                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <div>
                                            <button type="submit" class="cursor btn btn-primary" id="submitBtnDisable">
                                                @isset($city)
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
