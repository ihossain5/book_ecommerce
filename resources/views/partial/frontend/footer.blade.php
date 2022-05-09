@php
use App\Http\Controllers\Frontend\HomePageController;
    $footer = HomePageController::footer();
    $appInfo = HomePageController::appInfo();
@endphp

    <footer class="footer">
        <div class="container">
            <div class="row pb-5 mb-3">
                <div class="col-lg-4">
                    <div class="logo_wrapper">
                        <img src="{{asset('frontend/assets/images/footer/image_2.png')}}" alt="logo" class="img-fluid w-100">
                    </div>
                </div>
                <div class="col-lg-3 right_border left_content">
                    <h6>{{$appInfo->name}}</h6>
                    <ul class="website_address ">
                        <li>
                            <a href="" onclick="return false">{{$appInfo->address}}</a>
                        </li>
                        <li>
                            <a href="" onclick="return false">পিএবিএক্স: <span class="last_link_inter">{{$appInfo->pabx}}
                                    </a>
                        </li>
                        <li class="last_link_li">
                            <a href="mailto:{{$appInfo->email}}"
                                class="last_link_inter">{{$appInfo->email}}
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="col-lg-3 right_border center_content">
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
                <div class="col-lg-2 d-flex flex-column align-items-start align-items-sm-start align-items-lg-end  ">
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
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <ul class="social_link_box">
                        <li>
                            @if (!empty($footer))
                            @foreach ($footer as $item)

                                <a href="{{ $item->url }}" target="_blank"><img src="{{ asset('images/' . $item->logo) }}" alt="{{ $item->name }}"></a>

                            @endforeach
                            @endif

                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="acceptPayment">
                        <a target="_blank" href="https://www.sslcommerz.com/" title="SSLCommerz" alt="SSLCommerz"><img
                                src="https://securepay.sslcommerz.com/public/image/SSLCommerz-Pay-With-logo-All-Size-03.png" /></a>
                        <h6>Bkash Personal : {{$appInfo->bcash}}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="footer_inner_four">
                <div class="copywight">
                    <p>© Copyright <span>{{$appInfo->name}}</span></p>
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