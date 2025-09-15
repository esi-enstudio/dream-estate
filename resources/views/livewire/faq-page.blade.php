<div class="page-wrapper">
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-01.png') }}" alt="" class="breadcrumb-bg-01 d-none d-lg-block">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-02.png') }}" alt="" class="breadcrumb-bg-02 d-none d-lg-block">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-03.png') }}" alt="" class="breadcrumb-bg-03">
        <div class="row align-items-center text-center position-relative z-1">
            <div class="col-md-12 col-12 breadcrumb-arrow">
                <h1 class="breadcrumb-title">FAQ</h1>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><span><i class="material-icons-outlined me-1">home</i></span>Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="container">
            <div class="row" id="cart-wrap">
                <div class="col-lg-12 mx-auto">
                    <div class="cart-item-wrap">
                        <div class="row row-gap-3">

                            {{-- সাইডবার (ডাইনামিক) --}}
                            <div class="col-lg-3">
                                <div class="card faq-sidebar mb-lg-0">
                                    <div class="card-body">
                                        <h5 class="mb-3">Table of Contents</h5>
                                        <ul class="faq-sidebar">
                                            @if($this->categories->isNotEmpty())
                                                @foreach($this->categories as $category)
                                                    {{-- প্রতিটি ক্যাটাগরির জন্য লিঙ্ক তৈরি হচ্ছে --}}
                                                    <li><a href="#{{ Str::slug($category) }}" class="nav-link">{{ ucfirst($category) }}</a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            {{-- মূল FAQ কন্টেন্ট (ডাইনামিক) --}}
                            <div class="col-lg-9">
                                <div data-bs-spy="scroll" data-bs-target="#list-example" data-bs-offset="0">
                                    @if($this->faqsByCategory->isNotEmpty())
                                        @foreach($this->faqsByCategory as $category => $faqs)
                                            <div class="mb-4" id="{{ Str::slug($category) }}">
                                                <h4 class="mb-3">{{ ucfirst($category) }}</h4>

                                                {{-- প্রতিটি ক্যাটাগরির FAQ-এর জন্য অ্যাকর্ডিয়ন --}}
                                                <div class="accordion accordion-bordered accordion-custom-icon accordion-arrow-none" id="accordion-{{ Str::slug($category) }}">
                                                    @foreach($faqs as $faq)
                                                        <div class="accordion-item">
                                                            <h6 class="accordion-header" id="heading-{{ $faq->id }}">
                                                                <button class="accordion-button {{ !$loop->first ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $faq->id }}">
                                                                    {{ $faq->question }}
                                                                    <i class="ti ti-plus accordion-icon accordion-icon-on"></i>
                                                                    <i class="ti ti-minus accordion-icon accordion-icon-off"></i>
                                                                </button>
                                                            </h6>
                                                            <div id="collapse-{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#accordion-{{ Str::slug($category) }}">
                                                                <div class="accordion-body">
                                                                    {!! $faq->answer !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            {{-- শেষ আইটেম ছাড়া বাকিগুলোর পরে একটি বিভাজক রেখা --}}
                                            @if(!$loop->last)
                                                <hr class="my-4">
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
