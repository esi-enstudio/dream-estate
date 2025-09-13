<section class="home-blog-section section-padding">
    <div class="container">
        <!-- Section Heading -->
        <div class="section-heading aos" data-aos="fade-down">
            <h2 class="mb-2 text-center">Latest Blog</h2>
            <div class="sec-line"><span class="sec-line1"></span><span class="sec-line2"></span></div>
            <p class="mb-0 text-center">Explore our featured blog posts on premium properties for sales & rents.</p>
        </div>

        @if($this->posts->isNotEmpty())
            <!-- Blog Posts Row -->
            <div class="row row-gap-4 justify-content-center">
                @foreach($this->posts as $post)
                    <div class="col-md-6 col-lg-4 d-flex aos" data-aos="fade-down">
                        <div class="blog-item-01 flex-fill">
                            <div class="blog-img">
                                <a href="{{ route('blog.details', $post->slug) }}">
                                    {{-- SEO: alt ট্যাগ খুবই গুরুত্বপূর্ণ --}}
                                    <img src="{{ $post->getFirstMediaUrl('posts', 'thumbnail') ?? asset('assets/img/blogs/blog-placeholder.jpg') }}" alt="{{ $post->title }}" class="img-fluid">
                                </a>
                            </div>
                            <div class="blog-content">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
                                    {{-- ডাইনামিক ক্যাটাগরি --}}
                                    <span class="badge badge-sm bg-secondary fw-semibold">{{ $post->category?->name }}</span>
                                    <div class="d-flex align-items-center author-details">
                                        <div class="d-flex align-items-center me-3">
                                            {{-- ডাইনামিক অথর ইমেজ --}}
                                            <a href="#"><img src="{{ $post->user?->avatar_url ?? asset('assets/img/users/default-avatar.png') }}" alt="{{ $post->user?->name }}" class="avatar avatar-sm rounded-circle me-2"></a>
                                            {{-- ডাইনামিক অথর নাম --}}
                                            <a href="#">{{ $post->user?->name }}</a>
                                        </div>
                                        {{-- ডাইনামিক তারিখ --}}
                                        <span class="d-inline-flex align-items-center"><i class="material-icons-outlined me-1">event</i>{{ $post->published_at?->format('d M Y') }}</span>
                                    </div>
                                </div>
                                <div>
                                    {{-- ডাইনামিক টাইটেল এবং লিঙ্ক --}}
                                    <h5 class="mb-1"><a href="{{ route('blog.details', $post->slug) }}">{{ $post->title }}</a></h5>
                                    {{-- ডাইনামিক সারাংশ --}}
                                    <p class="mb-0">{{ $post->excerpt }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Explore All Button -->
            <div class="text-center d-flex align-items-center justify-content-center m-auto mt-5">
                <a href="{{ route('blog.index') }}" class="btn btn-lg btn-dark d-flex align-items-center gap-1">
                    Explore All <i class="material-icons-outlined">arrow_forward</i>
                </a>
            </div>
        @endif
    </div>
</section>
