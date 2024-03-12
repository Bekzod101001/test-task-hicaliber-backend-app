<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropertyIndexRequest extends PaginationRequest
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
        return array_merge(parent::rules(), [
            'name' => 'nullable|string',
            'priceFrom' => 'nullable|numeric|lte:priceTo',
            'priceTo' => 'nullable|numeric|gte:priceFrom',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'storeys' => 'nullable|integer',
            'garages' => 'nullable|integer',
        ]);
    }
}