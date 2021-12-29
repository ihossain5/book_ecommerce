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
                <form>
                    <div class="nav_search">
                        <input type="text" placeholder="এখানে বই খুঁজুন" aria-label="Search">
                        <button><img src="{{ asset('frontend/assets/images/icons/search.svg') }}" alt=""></button>
                    </div>
                </form>

                <li class="nav-item">
                    <a class="nav-link badge_link position-relative" href="#">
                        <img src="{{ asset('frontend/assets/images/icons/love-icon.svg') }}" alt="">
                        <span
                            class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-brand">
                            1
                            <span class="visually-hidden">unread messages</span>
                        </span> </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="offcanvas" href="#cartSidebar" class="nav-link badge_link position-relative"
                        href="#">
                        <img src="{{ asset('frontend/assets/images/icons/cart.svg') }}" alt="">
                        <span
                            class="position-absolute top-1 start-100 translate-middle badge rounded-pill bg-brand">
                            <span class="cartCounter">{{Cart::count()}}</span>
                            <span class="visually-hidden">unread messages</span>
                        </span> </a>
                </li>
                <li class="nav-item user_login_icon">
                    <a href="my-profile.html"><img src="{{ asset('frontend/assets/images/icons/user.svg') }}" alt=""></a>
                </li>
                <li class="nav-item user_login">
                    <a class="nav-link " href="login.html">
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
                                <form action="#" class="login_auth_box">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <input class="form-control form-control-lg" type="text"
                                                placeholder="আপনার ফোন নম্বর">

                                        </div>
                                        <div class="col-12 mb-3">
                                            <input class="form-control form-control-lg" type="password"
                                                placeholder="পাসওয়ার্ড">
                                        </div>
                                        <div class="col-12">
                                            <button>সাবমিট করুন</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row social_login">
                                    <div class="col-12">
                                        <h3 class="or">অথবা গুগল/ফেসবুক দিয়ে লগ ইন করুন,</h3>
                                    </div>
                                    <div class="col-6">
                                        <a href="#"><button><img src="{{ asset('frontend/assets/images/icons/Google__G__Logo 1.svg') }}"
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
                            <button class="writer_btn">সব লেখকদের দেখুন <img
                                    src="{{ asset('frontend/assets/images/icons/fi_arrow-right.svg') }}" alt=""></button>
                        </div>
                    </div>
                    <div class="row mega_link_box">
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">প্রকাশনী নাম</a></li>
                            </ul>
                        </div>
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
                            <button class="writer_btn">সব বিষয় দেখুন <img
                                    src="{{ asset('frontend/assets/images/icons/fi_arrow-right.svg') }}" alt=""></button>
                        </div>
                    </div>
                    <div class="row mega_link_box">
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">বিষয়ের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">বিষয়ের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">বিষয়ের নাম</a></li>
                            </ul>
                        </div>

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
                            <button class="writer_btn">সব লেখকদের দেখুন <img
                                    src="{{ asset('frontend/assets/images/icons/fi_arrow-right.svg') }}" alt=""></button>
                        </div>
                    </div>
                    <div class="row mega_link_box">
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
                        <div class="col-3">
                            <ul class="mega_writer_link">
                                <li><a href="#">লেখকের নাম</a></li>
                            </ul>
                        </div>
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
                <img src="{{ asset('frontend/assets/images/icons/demoUserImg.svg') }}" alt="">
                <h1>লগইন / সাইন ইন</h1>
            </div>
        </div>
        <div class="side_body">
            <ul class="side_menu">
                <li><a href="/">হোম</a></li>
                <li>
                    <a class="dropdown_link" href="javascript:void(0)">প্রকাশনী</a>
                    <ul class="multi_level d-none">
                        <li><a href="#">প্রকাশনী 1</a></li>
                        <li><a href="#">প্রকাশনী 2</a></li>
                        <li><a href="#"><button class="writer_btn">সব প্রকাশনী দেখুন <img
                                        src="{{ asset('frontend/assets/images/icons/fi_arrow-right.svg') }}" alt=""></button></a></li>
                    </ul>
                </li>
                <li>
                    <a class="dropdown_link" href="javascript:void(0)">বিষয়</a>
                    <ul class="multi_level d-none">
                        <li><a href="#">বিষয় 1</a></li>
                        <li><a href="#">বিষয় 2</a></li>
                        <li><a href="#"><button class="writer_btn">সব বিষয় দেখুন <img
                                        src="{{ asset('frontend/assets/images/icons/fi_arrow-right.svg') }}" alt=""></button></a></li>
                    </ul>
                </li>
                <li>
                    <a class="dropdown_link" href="javascript:void(0)">লেখক</a>
                    <ul class="multi_level d-none">
                        <li><a href="#">লেখক 1</a></li>
                        <li><a href="#">লেখক 1</a></li>
                        <li><a href="#"><button class="writer_btn">সব লেখক দেখুন <img
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
