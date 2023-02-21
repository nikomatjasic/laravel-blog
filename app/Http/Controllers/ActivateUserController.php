<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivateUserRequest;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Carbon;

class ActivateUserController extends Controller
{
    public function index($hash)
    {
        $user = User::where('hash', $hash)->firstOrFail();
        if (!Carbon::now()->gt($user->hash_expire)) {
            return view('register.index', ['hash' => $hash]);
        }
        return redirect('/')->with('success', 'User activation link expired, please contact admin.');
    }

    public function store($hash, ActivateUserRequest $request)
    {
        $attributes = array_merge($request->validated(),
            [
                'hash_expire' => Carbon::now(),
                'email_verified_at' => Carbon::now()
            ]
        );
        $user = User::where('hash', $hash)->firstOrFail();
        $user->update($attributes);
        auth()->login($user);

//        $basic  = new \Vonage\Client\Credentials\Basic(config('services.vonage.key'), config('services.vonage.secret'));
//        $client = new \Vonage\Client($basic);
//
//        $response = $client->sms()->send(
//            new \Vonage\SMS\Message\SMS("38651345855", 'AgileBlog', 'Welcome to the portal. Regards, AgileBlog.com')
//        );
//
//        $message = $response->current();
//
//        if ($message->getStatus() == 0) {
//            echo "The message was sent successfully\n";
//        } else {
//            echo "The message failed with status: " . $message->getStatus() . "\n";
//        }

        return redirect('/')->with('success', 'Welcome back');
    }

}
