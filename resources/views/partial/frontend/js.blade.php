{{-- <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script> --}}
    <!-- Jquery CDNJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/jquery.rateyo.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/common.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('frontend/assets/js/cart.js') }}"></script>
@yield('page-js')

<script>
    toastr.options = {
        "closeButton": true,
        "debug": true,
        "tapToDismiss ": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "autohide": false,
    }
    @if (Session::has('error'))
        var message = "{{ Session::get('error') }}";
        toastr["error"](message)
    @endif
    
    @if (Session::has('success'))
        var message = "{{ Session::get('success') }}";
        toastr["success"](message)
    @endif

    $(document).on('submit','.login_auth_box',function(e){
        e.preventDefault();
        // alert('hello');
    })
</script>
