<div class="page-wrapper">

    <div class="buy-details-header-item">
        <!-- Start Breadcrumb -->
        <div class="breadcrumb-bar custom-breadcrumb-bar">
            <div class="container">
                <div class="row align-items-center text-center position-relative z-1">
                    <div class="col-xl-8">
                        <div class="d-flex align-center gap-2 mb-2">
                            <span class="badge bg-primary">{{ $property->propertyType->name_en }}</span>
                            <span class="badge bg-secondary">For {{ ucfirst($property->purpose) }}</span>
                        </div>

                        {{-- SEO: h1 ট্যাগ সবচেয়ে গুরুত্বপূর্ণ --}}
                        <h1 class="breadcrumb-title text-start ">{{ $property->title }}</h1>
                        <div class="d-flex align-items-center gap-2 flex-wrap gap-1">
                            {{-- Avg star rating --}}
                            <div class="d-flex align-items-center justify-content-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="material-icons-outlined {{ $i <= round($property->average_rating) ? 'text-warning' : 'text-gray-300' }}">star</i>
                                @endfor
                                <span class="text-white ms-1"> {{ number_format($property->average_rating, 1) }} </span>
                            </div>

                            <i class="fa-solid fa-circle text-body"></i>

                            {{-- Property address --}}
                            <div class="fs-14 mb-0 text-white d-flex align-items-center flex-wrap gap-1 custom-address-item">
                                <i class="material-icons-outlined text-white me-1">location_on</i>
                                {{ $property->address_street }}, {{ $property->address_area }}, {{ $property->address_city }}

                                @if($property->google_maps_location_link)
                                    <a href="{{ $property->google_maps_location_link }}" target="_blank" class="text-primary fs-14 text-decoration-underline ms-1"> View Location</a>
                                @endif
                            </div>

                            <i class="fa-solid fa-circle text-body"></i>
                            <p class="fs-14 mb-0 text-white">Last Updated on : {{ $property->updated_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="col-xl-4 d-flex d-xl-block flex-wrap gap-3">
                        <div class="breadcrumb-icons d-flex align-items-center justify-content-xl-end justify-content-start gap-2 mb-xl-4 mb-2 mt-xl-0 mt-4">
                            {{-- Wishlist, Bookmark, Compare functionalities can be implemented later --}}
                            <livewire:wishlist-button :property="$property" :key="'wishlist-list-'.$property->id" />
{{--                            <a href="javascript:void(0);" class=""><i class="material-icons-outlined rounded">bookmark_add</i></a>--}}
{{--                            <a href="javascript:void(0);" class=""><i class="material-icons-outlined rounded">compare_arrows</i></a>--}}
                        </div>
                        <div class="d-flex align-items-center gap-3 justify-content-xl-end justify-content-start">
                            <h4 class="mb-0 text-primary text-xl-end text-start">
                                ৳{{ number_format($property->rent_price) }}
                                <span class="fs-14 fw-normal text-white">/ {{ ucfirst($property->rent_type) }}</span> </h4>
                            <a href="#" class="btn btn-primary btn-lg d-flex align-items-center"><i class="material-icons-outlined rounded me-1">calendar_today</i>Book Now</a>
{{--                            <a href="rental-booking.html" class="btn btn-primary btn-lg d-flex align-items-center"><i class="material-icons-outlined rounded me-1">calendar_today</i>Book Now</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb -->

    </div>

    <!-- Start Content -->
    <div class="content">
        <div class="container">

            <!-- start row -->
            <div class="row">
                <div class="col-xl-8">

                    <div class="mb-4 d-inline-flex align-center justify-content-between w-100 flex-wrap gap-1">
                        <div class="d-inline-flex align-center gap-2">
                            @if($property->is_trending)
                                <span class="badge bg-danger d-flex align-items-center"><i class="material-icons-outlined fs-14 me-1">generating_tokens</i> Trending </span>
                            @endif

                            @if($property->is_featured)
                                <span class="badge bg-orange d-flex align-items-center"> <i class="material-icons-outlined fs-14 me-1">loyalty</i> Featured </span>
                            @endif
                        </div>
                        <p class="mb-0 text-dark">
                            Total No of Visits : {{ $property->views_count }}
                        </p>
                    </div>

                    <!-- start slider -->
                    @php
                        $featuredImage = $property->getFirstMedia('featured_image');
                        $galleryImages = $property->getMedia('gallery');
                    @endphp

                    @if($featuredImage || $galleryImages->count() > 0)
                        <div class="slider-card service-slider-card mb-4">
                            <div class="slide-part mb-4">
                                <div class="slider service-slider">
                                    @if($featuredImage)
                                        <div class="service-img-wrap">
                                            {{-- SEO: Alt tag is critical --}}
                                            <img src="{{ $featuredImage->getUrl() }}" class="img-fluid" alt="{{ $property->title }} - Featured Image">
                                        </div>
                                    @endif

                                    @foreach($galleryImages as $image)
                                        <div class="service-img-wrap">
                                            <img src="{{ $image->getUrl() }}" class="img-fluid" alt="{{ $property->title }} - Gallery Image {{ $loop->iteration }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="slider slider-nav-thumbnails text-center">
                                @if($featuredImage)
                                    <div class="slide-img"><img src="{{ $featuredImage->getUrl() }}" class="img-fluid" alt="Thumbnail of {{ $property->title }}"></div>
                                @endif

                                @foreach($galleryImages as $image)
                                    <div class="slide-img"><img src="{{ $image->getUrl() }}" class="img-fluid" alt="Gallery Thumbnail {{ $loop->iteration }}"></div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <!-- End slider -->

                    <!-- items-2-->
                    <div class="accordion accordions-items-seperate">

                        <!-- description items -->
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-1" aria-expanded="true">
                                    Description
                                </button>
                            </div>

                            <div id="accordion-1" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    {{-- Rich text editor থেকে আসা HTML রেন্ডার করার জন্য {!! !!} ব্যবহার করুন --}}
                                    {!! $property->description !!}
                                </div>
                            </div>
                        </div>

                        <!-- Property items -->
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-2" aria-expanded="true">
                                    Property Features
                                </button>
                            </div>
                            <div id="accordion-2" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <!-- start row -->
                                    <div class="row row-gap-4">
                                        <div class="col-lg-3 col-md-6">
                                            <div class="buy-property-items">
                                                <p> <i class="material-icons-outlined">bed</i>  Bedrooms: {{ $property->bedrooms }}</p>
                                                <p> <i class="material-icons-outlined">bathtub</i>  Bathrooms: {{ $property->bathrooms }}</p>
                                                <p> <i class="material-icons-outlined">corporate_fare</i>  Balconies: {{ $property->balconies  }}</p>
                                                <p> <i class="material-icons-outlined">door_sliding</i> Floor: {{ $property->floor_level }} of {{ $property->total_floors }} </p>
                                            </div>
                                        </div> <!-- end col -->

                                        @if($property->additional_features)
                                            <div class="col-lg-3 col-md-6">
                                                <div class="buy-property-items">
                                                    @foreach($property->additional_features as $feature => $value)
                                                        <p> <i class="material-icons-outlined">check</i> {{ ucfirst($feature) }}: {{ $value }} </p>
                                                    @endforeach
                                                </div>
                                            </div> <!-- end col -->
                                        @endif
                                    </div>
                                    <!-- end row -->
                                </div>
                            </div>
                        </div>

                        <!-- about property items -->
                        @if($property->house_rules)
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    {{-- SEO: h2, h3 ট্যাগ ব্যবহার করা ভালো --}}
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-3" aria-expanded="true">
                                            House Rules & Guidelines
                                        </button>
                                    </h2>
                                </div>
                                <div id="accordion-3" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        @php
                                            // house_rules-এর টেক্সটকে প্রতিটি লাইন অনুযায়ী একটি অ্যারেতে বিভক্ত করা হচ্ছে
                                            // PREG_SPLIT_NO_EMPTY নিশ্চিত করে যে কোনো খালি লাইন অ্যারেতে আসবে না
                                            $rules = preg_split('/\\r\\n|\\r|\\n/', $property->house_rules, -1, PREG_SPLIT_NO_EMPTY);
                                        @endphp

                                        @foreach($rules as $rule)
                                            {{-- প্রতিটি নিয়মের জন্য ডিজাইনের ফরম্যাট অনুযায়ী HTML তৈরি হচ্ছে --}}
                                            <p class="mb-2">
                                                <i class="fa-solid fa-circle-check text-success me-2 fs-18"></i>
                                                {{-- SEO: htmlspecialchars ব্যবহার করে টেক্সটকে নিরাপদ রাখা হচ্ছে --}}
                                                {{ htmlspecialchars($rule) }}
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Amenities Section (Database Driven) -->
                        @if($property->amenities->isNotEmpty())
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-4" aria-expanded="true">
                                            Amenities
                                        </button>
                                    </h2>
                                </div>
                                <div id="accordion-4" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row">
                                            {{-- প্রপার্টির সাথে সংযুক্ত প্রতিটি Amenity-এর উপর লুপ চালানো হচ্ছে --}}
                                            <div class="col-md-12">
                                                <div class="buy-property-items">
                                                    @foreach($property->amenities as $amenity)
                                                        <p class="mb-0 d-flex align-items-center">
                                                            {{-- amenities টেবিল থেকে আইকন ক্লাস ব্যবহার করা হচ্ছে --}}
                                                            {{-- আপনার আইকন লাইব্রেরি অনুযায়ী ট্যাগ পরিবর্তন করতে হতে পারে (e.g., <i class="{{ $amenity->icon_class }}"></i>) --}}
                                                            <i class="material-icons-outlined me-2">{{ $amenity->icon_class ?? 'check_circle_outline' }}</i>
                                                            <span>{{ $amenity->name }}
                                                                {{-- পিভট টেবিল থেকে অতিরিক্ত তথ্য (details) দেখানো হচ্ছে --}}
                                                                @if($amenity->pivot->details)
                                                                    <span class="text-muted">({{ $amenity->pivot->details }})</span>
                                                                @endif
                                                            </span>
                                                        </p>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- floor plan items -->
{{--                        <div class="accordion-item">--}}
{{--                            <div class="accordion-header">--}}
{{--                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-5" aria-expanded="true">--}}
{{--                                    Floor Plan--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div id="accordion-5" class="accordion-collapse collapse show">--}}
{{--                                <div class="accordion-body">--}}

{{--                                    <div class="card border-0 shadow-none bg-light rounded mb-3">--}}
{{--                                        <div class="card-body d-flex align-center justify-content-between gap-2 flex-wrap">--}}
{{--                                            <h6 class="fs-16 fw-semibold mb-0">Balcony Plan</h6>--}}
{{--                                            <div class="d-flex align-items-center floor-items">--}}
{{--                                                <a href="javascript:void(0);" class="fs-16 text-dark"> <i class="material-icons-outlined">file_download</i> </a>--}}
{{--                                                <a href="javascript:void(0);" class="fs-16 text-dark"> <i class="material-icons-outlined">remove_red_eye</i> </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="card border-0 shadow-none bg-light rounded mb-3">--}}
{{--                                        <div class="card-body d-flex align-center justify-content-between gap-2 flex-wrap">--}}
{{--                                            <h6 class="fs-16 fw-semibold mb-0">Front Hall</h6>--}}
{{--                                            <div class="d-flex align-items-center floor-items">--}}
{{--                                                <a href="javascript:void(0);" class="fs-16 text-dark"> <i class="material-icons-outlined">file_download</i> </a>--}}
{{--                                                <a href="javascript:void(0);" class="fs-16 text-dark"> <i class="material-icons-outlined">remove_red_eye</i> </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="card border-0 shadow-none bg-light rounded mb-0">--}}
{{--                                        <div class="card-body d-flex align-center justify-content-between gap-2 flex-wrap">--}}
{{--                                            <h6 class="fs-16 fw-semibold mb-0">Kitchen</h6>--}}
{{--                                            <div class="d-flex align-items-center floor-items">--}}
{{--                                                <a href="javascript:void(0);" class="fs-16 text-dark"> <i class="material-icons-outlined">file_download</i> </a>--}}
{{--                                                <a href="javascript:void(0);" class="fs-16 text-dark"> <i class="material-icons-outlined">remove_red_eye</i> </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}


{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <!-- Gallery Section (Database Driven & SEO Optimized) -->
                        @php
                            // 'gallery' কালেকশন থেকে সমস্ত মিডিয়া আইটেম আনা হচ্ছে
                            $galleryImages = $property->getMedia('gallery');
                        @endphp

                        @if($galleryImages->isNotEmpty())
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-6" aria-expanded="true">
                                            Gallery ({{ $galleryImages->count() }} Photos)
                                        </button>
                                    </h2>
                                </div>
                                <div id="accordion-6" class="accordion-collapse collapse show">
                                    <div class="accordion-body gallery-body">
                                        <div class="gallery-slider">

                                            {{-- প্রতিটি গ্যালারি ছবির জন্য লুপ চালানো হচ্ছে --}}
                                            @foreach($galleryImages as $image)
                                                <div class="gallery-card">
                                                    {{-- FancyBox লাইটবক্সের জন্য মূল ছবির URL ব্যবহার করা হচ্ছে --}}
                                                    <a href="{{ $image->getUrl() }}"
                                                       data-fancybox="gallery"
                                                       class="gallery-item rounded"
                                                       data-caption="{{ $property->title }} - Photo {{ $loop->iteration }}"
                                                       title="View full size image">

                                                        {{-- স্লাইডারে দেখানোর জন্য ছোট আকারের 'preview' কনভার্সন ব্যবহার করা হচ্ছে --}}
                                                        {{-- SEO: alt ট্যাগটি ডাইনামিক এবং বর্ণনামূলক, যা সার্চ ইঞ্জিনের জন্য খুবই গুরুত্বপূর্ণ --}}
                                                        <img src="{{ $image->getUrl('preview') }}"
                                                             alt="{{ $property->title }} - Gallery Image {{ $loop->iteration }}"
                                                             class="rounded img-fluid">
                                                    </a>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- video items -->
                        @if($property->video_url)
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-7" aria-expanded="true">
                                        Video
                                    </button>
                                </div>

                                <div id="accordion-7" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="video-items position-relative">
                                            {{-- SEO: ছবির alt ট্যাগ ডাইনামিক করা হয়েছে, যা খুবই গুরুত্বপূর্ণ --}}
                                            <img
                                                class="img-fluid video-bg"
                                                src="{{ $property->getFirstMediaUrl('featured_image', 'thumbnail') }}"
                                                alt="{{ $property->title }}"
                                                title="{{ $property->title }}"
                                            >

                                            <a class="video-icon" data-fancybox="" href="{{ $property->video_url }}">
                                                <i class="material-icons-outlined">play_circle_filled</i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- faq items -->
                        @if($property->faqs)
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accordion-8" aria-expanded="true">
                                        Frequently Asked Questions
                                    </button>
                                </div>
                                <div id="accordion-8" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="faq-items">
                                            @foreach($property->faqs as $faq)
                                                <div class="faq-card mb">
                                                    <h4 class="faq-title">
                                                        <a class="collapsed" data-bs-toggle="collapse" href="#faq{{ $loop->index }}" aria-expanded="false">
                                                            {{ $faq['question'] }}
                                                        </a>
                                                    </h4>
                                                    <div id="faq{{ $loop->index }}" class="card-collapse collapse">
                                                        <div class="faq-content">
                                                            {!! $faq['answer'] !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- reviews items -->
                        <livewire:property-reviews :property="$property" :key="'reviews-'.$property->id" />
                    </div>

                </div> <!-- col end -->

                <div class="col-xl-4 theiaStickySidebar buy-details-item">

                    <!-- Provider Details -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Provider Details</h5>
                        </div>

                        <div class="card-body">
                            <div class="card bg-light border-0 rounded shadow-none custom-btn">
                                <div class="card-body">
                                    <div  class="d-flex align-items-center gap-2">
                                        <div class="avatar avatar-lg">
                                            <img src="{{ asset('assets/img/users/default-avatar.png') }}" alt="{{ $property->user->name }}" class="rounded-circle">
                                        </div>

                                        <div>
                                            <h6 class="mb-1 fs-16 fw-semibold">
                                                <a class="d-block w-100" href="javascript:void(0);">
                                                    {{ $property->user->name }}
                                                </a>
                                            </h6>
                                            <p class="mb-0 fs-14 text-body"> Company Agent </p>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card -->

                            <div class="border p-2 rounded mb-4">
                                @auth()
                                    <a href="tel:{{ $property->user->phone }}" class="d-block mb-3 pb-3 border-bottom text-body d-flex align-items-center">
                                        <i class="material-icons-outlined text-body me-2 fs-16 p-1 bg-light rounded text-dark">phone</i>
                                        Call Us :  {{ $property->user->phone }}
                                    </a>
                                @else
                                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                        <i class="material-icons-outlined text-muted me-2 fs-16 p-1 bg-light rounded">lock</i>
                                        <a href="{{ route('filament.superadmin.auth.login') }}"
                                           class="btn btn-outline-primary btn-sm">
                                            Login to view contact
                                        </a>
                                    </div>
                                @endauth

                                @auth()
                                <a href="mailto:{{ $property->user->email }}" class="d-block text-body d-flex align-items-center"><i class="material-icons-outlined text-body me-2 fs-16 p-1 bg-light rounded text-dark">email</i>Email : {{ $property->user->email }} </a>
                                @else
                                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                                        <i class="material-icons-outlined text-muted me-2 fs-16 p-1 bg-light rounded">lock</i>
                                        <a href="{{ route('filament.superadmin.auth.login') }}"
                                           class="btn btn-outline-primary btn-sm">
                                            Login to view email
                                        </a>
                                    </div>
                                @endauth
                            </div>

                            <div class="d-flex align-items-center justify-content-between gap-2 custom-btn flex-wrap mb-0">
                                <a href="#" class="btn btn-primary btn-lg d-flex align-center justify-content-center"> Whatsapp </a>
                                <a href="#" class="btn btn-dark btn-lg d-flex align-center text-center justify-content-center"> Chat Now </a>
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->

                    <!-- Enquire -->
                    <livewire:enquiry-form :property="$property" :key="$property->id" />

                    <!-- Why Book With Us -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Why Book With Us</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-0">
                                <p class="d-flex align-items-center gap-2 mb-3 text-body"><i class="material-icons-outlined text-secondary">badge</i> Expertise and Experience</p>
                                <p class="d-flex align-items-center gap-2 mb-3 text-body"><i class="material-icons-outlined text-secondary">design_services</i> Tailored Services</p>
                                <p class="d-flex align-items-center gap-2 mb-3 text-body"><i class="material-icons-outlined text-secondary">play_lesson</i> Comprehensive Planning</p>
                                <p class="d-flex align-items-center gap-2 mb-3 text-body"><i class="material-icons-outlined text-secondary">person</i> Client Satisfaction</p>
                                <p class="d-flex align-items-center gap-2 mb-0 text-body"><i class="material-icons-outlined text-secondary">support_agent</i> 24/7 Support</p>
                            </div>
                        </div> <!-- end card body-->
                    </div> <!-- end card -->

                    <!-- map -->
{{--                    @if($property->google_maps_location_link)--}}
{{--                        <div class="card mb-0">--}}
{{--                            <div class="custom-map position-relative">--}}
{{--                                <a href="{{ $property->google_maps_location_link }}" class="btn btn-dark fw-medium"> View Location </a>--}}
{{--                                <iframe src="{{ Str::replace('/maps/', '/maps/embed/', $property->google_maps_location_link) }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <h6 class="mb-3"> Nearby Landmarks & Visits </h6>--}}
{{--                                <p class="mb-2 text-body"><i class="fa-regular fa-circle-check fs-16 me-2 text-body"></i>  Near By Statue of Liberty </p>--}}
{{--                                <p class="mb-2 text-body"><i class="fa-regular fa-circle-check fs-16 me-2 text-body"></i> The Metropolitan Museum of Art </p>--}}
{{--                                <p class="mb-0 text-body"><i class="fa-regular fa-circle-check fs-16 me-2 text-body"></i> Yellowstone National Park </p>--}}
{{--                            </div> <!-- end card body-->--}}
{{--                        </div> <!-- end card -->--}}
{{--                    @endif--}}

                </div> <!-- col end -->
            </div>
            <!-- end row -->


            <!-- related property list -->
            @if($this->relatedProperties->isNotEmpty())
                <div class="row row-gap-4 custom-properties-items">
                    @foreach($this->relatedProperties as $relatedProperty)
                        @include('livewire.property.rent.partials.related-property', ['property' => $relatedProperty])
                    @endforeach
                </div>
            @endif
            <!-- end row plan Items -->

        </div>
    </div>
    <!-- End Content -->
</div>
