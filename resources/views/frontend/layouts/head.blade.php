<!-- Meta Tag -->
@yield('meta')
<!-- Title Tag  -->
<title>@yield('title')</title>
<!-- Favicon -->
<link rel="icon" type="image/png" href="images/favicon.png">
<!-- Web Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- StyleSheet -->
<link rel="manifest" href="/manifest.json">
<!-- Bootstrap -->
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">
<!-- Magnific Popup -->
<link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.css')}}">
<!-- Fancybox -->
<link rel="stylesheet" href="{{asset('frontend/css/jquery.fancybox.min.css')}}">
<!-- Themify Icons -->
<link rel="stylesheet" href="{{asset('frontend/css/themify-icons.css')}}">
<!-- Nice Select CSS -->
<link rel="stylesheet" href="{{asset('frontend/css/niceselect.css')}}">
<!-- Animate CSS -->
<link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
<!-- Flex Slider CSS -->
<link rel="stylesheet" href="{{asset('frontend/css/flex-slider.min.css')}}">
<!-- Owl Carousel -->
<link rel="stylesheet" href="{{asset('frontend/css/owl-carousel.css')}}">
<!-- Slicknav -->
<link rel="stylesheet" href="{{asset('frontend/css/slicknav.min.css')}}">
<!-- Jquery Ui -->
<link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.css')}}">

<!-- Bootstrap 5 CSS -->
{{--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">--}}

<!-- Bootstrap 5 JS and Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- FontAwesome (for your menu icon) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">



<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!-- HEAD SECTION -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">


<!-- jQuery & Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script> -->

<!-- Font Awesome v5 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />


<!-- Add this in your <head> section -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-FtD74C3mvlZez0QGDBXv2m0l3V8BZc+1Z3rVbqz1qg8cRb1rJwvZKX0ZJSuA4xzYZp4Ym1J5RJe+uYoKmc1sUQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />



<!-- Eshop StyleSheet -->
<link rel="stylesheet" href="{{asset('frontend/css/reset.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
<style>
    /* Multilevel dropdown */
    .dropdown-submenu {
    position: relative;
    }

    .dropdown-submenu>a:after {
    content: "\f0da";
    float: right;
    border: none;
    font-family: 'FontAwesome';
    }

    .dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: 0px;
    margin-left: 0px;
    }

    /*
</style>
@stack('styles')
