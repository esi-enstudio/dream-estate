<div class="col-lg-6 col-md-6 d-flex">
    <div class="property-card flex-fill">
        <div class="property-listing-item p-0 mb-0 shadow-none">
            <div class="buy-grid-img mb-0 rounded-0">
                <a href="{{ route('listing.details', $property->slug) }}">
                    <img class="img-fluid" src="{{ $property->getFirstMediaUrl('featured_image', 'thumbnail') }}" alt="{{ $property->title }}">
                </a>
                <div class="d-flex align-items-center justify-content-between position-absolute top-0 start-0 end-0 p-3 z-1">
                    <div class="d-flex align-items-center gap-2">
                        @if($property->created_at->gt(now()->subDays(7)))
                            <div class="badge badge-sm bg-danger d-flex align-items-center">
                                <i class="material-icons-outlined">offline_bolt</i>New
                            </div>
                        @endif
                        @if($property->is_featured)
                            <div class="badge badge-sm bg-orange d-flex align-items-center">
                                <i class="material-icons-outlined">loyalty</i>Featured
                            </div>
                        @endif
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between position-absolute bottom-0 end-0 start-0 p-3 z-1">
                    <h6 class="text-white mb-0">৳{{ number_format($property->rent_price) }} <span class="fs-14 fw-normal">/ {{ ucfirst($property->rent_type) }}</span></h6>
                    <a href="javascript:void(0)" class="favourite">
                        <i class="material-icons-outlined">favorite_border</i>
                    </a>
                </div>
            </div>
            <div class="buy-grid-content">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center justify-content-center">
                        @if($property->reviews_count > 0)
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="material-icons-outlined text-warning {{ $i > round($property->average_rating) ? 'opacity-25' : '' }}">star</i>
                            @endfor
                            <span class="ms-1 fs-14">{{ number_format($property->average_rating, 1) }} ({{ $property->reviews_count }} Reviews)</span>
                        @else
                            <span class="ms-1 fs-14">No Reviews Yet</span>
                        @endif
                    </div>
                    <span class="badge bg-secondary">{{ $property->propertyType->name_bn ?? 'N/A' }}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <h6 class="title mb-1">
                            <a href="{{ route('listing.details', $property->slug) }}">{{ $property->title }}</a>
                        </h6>
                        <p class="d-flex align-items-center fs-14 mb-0"><i class="material-icons-outlined me-1 ms-0">location_on</i>{{ $property->address_area }}, {{ $property->address_city }}</p>
                    </div>
                </div>
                <ul class="d-flex buy-grid-details bg-light rounded p-3 justify-content-between align-items-center flex-wrap gap-1 mb-3">
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
                            <img src="{{ $property->user->avatar_url ?? asset('assets/img/users/default-avatar.png') }}" alt="{{ $property->user->name }}" class="rounded-circle">
                        </div>
                        <h6 class="mb-0 fs-16 fw-medium text-dark">{{ $property->user->name }}</h6>
                    </div>
                    <a href="{{ route('listing.details', $property->slug) }}" class="btn btn-dark">Details</a>
                </div>
            </div>
        </div>
    </div>
</div>
