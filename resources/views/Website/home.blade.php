<!DOCTYPE html>
<html @if (LaravelLocalization::getCurrentLocale() === 'ar') lang="ar" dir="rtl" @elseif(LaravelLocalization::getCurrentLocale() === 'en') lang="en" @endif>


<!-- HEAD START -->
@include('Website.Layout.head')
<!-- HEAD END -->

<body>

    <!-- LOAD PAGE -->
    <div class="animationload">
        <div class="loader"></div>
    </div>

    <!-- BACK TO TOP SECTION -->
    <a href="#0" class="cd-top cd-is-visible cd-fade-out">Top</a>

    <!-- Navbar -->
    @include('Website.Layout.navbar')
    <!-- Navbar END -->


    <!-- BANNER -->
    <div class="sllide">
        <div class="baneeer">
            <div class="item2">
                <img src="{{ asset('public/upload/Animated-Slide/Hands-Raised.jpeg') }}" alt="Slider">
                <div class="centered col-md-12">
                    <p class="volunteer_p">Volunteer platform</p>
                    <p class="volunteer_p1">Arab Red Crescent and Red Cross organization</p>
                    <p class="volunteer_p1" id="demo" style="font-size:56px"></p>
                    <div class="form-group has-search col-md-12">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" class="form-control sear" placeholder="Search bar">
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- <div id="oc-fullslider" class="banner owl-carousel" style="height: 600px;" >
    @if (!empty($slides))
        @foreach ($slides as $slide)
            <div class="owl-slide" style="height: 600px;" >
                <div class="item">
                    <img src="{{ asset("public/upload/Animated-Slide/".$slide->image) }}" alt="Slider">
                </div>
            </div>
        @endforeach
    @endif
