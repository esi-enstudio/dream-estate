<section class="partners-section section-padding">
    <div class="container">
        <!-- Section Heading -->
        <div class="section-heading aos" data-aos="fade-down">
            <h2 class="mb-2 text-center">“আমাদের সম্মানিত পার্টনাররা”</h2>
            <div class="sec-line"><span class="sec-line1"></span><span class="sec-line2"></span></div>
            <p class="mb-0 text-center">রিয়েল এস্টেট খাতে নির্ভরযোগ্য সেবা দিতে আমরা কাজ করছি আমাদের বিশ্বস্ত পার্টনারদের সাথে একসাথে।</p>
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
        @else
            <p class="text-center" style="font-weight: bold">এই মুহূর্তে আমাদের কোন পার্টনার নেই।</p>
        @endif
    </div>
</section>
