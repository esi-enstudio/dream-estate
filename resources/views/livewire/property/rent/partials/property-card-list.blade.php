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
