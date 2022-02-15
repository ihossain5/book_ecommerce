@extends('layouts.frontend.master')
@section('title', 'Login Verification')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/login.css') }}">
@endsection

@section('content')

    <!-- login verification section -->
    <section class="login_section pt-20 pb-120">
        <div class="container">
            <div class="login_container">

                @include('partial.frontend.auth.logo')

                <div class="login_content">
                    <h2>পাসওয়ার্ড পরিবর্তন করুন </h2>
     
                    <form action="{{ route('frontend.password.update') }}" class="chagePassword" method="POST">
                        @csrf
                        <div class="input_fild">
                            @if (session()->has('errorMessage'))
                                <p class="error">{{ session('errorMessage') }}</p>
                            @endif
                            <input type="text" readonly id="number" name="phone" value="{{  $number }}">

                            <input type="text" class="mt-4" id="password" name="password" placeholder="আপনার পাসওয়ার্ড" name="password" >

                            <input type="text" class="mt-4" id="password_confirmation" name="password_confirmation" placeholder="পাসওয়ার্ড নিশ্চিত করুন " name="password" >
                        </div>
                        <div class="submit_btns">
                            <button href="" class="submit">সাবমিট করুন</button>                     
                        </div>
                    </form>

                </div>

                <!-- </div> -->
            </div>
        </div>
    </section>

@endsection
@section('page-js')
    <script>
        $(".chagePassword").validate({
            rules: {
                phone: {
                    required: true,
                    digits: true,
                    minlength: 11,
                    maxlength: 11,
                },
                password: {
                    required: true,
                    minlength: 8,
                },
                password_confirmation : {
                    equalTo : "#password"
            }


            },
            messages: {
                phone: {
                    required: 'Please insert your phone number',
                },
            },
            errorPlacement: function(label, element) {
                label.addClass('h1 text-danger');
                label.insertAfter(element);
            },
        });

        function sendOtpAgain() {
            var number = $('#number').val();
            $.ajax({
                url: routeConfig.routes.login,
                method: "post",
                data: {
                    number: number,
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    if (response.success == true) {
                        toastr['success']('পুনরায়  ওটিপি পাঠানো হয়েছে ');
                    } else {
                        toastr['error'](response.data);
                    }

                },
                error: function(error) {
                    if (error.status == 404) {
                        toastr['error']('Data not found');

                    }
                    if (error.status == 422) {
                        $.each(error.responseJSON.errors, function(i, message) {
                            toastr['error'](message);
                        });

                    }
                },
            }); //ajax end
        }
    </script>
@endsection
