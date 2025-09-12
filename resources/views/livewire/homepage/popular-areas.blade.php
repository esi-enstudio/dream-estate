<section class="cities-section section-padding">
    <div class="container">
        <!-- Section Heading -->
        <div class="section-heading aos" data-aos="fade-down">
            <h2 class="mb-2 text-center">Cities With Listing</h2>
            <div class="sec-line"><span class="sec-line1"></span><span class="sec-line2"></span></div>
            <p class="mb-0 text-center">Destinations we love the most</p>
        </div>

        @if($this->areas->isNotEmpty())
            <div class="cities-slider">
                {{-- আপনার ডিজাইনে প্রতি স্লাইডে ২টি করে আইটেম আছে, তাই আমরা কালেকশনটিকে chunk করছি --}}
                @foreach($this->areas->chunk(2) as $areaChunk)
                    <div class="city-items-slide">
                        @foreach($areaChunk as $area)
                            <!-- Inner Item -->
                            <div class="city-item position-relative {{ !$loop->last ? 'mb-4' : '' }} aos" data-aos="fade-down">
                                <div class="city-img position-relative">
                                    {{-- ডাইনামিক ইমেজ --}}
                                    <img src="{{ $this->getAreaImage($area->address_area) }}" alt="Photo of {{ $area->address_area }}" class="img-fluid">
                                </div>
                                <div class="city-name">
                                    {{-- ডাইনামিক এলাকার নাম --}}
                                    <h5 class="mb-1">{{ $area->address_area }}</h5>
                                    {{-- ডাইনামিক প্রপার্টি কাউন্ট --}}
                                    <p class="mb-0">{{ $area->properties_count }} Propert{{ $area->properties_count > 1 ? 'ies' : 'y' }}</p>
                                </div>
                                <div class="arrow-overlay">
                                    {{-- ডাইনামিক লিঙ্ক --}}
                                    <a href="{{ route('listing.rent', ['search' => $area->address_area]) }}">
                                        <i class='fa-solid fa-arrow-right'></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
