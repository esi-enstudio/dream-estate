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
            @include('livewire.property.rent.partials.topbar-filter')

            <div class="row">
                <!-- Sidebar filter area -->
                @include('livewire.property.rent.partials.sidebar-filter', ['limit' => 4])

                <!-- Content area -->
                <div class="col-lg-9">
                    <div class="row mb-4">

                        <!-- property card -->
                        @forelse($properties as $property)
                            @if ($viewMode === 'list')
                                @include('livewire.property.rent.partials.property-card-list', ['property' => $property])
                            @else
                                @include('livewire.property.rent.partials.property-card-grid', ['property' => $property])
                            @endif
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


        document.addEventListener('alpine:init', () => {
            // priceRangeSlider কম্পোনেন্ট
            Alpine.data('priceRangeSlider', (config) => ({
                // Livewire থেকে আসা entangled প্রপার্টি
                from: config.from,
                to: config.to,

                // স্ট্যাটিক কনফিগারেশন
                min: config.min || 0,
                max: config.max || 1000000,
                prefix: config.prefix || '$',

                // অভ্যন্তরীণ state
                sliderInstance: null,

                // ডিসপ্লে টেক্সট তৈরি করার জন্য একটি "getter"
                get displayRange() {
                    // Intl.NumberFormat ব্যবহার করে সংখ্যাকে কমা সহ সুন্দরভাবে ফরম্যাট করা হচ্ছে
                    const formattedFrom = new Intl.NumberFormat().format(this.from || this.min);
                    const formattedTo = new Intl.NumberFormat().format(this.to || this.max);
                    return `${this.prefix}${formattedFrom} - ${this.prefix}${formattedTo}`;
                },

                // ইনিশিয়ালাইজেশন ফাংশন
                init() {
                    this.sliderInstance = $(this.$refs.slider).ionRangeSlider({
                        skin: "flat",
                        type: 'double',
                        min: this.min,
                        max: this.max,
                        from: this.from,
                        to: this.to,
                        onFinish: (data) => {
                            // স্লাইডার পরিবর্তন শেষ হলে Livewire-কে আপডেট করুন
                            this.from = data.from;
                            this.to = data.to;
                        }
                    }).data("ionRangeSlider");

                    // Livewire বা URL থেকে আসা পরিবর্তনে স্লাইডারকে দৃশ্যত আপডেট করার জন্য
                    this.$watch('from', (newValue) => {
                        if (this.sliderInstance && newValue !== this.sliderInstance.result.from) {
                            this.sliderInstance.update({ from: newValue });
                        }
                    });

                    this.$watch('to', (newValue) => {
                        if (this.sliderInstance && newValue !== this.sliderInstance.result.to) {
                            this.sliderInstance.update({ to: newValue });
                        }
                    });

                    // Livewire-এর রিসেট ফিল্টার ইভেন্ট শোনার জন্য
                    Livewire.on('reset-price-slider', () => {
                        if (this.sliderInstance) {
                            this.sliderInstance.reset();
                        }
                    });
                },
            }));

            //Select2 Bridge কম্পোনেন্ট
            Alpine.data('select2Alpine', (config) => ({
                // Livewire থেকে entangled মডেল
                model: config.model,
                // Livewire প্রপার্টির নাম
                livewireModel: config.livewireModel,
                // নতুন: সার্চ ফিল্ড দেখানো হবে কিনা তা নিয়ন্ত্রণ করার জন্য
                showSearch: config.showSearch === undefined ? true : config.showSearch,

                // Select2 ইনিশিয়ালাইজেশন
                init() {
                    // Select2 অপশনগুলো একটি অবজেক্টে রাখা হলো
                    let select2Options = {
                        width: '100%'
                    };
                    // const select2 = $(this.$refs.select).select2({
                    //     width: '100%'
                    // });

                    // যদি showSearch false হয়, তাহলে সার্চ ফিল্ড 숨ানোর অপশন যোগ করুন
                    if (!this.showSearch) {
                        select2Options.minimumResultsForSearch = Infinity;
                    }

                    const select2 = $(this.$refs.select).select2(select2Options);

                    // Alpine.nextTick নিশ্চিত করে যে DOM সম্পূর্ণভাবে প্রস্তুত হওয়ার পর এই কোডটি রান হবে
                    Alpine.nextTick(() => {
                        // Livewire থেকে আসা প্রাথমিক মান দিয়ে Select2-কে আপডেট করুন
                        select2.val(this.model).trigger('change');
                    });

                    // Select2 থেকে একটি অপশন সিলেক্ট করা হলে
                    select2.on('select2:select', (e) => {
                        const selectedValue = e.params.data.id;
                        // Livewire কম্পোনেন্টকে ম্যানুয়ালি আপডেট করার জন্য বলা হচ্ছে
                        @this.set(this.livewireModel, selectedValue);
                    });

                    // Livewire থেকে আসা পরবর্তী পরিবর্তনে Select2-কে দৃশ্যত আপডেট করার জন্য
                    this.$watch('model', (newValue) => {
                        if (newValue !== $(this.$refs.select).val()) {
                            $(this.$refs.select).val(newValue).trigger('change');
                        }
                    });

                    // Livewire-এর রিসেট ফিল্টার ইভেন্ট শোনার জন্য
                    // Livewire.on('reset-filters-select2', () => {
                    //     $(this.$refs.select).val('').trigger('change');
                    // });
                },
            }));
        });
    </script>
@endpush
