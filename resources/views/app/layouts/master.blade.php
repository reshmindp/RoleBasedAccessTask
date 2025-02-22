<!doctype html>
<html lang="en">

@include('app.layouts.head')

    <body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">
            @include('app.layouts.header')

            @include('app.layouts.leftbar')

            @yield('content')

        </div>
        <!-- END layout-wrapper -->

        @include('app.layouts.footer_js')
    </body>

</html>