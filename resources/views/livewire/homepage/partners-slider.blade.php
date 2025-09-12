<section class="partners-section section-padding">
    <div class="container">
        <!-- Section Heading -->
        <div class="section-heading aos" data-aos="fade-down">
            <h2 class="mb-2 text-center">Hundreds of Partners Around the World</h2>
            <div class="sec-line"><span class="sec-line1"></span><span class="sec-line2"></span></div>
            <p class="mb-0 text-center">Every day, we build trust through communication, transparency, and results.</p>
        </div>

        @if($this->partners->isNotEmpty())
            <div class="partners-slide-item partners-slider">
                @foreach($this->partners as $partner)
                    <div class="partners-slide aos" data-aos="fade-right">
                        <div class="partners-items">
                            {{-- যদি পার্টনারের ওয়েবসাইট লিঙ্ক থাকে, তাহলে লোগোটিকে লিঙ্ক বানান --}}
                            @if($partner->website_url)
                                <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" title="{{ $partner->name }}">
                                    <img src="{{ $partner->getFirstMediaUrl('logos') }}" alt="{{ $partner->name }} Logo" class="img-fluid partners-icon">
                                </a>
                            @else
                                <img src="{{ $partner->getFirstMediaUrl('logos') }}" alt="{{ $partner->name }} Logo" class="img-fluid partners-icon">
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
