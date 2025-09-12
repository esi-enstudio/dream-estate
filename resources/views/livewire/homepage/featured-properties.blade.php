<section class="features-section section-padding bg-light position-relative">
    <div class="container">
        <!-- Section Heading -->
        <div class="section-heading aos" data-aos="fade-down">
            <h2 class="mb-2 text-center">
                {{ $purpose == 'rent' ? '✨ ভাড়ার জন্য নির্বাচিত প্রোপার্টি ✨' : '💎 আপনার জন্য বাছাই করা বিক্রির প্রোপার্টি 💎' }}
            </h2>
            <div class="sec-line"><span class="sec-line1"></span><span class="sec-line2"></span></div>
            <p class="mb-0 text-center">
                {{ $purpose == 'rent' ? 'সহজ শর্তে আরামদায়ক ও সুবিধাজনক লোকেশনে ভাড়া বাসা এখন এক ক্লিকেই।' : 'নিজের জন্য কিংবা বিনিয়োগের উদ্দেশ্যে বেছে নিন দারুণ সব প্রোপার্টি।' }}
            </p>
        </div>

        @if(!empty($properties))
            <div class="feature-slider-item features-slider position-none">
                @foreach($properties as $propertiesChunk)
                    <div class="features-slide-card">
                        @foreach($propertiesChunk as $property)
                            <div class="d-flex aos" data-aos="fade-down">
                                {{-- ★★★ হোমপেজের জন্য নতুন পার্শিয়াল ফাইল ব্যবহার করা হচ্ছে ★★★ --}}
                                @include('livewire.homepage.partials.featured-property-card', ['property' => $property])
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <div class="text-center d-flex align-items-center justify-content-center m-auto mt-5">
                {{-- ★★★★★ মূল সমাধান: ডাইনামিক লিঙ্ক ★★★★★ --}}
                <a href="{{ route('listing.rent', ['purpose' => $this->purpose]) }}" class="btn btn-lg btn-dark d-flex align-items-center gap-1">
                    Explore All <i class="material-icons-outlined">arrow_forward</i>
                </a>
            </div>
        @endif
    </div>
</section>
