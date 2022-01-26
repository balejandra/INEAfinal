<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('titulo' )| {{ config('app.name') }}</title>
    <!-- Bootstrap-->
    <link rel="stylesheet" href="{{asset('assets/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/coreui/coreui.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('assets/coreui/coreui-icons-free.css')}}">
    <link href="{{asset('assets/fontawesome/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/simplelineicons.github/css/simple-line-icons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/flag-icons-master/css/flag-icon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/custom.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fontawesome/css/all.css')}}">
    @stack('scripts')
</head>
<body class="app flex-row align-items-center">
<div class="container">
    <div class="row justify-content-center">
        <main>
            @yield('content')
        </main>
    </div>
</div>
<!-- CoreUI and necessary plugins-->
<script src="{{asset('assets/jquery/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('assets/jquery/popper.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/coreui/coreui.min.js')}}"></script>
<script src="{{asset('assets/coreui/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/fontawesome/js/all.js')}}"></script>
</body>
</html>
