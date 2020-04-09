@include('inc.head')
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            @include('inc.sidebar')
        </div>
        <div class="col-md-9">
            @yield('content')
        </div>
    </div>
</div>
@yield('script')
</body>
</html>

