<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Dreams Estate is a powerful real estate template for property listings, rentals, and agency dashboards. Built with HTML, React, Vue, Angular, and Laravel. Ideal for property portals and real estate platforms.">
    <meta name="keywords" content="real estate template, property management, real estate dashboard, property listings, rental template, agency admin, HTML real estate, React real estate, Vue dashboard, Angular real estate, Laravel property UI">
    <title>{{ $title ?? 'Page Title' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Dreams Technologies">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">

    <!-- Apple Icon -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-icon.png') }}">

    <!-- Theme Settings Js -->
    <script src="{{ asset('assets/js/theme-script.js') }}"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Material Icon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/material-icon/material-icon.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Aos CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">

    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick-theme.css') }}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/swiper/swiper-bundle.min.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @livewireStyles
</head>

<body>

<!-- Main Wrapper -->
<div class="main-wrapper">
    <div class="main-header-two">

        <!-- Header Start -->
        <header class="header header-two">
            <div class="container">

                <nav class="navbar navbar-expand-lg header-nav">
                    <div class="navbar-header">
                        <a href="index-2.html" class="navbar-brand logo">
                            <img src="{{ asset('assets/img/logo.svg') }}" class="img-fluid" alt="Logo">
                        </a>
                        <a href="index-2.html" class="navbar-brand logo-dark">
                            <img src="{{ asset('assets/img/logo-white.svg') }}" class="img-fluid" alt="Logo">
                        </a>
                        <a id="mobile_btn" href="javascript:void(0);">
                            <i class="material-icons-outlined">menu</i>
                        </a>
                    </div>

                    <div class="main-menu-wrapper">

                        <div class="menu-header">
                            <a href="index-2.html" class="menu-logo">
                                <img src="{{ asset('assets/img/logo.svg') }}" class="img-fluid" alt="Logo">
                            </a>
                            <a href="index-2.html" class="menu-logo menu-logo-dark">
                                <img src="{{ asset('assets/img/logo-white.svg') }}" class="img-fluid" alt="Logo">
                            </a>
                            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                                <i class="material-icons-outlined">close</i>
                            </a>
                        </div>
                        <div class="mobile-search">
                            <input type="text" class="form-control form-control-lg" placeholder="Search">
                        </div>

                        <ul class="main-nav">
                            <li class="has-submenu megamenu active">
                                <a href="#">Home <i  class="material-icons-outlined">expand_more</i></a>
                                <ul class="submenu mega-submenu">
                                    <li>
                                        <div class="megamenu-wrapper">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <div class="single-demo">
                                                        <div class="demo-img">
                                                            <a href="index-2.html" class="inner-demo-img"><img src="{{ asset('}assets/img/home/home-01.jpg') }}" class="img-fluid " alt="img"></a>
                                                        </div>
                                                        <div class="demo-info">
                                                            <a href="index-2.html" class="inner-demo-img">Home 1</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="single-demo active">
                                                        <div class="demo-img">
                                                            <a href="index-3.html" class="inner-demo-img"><img src="{{ asset('}assets/img/home/home-02.jpg') }}" class="img-fluid " alt="img"></a>
                                                        </div>
                                                        <div class="demo-info">
                                                            <a href="index-3.html" class="inner-demo-img">Home 2</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="single-demo">
                                                        <div class="demo-img">
                                                            <a href="index-4.html" class="inner-demo-img"><img src="{{ asset('}assets/img/home/home-03.jpg') }}" class="img-fluid " alt="img"></a>
                                                        </div>
                                                        <div class="demo-info">
                                                            <a href="index-4.html" class="inner-demo-img">Home 3</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="single-demo">
                                                        <div class="demo-img">
                                                            <a href="javascript:void(0);" class="inner-demo-img"><img src="{{ asset('}assets/img/home/coming-soon.jpg') }}" class="img-fluid " alt="img"></a>
                                                        </div>
                                                        <div class="demo-info">
                                                            <a href="javascript:void(0);" class="inner-demo-img">Coming Soon</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Listing <i  class="material-icons-outlined">expand_more</i></a>
                                <ul class="submenu">
                                    <li class="has-submenu">
                                        <a href="javascript:void(0);">Buy Property</a>
                                        <ul class="submenu">
                                            <li><a href="buy-property-grid.html">Buy Grid</a></li>
                                            <li><a href="buy-property-list.html">Buy List</a></li>
                                            <li><a href="buy-property-grid-sidebar.html">Buy Grid with Sidebar</a></li>
                                            <li><a href="buy-property-list-sidebar.html">Buy List with Sidebar</a></li>
                                            <li><a href="buy-grid-map.html">Buy Grid with map</a></li>
                                            <li><a href="buy-list-map.html">Buy List with map</a></li>
                                            <li><a href="buy-details.html">Buy Details</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-submenu">
                                        <a href="javascript:void(0);">Rent Property</a>
                                        <ul class="submenu">
                                            <li><a href="rent-property-grid.html">Rent Grid</a></li>
                                            <li><a href="rent-property-list.html">Rent List</a></li>
                                            <li><a href="rent-property-grid-sidebar.html">Rent Grid with Sidebar</a></li>
                                            <li><a href="rent-property-list-sidebar.html">Rent List with Sidebar</a></li>
                                            <li><a href="rent-grid-map.html">Rent Grid with map</a></li>
                                            <li><a href="rent-list-map.html">Rent List with map</a></li>
                                            <li><a href="rent-details.html">Rent Details</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Agent <i class="material-icons-outlined">expand_more</i></a>
                                <ul class="submenu">
                                    <li><a href="agent-grid.html">Agent Grid</a></li>
                                    <li><a href="agent-list.html">Agent List</a></li>
                                    <li><a href="agent-grid-sidebar.html">Agent Grid with Sidebar</a></li>
                                    <li><a href="agent-list-sidebar.html">Agent List with Sidebar</a></li>
                                    <li><a href="agent-details.html">Agent Details</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Agency <i class="material-icons-outlined">expand_more</i></a>
                                <ul class="submenu">
                                    <li><a href="agency-grid.html">Agency Grid</a></li>
                                    <li><a href="agency-list.html">Agency List</a></li>
                                    <li><a href="agency-grid-sidebar.html">Agency Grid with Sidebar</a></li>
                                    <li><a href="agency-list-sidebar.html">Agency List with Sidebar</a></li>
                                    <li><a href="agency-details.html">Agency Details</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Pages <i class="material-icons-outlined">expand_more</i></a>
                                <ul class="submenu">
                                    <li><a href="about-us.html">About Us</a></li>
                                    <li class="has-submenu">
                                        <a href="javascript:void(0);">Authentication</a>
                                        <ul class="submenu">
                                            <li><a href="signup.html">Sign Up</a></li>
                                            <li><a href="signin.html">Sign In</a></li>
                                            <li><a href="forgot-password.html">Forgot Password</a></li>
                                            <li><a href="reset-password.html">Reset Password</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="invoice-details.html">Invoice Details</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="contact-us.html">Contact Us</a></li>
                                    <li class="has-submenu">
                                        <a href="javascript:void(0);">Error Page</a>
                                        <ul class="submenu">
                                            <li><a href="error-404.html">Error 404</a></li>
                                            <li><a href="error-500.html">Error 500</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="pricing.html">Pricing</a></li>
                                    <li><a href="faq.html">FAQ</a></li>
                                    <li><a href="gallery.html">Gallery</a></li>
                                    <li><a href="our-team.html">Our Team</a></li>
                                    <li><a href="testimonial.html">Testimonials</a></li>
                                    <li><a href="terms-condition.html">Terms & Conditions</a></li>
                                    <li><a href="privacy-policy.html">Privacy Policy</a></li>
                                    <li><a href="maintenance.html">Maintenance</a></li>
                                    <li><a href="coming-soon.html">Coming Soon</a></li>
                                </ul>
                            </li>
                            <li class="has-submenu">
                                <a href="javascript:void(0);">Blog <i class="material-icons-outlined">expand_more</i></a>
                                <ul class="submenu">
                                    <li><a href="blog-list.html">Blog List</a></li>
                                    <li><a href="blog-grid.html">Blog Grid</a></li>
                                    <li><a href="blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                        </ul>

                        <div class="menu-dropdown">
                            <div class="dropdown mb-2">
                                <a href="#" class="dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                                    <img src="{{ asset('assets/img/flags/us.svg') }}" alt="Language" class="me-1" height="16">English
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                                        <img src="{{ asset('assets/img/flags/us.svg') }}" alt="" class="me-2" height="16"> <span class="align-middle">English</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                                        <img src="{{ asset('assets/img/flags/de.svg') }}" alt="" class="me-2" height="16"> <span class="align-middle">German</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                                        <img src="{{ asset('assets/img/flags/fr.svg') }}" alt="" class="me-2" height="16"> <span class="align-middle">French</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                                        <img src="{{ asset('assets/img/flags/ae.svg') }}" alt="" class="me-2" height="16"> <span class="align-middle">Arabic</span>
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    Light
                                </a>
                                <ul class="dropdown-menu mt-2">
                                    <li><a class="dropdown-item light-mode" href="javascript:void(0);">Light</a></li>
                                    <li><a class="dropdown-item dark-mode" href="javascript:void(0);">Dark</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="menu-login">
                            <a href="signin.html" class="btn btn-primary w-100 mb-2">Sign In</a>
                            <a href="signup.html" class="btn btn-secondary w-100">Register</a>
                        </div>

                    </div>

                    <div class="nav header-items">

                        <a href="#" class="topbar-link btn btn-light topbar-search" data-bs-toggle="modal" data-bs-target="#search-modal">
                            <i class="material-icons-outlined">search</i>
                        </a>

                        <div class="dropdown topbar-lang">
                            <a href="#" class="topbar-link btn btn-light" data-bs-toggle="dropdown">
                                <img src="{{ asset('assets/img/flags/us.svg') }}" alt="Language" height="16">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                                    <img src="{{ asset('assets/img/flags/us.svg') }}" alt="" class="me-2" height="16"> <span class="align-middle">English</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                                    <img src="{{ asset('assets/img/flags/de.svg') }}" alt="" class="me-2" height="16"> <span class="align-middle">German</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                                    <img src="{{ asset('assets/img/flags/fr.svg') }}" alt="" class="me-2" height="16"> <span class="align-middle">French</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">
                                    <img src="{{ asset('assets/img/flags/ae.svg') }}" alt="" class="me-2" height="16"> <span class="align-middle">Arabic</span>
                                </a>
                            </div>
                        </div>

                        <div class="dropdown">
                            <a href="javascript:void(0);" class="topbar-link btn btn-light" data-bs-toggle="dropdown">
                                <i class="material-icons-outlined">wb_sunny</i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" id="light-mode-toggle">
                                    <i class="material-icons-outlined me-2">wb_sunny</i> <span class="align-middle">Light Mode</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item d-flex align-items-center" id="dark-mode-toggle">
                                    <i class="material-icons-outlined me-2">dark_mode</i> <span class="align-middle">Dark Mode</span>
                                </a>
                            </div>
                        </div>

                        <a href="signin.html" class="btn btn-lg btn-primary d-inline-flex align-items-center"><i class="material-icons-outlined me-1">lock</i>Sign In</a>

                        <a href="signup.html" class="btn btn-lg btn-dark d-inline-flex align-items-center"><i class="material-icons-outlined me-1">perm_identity</i>Register</a>

                    </div>
                </nav>

            </div>
        </header>
        <!-- Header End -->

    </div>


    {{ $slot }}
</div>

<!-- jQuery -->
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

<!-- Bootstrap Core JS -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Select2 JS -->
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

<!-- Aos JS -->
<script src="{{ asset('assets/js/aos.js') }}"></script>

<!-- Slick Slider -->
<script src="{{ asset('assets/plugins/slick/slick.js') }}"></script>

<!-- Swiper JS -->
<script src="{{ asset('assets/plugins/swiper/swiper-bundle.min.js') }}"></script>

<!-- Counter JS -->
<script src="{{ asset('assets/js/waypoints.js') }}"></script>
<script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/script.js') }}"></script>

<script src="{{ asset('assets/js/rocket-loader.min.js') }}" defer></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"></script>

@livewireScripts
</body>
</html>
