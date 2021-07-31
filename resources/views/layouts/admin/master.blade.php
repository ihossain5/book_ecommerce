<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Admin Dashboard</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    @include('layouts.admin.css')
    @yield('pageCss')

</head>

<body class="fixed-left">
    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- Begin page -->
    <div id="wrapper">
        @include('layouts.admin.left_sidebar')
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                @include('layouts.admin.top_bar')

                @yield('content')

            </div> <!-- content -->

            @include('layouts.admin.footer')
       

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->

    @include('layouts.admin.scripts')
    @yield('pageScripts')
</body>

</html>
