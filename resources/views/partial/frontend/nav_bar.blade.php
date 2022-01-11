@php
use App\Http\Controllers\Frontend\HomePageController;
$authors = HomePageController::all_authors();
$categories = HomePageController::all_category();
$publications = HomePageController::all_publication();

@endphp

<nav class="navbar navbar-expand-lg navbar-light brand_nav sticky-top">
    <div class="container">
        <button data-bs-toggle="offcanvas" href="#sidebar" class="navbar-toggler" type="button">
            <img src="{{ asset('frontend/assets/images/icons/hambarger.svg') }}" alt="">
        </button>
        <a class="navbar-brand m-auto" href="/"><img src="{{ asset('frontend/assets/images/logo/logo.svg') }}" alt="bhorer Kagoj Logo"></a>

        <ul class="navbar-nav align-items-center mobileCart">
            <li class="nav-item">
                <a data-bs-toggle="offcanvas" href="#cartSidebar" class="nav-link badge_link position-relative">
                    <img src="{{ asset('frontend/assets/images/icons/cart.svg') }}" alt="">
                    <span class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-brand">
                       <span class="cartCounter">{{Cart::count()}}</span>
                        <span class="visually-hidden">unread messages</span>
                    </span> </a>

                    
            </li>
        </ul>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item dropdown dropdown_content" data-mege_menu_id="prokashoni_menu">
                    <a class="nav-link custom_nav_link dropdown-toggle" href="javascript:void(0)" role="button">
                        প্রকাশনী
                    </a>
                </li>
                <li class="nav-item dropdown dropdown_content" data-mege_menu_id="subject_menu">
                    <a class="nav-link custom_nav_link dropdown-toggle" href="javascript:void(0)" role="button">
                        বিষয়
                    </a>
                </li>
                <li class="nav-item dropdown dropdown_content" data-mege_menu_id="writers_menu">
                    <a class="nav-link custom_nav_link dropdown-toggle last_item" href="javascript:void(0)"
                        role="button">
                        লেখক
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto align-items-center">
                <form class="position-relative" action="{{ route('book.filter.search') }}">
                    @csrf
                    <div class="nav_search" >
                        <input type="text" placeholder="এখানে বই খুঁজুন" aria-label="Search" id="navbar_search" name="navbar_search"  onkeypress="book_search_method()" onkeyup="book_search_method()">
                        <button type="submit"><img src="{{ asset('frontend/assets/images/icons/search.svg') }}" alt=""></button>
                      
                    </div>
                    <div  id="nav_bar_search_div"  class="position-absolute left-0 right-0 search_div" ></div>
                </form>

                <li class="nav-item">
                    <a class="nav-link badge_link position-relative" href="{{route('customer.profile')}}#wishlist">
                        <img src="{{ asset('frontend/assets/images/icons/love-icon.svg') }}" alt="">
                        <span
                            class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-brand">
                            @auth
                            <span class="whislistCounter">{{auth()->user()->wishlists->count()}}</span>
                            @else
                            <span class="whislistCounter">0</span>
                            @endauth
                            <span class="visually-hidden">unread messages</span>

                        </span> </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="offcanvas" href="#cartSidebar" class="nav-link badge_link position-relative cartSideBar {{Cart::count() <1 ? 'd-none': ''}}"
                        href="#">
                        <img src="{{ asset('frontend/assets/images/icons/cart.svg') }}" alt="">
                        <span
                            class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-brand">
                            <span class="cartCounter">{{Cart::count()}}</span>
                            <span class="visually-hidden">unread messages</span>
                        </span> </a>

                        <a href="javascript:void(0)" class="nav-link badge_link position-relative cartTooltip {{Cart::count() <1 ? '': 'd-none'}}" aria-current="page"
                        data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cart Empty">
                        <img src="{{ asset('frontend/assets/images/icons/cart.svg') }}" alt="">
                        <span
                            class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-brand">
                            <span class="cartCounter">{{Cart::count()}}</span>
                            <span class="visually-hidden">unread messages</span>
                        </span> </a>
                </li>
              
                @auth
                <li class="nav-item user_login_icon">
                    <a href="{{route('customer.profile')}}"><img src="{{ asset( auth()->user()->image == null ? 'frontend/assets/images/profile/profile-icon.png' : 'images/'.auth()->user()->image) }}" alt=""></a>
                    <div class="user_login_dropdown">
                        <ul>
                            <li><a href="{{ route('customer.profile') }}">আমার প্রোফাইল</a></li>
                            <li><a href="{{ route('customer.profile') }}#orders">আমার অর্ডারস </a></li>
                            <li><a href="{{ route('customer.profile') }}#wishlist">পছন্দের তালিকা</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">সাইন আউট</a>
                               
                        <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                            </li>
                        </ul>
                    </div>
                </li>
                @else
                <li class="nav-item user_login">
                    <a class="nav-link " href="{{route('frontend.login')}}">
                        <span>লগ
                            ইন</span>
                    </a>
                    <div class="nav_login_form">
                        <div class="arrow_icon"></div>
                        <div class="login_wrapper">
                            <div class="login_header">
                                <h1>লগ ইন করুন</h1>
                            </div>
                            <div class="form_wrapper">
                                <form class="login_auth_box" id="loginModalForm" method="POST">@csrf
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <input class="form-control form-control-lg phone_number" type="text"
                                                placeholder="আপনার ফোন নম্বর" name="number">

                                                <input class="form-control form-control-lg otp_change d-none" name="otp" type="password"
                                                placeholder="পাসওয়ার্ড">

                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn_tg_sub">সাবমিট করুন</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row social_login">
                                    <div class="col-12">
                                        <h3 class="or">অথবা গুগল/ফেসবুক দিয়ে লগ ইন করুন,</h3>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{route('login.google')}}"><button><img src="{{ asset('frontend/assets/images/icons/Google__G__Logo 1.svg') }}"
                                                    alt="">Google</button></a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#">
                                            <button><img src="{{ asset('frontend/assets/images/icons/Facebook_f_logo_(2019) 1.svg') }}"
                                                    alt="">Facebook</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                @endauth
              
            </ul>

        </div>
    </div>

    <!-- New Mega Menu -->
    <div class="container new_mega_menu" id="prokashoni_menu">
        <div class="mega_menu_wraper">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <h1 class="mega_menu_title">প্রকাশনী</h1>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('frontend.publishers')}}"><button class="writer_btn">সব প্রকাশনী দেখুন <img
                                src="{{ asset('frontend/assets/images/icons/fi_arrow-right.svg') }}" alt=""></button></a>
                        </div>
                    </div>
                    <div class="row mega_link_box">
                        @if (!empty($publications))
                        @foreach ($publications as $publication)
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="{{ route('frontend.publishers.name', $publication->publication_id ) }}"> {{$publication->name}}</a></li>
                            </ul>
                        </div> 
                        @endforeach
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container new_mega_menu" id="subject_menu">
        <div class="mega_menu_wraper">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <h1 class="mega_menu_title">বিষয় সমূহ</h1>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('frontend.topics')}}"><button class="writer_btn">সব বিষয় দেখুন <img
                                src="{{ asset('frontend/assets/images/icons/fi_arrow-right.svg') }}" alt=""></button></a>
                            {{-- <button class="writer_btn">সব বিষয় দেখুন <img
                                    src="{{ asset('frontend/assets/images/icons/fi_arrow-right.svg') }}" alt=""></button> --}}
                        </div>
                    </div>
                    <div class="row mega_link_box">
                        @if(!empty($categories))
                        @foreach ($categories as $category)
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="{{ route('frontend.topics.name', $category->category_id ) }}">{{ $category->name }}</a></li>
                            </ul>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="container new_mega_menu" id="writers_menu">
        <div class="mega_menu_wraper">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <h1 class="mega_menu_title">লেখকগণ</h1>
                        </div>
                        <div class="col-6 text-end">
                            <a href="{{ route('frontend.authors')}}"><button class="writer_btn">সব লেখকদের দেখুন <img
                                src="{{ asset('frontend/assets/images/icons/fi_arrow-right.svg') }}" alt=""></button></a>   
                        </div>
                    </div>
                    <div class="row mega_link_box"> 
                        @if(!empty($authors))
                        @foreach ($authors as $author)
                         
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="{{ route('frontend.author.details', $author->author_id ) }}">{{ $author->name }}</a></li>
                            </ul>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>
