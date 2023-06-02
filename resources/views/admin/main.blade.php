<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('global.preloader')
        @include('admin.navbar')
        @include('admin.sidebar')
        @include('admin.js_vendor')
        @yield('content')
        @include('global.footer')
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
</body>
</html>
