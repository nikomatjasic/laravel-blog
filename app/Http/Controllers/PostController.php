<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
//            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->where('is_published', 1)->simplePaginate(7)->withQueryString()
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
