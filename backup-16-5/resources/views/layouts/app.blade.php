<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

{{-- Include Head --}}
@include('common.head')

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- Topbar -->
        @include('common.header')
        <!-- End of Topbar -->

        <!-- Sidebar -->
        @include('common.sidebar')
        <!-- End of Sidebar -->

        @yield('content')

        @include('common.footer')

    </div>

    @include('common.footerjs')

    @yield('scripts')

</body>

</html>
