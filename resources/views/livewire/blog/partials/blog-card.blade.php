<div class="blog-item-01">
    <div class="blog-img">
        <a href="{{ route('blog.details', $post->slug) }}"><img src="{{ $post->getFirstMediaUrl('posts', 'thumbnail') }}" alt="{{ $post->title }}" class="img-fluid"></a>
    </div>
    <div class="blog-content">
        <div class="d-flex align-items-center justify-content-between ...">
            <span class="badge ...">{{ $post->category->name }}</span>
            <div class="d-flex ...">
                <a href="#"><img src="{{ $post->user->avatar_url ?? '' }}" ...></a>
                <a href="#">{{ $post->user->name }}</a>
            </div>
            <span><i ...></i>{{ $post->published_at->format('d M Y') }}</span>
        </div>
        <div>
            <h5 class="mb-1"><a href="{{ route('blog.details', $post->slug) }}">{{ $post->title }}</a></h5>
            <p class="mb-0">{{ $post->excerpt }}</p>
        </div>
    </div>
</div>
