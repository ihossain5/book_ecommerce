
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
                        <a href="{{ route('admin.index') }}" class="waves-effect">
                            <i class="dripicons-calendar"></i>
                            <span> Admin Management </span>
                        </a>
                    </li>
               
                    <li>
                        <a href="{{ route('category.index') }}" class="waves-effect">
                            <i class="dripicons-calendar"></i>
                            <span> Category Management </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('feature-attributes.index') }}" class="waves-effect">
                            <i class="dripicons-calendar"></i>
                            <span> Feature Attribute </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('publications.index') }}" class="waves-effect">
                            <i class="dripicons-calendar"></i>
                            <span> Publications </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('authors.index') }}" class="waves-effect">
                            <i class="dripicons-calendar"></i>
                            <span> Publications </span>
                        </a>
                    </li>
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
</div>
<!-- Left Sidebar End -->