</div> --}}

    <div class="clearfix"></div>



    <!-- ABOUT US -->
    <div class="section  section-border">
        <div class="content-wrap content-wrap-20">
            <div class="container">


                <div class="row">

                    <div class="col-sm-3 col-md-3">
                        <div class="rs-icon-funfact style-2">
                            <div class="icon">
                                <i class="fa fa-file-text-o"></i>
                            </div>
                            <div class="body-content">
                                <h2>{{ $counters->no_of_volunteer }}</h2>
                                <p class="uk18">{{ __('home.register_volunteer') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <div class="rs-icon-funfact style-2">
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                            <div class="body-content">
                                <h2>{{ $counters->no_of_volunteer_opportunities }}</h2>
                                <p class="uk18">{{ __('home.volunteer_opportunities') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <div class="rs-icon-funfact style-2">
                            <div class="icon">
                                <i class="fa fa-trophy"></i>
                            </div>
                            <div class="body-content">
                                <h2>{{ $counters->no_of_organizations }}</h2>
                                <p class="uk18">{{ __('home.no_of_organizations') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <div class="rs-icon-funfact style-2">
                            <div class="icon">
                                <i class="fa fa-male"></i>
                            </div>
                            <div class="body-content">
                                <h2>{{ $counters->no_of_volunteer_hours }}</h2>
                                <p class="uk18">{{ __('home.no_of_volunteers_hours') }}</p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>



    <!-- WE NEED YOUR HELP -->
    <div class="section services">
        <div class="content-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h2 class="section-heading center">
                            {{ __('home.opportunities') }} <span>{{ __('home.section') }}</span>
                        </h2>
                        <p class="text-center">{{ __('home.opportunities_title') }}<span
                                style="font-weight: bold; color: #ae1c17;">{{ __('home.help') }}</span>
                            {{ __('home.others') }}</p>
                    </div>
                    @if (!empty($opportunities))
                        @foreach ($opportunities as $opportunity)
                            <div class="col-sm-4 col-md-4">
                                <!-- BOX 1 -->
                                <div class="card box-fundraising">

                                    <div class="body-content">
                                        <div class="media">
                                            <img src="{{ asset('public/upload/logo/' . $opportunity->logo) }}" alt="">
                                        </div>
                                        <div class="text" style="color: #1b1e21; font-weight: bold;">
                                            {{ $opportunity->name_en }}</div>
                                        <div class="text" style="color: #1b1e21; font-weight: bold;">
                                            {{ $opportunity->city }}</div>
                                            <div class="text" style="color: #1b1e21; font-weight: bold;">
                                                {{ $opportunity->name }}</div>
                                                <div class="text" style="color: #1b1e21; font-weight: bold;">
                                                Starting Date : {{ $opportunity->start_date }}</div>
                                                    <div class="text" style="color: #1b1e21; font-weight: bold;">
                                                End Date       {{ $opportunity->end_date }}</div>
                                    
                                        <div class="meta">
                                            <div class="row">
                                                @if ($opportunity->status_id == 1)
                                                    <div class=" col-md-6"
                                                        style="background-color: rgba(80,160,47,0.8); padding-top: 0px; padding-bottom: 0px;">
                                                        <h5
                                                            style="font-weight: bold; color: white; text-align: center;">
                                                            {{ __('home.available') }} </h5>
                                                    </div>
                                                @else
                                                    <div class=" col-md-6"
                                                        style="background-color: rgb(160,47,47); padding-top: 0px; padding-bottom: 0px;">
                                                        <h5
                                                            style="font-weight: bold; color: white; text-align: center;">
                                                            {{ __('home.not available') }} </h5>
                                                    </div>
                                                @endif
                                                <div class=" col-md-6">
                                                    <a href="{{ URL('opportunities_details/' . $opportunity->id) }}"
                                                        class="btn btn-secondary">{{ __('home.details') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif



                    <div class="col-sm-12 col-md-12">
                        <div class="spacer-50"></div>
                        <div class="text-center">
                            <a href="{{ URL('opportunities') }}"
                                class="btn btn-primary">{{ __('home.more_opportunities') }}</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>






    <!-- WE NEED YOUR HELP -->
    <div class="section services">
        <div class="content-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <h2 class="section-heading center">
                            {{ __('home.news') }} <span>{{ __('home.section') }}</span>
                        </h2>
                        <p class="subheading text-center">{{ __('home.news_title') }}</p>
                    </div>
                    <div class="clearfix"></div>
                    <!-- Item 1 -->
                    @if (!empty($news))
                        @foreach ($news as $singleNews)
                            <a href="{{ URL('details/' . $singleNews->id) }}">
                                <div class="col-sm-4 col-md-4">
                                    <div class="box-fundraising">
                                        <div class="media">
                                            <img src="{{ asset('public/upload/news/' . $singleNews->image) }}" alt="">
                                        </div>
                                        <div class="body-content">
                                            <div class="text"><a
                                                    href="{{ URL('details/' . $singleNews->id) }}">{{ $singleNews->description }}</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @endif

                    <div class="col-sm-12 col-md-12">
                        <div class="spacer-50"></div>
                        <div class="text-center">
                            <a href="{{ URL('news') }}" class="btn btn-primary">{{ __('home.more_news') }}</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>











    <!-- OUR PARTNERS -->
    <div class="section">
        <div class="content-wrap">
            <div class="container">
                <div class="row">

                    <div class="col-sm-12 col-md-12">
                        <h2 class="section-heading center">
                            {{ __('home.Our') }} <span>{{ __('home.Partners') }}</span>
                        </h2>
                        <p class="subheading text-center">{{ __('home.partners_descriptions') }}</p>
                    </div>

                </div>
                <div class="row gutter-5">

                    @if (!empty($organizations))
                        @foreach ($organizations as $organization)
                            <div class="col-6 col-md-2">
                                <a href="@if (!empty($organization->site_url)) {{ $organization->site_url }} @else # @endif" @if (!empty($organization->site_url)) target="_blank"
                                    @endif>
                                    <img src="{{ asset('public/upload/logo/' . $organization->logo) }}" alt=""
                                        class="img-fluid img-border">
                                </a>
                            </div>
                        @endforeach
                    @endif



                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/Alkamri.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}
                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/Bahrain.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}
                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/DJIBOUTI.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}
                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/Egypt.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}

                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/IRAQI.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}
                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/JORDAN.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}
                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/kuwait.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}
                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/Libanaise.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}
                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/LIBYAN.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}

                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/Morocain.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}
                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/Palestn.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}
                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/Qatar.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}
                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/saudi.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}
                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/Somalia.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}

                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/Syrian.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}
                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/TUNISA.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}
                    {{-- <div class="col-6 col-md-2"> --}}
                    {{-- <a href="#"><img src="{{ asset("public/images/partners/Yemen.png") }}" alt="" class="img-fluid img-border"></a> --}}
                    {{-- </div> --}}

                </div>
            </div>
        </div>
    </div>


    <!-- FOOTER SECTION -->
    @include('Website.Layout.footer')
    <!-- FOOTER END -->

    <!-- JS VENDOR -->
    @include('Website.Layout.Javascripts')
    <!-- JS VENDOR -->

</body>
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("Jun 23, 2021 15:37:25").getTime();
    
    // Update the count down every 1 second
    var x = setInterval(function() {
    
      // Get today's date and time
      var now = new Date().getTime();
        
      // Find the distance between now and the count down date
      var distance = countDownDate - now;
        
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="demo"
      document.getElementById("demo").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";
        
      // If the count down is over, write some text 
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("demo").innerHTML = "EXPIRED";
      }
    }, 1000);
    </script>

</html>
