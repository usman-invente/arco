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





<!-- CONTENT -->
<div class="section">
    <div class="content-wrap">
        <div class="container">
            <div class="row">
{{--                <div class="col-sm-3 col-md-3">--}}
{{--                    <div class="widget text">--}}
{{--                        <div class="widget-title">--}}
{{--                            Helping Organizations--}}
{{--                        </div>--}}
{{--                        <ul>--}}
{{--                            <u><li> Arab Red Cresent And Red Cross</li></u>--}}
{{--                            <u><li> Arab Red Cresent Eygpt</li></u>--}}
{{--                            <u><li> Arab Red Cresent Emirates</li></u>--}}
{{--                            <u><li> Arab Red Cresent Libanese</li></u>--}}

{{--                        </ul>--}}
{{--                    </div>--}}



{{--                </div>--}}
                @if(!empty($news))

                    <div class="col-sm-12 col-md-12">
                        <div class="row">
                            @foreach($news as $new)
                                <div class="col-sm-6 col-md-4">
                                    <!-- BOX 1 -->
                                    <div class="box-news-1">
                                        <div class="media gbr">
                                            <a href="{{ URL('details/'.$new->id)  }}" title=""> <img src="{{ asset('public/upload/news/'.$new->image) }}" alt="" class="img-fluid"></a>
                                        </div>
                                        <div class="body">
                                            <div class="title"><a href="{{ URL('details/'.$new->id)  }}" title=""> {!!  $new->description !!} </a></div>
                                            <div class="meta">
                                                <span class="date"><i class="fa fa-clock-o"></i> {{ $new->created_at }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12">

                                <nav aria-label="Page navigation">
                                    {{ $news->links() }}
                                </nav>

                            </div>
                        </div>

                    </div>
                @endif

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
