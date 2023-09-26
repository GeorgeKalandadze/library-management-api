<?php

namespace App\Http\Requests;

use App\Enums\BookStatus;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'img_url' => 'nullable|url',
            'description' => 'required|string',
            'status' => 'required|in:' . implode(',', BookStatus::toValues()),
            'publish_date' => 'required|date',
            'authors' => 'required|array|min:1',
            'authors.*' => 'exists:authors,id',
        ];
    }
}
