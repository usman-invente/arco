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
<div class="section banner-page" data-background="{{ asset('public/images/pages/'.$opportunities_page->page_image) }}">
    <div class="content-wrap pos-relative">
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <div class="title-page">{{__('navbar.volunteer_opportunities')}}</div>
        </div>
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="{{ URL('/') }}">{{__('navbar.home')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('navbar.volunteer_opportunities')}}</li>
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
{{--                <div class="col-sm-6 col-md-4">--}}
{{--                    <!-- BOX 1 -->--}}
{{--                    <div class="card box-fundraising">--}}

{{--                        <div class="body-content">--}}
{{--                            <div class="media">--}}
{{--                                <img src="{{ asset("public/images/opportunities/opportunity_saudi.png") }}" alt="">--}}
{{--                            </div>--}}
{{--                            <br>--}}
{{--                            <p class="title"><a href="#"><u>EDUCATION FOR SYRIAN CHILD</u></a></p>--}}
{{--                            <div class="text" style="color: #1b1e21; font-weight: bold;">Relief Camp For Refugees</div>--}}
{{--                            <br>--}}
{{--                            <div class="meta">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="card col-md-6">--}}
{{--                                        <h5 style="font-weight: bold; color: blue;"> Starting AT </h5>--}}
{{--                                        <span class=" date"><i class="fa fa-clock-o"></i> May 7, 2017</span>--}}
{{--                                    </div>--}}
{{--                                    <div class="card col-md-6">--}}
{{--                                        <h5 style="font-weight: bold; color: blue;"> Ending AT </h5>--}}
{{--                                        <span class=" date"><i class="fa fa-clock-o"></i> May 7, 2017</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="meta">--}}
{{--                                <div class="row">--}}
{{--                                    <div class=" col-md-6" style="background-color: rgba(57,255,20,0.8); padding-top: 0px; padding-bottom: 0px;">--}}
{{--                                        <h5 style="font-weight: bold; color: white; text-align: center;"> Available </h5>--}}
{{--                                    </div>--}}
{{--                                    <div class=" col-md-6" >--}}
{{--                                        <a href="#" class="btn btn-secondary">DONATE NOW</a>--}}
{{--                                        <button class="btn btn-secondary" style=" color: white; text-align: center; font-size: 14px !important;">  Details </button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                @if(!empty($opportunities))
                    @foreach($opportunities as $opportunity)
                        <div class="col-sm-6 col-md-4">
                            <!-- BOX 1 -->
                            <div class="card box-fundraising">

                                <div class="body-content">
                                    <div class="media">
                                        <img src="{{ asset("public/upload/logo/".$opportunity->logo) }}" alt="">
                                    </div>
                                    <br>
                                    <p class="title"><a href="#"><u>{{ $opportunity->name }}</u></a></p>
                                    <div class="text" style="color: #1b1e21; font-weight: bold;">{{ $opportunity->title }}</div>
                                    <div class="text" style="color: #1b1e21; font-weight: bold;">{{ $opportunity->name_en }}</div>
                                     <div class="text" style="color: #1b1e21; font-weight: bold;">{{ $opportunity->city }}</div>
                                    <br>
                                    <div class="meta">
                                        <div class="row">
                                            <div class="card col-md-6">
                                                <h5 style="font-weight: bold; color: blue;">{{__('home.starting_at')}}</h5>
                                                <span class=" date"><i class="fa fa-clock-o"></i>{{ $opportunity->start_date }}</span>
                                            </div>
                                            <div class="card col-md-6">
                                                <h5 style="font-weight: bold; color: blue;"> {{__('home.ending_at')}} </h5>
                                                <span class=" date"><i class="fa fa-clock-o"></i> {{ $opportunity->end_date }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="meta">
                                        <div class="row">
                                            @if($opportunity->status_id == 1)
                                                <div class=" col-md-6" style="background-color: rgba(80,160,47,0.8); padding-top: 0px; padding-bottom: 0px;">
                                                    <h5 style="font-weight: bold; color: white; text-align: center;"> {{__('home.available')}} </h5>
                                                </div>
                                            @else
                                                <div class=" col-md-6" style="background-color: rgb(160,47,47); padding-top: 0px; padding-bottom: 0px;">
                                                    <h5 style="font-weight: bold; color: white; text-align: center;"> {{__('home.not_available')}} </h5>
                                                </div>
                                            @endif
                                            <div class=" col-md-6" >
                                                {{--                                        <a href="#" class="btn btn-secondary">DONATE NOW</a>--}}
                                                <a href="{{ URL('opportunities_details/'.$opportunity->id) }}" class="btn btn-secondary" style=" color: white; text-align: center; font-size: 14px !important;">{{__('home.details')}}   </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


            </div>

            <div class="row">
                <div class="col-sm-12 col-md-12">

                    <nav aria-label="Page navigation">
                        <ul class="pagination">
{{--                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>--}}
{{--                            <li class="page-item active"><a class="page-link" href="#">1</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
{{--                            <li class="page-item"><a class="page-link" href="#">Next</a></li>--}}
                            {{ $opportunities->links() }}
                        </ul>
                    </nav>

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
