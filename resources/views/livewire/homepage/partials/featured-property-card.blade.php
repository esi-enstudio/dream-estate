<div class="property-card flex-fill {{ !$loop->last ? 'mb-4' : 'mb-0' }}">
    <div class="property-listing-item p-0 mb-0 shadow-none">
        <div class="buy-grid-img mb-0 rounded-0">
            {{-- ★★★ অবজেক্ট (`->`) এর পরিবর্তে অ্যারে (`['...']`) সিনট্যাক্স ★★★ --}}
            <a href="{{ route('listing.details', $property['slug']) }}">
                <img class="img-fluid" src="{{ $property['thumbnail_url'] }}" alt="{{ $property['title'] }}">
            </a>
            <div class="d-flex align-items-center justify-content-between position-absolute top-0 start-0 end-0 p-3 z-1">
                <div class="d-flex align-items-center gap-2">
                    {{-- Carbon অবজেক্ট ব্যবহার করার জন্য new \Carbon\Carbon() --}}
                    @if(new \Carbon\Carbon($property['created_at']) > now()->subDays(7))
                        <div class="badge badge-sm bg-danger d-flex align-items-center"><i class="material-icons-outlined">offline_bolt</i>New</div>
                    @endif
                    <div class="badge badge-sm bg-orange d-flex align-items-center"><i class="material-icons-outlined">loyalty</i>Featured</div>
                </div>
                <a href="javascript:void(0)" class="favourite"><i class="material-icons-outlined">favorite_border</i></a>
            </div>
            <div class="d-flex align-items-center justify-content-between position-absolute bottom-0 end-0 start-0 p-3 z-1">
                <h6 class="text-white mb-0">৳{{ number_format($property['rent_price']) }}</h6>
                <div class="user-avatar avatar avatar-md border rounded-circle">
                    <img src="{{ $property['user']['avatar_url'] ?? asset('assets/img/users/default-avatar.png') }}" alt="{{ $property['user']['name'] }}" class="rounded-circle">
                </div>
            </div>
        </div>
        <div class="buy-grid-content">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center justify-content-center">
                    @if($property['reviews_count'] > 0)
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="material-icons-outlined text-warning {{ $i > round($property['average_rating']) ? 'opacity-25' : '' }}">star</i>
                        @endfor
                        <span class="ms-1 fs-14">{{ number_format($property['average_rating'], 1) }} ({{ $property['reviews_count'] }} Reviews)</span>
                    @else
                        <span class="ms-1 fs-14">No Reviews Yet</span>
                    @endif
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div>
                    <h6 class="title mb-1">
                        <a href="{{ route('listing.details', $property['slug']) }}" title="{{ $property['title'] }}">
                            {{ \Illuminate\Support\Str::limit($property['title'], 30) }}
                        </a>
                    </h6>
                    <p class="d-flex align-items-center fs-14 mb-0"><i class="material-icons-outlined me-1 ms-0">location_on</i>{{ $property['address_street'] }} }}</p>
                </div>
            </div>
            <ul class="d-flex buy-grid-details bg-light rounded p-3 justify-content-between align-items-center flex-wrap gap-1 mb-3">
                <li class="d-flex align-items-center gap-1"><i class="material-icons-outlined bg-white text-secondary">bed</i>{{ $property['bedrooms'] }} Bed</li>
                <li class="d-flex align-items-center gap-1"><i class="material-icons-outlined bg-white text-secondary">bathtub</i>{{ $property['bathrooms'] }} Bath</li>
                <li class="d-flex align-items-center gap-1"><i class="material-icons-outlined bg-white text-secondary">straighten</i>{{ $property['size_sqft'] }} Sq Ft</li>
            </ul>
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-1">
                {{-- তারিখ ফরম্যাট করার জন্য Carbon ব্যবহার --}}
                <p class="fs-14 fw-medium text-dark mb-0">Listed: <span class="fw-medium text-body">{{ \Carbon\Carbon::parse($property['created_at'])->format('d M Y') }}</span></p>
                <p class="fs-14 fw-medium text-dark mb-0">Type: <span class="fw-medium text-body">{{ $property['property_type']['name_bn'] }}</span></p>
            </div>
        </div>
    </div>
</div>
