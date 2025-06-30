<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'name' => 'required|max:255,' . $this->category->id,
            'status' => 'required',
            'meta_title' => 'string|nullable',
            'meta_description'=> 'nullable',
            'meta_keywords'=> 'string|nullable',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp',
        ];
    }
}
