<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsletterRequest;
use App\Jobs\NewsletterSubscribeJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
class NewsletterController extends Controller
{
    public function __invoke(NewsletterRequest $request)
    {
        $attributes = $request->validated();
        try {
            NewsletterSubscribeJob::dispatch($attributes);
        } catch (\Exception $e) {
            Log::error($e);
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/')->with('success', 'You are now signed up for newsletter.');
    }
}
