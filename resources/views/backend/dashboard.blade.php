@extends('backend.master')



@section('content')
    <!--begin::App Content Header-->
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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-primary shadow-sm">
                            <i class="bi bi-gear-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Visitors</span>
                            <span class="info-box-number">
                                {{ $visitors }}

                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-danger shadow-sm">
                            <i class="bi bi-hand-thumbs-up-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Subscriptions</span>
                            <span class="info-box-number">{{ $subscriptions }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <!-- fix for small devices only -->
                <!-- <div class="clearfix hidden-md-up"></div> -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-success shadow-sm">
                            <i class="bi bi-cart-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Sales</span>
                            <span class="info-box-number"> &dollar;{{ $payments }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-warning shadow-sm">
                            <i class="bi bi-people-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">New Members</span>
                            <span class="info-box-number">{{ $users }}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-warning shadow-sm">
                            <i class="bi bi-check2-square"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">Pending Pet</span>
                            <a href="{{ route('admin.pets.index') }}">
                                <span class="info-box-number">{{ $pendings }}</span></a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Monthly Sales Report</h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                    <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                    <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                </button>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-tool dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="bi bi-wrench"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" role="menu">
                                        <a href="#" class="dropdown-item">Action</a>
                                        <a href="#" class="dropdown-item">Another action</a>
                                        <a href="#" class="dropdown-item"> Something else here </a>
                                        <a class="dropdown-divider"></a>
                                        <a href="#" class="dropdown-item">Separated link</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!--begin::Row-->
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-center">
                                        <strong>Sales: Monthly Data</strong>
                                    </p>
                                    <div id="sales-chart"></div>
                                </div>

                            </div>
                            <!--end::Row-->
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
                <!-- Start col -->
                <div class="col-md-12">
                    <!--begin::Row-->
                    <div class="row g-4 mb-4">
                        <div class="col-md-6">
                            <!-- DIRECT CHAT -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Latest Subscriptions</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>
                                                    <th>Order ID</th>
                                                    <th>Item</th>
                                                    <th>Plan</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($sales as $item)
                                                    <tr>
                                                        <td>
                                                            <a href="pages/examples/invoice.html"
                                                                class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                                                {{ $item->id }} </a>
                                                        </td>
                                                        <td>{{ $item->user->name }}</td>
                                                        <td><span class="badge text-bg-success">
                                                                {{ $item->subcription->name }} </span></td>

                                                    </tr>
                                                @endforeach


                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">

                                    <a href="{{ route('admin.subscriptions.index') }}"
                                        class="btn btn-sm btn-secondary float-end">
                                        View All Orders
                                    </a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.direct-chat -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-6">
                            <!-- USERS LIST -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Latest Members</h3>
                                    <div class="card-tools">
                                        <span class="badge text-bg-danger"> 10 New Members </span>
                                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <div class="row m-1">
                                        <div class="table-responsive">
                                            <table class="table m-0">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>

                                                        <th>Name</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($lusers as $key => $usr)
                                                        <tr>
                                                            <td>
                                                                {{ $key + 1 }}
                                                            </td>
                                                            <td>{{ $usr->name }}</td>
                                                            <td>
                                                                <a class="btn btn-secondary btn-sm"
                                                                    href="{{ route('admin.users.show', $usr->id) }}"><i
                                                                        class="fas fa-eye"></i>
                                                                    <span>Show</span>
                                                                </a>
                                                            </td>

                                                        </tr>
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>



                                    </div>
                                    <!-- /.users-list -->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer text-center">
                                    <a href="{{ route('admin.users.index') }}"
                                        class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View
                                        All Users</a>
                                </div>
                                <!-- /.card-footer -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!--end::Row-->
                    <!--begin::Latest Order Widget-->

                    <!-- /.card -->
                </div>

            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection


@push('js')
    <script src="{{ asset('backend/js/apexcharts.min.js') }}"></script>

    <script>
        const salesData = @json($salesData);
        const categories = salesData.map(item => item.month);
        const seriesData = salesData.map(item => item.total_amount);

        const sales_chart_options = {
            series: [{
                    name: 'Subscribed Amount',
                    data: seriesData,
                },

            ],
            chart: {
                height: 180,
                type: 'area',
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: false,
            },
            colors: ['#0d6efd', '#20c997'],
            dataLabels: {
                enabled: false,
            },
            stroke: {
                curve: 'smooth',
            },
            xaxis: {
                type: 'datetime',
                categories: categories,
            },
            tooltip: {
                x: {
                    format: 'MMMM yyyy',
                },
            },
        };

        const sales_chart = new ApexCharts(
            document.querySelector('#sales-chart'),
            sales_chart_options,
        );
        sales_chart.render();

        //---------------------------
        // - END MONTHLY SALES CHART -
        //---------------------------

        function createSparklineChart(selector, data) {
            const options = {
                series: [{
                    data
                }],
                chart: {
                    type: 'line',
                    width: 150,
                    height: 30,
                    sparkline: {
                        enabled: true,
                    },
                },
                colors: ['var(--bs-primary)'],
                stroke: {
                    width: 2,
                },
                tooltip: {
                    fixed: {
                        enabled: false,
                    },
                    x: {
                        show: false,
                    },
                    y: {
                        title: {
                            formatter: function(seriesName) {
                                return '';
                            },
                        },
                    },
                    marker: {
                        show: false,
                    },
                },
            };

            const chart = new ApexCharts(document.querySelector(selector), options);
            chart.render();
        }

        const table_sparkline_1_data = [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54];
        const table_sparkline_2_data = [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 44];
        const table_sparkline_3_data = [15, 46, 21, 59, 33, 15, 34, 42, 56, 19, 64];
        const table_sparkline_4_data = [30, 56, 31, 69, 43, 35, 24, 32, 46, 29, 64];
        const table_sparkline_5_data = [20, 76, 51, 79, 53, 35, 54, 22, 36, 49, 64];
        const table_sparkline_6_data = [5, 36, 11, 69, 23, 15, 14, 42, 26, 19, 44];
        const table_sparkline_7_data = [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 74];

        createSparklineChart('#table-sparkline-1', table_sparkline_1_data);
        createSparklineChart('#table-sparkline-2', table_sparkline_2_data);
        createSparklineChart('#table-sparkline-3', table_sparkline_3_data);
        createSparklineChart('#table-sparkline-4', table_sparkline_4_data);
        createSparklineChart('#table-sparkline-5', table_sparkline_5_data);
        createSparklineChart('#table-sparkline-6', table_sparkline_6_data);
        createSparklineChart('#table-sparkline-7', table_sparkline_7_data);

        //-------------
        // - PIE CHART -
        //-------------

        const pie_chart_options = {
            series: [700, 500, 400, 600, 300, 100],
            chart: {
                type: 'donut',
            },
            labels: ['Chrome', 'Edge', 'FireFox', 'Safari', 'Opera', 'IE'],
            dataLabels: {
                enabled: false,
            },
            colors: ['#0d6efd', '#20c997', '#ffc107', '#d63384', '#6f42c1', '#adb5bd'],
        };

        const pie_chart = new ApexCharts(document.querySelector('#pie-chart'), pie_chart_options);
        pie_chart.render();

        //-----------------
        // - END PIE CHART -
        //-----------------
    </script>
    <!--end::Script-->
@endpush
