<!DOCTYPE html>
<html @if(LaravelLocalization::getCurrentLocale() === 'ar') lang="ar" dir="rtl" @elseif(LaravelLocalization::getCurrentLocale() === 'en') lang="en"@endif>



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
<div class="section banner-page" data-background="{{ asset('public/images/pages/1614968002-min.jpg') }}">
    <div class="content-wrap pos-relative">
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <div class="title-page">{{__('navbar.contact_us')}}</div>
        </div>
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="{{ URL('/') }}">{{__('navbar.home')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('navbar.contact_us')}} </li>
                </ol>
            </nav>
        </div>
    </div>
</div>





<!-- HOW TO HELP US -->
<div class="section">
    <div class="content-wrap">
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-md-8">
                    <!-- MAPS -->
                    <!--<div class="maps-wraper">-->
                    <!--    <div id="cd-zoom-in"></div>-->
                    <!--    <div id="cd-zoom-out"></div>-->
                    <!--    <div id="maps" class="maps" data-lat="-7.452278" data-lng="112.708992" data-marker="{{ asset('public/images/cd-icon-location.png') }}">-->
                    <!--    </div>-->
                    <!--</div>-->
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d29004.395622255754!2d46.624943!3d24.673632!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x74b08eb4bcca370a!2z2KfZhNmF2YbYuNmF2Kkg2KfZhNi52LHYqNmK2Kkg2YTZhNmH2YTYp9mEINin2YTYo9it2YXYsSDZiNin2YTYtdmE2YrYqCDYp9mE2KPYrdmF2LE!5e0!3m2!1sar!2ssa!4v1623573926451!5m2!1sar!2ssa" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>

                <div class="col-sm-4 col-md-4">
                    <h2 class="section-heading">
                      {{__('dashboard/lang.Contact Details') }}
                    </h2>

                    <div class="rs-icon-info">
                        <div class="info-icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <div class="info-text">{{ $contact_us->main_address }}</div>
                    </div>

                    <div class="rs-icon-info">
                        <div class="info-icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="info-text">{{ $contact_us->email }}</div>
                    </div>

                    <div class="rs-icon-info">
                        <div class="info-icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="info-text">{{ $contact_us->main_phone }}</div>
                    </div>


                </div>

                <div class="clearfix"></div>

                <div class="col-sm-12 col-md-12">
                    <h2 class="section-heading">
                        {{__('contact_us.send_message')}}
                    </h2>
                    <div class="section-subheading">{{__('contact_us.message_description')}}</div>
                    <div class="margin-bottom-50"></div>

                    <div class="content">
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                            <br>
                        @endif

                        <form action="{{ URL('sendMessage') }}" method="POST" class="form-contact"  data-toggle="validator" novalidate="true">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required="">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea id="message" name="message" class="form-control" rows="6" placeholder="Enter Your Message"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <div id="success"></div>
                                @if(!empty(Auth::user()))
                                    <button type="submit" class="btn btn-primary">{{__('contact_us.sendMessage')}}</button>
                                @else
                                    <strong style="color: #ae1c17; font-weight: bold; font-size: 16px;"> {{__('contact_us.error_message')}}</strong>
                                @endif
                            </div>
                        </form>
                        <div class="margin-bottom-50"></div>
                       </div>
                </div>

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

<script>
    function hello()
    {
        console.log("hello world");
    }

</script>

</body>
</html>
