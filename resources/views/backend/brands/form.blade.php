@extends('backend.master')
@push('css')
<!-- summernote -->
{{-- <link rel="stylesheet" href="{{ asset('backend/plugins/summernote/summernote-bs4.min.css')}}"> --}}
@endpush



@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Brand</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.brands.index') }}">Brand</a></li>
                        <li class="breadcrumb-item active">Create Brand</li>
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
                            <h3 class="card-title">{{ __((isset($brand) ? 'Edit' : 'Create New') . 'Brand') }}
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <!-- form start -->

                        <form role="form" id="submitFromDisable" method="POST"
                            action="{{ isset($brand) ? route('admin.brands.update',$brand->id) : route('admin.brands.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if (isset($brand))
                            @method('PUT')
                            @endif

                            <div class="card card-default">

                                <!-- /.card-header -->
                                <div class="card-body">

                         


                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value=" {{ old('name', $brand->name ?? '')  }}"
                                                field-attributes="required autofocus">
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}} </strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <hr>

                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Danish Name</label>
                                            <input type="text" class="form-control" name="dn_name"
                                                value=" {{ old('dn_name', $brand->dn_name ?? '')  }}"
                                                field-attributes="required autofocus">
                                            @error('dn_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}} </strong>
                                            </span>
                                            @enderror
                                        </div>

                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Sweidish Name</label>
                                            <input type="text" class="form-control" name="sw_name"
                                                value=" {{ old('sw_name', $brand->sw_name ?? '')  }}"
                                                field-attributes="required autofocus">
                                            @error('sw_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}} </strong>
                                            </span>
                                            @enderror
                                        </div>

                                            <div class="form-group">
                                            <label for="exampleInputEmail1">Netherland Name</label>
                                            <input type="text" class="form-control" name="nr_name"
                                                value=" {{ old('nr_name', $brand->nr_name ?? '')  }}"
                                                field-attributes="required autofocus">
                                            @error('nr_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}} </strong>
                                            </span>
                                            @enderror
                                        </div>
                                            <div class="form-group">
                                            <label for="exampleInputEmail1">German Name</label>
                                            <input type="text" class="form-control" name="gr_name"
                                                value=" {{ old('gr_name', $brand->gr_name ?? '')  }}"
                                                field-attributes="required autofocus">
                                            @error('gr_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}} </strong>
                                            </span>
                                            @enderror
                                        </div>
                               


                                  <!-- /.row -->



                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta Title</label>

                                      
                                        <input type="text" class="form-control" name="meta_title"
                                        value=" {{ old('meta_title', $brand->meta_title ?? '')  }}"
                                        field-attributes="required autofocus">
                                @error('meta_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}} </strong>
                                </span>
                                @enderror
                                </div> 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta Description</label>

                                        <input type="text" class="form-control" name="meta_description"
                                        value=" {{ old('meta_description', $brand->meta_description ?? '')  }}"
                                        field-attributes="required autofocus">

                                @error('meta_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}} </strong>
                                </span>
                                @enderror
                                </div> 
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Meta Keywords</label>

                                       

                                        <input type="text" class="form-control" name="meta_keyword"
                                        value=" {{ old('meta_keyword', $brand->meta_keyword ?? '')  }}"
                                        field-attributes="required autofocus">
                                @error('meta_keyword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}} </strong>
                                </span>
                                @enderror
                                </div> 

                                <div class="row">
                                    <div class="col-sm-6">

                                <div class="form-group">

                                    <label for="exampleInputEmail1">brand Image</label>
                                    <input type="file" name="image" placeholder="Choose image"
                                        id="image">
                                    @error('image')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    <img id="preview-image-before-upload"
                                        src="#"
                                         style="max-height: 250px;">

                                @isset($brand)

                                <img id="preview-image-before-upload"
                                        src="{{ asset('images/backend') }}/{{ $brand->image }}"
                                        alt="preview image" style="max-height: 250px;">
                               @endisset

                            </div>
                                    </div>

                                    <div class="col-sm-6">
                                    </div>
                                </div>

                     

                        <hr>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Published Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" value="1" @isset($brand)
                                        {{ $brand->status == 1 ? 'checked' : ''  }}@endisset>
                                        <label class="form-check-label">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" value="0" @isset($brand)
                                            {{ $brand->status == 0 ? 'checked' : ''  }}@endisset>
                                            <label class="form-check-label">Deactive</label>
                                            </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Home Screen Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="feature" value="1" @isset($brand)
                                        {{ $brand->feature == 1 ? 'checked' : ''  }}@endisset>
                                        <label class="form-check-label">Active</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="feature" value="0" @isset($brand)
                                            {{ $brand->feature == 0 ? 'checked' : ''  }}@endisset>
                                            <label class="form-check-label">Deactive</label>
                                            </div>
                                </div>
                            </div>
                        </div>
                           
                               
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div>
                                        <button type="submit" class="cursor" id="submitBtnDisable">
                                            @isset($brand)
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
