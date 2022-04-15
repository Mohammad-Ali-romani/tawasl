<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="icon" href="{{asset('images/tawasal-logo.svg')}}" type="image/icon type">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">

    @auth
    <!-- Plugin css for this page -->
        <link rel="stylesheet" href="{{asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
        <link rel="stylesheet" href="{{asset('js/select.dataTables.min.css')}}"> <!-- هذاا الملف غير موجود-->
        <!-- End plugin css for this page -->
    @endauth
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
{{--        <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">--}}

<!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class=" rtl">

@auth
    @isset($routeSearch)
    <x-layouts.header :routeSearch="$routeSearch" />
    @endisset
    <div class="container-fluid page-body-wrapper">
        <x-layouts.sidebar/>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                {{$slot}}
            </div>
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- container-scroller -->
{{--    <x-footer></x-footer>--}}
@endauth
@guest
    {{$slot}}
@endguest
<script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
@auth
    <script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
@endauth
<script src="{{asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
@auth
    <script src="{{asset('vendors/progressbar.js/progressbar.min.js')}}"></script>
@endauth

<script src="{{asset('js/off-canvas.js')}}"></script>
<script src="{{asset('js/hoverable-collapse.js')}}"></script>
<script src="{{asset('js/template.js')}}"></script>
<script src="{{asset('js/settings.js')}}"></script>
<script src="{{asset('js/todolist.js')}}"></script>
@auth
    <script src="{{asset('js/jquery.cookie.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/dashboard.js')}}"></script>
    <script src="{{asset('js/Chart.roundedBarCharts.js')}}"></script>
@endauth
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
