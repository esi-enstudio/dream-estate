<?php

namespace App\Livewire\Blog;

use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class DetailsPage extends Component
{
    public Post $post;

    public function mount(string $slug): void
    {
        $this->post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->with(['user', 'category'])
            ->firstOrFail();

        // ভিউ কাউন্ট বৃদ্ধি
        $this->post->increment('views_count');
    }

    #[Computed(cache: true)]
    public function relatedPosts()
    {
        return Post::where('status', 'published')
            ->where('published_at', '<=', now())
            ->where('id', '!=', $this->post->id)
            ->where('category_id', $this->post->category_id)
            ->with(['user', 'category'])
            ->latest('published_at')
            ->take(5)
            ->get();
    }

    public function render(): Factory|View
    {
        return view('livewire.blog.details-page');
    }
}
