<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo' )| {{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link href="{{asset('assets/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/bootstrap/dist/css/bootstrap-datetimepicker.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/coreui/coreui.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('assets/coreui/coreui-icons-free.css')}}">

    <link href="{{asset('assets/fontawesome/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/simplelineicons.github/css/simple-line-icons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/flag-icons-master/css/flag-icon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/DataTables/datatables.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('css/zarpesStyle.css')}}">

    @routes


</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
<header>
    @include('partials/header')
</header>

<div class="app-body">
    @include('partials.sidebar')
    <main class="main">
        @yield('content')
    </main>
</div>
<footer class="app-footer">
    @include('partials/footer')
</footer>
</body>
@stack('scripts')
<script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/DataTables/datatables.js')}}"></script>
<script src="{{asset('assets/jquery/popper.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/coreui/coreui.min.js')}}"></script>
<script src="{{asset('assets/coreui/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/jquery/moment.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/dist/bootstrap-datetimepicker.min.js')}}"></script>
<script src="{{asset('js/functions.js')}}"></script>
<script src="{{asset('assets/fontawesome/js/all.js')}}"></script>
</html>
