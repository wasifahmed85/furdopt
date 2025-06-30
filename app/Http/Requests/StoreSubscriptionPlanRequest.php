<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriptionPlanRequest extends FormRequest
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
            'name' => 'required|max:255|unique:subscription_plans',
            'spotlight' => 'required|numeric',
            'type' => 'required',
            'duration' => 'required|numeric',
            'price' => 'required',
            'max_pets_allowed' => 'nullable|numeric',
            'can_feature_pets' => 'nullable',
            'can_top_search_pets' => 'nullable',
            'descriptions' => 'nullable',
            'status' => 'required',
        ];
    }
}
