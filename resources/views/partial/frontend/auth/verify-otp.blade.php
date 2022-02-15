<div class="input_fild">
    @if (session()->has('errorMessage'))
        <p class="error">{{ session('errorMessage') }}</p>
    @endif
    <input type="text" name="otp" placeholder="আপনার ওটিপি" name="">
    <input type="hidden" id="number" name="phone" value="{{ $number }}">
</div>
<div class="submit_btns">
    <button href="" class="submit">সাবমিট করুন</button>

    @if (Route::current()->getName() != 'forgot.password.otp.send')
        <button type="button" onclick="sendOtpAgain()" class="otp">আবার ওটিপি পাঠান</button>
    @endif

</div>
