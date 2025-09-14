<?php

namespace App\Livewire\Blog;

use App\Models\Post;
use App\Models\PostFeedback;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Attributes\On;

#[Layout('layouts.app')]
class DetailsPage extends Component
{
    public Post $post;
    public ?string $userFeedback = null; // ব্যবহারকারীর বর্তমান ভোট ট্র্যাক করার জন্য

    public function mount(Post $post): void
    {
        $this->post = $post;

        // মাউন্ট হওয়ার সময় ব্যবহারকারীর আগের ফিডব্যাক লোড করুন
        $this->loadUserFeedback();
    }

    public function loadUserFeedback(): void
    {
        if (auth()->check()) {
            $feedback = PostFeedback::where('user_id', auth()->id())
                ->where('post_id', $this->post->id)
                ->first();
            $this->userFeedback = $feedback?->vote;
        }
    }

    public function giveFeedback(string $vote)
    {
        if (!auth()->check()) {
            return $this->redirect(route('filament.app.auth.login'));
        }

        // 'yes' বা 'no' ছাড়া অন্য কোনো ইনপুট গ্রহণ করবেন না
        if (!in_array($vote, ['yes', 'no'])) {
            return;
        }

        PostFeedback::updateOrCreate(
            ['user_id' => auth()->id(), 'post_id' => $this->post->id],
            ['vote' => $vote]
        );

        // UI তাৎক্ষণিকভাবে আপডেট করার জন্য
        $this->userFeedback = $vote;
        $this->post->refresh(); // Observer থেকে আসা নতুন কাউন্ট লোড করার জন্য
    }

    #[Computed(cache: true, key: 'related-blog-post')]
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
        return view('livewire.blog.details-page')
            ->title($this->post->title . ' - ' . config('app.name'));
    }
}
