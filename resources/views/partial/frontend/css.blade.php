<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery.rateyo.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@yield('page-css')
<style>
    .toast-message {
        color: #ffffff;
        font-family: 'inter';
        font-weight: 600;
        font-size: 1.5rem;
        line-height: 2.4rem;
    }

    .toast-success {
        background: #4F7F6C;
        opacity: 1 !important;
        
    }

    #toast-container>div.toast {
        background-image: none !important;
    }

</style>
