<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bhorer Kagoj | @yield('title')</title>
    
    @include('partials.frontend.css')

</head>

<body>

    @include('partials.frontend.nav_bar')
    @include('partials.frontend.cart')
    @yield('content')
    <!-- Footer -->
    @include('partials.frontend.footer')
</body>    
    @include('partials.frontend.js')
    @yield('page-js')
</html>
