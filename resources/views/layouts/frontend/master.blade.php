<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bhorer Kagoj | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('meta')
    @include('partial.frontend.css')

</head>

<body>

    @include('partial.frontend.nav_bar')
    @include('partial.frontend.cart')
    @yield('content')
    <!-- Footer -->
    @include('partial.frontend.footer')
</body>    
    @include('partial.frontend.js')
</html>
