<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function __invoke() {
        $posts = Post::latest()->get();

        return response()->view('posts.feed', [
            'posts' => $posts
        ])->header('Content-Type', 'text/xml');
    }
}
