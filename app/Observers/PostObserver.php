<?php

namespace App\Observers;

use App\Models\Post;

class PostObserver
{
    /**
     * Handle the Post "created" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function created(Post $post)
    {
        cache()->forever('post.' . $post->slug, $post);
//        cache()->put('post' . $post->slug, $post, now()->addWeek());
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function updated(Post $post)
    {
        cache()->forget('post.' . $post->slug);
        cache()->forever('post.' . $post->slug, $post);
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function deleted(Post $post)
    {
        cache()->forget('post.' . $post->slug);
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param \App\Models\Post $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
