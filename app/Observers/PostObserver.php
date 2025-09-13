<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Post;

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
    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        $this->updateCategoryPostCount($post->category);
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        $this->updateCategoryPostCount($post->category);
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
}
