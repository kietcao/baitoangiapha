<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed" id="main">
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    <div class="wrapper">
        @include('global.preloader')
        @include('admin.navbar')
        @include('admin.sidebar')
        @include('admin.js_vendor')
        @yield('content')
        @include('global.footer')
    </div>
</body>
</html>
