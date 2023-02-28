<?php

namespace App\Http\Controllers;

use App\Events\FollowingUserCreatedNewPost;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminPostController extends Controller
{
    public function index()
    {
        app('debugbar')->error('Watch out..');
        return view('admin.posts.index', [
            'posts' => Post::latest()->paginate(10)
        ]);
    }


    public function create()
    {
        return view('admin.posts.create');
    }


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

    public function edit(Post $post)
    {
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Post $post)
    {
        $attributes = $this->validatePost($post);
        if ($attributes['thumbnail'] ?? false) {
            $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
        }
        $attributes['is_published'] = request('is_published') == 'on';
        $post->update($attributes);

        return back()->with('success', 'Updates confirmed.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success', 'Post removed.');
    }

    protected function validatePost(?Post $post = null): array
    {
        $post ??= new Post();
        return request()->validate([
            'title' => 'required',
            'thumbnail' => $post->exists ? ['image'] : ['required', 'image'],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')],
        ]);
    }
}
