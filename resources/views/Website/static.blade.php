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
<div class="section banner-page" data-background="{{ asset('public/images/pages/'.$page->page_image) }}">
    <div class="content-wrap pos-relative">
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <div class="title-page">@if(LaravelLocalization::getCurrentLocale() === 'ar') {{ $page->title_ar }} @else {{ $page->title_en }} @endif</div>
        </div>
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="{{ URL('/') }}">{{__('navbar.home')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@if(LaravelLocalization::getCurrentLocale() === 'ar') {{ $page->title_ar }} @else {{ $page->title_en }} @endif </li>
                </ol>
            </nav>
        </div>
    </div>
</div>





<!-- HOW TO HELP US -->
<div class="section">
    <div class="content-wrap">
        <div class="container">

            <div class="row" @if(LaravelLocalization::getCurrentLocale() === 'ar') style="text-align: right;" @endif>

                <h2 class="section-heading">

                        <span>{{ $page->heading }}</span>

                </h2>



                <div class="col-sm-12 col-md-12">
                   <p>{!!  $page->content !!}</p>
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
