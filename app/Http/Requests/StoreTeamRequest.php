<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'team_name' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'vendor_ids' => 'nullable|array',
            'vendor_ids.*' => 'exists:vendor_profiles,id',
        ];
    }
}
