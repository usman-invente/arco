<!DOCTYPE html>
<html lang="en">


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
            <div class="title-page">{{__('dashboard/lang.LOG IN') }} </div>
        </div>
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="{{ URL('/') }}"> {{__('dashboard/lang.Home') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> {{__('dashboard/lang.LOG IN') }} </li>
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

                <div class="col-sm-6 col-md-6">

                    <div class="img-date">

                        <img src="images/dummy-img-600x400.jpg" alt="" class="img-fluid" style="height: 500px;">
                    </div>



                </div>

                <div class="col-sm-6 col-md-6" >
                    <div class="card promo-ads">
                        <h2 class="form-title" style="color: #1d2124;"><img src="{{asset('public/images/apple-touch-icon.png')}}"> Login To ARCO</h2>
                        <div class="card-body content font__color-black" >
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group" >
                                    <label for="email" class="col-form-label text-md-right" style="color: black;">{{__('dashboard/lang.Email') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="border-color: #636b6f;">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-form-label text-md-right" style="color: black;">{{__('dashboard/lang.Password') }}</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="border-color: #636b6f;">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                   <span class="fa fa-sign-in " style="font-size: 25px;"> <u> <a href="{{ URL('/register') }}"  style="font-size: 14px;">{{__('dashboard/lang.for Sign-Up Click here') }}</a> </u> 
                                  
                                   </span> 
                                     <a   href="{{ route('forgetform') }}"  style="font-size: 14px;float:right">{{__('dashboard/lang.forgot password') }}?</a>
                                </div>

                              

                                <div class="form-group">
                                    <div id="success"></div>

                                    <button type="submit" class="btn btn-primary  t">
                                        {{ __('Login') }}
                                    </button>

                                </div>
                            </form>
                        </div>
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
