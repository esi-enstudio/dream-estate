<div class="row row-gap-4">
    <div class="col-md-6 col-lg-3">
        <div class="about-us-item-02">
            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/img/about-us/listing.svg') }}" alt="" class="img-fluid me-3">
                <div>
                    <h4 class="mb-1">{{ $this->formatNumber($listingsAdded) }}</h4>
                    <p class="mb-0">Listings Added</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="about-us-item-02">
            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/img/about-us/agents.svg') }}" alt="" class="img-fluid me-3">
                <div>
                    <h4 class="mb-1">{{ $this->formatNumber($agentsListed) }}+</h4>
                    <p class="mb-0">Agents Listed</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="about-us-item-02">
            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/img/about-us/sales.svg') }}" alt="" class="img-fluid me-3">
                <div>
                    <h4 class="mb-1">{{ $this->formatNumber($salesCompleted) }}+</h4>
                    <p class="mb-0">Sales Completed</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="about-us-item-02">
            <div class="d-flex align-items-center">
                <img src="{{ asset('assets/img/about-us/users.svg') }}" alt="" class="img-fluid me-3">
                <div>
                    <h4 class="mb-1">{{ $this->formatNumber($totalUsers) }}+</h4>
                    <p class="mb-0">Users Joined</p>
                </div>
            </div>
        </div>
    </div>
</div>
