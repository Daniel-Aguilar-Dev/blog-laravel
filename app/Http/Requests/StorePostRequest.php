<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       return request('user_id') == auth()->user()->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'user_id' => 'required',
            'slug' => 'required|unique:posts',
            'status' => 'required|in:1,2',
            'category_id' => 'required_if:status,2',
            'tags' => 'required_if:status,2',
            'file' => 'nullable|image|max:2048',
            'extract' => 'required_if:status,2',
            'body' => 'required_if:status,2'
        ];
    }
}
