<section class="features-section section-padding bg-light position-relative">
    <div class="container">
        <!-- Section Heading -->
        <div class="section-heading aos" data-aos="fade-down">
            <h2 class="mb-2 text-center">Featured Properties</h2>
            <div class="sec-line"><span class="sec-line1"></span><span class="sec-line2"></span></div>
            <p class="mb-0 text-center">Hand-picked selection of quality places</p>
        </div>

        @if($this->featuredProperties->isNotEmpty())
            <div class="feature-slider-item features-slider position-none">
                {{-- প্রতিটি chunk (২টি প্রপার্টির গ্রুপ) একটি স্লাইড আইটেম হবে --}}
                @foreach($this->featuredProperties as $propertiesChunk)
                    <div class="features-slide-card">
                        {{-- প্রতিটি প্রপার্টির জন্য কার্ড রেন্ডার করা হচ্ছে --}}
                        @foreach($propertiesChunk as $property)
                            <div class="d-flex aos" data-aos="fade-down" data-aos-duration="1000">
                                @include('livewire.property.rent.partials.property-card-grid', ['property' => $property])
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="text-center d-flex align-items-center justify-content-center m-auto mt-5">
                <a href="{{ route('listing.rent') }}" class="btn btn-lg btn-dark d-flex align-items-center gap-1">
                    Explore All Properties <i class="material-icons-outlined">arrow_forward</i>
                </a>
            </div>
        @endif
    </div>
</section>
