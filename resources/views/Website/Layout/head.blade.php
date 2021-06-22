<!DOCTYPE html>
<html class="loading" lang="{{ app()->getLocale() }}" data-textdirection="ltr">
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARCO (Arab red cresent and Red cross Organization)</title>
    <meta name="description" content="ARCO is a clean, modern society, it is designed for charity, non-profit, fundraising, donation, volunteer, businesses or any type of person or business who wants to showcase their work, services and professional way.">
    <meta name="keywords" content="campaign, cause, charity, donate, donations, event, foundation, fund, fundraising, kids, ngo, non-profit, organization, volunteer">
    <meta name="author" content="">

    <!-- ==============================================
    Favicons
    =============================================== -->
    <link rel="shortcut icon" href="{{ asset("public/images/favicon_io/favicon.ico") }}">
    <link rel="apple-touch-icon" href="{{ asset("public/images/favicon_io/apple-touch-icon.png") }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset("public/images/favicon_io/apple-touch-icon.png") }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset("public/images/favicon_io/android-chrome-192x192.png") }}">

    <!-- ==============================================
    CSS VENDOR
    =============================================== -->
    <link rel="stylesheet" type="text/css" href="{{ asset("public/css/vendor/bootstrap.min.css") }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset("public/css/vendor/font-awesome.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("public/css/vendor/owl.carousel.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("public/css/vendor/owl.theme.default.min.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("public/css/vendor/magnific-popup.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("public/css/vendor/animate.min.css") }}">

    <!-- ==============================================
    Custom Stylesheet
    =============================================== -->



    @if(LaravelLocalization::getCurrentLocale() === 'ar')
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/style_RTL.css') }}" />
    @elseif(LaravelLocalization::getCurrentLocale() === 'en')
        <link rel="stylesheet" type="text/css" href="{{ asset('public/css/style.css') }}" />
    @endif



    <script src="{{ asset("public/js/vendor/modernizr.min.js") }}"></script>

</head>
