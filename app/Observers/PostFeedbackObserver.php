<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\PostFeedback;

class PostFeedbackObserver
{
    public function saved(PostFeedback $feedback): void
    { $this->updateCounts($feedback->post); }

    public function deleted(PostFeedback $feedback): void
    { $this->updateCounts($feedback->post); }

    protected function updateCounts(Post $post): void
    {
        $post->helpful_yes_count = $post->feedback()->where('vote', 'yes')->count();
        $post->helpful_no_count = $post->feedback()->where('vote', 'no')->count();
        $post->saveQuietly();
    }
}
