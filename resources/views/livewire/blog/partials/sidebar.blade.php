<div>
    <!-- Search -->
    <div class="card">
        <div class="card-header"><h4 class="mb-0">Filter</h4></div>
        <div class="card-body">
            <input type="text" class="form-control" placeholder="Search..." wire:model.live.debounce.300ms="search">
        </div>
    </div>

    <!-- Categories -->
    @if($this->categories->isNotEmpty())
        <div class="card">
            <div class="card-header"><h4 class="mb-0">Categories</h4></div>
            <div class="card-body">

                {{-- "All Posts" ফিল্টার রিসেট করার জন্য --}}
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                    <a href="#"
                       wire:click.prevent="filterByCategory(null)"
                       class="{{ !$selectedCategory ? 'fw-bold text-primary' : 'link-body' }}">
                        All Posts
                    </a>
                </div>

                {{-- প্রতিটি ক্যাটাগরির জন্য লুপ --}}
                @foreach($this->categories as $category)
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 {{ !$loop->last ? 'mb-3' : 'mb-0' }}">
                        <a href="#"
                           wire:click.prevent="filterByCategory({{ $category->id }})"
                           class="{{ $selectedCategory == $category->id ? 'fw-bold text-primary' : 'link-body' }}">
                            {{ $category->name }}
                        </a>
                        <p class="mb-0">{{ $category->posts_count }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Top Articles -->
    @if($this->topPosts->isNotEmpty())
        <div class="card mb-0">
            <div class="card-header"><h4 class="mb-0">Top Articles</h4></div>
            <div class="card-body">
                @foreach($this->topPosts as $topPost)
                    <div class="blog-item-02 {{ !$loop->last ? 'mb-3' : '' }}">
                        <div class="blog-img-img">
                            <a href="{{ route('blog.details', $topPost->slug) }}">
                                <img src="{{ $topPost->getFirstMediaUrl('posts', 'thumbnail') }}" alt="{{ $topPost->title }}" class="img-fluid">
                            </a>
                        </div>
                        <div class="blog-content-02">
                            <h5><a href="{{ route('blog.details', $topPost->slug) }}">{{ $topPost->title }}</a></h5>
                            <p>{{ $topPost->published_at->format('d M Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
