<?php

namespace App\Http\Controllers;

use App\Http\Requests\FollowRequest;
use App\Models\User;

class FollowController extends Controller
{
    public function create(FollowRequest $request)
    {
        $request->validated();
        User::find(request('user_id'))->followings()->attach(User::find(request('author_id')));
        cache()->forget('post.' . request()->route('post'));

        return response()->json(['status' => 'success']);
    }

    public function destroy(FollowRequest $request)
    {
        $request->validated();
        User::find(request('user_id'))->followings()->detach(User::find(request('author_id')));
        cache()->forget('post.' . request()->route('post'));

        return response()->json(['status' => 'success']);
    }
}
