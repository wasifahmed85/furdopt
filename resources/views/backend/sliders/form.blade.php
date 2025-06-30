@extends('backend.master')
@push('css')

@endpush



@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>slider</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.sliders.index') }}">slider</a></li>
                        <li class="breadcrumb-item active">Create slider</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
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
                            <h3 class="card-title">{{ __((isset($slider) ? 'Edit' : 'Create New') . ' slider') }}
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- form start -->
 
                        <form role="form" id="submitFromDisable" method="POST"
                            action="{{ isset($slider) ? route('admin.sliders.update',$slider->id) : route('admin.sliders.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($slider))
                            @method('PUT')
                            @endif

                            <div class="card card-default">

                                <!-- /.card-header -->
                                <div class="card-body">
                                    



                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Caption 1</label>
                                            <input type="text" class="form-control" name="caption1"
                                                value=" {{ $slider->caption1 ?? ''  }}"
                                                field-attributes="required autofocus">
                                            @error('caption1')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}} </strong>
                                            </span>
                                            @enderror
                                        </div>
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Caption 2</label>
                                            <input type="text" class="form-control" name="caption2"
                                                value=" {{ $slider->caption2 ?? ''  }}"
                                                field-attributes="required autofocus">
                                            @error('caption2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}} </strong>
                                            </span>
                                            @enderror
                                        </div>
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Caption 3</label>
                                            <input type="text" class="form-control" name="caption3"
                                                value=" {{ $slider->caption3 ?? ''  }}"
                                                field-attributes="required autofocus">
                                            @error('caption3')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}} </strong>
                                            </span>
                                            @enderror
                                        </div>

                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Url Link</label>
                                            <input type="text" class="form-control" name="url"
                                                value=" {{ $slider->url ?? ''  }}"
                                                field-attributes="required autofocus">
                                            @error('url')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}} </strong>
                                            </span>
                                            @enderror
                                        </div>



           


                                <div class="form-group">


                                    <input type="file" name="image" placeholder="Choose image"
                                        id="image">
                                    @error('image')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    <img id="preview-image-before-upload"
                                        src="https://www.riobeauty.co.uk/images/slider_image_not_found.gif"
                                        alt="preview image" style="max-height: 250px;">

                                @isset($slider)

                                <img id="preview-image-before-upload"
                                        src="{{ asset('images/backend') }}/{{ $slider->image }}"
                                        alt="preview image" style="max-height: 250px;">
                               @endisset

                            </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="1" @isset($slider)
                                        {{ $slider->status == 1 ? 'checked' : ''  }}@endisset>
                                        <label class="form-check-label">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="0" @isset($slider)
                                            {{ $slider->status == 0 ? 'checked' : ''  }}@endisset>
                                            <label class="form-check-label">Deactive</label>
                                            </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div>
                                        <button type="submit" class="cursor" id="submitBtnDisable">
                                            @isset($slider)
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
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->







@endsection
@push('js')


<!-- Summernote -->
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
  </script>
@endpush
