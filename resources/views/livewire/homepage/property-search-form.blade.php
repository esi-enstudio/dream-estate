<div class="home-search-1 home-search-2"
     x-data="homepageSearchForm()"
     x-init="initSelect2()">

    <ul class="nav nav-tabs justify-content-lg-start justify-content-center aos" data-aos="fade-up" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" data-bs-toggle="tab" href="#rent_property" role="tab" aria-controls="rent_property" aria-selected="false">
                <i class="material-icons-outlined me-2">king_bed</i>Rent Property
            </a>
        </li>
    </ul>

    <div class="tab-content aos" data-aos="fade-down" data-aos-duration="1000">

        <!-- Rent property search form  -->
        <div class="tab-pane fade show active" id="rent_property" role="tabpanel">
            <div class="search-item">
                <form x-on:submit.prevent="submitSearch" id="homepage-search-form">
                    <div class="d-flex align-items-bottom flex-wrap flex-lg-nowrap gap-3">
                        <!-- Property Type -->
                        <div class="flex-fill select-field w-100">
                            <label class="form-label">Property Type</label>
                            {{-- ★★★ name অ্যাট্রিবিউট যোগ করা হয়েছে ★★★ --}}
                            <select class="select" name="property_type_id">
                                <option value="">Select Type</option>
                                @foreach($this->allPropertyTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name_bn }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tenant Type -->
                        <div class="flex-fill select-field w-100">
                            <label class="form-label">Tenant Type</label>
                            <select class="select" name="tenant_type_id">
                                <option value="">Select Tenant</option>
                                @foreach($this->allTenantTypes as $tenant)
                                    <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Min Price -->
                        <div class="flex-fill select-field w-100">
                            <label class="form-label">Min Price</label>
                            <input name="min_price" type="number" class="form-control" placeholder="৳">
                        </div>

                        <!-- Max Price -->
                        <div class="flex-fill select-field w-100">
                            <label class="form-label">Max Price</label>
                            <input name="max_price" type="number" class="form-control" placeholder="৳">
                        </div>

                        <div class="custom-search-item d-flex align-items-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="material-icons-outlined">search</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function homepageSearchForm() {
            return {
                initSelect2() {
                    // Alpine.nextTick নিশ্চিত করে যে Livewire রেন্ডারিং শেষ হওয়ার পর Select2 ইনিশিয়ালাইজ হয়
                    Alpine.nextTick(() => {
                        $('#homepage-search-form .select').select2({
                            width: '100%',
                            minimumResultsForSearch: Infinity // সার্চ বক্স 숨ানোর জন্য
                        });
                    });
                },
                submitSearch(event) {
                    const form = event.target;
                    const formData = new FormData(form);
                    const params = new URLSearchParams();

                    // FormData থেকে ডেটা নিয়ে URL প্যারামিটার তৈরি করুন
                    for (const [key, value] of formData.entries()) {
                        if (value) { // শুধুমাত্র যে 필্ডগুলোতে মান আছে সেগুলো যোগ করুন
                            // PropertiesPage-এর সাথে মিলিয়ে কী-গুলোকে পরিবর্তন করুন
                            if (key === 'property_type_id') {
                                params.append('propertyTypes[]', value);
                            } else if (key === 'tenant_type_id') {
                                params.append('tenantTypes[]', value);
                            } else {
                                params.append(key, value);
                            }
                        }
                    }

                    // চূড়ান্ত URL তৈরি করুন এবং রিডাইরেক্ট করুন
                    const destination = "{{ route('listing.rent') }}";
                    const queryString = params.toString();

                    window.location.href = queryString ? `${destination}?${queryString}` : destination;
                }
            }
        }

        // Livewire কম্পোনেন্ট সোয়াপ হওয়ার পর Select2 আবার ইনিশিয়ালাইজ করার জন্য
        document.addEventListener('livewire:navigated', () => {
            if (typeof $('#homepage-search-form .select').select2 === 'function') {
                $('#homepage-search-form .select').select2({
                    width: '100%',
                    minimumResultsForSearch: Infinity
                });
            }
        });
    </script>
@endpush
