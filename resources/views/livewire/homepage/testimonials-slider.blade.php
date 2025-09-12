<section class="testimonials-section section-padding">
    <div class="container">
        <!-- Section Heading -->
        <div class="section-heading aos" data-aos="fade-down">
            <h2 class="mb-2 text-center text-white">Testimonials</h2>
            <div class="sec-line"><span class="sec-line1"></span><span class="sec-line2"></span></div>
            <p class="mb-0 text-center text-light">What our happy client says</p>
        </div>

        @if($this->testimonials->isNotEmpty())
            <div class="testimonials-slider-item testimonials-slider">
                @foreach($this->testimonials as $testimonial)
                    <div class="testimonials-slide">
                        <div class="testimonials-item aos" data-aos="fade-down">
                            <div class="avatar avatar-lg mb-4">
                                <img src="{{ $testimonial->getFirstMediaUrl('avatars') }}" alt="{{ $testimonial->client_name }}" class="img-fluid rounded-circle">
                            </div>
                            <p class="mb-2">"{{ $testimonial->quote }}"</p>
                            <h6 class="mb-2">{{ $testimonial->client_name }}</h6>
                            <div class="d-flex align-items-center justify-content-center">
                                @for ($i = 1; $i <= $testimonial->rating; $i++)
                                    <i class="material-icons-outlined text-warning">star</i>
                                @endfor
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
