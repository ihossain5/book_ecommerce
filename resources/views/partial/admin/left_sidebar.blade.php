
<!-- ========== Left Sidebar Start ========== -->
<div class="left side-menu">

    <!-- LOGO -->
    <div class="topbar-left">
        <div class="">
            <!--<a href="index.html" class="logo text-center">Fonik</a>-->
            <a href="{{ route('dashboard') }}" class="logo">
                <h6>Admin Dashboard</h6>
                {{-- <img src="{{asset('backend/assets/images/logo.png')}}" height="20" alt="logo"> --}}
            </a>
        </div>
       

    </div>

    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <div class="">
                    <div class="card sidebar_user_card m-b-20">
                        <div class="card-body">

                            <div class="media justify-content-center">
                                @if (Auth::user()->image == null)
                                    <img src="{{ asset('images/default.png') }}" class="left_sidebar_image"
                                        alt="user-profle">
                                @else
                                    <img class="d-flex mr-2 rounded-circle thumb-lg"
                                        src="{{ asset('images/' . Auth::user()->image) }}"
                                        alt="Generic placeholder image">
                                @endif
                            </div>
                            <div>
                                <h6 class="text-center user_name">{{ Auth::user()->name }}</h6>
                            </div>

                        </div>
                    </div>

                </div>
               


                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect"><i
                            class="dripicons-device-desktop"></i><span>
                            Dashboard </span></a>
                </li>
                
                    <li>
                        <a href="{{ route('category.index') }}" class="waves-effect">
                            <i class="fa fa-list-alt"></i>
                            <span> Category Management </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('feature-attributes.index') }}" class="waves-effect">
                            <i class="fa fa-certificate"></i>
                            <span> Feature Attribute </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('publications.index') }}" class="waves-effect">
                            <i class="fa fa-newspaper-o"></i>
                            <span> Publications </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('authors.index') }}" class="waves-effect">
                            <i class="fa fa-pencil-square-o"></i>
                            <span> Author Management </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('books.index') }}" class="waves-effect">
                            <i class="fa fa-book"></i>
                            <span> Book Management </span>
                        </a>
                    </li>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cart-arrow-down"></i><span> Order Management  <span class="float-right"><i class="mdi mdi-chevron-right"></i></span>
                            </span></a>
                        <ul class="list-unstyled">
                            <li>
                                <a href="{{ route('order.index') }}" class="waves-effect">
                                    <i class="fa fa-file-text-o"></i>
                                    <span>Invoices </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('order.info') }}" class="waves-effect">
                                    <i class="fa fa-cart-arrow-down"></i>
                                    <span>Orders </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="dripicons-web"></i><span> Website
                                Content <span class="float-right"><i class="mdi mdi-chevron-right"></i></span>
                            </span></a>
                        <ul class="list-unstyled">
                            {{-- @if (Auth::user()->is_super_admin == 1 || Auth::user()->is_admin == 1) --}}
                                <li>
                                    <a href="{{ route('sliders.index') }}" class="waves-effect">
                                        <i class="dripicons-calendar"></i>
                                        <span>Sliders</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('socials') }}" class="waves-effect">
                                        <i class="dripicons-calendar"></i>
                                        <span>Social Medias</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('contacts') }}" class="waves-effect">
                                        <i class="fa fa-address-card-o"></i>
                                        <span>Contacts</span>
                                    </a>
                                </li>
                            {{-- @endif --}}
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('admin.index') }}" class="waves-effect">
                            <i class="dripicons-user"></i>
                            <span> Admin Management </span>
                        </a>
                    </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->
