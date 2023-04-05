<?php

namespace App\Http\Controllers;

use App\Events\FollowingUserCreatedNewPost;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * Administration Posts Controller.
 */
class AdminPostController extends Controller
{

    /**
     * List of all the posts in the administration panel.
     *
     * @return mixed
     */
    public function index()
    {
        app('debugbar')->error('Watch out..');
        return view('admin.posts.index', [
            'posts' => Post::latest()->paginate(10)
        ]);
    }

    /**
     * Create new post.
     *
     * @return mixed
     */
    public function create()
    {
        return view('admin.posts.create', ['categories' => Category::all()]);
    }

    /**
     * Store Post.
     *
     * @return mixed
     */
    public function store()
    {
        $attributes = array_merge($this->validatePost(), [
            'user_id' => request()->user()->id,
            'slug' => Str::slug(request('title')),
            'is_published' => request('published') == 'on',
            'thumbnail' => request()->file('thumbnail')->store('thumbnails')
        ]);

        $post = Post::create($attributes);

        FollowingUserCreatedNewPost::dispatch(Auth::user(), $post);

        return redirect('/');
    }

    /**
     * Administrator edit post view.
     *
     * @param \App\Models\Post $post
     *   Post.
     *
     * @return mixed
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post, 'categories' => Category::all(), 'authors' => User::all()]);
    }

    /**
     * Update post.
     *
     * @param \App\Models\Post $post
     *   Post.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);
        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }

        $attributes['is_published'] = request('published') == 'on';
        $post->update($attributes);

        return back()->with('success', 'Updates confirmed.');
    }

    /**
     * Delete Post.
     *
     * @param  \App\Models\Post  $post
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post removed.');
    }

    /**
     * Post validation for create and update.
     *
     * @param \App\Models\Post|null $post
     *   Post.
     *
     * @return array
     */
    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();
        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'user_id' => [Rule::exists('users', 'id')],
        ]);
    }
}
