<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Safe Aqua Tech | Water Purifier, Commercial Water Plant, Water Softener Dealers, Suppliers in Trichy | Water
        purification company in Tiruchirappalli, Tamil Nadu
    </title>

    <!-- Meta Data -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Zwork Technology">
    <meta name="description"
        content="Shop now to find the best water purifier for your needs and experience pure, safe, and great-tasting water every day!">
    <meta name="keywords"
        content="water softener, water softener for water tank, home water softener, water softener for house, water softener installation near me, water purifier for home, smart water purifier, house water purification system, how to choose water purifier for home, soft water conditioner, water conditioner for home, ro water plant, ro plant, reverse osmosis plant, water plant company near me, water purifier, water purifier machine, tap water purifier, near water purifier shop, RO installation near me, reverse osmosis filter for home, ro filter for home, water filter for hard water, water filter for home, iron removal filter, home filter system, drinking water filter near me, best water purifiers for home, uv water purifiers, water purifiers">
    <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favlogo.webp') }}" />
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.safeaquatech.com/">
    <meta property="og:title" content="Your Health Matters: Prioritizing Wellness with Our Water Purifiers.">
    <meta property="og:description"
        content="Shop now to find the best water purifier for your needs and experience pure, safe, and great-tasting water every day!">
    <meta property="og:image" content="https://www.safeaquatech.com/assets/frontend/images/banner/banner2.webp">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/fontawesome.min.css') }}" />
    <!-- Themify Icon -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/themify-icons.css') }}" />
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/owl.carousel.min.css') }}" />
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/nice-select.css') }}" />
    <!-- FancyBox-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/jquery.fancybox.min.css') }}" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min.css') }}" />
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/responsive.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <script src='https://www.google.com/recaptcha/api.js'></script>

     @turnstileScripts()
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })
        (window, document, 'script', 'dataLayer', 'GTM-PKG884Q7');

    </script>
    <!-- End Google Tag Manager -->

</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PKG884Q7" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Preloader -->
    {{-- <div id="preloader">
        <div id="status">
            <img src="{{ asset('assets/frontend/images/favlogo.webp') }}" alt="perloader" />
        </div>
    </div> --}}

    <!-- Header Start -->
    <header class="header">
        <div class="header-top">
            <div class="container-fluid">
                <div class="head-menu d-flex justify-content-center">
                    <div class="head-content">
                        <i class="fas fa-phone"></i>
                        <a href="tel:+919344330043">+91 93443 30043</a>
                    </div>
                    <div class="head-content">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:info@safeaquatech.com">info@safeaquatech.com</a>
                    </div>
                    <div class="head-content">
                        <i class="fas fa-map-marker-alt"></i>
                        <a href="#">Mannarpuram, Tiruchirapalli, Tamil Nadu</a>
                    </div>
                    <div class="head-social-icon ml-auto">
                        <a href="https://www.facebook.com/safeaquatech.tpj" target="_blank"> <i
                                class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/safeaquatech.tpj" target="_blank"><i
                                class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/@safeaquatech_tpj" target="_blank"><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!--Navbar -->
        <nav class="navbar navbar-expand-lg top-menu">
            <div class="container-fluid">
                <div class="logo">
                    <a href="{{ route('index') }}"><img src="{{ asset('assets/frontend/images/logo.webp') }}"
                            alt="logo" style="width: 200px;" /></a>
                </div>
                <div class="collapse main-nav navbar-collapse" id="navbarSupportedContent-333">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('index') ? 'active' : '' }}"
                                href="{{ route('index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('about') ? 'active' : '' }}"
                                href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('service') ? 'active' : '' }}"
                                href="{{ route('service') }}">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('product') ? 'active' : '' }}"
                                href="{{ route('product') }}">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('blog') ? 'active' : '' }}"
                                href="{{ route('blog') }}">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('contact') ? 'active' : '' }}"
                                href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="header-btn">
                    <a href="https://api.whatsapp.com/send/?phone=%2B919344330043" target="_blank" class="button">Chat
                        On WhatsApp</a>
                </div>
                <div class="mobile-btn bttn">
                    <a href="#"><i class="fas fa-envelope-open-text"></i></a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="ti-menu"></i></span>
                </button>
            </div>
        </nav>
    </header>
    <!-- Header End-->
