<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $setting->site_name ?? '' }}</title>

    <link rel="stylesheet" href="{{ asset('backend/css/source-sans-3@5.0.12.index.css') }}" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link rel="stylesheet" href="{{ asset('backend/css/overlayscrollbars.min.css') }}" />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    {{-- <link rel="stylesheet" href="{{ asset('backend/css/bootstrap-icons.min.css') }}" /> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/css/adminlte.css') }}" />

    <style type="text/css" media="screen">
        #submitBtn[disabled] {
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;

        }
    </style>
</head>

<body class="hold-transition login-page">
    @yield('content')

    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="{{ asset('backend/js/overlayscrollbars.browser.es6.min.js') }}"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="{{ asset('backend/js/popper.min.js') }}"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('backend/js/adminlte.js') }}"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("submitFromDisable");
            const submitBtn = document.getElementById("submitBtnDisable");

            form.addEventListener("submit", function() {
                submitBtn.disabled = true;
            });
        });
    </script>
</body>

</html>
