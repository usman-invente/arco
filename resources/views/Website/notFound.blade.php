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





<!-- HOW TO HELP US -->
<div class="section">
    <div class="content-wrap">
        <div class="container">

            <div class="row">
                <img src="{{ asset('public/images/404.png') }}">
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
