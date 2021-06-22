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
<div class="section banner-page" data-background="{{ asset('public/images/dummy-img-1920x300.jpg') }}">
    <div class="content-wrap pos-relative">
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <div class="title-page">{{__('dashboard/lang.Forget Password') }}</div>
        </div>
        <!--<div class="d-flex justify-content-center bd-highlight mb-3">-->
        <!--    <nav aria-label="breadcrumb">-->
        <!--        <ol class="breadcrumb ">-->
        <!--            <li class="breadcrumb-item"><a href="{{ URL('/') }}">Home</a></li>-->
        <!--            <li class="breadcrumb-item active" aria-current="page">Login </li>-->
        <!--        </ol>-->
        <!--    </nav>-->
        <!--</div>-->
    </div>
</div>





<!-- HOW TO HELP US -->
<div class="section">
    <div class="content-wrap">
        <div class="container">

            <div class="row">


                <div class="col-sm-12 col-md-12" >
                    <div class="card promo-ads">
                        @if (\Session::has('message'))
                        <div class="alert alert-info">
                           {!! \Session::get('message') !!}
                        </div>
                      @endif
                        @if (\Session::has('emailsent'))
                        <div class="alert alert-info">
                           {!! \Session::get('emailsent') !!}
                        </div>
                      @endif
                        <div class="card-body content font__color-black" >
                            <form method="post" action="{{ route('resetpassword') }}">
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
                                    <div id="success"></div>

                                    <button type="submit" class="btn btn-primary  t">
                                       {{ __('Send Password Reset Link') }}
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
