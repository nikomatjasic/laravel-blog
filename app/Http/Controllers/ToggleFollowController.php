<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToggleFollowRequest;
use App\Models\User;

/**
 * Toggle follow controller.
 */
class ToggleFollowController extends Controller
{

    /**
     * Toggle follow/unfollow action.
     *
     * @param  \App\Http\Requests\ToggleFollowRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function __invoke(ToggleFollowRequest $request)
    {
        // Check if the request is ajax.
        if ($request->ajax()) {
            // Returns error if not valid.
            $request->validated();
            $userId = $request->get('user_id');
            $authorId = $request->get('author_id');

            $user = User::find($userId);
            $user->followings()->toggle($authorId);

            $status = $user->followings->contains($authorId);
            //cache()->forget('post.' . request()->route('post'));

            return response()->json([
              'status' => 'success',
              'action' => $status ? 'unfollow' : 'follow',
            ]);
        }
    }

}
