<div class="page-wrapper">
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-01.png') }}" alt="" class="breadcrumb-bg-01 d-none d-lg-block">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-02.png') }}" alt="" class="breadcrumb-bg-02 d-none d-lg-block">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-03.png') }}" alt="" class="breadcrumb-bg-03">
        <div class="row align-items-center text-center position-relative z-1">
            <div class="col-md-12 col-12 breadcrumb-arrow">
                <h1 class="breadcrumb-title">যোগাযোগ করুন</h1>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><span><i class="material-icons-outlined me-1">home</i></span>প্রথম পাতা</a></li>
                        <li class="breadcrumb-item active" aria-current="page">যোগাযোগ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Breadscrumb -->

    <div class="contact-us-wrap-01">
        <div class="container">
            <div class="row align-items-center row-gap-3">
                <div class="col-lg-6">
                    <div class="card border-0"><div class="card-body p-4">
                            <h4 class="mb-2">আমাদের বিক্রয় প্রতিনিধির সাথে কথা বলুন</h4>
                            <p class="mb-3">আপনার স্বপ্নের বাড়ি খুঁজে পেতে বা প্রোপার্টি সংক্রান্ত যেকোনো তথ্যের জন্য আমাদের অভিজ্ঞ বিক্রয় দলের সাথে কথা বলুন। আমরা আছি আপনার পাশে।</p>
                            <p class="fw-semibold mb-0">টোল ফ্রি : +৮৮০ ৯৬xxxxxxxx</p>
                        </div></div>
                    <div class="card border-0 mb-0"><div class="card-body p-4">
                            <h4 class="mb-2">প্রোডাক্ট ও অ্যাকাউন্ট সাপোর্ট</h4>
                            <p class="mb-3">আমাদের প্ল্যাটফর্ম বা আপনার অ্যাকাউন্ট সম্পর্কিত যেকোনো প্রয়োজনে আমাদের সাপোর্ট টিমের সাহায্য নিন।</p>
                            <a href="{{-- route('faq.index') --}}" class="btn btn-dark">সাধারণ জিজ্ঞাসা</a>
                        </div></div>
                </div>
                <div class="col-lg-6">
                    <div class="ms-0 ms-lg-4">
                        <img src="{{ asset('assets/img/contact-us/contact-us-img-01.jpg') }}" alt="যোগাযোগ" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-us-wrap-02">
        <div class="container">
            <!-- Contact Info -->
            <div class="row justify-content-center mb-3">
                <div class="col-md-6 col-lg-4">
                    <div class="contact-us-item-01">
                        <div class="d-flex align-items-center">
                            <span class="material-icons-outlined">mail</span>
                            <div>
                                <h6 class="mb-2">ইমেইল অ্যাড্রেস</h6>
                                {{-- এই তথ্যগুলো একটি সেটিংস টেবিল থেকে আসা উচিত --}}
                                <p class="mb-0"><a href="mailto:info@yourdomain.com">info@yourdomain.com</a></p>
                                <p class="mb-0"><a href="mailto:support@yourdomain.com">support@yourdomain.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="contact-us-item-01">
                        <div class="d-flex align-items-center">
                            <span class="material-icons-outlined">call</span>
                            <div>
                                <h6 class="mb-2">ফোন নাম্বার</h6>
                                <p class="mb-0">+৮৮০ ১xxxxxxxxx</p>
                                <p class="mb-0">+৮৮০ ১xxxxxxxxx</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="contact-us-item-01">
                        <div class="d-flex align-items-center">
                            <span class="material-icons-outlined">location_on</span>
                            <div>
                                <h6 class="mb-2">অফিসের ঠিকানা</h6>
                                <p class="mb-0">বাড়ি #.., রোড #.., ধানমন্ডি, ঢাকা-১২০৯</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Get In Touch Form -->
            <div class="row align-items-center row-gap-3">
                <div class="col-lg-6">
                    <img src="{{ asset('assets/img/contact-us/contact-us-img-02.jpg') }}" alt="আমাদের সাথে যোগাযোগ করুন" class="img-fluid">
                </div>
                <div class="col-lg-6">
                    <div class="contact-us-item-02">
                        <h2>যোগাযোগ ফর্ম</h2>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form wire:submit.prevent="submitForm">
                            <div class="row">
                                <div class="col-md-12"><div class="mb-3">
                                        <label class="form-label">আপনার নাম</label>
                                        <input type="text" class="form-control" wire:model="name" placeholder="আপনার সম্পূর্ণ নাম লিখুন">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div></div>
                                <div class="col-md-6"><div class="mb-3">
                                        <label class="form-label">ফোন নাম্বার</label>
                                        <input type="text" class="form-control" wire:model="phone" placeholder="আপনার ফোন নাম্বার">
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div></div>
                                <div class="col-md-6"><div class="mb-3">
                                        <label class="form-label">ইমেইল</label>
                                        <input type="email" class="form-control" wire:model="email" placeholder="আপনার ইমেইল অ্যাড্রেস">
                                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div></div>
                                <div class="col-md-12"><div class="mb-3">
                                        <label class="form-label">বিষয়</label>
                                        <input type="text" class="form-control" wire:model="subject" placeholder="আপনার আলোচনার বিষয়">
                                        @error('subject') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div></div>
                                <div class="col-md-12"><div class="mb-3">
                                        <label class="form-label">বিস্তারিত</label>
                                        <textarea class="form-control" rows="3" wire:model="message" placeholder="আপনার বার্তাটি এখানে লিখুন..."></textarea>
                                        @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div></div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-lg btn-dark">বার্তা পাঠান</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="google-map">
        {{-- গুগল ম্যাপের লিঙ্কটি অ্যাডমিন প্যানেলের সেটিংস থেকে আসা উচিত --}}
        <iframe class="rounded-0" src="https://www.google.com/maps/embed?pb=..." allowfullscreen loading="lazy"></iframe>
    </div>
</div>
