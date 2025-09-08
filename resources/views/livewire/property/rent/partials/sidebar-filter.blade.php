<div class="col-lg-3 theiaStickySidebar">
    <div class="filter-sidebar rent-grid-sidebar-item-02 mb-lg-0">
        <div class="filter-head d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Filter</h5>
            <a href="#" wire:click.prevent="resetFilters" class="text-danger font-bold">Reset</a>
        </div>
        <div class="filter-body">

            <!-- Input and Select -->
            <div class="filter-set">
                <div class="d-flex align-items-center">
                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#search" aria-expanded="false" role="button">
                        <h6 class="d-inline-flex align-items-center mb-0"><i class="material-icons-outlined me-2 text-secondary">search</i>Search</h6>
                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                    </div>
                </div>
                <div id="search" class="card-collapse collapse show mt-3">

                    <!-- Search -->
                    <div class="input-group input-group-flat mb-3">
                            <span class="input-group-text border-0">
                                <i class="material-icons-outlined">search</i>
                            </span>
                        <input wire:model.live.debounce.500ms="search" type="text" class="form-control" placeholder="Search here...">
                    </div>

                    <!-- Purpose -->
                    <div class="mb-2"
                         wire:ignore
                         x-data="select2Alpine({
                             model: @entangle('purpose'),
                             livewireModel: 'purpose',
                             showSearch: false
                         })"
                         x-init="init()"
                    >
                        <label class="form-label mb-1">Purpose</label>
                        <select class="select" x-ref="select">
                            <option value="">Any</option>
                            <option value="rent">Rent</option>
                            <option value="sell">Sell</option>
                        </select>
                    </div>

                    <!-- Rent Type -->
                    <div class="mb-2"
                         wire:ignore
                         x-data="select2Alpine({
                             model: @entangle('rent_type'),
                             livewireModel: 'rent_type',
                             showSearch: false
                         })"
                         x-init="init()"
                    >
                        <label class="form-label mb-1">Rent Type</label>
                        <select class="select" x-ref="select">
                            <option value="">Any</option>
                            <option value="day">Day</option>
                            <option value="week">Week</option>
                            <option value="month">Month</option>
                            <option value="year">Year</option>
                        </select>
                    </div>

                    <!-- Negotiable -->
                    <div class="mb-2"
                         wire:ignore
                         x-data="select2Alpine({
                             model: @entangle('is_negotiable'),
                             livewireModel: 'is_negotiable',
                             showSearch: false
                         })"
                         x-init="init()"
                    >
                        <label class="form-label mb-1">Negotiable</label>
                        <select class="form-select" x-ref="select">
                            <option value="">Any</option>
                            <option value="negotiable">Negotiable</option>
                            <option value="fixed">Fixed</option>
                        </select>
                    </div>

                    <!-- Bedrooms -->
                    <div class="mb-2"
                         wire:ignore
                         x-data="select2Alpine({
                             model: @entangle('bedrooms'),
                             livewireModel: 'bedrooms',
                             showSearch: false
                         })"
                         x-init="init()"
                    >
                        <label class="form-label mb-1">No of Bedrooms</label>
                        <select class="form-select" x-ref="select">
                            <option value="">Any</option>
                            @for($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }}</option> @endfor
                        </select>
                    </div>

                    <!-- Bathrooms -->
                    <div class="mb-2"
                         wire:ignore
                         x-data="select2Alpine({
                             model: @entangle('bathrooms'),
                             livewireModel: 'bathrooms',
                             showSearch: false
                         })"
                         x-init="init()"
                    >
                        <label class="form-label mb-1">No of Bathrooms</label>
                        <select class="form-select" x-ref="select">
                            <option value="">Any</option>
                            @for($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }}</option> @endfor
                        </select>
                    </div>

                    <!-- Balconies -->
                    <div class="mb-2"
                         wire:ignore
                         x-data="select2Alpine({
                             model: @entangle('balconies'),
                             livewireModel: 'balconies',
                             showSearch: false
                         })"
                         x-init="init()"
                    >
                        <label class="form-label mb-1">No of Balconies</label>
                        <select class="form-select" x-ref="select">
                            <option value="">Any</option>
                            @for($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }}</option> @endfor
                        </select>
                    </div>

                    <!-- Floor Level -->
                    <div class="mb-2"
                         wire:ignore
                         x-data="select2Alpine({
                             model: @entangle('floor_level'),
                             livewireModel: 'floor_level',
                             showSearch: false
                         })"
                         x-init="init()"
                    >
                        <label class="form-label mb-1">Floor Level</label>
                        <select class="form-select" x-ref="select">
                            <option value="">Any</option>
                            @for($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ $i }}</option> @endfor
                        </select>
                    </div>

                    <!-- Total Floor -->
                    <div class="mb-2"
                         wire:ignore
                         x-data="select2Alpine({
                             model: @entangle('total_floors'),
                             livewireModel: 'total_floors',
                             showSearch: false
                         })"
                         x-init="init()"
                    >
                        <label class="form-label mb-1">Total Floor</label>
                        <select class="form-select" x-ref="select">
                            <option value="">Any</option>
                            @for($i = 1; $i <= 20; $i++) <option value="{{ $i }}">{{ $i }}</option> @endfor
                        </select>
                    </div>

                    <div>
                        <label class="form-label mb-1"> Min Sqft </label>
                        <div class="input-group input-group-flat mb-0">
                            <input wire:model.live.debounce.1000ms="size_sqft" type="number" class="form-control" placeholder="Search here...">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional -->
            <div class="filter-set">
                <div class="d-flex align-items-center">
                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#additional" aria-expanded="false" role="button">
                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">category</i>Additional</h6>
                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                    </div>
                </div>
                <div id="additional" class="card-collapse collapse show mt-3">
                    <div>
                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                            <input wire:model.live="is_featured" class="form-check-input ms-0 mt-0" type="checkbox" id="is_featured">
                            <label class="form-check-label ms-2" for="is_featured">
                                Featured
                            </label>
                        </div>

                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                            <input wire:model.live="is_trending" class="form-check-input ms-0 mt-0" type="checkbox" id="is_trending">
                            <label class="form-check-label ms-2" for="is_trending">
                                Trending (45)
                            </label>
                        </div>

                        <div class="form-check d-flex align-items-center ps-0 mb-2">
                            <input wire:model.live="is_verified" class="form-check-input ms-0 mt-0" type="checkbox" id="is_verified">
                            <label class="form-check-label ms-2" for="is_verified">
                                Verified
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Property Type -->
            @if($this->allPropertyTypes && $this->allPropertyTypes->isNotEmpty())
                {{-- Alpine.js শুধুমাত্র open/close অবস্থা নিয়ন্ত্রণ করবে --}}
                <div class="filter-set" x-data="{ open: false }">
                    <div class="d-flex align-items-center">
                        <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#propertyTypeCollapse">
                            <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">category</i>Property Type</h6>
                            <i class="material-icons-outlined expand-arrow">expand_less</i>
                        </div>
                    </div>
                    <div id="propertyTypeCollapse" class="card-collapse collapse show mt-3">
                        <div>
                            @foreach($this->allPropertyTypes as $type)
                                {{-- Blade কন্ডিশনটি এখন সার্ভার থেকে আসা PHP ভ্যারিয়েবল $limit ব্যবহার করবে --}}
                                <div class="form-check d-flex align-items-center ps-0 mb-2"
                                     @if($loop->iteration > $limit) x-show="open" x-transition @endif>
                                    <input class="form-check-input ms-0 mt-0" type="checkbox" value="{{ $type->id }}" id="type_{{ $type->id }}" wire:model.live="propertyTypes">
                                    <label class="form-check-label ms-2" for="type_{{ $type->id }}">
                                        {{ $type->name_bn }} ({{ $type->properties_count }})
                                    </label>
                                </div>
                            @endforeach

                            {{-- Blade কন্ডিশনটি এখন সার্ভার থেকে আসা PHP ভ্যারিয়েবল $limit ব্যবহার করবে --}}
                            @if($this->allPropertyTypes->count() > $limit)
                                <div class="view-all d-inline-flex align-items-center">
                                    <a href="javascript:void(0);" @click="open = !open" class="viewall-button text-secondary">
                                        <span x-text="open ? 'See Less' : 'See More'"></span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
{{--            <div class="filter-set">--}}
{{--                <div class="d-flex align-items-center">--}}
{{--                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#propertyType" aria-expanded="false" role="button">--}}
{{--                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">category</i>Property Type</h6>--}}
{{--                        <i class="material-icons-outlined expand-arrow">expand_less</i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div id="propertyType" class="card-collapse collapse show mt-3">--}}
{{--                    <div>--}}
{{--                        <div class="form-check d-flex align-items-center ps-0 mb-2">--}}
{{--                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_1">--}}
{{--                            <label class="form-check-label ms-2" for="check_1">--}}
{{--                                Apartments (45)--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="more-menu mt-2">--}}
{{--                            <div class="form-check d-flex align-items-center ps-0 mb-2">--}}
{{--                                <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_3">--}}
{{--                                <label class="form-check-label ms-2" for="check_3">--}}
{{--                                    Houses (24)--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="view-all d-inline-flex align-items-center">--}}
{{--                            <a href="javascript:void(0);" class="viewall-button text-secondary">See More</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <!-- Tenant Type -->
            @if($this->allTenantTypes && $this->allTenantTypes->isNotEmpty())
                {{-- Alpine.js শুধুমাত্র open/close অবস্থা নিয়ন্ত্রণ করবে --}}
                <div class="filter-set" x-data="{ open: false }">
                    <div class="d-flex align-items-center">
                        <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#tenantTypeCollapse">
                            <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">person</i>Tenant Type</h6>
                            <i class="material-icons-outlined expand-arrow">expand_less</i>
                        </div>
                    </div>
                    <div id="tenantTypeCollapse" class="card-collapse collapse show mt-3">
                        <div>
                            @foreach($this->allTenantTypes as $tenant)
                                {{-- Blade কন্ডিশনটি এখন সার্ভার থেকে আসা PHP ভ্যারিয়েবল $limit ব্যবহার করবে --}}
                                <div class="form-check d-flex align-items-center ps-0 mb-2"
                                     @if($loop->iteration > $limit) x-show="open" x-transition @endif>
                                    <input class="form-check-input ms-0 mt-0" type="checkbox" value="{{ $tenant->id }}" id="tenant_{{ $tenant->id }}" wire:model.live="tenantTypes">
                                    <label class="form-check-label ms-2" for="tenant_{{ $tenant->id }}">
                                        {{ $tenant->name }} ({{ $tenant->properties_count }})
                                    </label>
                                </div>
                            @endforeach

                            {{-- Blade কন্ডিশনটি এখন সার্ভার থেকে আসা PHP ভ্যারিয়েবল $limit ব্যবহার করবে --}}
                            @if($this->allTenantTypes->count() > $limit)
                                <div class="view-all d-inline-flex align-items-center">
                                    <a href="javascript:void(0);" @click="open = !open" class="viewall-button text-secondary">
                                        <span x-text="open ? 'See Less' : 'See More'"></span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
{{--            <div class="filter-set">--}}
{{--                <div class="d-flex align-items-center">--}}
{{--                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#tenantType" aria-expanded="false" role="button">--}}
{{--                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">category</i>Tenant Type</h6>--}}
{{--                        <i class="material-icons-outlined expand-arrow">expand_less</i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div id="tenantType" class="card-collapse collapse show mt-3">--}}
{{--                    <div>--}}
{{--                        <div class="form-check d-flex align-items-center ps-0 mb-2">--}}
{{--                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_1">--}}
{{--                            <label class="form-check-label ms-2" for="check_1">--}}
{{--                                Family (45)--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check d-flex align-items-center ps-0 mb-2">--}}
{{--                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_1">--}}
{{--                            <label class="form-check-label ms-2" for="check_1">--}}
{{--                                Bachelor Male (45)--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="more-menu mt-2">--}}
{{--                            <div class="form-check d-flex align-items-center ps-0 mb-2">--}}
{{--                                <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_3">--}}
{{--                                <label class="form-check-label ms-2" for="check_3">--}}
{{--                                    Sublet (24)--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="view-all d-inline-flex align-items-center">--}}
{{--                            <a href="javascript:void(0);" class="viewall-button text-secondary">See More</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <!-- Amenities -->
            @if($this->allAmenities && $this->allAmenities->isNotEmpty())
                {{-- Alpine.js শুধুমাত্র open/close অবস্থা নিয়ন্ত্রণ করবে --}}
                <div class="filter-set" x-data="{ open: false }">
                    <div class="d-flex align-items-center">
                        <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#amenitiesCollapse">
                            <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">cake</i>Amenities</h6>
                            <i class="material-icons-outlined expand-arrow">expand_less</i>
                        </div>
                    </div>
                    <div id="amenitiesCollapse" class="card-collapse collapse show mt-3">
                        <div>
                            @foreach($this->allAmenities as $amenity)
                                {{-- Blade কন্ডিশনটি এখন সার্ভার থেকে আসা PHP ভ্যারিয়েবল $limit ব্যবহার করছে --}}
                                <div class="form-check d-flex align-items-center ps-0 mb-2"
                                     @if($loop->iteration > $limit) x-show="open" x-transition @endif>
                                    <input class="form-check-input ms-0 mt-0" type="checkbox" value="{{ $amenity->id }}" id="amenity_{{ $amenity->id }}" wire:model.live="amenities">
                                    <label class="form-check-label ms-2" for="amenity_{{ $amenity->id }}">
                                        {{ $amenity->name }} ({{ $amenity->properties_count }})
                                    </label>
                                </div>
                            @endforeach

                            {{-- Blade কন্ডিশনটি এখন সার্ভার থেকে আসা PHP ভ্যারিয়েবল $limit ব্যবহার করছে --}}
                            @if($this->allAmenities->count() > $limit)
                                <div class="view-all d-inline-flex align-items-center">
                                    <a href="javascript:void(0);" @click="open = !open" class="viewall-button text-secondary">
                                        <span x-text="open ? 'See Less' : 'See More'"></span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

{{--            <div class="filter-set">--}}
{{--                <div class="d-flex align-items-center">--}}
{{--                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#amenities" aria-expanded="false" role="button">--}}
{{--                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">cake</i>Amenities</h6>--}}
{{--                        <i class="material-icons-outlined expand-arrow">expand_less</i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div id="amenities" class="card-collapse collapse show mt-3">--}}
{{--                    <div>--}}
{{--                        <div class="form-check d-flex align-items-center ps-0 mb-2">--}}
{{--                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_7">--}}
{{--                            <label class="form-check-label ms-2" for="check_7">--}}
{{--                                Backyard (34)--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="more-menu1 mt-2">--}}
{{--                            <div class="form-check d-flex align-items-center ps-0 mb-2">--}}
{{--                                <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_10">--}}
{{--                                <label class="form-check-label ms-2" for="check_10">--}}
{{--                                    Elevator (16)--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="view-all d-inline-flex align-items-center">--}}
{{--                            <a href="javascript:void(0);" class="viewall1-button text-secondary">See More</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <!-- Price -->
            <div class="filter-set"
                 x-data="priceRangeSlider({
                 from: @entangle('min_price').live,
                 to: @entangle('max_price').live,
                 min: 0,
                 max: 50000,
                 prefix: '৳'
             })"
                 x-init="init()"
            >
                <div class="d-flex align-items-center">
                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#priceCollapse">
                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">monetization_on</i>Price</h6>
                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                    </div>
                </div>
                <div id="priceCollapse" class="card-collapse collapse show mt-3">
                    <div>
                        {{-- wire:ignore খুবই গুরুত্বপূর্ণ, কারণ ion.rangeSlider এই div-টিকে নিয়ন্ত্রণ করবে --}}
                        <div class="filter-range" wire:ignore>
                            <input type="text" x-ref="slider">
                            <p class="mb-0">Range :
                                {{-- এই span-এর টেক্সট এখন Alpine.js দ্বারা ডাইনামিকভাবে আপডেট হবে --}}
                                <span class="text-dark" x-text="displayRange"></span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews -->
            <!-- Reviews -->
            <div class="filter-set">
                <div class="d-flex align-items-center">
                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#reviewsCollapse">
                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">auto_awesome</i>Reviews</h6>
                        <i class="material-icons-outlined expand-arrow">expand_less</i>
                    </div>
                </div>
                <div id="reviewsCollapse" class="card-collapse collapse show mt-3">
                    <div>
                        @for ($i = 5; $i >= 1; $i--)
                            {{-- ★★★★★ মূল সমাধান: $loop->last এর পরিবর্তে $i === 1 ব্যবহার করুন ★★★★★ --}}
                            <div class="form-check d-flex align-items-center ps-0 {{ $i === 1 ? 'mb-0' : 'mb-2' }}">
                                <input class="form-check-input ms-0 mt-0"
                                       type="checkbox"
                                       value="{{ $i }}"
                                       id="rating_{{ $i }}"
                                       wire:model.live="ratings">

                                <label class="form-check-label ms-2 d-flex align-items-center" for="rating_{{ $i }}">
                        <span class="review-star mb-0 d-flex align-items-center">
                            @for ($s = 1; $s <= $i; $s++)
                                <i class="material-icons text-warning">star</i>
                            @endfor
                        </span>
                                    <span class="ms-2 mb-0">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</span>
                                </label>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

{{--            <div class="filter-set">--}}
{{--                <div class="d-flex align-items-center">--}}
{{--                    <div class="d-flex justify-content-between w-100 filter-search-head" data-bs-toggle="collapse" data-bs-target="#reviews" aria-expanded="false" role="button">--}}
{{--                        <h6 class="mb-0 d-flex align-items-center"><i class="material-icons-outlined me-2 text-secondary">auto_awesome</i>Reviews</h6>--}}
{{--                        <i class="material-icons-outlined expand-arrow">expand_less</i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div id="reviews" class="card-collapse collapse show mt-3">--}}
{{--                    <div>--}}
{{--                        <div class="form-check d-flex align-items-center ps-0 mb-2">--}}
{{--                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_12">--}}
{{--                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_12">--}}
{{--														<span class="review-star mb-0 d-flex align-items-center">--}}
{{--                                                            <i class="material-icons text-warning">star</i>--}}
{{--                                                            <i class="material-icons text-warning">star</i>--}}
{{--                                                            <i class="material-icons text-warning">star</i>--}}
{{--                                                            <i class="material-icons text-warning">star</i>--}}
{{--                                                            <i class="material-icons text-warning">star</i>--}}
{{--                                                        </span>--}}
{{--                                <span class="ms-2 mb-0"> 5 Star </span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check d-flex align-items-center ps-0 mb-2">--}}
{{--                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_13">--}}
{{--                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_13">--}}
{{--														<span class="review-star mb-0 d-flex align-items-center">--}}
{{--                                                            <i class="material-icons text-warning">star</i>--}}
{{--                                                            <i class="material-icons text-warning">star</i>--}}
{{--                                                            <i class="material-icons text-warning">star</i>--}}
{{--                                                            <i class="material-icons text-warning">star</i>--}}
{{--                                                        </span>--}}
{{--                                <span class="ms-2 mb-0"> 4 Star </span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check d-flex align-items-center ps-0 mb-2">--}}
{{--                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_14">--}}
{{--                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_14">--}}
{{--                                                        <span class="review-star mb-0 d-flex align-items-center">--}}
{{--                                                        <i class="material-icons text-warning">star</i>--}}
{{--                                                        <i class="material-icons text-warning">star</i>--}}
{{--                                                        <i class="material-icons text-warning">star</i>--}}
{{--                                                    </span>--}}
{{--                                <span class="ms-2 mb-0"> 3 Star </span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check d-flex align-items-center ps-0 mb-2">--}}
{{--                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_15">--}}
{{--                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_15">--}}
{{--                                                        <span class="review-star mb-0 d-flex align-items-center">--}}
{{--                                                        <i class="material-icons text-warning">star</i>--}}
{{--                                                        <i class="material-icons text-warning">star</i>--}}
{{--                                                    </span>--}}
{{--                                <span class="ms-2 mb-0"> 2 Star </span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check d-flex align-items-center ps-0 mb-0">--}}
{{--                            <input class="form-check-input ms-0 mt-0" name="category" type="checkbox" id="check_16">--}}
{{--                            <label class="form-check-label ms-2 d-flex align-items-center" for="check_16">--}}
{{--														<span class="review-star mb-0 d-flex align-items-center">--}}
{{--                                                            <i class="material-icons text-warning">star</i>--}}
{{--                                                        </span>--}}
{{--                                <span class="ms-2 mb-0"> 1 Star </span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>

{{--        <div class="filter-footer">--}}
{{--            <a href="#" class="btn btn-dark w-100"> Apply Filter </a>--}}
{{--        </div>--}}
    </div>
</div>
