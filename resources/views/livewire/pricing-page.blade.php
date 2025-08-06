<div class="page-wrapper">

    <!-- Start Breadcrumb -->
    <div class="breadcrumb-bar">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-01.png') }}" alt="" class="breadcrumb-bg-01 d-none d-lg-block">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-02.png') }}" alt="" class="breadcrumb-bg-02 d-none d-lg-block">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-03.png') }}" alt="" class="breadcrumb-bg-03">
        <div class="row align-items-center text-center position-relative z-1">
            <div class="col-md-12 col-12 breadcrumb-arrow">
                <h1 class="breadcrumb-title">Pricing</h1>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <span>
                                    <i class="material-icons-outlined me-1">home</i>
                                </span>
                                Home
                            </a>
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">
                            Pricing
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <!-- Start Content -->
    <div class="content">

        <div class="container">

            <!-- start row -->
            <div class="row">
                <div class="col-lg-12 mx-auto">

                    <div class="pricing-item-01">
                        <ul class="nav nav-tabs nav-tabs-rounded nav-justified mb-3">
                            <li class="nav-item"><a class="nav-link active" href="#monthly" data-bs-toggle="tab">Monthly</a></li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="monthly">
                            <!-- start row -->
                            <div class="row row-gap-3">
                                @forelse ($monthlyPlans as $plan)
                                    <div class="col-lg-4">
                                    <div class="pricing-item-02 popular">
                                        @if($plan->is_popular)
                                            <span class="bookmark-sideright-ribbone-primary-right">
                                                <span>Most Popular</span>
                                            </span>
                                        @endif

                                        <div class="plan-head">
                                            <h4 class="mb-1">{{ $plan->name }}</h4>
                                            <p>{{ $plan->description }}</p>
                                        </div>

                                        <div class="plan-price">
                                            <h2>
                                                ৳{{ (int)$plan->price }}
                                                <span>/month</span>
                                            </h2>
                                            <hr>
                                        </div>

                                        <div class="plan-features">
                                            <h6>Key Features</h6>
                                            @if($plan->features)
                                                @foreach($plan->features as $feature)
                                                    <p>
                                                        <i class="material-icons-outlined">check_circle</i>
                                                        {{ $feature }}
                                                    </p>
                                                @endforeach
                                            @endif
                                        </div>

                                        <div class="plan-btn">
                                            <a href="{{ route('payment.initiate', $plan->slug) }}" class="btn btn-dark">Subscribe Now</a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <p class="text-center">
                                        No monthly plans available at the moment.
                                    </p>
                                @endforelse
                            </div>
                            <!-- end row -->
                        </div>
                    </div>

                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div>

    </div>
    <!-- End Content -->

</div>
