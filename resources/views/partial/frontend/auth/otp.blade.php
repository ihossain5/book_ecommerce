<div class="input_fild">
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p class="error ">{{ $error }}</p>
        @endforeach
    @endif
    <input type="text" name="number" placeholder="আপনার ফোন নম্বর" name="">
</div>
<p>এই নম্বরে আমরা একটি ওটিপি (একবার ব্যবহারযোগ্য পাসওয়ার্ড) পাঠাব</p>
<div class="submit_btn">
    <button onclick="" class="submit">সাবমিট করুন</button>
</div>
