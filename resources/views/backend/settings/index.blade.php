@extends('backend.master')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" />
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }
    </style>
@endpush
@section('title', 'Profile')

@section('content')

    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
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


            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                        src="{{ asset('images/') }}/{{ $setting->site_logo ?? '' }}"
                                        alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ $setting->site_name ?? '' }}</h3>

                                <p class="text-muted text-center">{{ Auth::user()->role->name }}</p>



                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#home" style="cursor: pointer">Change Site Logo</a></li>
                                    {{-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Change
                                        Password</a></li> --}}
                                    <li class="nav-item"><a class="nav-link" id="general-tab" data-bs-toggle="tab"
                                            data-bs-target="#general" style="cursor: pointer">General
                                            Settings</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="home">

                                        <form method="POST" id="submitFromDisable" action="{{ route('admin.logoupdate') }}"
                                            class="form-horizontal" enctype="multipart/form-data">
                                            @csrf
                                            <div class="card-body">


                                                <div class="form-group">

                                                    <div>
                                                        <input type="file" name="site_logo" placeholder="Choose image"
                                                            id="image">
                                                        @error('image')
                                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                                        @enderror
                                                        <img id="preview-image-before-upload"
                                                            src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                                            alt="preview image" style="max-height: 250px;">
                                                    </div>

                                                </div>

                                            </div>
                                            <!-- /.card-body -->

                                            <div class="card-footer">
                                                <button type="submit" id="submitBtnDisable"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>




                                    </div>



                                    <div class="tab-pane" id="general">
                                        <form class="form-horizontal" id="submitFromDisable"
                                            action="{{ route('admin.settings.update', $setting) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Site Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="site_name" value="{{ $setting->site_name }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">About Site</label>
                                                <div class="col-sm-10">
                                                    <textarea name="about_site" id="" class="form-control">{{ $setting->about_site }}
                                                </textarea>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Copy Right</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="copyright" value="{{ $setting->copyright }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Slogan</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="slogan" value="{{ $setting->slogan }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Meta Title</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="meta_title" value="{{ $setting->meta_title }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Meta
                                                    Description</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="meta_description" value="{{ $setting->meta_description }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Meta
                                                    Keywords</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="meta_keywords" value="{{ $setting->meta_keywords }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Facebook</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="facebook" value="{{ $setting->facebook }}"
                                                        placeholder="https://">
                                                </div>
                                            </div>
                                             <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Instagram</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="instagram" value="{{ $setting->instagram }}"
                                                        placeholder="https://">
                                                </div>
                                            </div>
                                            {{--
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Google</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="google" value="{{ $setting->google }}"
                                                        placeholder="https://">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Google
                                                    Plus</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="google_plus" value="{{ $setting->google_plus }}"
                                                        placeholder="https://">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Twiter</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="twiter" value="{{ $setting->twiter }}"
                                                        placeholder="https://">
                                                </div>
                                            </div>
                                           
                                            
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Youtube</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="youtube" value="{{ $setting->youtube }}"
                                                        placeholder="https://">
                                                </div>
                                            </div>
                                            --}}
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">contact</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="contact" value="{{ $setting->contact }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="inputName2"
                                                        name="email" value="{{ $setting->email }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Web Mail</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" id="inputName2"
                                                        name="webmail" value="{{ $setting->webmail }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="inputName2" class="col-sm-2 col-form-label">Address</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="inputName2"
                                                        name="address" value="{{ $setting->address }}">
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <button type="submit" id="submitBtnDisable"
                                                        class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.tab-pane -->
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->

        </div>

    @endsection
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
            integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
            crossorigin="anonymous"></script>
        <script>
            $(document).ready(function() {
                $('.dropify').dropify();

            });
        </script>
    @endpush
