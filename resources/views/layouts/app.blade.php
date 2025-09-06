<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
{{--    <meta name="description" content="{{ $metaDescription }}">--}}
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
    <link rel="stylesheet" href="{{ asset('assets/plugins/material/materialdesignicons.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <!-- Fancybox CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fancybox/jquery.fancybox.min.css') }}">

    <!-- Range slider CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/ion-rangeslider/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css') }}">

    <!-- Simplebar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/simplebar/simplebar.min.css') }}">

    <!-- Aos CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/aos.css') }}">

    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/slick/slick-theme.css') }}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/swiper/swiper-bundle.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @stack('meta_tags')

    @livewireStyles
</head>

<body>

<!-- Main Wrapper -->
<div class="main-wrapper">
    @include('layouts.partials.header')

    {{ $slot }}

    @include('layouts.partials.footer')

    <!-- Search Modal -->
    <div class="modal fade" id="search-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body search-wrap">
                    <form class="search-form" id="search-form" action="rent-property-grid.html">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h5>What Are You Looking for?</h5>
                            <a href="javascript:void(0);" class="close" data-bs-dismiss="modal"><i class="material-icons-outlined">close</i></a>
                        </div>
                        <div class="input-group input-group-flat">
                            <input type="text" class="form-control" placeholder="Type a Keyword....">
                            <span class="input-group-text">
									<i class="material-icons-outlined">search</i>
								</span>
                        </div>
                        <h6>Popular Properties</h6>
                        <div class="search-list">
                            <p><a href="rent-property-grid.html">Beautiful Condo Room</a></p>
                            <p><a href="rent-property-grid.html">Royal Apartment</a></p>
                            <p><a href="rent-property-grid.html">Grand Villa House</a></p>
                            <p><a href="rent-property-grid.html">Grand Mahaka</a></p>
                            <p><a href="rent-property-grid.html">Lunaria Residence</a></p>
                            <p><a href="rent-property-grid.html">Stephen Alexander Homes</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Search Modal -->
</div>

<!-- jQuery -->
<script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>

<!-- Bootstrap Core JS -->
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Select2 JS -->
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>

<!-- Sticky Sidebar JS -->
<script src="{{ asset('assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
<script src="{{ asset('assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

<!-- Rangeslider JS -->
<script src="{{ asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.js') }}"></script>
<script src="{{ asset('assets/plugins/ion-rangeslider/js/custom-rangeslider.js') }}"></script>
<script src="{{ asset('assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>

<!-- Simplebar JS -->
<script src="{{ asset('assets/plugins/simplebar/simplebar.min.js') }}"></script>

<!-- Aos JS -->
<script src="{{ asset('assets/js/aos.js') }}"></script>

<!-- Slick Slider -->
<script src="{{ asset('assets/plugins/slick/slick.js') }}"></script>

<!-- Fancybox JS -->
<script src="{{ asset('assets/plugins/fancybox/jquery.fancybox.min.js') }}"></script>

<!-- Datetimepicker JS -->
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>


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
@stack('scripts')
</body>
</html>
