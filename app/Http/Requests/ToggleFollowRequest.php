<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Checks that request contains valid data and
 * that user is authenticated.
 */
class ToggleFollowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
          'user_id' => ['required', Rule::exists(User::class, 'id')],
          'author_id' => ['required', Rule::exists(User::class, 'id')],
        ];
    }
}
