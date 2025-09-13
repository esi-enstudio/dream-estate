<div class="blog-item-01 mb-4">
    <div class="blog-img">
        <a href="{{ route('blog.details', $post->slug) }}"><img src="{{ $post->getFirstMediaUrl('posts', 'thumbnail') }}" alt="{{ $post->title }}" class="img-fluid"></a>
    </div>

    <div class="blog-content">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-4">
            <span class="badge badge-sm bg-secondary fw-semibold">{{ $post->category->name }}</span>
            <div class="d-flex align-items-center flex-wrap gap-3 author-details">
                <div class="d-flex align-items-center me-3">
                    <a href="#">
                        <img src="{{ $post->user->avatar_url ?? '' }}" alt="{{ $post->user->name }}" class="avatar avatar-sm rounded-circle me-2">
                    </a>
                    <a href="#">{{ $post->user->name }}</a>
                </div>
                <div class="d-flex align-items-center">
                    <span class="d-inline-flex align-items-center"><i class="material-icons-outlined me-1">events</i>
                        {{ $post->published_at->format('d M Y') }}
                    </span>
                </div>
            </div>
        </div>
        <div>
            <h5 class="mb-1"><a href="{{ route('blog.details', $post->slug) }}">{{ $post->title }}</a></h5>
            <p class="mb-0">{{ $post->excerpt }}</p>
        </div>
    </div>
</div>
