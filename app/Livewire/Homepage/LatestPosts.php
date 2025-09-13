<?php

namespace App\Livewire\Homepage;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class LatestPosts extends Component
{
    /**
     * ডেটাবেস থেকে সর্বশেষ প্রকাশিত পোস্টগুলো নিয়ে আসুন
     */
    #[Computed(cache: true, key: 'homepage-latest-posts')]
    public function posts(): Collection
    {
        return Post::query()
            ->with(['user', 'category']) // N+1 সমস্যা এড়ানোর জন্য
            ->where('status', 'published')
            ->where('published_at', '<=', now())
            ->latest('published_at') // 'created_at' এর পরিবর্তে 'published_at' দিয়ে সর্ট করা ভালো
            ->take(3) // дизайনে ৩টি পোস্ট দেখানো হয়েছে
            ->get();
    }
    public function render()
    {
        return view('livewire.homepage.latest-posts');
    }
}
