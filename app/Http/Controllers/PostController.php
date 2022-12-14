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
        $this->increaseViews($post);

        return view('posts.show', [
            'post' => $post
        ]);
    }

    protected function increaseViews(Post $post)
    {
        if (!session()->has('views.post')) {
            session()->put('views.post', 1);
            $post->increment('views_count');
            $post->save();
        }
    }

}
