<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostCommentsController extends Controller
{
    public function store(Post $post, Request $request)
    {
        $request->validate([
            'body' => 'required|min:3'
        ]);
        $post->comments()->create([
            'body' => $request->input('body'),
            'user_id' => $request->user()->id
        ]);

        return back();
    }
}
