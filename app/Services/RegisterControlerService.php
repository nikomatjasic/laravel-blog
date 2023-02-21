<?php

namespace App\Services;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class RegisterControlerService
{
    public function create(StoreUserRequest $request)
    {
        return  User::create($request->validated());
    }
}
