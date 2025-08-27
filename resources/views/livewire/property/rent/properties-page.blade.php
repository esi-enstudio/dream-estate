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
            <div class="card border-0 search-item mb-4">
                <div class="card-body">

                    <!-- start row -->
                    <div class="row align-items-center">
                        <div class="col-lg-3">
                            <p class="mb-4 mb-lg-0 mb-md-3 text-lg-start text-md-start  text-center">Showing result <span class="result-value"> 06</span> of<span class="result-value"> 125</span></p>
                        </div> <!-- end col -->

                        <div class="col-lg-9">
                            <div class="d-flex align-items-center gap-3 flex-wrap justify-content-lg-end flex-lg-row flex-md-row flex-column">
                                <div class="result-list d-flex d-block flex-lg-row flex-md-row flex-column align-items-center gap-2">
                                    <h5>Sort By</h5>
                                    <div class="result-select">
                                        <select class="select">
                                            <option value="0">Default</option>
                                            <option value="1" >A-Z</option>
                                        </select>
                                    </div>
                                </div>
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
                                    <li><a href="rent-property-list-sidebar.html"  class="list-icon active"><i class="material-icons">list</i></a></li>
                                    <li><a href="rent-property-grid-sidebar.html" class="list-icon"><i class="material-icons">grid_view</i></a></li>
                                    <li><a href="rent-list-map.html" class="list-icon"><i class="material-icons-outlined">location_on</i></a></li>
                                </ul>
                            </div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div>
            </div> <!-- end card -->

            <!-- start row -->
            <div class="row">
                <div class="col-lg-3 theiaStickySidebar">
                    <div class="filter-sidebar rent-grid-sidebar-item-02 mb-lg-0">
                        <div class="filter-head d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Filter</h5>
                            <a href="#" class="text-danger">Reset</a>
                        </div>
                        <div class="filter-body">

                            <!-- Items -->
                            <div class="filter-set">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#search" aria-expanded="false" role="button">
                                        <h6 class="d-inline-flex align-items-center mb-0"><i class="material-icons-outlined me-2 text-secondary">search</i>Search</h6>
                                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                                    </div>
                                </div>
                                <div id="search" class="card-collapse collapse show mt-3">
                                    <div class="input-group input-group-flat mb-3">
												<span class="input-group-text border-0">
                                                    <i class="material-icons-outlined">search</i>
                                                </span>
                                        <input type="text" class="form-control" placeholder="Search here...">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label mb-1">Select Location</label>
                                        <select class="select">
                                            <option>Chicago</option>
                                            <option>Newyork</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label mb-1">No of Bedrooms</label>
                                        <select class="select">
                                            <option>Select</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label mb-1">No of Bathrooms</label>
                                        <select class="select">
                                            <option>Select</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="form-label mb-1"> Min Sqft </label>
                                        <div class="input-group input-group-flat mb-0">
                                            <input type="text" class="form-control" placeholder="Search here...">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Items -->
                            <div class="filter-set">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#category" aria-expanded="false" role="button">
                                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">category</i>Categories</h6>
                                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                                    </div>
                                </div>
                                <div id="category" class="card-collapse collapse show mt-3">
                                    <div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_1">
                                            <label class="form-check-label ms-2" for="check_1">
                                                Apartments (45)
                                            </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_2">
                                            <label class="form-check-label ms-2" for="check_2">
                                                Condos (32)
                                            </label>
                                        </div>
                                        <div class="more-menu mt-2">
                                            <div class="form-check d-flex align-items-center ps-0 mb-2">
                                                <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_3">
                                                <label class="form-check-label ms-2" for="check_3">
                                                    Houses (24)
                                                </label>
                                            </div>
                                            <div class="form-check d-flex align-items-center ps-0 mb-2">
                                                <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_4">
                                                <label class="form-check-label ms-2" for="check_4">
                                                    Industrial (75)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_5">
                                            <label class="form-check-label ms-2" for="check_5">
                                                Land (18)
                                            </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center ps-0 ">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_6">
                                            <label class="form-check-label ms-2" for="check_6">
                                                Office (12)
                                            </label>
                                        </div>
                                        <div class="view-all d-inline-flex align-items-center">
                                            <a href="javascript:void(0);" class="viewall-button text-secondary">See More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Items -->
                            <div class="filter-set">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#amenities" aria-expanded="false" role="button">
                                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">cake</i>Amenities</h6>
                                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                                    </div>
                                </div>
                                <div id="amenities" class="card-collapse collapse show mt-3">
                                    <div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_7">
                                            <label class="form-check-label ms-2" for="check_7">
                                                Backyard (34)
                                            </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_8">
                                            <label class="form-check-label ms-2" for="check_8">
                                                Central Air (28)
                                            </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_9">
                                            <label class="form-check-label ms-2" for="check_9">
                                                Chair Accessable (39)
                                            </label>
                                        </div>
                                        <div class="more-menu1 mt-2">
                                            <div class="form-check d-flex align-items-center ps-0 mb-2">
                                                <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_10">
                                                <label class="form-check-label ms-2" for="check_10">
                                                    Elevator (16)
                                                </label>
                                            </div>
                                            <div class="form-check d-flex align-items-center ps-0">
                                                <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_11">
                                                <label class="form-check-label ms-2" for="check_11">
                                                    Fireplace (23)
                                                </label>
                                            </div>
                                        </div>
                                        <div class="view-all d-inline-flex align-items-center">
                                            <a href="javascript:void(0);" class="viewall1-button text-secondary">See More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Items -->
                            <div class="filter-set">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#price" aria-expanded="false" role="button">
                                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">monetization_on</i>Price</h6>
                                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                                    </div>
                                </div>
                                <div id="price" class="card-collapse collapse show mt-3">
                                    <div>
                                        <div class="filter-range">
                                            <input type="text" id="range_03">
                                            <p class="mb-0">Range : <span class="text-dark">$200 - $5695</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Items -->
                            <div class="filter-set">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#reviews" aria-expanded="false" role="button">
                                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">auto_awesome</i>Reviews</h6>
                                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                                    </div>
                                </div>
                                <div id="reviews" class="card-collapse collapse show mt-3">
                                    <div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_12">
                                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_12">
														<span class="review-star mb-0 d-flex align-items-center">
                                                            <i class="material-icons text-warning">star</i>
                                                            <i class="material-icons text-warning">star</i>
                                                            <i class="material-icons text-warning">star</i>
                                                            <i class="material-icons text-warning">star</i>
                                                            <i class="material-icons text-warning">star</i>
                                                        </span>
                                                <span class="ms-2 mb-0"> 5 Star </span>
                                            </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_13">
                                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_13">
														<span class="review-star mb-0 d-flex align-items-center">
                                                            <i class="material-icons text-warning">star</i>
                                                            <i class="material-icons text-warning">star</i>
                                                            <i class="material-icons text-warning">star</i>
                                                            <i class="material-icons text-warning">star</i>
                                                        </span>
                                                <span class="ms-2 mb-0"> 4 Star </span>
                                            </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_14">
                                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_14">
                                                        <span class="review-star mb-0 d-flex align-items-center">
                                                        <i class="material-icons text-warning">star</i>
                                                        <i class="material-icons text-warning">star</i>
                                                        <i class="material-icons text-warning">star</i>
                                                    </span>
                                                <span class="ms-2 mb-0"> 3 Star </span>
                                            </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_15">
                                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_15">
                                                        <span class="review-star mb-0 d-flex align-items-center">
                                                        <i class="material-icons text-warning">star</i>
                                                        <i class="material-icons text-warning">star</i>
                                                    </span>
                                                <span class="ms-2 mb-0"> 2 Star </span>
                                            </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-0">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_16">
                                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_16">
														<span class="review-star mb-0 d-flex align-items-center">
                                                            <i class="material-icons text-warning">star</i>
                                                        </span>
                                                <span class="ms-2 mb-0"> 1 Star </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Items -->
                            <div class="filter-set">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#style" aria-expanded="false" role="button">
                                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">corporate_fare</i>Style</h6>
                                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                                    </div>
                                </div>
                                <div id="style" class="card-collapse collapse show mt-3">
                                    <div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_17">
                                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_17">
                                                Budget
                                            </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_18">
                                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_18">
                                                Midrange
                                            </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_19">
                                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_19">
                                                Luxury
                                            </label>
                                        </div>
                                        <div class="form-check d-flex align-items-center ps-0 mb-0">
                                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_20">
                                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_20">
                                                Family Friendly
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="filter-footer">
                            <a href="#" class="btn btn-dark w-100"> Apply Filter </a>
                        </div>
                    </div>
                </div>  <!-- end col -->

                <div class="col-lg-9">

                    <!-- start row -->
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
