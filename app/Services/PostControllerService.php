<?php

namespace App\Services;

use App\Models\Post;

class PostControllerService
{
    public function increaseViews(Post $post)
    {
        if (!session()->has('views.post')) {
            session()->put('views.post', 1);
            $post->increment('views_count');
            $post->save();
        }
    }

}

