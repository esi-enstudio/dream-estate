<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;

class PostObserver
{
    /**
     * Handle events after all transactions are committed.
     */
    public bool $afterCommit = true;

    /**
     * Handle the Post "created" event.
     */
    public function created(Post $post): void
    {
        $this->updateCategoryPostCount($post->category);
        $this->clearRelevantCache();
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updated(Post $post): void
    {
        // যদি পোস্টের ক্যাটাগরি পরিবর্তন করা হয়
        if ($post->isDirty('category_id')) {
            // পুরনো ক্যাটাগরির কাউন্ট আপডেট করুন
            if ($oldCategoryId = $post->getOriginal('category_id')) {
                if ($oldCategory = Category::find($oldCategoryId)) {
                    $this->updateCategoryPostCount($oldCategory);
                }
            }
            // নতুন ক্যাটাগরির কাউন্ট আপডেট করুন
            $this->updateCategoryPostCount($post->category);
        }

        // পোস্টের স্ট্যাটাস বা প্রকাশের তারিখ পরিবর্তন হলেও ক্যাশ পরিষ্কার করুন
        if ($post->isDirty('status', 'published_at', 'views_count', 'updated_at')) {
            $this->clearRelevantCache();
        }
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $this->updateCategoryPostCount($post->category);
        $this->clearRelevantCache();
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        $this->updateCategoryPostCount($post->category);
        $this->clearRelevantCache();
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }

    /**
     * A helper function to update the posts_count for a given category.
     */
    protected function updateCategoryPostCount(?Category $category): void
    {
        if ($category) {
            // সরাসরি COUNT কোয়েরি চালিয়ে সঠিক সংখ্যাটি নিন
            $category->posts_count = $category->posts()->count();
            $category->saveQuietly(); // কোনো নতুন ইভেন্ট ট্রিগার না করে সেভ করুন
        }
    }

    /**
     * A helper function to clear all caches related to posts.
     */
    protected function clearRelevantCache(): void
    {
        // BlogIndexPage-এর ক্যাটাগরি তালিকার জন্য
        Cache::forget('blog-index-categories');

        // রিলেটেড পোস্ট সেকশনের জন্য
        Cache::forget('related-blog-post');

        // Homepage-এর Latest Posts সেকশনের জন্য
        Cache::forget('homepage-latest-posts');

        // BlogIndexPage-এর টপ পোস্ট তালিকার জন্য
        // যেহেতু টপ পোস্টের কোনো নির্দিষ্ট কী নেই, তাই এটি পরিষ্কার করার প্রয়োজন নেই কারণ এটি ক্যাশ করা হয়নি
        // যদি আপনি #[Computed(cache: true, key: 'top-posts')] যোগ করেন, তাহলে নিচের লাইনটি লাগবে:
        // Cache::forget('top-posts');
    }
}
