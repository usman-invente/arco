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
<div class="section banner-page" data-background="{{ asset('public/images/pages/'.$news_page->page_image) }}">
    <div class="content-wrap pos-relative">
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <div class="title-page">@if(LaravelLocalization::getCurrentLocale() === 'ar') {{ $news_page->title_ar }} @else {{ $news_page->title_en }} @endif</div>
        </div>
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="{{ URL('/') }}">{{__('navbar.home')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@if(LaravelLocalization::getCurrentLocale() === 'ar') {{ $news_page->title_ar }} @else {{ $news_page->title_en }} @endif </li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- HOW TO HELP US -->
<div class="section">
    <div class="content-wrap">
        <div class="container">

            <!--<div class="row">-->
            <!--    <div class="col-sm-12 col-md-12">-->
            <!--        @if(!empty($news))-->
            <!--            <img src="{{ asset('public/upload/news/'.$news->image) }}" alt="" class="img-fluid">-->
            <!--        @endif-->
            <!--    </div>-->
            <!--</div>-->

            <div class="spacer-90"></div>

            <div class="row" @if(LaravelLocalization::getCurrentLocale() === 'ar') style="text-align: right;" @endif>

                <h2 class="section-heading">
                    <img src="{{ asset('public/upload/news/'.$news->image) }}">

                    @if(LaravelLocalization::getCurrentLocale() === 'ar')
                        <span>{{ $news->name_ar }}</span>
                    @else
                        <span>{{ $news->name_en }}</span>
                    @endif
                </h2>

                <div class="col-sm-12 col-md-12">

                    <h2 class="color-secondary"><span class="color-primary">{!!  $news->description !!}</span> </h2>
                    @if(LaravelLocalization::getCurrentLocale() === 'ar')
                        <p class="subheading color-secondary pull-right">({{ $news->created_at }})</p>
                    @else
                        <p class="subheading color-secondary pull-left">({{ $news->created_at }})</p>
                    @endif

                </div>

                <div class="col-sm-12 col-md-12">
                   <p>{!!  $news->content !!} </p>
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

</body>
</html>