</nav>

<div class="container mobile_search">
    <div class="row">
        <div class="col-12">
            <div class="nav_search">
                <input type="text" placeholder="এখানে বই খুঁজুন" aria-label="Search">
                <button><img src="{{ asset('frontend/assets/images/icons/search.svg') }}" alt=""></button>
            </div>
        </div>
    </div>
</div>

<!-- smll device side nav -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLebel">
    <div class="offcanvas-body">

        <div class="side_header">
            <button data-bs-dismiss="offcanvas" class="canvasClose"><img src="{{ asset('frontend/assets/images/icons/close.svg') }}"
                    alt=""></button>
            <div>
               
               
               

                @auth
                <img src="{{ asset(auth()->user()->image == null ?'frontend/assets/images/icons/demoUserImg.svg' : 'images/'.auth()->user()->image) }}" alt="">

                <div class="sm_user_login">
                    <button class="" type="button" data-bs-toggle="collapse" data-bs-target="#smUserDropdown" aria-controls="smUserDropdown"
                        aria-expanded="false" aria-label="">
                        রায়হান কবির
                        <img src="{{ asset('frontend/assets/images/icons/down-arrow-white.svg') }}" alt="arrow">
                    </button>
                    <div class="sm_user_login_dropdown collapse" id=smUserDropdown>
                        <ul>
                            <li><a href="{{ route('customer.profile') }}">আমার প্রোফাইল</a></li>
                            <li><a href="{{ route('customer.profile') }}">আমার অর্ডারস </a></li>
                            <li><a href="{{ route('customer.profile') }}">পছন্দের তালিকা</a></li>
                            <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">সাইন আউট</a>
                               
                                <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                    </li>
                        </ul>
                    </div>
                </div>

                @else 
                <img src="{{ asset('frontend/assets/images/icons/demoUserImg.svg') }}" alt="">
               <a href="{{route('frontend.login')}}"><h1>লগইন / সাইন ইন</h1></a>  
                @endauth
            </div>
        </div>
        <div class="side_body">
            <ul class="side_menu">
                <li><a href="{{route('frontend.home')}}">হোম</a></li>
                <li>
                    <a class="dropdown_link" href="javascript:void(0)">প্রকাশনী</a>
                    <ul class="multi_level d-none">
                        @if(!empty($publications))
                        @foreach ($publications as $publication)
                            <li><a href="{{ route('frontend.publishers.name', $publication->publication_id) }}">{{$publication->name}}</a></li>
                        @endforeach
                        @endif
                        <li><a href="{{ route('frontend.publishers') }}"><button class="writer_btn">সব প্রকাশনী দেখুন <img
                                        src="{{ asset('frontend/assets/images/icons/fi_arrow-right.svg') }}" alt=""></button></a></li>
                    </ul>
                </li>
                <li>
                    <a class="dropdown_link" href="javascript:void(0)">বিষয়</a>
                    <ul class="multi_level d-none">
                        @if(!empty($categories))
                        @foreach ($categories as $category)
                            <li><a href="{{ route('frontend.topics.name', $category->category_id ) }}">{{ $category->name }}</a></li>
                        @endforeach
                        @endif
                        <li><a href="{{ route('frontend.topics')}}"><button class="writer_btn">সব বিষয় দেখুন <img
                                        src="{{ asset('frontend/assets/images/icons/fi_arrow-right.svg') }}" alt=""></button></a></li>
                    </ul>
                </li>
                <li>
                    <a class="dropdown_link" href="javascript:void(0)">লেখক</a>
                    <ul class="multi_level d-none">
                        @if(!empty($authors))
                        @foreach ($authors as $author)
                        <li><a href="{{ route('frontend.author.details', $author->author_id ) }}">{{ $author->name }}</a></li>
                        @endforeach
                        @endif
                        <li><a href="{{ route('frontend.authors')}}"><button class="writer_btn">সব লেখক দেখুন <img
                                        src="{{ asset('frontend/assets/images/icons/fi_arrow-right.svg') }}" alt=""></button></a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="sidebar_logo">
            <img src="{{ asset('frontend/assets/images/icons/sidebarLogo.svg') }}" alt="">
        </div>
    </div>

</div>
