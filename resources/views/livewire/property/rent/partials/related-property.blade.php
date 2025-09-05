<!-- Items-1 -->
<div class="col-xl-3 col-lg-6 col-md-6 d-flex">
    <div class="property-card mb-0 flex-fill">
        <div class="property-listing-item p-0 mb-0 shadow-none">
            <div class="buy-grid-img mb-0 rounded-0">
                {{-- SEO: পরিষ্কার URL এবং ছবির টাইটেল --}}
                <a href="{{ route('listing.details', $property->slug) }}" title="View details for {{ $property->title }}">
                    {{-- SEO: ডাইনামিক alt ট্যাগ খুবই গুরুত্বপূর্ণ --}}
                    <img class="img-fluid"
                         src="{{ $property->getFirstMediaUrl('featured_image', 'thumbnail') }}"
                         alt="{{ $property->title }}"
                         title="{{ $property->title }}">
                </a>
                <div class="d-flex align-items-center justify-content-between position-absolute top-0 start-0 end-0 px-3 py-2 z-1">
                    <div class="d-flex align-items-center gap-2">
                        {{-- শর্তসাপেক্ষ ব্যাজ --}}
                        @if($property->is_trending)
                            <div class="badge badge-sm bg-danger d-flex align-items-center custom-badge">
                                <i class="material-icons-outlined">generating_tokens</i>
                            </div>
                        @endif
                        @if($property->is_featured)
                            <div class="badge badge-sm bg-orange d-flex align-items-center custom-badge">
                                <i class="material-icons-outlined">loyalty</i>
                            </div>
                        @endif
                    </div>

                    {{-- ভবিষ্যতের Wishlist কার্যকারিতার জন্য --}}
                    <a href="javascript:void(0)" class="favourite">
                        <i class="material-icons-outlined">favorite_border</i>
                    </a>
                </div>
                <div class="d-flex align-items-center justify-content-start position-absolute bottom-0 end-0 start-0 p-3 z-1">
                    <div class="user-avatar avatar avatar-md border rounded-circle">
                        {{-- মালিকের ডাইনামিক ছবি --}}
                        <img src="{{ $property->user->avatar_url ?? asset('assets/img/users/default-avatar.png') }}" alt="{{ $property->user->name }}" class="rounded-circle">
                    </div>
                </div>
            </div>
            <div class="buy-grid-content">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    {{-- ডাইনামিক ক্যাটাগরি --}}
                    <span class="badge bg-secondary">{{ $property->propertyType->name_bn ?? 'N/A' }}</span>
                    {{-- ডাইনামিক তারিখ --}}
                    <span class="ms-1 fs-14">Listed on : {{ $property->created_at->format('d M Y') }}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h6 class="title mb-1">
                            <a href="{{ route('listing.details', $property->slug) }}" title="{{ $property->title }}">{{ \Illuminate\Support\Str::limit($property->title, 20) }}</a>
                        </h6>
                        <div class="d-flex align-items-center fs-14 mb-0 flex-wrap gap-1">
                            <i class="material-icons-outlined me-1 ms-0">location_on</i>
                            {{ $property->address_street }}
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-1">
                    {{-- ডাইনামিক মূল্য এবং ধরণ --}}
                    <h6 class="text-primary mb-0 ms-1">৳{{ number_format($property->rent_price) }}
                        <span class="fw-normal fs-14"> / {{ ucfirst($property->rent_type) }}</span>
                    </h6>

                    <div class="d-flex align-items-center justify-content-center">
                        {{-- ডাইনামিক রেটিং --}}
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="material-icons-outlined text-warning {{ $i > round($property->average_rating) ? 'opacity-25' : '' }}">star</i>
                        @endfor
                        <span class="ms-1 fs-14">{{ number_format($property->average_rating, 1) }}</span>
                    </div>
                </div>

                <ul class="d-flex buy-grid-details justify-content-between align-items-center flex-wrap gap-1 border-top border-light-100 pt-3 mt-3">
                    {{-- ডাইনামিক স্পেসিফিকেশন --}}
                    <li class="d-flex align-items-center gap-1">
                        <i class="material-icons-outlined bg-light text-dark">bed</i>
                        {{ $property->bedrooms }} Bed
                    </li>
                    <li class="d-flex align-items-center gap-1">
                        <i class="material-icons-outlined bg-light text-dark">bathtub</i>
                        {{ $property->bathrooms }} Bath
                    </li>
                    <li class="d-flex align-items-center gap-1">
                        <i class="material-icons-outlined bg-light text-dark">straighten</i>
                        {{ $property->size_sqft }} Sq Ft
                    </li>
                </ul>
            </div>
        </div>
    </div> <!-- end card -->
</div> <!-- end col -->
