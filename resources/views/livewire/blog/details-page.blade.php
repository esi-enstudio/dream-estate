<div class="page-wrapper">

    <!-- Start Breadscrumb -->
    <div class="breadcrumb-bar">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-01.png') }}" alt="" class="breadcrumb-bg-01 d-none d-lg-block">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-02.png') }}" alt="" class="breadcrumb-bg-02 d-none d-lg-block">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-03.png') }}" alt="" class="breadcrumb-bg-03">
        <div class="row align-items-center text-center position-relative z-1">
            <div class="col-md-12 col-12 breadcrumb-arrow">
                <h1 class="breadcrumb-title">Blog Details</h1>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><span><i class="mdi mdi-home-outline me-1"></i></span>Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Breadscrumb -->


    <div class="content">
        <div class="container">
            <div class="row blog-details-cover">
                <div class="col-lg-10 mx-auto">
                    <a href="{{ route('blog.index') }}" class="d-flex align-items-center mb-4"><i class="material-icons-outlined me-1">arrow_back</i>Back to Blogs</a>
                    <div class="card mb-0">
                        <div class="card-body">
                            <div class="blog-details-item-01">
                                <div class="blog-details-img-01">
                                    <img src="{{ $post->getFirstMediaUrl('posts') }}" alt="{{ $post->title }}" class="img-fluid">
                                </div>
                                <div class="blog-details-content-01">
                                    <span class="badge badge-sm bg-secondary fw-semibold">{{ $post->category->name }}</span>
                                    <h5>{{ $post->title }}</h5>
                                    <div class="d-flex align-items-center justify-content-center flex-wrap gap-2 author-details">
                                        <div class="d-flex align-items-center me-3">
                                            <a href="#"><img src="{{ \Illuminate\Support\Facades\Storage::url($post->user->avatar_url) ?? asset('assets/img/users/default-avatar.png') }}" alt="{{ $post->user->name }}" class="avatar avatar-sm rounded-circle me-2"></a>
                                            <a href="#">{{ $post->user->name }}</a>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="d-inline-flex align-items-center"><i class="material-icons-outlined me-1">event</i>{{ $post->published_at->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- মূল ব্লগ কন্টেন্ট --}}
                            <div class="mt-4">
                                {!! $post->body !!}
                            </div>

                            {{-- অথর বক্স --}}
                            <div class="card border-0 border-start border-3 border-primary bg-light my-4">
                                <div class="card-body">
                                    <div class="row align-items-center row-gap-2">
                                        <div class="col-lg-2">
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($post->user->avatar_url) ?? asset('assets/img/users/default-avatar.png') }}" alt="{{ $post->user->name }}" class="img-fluid avatar avatar-xxxl rounded-circle">
                                        </div>
                                        <div class="col-lg-10">
                                            <p class="fw-medium mb-1 text-primary">Author</p>
                                            <h5>{{ $post->user->name }}</h5>
                                            <p class="mb-0">{{ $post->user->bio ?? '' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Was this article helpful? --}}
                            <div class="card shadow-none mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                        <h6 class="mb-0">Was this article helpful?</h6>

                                        {{-- ডাইনামিক কাউন্টার --}}
                                        @if(($post->helpful_yes_count + $post->helpful_no_count) > 0)
                                            <p class="mb-0">
                                                {{ $post->helpful_yes_count }} out of {{ $post->helpful_yes_count + $post->helpful_no_count }} found this helpful
                                            </p>
                                        @endif

                                        {{-- ★★★ মূল ডাইনামিক অংশ ★★★ --}}
                                        <div>
                                            @auth
                                                {{-- যদি ব্যবহারকারী ইতিমধ্যে ভোট দিয়ে থাকেন, তাহলে বাটনগুলো নিষ্ক্রিয় দেখান --}}
                                                @if($userFeedback)
                                                    <div class="d-flex align-items-center">
                                                        <button class="btn btn-sm {{ $userFeedback === 'yes' ? 'btn-success' : 'btn-white' }} d-inline-flex align-items-center me-2" disabled>
                                                            <i class="material-icons-outlined me-1">thumb_up</i>Yes
                                                        </button>
                                                        <button class="btn btn-sm {{ $userFeedback === 'no' ? 'btn-danger' : 'btn-white' }} d-inline-flex align-items-center" disabled>
                                                            <i class="material-icons-outlined me-1">thumb_down</i>No
                                                        </button>
                                                    </div>
                                                    <small class="d-block text-muted mt-1">Thank you for your feedback!</small>
                                                @else
                                                    {{-- ভোট দেওয়ার জন্য বাটন --}}
                                                    <div class="d-flex align-items-center">
                                                        <a href="#" wire:click.prevent="giveFeedback('yes')" class="btn btn-sm btn-white d-inline-flex align-items-center me-2">
                                                            <i class="material-icons-outlined me-1">thumb_up</i>Yes
                                                        </a>
                                                        <a href="#" wire:click.prevent="giveFeedback('no')" class="btn btn-sm btn-white d-inline-flex align-items-center">
                                                            <i class="material-icons-outlined me-1">thumb_down</i>No
                                                        </a>
                                                    </div>
                                                @endif
                                            @else
                                                {{-- লগইন না করা থাকলে লগইন করার জন্য বার্তা --}}
                                                <p class="mb-0 fs-14"><a href="{{ route('login') }}">Login</a> to give feedback.</p>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- Related Posts --}}
            @if($this->relatedPosts->isNotEmpty())
                <div class="blog-details-item-02 mt-5">
                    <h5>Related Posts</h5>
                    <div class="blog-carousel-wrapper">
                        {{-- Carousel JS ইনিশিয়ালাইজ করার জন্য --}}
                        <div class="blog-carousel">
                            @foreach($this->relatedPosts as $relatedPost)
                                <div>
                                    @include('livewire.blog.partials.blog-card', ['post' => $relatedPost])
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let viewCounted = false;

            const timer = setTimeout(() => {
                if (!viewCounted) {
                    // ★★★★★ মূল সমাধানটি এখানে ★★★★★
                    // Livewire dispatch-এর পরিবর্তে Fetch API ব্যবহার করে API endpoint-এ রিকোয়েস্ট পাঠানো হচ্ছে
                    fetch("{{ route('blog.increment-view', $post) }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Post view count updated successfully.');
                            }
                        })
                        .catch(error => console.error('Error:', error));

                    viewCounted = true;
                }
            }, 20000); // ২০ সেকেন্ড

            // সক্রিয় সময় গণনার জন্য visibilitychange লিসেনারটি আগের মতোই থাকবে
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    clearTimeout(timer);
                }
            });
        });
    </script>
@endpush
