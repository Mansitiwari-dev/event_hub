<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->vendorProfile?->id === $this->route('vendor')?->id;
    }

    public function rules(): array
    {
        return [
            'company_name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1000',
            'experience' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'service_amount' => 'nullable|numeric|min:0',
            'availability' => 'nullable|json',
        ];
    }
}
