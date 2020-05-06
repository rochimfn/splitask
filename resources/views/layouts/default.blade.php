@include('inc.head')
<body class="">
<div class="container-fluid bg-white">
    <div class="row">
        <div class="col-md-4 col-lg-3 bg-blue-splitask position-md-fixed h-100">
            @include('inc.sidebar')
        </div>
        <div class="col-md-8 col-lg-9 offset-md-fixed offset-lg-fixed">
            @yield('content')
        </div>
    </div>
</div>
@yield('script')
</body>
</html>

