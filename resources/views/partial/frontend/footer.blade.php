@php
use App\Http\Controllers\Frontend\HomePageController;
    $footer = HomePageController::footer();
@endphp
<!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer_inner_one">
                <div class="logo_wrapper">
                    <img src="{{ asset('frontend/assets/images/footer/image_2.png') }}" alt="logo" class="img-fluid w-100">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="footer_inner_two">
                <div class="row">
                    <div class="col-lg-4">
                        <h6>ভোরের কাগজ প্রকাশন</h6>
                        <ul>
                            <li>
                                <a href="" onclick="return false">কর্ণফুলী মিডিয়া পয়েন্ট তৃতীয় তলা, ৭০ <br>
                                    শহীদ সাংবাদিক সেলিনা পারভীন সড়ক,<br>
                                    মালিবাগ, ঢাকা-১২১৭, বাংলাদেশ
                            </li>
                            <li>
                                <a href="" onclick="return false">পিএবিএক্স: <span class="last_link_inter">09612112200, 58316483,</span></a>
                            </li>
                            <li class="last_link_li">
                                <a href="mailto:bhorerkagojprokashan@gmail.com" class="last_link_inter">bhorerkagojprokashan@gmail.com
                                </a>
                            </li>
                            <li class="last_link">
                                <a href="" onclick="return false">Bkash Personal : 01733 062 014</a>
                            </li>
                            <li>
                                <a href="" onclick="return false" ><img src="{{ asset('frontend/assets/images/footer/online-pay-cards.png') }}" alt=""></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <h6>আমাদের সম্পর্কে</h6>
                        <ul class="icon">
                            <li>
                                <a href="">প্রাইভেসি পলিসি</a>
                            </li>
                            <li>
                                <a href="">টার্মস এন্ড কন্ডিশন</a>
                            </li>
                            <li>
                                <a href="">রিটার্ন পলিসি</a>
                            </li>
                            <li>
                                <a href="">ডেলিভারি পলিসি</a>
                            </li>
                            <li>
                                <a href="">ট্রাক অর্ডার</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 d-flex flex-column align-items-start align-items-md-end align-items-sm-start align-items-lg-end  ">
                        <h6>আমাদের পলিসি</h6>
                        <ul class="icon">
                            <li>
                                <a href="">প্রাইভেসি পলিসি</a>
                            </li>
                            <li>
                                <a href="">টার্মস এন্ড কন্ডিশন</a>
                            </li>
                            <li>
                                <a href="">রিটার্ন পলিসি</a>
                            </li>
                            <li>
                                <a href="">ডেলিভারি পলিসি</a>
                            </li>
                            <li>
                                <a href="">ট্রাক অর্ডার</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 d-flex flex-column align-items-start align-items-md-end align-items-sm-start align-items-lg-end">
                        <div class="social_madia_wrapper">
                            <h6>সামাজিক যোগাযোগ মাধ্যম</h6>
                            <div class="social_wrapper">
                                <ul>
                                    @if (!empty($footer))
                                    @foreach ($footer as $item)
                                        <li>
                                            <a href="{{ $item->url }}" target="_blank">
                                                <img class="img-fluid" src="{{ asset('images/' . $item->logo) }}"
                                                    alt="{{ $item->name }}" />
                                            </a>
                                        </li>

                                    @endforeach
                                    @endif
                                    {{-- <li>
                                        <a href="#" target="_blank">
                                            <img class="img-fluid" src="{{ asset('frontend/assets/images/icons/facebook.svg') }}"
                                                alt="facebook" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">
                                            <img class="img-fluid" src="{{ asset('frontend/assets/images/icons/twitter.svg') }}"
                                                alt="twitter" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">
                                            <img class="img-fluid" src="{{ asset('frontend/assets/images/icons/linkedin.svg') }}"
                                                alt="linkedin" />
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" target="_blank">
                                            <img class="img-fluid" src="{{ asset('frontend/assets/images/icons/instagram.svg') }}"
                                                alt="instagram" />
                                        </a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
    
                </div>
            </div>
        </div>
        <div class="container">
            <div class="footer_inner_four">
                <div class="copywight">
                    <p>© Copyright <span>Bhorer Prokashoni</span></p>
                </div>
                <div class="ar_reserved">
                    <p>All rights reserved.</p>
                </div>
                <div class="by_develop">
                    <p>Designed & Developed by <a href="https://theantopolis.com/" class="text-reset">Antopolis</a></p>
                </div>
            </div>
        </div>
    </footer>