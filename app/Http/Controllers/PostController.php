<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostControllerService;

class PostController extends Controller
{

    public function __construct(public PostControllerService $controllerService)
    {
    }

    public function index()
    {
        return view('posts.index', [
//            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->where('is_published', 1)->simplePaginate(7)->withQueryString()
        ]);
    }

    public function show($slug)
//    public function show(Post $post)
    {
        $post = cache()->remember('post.' . $slug, 60, function () use ($slug) {
            return Post::where('slug', $slug)->first();
        });
        $following = false;
//        $followings = auth()->user()->followings()->pluck('id')->toArray();
//        $following = in_array($post->author->id, $followings);
        $this->controllerService->increaseViews($post);

//        return view('posts.show', compact('post', 'following'));
        return view('posts.show', compact('post', 'following'));
    }


}
