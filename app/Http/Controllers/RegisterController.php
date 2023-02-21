<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Jobs\NewUserDataJob;
use App\Services\RegisterControlerService;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function __construct(public RegisterControlerService $registerControlerService)
    {
    }

    public function create()
    {
        return view('register.create');
    }

    public function store(StoreUserRequest $request)
    {
        $user = $this->registerControlerService->create($request);
        event(new Registered($user));
        NewUserDataJob::dispatch($user);

        return redirect('/')->with('success', 'Your account has been created.');
    }
}
