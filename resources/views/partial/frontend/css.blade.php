<link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery.rateyo.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
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

    .search_div{
        width:100%;
        background-color: white;
        border-radius: 0 0 8px 8px;
    }
    .search_div a{
        display: block;
        padding:5px;
    }

    input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            /* display: none; <- Crashes Chrome on hover */
            -webkit-appearance: none;
            margin: 0;
            /* <-- Apparently some margin are still there even though it's hidden */
        }

    input[type=number] {
            -moz-appearance: textfield;
            /* Firefox */
        }
</style>
