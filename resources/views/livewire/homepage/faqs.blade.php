<section class="faq-section section-padding bg-light">
    <div class="container">
        <!-- Section Heading -->
        <div class="section-heading aos" data-aos="fade-down">
            <h2 class="mb-2 text-center">Frequently Asked Questions</h2>
            <div class="sec-line"><span class="sec-line1"></span><span class="sec-line2"></span></div>
            <p class="mb-0 text-center">Ready to buy your dream home? Find it here.</p>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-0">
                    <div class="card-body">
                        {{-- ক্যাটাগরি অনুযায়ী লুপ চালানো হচ্ছে --}}
                        @foreach($this->faqs as $category => $faqItems)
                            <div class="faq-category-group {{ !$loop->first ? 'mt-4' : '' }}">
                                <h5 class="mb-4">{{ ucfirst($category) }} FAQ’s</h5>
                                <div class="accordion accordions-items-seperate faq-accordion m-0" id="faq-accordion-{{ $category }}">
                                    @foreach($faqItems as $faq)
                                        <div class="accordion-item aos" data-aos="fade-down">
                                            <div class="accordion-header">
                                                <button class="accordion-button {{ !$loop->first ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq-{{ $faq->id }}">
                                                    {{ $faq->question }}
                                                </button>
                                            </div>
                                            <div id="faq-{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faq-accordion-{{ $category }}">
                                                <div class="accordion-body">
                                                    {{-- Rich Editor থেকে আসা HTML রেন্ডার করার জন্য {!! !!} ব্যবহার করুন --}}
                                                    {!! $faq->answer !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
