<div class="main-header-two">

    <!-- Header Start -->
    <header class="header header-two">
        <div class="container">

            <nav class="navbar navbar-expand-lg header-nav">
                <div class="navbar-header">
                    <a href="{{ route('home') }}" class="navbar-brand logo">
                        <img src="{{ asset('assets/img/logo.svg') }}" class="img-fluid" alt="Logo">
                    </a>
                    <a href="{{ route('home') }}" class="navbar-brand logo-dark">
                        <img src="{{ asset('assets/img/logo-white.svg') }}" class="img-fluid" alt="Logo">
                    </a>
                    <a id="mobile_btn" href="javascript:void(0);">
                        <i class="material-icons-outlined">menu</i>
                    </a>
                </div>

                <div class="main-menu-wrapper">

                    <div class="menu-header">
                        <a href="{{ route('home') }}" class="menu-logo">
                            <img src="{{ asset('assets/img/logo.svg') }}" class="img-fluid" alt="Logo">
                        </a>
                        <a href="{{ route('home') }}" class="menu-logo menu-logo-dark">
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
                        <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                            <a href="{{ route('home') }}">Home</a>
                        </li>

                        <li class="{{ request()->routeIs('listing.*') ? 'active' : '' }} has-submenu">
                            <a href="javascript:void(0);">
                                Listing
                                <i  class="material-icons-outlined">expand_more</i>
                            </a>
                            <ul class="submenu">
{{--                                <li>--}}
{{--                                    <a href="javascript:void(0);">Buy Property</a>--}}
{{--                                </li>--}}

                                <li class="{{ request()->routeIs('listing.*') ? 'active' : '' }}">
                                    <a href="{{ route('listing.rent') }}">Rent Property</a>
                                </li>
                            </ul>
                        </li>


                        <li class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">
                            <a href="{{ route('blog.index') }}">Blog</a>
                        </li>

                        <li class="{{ request()->routeIs('pricing') ? 'active' : '' }}">
                            <a href="{{ route('pricing') }}">Pricing</a>
                        </li>



{{--                        <li class="has-submenu">--}}
{{--                            <a href="javascript:void(0);">Agent <i class="material-icons-outlined">expand_more</i></a>--}}
{{--                            <ul class="submenu">--}}
{{--                                <li><a href="agent-grid.html">Agent Grid</a></li>--}}
{{--                                <li><a href="agent-list.html">Agent List</a></li>--}}
{{--                                <li><a href="agent-grid-sidebar.html">Agent Grid with Sidebar</a></li>--}}
{{--                                <li><a href="agent-list-sidebar.html">Agent List with Sidebar</a></li>--}}
{{--                                <li><a href="agent-details.html">Agent Details</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        --}}
{{--                        <li class="has-submenu">--}}
{{--                            <a href="javascript:void(0);">Agency <i class="material-icons-outlined">expand_more</i></a>--}}
{{--                            <ul class="submenu">--}}
{{--                                <li><a href="agency-grid.html">Agency Grid</a></li>--}}
{{--                                <li><a href="agency-list.html">Agency List</a></li>--}}
{{--                                <li><a href="agency-grid-sidebar.html">Agency Grid with Sidebar</a></li>--}}
{{--                                <li><a href="agency-list-sidebar.html">Agency List with Sidebar</a></li>--}}
{{--                                <li><a href="agency-details.html">Agency Details</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        --}}
{{--                        <li class="has-submenu">--}}
{{--                            <a href="javascript:void(0);">Pages <i class="material-icons-outlined">expand_more</i></a>--}}
{{--                            <ul class="submenu">--}}
{{--                                <li><a href="about-us.html">About Us</a></li>--}}
{{--                                <li class="has-submenu">--}}
{{--                                    <a href="javascript:void(0);">Authentication</a>--}}
{{--                                    <ul class="submenu">--}}
{{--                                        <li><a href="signup.html">Sign Up</a></li>--}}
{{--                                        <li><a href="signin.html">Sign In</a></li>--}}
{{--                                        <li><a href="forgot-password.html">Forgot Password</a></li>--}}
{{--                                        <li><a href="reset-password.html">Reset Password</a></li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <li><a href="invoice-details.html">Invoice Details</a></li>--}}
{{--                                <li><a href="wishlist.html">Wishlist</a></li>--}}
{{--                                <li><a href="contact-us.html">Contact Us</a></li>--}}
{{--                                <li class="has-submenu">--}}
{{--                                    <a href="javascript:void(0);">Error Page</a>--}}
{{--                                    <ul class="submenu">--}}
{{--                                        <li><a href="error-404.html">Error 404</a></li>--}}
{{--                                        <li><a href="error-500.html">Error 500</a></li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <li><a href="pricing.html">Pricing</a></li>--}}
{{--                                <li><a href="faq.html">FAQ</a></li>--}}
{{--                                <li><a href="gallery.html">Gallery</a></li>--}}
{{--                                <li><a href="our-team.html">Our Team</a></li>--}}
{{--                                <li><a href="testimonial.html">Testimonials</a></li>--}}
{{--                                <li><a href="terms-condition.html">Terms & Conditions</a></li>--}}
{{--                                <li><a href="privacy-policy.html">Privacy Policy</a></li>--}}
{{--                                <li><a href="maintenance.html">Maintenance</a></li>--}}
{{--                                <li><a href="coming-soon.html">Coming Soon</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
{{--                        --}}
{{--                        <li class="has-submenu">--}}
{{--                            <a href="javascript:void(0);">Blog <i class="material-icons-outlined">expand_more</i></a>--}}
{{--                            <ul class="submenu">--}}
{{--                                <li><a href="blog-list.html">Blog List</a></li>--}}
{{--                                <li><a href="blog-grid.html">Blog Grid</a></li>--}}
{{--                                <li><a href="blog-details.html">Blog Details</a></li>--}}
{{--                            </ul>--}}
{{--                        </li>--}}
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
