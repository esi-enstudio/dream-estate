<div class="page-wrapper">

    <!-- Start Breadscrumb -->
    <div class="breadcrumb-bar">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-01.png') }}" alt="" class="breadcrumb-bg-01 d-none d-lg-block">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-02.png') }}" alt="" class="breadcrumb-bg-02 d-none d-lg-block">
        <img src="{{ asset('assets/img/bg/breadcrumb-bg-03.png') }}" alt="" class="breadcrumb-bg-03">
        <div class="row align-items-center text-center position-relative z-1">
            <div class="col-md-12 col-12 breadcrumb-arrow">
                <h1 class="breadcrumb-title">Blog List</h1>
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">
                                <span><i class="mdi mdi-home-outline me-1"></i></span>Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Blog List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Breadscrumb -->

    <div class="content">
    <div class="container">
        <div class="row row-gap-4">
            <div class="col-md-12 col-lg-8">
                {{-- পোস্ট লিস্ট --}}
                @forelse($posts as $post)
                    <div class="{{ !$loop->last ? 'mb-4' : '' }}">
                        {{-- পুনঃব্যবহারযোগ্য ব্লগ কার্ড --}}
                        @include('livewire.blog.partials.blog-card', ['post' => $post])
                    </div>
                @empty
                    <p class="text-center">No posts found matching your criteria.</p>
                @endforelse

                {{-- Load More বাটন --}}
                @if($hasMorePosts)
                    <div class="d-flex align-items-center justify-content-center mt-4">
                        <button wire:click="loadMore" class="btn btn-dark d-inline-flex align-items-center">
                            <i class="material-icons-outlined me-1">autorenew</i>Load More
                        </button>
                    </div>
                @endif
            </div>

            <div class="col-lg-4 theiaStickySidebar">
                {{-- সাইডবার --}}
                @include('livewire.blog.partials.sidebar')
            </div>
        </div>
    </div>
</div>

</div>
