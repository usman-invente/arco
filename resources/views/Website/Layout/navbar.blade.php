<div class="header header-3">

    <!-- TOPBAR -->
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-6">
                    @if(LaravelLocalization::getCurrentLocale() === 'ar')
                            <div class="info pull-right">
                                <div class="info-item">
                                    <span class="fa fa-envelope-o"></span> <a href="mailto:info@arco.com" title=""><strong>Mail:</strong> info@arco.com</a>
                                </div>
                                <div class=" info-item">
                                    <a href="{{ URL('contact_us') }}"><span style="font-size:12px; ">Contact Us </span>  </a>
                                </div>
                            </div>
                    @else
                        <div class="info">
                            <div class="info-item">
                                <a href="{{route('register')}}" ><input class="regis" type="button" name="" value="Register Volunteers"></a>
                                <!--<span class="fa fa-envelope-o"></span> <a href="mailto:{{$contact_us->email}}" title=""><strong>Mail:</strong> {{ $contact_us->email }}</a>-->
                            </div>
                            <div class=" info-item">
                                <a href="{{ route('login') }}" ><input class="signin" type="button" name="" value="Sign In"></a>
                              <!--  <a href="{{ URL('contact_us') }}"><span style="font-size:12px; ">{{ __('navbar.contact_us') }} </span>  </a>-->
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-sm-4 col-md-6">
                    @if(LaravelLocalization::getCurrentLocale() === 'ar')
                        <div class="sosmed-icon pull-left">

    {{--                        <a href="{{ URL('/login') }}"><span style="font-size:12px; ">Login </span>  </a>--}}
    {{--                        <a href="{{ URL('/register') }}"><span style="font-size:12px; ">SignUp </span></a>--}}
                            @if(!empty(\Illuminate\Support\Facades\Auth::user()))
                                <a href="{{ route('dashboard.home') }}"><span style="font-size:12px; ">{{ __('navbar.dashboard') }} </span>  </a>
                                {{--                        <a href="{{ URL('/register') }}"><span style="font-size:12px; ">SignUp </span></a>--}}
                            @endif
                                <!-- Authentication Links -->
                                @guest
                                    <a href="{{ route('login') }}"><span style="font-size:12px; ">{{ __('navbar.Login') }} </span>  </a>
                                    @if (Route::has('register'))
                                        <a href="{{ URL('/register') }}"><span style="font-size:12px; ">{{ __('navbar.Register') }} </span></a>
                                    @endif
                                @endguest

                        </div>
                     @else
                        <div class="sosmed-icon pull-right">

                            @if(!empty(\Illuminate\Support\Facades\Auth::user()))
                             <a href="{{ route('dashboard.home') }}"><span style="font-size:12px; ">{{ __('navbar.dashboard') }} </span>  </a>
                        {{--                        <a href="{{ URL('/register') }}"><span style="font-size:12px; ">SignUp </span></a>--}}
                            @endif
                        <!-- Authentication Links -->
                            @guest
                            <div class="social-media-icons col-xs-12">
            <ul class="list-inline col-xs-12">
              <a href="#"><i class="fa fa-youtube-play na fa-5x"></i></a>
              <a href="#"><i class="fa fa-instagram  na fa-5x"></i></a>
              <a href="#"><i class="fa fa-twitter na fa-5x"></i></a>
              
              <a href="#"><i class="fa fa-facebook na fa-5x"></i></a>               
            </ul>
          </div>
                          <!--      <a href="{{ route('login') }}"><span style="font-size:12px; ">{{ __('Login') }} </span>  </a>-->
                                @if (Route::has('register'))
                                   <!-- <a href="{{ URL('/register') }}"><span style="font-size:12px; ">{{ __('Register') }} </span></a>-->
                                @endif
                            @endguest

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- NAVBAR SECTION -->
    <div class="navbar-main">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <a class="navbar-brand" href="{{ URL('/') }}">
                    <img src="{{ asset('public/images/'.$logos[0]->logo) }}" alt="" style="width: 320px; height:70px;"  />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown"  @if(LaravelLocalization::getCurrentLocale() === 'ar')  style="margin-right: 100px;" @endif>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL('/') }}">{{ __('navbar.home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL('page/1') }}">{{ __('navbar.about_us') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL('news') }}">{{ __('navbar.our_news') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL('opportunities') }}">{{ __('navbar.volunteer_opportunities') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL('nationalSocieties/1') }}">{{ __('navbar.our_national_societies') }}</a>
                        </li>


                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{__('navbar.language')}}</a>
                            <div class="dropdown-menu">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <a class="dropdown-item" rel="alternate"  hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                @endforeach
                            </div>
                        </li>


                        <li class="nav-item dropdown">
                            @guest
                            @else
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span style="color: darkred; font-weight: bold;" >@php $name=explode(' ', Auth::user()->name) @endphp {{  $name[0] }}</span>
                                </a>

                                <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            @endguest
                        </li>

                    </ul>

                </div>
            </nav>
        </div>
    </div>



</div>