@auth
    @if (Auth::user()->userrole == 'owner')
    @else
        @extends('backend.master')

        @push('css')
            <style>
                a {
                    color: #EE4B5E !important;
                    text-decoration: none;
                }

                a:hover {
                    color: #e75858 !important;
                    text-decoration: none;
                }

                .text-wrapper {
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                }

                .title {
                    font-size: 5em;
                    font-weight: 700;
                    color: #EE4B5E;
                }

                .subtitle {
                    font-size: 40px;
                    font-weight: 700;
                    color: #1FA9D6;
                }

                .isi {
                    font-size: 18px;
                    text-align: center;
                    margin: 30px;
                    padding: 20px;
                    color: white;
                }

                .buttons {
                    margin: 30px;
                    font-weight: 700;
                    border: 2px solid #EE4B5E;
                    text-decoration: none;
                    padding: 15px;
                    text-transform: uppercase;
                    color: #EE4B5E;
                    border-radius: 26px;
                    transition: all 0.2s ease-in-out;
                    display: inline-block;

                    .buttons:hover {
                        background-color: #EE4B5E;
                        color: white;
                        transition: all 0.2s ease-in-out;
                    }
                }
                }
            </style>
        @endpush

        @section('content')
            <!-- Content Wrapper. Contains page content -->



            <div class="app-content">
                <div class="container-fluid">
                    {{-- <div class="row">

                        <div class="col-md-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-exclamation-triangle"></i>
                                        Authorization Alerts
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                        You are not authorizes use this resource!!!
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div> --}}
                    <div class="row mt-4">
                        <div class="text-wrapper">
                            <div class="title" data-content="404">
                                403 - ACCESS DENIED
                            </div>

                            <div class="subtitle">
                                Oops, You don't have permission to access this page.
                            </div>
                            <div class="isi">
                                SIPANDA - BPKAD KLATEN
                            </div>

                            <div class="buttons">
                                <a class="button" href="{{ route('admin.dashboard') }}">Go to Dashboard</a>
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->

            <!-- /.content-wrapper -->
        @endsection
    @endif
@else
@endauth
