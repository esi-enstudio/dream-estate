<section class="home-property-section section-padding bg-dark position-relative overflow-hidden">
    <div class="container">

        <!-- start row -->
        <div class="row position-relative">
            <div class="col-lg-4 aos" data-aos="fade-down" data-aos-duration="1000">
                <!-- start title -->
                <div class="section-heading">
                    <h2 class="mb-2 text-lg-start text-center text-white">Explore by  <span class="d-lg-block "> Property Type </span></h2>
                    <div class="sec-line justify-content-lg-start">
                        <span class="sec-line1"></span>
                        <span class="sec-line2"></span>
                    </div>
                    <p class="mb-0 text-lg-start text-center text-light">Whether you're looking for a cozy apartment, a luxurious villa, or a commercial investment, we’ve got you covered.</p>
                </div>
                <!-- end title -->
            </div>

            <div class="col-lg-8">
                <div class="property-slider">
                    @foreach($this->propertyTypes as $type)
{{--                        {{ dump($type) }}--}}
                    <div class="property-item aos" data-aos="fade-up" data-aos-duration="1000">
                        <div class="property-card-item">
                            <div class="mb-3 text-center">
                                <img src="{{ Storage::url($type->icon_path) }}" alt="{{ $type->name_en }} icon" class="m-auto">
                            </div>
                            <h5 class="mb-1">{{ $type->name_en }}</h5>
                            <p class="mb-0">{{ $type->properties_count }} Propert{{ $type->properties_count > 1 ? 'ies' : 'y' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- end row -->

    </div>

    <!-- element img -->
    <img src="{{ asset('assets/img/home/icons/property-element-1.svg') }}" alt="property-element-0" class="img-fluid custom-element-img-1 d-lg-block d-none">
    <img src="{{ asset('assets/img/home/icons/property-element-2.svg') }}" alt="property-element-0" class="img-fluid custom-element-img-2 d-lg-block d-none">
</section>
