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
        return true;
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
            'status' => 'in:'.BookStatus::AVAILABLE->value.','.BookStatus::BOOKED->value,
            'publish_date' => 'required|date',
            'authors' => 'required|array|min:1',
            'authors.*' => 'exists:authors,id',
        ];
    }
}
