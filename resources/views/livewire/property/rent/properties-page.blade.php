<div class="page-wrapper">

    <!-- Start Breadcrumb -->
    <div class="breadcrumb-bar">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-01.png') }}" alt="" class="breadcrumb-bg-01 d-none d-lg-block">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-02.png') }}" alt="" class="breadcrumb-bg-02 d-none d-lg-block">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-03.png') }}" alt="" class="breadcrumb-bg-03">
        <div class="row align-items-center text-center position-relative z-1">
            <div class="col-md-12 col-lg-12 col-md-6 breadcrumb-arrow">
                <h1 class="breadcrumb-title">Rent List Sidebar</h1>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><span><i class="material-icons-outlined me-1">home</i></span>Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rent Property List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Start Content -->
    <div class="content">
        <div class="container">
            <!-- Top filter area -->
            <div class="card border-0 search-item mb-4">
                <div class="card-body">

                    <!-- start row -->
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <p class="mb-4 mb-lg-0 mb-md-3 text-lg-start text-md-start  text-center">Showing result <span class="result-value"> 06</span> of<span class="result-value"> 125</span></p>
                        </div> <!-- end col -->

                        <div class="col-lg-9">
                            <div class="d-flex align-items-center gap-3 flex-wrap justify-content-lg-end flex-lg-row flex-md-row flex-column">
{{--                                <div class="result-list d-flex d-block flex-lg-row flex-md-row flex-column align-items-center gap-2">--}}
{{--                                    <h5>Sort By</h5>--}}
{{--                                    <div class="result-select">--}}
{{--                                        <select class="select">--}}
{{--                                            <option value="0">Default</option>--}}
{{--                                            <option value="1" >A-Z</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="result-list d-flex flex-lg-row flex-md-row flex-column align-items-center gap-2">
                                    <h5>Price Range</h5>
                                    <div class="result-select">
                                        <select class="select">
                                            <option>Low to High</option>
                                            <option>High to Low</option>
                                        </select>
                                    </div>
                                </div>
                                <ul class="grid-list-view d-flex align-items-center justify-content-center">
                                    <li><a href="#"  class="list-icon active"><i class="material-icons">list</i></a></li>
{{--                                    <li><a href="rent-property-grid-sidebar.html" class="list-icon"><i class="material-icons">grid_view</i></a></li>--}}
{{--                                    <li><a href="rent-list-map.html" class="list-icon"><i class="material-icons-outlined">location_on</i></a></li>--}}
                                </ul>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div>
            </div> <!-- end card -->


            <div class="row">
                <!-- Sidebar filter area -->
                @include('livewire.property.rent.partials.sidebar-filter', ['limit' => 4])

                <!-- Content area -->
                <div class="col-lg-9">
                    <div class="row mb-4">

                        <!-- property card -->
                        @forelse($properties as $property)
                        <div class="col-lg-12 col-md-6">
                            <div class="property-card">
                                <div class="property-listing-item p-0 mb-0 shadow-none d-flex flex-lg-nowrap flex-wrap">
                                    <div class="buy-grid-img buy-list-img rent-list-img  mb-0 rounded-0">

                                        {{-- SEO: লিঙ্কে টাইটেল যোগ করা হয়েছে এবং slug ব্যবহার করা হয়েছে --}}
                                        <a href="{{ route('listing.details', $property->slug) }}" title="View details for {{ $property->title }}">

                                            {{-- SEO: ছবির alt ট্যাগ ডাইনামিক করা হয়েছে, যা খুবই গুরুত্বপূর্ণ --}}
                                            <img
                                                class="img-fluid"
                                                src="{{ $property->getFirstMediaUrl('featured_image', 'thumbnail') }}"
                                                alt="{{ $property->title }}"
                                                title="{{ $property->title }}"
                                            >
                                        </a>

                                        <div class="d-flex align-items-center justify-content-between position-absolute top-0 start-0 end-0 p-3 z-1">
                                            <div class="d-flex align-items-center gap-2">
                                                {{-- শর্তসাপেক্ষ ব্যাজ: যদি প্রপার্টিটি নতুন হয় --}}
                                                @if($property->created_at->gt(now()->subDays(7)))
                                                    <div class="badge badge-sm bg-danger d-flex align-items-center">
                                                        <i class="material-icons-outlined">offline_bolt</i>New
                                                    </div>
                                                @endif

                                                {{-- শর্তসাপেক্ষ ব্যাজ: যদি প্রপার্টিটি ফিচার্ড হয় --}}
                                                @if($property->is_featured)
                                                    <div class="badge badge-sm bg-orange d-flex align-items-center">
                                                        <i class="material-icons-outlined">loyalty</i>Featured
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between position-absolute bottom-0 end-0 start-0 p-3 z-1">
                                            {{-- ডাইনামিক মূল্য: ডাটাবেস থেকে আসছে --}}
                                            <h6 class="text-white mb-0">৳{{ number_format($property->rent_price) }} <span class="fs-14 fw-normal">/ {{ $property->rent_type }}</span></h6>

                                            {{-- ভবিষ্যতের জন্য: Wishlist কার্যকারিতা যোগ করার জন্য --}}
                                            <a href="javascript:void(0)" wire:click.prevent="toggleWishlist({{ $property->id }})" class="favourite">
                                                <i class="material-icons-outlined">favorite_border</i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="buy-grid-content w-100">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="d-flex align-items-center justify-content-center">
                                                {{-- ডাইনামিক স্টার রেটিং --}}
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="material-icons-outlined {{ $i <= round($property->average_rating) ? 'text-warning' : 'text-gray-300' }}">star</i>
                                                @endfor

                                                <span class="ms-1 fs-14"> ({{ $property->reviews_count }} Reviews)</span>
                                            </div>

                                            {{-- ডাইনামিক ক্যাটাগরি --}}
                                            <span class="badge bg-secondary">{{ $property->property_type }}</span>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div>
                                                <h6 class="title mb-1">
                                                    <a href="{{ route('listing.details', $property->slug) }}">{{ $property->title }}</a>
                                                </h6>

                                                <p class="d-flex align-items-center fs-14 mb-0">
                                                    <i class="material-icons-outlined me-1 ms-0">location_on</i>
                                                    {{ $property->address_street }}
                                                </p>
                                            </div>
                                        </div>

                                        <ul class="d-flex buy-grid-details d-flex mb-3 bg-light rounded p-3 justify-content-between align-items-center flex-wrap gap-1">
                                            {{-- ডাইনামিক স্পেসিফিকেশন --}}
                                            <li class="d-flex align-items-center gap-1">
                                                <i class="material-icons-outlined bg-white text-secondary">bed</i>
                                                {{ $property->bedrooms }} Bed
                                            </li>
                                            <li class="d-flex align-items-center gap-1">
                                                <i class="material-icons-outlined bg-white text-secondary">bathtub</i>
                                                {{ $property->bathrooms }} Bath
                                            </li>
                                            <li class="d-flex align-items-center gap-1">
                                                <i class="material-icons-outlined bg-white text-secondary">straighten</i>
                                                {{ $property->size_sqft }} Sq Ft
                                            </li>
                                        </ul>

                                        <div class="d-flex align-items-center justify-content-between flex-wrap border-top border-light-100 pt-3">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar avatar-lg user-avatar">
                                                    {{-- মালিকের ডাইনামিক ছবি ও নাম --}}
                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($property->user->avatar_url) }}" alt="{{ $property->user->name }}" class="rounded-circle">
                                                </div>
                                                <h6 class="mb-0 fs-16 fw-medium text-dark">{{ $property->user->name }}
                                                    <span class="d-block fs-14 text-body pt-1">United States</span>
                                                </h6>
                                            </div>
                                            <a href="rental-booking.html" class="btn btn-dark">Book Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end card -->
                        </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">No properties found matching your criteria.</p>
                            </div>
                        @endforelse

                    </div>
                    <!-- end row -->

                    <!-- Pagination এর পরিবর্তে Load More বাটন -->
                    @if ($hasMoreProperties)
                        <div class="text-center">
                            <button class="btn btn-dark d-inline-flex align-items-center" wire:click="loadMore">
                                {{-- লোডিং ইন্ডিকেটর --}}
                                <span wire:loading.remove wire:target="loadMore">
                                    <i class="material-icons-outlined me-1">autorenew</i>Load More
                                </span>

                                <span wire:loading wire:target="loadMore">
                                    Loading...
                                </span>
                            </button>
                        </div>
                    @endif

                </div>  <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- End Content -->

</div>


@push('scripts')
    <script>
        document.addEventListener('livewire:initialized', () => {
            let priceSlider = $("#price_range_slider").ionRangeSlider({
                type: "double",
                grid: true,
                min: 0,
                max: 100000,
                from: @json($min_price ?? 0),
                to: @json($max_price ?? 100000),
                prefix: "৳",
                onFinish: function (data) {
                    @this.set('min_price', data.from);
                    @this.set('max_price', data.to);
                }
            }).data("ionRangeSlider");

            // Livewire থেকে রিসেট ইভেন্ট শোনার জন্য
            Livewire.on('reset-price-slider', () => {
                priceSlider.reset();
            });
        });
    </script>
@endpush
