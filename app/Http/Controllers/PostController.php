<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\PostControllerService;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct(public PostControllerService $controllerService)
    {
    }

    /**
     * Previews all posts.
     *
     * @return mixed
     */
    public function index()
    {
        return view('posts.index', [
//            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->where('is_published', 1)->simplePaginate(7)->withQueryString()
        ]);
    }

    /**
     * Show single post.
     *
     * @param $slug
     *
     * @return mixed
     */
    public function show($slug)
    {
        $currentUser = Auth::user();
        $post = cache()->remember('post.' . $slug, 60, function () use ($slug) {
            return Post::where('slug', $slug)->first();
        });
        $following = $currentUser->followings->contains($post->author->id);
        $followingAction = $following ? 'unfollow' : 'follow';
        $this->controllerService->increaseViews($post);

        return view('posts.show', compact('post', 'followingAction'));
    }

}
