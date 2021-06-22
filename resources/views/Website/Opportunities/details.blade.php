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
            <div class="title-page">{{ $opportunity->name }} {{__('opportunities.Opportunity')}}</div>
        </div>
        <div class="d-flex justify-content-center bd-highlight mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item"><a href="{{ URL('/') }}">{{__('home.home')}}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{__('opportunities.Opportunity')}}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<!-- HOW TO HELP US -->
<div class="section">
    <div class="content-wrap">
        <div class="container">

            <div class="row"  @if(LaravelLocalization::getCurrentLocale() === 'ar') style="text-align: right;" @endif>
                <div class="col-sm-12 col-md-12">
                    <h2 class="section-heading">
                        <img src="{{ asset('public/upload/logo/'.$opportunity->logo) }}">
                        <br>
                         <span>{{ $opportunity->name }}</span>
                    </h2>

                    <h2 class="color-secondary">{{ $opportunity->title }}</h2>
                </div>

                <div class="col-sm-6 col-md-6">

                    <p class="uk18 color-secondary">{{ $opportunity->description }}</p>


                    <div class="spacer-30"></div>
                    <h3 class="color-secondary">{{__('opportunities.program')}}<span class="color-primary">{{__('opportunities.time_period')}}</span>?</h3>
                    <h5> {{__('opportunities.start_at')}} : {{ $opportunity->start_date }}</h5>
                    <h5> {{__('opportunities.end_at')}} : {{ $opportunity->end_date }}</h5>

                    <h3 class="color-secondary">{{__('opportunities.field_of')}} <span class="color-primary">{{__('opportunities.voluntary')}}</span>?</h3>
                    <h3> {{ $opportunity->field_en }}</h3>
                    <h5> {{__('opportunities.age_rate')}}: {{ $opportunity->type }}</h5>
                    <h5> {{__('opportunities.number_of_Volunteer')}}: {{ $opportunity->no_of_volunteers }}</h5>
                    <h5> {{__('opportunities.number_of_hours')}}: {{ $opportunity->no_of_hours }}</h5>

                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="spacer-30"></div>
                    <div class="spacer-30"></div>
                    <div class="spacer-30"></div>
                    <div class="spacer-30"></div>

                    <h3 class="color-secondary">{{__('opportunities.officer_of')}} <span class="color-primary">{{__('opportunities.volunteer_opportunity')}}</span>{{ $opportunity->title }}</h3>
                    <h3> SAAD KHALID</h3>
                    <h5> {{__('opportunities.email')}} : {{ $opportunity->email }}</h5>
                    <h5> {{__('opportunities.number')}}: {{ $opportunity->contact_number }}</h5>

                    @if(empty(Auth()->user()))
                        <a href="{{ URL('register') }}" class="btn btn-primary">{{__('opportunities.join_us')}}</a>
                    @endif
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
