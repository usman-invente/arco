    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="https://arabrcrc.org/volunteer_test/">

                    <img src="{{asset('public/images/ARCO-LOGO.png')}}" style="width: 200px;">
                    </a></li>
                {{-- <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li> --}}
            </ul>
        </div>     
        {{-- @if (Auth::user()->role_id == 1)
        <h5 style="text-align: center">{{__('lang.Admin') }}</h5>
         @elseif (Auth::user()->role_id == 3)
         <h5 style="text-align: center;margin-top:20px;">Volunteer Supervisor</h5>
         @elseif (Auth::user()->role_id == 4)
         <h5 style="text-align: center;margin-top:20px;">Volunteer Opportunity Officer</h5>
         @elseif (Auth::user()->role_id == 6)  
         <h5 style="text-align: center;margin-top:20px;">Site Admin</h5>
        @endif --}}
        @if(Auth::user()->role_id == 2 )
        <div class="main-menu-content" style="margin-top: 40px;">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="{{route('home')}}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">{{__('dashboard/lang.Dashboard') }}</span><span class="badge badge badge-warning badge-pill float-right mr-2"></span></a>
                </li>
                <li class=" nav-item"><a href="{{route('admin_Volunteer_Supervisor')}}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Email">{{__('dashboard/lang.VS') }}</span></a>
                </li>
                <li class=" nav-item"><a href="{{route('admin_Volunteer_Opportunity_Officers')}}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Chat">{{__('dashboard/lang.VOO') }}</span></a>
                </li>
                <li class=" nav-item"><a href="{{route('admin_volunteer_field')}}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Todo">{{__('dashboard/lang.AOVP') }}</span></a>
                </li>
                <li class=" nav-item"><a href="{{route('admin_manage_Volunteer_Opportunity')}}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Calender">{{__('dashboard/lang.MOV') }}</span></a>
                </li>
                <li class=" nav-item"><a href="{{route('admin_organization')}}"><i class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.National Societies') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('admin_reports')}}"><i class="feather icon-list"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.Reports') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('admin_volunteer')}}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.Volunteers') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('admin_news')}}"><i class="feather icon-video"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.News') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('admin_account')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Ecommerce"> {{__('dashboard/lang.Account') }}</span></a></li>
                {{-- <li class=" nav-item"><a href="{{route('admin_account')}}" ><i class="feather icon-user-check"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.User Roles') }}</span></a></li>
                <li class=" nav-item"><a href="#"><i class="feather icon-monitor"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.PM') }}</span></a>
                </li> --}}
            </ul>
        </div>
        @elseif(Auth::user()->role_id == 3)
        <div class="main-menu-content" style="margin-top: 40px;">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="{{route('admin_Volunteer_Opportunity_Officers')}}"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Chat">{{__('dashboard/lang.VOO') }}</span></a>
                </li>
                <li class=" nav-item"><a href="{{route('admin_volunteer_field')}}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Todo">{{__('dashboard/lang.AOVP') }}</span></a>
                </li>
                <li class=" nav-item"><a href="{{route('admin_manage_Volunteer_Opportunity')}}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Calender">{{__('dashboard/lang.MOV') }}</span></a>
                </li>
                <li class=" nav-item"><a href="{{route('admin_organization')}}"><i class="feather icon-shopping-cart"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.National Societies') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('admin_reports')}}"><i class="feather icon-list"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.Reports') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('admin_volunteer')}}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.Volunteers') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('admin_news')}}"><i class="feather icon-video"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.News') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('admin_account')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Ecommerce"> {{__('dashboard/lang.Account') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('admin_account')}}" ><i class="feather icon-user-check"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.User Roles') }}</span></a></li>
                <li class=" nav-item"><a href="#"><i class="feather icon-monitor"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.PM') }}</span></a>
                </li>
            </ul>
        </div>
        @elseif(Auth::user()->role_id == 4)
        <div class="main-menu-content" style="margin-top: 40px;">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="{{route('admin_manage_Volunteer_Opportunity')}}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Calender">{{__('dashboard/lang.MOV') }}</span></a>
                </li>
                <li class=" nav-item"><a href="{{route('admin_reports')}}"><i class="feather icon-list"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.Reports') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('admin_volunteer')}}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.Volunteers') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('admin_news')}}"><i class="feather icon-video"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.News') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('admin_account')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Ecommerce"> {{__('dashboard/lang.Account') }}</span></a></li>
            </ul>
        </div>
        @elseif(Auth::user()->role_id == 6)
        <div class="main-menu-content" style="margin-top: 40px;">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="{{route('home')}}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">{{__('dashboard/lang.Dashboard') }}</span><span class="badge badge badge-warning badge-pill float-right mr-2"></span></a>
                </li>
                <li class=" nav-item"><a href="{{route('page')}}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Calender"> {{__('dashboard/lang.Page Manager') }}</span></a>
                </li>
                <li class=" nav-item"><a href="{{ route('site_news') }}"><i class="feather icon-video"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.News') }}</span></a></li>
                <li class=" nav-item"><a href="{{ route('animated_slide') }}"><i class="feather icon-airplay"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.Animated Slides') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('counter')}}"><i class="feather icon-aperture"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.Counters') }}</span></a></li>
                <li class=" nav-item"><a href="{{ route('contact_us') }}"><i class="feather icon-phone-call"></i><span class="menu-title" data-i18n="Ecommerce"> {{__('dashboard/lang.Call US') }}</span></a></li>
                <li class=" nav-item"><a href="{{ route('footer') }}"><i class="feather icon-arrow-down"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.Footer') }}</span></a></li>
                <li class=" nav-item"><a href="{{ route('logo') }}"><i class="feather icon-image"></i><span class="menu-title" data-i18n="Ecommerce"> {{__('dashboard/lang.Logos') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('sit_account')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Ecommerce"> {{__('dashboard/lang.Account') }}</span></a></li>
                <li class=" nav-item"><a href="{{ route('user_registration') }}"><i class="feather icon-user-plus"></i><span class="menu-title" data-i18n="Ecommerce">  {{__('dashboard/lang.User Registration') }}</span></a></li>
                     
            </ul>
        </div>
          @elseif(Auth::user()->role_id == 5)
        <div class="main-menu-content" style="margin-top: 40px;">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a href="{{route('home')}}"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">{{__('dashboard/lang.Dashboard') }}</span><span class="badge badge badge-warning badge-pill float-right mr-2"></span></a>
                </li>
                <li class=" nav-item"><a href="{{route('page')}}"><i class="feather icon-user"></i><span class="menu-title" data-i18n="Calender"> {{__('dashboard/lang.Page Manager') }}</span></a>
                </li>
                <li class=" nav-item"><a href="{{ route('site_news') }}"><i class="feather icon-video"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.News') }}</span></a></li>
                <li class=" nav-item"><a href="{{ route('animated_slide') }}"><i class="feather icon-airplay"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.Animated Slides') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('counter')}}"><i class="feather icon-aperture"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.Counters') }}</span></a></li>
                <li class=" nav-item"><a href="{{ route('contact_us') }}"><i class="feather icon-phone-call"></i><span class="menu-title" data-i18n="Ecommerce"> {{__('dashboard/lang.Call US') }}</span></a></li>
                <li class=" nav-item"><a href="{{ route('footer') }}"><i class="feather icon-arrow-down"></i><span class="menu-title" data-i18n="Ecommerce">{{__('dashboard/lang.Footer') }}</span></a></li>
                <li class=" nav-item"><a href="{{ route('logo') }}"><i class="feather icon-image"></i><span class="menu-title" data-i18n="Ecommerce"> {{__('dashboard/lang.Logos') }}</span></a></li>
                <li class=" nav-item"><a href="{{route('sit_account')}}"><i class="feather icon-settings"></i><span class="menu-title" data-i18n="Ecommerce"> {{__('dashboard/lang.Account') }}</span></a></li>
                <li class=" nav-item"><a href="{{ route('user_registration') }}"><i class="feather icon-user-plus"></i><span class="menu-title" data-i18n="Ecommerce">  {{__('dashboard/lang.User Registration') }}</span></a></li>
                     
            </ul>
        </div>
        @endif
    </div>
    <!-- END: Main Menu-->
