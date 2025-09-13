<?php

namespace App\Livewire\Blog;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class IndexPage extends Component
{
    // --- ফিল্টার ---
    public string $search = '';
    public ?int $selectedCategory = null;

    // --- লোডিং ---
    public int $perPage = 5; // প্রথমে কয়টি পোস্ট দেখানো হবে

    // URL-এ ফিল্টারগুলো দেখানোর জন্য
    protected array $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => null, 'as' => 'category'], // URL-এ 'category' হিসেবে দেখাবে
    ];

    public function loadMore(): void
    {
        $this->perPage += 3; // প্রতি ক্লিকে আরও ৩টি পোস্ট যোগ হবে
    }

    // নির্দিষ্ট ক্যাটাগরিতে ফিল্টার করার জন্য মেথড
    public function filterByCategory(?int $categoryId): void
    {
        $this->selectedCategory = $categoryId;
        $this->reset('perPage'); // নতুন ফিল্টার করলে পেজিনেশন রিসেট করুন
    }

    #[Computed(cache: true, key: 'blog-index-categories')]
    public function categories()
    {
        // শুধুমাত্র সেই ক্যাটাগরিগুলো আনবে যেগুলোতে কমপক্ষে একটি 'published' পোস্ট আছে
        return Category::whereHas('posts', function ($query) {
            $query->where('status', 'published')->where('published_at', '<=', now());
        })
            ->withCount(['posts' => function ($query) {
                $query->where('status', 'published')->where('published_at', '<=', now());
            }])
            ->get();
    }

    #[Computed]
    public function topPosts()
    {
        // সবচেয়ে বেশি ভিউ হওয়া ৫টি পোস্ট
        return Post::where('status', 'published')
            ->where('published_at', '<=', now())
            ->orderBy('views_count', 'desc')
            ->take(4)
            ->get();
    }

    public function render(): Factory|View|Application
    {
        $query = Post::query()
            ->with(['user', 'category'])
            ->where('status', 'published')
            ->where('published_at', '<=', now());

        // সার্চ ফিল্টার
        $query->when($this->search, function ($q) {
            $q->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('body', 'like', '%' . $this->search . '%');
        });

        // ক্যাটাগরি ফিল্টার
        $query->when($this->selectedCategory, fn($q) => $q->where('category_id', $this->selectedCategory));

        $totalPostsCount = $query->clone()->count();
        $posts = $query->latest('published_at')->take($this->perPage)->get();

        return view('livewire.blog.index-page', [
            'posts' => $posts,
            'hasMorePosts' => $posts->count() < $totalPostsCount,
        ]);
    }
}
