<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
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
            'name' => 'required|max:255|unique:pages,name,' . $this->page->id,
            'serial' => 'nullable|numeric',
            'title' => 'required|max:255',
            // 'headline' => 'required|max:255',
            // 'header' => 'required|max:255',
            // 'summery' => 'string|nullable|max:255',
            'descriptions' => 'required',
            'status' => 'required',
            'header_menu' => 'required',
            'footer_menu' => 'required',
            'meta_title' => 'string|nullable|max:255',
            'meta_description' => 'string|nullable|max:255',
            'meta_keywords' => 'string|nullable|max:255',
            'terms_status' => 'string|nullable',
            'privacy_status' => 'string|nullable',
            'cookie_status' => 'string|nullable',
        ];
    }
}
