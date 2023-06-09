<?php

namespace App\Http\Requests;

use App\Rules\MaxPostsPerUser;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        return [
            'title' =>'required|min:3|unique:posts,title,' . $this->post,
            'description' => ['required', 'min:5'],
            'user_id'=> ['exists:App\Models\User,id',new MaxPostsPerUser],
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
