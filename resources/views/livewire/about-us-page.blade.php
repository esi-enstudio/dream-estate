<div class="page-wrapper">
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-01.png') }}" alt="" class="breadcrumb-bg-01 d-none d-lg-block">
        <img src="{{ asset('}assets/img/bg/breadcrumb-bg-02.png') }}" alt="" class="breadcrumb-bg-02 d-none d-lg-block">
        <img src="{{ asset('}assets/img/bg/breadcrumb-bg-03.png') }}" alt="" class="breadcrumb-bg-03">
        <div class="row align-items-center text-center position-relative z-1">
            <div class="col-md-12 col-12 breadcrumb-arrow">
                <h1 class="breadcrumb-title">About Us</h1>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><span><i class="material-icons-outlined me-1">home</i></span>Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">About Us</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="about-us-item-06">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    {{-- উপরের টেক্সট এবং ছবিগুলো সাধারণত স্ট্যাটিক থাকে, তবে আপনি এগুলোকে একটি সেটিংস টেবিল থেকে আনতে পারেন --}}
                    <div class="about-us-item-01">
                        <h2>আমরা মানুষকে ভবনের সাথে সংযুক্ত করি</h2>
                        <p class="mb-0">
                            আমরা শুধু প্রোপার্টি কেনা-বেচার প্ল্যাটফর্ম নই—আমরা স্বপ্নকে বাস্তবের সাথে যুক্ত করি।
                            “আমরা মানুষকে ভবনের সাথে সংযুক্ত করি” আমাদের সেই লক্ষ্যকে প্রকাশ করে, যেখানে প্রতিটি জায়গা হয়ে ওঠে নতুন গল্পের সূচনা।
                            আপনি যদি খুঁজে থাকেন স্বপ্নের বাড়ি, আধুনিক অফিস স্পেস, বা লাভজনক বিনিয়োগের সুযোগ—আমাদের নির্ভরযোগ্য লিস্টিং, বিশেষজ্ঞ সহায়তা এবং স্মার্ট প্রযুক্তি আপনাকে করে তোলে আরও আত্মবিশ্বাসী।
                            আমাদের সাথে প্রতিটি ভবন কেবল ইট-পাথরের কাঠামো নয়, হয়ে ওঠে আপনার জীবনের অংশ, আর প্রতিটি জায়গা পায় প্রকৃত অর্থে আপনজনের আবাস।
                        </p>
                    </div>



                    <!-- start row -->
                    <div class="row row-gap-4 about-us-img-wrap">
                        <div class="col-md-4 col-lg-4">
                            <img src="{{ asset('assets/img/about-us/about-us-01.jpg') }}" alt="img" class="img-fluid rounded">
                        </div><!-- end col -->
                        <div class="col-md-4 col-lg-4">
                            <img src="{{ asset('assets/img/about-us/about-us-02.jpg') }}" alt="img" class="img-fluid rounded">
                        </div><!-- end col -->
                        <div class="col-md-4 col-lg-4">
                            <img src="{{ asset('assets/img/about-us/about-us-03.jpg') }}" alt="img" class="img-fluid rounded">
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                    <!-- ★★★ ডাইনামিক Statistics সেকশন ★★★ -->
                    {{-- এটি কোড পুনঃব্যবহারের একটি চমৎকার উদাহরণ --}}
                    <livewire:homepage.statistics-counter viewName="about-us-stats"/>
                </div>
            </div>
        </div>
    </div>

    <div class="about-us-item-03">
        <img src="{{ asset('assets/img/bg/about-us-bg-01.png') }}" alt="" class="img-fluid about-us-bg-01 d-none d-lg-flex">
        <img src="{{ asset('assets/img/bg/about-us-bg-02.png') }}" alt="" class="img-fluid about-us-bg-02 d-none d-lg-flex">
        <div class="container">

            <!-- start row -->
            <div class="row align-items-center row-gap-4 position-relative z-2">
                <div class="col-xl-5">
                    <div class="me-3">
                        <h2 class="mb-4">আপনি কি প্রস্তুত আপনার পছন্দের জায়গা বুক করতে?</h2>
                        <img src="{{ asset('assets/img/about-us/about-us-04.jpg') }}" alt="" class="img-fluid rounded w-100">
                    </div>
                </div><!-- end col -->
                <div class="col-xl-7">
                    <h5 class="mb-4">স্বপ্নের প্রোপার্টি খুঁজুন এবং সহজ, দ্রুত ও ঝামেলামুক্ত প্রক্রিয়ায় আপনার পছন্দের জায়গা বুক করে নিন আজই।</h5>
                    <p>আপনার বাজেট ও লাইফস্টাইল অনুযায়ী যাচাই করা অসংখ্য প্রোপার্টির তালিকা থেকে বেছে নিন আপনার নতুন ঠিকানা। শহরের বিলাসবহুল অ্যাপার্টমেন্ট হোক কিংবা উপশহরের আরামদায়ক পারিবারিক বাড়ি—আমাদের প্ল্যাটফর্ম দিচ্ছে নির্ভরযোগ্য এবং ঝামেলাহীন বুকিং অভিজ্ঞতা। থাকছে নিরাপদ লেনদেন, তাৎক্ষণিক বুকিং কনফার্মেশন এবং সর্বদা আপডেটেড তথ্য।</p>
                    <p class="mb-0">ড্রিমস এস্টেট আপনাকে দিচ্ছে প্রিমিয়াম প্রোপার্টি এবং ব্যবহারবান্ধব প্ল্যাটফর্মের সুবিধা। লোকেশন, দাম ও সুযোগ-সুবিধা অনুযায়ী ফিল্টার করে দ্রুত খুঁজে নিন আপনার কাঙ্ক্ষিত প্রোপার্টি। রিয়েল-টাইম আপডেট ও নোটিফিকেশনের মাধ্যমে থাকুন একদম এগিয়ে। ভাড়া অথবা কেনা—যা-ই হোক না কেন, ড্রিমস এস্টেটের সাথে আপনার বুকিং অভিজ্ঞতা হবে সহজ, দ্রুত এবং আত্মবিশ্বাসী।</p>
                </div><!-- end col -->
            </div>
            <!-- end row -->

        </div>
    </div>


    <div class="about-us-item-04">
        <div class="container">
            <div class="row">
                <div class="col-lg-11 mx-auto">
                    <!-- ★★★ ডাইনামিক Partners সেকশন ★★★ -->
                    {{-- আমরা PartnersSlider কম্পোনেন্টকে কল করছি, কিন্তু একটি ভিন্ন ভিউ দিয়ে --}}
                    <livewire:homepage.partners-slider viewName="about-us-partners"/>
                </div>
            </div>
        </div>
    </div>
</div>
