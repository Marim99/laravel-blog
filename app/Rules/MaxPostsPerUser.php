<?php

namespace App\Rules;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class MaxPostsPerUser implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes()
    {
        $user = Auth::user();
        $postCount = Post::where('user_id', $user->id)->count();
        return $postCount < 3;
    }

    public function message()
    {
        return 'You have exceeded the maximum number of allowed posts.';
    }
}
