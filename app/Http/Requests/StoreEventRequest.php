<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Any authenticated user can create events
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'event_type' => 'required|in:wedding,birthday,corporate,conference,anniversary,other',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'guest_count' => 'nullable|integer|min:0',
            'budget' => 'nullable|numeric|min:0',
            'status' => 'nullable|in:pending,confirmed,completed,cancelled',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Event title is required.',
            'title.max' => 'Event title must not exceed 255 characters.',
            'event_type.required' => 'Event type is required.',
            'event_type.in' => 'Please select a valid event type.',
            'start_date.required' => 'Start date is required.',
            'start_date.after_or_equal' => 'Start date must be today or later.',
            'end_date.required' => 'End date is required.',
            'end_date.after_or_equal' => 'End date must be after or equal to start date.',
            'location.required' => 'Event location is required.',
            'location.max' => 'Location must not exceed 255 characters.',
            'guest_count.integer' => 'Guest count must be a valid number.',
            'budget.numeric' => 'Budget must be a valid number.',
        ];
    }
}
