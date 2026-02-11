<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isServiceProvider();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:decorator,catering,dj,security,lighting,sound',
            'price' => 'required|numeric|min:0',
            'duration' => 'nullable|string|max:100',
            'features' => 'nullable|string',
            'max_bookings' => 'nullable|integer|min:1',
        ];
    }
}
