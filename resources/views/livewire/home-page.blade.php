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
    @include('livewire.partials.homepage.how-it-work')
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
    <section class="agent-section section-padding bg-dark position-relative">
        <div class="container">

            <!-- start row -->
            <div class="row align-items-center justify-content-lg-between justify-content-md-between flex-wrap">
                <div class="col-lg-7 aos" data-aos="zoom-in" data-aos-duration="1000">
                    <!-- start title -->
                    <div class="section-heading mb-3 mb-lg-0">
                        <h2 class="mb-2 text-center text-lg-start  text-white ">“আপনার প্রোপার্টি বিজ্ঞাপন দিন সহজেই”</h2>
                        <p class="mb-0 text-center text-lg-start text-light">মাত্র কয়েক মিনিটেই আপনার ফ্ল্যাট বা বাড়ির বিজ্ঞাপন প্রকাশ করুন এবং পৌঁছে যান হাজারো সম্ভাব্য ক্রেতা ও ভাড়াটিয়ার কাছে।”</p>
                    </div>
                    <!-- end title -->
                </div>
                <div class="col-lg-5 position-relative z-1 aos" data-aos="zoom-in" data-aos-duration="1500">
                    <div class="text-lg-end text-center ">
                        @auth
                            <a href="{{ route('filament.app.resources.properties.create') }}" class="btn btn-xl btn-primary"> Add Listing </a>
                        @endauth

                        @guest
                                <a href="{{ route('filament.app.auth.login') }}" class="btn btn-xl btn-primary"> Log In </a>
                        @endguest
                    </div>
                </div>
            </div>
            <!-- end row -->

        </div>


        <i class="fa-solid fa-circle custom-circle-line-1 d-lg-block d-none"></i>
        <i class="fa-solid fa-circle custom-circle-line-2 d-lg-block d-none"></i>


        <img src="{{ asset('assets/img/home/icons/property-element-1.svg') }}" alt="property-element-0" class="img-fluid custom-element-img-1 d-lg-block d-none">
        <img src="{{ asset('assets/img/home/icons/property-element-2.svg') }}" alt="property-element-0" class="img-fluid custom-element-img-2 d-lg-block d-none">
        <img src="{{ asset('assets/img/home/city/cities-img.png') }}" alt="property-element-0" class="img-fluid custom-element-img-3 position-absolute end-0 bottom-0 z-0 d-lg-block d-none">
    </section>
    <!-- end agent section -->

    <!-- start blog section -->
    <section class="home-blog-section section-padding ">
        <div class="container">

            <!-- start title -->
            <div class="section-heading aos" data-aos="fade-down" data-aos-duration="1000">
                <h2 class="mb-2 text-center">Latest Blog</h2>
                <div class="sec-line">
                    <span class="sec-line1"></span>
                    <span class="sec-line2"></span>
                </div>
                <p class="mb-0 text-center"> Explore our featured blog posts on premium properties for sales & rents.</p>
            </div>
            <!-- end title -->


            <!-- start row -->
            <div class="row row-gap-4 justify-content-center">

                <div class="col-md-6 col-lg-4 d-flex aos" data-aos="fade-down" data-aos-duration="1500">
                    <div class="blog-item-01 flex-fill">
                        <div class="blog-img">
                            <a href="blog-details.html"><img src="{{ asset('assets/img/blogs/blog-img-01.jpg') }}" alt="img" class="img-fluid"></a>
                        </div>
                        <div class="blog-content">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                                <span class="badge badge-sm bg-secondary fw-semibold">Property</span>
                                <div class="d-flex align-items-center author-details">
                                    <div class="d-flex align-items-center me-3">
                                        <a href="agent-details.html"><img src="{{ asset('assets/img/agents/agent-01.jpg') }}" alt="" class="avatar avatar-sm rounded-circle me-2"></a>
                                        <a href="agent-details.html">Susan Culli</a>
                                    </div>
                                    <span class="d-inline-flex align-items-center"><i class="material-icons-outlined me-1">events</i>10 Apr 2025</span>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-1"><a href="blog-details.html">Location is Everything</a></h5>
                                <p class="mb-0">The value of a property largely depends on where it’s located.</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->


                <div class="col-md-6 col-lg-4 d-flex aos" data-aos="fade-down" data-aos-duration="1500">
                    <div class="blog-item-01 flex-fill">
                        <div class="blog-img">
                            <a href="blog-details.html"><img src="{{ asset('assets/img/blogs/blog-img-02.jpg') }}" alt="img" class="img-fluid"></a>
                        </div>
                        <div class="blog-content">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                                <span class="badge badge-sm bg-secondary fw-semibold">Vila</span>
                                <div class="d-flex align-items-center author-details">
                                    <div class="d-flex align-items-center me-3">
                                        <a href="agent-details.html"><img src="{{ asset('assets/img/agents/agent-04.jpg') }}" alt="" class="avatar avatar-sm rounded-circle me-2"></a>
                                        <a href="agent-details.html">Shelly Cox</a>
                                    </div>
                                    <span class="d-inline-flex align-items-center"><i class="material-icons-outlined me-1">events</i>24 Apr 2025</span>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-1"><a href="blog-details.html">Real Estate is a Investment</a></h5>
                                <p class="mb-0">Unlike stocks, real estate usually grows in value over time.</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-md-6 col-lg-4 d-flex aos" data-aos="fade-down" data-aos-duration="1500">
                    <div class="blog-item-01 flex-fill">
                        <div class="blog-img">
                            <a href="blog-details.html"><img src="{{ asset('assets/img/blogs/blog-img-03.jpg') }}" alt="img" class="img-fluid"></a>
                        </div>
                        <div class="blog-content">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                                <span class="badge badge-sm bg-secondary fw-semibold">Godown</span>
                                <div class="d-flex align-items-center author-details">
                                    <div class="d-flex align-items-center me-3">
                                        <a href="agent-details.html"><img src="{{ asset('assets/img/agents/agent-02.jpg') }}" alt="" class="avatar avatar-sm rounded-circle me-2"></a>
                                        <a href="agent-details.html">Eva Jones</a>
                                    </div>
                                    <span class="d-inline-flex align-items-center"><i class="material-icons-outlined me-1">events</i>27 Sep 2025</span>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-1"><a href="blog-details.html">Market Trends Matter</a></h5>
                                <p class="mb-0">Staying informed about housing market trends helps you make smarter.</p>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->

            </div>

            <div class="text-center d-flex align-items-center justify-content-center m-auto">
                <a href="rent-property-grid.html" class="btn btn-lg btn-dark d-flex align-items-center gap-1"> Explore All <i class="material-icons-outlined">arrow_forward</i></a>
            </div>

        </div>
    </section>
    <!-- end blog section -->

</main>
