<section class="statistics-section section-padding bg-dark position-relative">
    <div class="container">
        <div class="d-flex align-items-center justify-content-lg-between justify-content-md-between justify-content-center flex-wrap gap-2">

            <!-- Listings Added -->
            <div class="statistics-item d-flex align-items-center gap-2 flex-wrap aos" data-aos="fade-down">
                <div><img src="{{ asset('assets/img/home/icons/stat-icon-1.svg') }}" alt="Listings Added" class="img-fluid stat-img"></div>
                <div>
                    {{-- ডাইনামিক সংখ্যা --}}
                    <h4 class="mb-1"><span wire:key="listings-added">{{ $this->formatNumber($listingsAdded) }}</span></h4>
                    <p class="mb-0">Listings Added</p>
                </div>
            </div>

            <!-- Agents Listed -->
            <div class="statistics-item d-flex align-items-center gap-2 flex-wrap aos" data-aos="fade-up">
                <div><img src="{{ asset('assets/img/home/icons/stat-icon-2.svg') }}" alt="Agents Listed" class="img-fluid stat-img"></div>
                <div>
                    {{-- ডাইনামিক সংখ্যা --}}
                    <h4 class="mb-1"><span wire:key="agents-listed">{{ $this->formatNumber($agentsListed) }}+</span></h4>
                    <p class="mb-0">Owner Listed</p>
                </div>
            </div>

            <!-- Sales Completed -->
            <div class="statistics-item d-flex align-items-center gap-2 flex-wrap aos" data-aos="fade-down">
                <div><img src="{{ asset('assets/img/home/icons/stat-icon-3.svg') }}" alt="Sales Completed" class="img-fluid stat-img"></div>
                <div>
                    {{-- ডাইনামিক সংখ্যা --}}
                    <h4 class="mb-1"><span wire:key="sales-completed">{{ $this->formatNumber($salesCompleted) }}+</span></h4>
                    <p class="mb-0">Rent Completed</p>
                </div>
            </div>

            <!-- Total Users -->
            <div class="statistics-item d-flex align-items-center gap-2 flex-wrap aos" data-aos="fade-up">
                <div><img src="{{ asset('assets/img/home/icons/stat-icon-4.svg') }}" alt="Users" class="img-fluid stat-img"></div>
                <div>
                    {{-- ডাইনামিক সংখ্যা --}}
                    <h4 class="mb-1"> <span wire:key="total-users">{{ $this->formatNumber($totalUsers) }}+</span></h4>
                    <p class="mb-0">Users</p>
                </div>
            </div>

        </div>
    </div>
    <!-- Element images অপরিবর্তিত থাকবে -->
    <img src="{{ asset('assets/img/home/icons/property-element-1.svg') }}" alt="" class="img-fluid custom-element-img-1 d-lg-block d-none">
    <img src="{{ asset('assets/img/home/icons/property-element-2.svg') }}" alt="" class="img-fluid custom-element-img-2 d-lg-block d-none">
</section>
