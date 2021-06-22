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
<div class="section banner-page" data-background="{{ asset('public/images/pages/'.$organization_page->page_image) }}">
    <div class="content-wrap pos-relative">
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <div class="title-page">{{__('navbar.our_national_societies')}}</div>
        </div>
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="{{ URL('/') }}">{{__('navbar.home')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('navbar.our_national_societies')}} </li>
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
                <div class="col-sm-3 col-md-3">

                    <div class="widget widget-text">
                        <div class="widget-title">
                           Organizations
                        </div>
                        <ul>
                            @if(!empty($organizations))
                                @foreach($organizations as $society)
                                    <a href="{{ URL('nationalSocieties/'.$society->id) }}">
                                        <li>
                                            @if(LaravelLocalization::getCurrentLocale() === 'ar')
                                                 @if(  $society->id == $id)
                                                    <u style="color: #dc3545;"> <p style="color: #dc3545;"> {{ $society->name_ar }} </p></u>
                                                @else
                                                    {{ $society->name_ar }}
                                                @endif
                                            @else
                                                @if(  $society->id == $id)
                                                    <u style="color: #dc3545;"> <p style="color: #dc3545;"> {{ $society->name_en }} </p></u>
                                                @else
                                                    {{ $society->name_en }}
                                                @endif
                                            @endif
                                        </li>
                                    </a>
                                @endforeach
                            @endif
                        </ul>
                    </div>


                </div>
                <div class="col-sm-9 col-md-9">
                    <div class="single-news">
                        <div class="image">
                            <a href="@if(!empty($organization->site_url)){{ $organization->site_url }} @else # @endif"  @if(!empty($organization->site_url)) target="_blank" @endif>
                                <img src="{{ asset('public/images/organizations/banner/'.$organization->banner) }}" alt="" class="img-fluid">
                            </a>
                        </div>
                        <h2 class="blok-title">
                            @if(LaravelLocalization::getCurrentLocale() === 'ar')
                                {{ $organization->name_ar }}
                            @else
                                {{ $organization->name_en }}
                            @endif
                        </h2>
{{--                        <div class="meta">--}}
{{--                            <div class="meta-date"><i class="fa fa-clock-o"></i> April 25, 2017</div>--}}
{{--                            <div class="meta-author"> Posted by: <a href="#">Rome Doel</a></div>--}}
{{--                            <div class="meta-category"> Category: <a href="#">Industry</a>, <a href="#">Machine</a></div>--}}
{{--                            <div class="meta-comment"><i class="fa fa-comment-o"></i> 2 Comments</div>--}}
{{--                        </div>--}}
                        <p>
                            {!! $organization->details !!}
                        </p>

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
