<section class="how-work-section section-padding">
    <div class="container">
        <!-- Section Heading -->
        <div class="section-heading aos" data-aos="fade-down">
            <h2 class="mb-2 text-center">“কিভাবে কাজ করে”</h2>
            <div class="sec-line"><span class="sec-line1"></span><span class="sec-line2"></span></div>
            <p class="mb-0 text-center">আমাদের প্ল্যাটফর্ম ব্যবহার করে প্রোপার্টি খোঁজা, ভাড়া বা বিক্রির সহজ ধাপগুলো জেনে নিন।</p>
        </div>

        @if($this->steps->isNotEmpty())
            <div class="row">
                @foreach($this->steps as $step)
                    <div class="col-lg-4 d-flex aos" data-aos="fade-up" data-aos-duration="1000">
                        <div class="howit-work-item text-center aos-init aos-animate flex-fill" data-aos="fade-down" data-aos-duration="1200" data-aos-delay="100">
                            {{-- ডাইনামিক ব্যাকগ্রাউন্ড কালার এবং আইকন --}}
                            <div class="mb-3 {{ $step->background_color_class }} avatar avatar-md rounded-circle p-2">
                                <img src="{{ $step->getFirstMediaUrl('icons') }}" alt="{{ $step->title }} icon">
                            </div>
                            {{-- ডাইনামিক টাইটেল --}}
                            <h5 class="mb-3">{{ $step->title }}</h5>
                            {{-- ডাইনামিক বর্ণনা --}}
                            <p class="mb-0">{{ $step->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
