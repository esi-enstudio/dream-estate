<main>
    <!-- start banner section -->
    <section class="Home-banner-section">
        <div class="container">

            <!-- Hero title section -->
            @include('livewire.partials.homepage.hero')
            <!-- End Hero title section -->

            <!-- Find property form Start -->
            <livewire:homepage.property-search-form/>
            <!-- Find property form End -->
        </div>
    </section>
    <!-- end banner section -->

    <!-- start how it works a section -->
    <livewire:homepage.how-it-works-section />
    <!-- end how it works a section -->

    <!-- start exploring by property type section -->
    <livewire:homepage.property-type-slider/>
    <!-- end exploring by property type section -->

    <!-- start features section -->
    <livewire:homepage.featured-properties key="featured-rent" purpose="rent" />
    <!-- end features section -->

    <!-- start cities section -->
    <livewire:homepage.popular-areas/>
    <!-- end cities section -->

    <!-- start features rent section -->
    <livewire:homepage.featured-properties key="featured-sell" purpose="sell" />
    <!-- end features rent section -->

    <!-- start stat section -->
    <livewire:homepage.statistics-counter />
    <!-- end stat section -->

    <!-- start buy/sell/rent section -->
    <section class="buy-property-section section-padding pb-0">
        <div class="container">

            <div class="row justify-content-center">
                <!-- buy property item -->
                <div class="col-lg-4 col-md-6">
                    <div class="buy-property-item text-center mb-lg-0 mb-md-0  mb-4 aos" data-aos="fade-down" data-aos-duration="1000">
                        <div class="img-card overflow-hidden text-center">
                            <a href="#">
                                <img src="{{ asset('assets/img/home/city/property-img-1.jpg') }}" alt="Property Image">
                            </a>
                        </div>
                        <div class="buy-property bg-white d-flex align-items-center justify-content-between">
                            <h6 class="mb-0"><a href="#">Buy a Property</a></h6>
                            <a href="#" class="arrow buy-arrow d-flex align-items-center justify-content-center bg-error rounded-circle"><i class='fa-solid fa-arrow-right'></i></a>
                        </div>
                    </div>
                </div>

                <!-- sell property item -->
                <div class="col-lg-4 col-md-6" >
                    <div class="buy-property-item mb-lg-0 mb-4 text-center aos" data-aos="fade-up" data-aos-duration="1000">
                        <div class="img-card overflow-hidden text-center">
                            <a href="#"><img src="{{ asset('assets/img/home/city/property-img-2.jpg') }}" alt="Property Image"></a>
                        </div>
                        <div class="buy-property bg-white d-flex align-items-center justify-content-between">
                            <h6 class="mb-0"><a href="#">Sell a Property</a></h6>
                            <a href="#" class="arrow sell-arrow d-flex align-items-center justify-content-center bg-warning rounded-circle"><i class='fa-solid fa-arrow-right'></i></a>
                        </div>
                    </div>
                </div>

                <!-- rent property item -->
                <div class="col-lg-4 col-md-6" >
                    <div class="buy-property-item mb-0 text-center aos" data-aos="fade-down" data-aos-duration="1000">
                        <div class="img-card overflow-hidden text-center">
                            <a href="{{ route('listing.rent') }}"><img src="{{ asset('assets/img/home/city/property-img-3.jpg') }}" alt="Property Image"></a>
                        </div>
                        <div class="buy-property bg-white d-flex align-items-center justify-content-between">
                            <h6 class="mb-0">
                                <a href="{{ route('listing.rent') }}">Rent a Property</a>
                            </h6>
                            <a href="{{ route('listing.rent') }}" class="arrow rent-arrow d-flex align-items-center justify-content-center bg-info rounded-circle"><i class='fa-solid fa-arrow-right'></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- end buy/sell/rent section -->

    <!-- start partners section -->
    <livewire:homepage.partners-slider />
    <!-- end partners section -->

    <!-- start testimonials section -->
    <livewire:homepage.testimonials-slider />
    <!-- end partners section -->

    <!-- start faq section -->
    <livewire:homepage.faqs />
    <!-- end faq section -->

    <!-- start agent section -->
{{--    <section class="agent-section section-padding bg-dark position-relative">--}}
{{--        <div class="container">--}}

{{--            <!-- start row -->--}}
{{--            <div class="row align-items-center justify-content-lg-between justify-content-md-between flex-wrap">--}}
{{--                <div class="col-lg-7 aos" data-aos="zoom-in" data-aos-duration="1000">--}}
{{--                    <!-- start title -->--}}
{{--                    <div class="section-heading mb-3 mb-lg-0">--}}
{{--                        <h2 class="mb-2 text-center text-lg-start  text-white ">“আপনার প্রোপার্টি বিজ্ঞাপন দিন সহজেই”</h2>--}}
{{--                        <p class="mb-0 text-center text-lg-start text-light">মাত্র কয়েক মিনিটেই আপনার ফ্ল্যাট বা বাড়ির বিজ্ঞাপন প্রকাশ করুন এবং পৌঁছে যান হাজারো সম্ভাব্য ক্রেতা ও ভাড়াটিয়ার কাছে।</p>--}}
{{--                    </div>--}}
{{--                    <!-- end title -->--}}
{{--                </div>--}}
{{--                <div class="col-lg-5 position-relative z-1 aos" data-aos="zoom-in" data-aos-duration="1500">--}}
{{--                    <div class="text-lg-end text-center ">--}}
{{--                        @auth--}}
{{--                            <a href="{{ route('filament.app.resources.properties.create') }}" class="btn btn-xl btn-primary"> Add Listing </a>--}}
{{--                        @endauth--}}

{{--                        @guest--}}
{{--                                <a href="{{ route('filament.app.auth.login') }}" class="btn btn-xl btn-primary"> Log In </a>--}}
{{--                        @endguest--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- end row -->--}}

{{--        </div>--}}


{{--        <i class="fa-solid fa-circle custom-circle-line-1 d-lg-block d-none"></i>--}}
{{--        <i class="fa-solid fa-circle custom-circle-line-2 d-lg-block d-none"></i>--}}


{{--        <img src="{{ asset('assets/img/home/icons/property-element-1.svg') }}" alt="property-element-0" class="img-fluid custom-element-img-1 d-lg-block d-none">--}}
{{--        <img src="{{ asset('assets/img/home/icons/property-element-2.svg') }}" alt="property-element-0" class="img-fluid custom-element-img-2 d-lg-block d-none">--}}
{{--        <img src="{{ asset('assets/img/home/city/cities-img.png') }}" alt="property-element-0" class="img-fluid custom-element-img-3 position-absolute end-0 bottom-0 z-0 d-lg-block d-none">--}}
{{--    </section>--}}
    <!-- end agent section -->

    <!-- start blog section -->
    <livewire:homepage.latest-posts />
    <!-- end blog section -->

</main>
